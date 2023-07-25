<?php

require_once __DIR__ . '/../../../wp-load.php';
global $woocommerce;
$cart = $woocommerce->cart;
ini_set('display_errors', 'On');
error_reporting(E_ALL);

if (!empty($_POST['action']) && ($_POST['action'] == 'doAddToQuote')) {
	
	if (!empty($_POST['data'])) {
		$data = json_decode(stripslashes($_POST['data']));
		$qty = (int) $data->product_qty;
		$unit = $data->product_unit;

		/**
		 * Simple product, 1 attribute
		 * noted by skip_crosssell presence
		 */
		if ($data->skip_crosssell) {
			// simple product
			$product1Id = (int) $data->product_1;
			$product1VariantId = (int) $data->product_1_variant;
			$product = $product1Id;

		    if ($product1VariantId) {
				
			 	$product = $product1VariantId;

			 	if ($product = new WC_Product_Variation($product)) {
				 	$cart->add_to_cart($product1Id, $qty, $product1VariantId, array(), array('qty_unit' => $unit));
				 	die('success');
			 	} else {
			 		die('error1');
			 	}
			 } else {
				if ($product = new WC_Product($product)) {
				 	$cart->add_to_cart($product1Id, $qty, null, null, array('qty_unit' => $unit, 'unfinished' => 'Not Selected'));
				 	die('success');
				} else {
					die('error2');
				}
			}
		} else {
			/**
			 * Multiple attributes, OR
			 */
			if (!$data->multiple_attributes) {
				$product1Id = (int) $data->product_1;
				$product1VariantId = (int) $data->product_1_variant;
				$product = $product1Id;

				if ($product1VariantId) {
					$product = $product1VariantId;

					if ($product = new WC_Product_Variation($product)) {
						$cart->add_to_cart($product1Id, $qty, $product1VariantId, array(), array('qty_unit' => $unit));
						die('success');
					} else {
						die('error3');
					}
				} else {
					if ($product = new WC_Product($product1Id)) {
						if (!empty($product->get_cross_sell_ids())) {
							//original product, no type selected
							$cart->add_to_cart($product1Id, $qty, null, null, array('qty_unit' => $unit, 'unfinished' => 'Specification Not Selected'));
							die('success');
						} else {
							// type selected, but no variant selected
							$cart->add_to_cart($product1Id, $qty, null, null, array('qty_unit' => $unit, 'unfinished' => 'Not Selected'));
							die('success');
						}
					} else {
						die('error4');
					}
				}
			} else {

				/**
				 * Multiple attributes, AND
				 */

				$extras = array(
					'qty_unit' => $unit,
					'multiple_attributes' => 1
				);

				$product1Id = (int) $data->product_1;
				$product1VariantId = (int) $data->product_1_variant;
				$product1 = $product1Id;

				$product2Id = (int) $data->product_2;
				$product2VariantId = (int) $data->product_2_variant;
				$product2 = $product2Id;

				if ($product1VariantId) {
					if ($product1 = new WC_Product_Variation($product1VariantId)) {
						$extras['product_2'] = $data->product_2;
						$extras['product_2_variant'] = $data->product_2_variant;
						$cart->add_to_cart($product1Id, $qty, $product1VariantId, null, $extras);
						die('success');
					}
				} else {
					die('error5');
				}
			}
		}
	}
}

if (!empty($_POST['action']) && ($_POST['action'] == 'doRemoveFromQuote')) {
	if (!empty($_POST['key'])) {
		$post_key = json_decode(stripslashes($_POST['key']));

		foreach ($cart->get_cart_contents() AS $key => $item) {
			if ($post_key == $key) {
				$cart->remove_cart_item($key);
				die('success');
			}
		}

	} else {
		die('error6');
	}
}

if (!empty($_POST['action']) && ($_POST['action'] == 'doChangeUnits')) {
	if (!empty($_POST['newUnit']) && !empty($_POST['cartKey'])) {
		$post_key = $_POST['cartKey'];

		foreach ($cart->get_cart_contents() AS $key => $item) {
			if ($post_key == $key) {
				$item['qty_unit'] = $_POST['newUnit'];
				$cart->cart_contents[ $key ] = $item;
				$cart->set_session();
				die('success');
			}
		}
	}
}


if (!empty($_POST['action']) && ($_POST['action'] == 'doChangeQty')) {
	if (!empty($_POST['cartKey']) && !empty($_POST['qty'])) {
		$post_key = $_POST['cartKey'];
		$qty = $_POST['qty']; // type cast to (int) ?  thinking about if someone orders 1.5 lbs, for example
		foreach ($cart->get_cart_contents() AS $key => $item) {
			if ($post_key == $key) {
				$cart->set_quantity($key, $qty);
				die('success');
			}
		}
	}
}