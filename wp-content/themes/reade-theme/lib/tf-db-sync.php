<?php

define('TF_DB_SYNC_SECURITY_STRING', 'W6pdOt4z3j91');
define('TF_DB_SYNC_URL', 'https://reade.wpengine.com/wp-json/tf-db-sync/v1/dump-tables?auth=' . TF_DB_SYNC_SECURITY_STRING);


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
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
         );
        if ($remotedb = @wp_remote_get(TF_DB_SYNC_URL)) {
            if (!is_wp_error($remotedb)) {
                if ($remotedb = @json_decode($remotedb['body'])) {

                    
                    echo '<pre>';
                    print_r($remotedb);
                    echo '</pre>';

                    // drop all tables locally except for users


                    // create tables from the response body
                    $create_table_query = "CREATE TABLE IF NOT EXISTS {$table_name} (";
                    $columns = array();

                    foreach ( $remotedb as $k => $data ) {

                         if ($k = 'structure') {
                            echo '<pre>'; print_r($data); echo '</pre>';
                            $column_name = $data['Field'];
                            $column_type = $data['Type'];
                            $column_key = $data['Key'];
                            $column_extra = $data['Extra'];

                            $columns[] = "$column_name $column_type $column_key $column_extra";
                        }
                    }

                    $create_table_query .= implode( ', ', $columns );
                    $create_table_query .= ')';

                    echo $create_table_query;

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