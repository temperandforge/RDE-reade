<?php
echo '<script>console.log('.json_encode($block, JSON_PRETTY_PRINT).');</script>';//debug

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { 
   ?>
   <figure>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/blocks/benefits.webp" alt="Preview of Benefits Block">
   </figure>
<?php 
} else if( $fields = get_fields() ) {

   $bicons = array(
      'textplus' => '<svg width="53" height="52" viewBox="0 0 53 52" fill="none" xmlns="http://www.w3.org/2000/svg"> <rect width="53" height="52" rx="10" fill="#CFEEF7"/> <mask id="mask0_4510_67909" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="13" y="12" width="27" height="28"> <rect x="13" y="12.5" width="27" height="27" fill="#D9D9D9"/> </mask> <g mask="url(#mask0_4510_67909)"> <path d="M16.375 30.5V28.25H24.25V30.5H16.375ZM16.375 26V23.75H28.75V26H16.375ZM16.375 21.5V19.25H28.75V21.5H16.375ZM31 35V30.5H26.5V28.25H31V23.75H33.25V28.25H37.75V30.5H33.25V35H31Z" fill="#009FC6"/> </g> </svg> ',
      'marketplus' => '<svg width="53" height="52" viewBox="0 0 53 52" fill="none" xmlns="http://www.w3.org/2000/svg"> <rect width="53" height="52" rx="10" fill="#CFEEF7"/> <mask id="mask0_4510_67919" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="13" y="12" width="27" height="28"> <rect x="13" y="12.5" width="27" height="27" fill="#D9D9D9"/> </mask> <g mask="url(#mask0_4510_67919)"> <path d="M33.25 38.375V35H29.875V32.75H33.25V29.375H35.5V32.75H38.875V35H35.5V38.375H33.25ZM15.25 35V28.25H14.125V26L15.25 20.375H32.125L33.25 26V28.25H32.125V31.625H29.875V28.25H25.375V35H15.25ZM17.5 32.75H23.125V28.25H17.5V32.75ZM15.25 19.25V17H32.125V19.25H15.25ZM16.4312 26H30.9438L30.2688 22.625H17.1063L16.4312 26Z" fill="#009FC6"/> </g> </svg> ',
      'sound' => '<svg width="53" height="52" viewBox="0 0 53 52" fill="none" xmlns="http://www.w3.org/2000/svg"> <rect width="53" height="52" rx="10" fill="#CFEEF7"/> <mask id="mask0_4510_67930" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="13" y="12" width="27" height="28"> <rect x="13" y="12.5" width="27" height="27" fill="#D9D9D9"/> </mask> <g mask="url(#mask0_4510_67930)"> <path d="M31 27.125V24.875H35.5V27.125H31ZM32.35 35L28.75 32.3L30.1 30.5L33.7 33.2L32.35 35ZM30.1 21.5L28.75 19.7L32.35 17L33.7 18.8L30.1 21.5ZM16.375 29.375V22.625H20.875L26.5 17V35L20.875 29.375H16.375ZM24.25 22.4562L21.8312 24.875H18.625V27.125H21.8312L24.25 29.5438V22.4562Z" fill="#009FC6"/> </g> </svg> ',
      'people' => '<svg width="53" height="52" viewBox="0 0 53 52" fill="none" xmlns="http://www.w3.org/2000/svg"> <rect width="53" height="52" rx="10" fill="#CFEEF7"/> <mask id="mask0_4510_67940" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="13" y="12" width="27" height="28"> <rect x="13" y="12.5" width="27" height="27" fill="#D9D9D9"/> </mask> <g mask="url(#mask0_4510_67940)"> <path d="M14.125 35V31.85C14.125 31.2125 14.2891 30.6266 14.6172 30.0922C14.9453 29.5578 15.3813 29.15 15.925 28.8688C17.0875 28.2875 18.2687 27.8516 19.4688 27.5609C20.6688 27.2703 21.8875 27.125 23.125 27.125C24.3625 27.125 25.5813 27.2703 26.7812 27.5609C27.9812 27.8516 29.1625 28.2875 30.325 28.8688C30.8688 29.15 31.3047 29.5578 31.6328 30.0922C31.9609 30.6266 32.125 31.2125 32.125 31.85V35H14.125ZM34.375 35V31.625C34.375 30.8 34.1453 30.0078 33.6859 29.2484C33.2266 28.4891 32.575 27.8375 31.7313 27.2938C32.6875 27.4063 33.5875 27.5984 34.4313 27.8703C35.275 28.1422 36.0625 28.475 36.7937 28.8688C37.4688 29.2438 37.9844 29.6609 38.3406 30.1203C38.6969 30.5797 38.875 31.0813 38.875 31.625V35H34.375ZM23.125 26C21.8875 26 20.8281 25.5594 19.9469 24.6781C19.0656 23.7969 18.625 22.7375 18.625 21.5C18.625 20.2625 19.0656 19.2031 19.9469 18.3219C20.8281 17.4406 21.8875 17 23.125 17C24.3625 17 25.4219 17.4406 26.3031 18.3219C27.1844 19.2031 27.625 20.2625 27.625 21.5C27.625 22.7375 27.1844 23.7969 26.3031 24.6781C25.4219 25.5594 24.3625 26 23.125 26ZM34.375 21.5C34.375 22.7375 33.9344 23.7969 33.0531 24.6781C32.1719 25.5594 31.1125 26 29.875 26C29.6687 26 29.4062 25.9766 29.0875 25.9297C28.7688 25.8828 28.5063 25.8313 28.3 25.775C28.8063 25.175 29.1953 24.5094 29.4672 23.7781C29.7391 23.0469 29.875 22.2875 29.875 21.5C29.875 20.7125 29.7391 19.9531 29.4672 19.2219C29.1953 18.4906 28.8063 17.825 28.3 17.225C28.5625 17.1312 28.825 17.0703 29.0875 17.0422C29.35 17.0141 29.6125 17 29.875 17C31.1125 17 32.1719 17.4406 33.0531 18.3219C33.9344 19.2031 34.375 20.2625 34.375 21.5ZM16.375 32.75H29.875V31.85C29.875 31.6438 29.8234 31.4563 29.7203 31.2875C29.6172 31.1187 29.4812 30.9875 29.3125 30.8938C28.3 30.3875 27.2781 30.0078 26.2469 29.7547C25.2156 29.5016 24.175 29.375 23.125 29.375C22.075 29.375 21.0344 29.5016 20.0031 29.7547C18.9719 30.0078 17.95 30.3875 16.9375 30.8938C16.7687 30.9875 16.6328 31.1187 16.5297 31.2875C16.4266 31.4563 16.375 31.6438 16.375 31.85V32.75ZM23.125 23.75C23.7437 23.75 24.2734 23.5297 24.7141 23.0891C25.1547 22.6484 25.375 22.1188 25.375 21.5C25.375 20.8812 25.1547 20.3516 24.7141 19.9109C24.2734 19.4703 23.7437 19.25 23.125 19.25C22.5063 19.25 21.9766 19.4703 21.5359 19.9109C21.0953 20.3516 20.875 20.8812 20.875 21.5C20.875 22.1188 21.0953 22.6484 21.5359 23.0891C21.9766 23.5297 22.5063 23.75 23.125 23.75Z" fill="#009FC6"/> </g> </svg> ',
      'checkmark' => '<svg width="53" height="52" viewBox="0 0 53 52" fill="none" xmlns="http://www.w3.org/2000/svg"> <rect width="53" height="52" rx="10" fill="#CFEEF7"/> <mask id="mask0_4504_66974" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="11" y="11" width="31" height="30"> <rect x="11.6406" y="11.1387" width="29.7229" height="29.7229" fill="#D9D9D9"/> </mask> <g mask="url(#mask0_4504_66974)"> <path d="M23.4334 33.4304L36.561 20.3028L34.7962 18.5689L23.4024 29.9318L18.17 24.6683L16.4052 26.4331L23.4334 33.4304ZM23.4334 36.929L12.9375 26.4331L18.17 21.1697L23.4334 26.4331L34.7653 15.0703L40.0906 20.2718L23.4334 36.929Z" fill="#009FC6"/> </g> </svg> ' 
   );
   
?>

<div class="benefits <?php if ($fields['blue_background']) { ?>bg-light-blue<?php } ?>">
  <?php

  if (!empty($fields['headline']) || !empty($fields['text'])) {
    ?>
    <div class="benefits-top <?php if ($fields['wider_heading_&_text']) { ?>benefits-wider-text<?php } ?>">
      <?php

      if (!empty($fields['headline'])) {
        ?>
        <h2 class="benefits-top-headline"><?php echo $fields['headline']; ?></h2>
        <?php
      }

      if (!empty($fields['text'])) {
        ?>
        <p class="benefits-top-text"><?php echo $fields['text']; ?></p>
        <?php
      }

      ?>
    </div>
    <?php
  }

  if (!empty($fields['benefits'])) {
    ?>
    <div class="benefits-benefits">
      <?php

      foreach ($fields['benefits'] AS $benefit) {
        ?>
        <div class="benefits-benefits-item">
          <div class="benefits-benefits-item-left">
            <?php echo $bicons[$benefit['icon']]; ?>
          </div>
          <div class="benefits-benefits-item-right">
            <?php

            if (!empty($benefit['headline'])) {
              ?>
              <h3 class="benefits-benefits-item-headline"><?php echo $benefit['headline']; ?></h3>
              <?php
            }

            if (!empty($benefit['text'])) {
              ?>
              <p class="benefits-benefits-item-text"><?php echo $benefit['text']; ?></p>
              <?php
            }

            ?>
          </div>
          <p class="benefits-benefits-item-text-mobile"><?php echo $benefit['text']; ?></p>
        </div>
        <?php
      }

      ?>
    </div>
    <?php
  }

  if (!empty($fields['subtext'])) {
    ?>
    <hr>
    <div class="benefits-subtext">
      <p><?php echo $fields['subtext']; ?></p>
    </div>
    <?php
  }

  ?>
</div>

<?php 
} ?>
