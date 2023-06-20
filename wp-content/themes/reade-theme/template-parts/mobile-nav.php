<nav id="menu">
    <div class="mobile-search">
      <form role="search" method="get" action="<?php echo get_site_url() ?>">
        <label for="mobile_search" class="sr-only">Search</label>
        <input type="search" placeholder="Search" autocomplete="off" autocorrect="off" autocapitalize="off" id="mobile_search" spellcheck="false" name="s" />
      </form>
    </div>
    <div class="menu-inner">
      <section class="menu-section">
        <h4>Menu</h4>
        <?php
          // header menu
          wp_nav_menu( array(
            'menu' => get_term(get_nav_menu_locations()['primary-navigation'], 'nav_menu')->name,
            'container' => false, // remove nav container
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'menu_class' => 'menu-section-list', // adding custom nav class
            'depth' => 2, // limit the depth of the nav
            'theme_location' => 'Primary Navigation'
          ) );
        ?>
      </section>
      <section class="menu-section">
        <h4>Get in touch</h4>
        <p>Submit the form on the <a class="mobile-contact-link" href="/contact/">contact page</a>, or reach out using one of
          the methods below.</p>
        <?php $option_fields = get_fields('options') ?>
        <ul class="mm-contact">
          <?php if ($email_address = $option_fields['email_address']) { ?>
          <li class="mm-email">
            <a href="mailto:<?php echo $email_address ?>">
              <?php echo $email_address ?>
            </a>
          </li>
          <?php } ?>
          <?php if ($phone = $option_fields['phone']) { ?>
          <li class="mm-phone">
            <?php echo format_phone($phone) ?>
          </li>
          <?php } ?>
          <?php if ($address_line_one = $option_fields['address_line_one']) { ?>
          <li class="mm-address">
            <?php
              $address_line_two = $option_fields['address_line_two']
            ?>
            <a href="https://www.google.com/maps?saddr=My+Location&daddr=<?php echo $address_line_one . $address_line_two ?>" target="_blank" rel="noopener noreferrer">
              <?php echo "<p>$address_line_one<br>$address_line_two</p>" ?>
            </a>
          </li>
          <?php } ?>
        </ul>
      </section>
    </div>
  </nav>