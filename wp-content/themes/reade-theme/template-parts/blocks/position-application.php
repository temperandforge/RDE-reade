<?php

$fields = get_fields();
if(IS_LOCAL) {
echo '<script>console.log('.json_encode($fields, JSON_PRETTY_PRINT).');</script>';//debug
}


?>

<div class="position--application--section">
 <div class="position-application--main">
  <div class="position-application--inner">
   <div class="position-application--wrap">
    <?php if(!empty($fields['content'])) :?>
     <p><strong><?php echo $fields['content'] ;?></strong></p>
    <?php endif ;?>
    <a 
    href="<?php echo (empty($fields['link'])) ? 'mailto:jobs@reade.com' : $fields['link']['url'] ;?>"
    target="<?php echo ((empty($fields['link'])) ||($fields['link']['target'] == '_blank')) ? '_blank' : '_self' ;?>"
    class="btn-blue-dark-blue btn-arrow">
    <span>
     <?php echo (empty($fields['link'])) ? 'Apply Now' : $fields['link']['title'] ;?>
    </span>
    <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
     <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5063 5.88128C12.848 5.53957 13.402 5.53957 13.7437 5.88128L17.2437 9.38128C17.5854 9.72299 17.5854 10.277 17.2437 10.6187L13.7437 14.1187C13.402 14.4604 12.848 14.4604 12.5063 14.1187C12.1646 13.777 12.1646 13.223 12.5063 12.8813L14.5126 10.875H4.375C3.89175 10.875 3.5 10.4832 3.5 10C3.5 9.51675 3.89175 9.125 4.375 9.125H14.5126L12.5063 7.11872C12.1646 6.77701 12.1646 6.22299 12.5063 5.88128Z" fill="#FAFAFA"/>
    </svg>
    </a>
   </div>
  </div>
 </div>
</div>