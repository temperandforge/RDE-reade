<?php

$fields = get_fields();

// global product
global $product;

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


?>
<div class="product-rfq">
    <div class="product-rfq-top">
        <svg class="product-rfq-top-decor" width="94" height="139" viewBox="0 0 94 139" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12.8953 7.60782L67.6222 -24.5892L122.277 7.60782L67.5915 39.8049V110.804L12.8953 78.6175V7.60782ZM12.8953 7.60782L67.5915 39.8049L122.277 7.60782V78.6175L67.5915 110.804" stroke="#AEE3F0" stroke-width="2" stroke-linejoin="round"/>
<path d="M1.81692 83.4166L30.5034 66.5397L59.1523 83.4166L30.4873 100.294V137.51L1.81692 120.638V83.4166ZM1.81692 83.4166L30.4873 100.294L59.1523 83.4166V120.638L30.4873 137.51" stroke="#AEE3F0" stroke-width="2" stroke-linejoin="round"/>
</svg>


        <?php

        if (!empty($fields['headline'])) {
            ?>
            <h2 class="product-rfq-headline"><?php echo $fields['headline']; ?></h2>
            <?php
        }

        if (!empty($fields['text'])) {
            ?>
            <p class="product-rfq-text"><?php echo $fields['text']; ?></p>
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
                        $skipCrossSellSelect = true;
                    }
                }
            }


            if (!$skipCrossSellSelect) {

                // check if we have multiple initial cross sell selects
                if ($productfields['multiple_attributes']) {
                    
                    if (!empty($crosssellsproducts)) {
                        $it = 1;
                        foreach ($crosssellsproducts AS $csp) {
                             $s1options = array(
                                'id' => 'select' . $it,
                                'select_text' => 'Select Type',
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

                            //tf_dropdown($s1options);
                            $it++;
                        }
                    }
                } else {

                    /**
                     * Initial select box shows cross sell items
                     */

                    $s1options = array(
                        'id' => 'select1',
                        'select_text' => 'Select Type',
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

                    tf_dropdown($s1options);
                }
            }


            /** After initial select box, we need to have a select box for the attributes.  We have to have a select box for all possible attributes, so it can be shown after it's selected in box one.  It will be hidden by default, and onselect of select one, the correct attribute box will be shown **/
            foreach ($cspattrs AS $pid => $pattrs) {

                $attrCount = count($pattrs);

                foreach ($pattrs AS $pattr) {
                    $pattrdata = $pattr->get_data();
                    $soptions = array(
                        'id' => 'product-rfq-select-' . $pid,
                        'select_text' => 'Select',
                        'svg' => '<svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1.01928 0.921548C0.78888 1.13142 0.772237 1.48834 0.982109 1.71874L5.75031 6.95339C5.85724 7.07079 6.00869 7.1377 6.16749 7.1377C6.32629 7.1377 6.47774 7.07079 6.58467 6.95339L11.3529 1.71874C11.5627 1.48833 11.5461 1.13142 11.3157 0.921547C11.0853 0.711674 10.7284 0.728318 10.5185 0.958722L6.16749 5.73538L1.81648 0.958723C1.6066 0.728319 1.24969 0.711675 1.01928 0.921548Z" fill="#004455"/>
</svg>
',
                        'width' => '100%',
                        'extra_classes' => array('product-rfq-select')
                    );

                    if (!$skipCrossSellSelect && !$productfields['multiple_attributes']) {
                        $soptions['extra_classes'][] = 'tf-dropdown-hidden';
                    }
                    
                    $soptions['select_text'] = 'Select ' . $pattrdata['name'];

                    if (!empty($pattrdata['options'])) {
                        $options = $pattrdata['options'];
                    
                        foreach ($options AS $id => $option) {
                            $soptions['values'][$id] = $option;
                        }

                        tf_dropdown($soptions);
                    }
                }
            }

            ?>
            <div class="product-rfq-qty">
                <?php

                /** show qty **/
                $qtyoptions = array(
                    'id' => 'product-qty',
                    'select_text' => '1',
                    '<svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.01928 0.921548C0.78888 1.13142 0.772237 1.48834 0.982109 1.71874L5.75031 6.95339C5.85724 7.07079 6.00869 7.1377 6.16749 7.1377C6.32629 7.1377 6.47774 7.07079 6.58467 6.95339L11.3529 1.71874C11.5627 1.48833 11.5461 1.13142 11.3157 0.921547C11.0853 0.711674 10.7284 0.728318 10.5185 0.958722L6.16749 5.73538L1.81648 0.958723C1.6066 0.728319 1.24969 0.711675 1.01928 0.921548Z" fill="#004455"/>
                    </svg>',
                );

                for ($i = 1; $i < 10; $i++) {
                    $qtyoptions['values'][$i] = $i;
                }

                tf_dropdown($qtyoptions);


                /** show units **/
                $unitoptions = array(
                    'id' => 'product-units',
                    'select_text' => 'Units',
                    '<svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.01928 0.921548C0.78888 1.13142 0.772237 1.48834 0.982109 1.71874L5.75031 6.95339C5.85724 7.07079 6.00869 7.1377 6.16749 7.1377C6.32629 7.1377 6.47774 7.07079 6.58467 6.95339L11.3529 1.71874C11.5627 1.48833 11.5461 1.13142 11.3157 0.921547C11.0853 0.711674 10.7284 0.728318 10.5185 0.958722L6.16749 5.73538L1.81648 0.958723C1.6066 0.728319 1.24969 0.711675 1.01928 0.921548Z" fill="#004455"/>
                    </svg>',
                );

                $unitoptions['values']['cm'] = 'CM';
                $unitoptions['values']['in'] = 'IN';
                $unitoptions['values']['Other'] = 'Other';

                tf_dropdown($unitoptions);

                ?>
            </div>


        </div>
        <?php

        $buttontext = !empty($fields['button_text']) ? $fields['button_text'] : 'Add To Quote';

        ?>
        <a href="#add-to-quote-success" class="btn-blue-dark-blue btn-arrow" data-lity>
            <?php echo $buttontext; ?>
            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5063 6.83734C12.848 6.49563 13.402 6.49563 13.7437 6.83734L17.2437 10.3373C17.5854 10.679 17.5854 11.2331 17.2437 11.5748L13.7437 15.0748C13.402 15.4165 12.848 15.4165 12.5063 15.0748C12.1646 14.7331 12.1646 14.179 12.5063 13.8373L14.5126 11.8311H4.375C3.89175 11.8311 3.5 11.4393 3.5 10.9561C3.5 10.4728 3.89175 10.0811 4.375 10.0811H14.5126L12.5063 8.07477C12.1646 7.73306 12.1646 7.17904 12.5063 6.83734Z" fill="#FAFAFA"/>
            </svg>
        </a>

    </div>
    <div class="product-rfq-bottom">
        <?php
        if (!empty($fields['bottom_text'])) {
            ?>
            <span><?php echo $fields['bottom_text']; ?></span>
            <?php
        }

        if (!empty($fields['bottom_button'])) {
            ?>
            <a href="<?php echo $fields['button_button']['url']; ?>" class="btn-white-light-blue btn-arrow" <?php if ($fields['botton_button']['target'] == '_blank') { ?>target="_blank"<?php } ?>>
                <?php echo $fields['bottom_button']['title']; ?>
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0063 6.14642C12.348 5.80471 12.902 5.80471 13.2437 6.14642L16.7437 9.64642C17.0854 9.98813 17.0854 10.5421 16.7437 10.8839L13.2437 14.3839C12.902 14.7256 12.348 14.7256 12.0063 14.3839C11.6646 14.0421 11.6646 13.4881 12.0063 13.1464L14.0126 11.1401H3.875C3.39175 11.1401 3 10.7484 3 10.2651C3 9.78189 3.39175 9.39014 3.875 9.39014H14.0126L12.0063 7.38386C11.6646 7.04215 11.6646 6.48813 12.0063 6.14642Z" fill="#009FC6"/>
                </svg>
            </a>
            <?php
        }

        ?>
    </div>
</div>