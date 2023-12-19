<?php

require_once __DIR__ . '/../../../wp-load.php';

if (!empty($_POST['action']) && ($_POST['action'] == 'doSubmitRecaptcha')) {
	$recaptcha_response = $_POST['response'];
    define("RECAPTCHA_V3_SECRET_KEY", '6LfEWw8pAAAAAPojruCyAX8eD1e_OW9qqhd1-4kW');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => RECAPTCHA_V3_SECRET_KEY, 'response' => $recaptcha_response)));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $response = curl_exec($ch);
    curl_close($ch);
    $arrResponse = json_decode($response, true);
    // verify the response
    if($arrResponse["success"] == '1' && $arrResponse["score"] >= 0.5) {
        die('valid');
    } else {
        die('invalid');
    }

	die('invalid');
}