<?php

$fields = get_fields();
if(IS_LOCAL) {
echo '<script>console.log('.json_encode($fields, JSON_PRETTY_PRINT).');</script>';//debug
}

?>

<div class="simple-cta--section <?php 
echo $fields['style'] == 'light-blue' ? 'light-blue' : null ;
echo $fields['style'] == 'dark-blue' ? 'dark-blue' : null ;
echo $fields['style'] == 'white' ? 'white' : null ;
echo $fields['style'] == 'with-image' ? 'with-image' : null ;?>">

 <div class="simple-cta--wrap"
   <?php // for with image only;
   if(($fields['style'] == 'with-image') && (!empty($fields['background_image']))) :?>
    style="background-image: url('<?php echo $fields['background_image']['url']; ?>')"
   <?php endif ;?>>

   <div class="simple-cta-content--wrap<?php echo ($fields['style'] == 'dark-blue') || ($fields['style'] == 'white') || ((isset($fields['text_align'])) && (!$fields['text_align'])) ? ' centered' : null ;?>">

   <?php // for with image only;
   if($fields['style'] == 'with-image') :?>
    <div class="simple-cta--content">
    <?php endif ;?>

    <?php if(!empty($fields['heading'])) :?>
      <h2 class="cta-heading<?php echo empty($fields['content']) ? ' solo-heading' : null ;?>"><?php echo $fields['heading'] ;?></h2>
      <?php endif ;?>
      <?php if(!empty($fields['content'])) :?>
        <p><?php echo $fields['content'] ;?></p>
        <?php endif ;?>
        <?php if(!empty($fields['link'])) :?>

   <?php  // for with image only - closing div;
   if($fields['style'] == 'with-image') :?>
    </div>
    <?php endif ;?>

    <a 
     href="<?php echo $fields['link']['url'] ;?>" 
     class="simple-cta-btn <?php echo $fields['include_arrow']? 'btn-arrow' : null ;?>"
     target="<?php echo $fields['link']['target'] ;?>">
     <?php echo $fields['link']['title'] ;?>
     <?php if($fields['include_arrow']) :?>
      <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
       <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5063 5.88128C12.848 5.53957 13.402 5.53957 13.7437 5.88128L17.2437 9.38128C17.5854 9.72299 17.5854 10.277 17.2437 10.6187L13.7437 14.1187C13.402 14.4604 12.848 14.4604 12.5063 14.1187C12.1646 13.777 12.1646 13.223 12.5063 12.8813L14.5126 10.875H4.375C3.89175 10.875 3.5 10.4832 3.5 10C3.5 9.51675 3.89175 9.125 4.375 9.125H14.5126L12.5063 7.11872C12.1646 6.77701 12.1646 6.22299 12.5063 5.88128Z" fill="#FAFAFA"/>
      </svg>
     <?php endif ;?>
    </a>
   <?php endif ;?>
  </div>
 </div>
</div>

