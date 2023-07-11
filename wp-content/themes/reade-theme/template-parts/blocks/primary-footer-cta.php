<?php

$fields = get_fields();

?>

<div class="primary-footer-cta--section <?php echo $fields['style']?>">
 <div class="primary-footer-cta--main">
  <div class="primary-footer-cta--inner">

   <div class="primary-footer-cta--wrap">

    <?php if(!empty($fields['heading'])) :?>
      <div class="primary-footer-cta--cta primary-cta">
        <h2><?php echo $fields['heading'] ;?></h2>
     <?php if(!empty($fields['content'])) :?>
      <p><?php echo $fields['content'] ;?></p>
     <?php endif ;?>
     <?php if(!empty($fields['link'])) :?>
      <a 
      href="<?php echo $fields['link']['title'] ;?>"
      target="<?php echo $fields['link']['target'] ?: '_self';?>"
      class="primary-cta-btn<?php echo $fields['include_arrow'] ? ' btn-arrow' : null ;?>">
       <span><?php echo $fields['link']['title'] ;?></span>
       <?php if($fields['include_arrow']) :?>
        <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5063 5.88128C12.848 5.53957 13.402 5.53957 13.7437 5.88128L17.2437 9.38128C17.5854 9.72299 17.5854 10.277 17.2437 10.6187L13.7437 14.1187C13.402 14.4604 12.848 14.4604 12.5063 14.1187C12.1646 13.777 12.1646 13.223 12.5063 12.8813L14.5126 10.875H4.375C3.89175 10.875 3.5 10.4832 3.5 10C3.5 9.51675 3.89175 9.125 4.375 9.125H14.5126L12.5063 7.11872C12.1646 6.77701 12.1646 6.22299 12.5063 5.88128Z" fill="white"/>
       </svg>
       <?php endif ;?>
      </a>
      <?php endif ;?>
     </div>
    <?php endif ;?>

    <?php if(($fields['style'] == 'bg-light-blue') && ($fields['icon'] != 'no-svg') && (!empty($fields['heading']))) :?>
     <div class="primary-footer-cta--decor <?php echo $fields['icon'] ;?>" aria-hidden="true"></div>
    <?php endif ;?>
   </div>
   
   <?php if(!empty($fields['ctas'])) :?>
    <div class="primary-footer-secondary--wrap">
     <?php foreach($fields['ctas'] as $index=>$cta) :?>
      <div class="primary-footer-cta--cta secondary-cta">
        <?php if($cta['icon'] != 'none') :?>
          <div class="footer-cta-icon--wrap <?php echo $cta['icon'];?>" aria-hidden="true"></div>
        <?php endif ;?>
       <?php if(!empty($cta['heading'])) :?>
        <h3><?php echo $cta['heading'] ;?></h3>
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