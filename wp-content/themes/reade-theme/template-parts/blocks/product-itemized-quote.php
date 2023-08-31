<?php

$fields = get_fields();
global $woocommerce;
$cart = $woocommerce->cart;
$cart_contents = $cart->get_cart_contents();
?>
<div class="product-itemized-quote">
    <svg class="piq-decor" width="133" height="224" viewBox="0 0 133 224" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M16.1113 44.916L90.7574 1L165.306 44.916L90.7155 88.832V185.673L16.1113 141.771V44.916ZM16.1113 44.916L90.7155 88.832L165.306 44.916V141.771L90.7155 185.673" stroke="#BAE3E9" stroke-width="2" stroke-linejoin="round"/>
<path d="M1 148.317L40.1277 125.297L79.2041 148.317L40.1057 171.336V222.098L1 199.086V148.317ZM1 148.317L40.1057 171.336L79.2041 148.317V199.086L40.1057 222.098" stroke="#BAE3E9" stroke-width="2" stroke-linejoin="round"/>
</svg>

    <?php

    if (!empty($fields['headline'])) {
        ?>
        <h1 class="title"><?php echo $fields['headline']; ?></h1>
        <?php
    }

    ?>

    <div class="piq-container">
        <div class="piq-container-left">
            <div class="rfq-empty" <?php if (empty($cart_contents)) { echo 'style="display: flex;"'; } ?>>
                    <?php

                    if (!empty($fields['empty_quote_headline']) || !empty($fields['empty_quote_subtext'])) {
                        ?>
                        <div>
                            <?php

                            if (!empty($fields['empty_quote_headline'])) {
                                ?>
                                <span class="rfq-empty-headline"><?php echo $fields['empty_quote_headline']; ?></span>
                                <?php
                            }

                            if (!empty($fields['empty_quote_subtext'])) {
                                ?>
                                <span class="rfq-empty-subtext"><?php echo $fields['empty_quote_subtext']; ?></span>
                                <?php
                            }

                            ?>
                        </div>
                        <?php
                    }

                    if (!empty($fields['empty_quote_button'])) {
                        ?>
                        <a href="<?php echo $fields['empty_quote_button']['url']; ?>" class="btn-blue-dark-blue btn-arrow">
                            <?php echo $fields['empty_quote_button']['title']; ?>
                            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5063 6.75823C12.848 6.41653 13.402 6.41653 13.7437 6.75823L17.2437 10.2582C17.5854 10.5999 17.5854 11.154 17.2437 11.4957L13.7437 14.9957C13.402 15.3374 12.848 15.3374 12.5063 14.9957C12.1646 14.654 12.1646 14.0999 12.5063 13.7582L14.5126 11.752H4.375C3.89175 11.752 3.5 11.3602 3.5 10.877C3.5 10.3937 3.89175 10.002 4.375 10.002H14.5126L12.5063 7.99567C12.1646 7.65396 12.1646 7.09994 12.5063 6.75823Z" fill="#FAFAFA"/>
                            </svg>
                        </a>
                        <?php
                    }

                    ?>
                </div>
            <?php

            if (empty($cart_contents)) {
                ?>
                
                <?php
            } else {
                $it = 1;
                foreach ($cart_contents AS $key => $contents) {
                    //echo '<pre>'; print_r($contents); echo '</pre>';
                    $item = new WC_Product($contents['product_id']);

                    //echo '<pre>'; print_r($item); echo '</pre>';
                    $parent = $item->get_cross_sell_ids();
                    $parent = $parent[0];
                    $parentItem = new WC_Product($parent);

                    $attributes = $contents['data']->get_data()['attributes'];

                    ?>
                    <div class="piq-cart-item" id="cart-item-<?php echo $key; ?>" data-cart-key="<?php echo $key; ?>">
                        <div class="piq-product-info">
                            <h2 class="piq-product-name"><?php echo $parentItem->get_name(); ?></h2>
                            <div class="rfq-cas-number">
                                <?php

                                $pfields = get_fields($parentItem->get_id());
                                echo $pfields['cas_number'];

                                ?>
                            </div> 
                        </div>
                        <div class="piq-product-details">
                            <div class="piq-product-details-attributes">
                                <?php

                                if ($attributes) {
                                    foreach ($attributes AS $attribute) {
                                        ?>
                                        <div class="piq-product-details-attributes-attribute"><?php echo $attribute; ?></div>
                                        <?php
                                    }

                                    if (!empty($contents['product_2'])) {
                                        if (!empty($contents['product_2_variant'])) {
                                            $product2Variant = new WC_Product_Variation($contents['product_2_variant']);
                                            $attributes = $product2Variant->get_data()['attributes'];
                                            foreach ($attributes AS $attribute) {
                                                ?>
                                                <div class="piq-product-details-attributes-attribute"><?php echo $attribute; ?></div>
                                                <?php
                                            }
                                        }
                                    }
                                }

                                ?>
                            </div>
                            <div class="piq-product-details-qty">
                                <input type="number" class="product-qty" data-cart-key="<?php echo $key; ?>" value="<?php echo $contents['quantity']; ?>">

                                <?php

                                /** show units **/
                                $unitoptions = array(
                                    'id' => 'product-units-' . $it,
                                    'select_text' => ucwords($contents['qty_unit']),
                                    'width' => '140px',
                                    '<svg width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M0.519284 0.965493C0.28888 1.17537 0.272237 1.53228 0.482109 1.76269L5.25031 6.99734C5.35724 7.11473 5.50869 7.18164 5.66749 7.18164C5.82629 7.18164 5.97774 7.11473 6.08467 6.99734L10.8529 1.76268C11.0627 1.53228 11.0461 1.17537 10.8157 0.965492C10.5853 0.755619 10.2284 0.772263 10.0185 1.00267L5.66749 5.77932L1.31648 1.00267C1.1066 0.772264 0.749688 0.75562 0.519284 0.965493Z" fill="#009FC6"/>
</svg>
',
                                );

                                $unitoptions['values']['pieces'] = 'Pieces';
                                $unitoptions['values']['grams'] = 'Grams';
                                $unitoptions['values']['troy ounces'] = 'Troy Ounces';
                                $unitoptions['values']['pounds'] = 'Pounds';
                                $unitoptions['values']['kilograms'] = 'Kilograms';
                                $unitoptions['values']['metric tons'] = 'Metric Tons';
                                $unitoptions['values']['net tons'] = 'Net Tons';
                                $unitoptions['values']['feet'] = 'Feet';
                                $unitoptions['values']['meters'] = 'Meters';
                                $unitoptions['values']['inches'] = 'Inches';
                                $unitoptions['values']['centimeters'] = 'Centimeters';
                                $unitoptions['values']['millimeters'] = 'Millimeters';


                                tf_dropdown($unitoptions);


                                ?>

                                <a class="removeFromQuote" data-cart-key="<?php echo $key; ?>" href="javascript: void(0);">
                                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="28" height="28" rx="14" fill="#EFFBFF"/>
                                    <path d="M17.1011 11.7698L14.9321 14L17.1011 16.2302C17.164 16.2926 17.2142 16.3674 17.2487 16.45C17.2832 16.5326 17.3014 16.6215 17.3022 16.7114C17.3029 16.8013 17.2863 16.8905 17.2532 16.9737C17.22 17.057 17.1711 17.1326 17.1093 17.1962C17.0474 17.2598 16.9739 17.31 16.8929 17.3441C16.812 17.3782 16.7253 17.3953 16.6378 17.3945C16.5503 17.3937 16.4639 17.375 16.3835 17.3395C16.3032 17.3041 16.2305 17.2525 16.1697 17.1878L14.0007 14.9576L11.8317 17.1878C11.7709 17.2525 11.6982 17.3041 11.6179 17.3395C11.5375 17.375 11.4511 17.3937 11.3636 17.3945C11.2762 17.3953 11.1894 17.3782 11.1085 17.3441C11.0275 17.31 10.954 17.2598 10.8921 17.1962C10.8303 17.1326 10.7814 17.057 10.7483 16.9737C10.7151 16.8905 10.6985 16.8013 10.6992 16.7114C10.7 16.6215 10.7182 16.5326 10.7527 16.45C10.7872 16.3674 10.8374 16.2926 10.9003 16.2302L13.0693 14L10.9003 11.7698C10.8374 11.7074 10.7872 11.6326 10.7527 11.55C10.7182 11.4674 10.7 11.3785 10.6992 11.2886C10.6985 11.1987 10.7151 11.1095 10.7483 11.0263C10.7814 10.943 10.8303 10.8674 10.8921 10.8038C10.954 10.7402 11.0275 10.69 11.1085 10.6559C11.1894 10.6218 11.2762 10.6047 11.3636 10.6055C11.4511 10.6063 11.5375 10.625 11.6179 10.6605C11.6982 10.6959 11.7709 10.7475 11.8317 10.8122L14.0007 13.0424L16.1697 10.8122C16.2305 10.7475 16.3032 10.6959 16.3835 10.6605C16.4639 10.625 16.5503 10.6063 16.6378 10.6055C16.7253 10.6047 16.812 10.6218 16.8929 10.6559C16.9739 10.69 17.0474 10.7402 17.1093 10.8038C17.1711 10.8674 17.22 10.943 17.2532 11.0263C17.2863 11.1095 17.3029 11.1987 17.3022 11.2886C17.3014 11.3785 17.2832 11.4674 17.2487 11.55C17.2142 11.6326 17.164 11.7074 17.1011 11.7698Z" fill="#009FC6"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <?php
                    $it++;
                }
            }

            if (!empty($cart_contents)) {
                ?>
                <h2 class="piq-additional-notes"><?php echo !empty($fields['notes_text']) ? $fields['notes_text'] : 'Additional Quote Notes'; ?></h2>
                <textarea class="rfq-notes" name="rfq-notes" placeholder="Add application details here..."></textarea>
                <?php
            }

            ?>

            <div class="piq-container-left-bottom">
                <?php
                if (!empty($fields['bottom_block_headline'])) {
                     ?>
                    <p class="piq-bottom-block-headline"><?php echo $fields['bottom_block_headline']; ?></p>
                    <?php
                }

                if (!empty($fields['bottom_block_text'])) {
                    ?>
                    <p class="piq-bottom-block-text"><?php echo $fields['bottom_block_text']; ?></p>
                    <?php
                }

                if (!empty($fields['bottom_block_button'])) {
                    ?>
                    <a class="btn-green-light-green btn-arrow" href="<?php echo $fields['bottom_block_button']['url']; ?>">
                        <?php echo $fields['bottom_block_button']['title']; ?>
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5063 6.75823C12.848 6.41653 13.402 6.41653 13.7437 6.75823L17.2437 10.2582C17.5854 10.5999 17.5854 11.154 17.2437 11.4957L13.7437 14.9957C13.402 15.3374 12.848 15.3374 12.5063 14.9957C12.1646 14.654 12.1646 14.0999 12.5063 13.7582L14.5126 11.752H4.375C3.89175 11.752 3.5 11.3602 3.5 10.877C3.5 10.3937 3.89175 10.002 4.375 10.002H14.5126L12.5063 7.99567C12.1646 7.65396 12.1646 7.09994 12.5063 6.75823Z" fill="#FAFAFA"/>
    </svg>

                    </a>
                    <?php
                }

                ?>     
            </div>
        </div>
        <div class="piq-container-right">
            <?php

            if (!empty($cart_contents)) {
                ?>
                <div class="piq-container-right-form">
                    <h2 class="piq-form-headline"><?php echo !empty($fields['form_headline']) ? $fields['form_headline'] : 'Customer Info'; ?></h2>
                    <div class="piq-form">
                        <div class="piq-form-container">
                            <input type="hidden" name="action" value="doSubmitRFQForm">
                            <input type="text" name="rfq-first-name" placeholder="First Name" value="">
                            <input type="text" name="rfq-last-name" placeholder="Last Name" value="">
                            <input type="text" name="rfq-company" placeholder="Company" value="">
                            <input type="phone" name="rfq-phone" placeholder="Phone Number" value="">
                            <input type="email" name="rfq-email" placeholder="Email" value="">
                            <input type="text" name="rfq-address-line-1" placeholder="Address" value="">
                            <input type="text" name="rfq-address-line-2" placeholder="Address Line 2" value="">
                            <input type="text" name="rfq-city" placeholder="City" value="">
                            <input type="text" name="rfq-state" placeholder="State" value="">
                            <input type="text" name="rfq-zip" placeholder="Zip" value="">
                        </div>
                    </div>
                </div>
                    <button class="btn-blue-dark-blue btn-arrow">
                        <?php echo !empty($fields['form_submit_button_text']) ? $fields['form_submit_button_text'] : 'Submit RFQ'; ?>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0063 5.88128C12.348 5.53957 12.902 5.53957 13.2437 5.88128L16.7437 9.38128C17.0854 9.72299 17.0854 10.277 16.7437 10.6187L13.2437 14.1187C12.902 14.4604 12.348 14.4604 12.0063 14.1187C11.6646 13.777 11.6646 13.223 12.0063 12.8813L14.0126 10.875H3.875C3.39175 10.875 3 10.4832 3 10C3 9.51675 3.39175 9.125 3.875 9.125H14.0126L12.0063 7.11872C11.6646 6.77701 11.6646 6.22299 12.0063 5.88128Z" fill="#FAFAFA"/>
    </svg></button>

                    <a href="/products/" class="btn-dark-blue-blue btn-arrow-reverse">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.99372 14.1187C7.65201 14.4604 7.09799 14.4604 6.75628 14.1187L3.25628 10.6187C2.91457 10.277 2.91457 9.72299 3.25628 9.38128L6.75628 5.88128C7.09799 5.53957 7.65201 5.53957 7.99372 5.88128C8.33543 6.22299 8.33543 6.77701 7.99372 7.11872L5.98744 9.125L16.125 9.125C16.6082 9.125 17 9.51675 17 10C17 10.4832 16.6082 10.875 16.125 10.875L5.98744 10.875L7.99372 12.8813C8.33543 13.223 8.33543 13.777 7.99372 14.1187Z" fill="#FAFAFA"/>
    </svg>
                        <?php echo !empty($fields['back_to_products_text']) ? $fields['back_to_products_text'] : 'Back To Products'; ?>
                    </a>
                <?php
            }

            ?>
        </div>
    </div>

</div>