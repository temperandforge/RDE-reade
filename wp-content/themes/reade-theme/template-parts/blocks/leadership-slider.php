<?php 

$post_type = 'team';
$leadership_team = [];
if(is_single()) {
   global $post;
   $post_type = $post_type;
} else {
   $fields = get_fields() ?: [];
   if(array_key_exists('team', $fields) && $fields['team']) {
      $leadership_team = $fields['team'];
   }
}

if(!$leadership_team) {
   global $wp_query; 
   $wp_query = new WP_Query([
      'orderby'        => 'date',
      'order'          => 'ASC',
      'post_type'      => $post_type,
      'posts_per_page' => -1,
      'post_status'    => 'publish',
      'posts__not_in'  => [get_the_ID()],
   ]);
   $leadership_team = $wp_query->posts;
}

?>

<div class="leadership-slider--section">
 <div class="leadership-slider--main">
  <div class="leadership-slider--inner">
   
   <div class="leadership-slider--nav" role="presentation">
   </div>
   
   <div class="leadership-slider--slider">
    <?php foreach($leadership_team as $post) :
     $postid = $post->ID;
     $title = $post->post_title;
     $post_fields = get_fields($postid);
     $content_post = get_post($postid);
     $content = $content_post->post_content;
     ?>
     <div class="leadership-slider--slide" data-title="<?php echo $title ;?>" 
     <?php if(!empty($post_fields['position'])) :?>
      data-position="<?php echo $post_fields['position'] ;?>"
     <?php endif ;?>>
      <?php if(has_post_thumbnail($postid)) :?>
         <figure>
            <?php echo get_the_post_thumbnail($postid, 'full') ;?>
         </figure>
      <?php endif ;?>
      <div class="leadership-slider--top">
         <div class="leadership-slider--member">
            <h2><?php echo $title ;?></h2>
            <?php if(!empty($post_fields['position'])) :?>
               <p><?php echo $post_fields['position'] ;?></p>
            <?php endif ;?>
         </div>
         <?php if((!empty($post_fields['email'])) ||(!empty($post_fields['linkedin']))) :?>
            <div class="leadership-slider--contact" >
               <?php if(!empty($post_fields['linkedin'])) :?>
                <a 
                href="<?php echo $post_fields['linkedin']['title'] ;?>"
                target="<?php echo $post_fields['linkedin']['target'] ?: '_self';?>"
                class="icon-btn linkedin">
                 <span class="sr-only"><?php echo $post_fields['linkedin']['title'] ;?> Profile</span>
                 <svg width="27" height="26" viewBox="0 0 27 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0_4305_71668)">
                     <path d="M24.4334 0.165283H2.55919C1.51136 0.165283 0.664062 0.992523 0.664062 2.01529V23.9798C0.664062 25.0025 1.51136 25.8348 2.55919 25.8348H24.4334C25.4813 25.8348 26.3336 25.0025 26.3336 23.9848V2.01529C26.3336 0.992523 25.4813 0.165283 24.4334 0.165283ZM8.27968 22.0395H4.46937V9.78634H8.27968V22.0395ZM6.37453 8.11682C5.15121 8.11682 4.16354 7.12914 4.16354 5.91084C4.16354 4.69254 5.15121 3.70487 6.37453 3.70487C7.59282 3.70487 8.5805 4.69254 8.5805 5.91084C8.5805 7.12413 7.59282 8.11682 6.37453 8.11682ZM22.5383 22.0395H18.733V16.0834C18.733 14.6645 18.7079 12.8346 16.7526 12.8346C14.7723 12.8346 14.4715 14.3838 14.4715 15.9831V22.0395H10.6712V9.78634H14.321V11.4609H14.3712C14.8776 10.4983 16.1209 9.48051 17.9709 9.48051C21.8264 9.48051 22.5383 12.0174 22.5383 15.3163V22.0395V22.0395Z" fill="#009FC6"/>
                  </g>
                  <defs>
                     <clipPath id="clip0_4305_71668">
                        <rect width="25.6695" height="25.6695" fill="white" transform="translate(0.664062 0.165283)"/>
                     </clipPath>
                  </defs>
               </svg>
                </a>
               <?php endif ;?>
               <?php if(!empty($post_fields['email'])) :?>
                <a 
                href="mailto:<?php echo $post_fields['email'] ;?>"
                class="icon-btn">
                <span class="sr-only"><?php echo $post_fields['email'] ;?></span>
                <svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                   <path d="M5.58203 11.147L15.1555 17.5294C15.9706 18.0728 17.0325 18.0728 17.8476 17.5294L27.4211 11.147M8.00859 24.4931H24.9945C26.3347 24.4931 27.4211 23.4067 27.4211 22.0666V9.93376C27.4211 8.59361 26.3347 7.5072 24.9945 7.5072H8.00859C6.66844 7.5072 5.58203 8.59361 5.58203 9.93376V22.0666C5.58203 23.4067 6.66844 24.4931 8.00859 24.4931Z" stroke="#009FC6" stroke-width="2.60509" stroke-linecap="round" stroke-linejoin="round"/>
               </svg>
                </a>
               <?php endif ;?>
               <?php if(!empty($post_fields['phone_number'])) :?>
                <a
                href="tel:<?php echo $post_fields['phone_number'] ;?><?php if(!empty($post_fields['phone_extension'])) {?>p<?php echo $post_fields['phone_extension'] ;?><?php };?>"
                class="icon-btn">
                 <span class="sr-only"><?php echo $post_fields['phone_number'] ;?><?php if(!empty($post_fields['phone_extension'])) :?> EXT: <?php echo $post_fields['phone_extension'] ;?><?php endif ;?></span>
                  <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M4.52734 6.85518C4.52734 5.56996 5.56922 4.52808 6.85445 4.52808H10.67C11.1708 4.52808 11.6155 4.84855 11.7739 5.32368L13.5166 10.552C13.6998 11.1014 13.4511 11.7017 12.9332 11.9607L10.3067 13.2739C11.5892 16.1185 13.8809 18.4101 16.7255 19.6926L18.0387 17.0662C18.2976 16.5483 18.898 16.2996 19.4473 16.4827L24.6757 18.2255C25.1508 18.3839 25.4713 18.8285 25.4713 19.3293V23.1449C25.4713 24.4301 24.4294 25.472 23.1442 25.472H21.9806C12.3414 25.472 4.52734 17.6579 4.52734 8.01873V6.85518Z" stroke="#009FC6" stroke-width="2.49831" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </a>
               <?php endif ;?>
            </div>
         <?php endif ;?>
      </div>
         <?php if(!empty($content)) :?>
            <div class="leadership-slider--content">
               <?php echo $content ;?>
            </div>
         <?php endif ;?>
      </div>
      <?php endforeach ; ?>
   </div>

   <div class="leadership-slider--mobile" role="presentation">
      <div class="leadership-slider-mobile--arrows">
         <button class="slick-prev-arrow" aria-label="Previous">
            <span class="sr-only">Previous slide</span>
            <svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1018 25.1C15.5687 25.633 14.7045 25.633 14.1715 25.1L5.98181 16.9104C5.44877 16.3773 5.44877 15.5131 5.98181 14.98L14.1715 6.79041C14.7045 6.25736 15.5687 6.25736 16.1018 6.79041C16.6348 7.32345 16.6348 8.18768 16.1018 8.72072L10.2422 14.5803H26.0561C26.81 14.5803 27.4211 15.1914 27.4211 15.9452C27.4211 16.699 26.81 17.3101 26.0561 17.3101L10.2422 17.3101L16.1018 23.1697C16.6348 23.7027 16.6348 24.567 16.1018 25.1Z" fill="#009FC6"/>
            </svg>
         </button>
         <button class="slick-next-arrow" aria-label="Next">
            <span class="sr-only">Next slide</span>
            <svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path fill-rule="evenodd" clip-rule="evenodd" d="M16.8982 25.1C17.4313 25.633 18.2955 25.633 18.8285 25.1L27.0182 16.9104C27.5512 16.3773 27.5512 15.5131 27.0182 14.98L18.8285 6.79041C18.2955 6.25736 17.4313 6.25736 16.8982 6.79041C16.3652 7.32345 16.3652 8.18768 16.8982 8.72072L22.7578 14.5803H6.94386C6.19003 14.5803 5.57892 15.1914 5.57892 15.9452C5.57892 16.699 6.19003 17.3101 6.94386 17.3101L22.7578 17.3101L16.8982 23.1697C16.3652 23.7027 16.3652 24.567 16.8982 25.1Z" fill="#009FC6"/>   
            </svg>
         </button>
         </div>
      <div class="leadership-slider-mobile--contacts">
         <?php foreach($leadership_team as $post) :
            $post_fields = get_fields($postid);
            $postid = $post->ID;
            ?>
            <div class="leadership-slider-mobile-contact">
               <?php if(!empty($post_fields['linkedin'])) :?>
                  <a 
                   href="<?php echo $post_fields['linkedin']['title'] ;?>"
                   target="<?php echo $post_fields['linkedin']['target'] ?: '_self';?>"
                   class="icon-btn linkedin">
                    <span class="sr-only"><?php echo $post_fields['linkedin']['title'] ;?> Profile</span>
                    <svg width="27" height="26" viewBox="0 0 27 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <g clip-path="url(#clip0_4305_71668)">
                        <path d="M24.4334 0.165283H2.55919C1.51136 0.165283 0.664062 0.992523 0.664062 2.01529V23.9798C0.664062 25.0025 1.51136 25.8348 2.55919 25.8348H24.4334C25.4813 25.8348 26.3336 25.0025 26.3336 23.9848V2.01529C26.3336 0.992523 25.4813 0.165283 24.4334 0.165283ZM8.27968 22.0395H4.46937V9.78634H8.27968V22.0395ZM6.37453 8.11682C5.15121 8.11682 4.16354 7.12914 4.16354 5.91084C4.16354 4.69254 5.15121 3.70487 6.37453 3.70487C7.59282 3.70487 8.5805 4.69254 8.5805 5.91084C8.5805 7.12413 7.59282 8.11682 6.37453 8.11682ZM22.5383 22.0395H18.733V16.0834C18.733 14.6645 18.7079 12.8346 16.7526 12.8346C14.7723 12.8346 14.4715 14.3838 14.4715 15.9831V22.0395H10.6712V9.78634H14.321V11.4609H14.3712C14.8776 10.4983 16.1209 9.48051 17.9709 9.48051C21.8264 9.48051 22.5383 12.0174 22.5383 15.3163V22.0395V22.0395Z" fill="#009FC6"/>
                     </g>
                     <defs>
                        <clipPath id="clip0_4305_71668">
                           <rect width="25.6695" height="25.6695" fill="white" transform="translate(0.664062 0.165283)"/>
                        </clipPath>
                     </defs>
                  </svg>
                   </a>
                  <?php endif ;?>
                  <?php if(!empty($post_fields['email'])) :?>
                   <a 
                   href="mailto:<?php echo $post_fields['email'] ;?>"
                   class="icon-btn">
                   <span class="sr-only"><?php echo $post_fields['email'] ;?></span>
                   <svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M5.58203 11.147L15.1555 17.5294C15.9706 18.0728 17.0325 18.0728 17.8476 17.5294L27.4211 11.147M8.00859 24.4931H24.9945C26.3347 24.4931 27.4211 23.4067 27.4211 22.0666V9.93376C27.4211 8.59361 26.3347 7.5072 24.9945 7.5072H8.00859C6.66844 7.5072 5.58203 8.59361 5.58203 9.93376V22.0666C5.58203 23.4067 6.66844 24.4931 8.00859 24.4931Z" stroke="#009FC6" stroke-width="2.60509" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                   </a>
                  <?php endif ;?>
                  <?php if(!empty($post_fields['phone_number'])) :?>
                   <a
                   href="tel:<?php echo $post_fields['phone_number'] ;?><?php if(!empty($post_fields['phone_extension'])) {?>p<?php echo $post_fields['phone_extension'] ;?><?php };?>"
                   class="icon-btn">
                    <span class="sr-only"><?php echo $post_fields['phone_number'] ;?><?php if(!empty($post_fields['phone_extension'])) :?> EXT: <?php echo $post_fields['phone_extension'] ;?><?php endif ;?></span>
                     <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.52734 6.85518C4.52734 5.56996 5.56922 4.52808 6.85445 4.52808H10.67C11.1708 4.52808 11.6155 4.84855 11.7739 5.32368L13.5166 10.552C13.6998 11.1014 13.4511 11.7017 12.9332 11.9607L10.3067 13.2739C11.5892 16.1185 13.8809 18.4101 16.7255 19.6926L18.0387 17.0662C18.2976 16.5483 18.898 16.2996 19.4473 16.4827L24.6757 18.2255C25.1508 18.3839 25.4713 18.8285 25.4713 19.3293V23.1449C25.4713 24.4301 24.4294 25.472 23.1442 25.472H21.9806C12.3414 25.472 4.52734 17.6579 4.52734 8.01873V6.85518Z" stroke="#009FC6" stroke-width="2.49831" stroke-linecap="round" stroke-linejoin="round"/>
                     </svg>
                   </a>
                  <?php endif ;?>
            </div>
         <?php endforeach ; wp_reset_query(); ?>
      </div>
   </div>


  </div>
 </div>
</div>