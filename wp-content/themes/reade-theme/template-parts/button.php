<?php
//SETUP
function button(
   $link = null,
   $add_classes = [],
   $rel = "noreferrer",
   $download = false,
   $text = null,
   $href = null,
   $target = "_self",
) { 
   if($link) {
      $title = $link['title'];
      $href = $link['url'];
      $target = $link['target'] ?: '_self';
   }
?>
   <a 
      class="btn<?php echo $add_classes ? " ".implode(' ',$add_classes):"";?>" 
      href="<?php echo $href ?: '#' ;?>"
      rel="<?php echo $rel ?: '' ;?>"
      target="<?php echo $target ?: '_self';?>"
      >
      <!-- icon -->
      <span><?php echo __($title, TEXTDOMAIN); ?></span>
      <!-- icon -->
   </a>
<?php 
}
