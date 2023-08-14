<?php

if (is_category() || is_archive()) {
  $fields = $args;
} else {
  $fields = get_fields();
}

$options = get_fields('options');

// style, heading, content, link, icon, and include arrow are set on a per block basis if they are needed
$style = $fields['style'] ? $fields['style'] : 'white';
$heading = !empty($fields['heading']) ? $fields['heading'] : false;
$content = !empty($fields['content']) ? $fields['content'] : false;
$link = !empty($fields['link']) ? $fields['link'] : false;
$includearrow = $fields['include_arrow'] ? $fields['include_arrow'] : false;
$icon = !empty($fields['icon']) ? $fields['icon'] : false;


// if no cta's are set, we pull the default values from theme options
$ctas = !empty($fields['ctas']) ? $fields['ctas'] : $options['pfcta_ctas'];


?>

<div class="primary-footer-cta--section <?php echo $style; ?>">
 <div class="primary-footer-cta--main">
  <div class="primary-footer-cta--inner">

   <div class="primary-footer-cta--wrap">

    <?php if(!empty($heading)) :?>
      <div class="primary-footer-cta--cta primary-cta">
        <p class="primary-ptitle"><?php echo $heading ;?></p>
     <?php if(!empty($content)) :?>
      <p style="text-wrap: balance" ><?php echo $content;?></p>
     <?php endif ;?>
     <?php if(!empty($link)) :?>
      <a 
      href="<?php echo $link['url'] ;?>"
      target="<?php echo $link['target'] ?: '_self';?>"
      class="primary-cta-btn<?php echo $fields['include_arrow'] ? ' btn-arrow' : null ;?>">
       <span><?php echo $fields['link']['title'] ;?></span>
       <?php if($includearrow) :?>
        <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5063 5.88128C12.848 5.53957 13.402 5.53957 13.7437 5.88128L17.2437 9.38128C17.5854 9.72299 17.5854 10.277 17.2437 10.6187L13.7437 14.1187C13.402 14.4604 12.848 14.4604 12.5063 14.1187C12.1646 13.777 12.1646 13.223 12.5063 12.8813L14.5126 10.875H4.375C3.89175 10.875 3.5 10.4832 3.5 10C3.5 9.51675 3.89175 9.125 4.375 9.125H14.5126L12.5063 7.11872C12.1646 6.77701 12.1646 6.22299 12.5063 5.88128Z" fill="white"/>
       </svg>
       <?php endif ;?>
      </a>
      <?php endif ;?>
     </div>
    <?php endif ;?>

    <?php if(($style == 'bg-light-blue') && ($icon != 'no-svg') && (!empty($heading))) :?>
     <div class="primary-footer-cta--decor <?php echo $icon ;?>" aria-hidden="true"></div>
    <?php endif ;?>
   </div>
   
   <?php

   if(!empty($ctas)) :?>
    <div class="primary-footer-secondary--wrap">
     <?php foreach($ctas as $index=>$cta) :?>
      <div class="primary-footer-cta--cta secondary-cta">
        <?php if($cta['icon'] != 'none') :?>
          <div class="footer-cta-icon--wrap <?php echo $cta['icon'];?>" aria-hidden="true"></div>
        <?php endif ;?>
       <?php if(!empty($cta['heading'])) :?>
        <p class="ptitle"><?php echo $cta['heading'] ;?></p>
       <?php endif ;?>
       <?php if(!empty($cta['content'])) :?>
        <p><?php echo $cta['content'] ;?></p>
       <?php endif ;?>
       <?php if(!empty($cta['link'])) :?>
        <a 
        href="<?php echo $cta['link']['url'] ;?>"
        class="secondary-cta-btn"
        target="<?php echo $cta['link']['target'] ?: '_self' ;?>"><?php echo $cta['link']['title'] ;?></a>
       <?php endif ;?>
      </div>
     <?php endforeach ;?>
    </div>
   <?php endif ;?>
  </div>
 </div>
</div>

