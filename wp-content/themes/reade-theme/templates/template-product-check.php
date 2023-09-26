<?php

/**
* Template Name: Product Automated Check
*/

get_header();

echo '<h3 style="font-weight: 800;">"Main Product" checks</h3>';

$mainProductArgs = array(
	'post_type' => 'product',
	'post_status' => 'publish',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => 'is_main_product',
            'value' => true,
            'compare' => '=',
        )
    )
);

$mainProducts = new WP_Query($mainProductArgs);

if (!empty($mainProducts->posts)) {
	foreach ($mainProducts->posts AS $prod) {
		$product = new WC_Product($prod->ID);

		if ($product->get_price() != '0.00') {
			echo '<p>Price for ' . $product->get_name() . ' is not 0.00</p>';
		}

		if (trim($product->get_short_description()) == '') {
			echo '<p>Product ' . $product->get_name() . ' has no short description</p>';
		}

		if (strtolower($product->get_type()) != 'simple') {
			echo '<p>Product ' . $product->get_name() . ' is not a simple product</p>';
		}

		if (!preg_match('/^[a-zA-Z0-9-]*$/', get_post_field('post_name', $prod->ID))) {
			echo '<p>Product ' . $product->get_name() . ' probably has superscript or subscript in the url slug</p>';
		}

		if (!$product->get_cross_sell_ids() || count($product->get_cross_sell_ids()) == 0) {
			echo '<p>Product ' . $product->get_name() . ' has no cross sells</p>';
		}

		$blocks = parse_blocks($prod->post_content);

		if (!empty($blocks)) {
			$blockNames = array();
			foreach ($blocks AS $k => $v){
				$blockNames[] = $v['blockName'];

				if ($v['blockName'] == 'acf/product-hero') {
					if (empty($v['attrs']['data']['product_description']) || (trim($v['attrs']['data']['product_description']) == '')) {
						echo '<p>Product ' . $product->get_name() . ' Product Hero block is missing a product description.</p>';
					}
				}

				if ($v['blockName'] == 'acf/product-rfq') {
					if (stripos($v['attrs']['data']['headline'], $product->get_name()) === false) {
						echo '<p>Product ' . $product->get_name() . ': product name not found in Product RFQ block Headline field</p>';
					}
				}
			}
			$blockNames = array_filter($blockNames);

			foreach (array('acf/product-hero', 'acf/product-custom-fields', 'acf/product-rfq', 'acf/product-related-products') AS $expectedBlock) {
				if (!in_array($expectedBlock, $blockNames)) {
					echo '<p>Product ' . $product->get_name() . ' is missing expected acf block "' . $expectedBlock . '"</p>';
				}
			}
		} else {
			echo '<p>Product ' . $product->get_name() . ' has no acf blocks (should have product hero, product custom fields, product rfq, and related procucts blocks)</p>';
		}

		$pc = wp_get_post_terms($prod->ID, 'product_cat');

		if (!$pc || count($pc) == 0) {
			echo '<p>Product ' . $product->get_name() . ' has no categories assigned</p>';
		}

		foreach ($pc AS $c) {
			if (strtolower($c->name) == 'uncategorized') {
				echo '<p>Product: ' . $product->get_name() . ' has category "uncategorized" assigned</p>';
			}
		}

		$yoast_description = get_post_meta($prod->ID, '_yoast_wpseo_metadesc', true);
		if (trim($yoast_description) == '') {
			echo '<p>Product: ' . $product->get_name() . ' has no yoast page description</p>';
		}

		$product_tags = wc_get_product_term_ids($product_id, 'product_tag');

		if (empty($product_tags) || count($product_tags) == 0) {
			echo '<p>Product: ' . $product->get_name() . ' doesn\'t have any vendor tags</p>';
		}
	}
}

echo '<br><br><br><h3 style="font-weight: 800;">"Sub-Products Check"</h3><br><br><br>
<p style="font-color: red; font-weight: 600;">Please note, there is no way to check that product variations have prices set to 0.00.  Please go through the woocommerce backend and make sure every variation has a price set.</p>';

$subProductArgs = array(
	'post_type' => 'product',
	'post_status' => 'publish',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => 'is_main_product',
            'value' => true,
            'compare' => '!=',
        )
    )
);

$subProducts = new WP_Query($subProductArgs);

if (!empty($subProducts->posts)) {
	foreach ($subProducts->posts AS $prod) {
		$product = wc_get_product($prod->ID);
		
		if (empty($product->get_cross_sell_ids()) || !$product->get_cross_sell_ids()) {
			echo '<p>Product ' . $product->get_name() . ' does not have a cross sell linking to parent product</p>';
		}

		if (strtolower($product->get_type()) != 'variable') {
			echo '<p>Product ' . $product->get_name() . ' is not a variable product</p>';
		}

		if (strtolower($product->get_type()) == 'variable') {
			$variations = $product->get_available_variations();

			if (empty($variations)) {
				echo '<p>Product ' . $product->get_name() . ' does not have any variations</p>';
			} else {
				
			}
		}
	}
}

echo '<br><br><br><h3 style="font-weight: 800;">Product URLs</h3><br><br><br>';

foreach ($mainProducts->posts AS $product) {	
	echo get_permalink($product->ID) . '<br />';
}

get_footer();