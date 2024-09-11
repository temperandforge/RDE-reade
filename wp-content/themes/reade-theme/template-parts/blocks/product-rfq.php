<?php

$fields = get_fields();
$options = get_fields('options');

// global product
global $product;

if (is_null($product)) {
    return;
}

// this is the product id that gets submitted in the form, hopefully it gets updated later on, but we will start with this
$submittedProduct = $product->get_id();

// global product fields
// [multiple_attributes] => (bool) true/false
//
global $productfields;

// get product cross-sells
$crosssells = $product->get_cross_sell_ids();
$crosssellsproducts = array();
$cspattrs = array();

// add cross sells into array
if (!empty($crosssells)) {
    foreach ($crosssells AS $crosssell) {
        $crosssellsproducts[] = new WC_Product($crosssell);
    }
}

// foreach cross sell product, add its' attributes into an array
if (!empty($crosssellsproducts)) {
    foreach ($crosssellsproducts AS $csp) {
        $cspattrs[$csp->get_id()] = $csp->get_attributes();
    }
}


// product type variable, used for javascript in validation
$productType = '';
// product attribute name, used for javascript in validation
$productAttrName = '';


?>
<div class="product-rfq">
    <div class="product-rfq-top">
        <svg class="product-rfq-top-decor" width="94" height="139" viewBox="0 0 94 139" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12.8953 7.60782L67.6222 -24.5892L122.277 7.60782L67.5915 39.8049V110.804L12.8953 78.6175V7.60782ZM12.8953 7.60782L67.5915 39.8049L122.277 7.60782V78.6175L67.5915 110.804" stroke="#AEE3F0" stroke-width="2" stroke-linejoin="round"/>
