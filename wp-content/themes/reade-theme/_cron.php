<?php

/**
 * This is a cron file that's ran every hour.  It's purpose is to detect rfq submits and custom product submits.
 * 
 * When custom product or rfq is submitted, we update a timestamp in the database.  This cron file will check if it's been 
 * X hours since that last submission to give an indication that the submissions are broken
 * 
 * Custom product submission timestamp is stored in option "custom_product_submit"
 * RFQ submission timestamp is stored in option "rfq_submit"
 */

// first, load in the wp instance
require_once __DIR__ . '/../../../wp-load.php';

// set the number of hours threshold for each type of submission
$custom_threshold = 1;
$rfq_threshold = 1;

// get the timestamp for the last submission of each
$custom_timestamp	= get_option('custom_product_submit');
$rfq_timestamp		= get_option('rfq_submit');

// check custom timestamp and mail if it's been creater than $custom_threshold hours
if (!empty($custom_timestamp)) {

	if ($custom_timestamp < (time() - ($custom_threshold * 60 * 60))) {
		
		$headers = 'From: wordpress-debug@reade.com' . "\r\n" .
    	'Reply-To: wordpress-debug@reade.com' . "\r\n" .
    	'X-Mailer: PHP/' . phpversion();

		mail('nathan@temperandforge.com', 'Reade - No Custom Product Submission In ' . $custom_threshold . ' Hours', 'You may wish to check that the custom product form on reade is still working - https://reade.com/custom-product-rfq-form/', $headers);

	}
}

// check rfq timestamp and mail if it's been creater than $custom_threshold hours
if (!empty($rfq_timestamp)) {
	if ($rfq_timestamp < (time() - ($rfq_threshold * 60 * 60))) {
		
		$headers = 'From: wordpress-debug@reade.com' . "\r\n" .
    	'Reply-To: wordpress-debug@reade.com' . "\r\n" .
    	'X-Mailer: PHP/' . phpversion();

		mail('nathan@temperandforge.com', 'Reade - No RFQ Submission In ' . $rfq_threshold . ' Hours', 'You may wish to check that the RFQ form on reade is still working - https://reade.com/itemized-rfq/', $headers);
	}
}

$headers = 'From: wordpress-debug@reade.com' . "\r\n" .
    	'Reply-To: wordpress-debug@reade.com' . "\r\n" .
    	'X-Mailer: PHP/' . phpversion();

mail('scott@temperandforge.com', 'cron has ran from reade', 'all good', $headers);