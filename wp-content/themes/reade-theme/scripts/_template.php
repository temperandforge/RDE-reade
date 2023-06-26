<?php 
$block_name = "hero";
if($fields = get_fields()): 

   //enqueue stylesheet
   add_action('wp_enqueue_scripts', function(){
      //wp_enqueue_styles(_FILENAME_, get_stylesheet_directory());
   }, 10);

   $pre_heading = null;
   $heading = null;
   $content = null;
   $buttons = [];
   if (array_key_exists('pre_heading', $fields)) { $pre_heading = $fields['pre_heading']; }
   if (array_key_exists('heading', $fields)) { $heading = $fields['heading']; }
   if (array_key_exists('content', $fields)) { $content = $fields['content']; }
   if (array_key_exists('buttons', $fields)) { $buttons = $fields['buttons']; }
   

?>

<!-- snippet -->
<div class="<?php echo $block_name;?>">
   <div class="<?php echo $block_name;?>-img">
      <picture>
         <?php echo wp_get_attachment_image($img['ID'], [2048,2048], false, ['class' => 'cover-img', 'role' => 'presentation']); ?>
      </picture>
   </div>
   <div class="<?php echo $block_name;?>-content">
      <?php if ($pre_heading): ?>
         <p class="pre-heading"><?php echo $pre_heading; ?></p>
      <?php endif;?>
      <?php if ($heading): ?>
         <h2 class="title is-2"><?php echo $heading; ?></h2>
      <?php endif;?>
      <?php if ($content): ?>
         <p><?php echo $content; ?></p>
      <?php endif;?>
      <?php if($buttons): ?>
         <div class="buttons-wrap">
            <?php foreach($buttons as $btn): $btn = $btn['btn']; ?>
            <a class="btn" href="<?php echo $btn['url'];?>" target="<?php echo $btn['target']?:'_self';?>">
               <?php echo $btn['title']; ?>
            </a>
            <?php endforeach;?>
         </div>
      <?php endif;?>
   </div>
</div>

<?php endif; ?>