<path d="M1.81692 83.4166L30.5034 66.5397L59.1523 83.4166L30.4873 100.294V137.51L1.81692 120.638V83.4166ZM1.81692 83.4166L30.4873 100.294L59.1523 83.4166V120.638L30.4873 137.51" stroke="#AEE3F0" stroke-width="2" stroke-linejoin="round"/>
</svg>


        <div id="product-rfq-error-message"></div>

       


        <?php

        if (!empty($fields['headline'])) {
            ?>
            <h2 class="product-rfq-headline"><?php echo str_replace(array('®'), array('<sup>®</sup>'), $fields['headline']); ?></h2>
            <?php
        }

        ?>
        <div class="product-rfq-options">
            <?php


            /**
             * Skip cross sell select if there is only one cross sell with one type
             */
            $skipCrossSellSelect = false;
            if (count($cspattrs) === 1) {
                foreach ($cspattrs AS $cspattr) {
                    if (count($cspattr) === 1) {
                        // set skip cross sell select to true
                        $skipCrossSellSelect = true;
                        // update submitted product
                        $submittedProduct = array_keys($cspattrs)[0];
                        // set product type
                        $productType = 'skip_crosssell';

                        ?>
                        <input id="submitted_product_1" type="hidden" value="<?php echo $submittedProduct; ?>">
                        <input id="product-<?php echo $submittedProduct; ?>-variant" type="hidden" value="">
                        <input id="skip_crosssell" type="hidden" value="1">
                        <?php
                    }
                }
            }


            if (!$skipCrossSellSelect) {

                // check if we have multiple initial cross sell selects
                if ($productfields['multiple_attributes']) {

                    // set product type
                    $productType = 'multiple_attributes_and';

                    ?>
                    <input id="multiple_attributes" type="hidden" value="1">
                    <?php
                    
                    if (!empty($crosssellsproducts)) {
                        $it = 1;
                        foreach ($crosssellsproducts AS $csp) {
                            //echo '<pre>'; print_r($csp); echo '</pre>';
                             $s1options = array(
                                'id' => 'select' . $it,
                                'select_text' => 'Specifications Available',
                                'svg' => '<svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.01928 0.921548C0.78888 1.13142 0.772237 1.48834 0.982109 1.71874L5.75031 6.95339C5.85724 7.07079 6.00869 7.1377 6.16749 7.1377C6.32629 7.1377 6.47774 7.07079 6.58467 6.95339L11.3529 1.71874C11.5627 1.48833 11.5461 1.13142 11.3157 0.921547C11.0853 0.711674 10.7284 0.728318 10.5185 0.958722L6.16749 5.73538L1.81648 0.958723C1.6066 0.728319 1.24969 0.711675 1.01928 0.921548Z" fill="#004455"/>
                                </svg>',
                                'width' => '100%'
                            );

                            if (!empty($crosssellsproducts)) {
                                foreach ($crosssellsproducts AS $csp) {
                                    $s1options['values'][$csp->get_id()] = $csp->get_name();
                                }
                            }

                            $submittedProduct = $csp->get_id();         

                            //tf_dropdown($s1options);
                            $it++;
                        }
                    }
                } else {

                    /**
                     * Initial select box shows cross sell items
                     */

                    // set product type
                    $productType = 'multiple_attributes_or';

                    $s1options = array(
                        'id' => 'select1',
                        'select_text' => 'Specifications Available',
                        'svg' => '<svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M1.01928 0.921548C0.78888 1.13142 0.772237 1.48834 0.982109 1.71874L5.75031 6.95339C5.85724 7.07079 6.00869 7.1377 6.16749 7.1377C6.32629 7.1377 6.47774 7.07079 6.58467 6.95339L11.3529 1.71874C11.5627 1.48833 11.5461 1.13142 11.3157 0.921547C11.0853 0.711674 10.7284 0.728318 10.5185 0.958722L6.16749 5.73538L1.81648 0.958723C1.6066 0.728319 1.24969 0.711675 1.01928 0.921548Z" fill="#004455"/>
        </svg>
        ',
                        'width' => '100%'
                    );

                    if (!empty($crosssellsproducts)) {
                        foreach ($crosssellsproducts AS $csp) {
                            $s1options['values'][$csp->get_id()] = $csp->get_name();
                        }
                    }

                    ?>
                     <!-- this value will be updated and submitted and changed via javascript -->
                    <input id="submitted_product_1" type="hidden" value="<?php echo $submittedProduct; ?>">
                    <input id="product-<?php echo $submittedProduct; ?>-variant" type="hidden" class="submitted_product_1_variant" value="">
                    <?php

                    tf_dropdown($s1options);
                }
            }


            /** After initial select box, we need to have a select box for the attributes.  We have to have a select box for all possible attributes, so it can be shown after it's selected in box one.  It will be hidden by default, and onselect of select one, the correct attribute box will be shown **/
            $it = 1;
            
            foreach ($cspattrs AS $pid => $pattrs) {

                if (!empty($pattrs)) {
                    $pattrName = array_values($pattrs)[0]->get_data()['name'];
                    $thisProduct = new WC_Product_Variable($pid);
                    $thisProductVariations = $thisProduct->get_available_variations();

                    $soptions = array(
                        'id' => 'product-rfq-select-' . $pid,
                        'select_text' => 'Select',
                        'svg' => '<svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.01928 0.921548C0.78888 1.13142 0.772237 1.48834 0.982109 1.71874L5.75031 6.95339C5.85724 7.07079 6.00869 7.1377 6.16749 7.1377C6.32629 7.1377 6.47774 7.07079 6.58467 6.95339L11.3529 1.71874C11.5627 1.48833 11.5461 1.13142 11.3157 0.921547C11.0853 0.711674 10.7284 0.728318 10.5185 0.958722L6.16749 5.73538L1.81648 0.958723C1.6066 0.728319 1.24969 0.711675 1.01928 0.921548Z" fill="#004455"/>
                        </svg>',
                        'width' => '100%',
                        'extra_classes' => array('product-rfq-select')
                    );

                    if (!$skipCrossSellSelect && !$productfields['multiple_attributes']) {
                        $soptions['extra_classes'][] = 'tf-dropdown-hidden';
                    }

                    if ($skipCrossSellSelect) {
                        $productAttrName = $pattrName;
                        ?>
                        <input type="hidden" id="product_1_attribute_name" value="<?php echo $productAttrName; ?>">
                        <?php
                    }

                    if (!is_null($productfields) && $productfields['multiple_attributes']) {
                        $submittedProduct = $pid;
                        ?>
                        <input id="submitted_product_<?php echo $it; ?>" type="hidden" value="<?php echo $submittedProduct; ?>">
                        <input id="product-<?php echo $submittedProduct; ?>-variant" type="hidden" value="">
                        <input type="hidden" id="product-<?php echo $pid; ?>-attribute-name" value="<?php echo $pattrName; ?>">
                        <?php
                    } else {
                        ?>
                        <input type="hidden" id="product-<?php echo $pid; ?>-attribute-name" value="<?php echo $pattrName; ?>">
                        <?php
                    }
                            
                    $soptions['select_text'] = 'Select ' . $pattrName;

                    foreach ($thisProductVariations AS $tpv) {
                        if (!empty($tpv['attributes'])) {
                            foreach ($tpv['attributes'] AS $id => $option) {
                                if (strtolower($option) == 'no options') {
                                    $soptions['values'][$tpv['variation_id']] = 'No Options';
                                } else {
                                    $soptions['values'][$tpv['variation_id']] = array_values($tpv['attributes'])[0];
                                }
                            }
                        }
                    }

                    tf_dropdown($soptions);

                    $it++;
                }
            }
 

            ?>
            <div class="product-rfq-qty">
                <?php

                /** show qty **/
                // $qtyoptions = array(
                //     'id' => 'product-qty',
                //     'select_text' => '1',
                //     '<svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                //     <path d="M1.01928 0.921548C0.78888 1.13142 0.772237 1.48834 0.982109 1.71874L5.75031 6.95339C5.85724 7.07079 6.00869 7.1377 6.16749 7.1377C6.32629 7.1377 6.47774 7.07079 6.58467 6.95339L11.3529 1.71874C11.5627 1.48833 11.5461 1.13142 11.3157 0.921547C11.0853 0.711674 10.7284 0.728318 10.5185 0.958722L6.16749 5.73538L1.81648 0.958723C1.6066 0.728319 1.24969 0.711675 1.01928 0.921548Z" fill="#004455"/>
                //     </svg>',
                // );

                // for ($i = 1; $i < 10; $i++) {
                //     $qtyoptions['values'][$i] = $i;
                // }

                // tf_dropdown($qtyoptions);

                ?>
                <input id="product-qty" type="number" name="qty_number" value="1" aria-label="Quantity">
                <input id="product-qty-units" type="hidden" name="qty_unit" value="Units">
                <?php


                /** show units **/
                $unitoptions = array(
                    'id' => 'product-units',
                    'select_text' => 'Units',
                    '<svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.01928 0.921548C0.78888 1.13142 0.772237 1.48834 0.982109 1.71874L5.75031 6.95339C5.85724 7.07079 6.00869 7.1377 6.16749 7.1377C6.32629 7.1377 6.47774 7.07079 6.58467 6.95339L11.3529 1.71874C11.5627 1.48833 11.5461 1.13142 11.3157 0.921547C11.0853 0.711674 10.7284 0.728318 10.5185 0.958722L6.16749 5.73538L1.81648 0.958723C1.6066 0.728319 1.24969 0.711675 1.01928 0.921548Z" fill="#004455"/>
                    </svg>',
                );

                //$unitoptions['values']['units'] = 'Units';
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
            </div>




        </div>
        <?php

        global $woocommerce;
        
        $buttontext = !empty($options['add_to_quote_button_text']) ? $options['add_to_quote_button_text'] : 'Add To Quote';
        if (!is_null($woocommerce->cart)) {
            $buttondisabled = count($woocommerce->cart->get_cart()) >= 5 ? ' disabled' : '';
        } else {
            $buttondisabled = '';
        }

        ?>
        <button id="product-submit-button" class="btn-blue-dark-blue btn-arrow"<?php echo $buttondisabled; ?>>
            <?php echo $buttontext; ?>
            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5063 6.83734C12.848 6.49563 13.402 6.49563 13.7437 6.83734L17.2437 10.3373C17.5854 10.679 17.5854 11.2331 17.2437 11.5748L13.7437 15.0748C13.402 15.4165 12.848 15.4165 12.5063 15.0748C12.1646 14.7331 12.1646 14.179 12.5063 13.8373L14.5126 11.8311H4.375C3.89175 11.8311 3.5 11.4393 3.5 10.9561C3.5 10.4728 3.89175 10.0811 4.375 10.0811H14.5126L12.5063 8.07477C12.1646 7.73306 12.1646 7.17904 12.5063 6.83734Z" fill="#FAFAFA"/>
            </svg>
            <svg class="spinner" viewBox="0 0 50 50">
                  <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
                </svg>
        </button>
        <a id="hidden-lity-opener" style="display: none;" href="#add-to-quote-success" data-lity>&nbsp;</a>
        <?php

        if (!is_null($woocommerce->cart) && count($woocommerce->cart->get_cart()) >= 5) {
            if (!empty($options['max_5_products_in_cart'])) {
                ?>
                <p class="product-rfq-max"><?php echo $options['max_5_products_in_cart']; ?></p>
                <?php
            }
        }

        ?>

    </div>
    <div class="product-rfq-bottom">
        <?php
        if (!empty($options['rfq_bottom_text'])) {
            ?>
            <span><?php echo $options['rfq_bottom_text']; ?></span>
            <?php
        }

        if (!empty($options['rfq_bottom_button'])) {
            ?>
            <a href="<?php echo !empty($options) && !empty($options['rfq_bottom_button']) && !empty($options['rfq_bottom_button']['url']) ? $options['rfq_bottom_button']['url'] : ''; ?>" class="btn-white-light-blue btn-arrow" <?php if (!empty($options) && !empty($options['rfq_bottom_button']) && !empty($options['rfq_bottom_button']['target']) && $options['rfq_bottom_button']['target'] == '_blank') { ?>target="_blank"<?php } ?>>
                <?php echo $options['rfq_bottom_button']['title']; ?>
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0063 6.14642C12.348 5.80471 12.902 5.80471 13.2437 6.14642L16.7437 9.64642C17.0854 9.98813 17.0854 10.5421 16.7437 10.8839L13.2437 14.3839C12.902 14.7256 12.348 14.7256 12.0063 14.3839C11.6646 14.0421 11.6646 13.4881 12.0063 13.1464L14.0126 11.1401H3.875C3.39175 11.1401 3 10.7484 3 10.2651C3 9.78189 3.39175 9.39014 3.875 9.39014H14.0126L12.0063 7.38386C11.6646 7.04215 11.6646 6.48813 12.0063 6.14642Z" fill="#009FC6"/>
                </svg>
            </a>
            <?php
        }

        ?>
    </div>
</div>

<!-- product type for javascript -->
<input id="product_type" type="hidden" value="<?php echo $productType; ?>">