<?php
//SETUP
function button(
   $add_classes = []
) { 
?>
   <a 
      class="btn<?php echo $add_classes ? " ".implode(' ',$add_classes):"";?>" 
      href=""
      rel="noreferrer"
      target="_self">
      <!-- icon -->
      <span>Button</span>
      <!-- icon -->
   </a>
<?php 
}
