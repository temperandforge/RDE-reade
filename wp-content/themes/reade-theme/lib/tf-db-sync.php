<?php



define('TF_DB_SYNC_SECURITY_STRING', 'W6pdOt4z3j91');
define('TF_DB_SYNC_URL', 'https://reade.wpengine.com/wp-json/tf-db-sync/v1/dump-tables?auth=' . TF_DB_SYNC_SECURITY_STRING);

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
function dump_tables_endpoint() {
   register_rest_route( 'tf-db-sync/v1', '/dump-tables', array(
       'methods'  => 'GET',
       'callback' => 'dump_tables_callback',
       'permission_callback' => function () {
           return true;
       }
   ));
}
add_action( 'rest_api_init', 'dump_tables_endpoint' );


function dump_tables_callback( $request ) {

    // if (empty($_GET['auth']) || ($_GET['auth'] != TF_DB_SYNC_SECURITY_STRING)) {
    //     die('invalid')
    // }
   global $wpdb;

   // Get all database tables except 'wp_users'
   $tables = $wpdb->get_results( "SHOW TABLES LIKE '{$wpdb->prefix}%'", ARRAY_N );
   $excluded_table = 'wp_users';
   $filtered_tables = array_filter( $tables, function ( $table ) use ( $excluded_table ) {
       return $table[0] !== $excluded_table;
   });

   $response = array();

   // Dump the contents of each table
   foreach ( $filtered_tables as $table ) {
       $table_name = $table[0];
       $results = $wpdb->get_results( "SELECT * FROM {$table_name}", ARRAY_A );
       $response[ $table_name ] = $results;
   }

   // Dump the structure of each table
   foreach ( $filtered_tables as $table ) {
        $table_name = $table[0];
        $table_structure = $wpdb->get_results( "DESCRIBE {$table_name}", ARRAY_A );
        $response[ $table_name ]['structure'] = $table_structure;
    }

   return rest_ensure_response( $response );
}

function tfdbsync_menu_page()
{
    add_menu_page(
        'TF DB Sync', // The text to be displayed in the title tags of the page when the menu is selected
        'TFDBSync', // The text to be used for the menu
        'read', // The capability required for this menu to be displayed to the user
        'tfdbsync', // The slug name to refer to this menu page
        'tfdbsync_callback', // The function to be called to output the content for this page
        'dashicons-database', // The URL to the icon to be used for this menu
        300 // The position of this menu item in the menu
    );
}
add_action('admin_menu', 'tfdbsync_menu_page');

