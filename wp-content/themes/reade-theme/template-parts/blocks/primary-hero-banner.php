<?php

$fields = get_fields();

?>

<div class="primary-hero--section">
 <div class="primary-hero--wrap">
  <div class="primary-hero--inner">
   <div class="primary-hero--content">
    <?php if(!empty($fields['heading'])) :?>
     <h1><?php echo $fields['heading'] ;?></h1>
    <?php endif ;?>
    <?php if(!empty($fields['content'])) :?>
     <p><?php echo $fields['content'] ;?></p>
    <?php endif ;?>
    <?php if(!empty($fields['link'])) :?>
     <a
     class="btn-blue-dark-blue btn-arrow"
     href="<?php echo $fields['link']['url'] ;?>"
     target="<?php echo $fields['link']['target'] ?: '_self' ;?>">
     <span><?php echo $fields['link']['title'] ;?></span>
     <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd" d="M11.1151 5.22214C11.5708 4.76653 12.3095 4.76653 12.7651 5.22214L17.4317 9.88881C17.8873 10.3444 17.8873 11.0831 17.4317 11.5387L12.7651 16.2054C12.3095 16.661 11.5708 16.661 11.1151 16.2054C10.6595 15.7498 10.6595 15.0111 11.1151 14.5555L13.7902 11.8804L4.94011 11.8804C4.29577 11.8804 3.77344 11.3581 3.77344 10.7138C3.77344 10.0694 4.29577 9.5471 4.94011 9.5471H13.7902L11.1151 6.87206C10.6595 6.41645 10.6595 5.67775 11.1151 5.22214Z" fill="white"/>
      </svg>
     </a>
    <?php endif ;?>
   </div>
   <figure class="primary-hero--figure">
    <?php echo wp_get_attachment_image( $fields['image']['ID'], 'full' );?>
   </figure>
  </div>
 </div>
</div>