<?php

$fields = get_fields();


// empty cart
global $woocommerce;
$woocommerce->cart->empty_cart();

?>

<div class="rfq-submit--section">
 <div class="rfq-submit--main">
  <div class="rfq-submit--inner">
   <div class="rfq-submit--wrap">
    <?php if(!empty($fields['submit_image'])) :?>
     <figure>
      <?php echo wp_get_attachment_image( $fields['submit_image']['ID'], 'full' );?>
     </figure>
    <?php endif ;?>
    <?php if((!empty($fields['submit_heading'])) || (!empty($fields['submit_content']))) :?>
     <div class="rfq-submit--content">
        <h1 class="sr-only">Your RFQ Has Been Received</h1>
      <?php if(!empty($fields['submit_heading'])) :?>
       <h2><?php echo $fields['submit_heading'] ;?></h2>
      <?php endif ;?>
      <?php if(!empty($fields['submit_content'])) :?>
       <p><?php echo $fields['submit_content'] ;?></p>
      <?php endif ;?>
      <?php if(!empty($fields['submit_link'])) :?>
       <a 
       href="<?php echo $fields['submit_link']['url'] ;?>"
       target="<?php echo $fields['submit_link']['target'] ?: '_self';?>"
       class="btn-blue-dark-blue btn-arrow">
        <span><?php echo $fields['submit_link']['title'] ;?></span>
        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5063 6.38128C12.848 6.03957 13.402 6.03957 13.7437 6.38128L17.2437 9.88128C17.5854 10.223 17.5854 10.777 17.2437 11.1187L13.7437 14.6187C13.402 14.9604 12.848 14.9604 12.5063 14.6187C12.1646 14.277 12.1646 13.723 12.5063 13.3813L14.5126 11.375H4.375C3.89175 11.375 3.5 10.9832 3.5 10.5C3.5 10.0168 3.89175 9.625 4.375 9.625H14.5126L12.5063 7.61872C12.1646 7.27701 12.1646 6.72299 12.5063 6.38128Z" fill="#FAFAFA"/>
        </svg>
       </a>
      <?php endif ;?>
     </div>
    <?php endif ;?>
   </div>
  </div>
 </div>
</div>
<?php

   if (!empty($_GET['from']) && in_array($_GET['from'], array('custom', 'rfq'))) {

      if ($_GET['from'] == 'custom') {
         ?>
         <script>
         window.dataLayer || [];
         window.dataLayer.push({'event': 'submitproductrequest'});
         </script>
         <?php
      }

      if ($_GET['from'] == 'rfq') {
         ?>
         <script>
         window.dataLayer || [];
         window.dataLayer.push({'event': 'submitrfq'});
         </script>
         <?php
      }
   }