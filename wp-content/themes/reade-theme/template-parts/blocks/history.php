<?php

/** References/Resources
 * - https://css-tricks.com/pure-css-horizontal-scrolling/
 * // Vertical-Triggered Scrolling
 * - https://greensock.com/docs/v3/Plugins/ScrollTrigger
 * - https://codepen.io/GreenSock/pen/XWmEoNg
 * - SNAP - https://codepen.io/GreenSock/pen/YzygYvM
 * - "drawing a line across multiple components section html scrollmagic"
 * - https://scrollmagic.io/
 */

$fields = get_fields(); 
$events = $fields['events']; 
echo '<script>console.log('.json_encode($fields, JSON_PRETTY_PRINT).');</script>';//debug
?>

<div id="history" class="history">
   <div class="history--slider">
      <?php foreach($events as $idx => $event ):?>
         <div class="history--event event-<?php echo strval($idx); ?>">
            <h2 class="title primary"><?php echo $event['year'];?></h2>
            <h3 class="title secondary"><?php echo $event['heading'];?></h3>
            <?php //echo $event['content']; ?>
            <p>The Reade family industrial businesses were originally established in Wolverhampton, England as Reade Brothers Co., Ltd. in 1773. They manufactured pharmaceutical chemicals and varnishes.</p>

            <picture>
               <?php //echo wp_get_attachment_image($event['img']['ID'], [1920,1920], false, []); ?>
               <img src="https://picsum.photos/1920/192<?php echo strval($idx);?>.webp" alt="" />
            </picture>
         </div>
      <?php endforeach;?>
   </div>
   <div class="slick-arrow--container flex gap-x-3 justify-between">
      <button class="slick-prev slick-arrow" aria-label="<?php echo __('previous', TEXTDOMAIN); ?>" type="button" style="btn-blue-dark-blue">
         <span class="sr-only"> <?php echo __('previous', TEXTDOMAIN); ?> </span>
         <svg aria-hidden="true" width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1018 25.2317C15.5687 25.7648 14.7045 25.7648 14.1715 25.2317L5.98181 17.0421C5.44877 16.509 5.44877 15.6448 5.98181 15.1118L14.1715 6.92212C14.7045 6.38908 15.5687 6.38908 16.1018 6.92212C16.6348 7.45516 16.6348 8.3194 16.1018 8.85244L10.2422 14.712H26.0561C26.81 14.712 27.4211 15.3231 27.4211 16.0769C27.4211 16.8308 26.81 17.4419 26.0561 17.4419L10.2422 17.4419L16.1018 23.3014C16.6348 23.8344 16.6348 24.6987 16.1018 25.2317Z" fill="#009FC6"/> </svg>
      </button>
      <button class="slick-next slick-arrow" aria-label="<?php echo __('next', TEXTDOMAIN); ?>" type="button" style="btn-blue-dark-blue">
         <span class="sr-only"> <?php echo __('next', TEXTDOMAIN); ?> </span>
         <svg aria-hidden="true" width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M16.8982 25.2317C17.4313 25.7648 18.2955 25.7648 18.8285 25.2317L27.0182 17.0421C27.5512 16.509 27.5512 15.6448 27.0182 15.1118L18.8285 6.92212C18.2955 6.38908 17.4313 6.38908 16.8982 6.92212C16.3652 7.45516 16.3652 8.3194 16.8982 8.85244L22.7578 14.712H6.94386C6.19003 14.712 5.57892 15.3231 5.57892 16.0769C5.57892 16.8308 6.19003 17.4419 6.94386 17.4419L22.7578 17.4419L16.8982 23.3014C16.3652 23.8344 16.3652 24.6987 16.8982 25.2317Z" fill="#009FC6"/> </svg>
      </button>
   </div>
   <!-- Line connecting events - dynamic connections written - orcas-generated -->
   <svg></svg>
</div>