// Callback function to output the content of the custom menu page
function tfdbsync_callback()
{
    ?><div class="wrap">
    
    <?php

    if (!empty($_POST['action']) && ($_POST['action'] == 'doTFDBSync')) {

        set_time_limit(0);
        ignore_user_abort(true);

        if ($remotedb = @wp_remote_get(TF_DB_SYNC_URL)) {
            if (!is_wp_error($remotedb)) {
                $response_code = wp_remote_retrieve_response_code($remotedb);
                
                if ($response_code != '200') {
                    die('Response code returned was not 200');
                }
                
                if ($remotedb = @json_decode($remotedb['body'])) {

                    

                    $currentURL = get_site_url();

    ##### DROP ALL TABLES #####
                    // Drop all tables except 'wp_users'
                    global $wpdb;
                    $excluded_table = 'wp_users';
                    $tables = $wpdb->get_results( "SHOW TABLES", ARRAY_N );

                    foreach ( $tables as $table ) {
                        $table_name = $table[0];

                        if ( $table_name !== $excluded_table ) {
                            //echo "TRUNCATE `{$table_name}`;";
                            $wpdb->query("TRUNCATE `{$table_name}`;" ) or die('could not truncate table ' . $table_name);
                        }
                    }

                    echo 'All tables except wp_users truncated.';
                   
//                     $allQueries = array();
//                     foreach ( $remotedb as $t => $d ) {
//                         foreach ($d as $type => $d) {
//                             if ($type == 'structure') {
//                                 $create_table_query = "CREATE TABLE {$t} (";
//                                 $columns = array();
//                                 $pk = false;
//                                 foreach ($d AS $tf) {
//                                     $column_name = $tf->Field;
//                                     $column_type = $tf->Type;
//                                     $column_default = isset( $tf->Default ) ? "DEFAULT '{$tf->Default}'" : '';
//                                     $column_nullable = $tf->Null === 'YES' ? 'NULL' : 'NOT NULL';
//                                     $column_extra = isset( $tf->Extra ) ? $tf->Extra : '';
//                                     if (!$pk) {
//                                         $column_key = $tf->Key == 'PRI' ? "primary key" : '';
//                                         $pk = true;
//                                     } else {
//                                         $column_key = '';
//                                     }
//                                     $create_table_query .= "{$column_name} {$column_type} {$column_default} {$column_nullable} {$column_extra} {$column_key}, ";
                                    
//                                 }
//                                 $create_table_query = rtrim( $create_table_query, ', ' );
//                                     $create_table_query .= ');';
//                                     $allQueries[] = $create_table_query;
//                             }
//                         }
//                     }

//     ##### INSERT ALL TABLES
//                     // CREATE ALL TABLES
//                     echo '<BR>CREATE ALL TABLES<BR>';
//                     $allQueries = implode(' ', $allQueries);
//                    //dbDelta($allQueries) or die('could not create tables');
// //                    if (dbDelta($allQueries)) {
//                         //
//   //                  } else {
//     //                    echo 'could not create all tables';
//       //              }

//                     echo '<br />All tables created.';
//                     echo $allQueries;


    ##### INSERT ALL DATA
                    // Insert data into the table
                     //echo '<pre>'; print_r($remotedb); echo '</pre>';
                     $insertQueries = array();
                     foreach ($remotedb AS $table => $data) {
                        foreach ( $data as $k => $row ) {
                            if ($k != 'structure') {
                                $row = (array) $row;
                                $columns = implode( ', ', array_keys( $row ) );
                                $values = implode( "', '", array_map('addslashes', array_values( $row ) ));
                                 $insert_query = "INSERT INTO {$table} ({$columns}) VALUES ('{$values}');";
                                 $wpdb->query($insert_query);
                                 //$wpdb->query( $insert_query ) or die('db error: ' . $wpdb->last_error);
                            }
                         }
                     }

                     //echo implode(' ', $insertQueries);

                     //$wpdb->query($insertQueries) or die($wpdb->show_errors());

                     echo '<br />All data inserted.';


                     // update to current url
                     $wpdb->query("UPDATE `wp_options` SET `option_value` = '$currentURL' WHERE `option_name` = 'siteurl'");
                     $wpdb->query("UPDATE `wp_options` SET `option_value` = '$currentURL' WHERE `option_name` = 'home';");

                     echo '<br />Local values for siteurl and home option fields restored';

                     flush_rewrite_rules();

                     echo '<br />Permalinks flushed.';
                    

                } else {
                    echo '<p>Could not json_decode() remote contents.  Try again later.</p>';
                }
            } else {
                echo '<p>Sorry, there was an error: ' . $remotedb->get_error_message() . '</p>';
            }
        } else {
            echo '<p>Could not wp_remote_get() remote URL.  Try again later.</p>';
        }
    }

    ?>
    
    <h1>TF DB Sync</h1>
    <p>Sync the remote dev site database locally.  This will not export/import the users table.  Your site URL and home URL will remain the same locally.  It will also flush permalinks.</p>

    <form action="<?php echo site_url(); ?>/wp-admin/admin.php?page=tfdbsync" method="post">
    <input type="hidden" name="action" value="doTFDBSync">
    <input type="submit" value="Sync Now">
    </form>
    </div>

    <?php
}