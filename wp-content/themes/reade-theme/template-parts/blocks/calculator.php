<?php 

$fields = get_fields(); 

?>

<div class="calculator">
   <div class="calculator--content">
      <?php if (array_key_exists('heading', $fields) && $heading = $fields['heading'] ): ?>
         <h2 class="title"><?php echo $heading; ?></h2>
      <?php endif;?>
      <p><?php echo __($fields['content'], TEXTDOMAIN); ?></p>
      <?php if( $btn = $fields['btn']) {
         // include( 
         //    locate_template(
         //       'template-parts/button.php', 
         //       false, 
         //       false, 
         //       $args = [
         //          $link = [
         //             'title' => 'Download PDF',
         //             'url' => '##',
         //             'target' => '_blank'
         //          ],
         //          $text = null,
         //          $href = null,
         //          $rel = "noreferrer",
         //          $download = false,
         //          $target = "_self",
         //          $add_classes = []
         //       ]
         //    )
         // );

         $add_classes = [];
         $title = $btn['title'];
         $href = $btn['url'];
         $rel = "noreferrer";
         $target = $btn['target'];
         ?>
         <a 
            class="btn-blue-dark-blue<?php echo $add_classes ? " ".implode(' ',$add_classes):"";?>" 
            href="<?php echo $href ?: '#' ;?>"
            rel="<?php echo $rel ?: '' ;?>"
            target="<?php echo $target ?: '_self';?>"
            >
            <!-- icon -->
            <span><?php echo __($title, TEXTDOMAIN); ?></span>
            <!-- icon -->
         </a>
      <?php } ?>
   </div>

   <div class="calculator--component flex gap-x-8">
      <?php 
      foreach([
         1, 2, 3, 4
      ] as $idx => $dropdown) {
         // include(  locate_template(
         //    'template-parts/button.php', 
         //    false, 
         //    false, 
         //    $args = [
         //       'placeholder',
         //       [
         //          4.75,
         //          4 // ? float
         //       ]
         //    ]
         // ));
         tf_dropdown([
            'id'=>"test$idx"
         ]);
      } ?>
   </div>
</div>
