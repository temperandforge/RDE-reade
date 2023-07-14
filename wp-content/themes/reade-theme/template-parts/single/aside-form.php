<?php

$form = get_field('newsletter_subscribe_form', 'options');

?>
<div class="newsletter-container">
    <?php echo !empty($form) ? $form : ''; ?>
</div>