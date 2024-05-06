<?php

    require_once __DIR__ . '/../../../wp-load.php';

    $email_to = get_field('submissions_email', 'options');

    if (!empty($_POST['action']) && ($_POST['action'] == 'doCustomRFQSubmit')) {

        // check nonce
        if (empty($_POST['custom_rfq_nonce']) || !wp_verify_nonce($_POST['custom_rfq_nonce'], 'custom_rfq')) {
            header('Location: ' . site_url() . '/custom-product-rfq-form/?error=invalid-nonce-please-try-again');
            exit;
        }

        if (empty($_POST['g-recaptcha-response'])) {
            header('Location: ' . site_url() . '/custom-product-rfq-form/?error=invalid-captcha');
            exit;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => '6LfEWw8pAAAAAPojruCyAX8eD1e_OW9qqhd1-4kW', 'response' => $_POST['g-recaptcha-response'])));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // local only
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);
        curl_close($ch);
        $arrResponse = json_decode($response, true);

        // verify the response
        if($arrResponse["success"] == '1' && $arrResponse["score"] >= 0.3) {

            // check for honeypot fields, if the fields have data then a bot has filled them in
            if (!empty($_POST['lead_info']) || (trim($_POST['lead_info']) != '')) {
                header('Location: ' . site_url() . '/custom-product-rfq-form/?error=honeypot-1');
                exit;
            }

            if (!empty($_POST['lead_info_impt']) || (trim($_POST['lead_info_impt']) != '')) {
                header('Location: ' . site_url() . '/custom-product-rfq-form/?error=honeypot-2');
                exit;
            }

            // set up post data
            $postData = array(
                'lead_source' => 'Website',
                '00N6g00000TUVFe' => !empty($_POST['00N6g00000TUVFe']) ? $_POST['00N6g00000TUVFe'] : '',
                '00N6g00000Tj7ls' => !empty($_POST['00N6g00000Tj7ls']) ? $_POST['00N6g00000Tj7ls'] : '',
                '00N6g00000TBLtL' => !empty($_POST['00N6g00000TBLtL']) ? $_POST['00N6g00000TBLtL'] : '',
                '00N6g00000TUVFy' => !empty($_POST['00N6g00000TUVFy']) ? $_POST['00N6g00000TUVFy'] : '',
                '00N6g00000TUVG3' => !empty($_POST['00N6g00000TUVG3']) ? $_POST['00N6g00000TUVG3'] : '',
                '00N6g00000TUVG8' => !empty($_POST['00N6g00000TUVG8']) ? $_POST['00N6g00000TUVG8'] : '',
                'first_name' => !empty($_POST['first_name']) ? $_POST['first_name'] : '',
                'last_name' => !empty($_POST['last_name']) ? $_POST['last_name'] : '',
                'company' => !empty($_POST['company']) ? $_POST['company'] : '',
                'street' => !empty($_POST['street']) ? $_POST['street'] : '',
                'city' => !empty($_POST['city']) ? $_POST['city'] : '',
                'zip' => !empty($_POST['zip']) ? $_POST['zip'] : '',
                'phone' => !empty($_POST['phone']) ? $_POST['phone'] : '',
                'email' => !empty($_POST['email']) ? $_POST['email'] : '',
                '00N3J000001mdyh' => !empty($_POST['00N3J000001mdyh']) ? $_POST['00N3J000001mdyh'] : '',
                '00N6g00000U3avS' => !empty($_POST['00N6g00000U3avS']) ? $_POST['00N6g00000U3avS'] : '',
                'oid' => !empty($_POST['oid']) ? $_POST['oid'] : '',
                'retURL' => !empty($_POST['retURL']) ? $_POST['retURL'] : '',
                'state' => !empty($_POST['state']) ? $_POST['state'] : '',
                'country' => !empty($_POST['country']) ? $_POST['country'] : '',
                '00N6g00000VMFwG' => !empty($_POST['00N6g00000VMFwG']) ? $_POST['00N6g00000VMFwG'] : '',
                '00N6g00000VMFwF' => !empty($_POST['00N6g00000VMFwF']) ? $_POST['00N6g00000VMFwF'] : '',
                '00N6g00000TtToG' => !empty($_POST['00N6g00000TtToG']) ? $_POST['00N6g00000TtToG'] : '',
                '00N6g00000TtToJ' => !empty($_POST['00N6g00000TtToJ']) ? $_POST['00N6g00000TtToJ'] : '',
                '00N6g00000TUVGD' => !empty($_POST['00N6g00000TUVGD']) ? $_POST['00N6g00000TUVGD'] : '',
                '00NUP000000pL5d' => !empty($_POST['utm_id']) ? $_POST['utm_id'] : 'N/A'
            );

            // // send the post data with curl
            // // Initialize cURL session
            $ch = curl_init('https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8&orgId=00D6g000003RNAt');

            $headers = array(
                "X-Custom-Header: website-",
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
            );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_HEADER, true);

            // Set cURL options
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            // local only
            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            // Execute cURL session and get the response
            $response = curl_exec($ch);

            // send email before we check for CURL errors
            // this allows the form to be emailed even if salesforce is down
            if (!empty($email_to)) {
                $email_to = array_map('trim', explode(',', $email_to));
                $email_subject = 'Reade Custom Product Request Form Submission';
                $email_headers = array(
                    'MIME-Version' => '1.0',
                    'Content-type' => 'text/plain; charset=UTF-8',
                    'From' => 'reade-form-submissions@reade.com',
                    'Reply-To' => 'reade-form-submissions@reade.com',
                );
    
                $email_text = "Custom Product Request\n";
                $email_text .= "Submitted: " . date('n/d/y g:i A') . "\n";
                $email_text .= "Material or Chemical Formula: " . (!empty($_POST['00N6g00000TUVFe']) ? $_POST['00N6g00000TUVFe'] : 'N/A') . "\n";
                $email_text .= (!empty($_POST['00N6g00000VMFwF']) ? $_POST['00N6g00000VMFwF'] : 'N/A') . "\n\n";
                $email_text .= "First Name: " . (!empty($_POST['first_name']) ? $_POST['first_name'] : 'N/A') . "\n";
                $email_text .= "Last Name: " . (!empty($_POST['last_name']) ? $_POST['last_name'] : 'N/A') . "\n";
                $email_text .= "Company: " . (!empty($_POST['company']) ? $_POST['company'] : 'N/A') . "\n";
                $email_text .= "Street: " . (!empty($_POST['street']) ? $_POST['street'] : 'N/A') . "\n";
                $email_text .= "City: " . (!empty($_POST['city']) ? $_POST['city'] : 'N/A') . "\n";
                $email_text .= "State: " . (!empty($_POST['state']) ? $_POST['state'] : 'N/A') . "\n";
                $email_text .= "ZIP: " . (!empty($_POST['zip']) ? $_POST['zip'] : 'N/A') . "\n";
                $email_text .= "Country: " . (!empty($_POST['country']) ? $_POST['country'] : 'N/A') . "\n";
                $email_text .= "Phone: " . (!empty($_POST['phone']) ? $_POST['phone'] : 'N/A') . "\n";
                $email_text .= "Email: " . (!empty($_POST['email']) ? $_POST['email'] : 'N/A') . "\n";
                $email_text .= "Notes: " . (!empty($_POST['00N3J000001mdyh']) ? $_POST['00N3J000001mdyh'] : 'N/A') . "\n";
    
                foreach ($email_to AS $email_single) {
                    wp_mail($email_single, $email_subject, $email_text, $email_headers);
                }
            }

            // Check for cURL errors
            if (curl_errno($ch)) {
                die('there was an error, please try again later.');
                exit;
            }

            // Close cURL session
            curl_close($ch);

            // update database with last submission
            update_option('custom_product_submit', time());

            // redirect
            header('Location: ' . $_POST['retURL']);
            exit;

        } else {
            header('Location: ' . site_url() . '/custom-product-rfq-form/?error=invalid-captcha-response');
            exit;
        }

        // if we reached this point, we assume invalid
        header('Location: ' . site_url() . '/custom-product-rfq-form/?error=general-invalid-captcha');
        exit;
    }

    if (!empty($_POST['action']) && ($_POST['action'] == 'doProcessRFQ')) {

        // check nonce
        if (empty($_POST['rfq_nonce']) || !wp_verify_nonce($_POST['rfq_nonce'], 'rfq')) {
            header('Location: ' . site_url() . '/itemized-rfq/?error=invalid-nonce-please-try-again');
            exit;
        }


        if (empty($_POST['g-recaptcha-response'])) {
            header('Location: ' . site_url() . '/itemized-rfq/?error=invalid-captcha');
            exit;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => '6LfEWw8pAAAAAPojruCyAX8eD1e_OW9qqhd1-4kW', 'response' => $_POST['g-recaptcha-response'])));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // local only
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);
        curl_close($ch);
        $arrResponse = json_decode($response, true);

        // verify the response
        if($arrResponse["success"] == '1' && $arrResponse["score"] >= 0.3) {

            // check for honeypot fields
            if (!empty($_POST['leadinfo']) || trim($_POST['leadinfo']) != ''){
                header('Location: ' . site_url() . '/itemized-rfq/?error=honeypot-1');
                exit;
            }

            if (!empty($_POST['rfq-lead-info']) || trim($_POST['rfq-lead-info']) != ''){
                header('Location: ' . site_url() . '/itemized-rfq/?error=honeypot-2');
                exit;
            }

            // set up post data
            $postData = array(
                'oid'               => !empty($_POST['oid']) ? $_POST['oid'] : '',
                'retURL'            => !empty($_POST['retURL']) ? $_POST['retURL'] : '',
                'first_name'        => !empty($_POST['first_name']) ? $_POST['first_name'] : '',
                'last_name'         => !empty($_POST['last_name']) ? $_POST['last_name'] : '',
                'company'           => !empty($_POST['company']) ? $_POST['company'] : '',
                'phone'             => !empty($_POST['phone']) ? $_POST['phone'] : '',
                'email'             => !empty($_POST['email']) ? $_POST['email'] : '',
                'street'            => !empty($_POST['street']) ? $_POST['street'] : '',
                'city'              => !empty($_POST['city']) ? $_POST['city'] : '',
                'state'             => !empty($_POST['state']) ? $_POST['state'] : '',
                'zip'               => !empty($_POST['zip']) ? $_POST['zip'] : '',
                'country'           => !empty($_POST['country']) ? $_POST['country'] : '',
                'lead_source'       => !empty($_POST['lead_source']) ? $_POST['lead_source'] : '',
                '00N6g00000VMFwG'   => !empty($_POST['00N6g00000VMFwG']) ? $_POST['00N6g00000VMFwG'] : '',
                '00N6g00000VMFwF'   => !empty($_POST['00N6g00000VMFwF']) ? $_POST['00N6g00000VMFwF'] : '',
                '00N6g00000VMFwI'   => !empty($_POST['00N6g00000VMFwI']) ? $_POST['00N6g00000VMFwI'] : '',
                '00N6g00000VMFwH'   => !empty($_POST['00N6g00000VMFwH']) ? $_POST['00N6g00000VMFwH'] : '',
                '00N6g00000VMFwK'   => !empty($_POST['00N6g00000VMFwK']) ? $_POST['00N6g00000VMFwK'] : '',
                '00N6g00000VMFwJ'   => !empty($_POST['00N6g00000VMFwJ']) ? $_POST['00N6g00000VMFwJ'] : '',
                '00N6g00000VMFwM'   => !empty($_POST['00N6g00000VMFwM']) ? $_POST['00N6g00000VMFwM'] : '',
                '00N6g00000VMFwL'   => !empty($_POST['00N6g00000VMFwL']) ? $_POST['00N6g00000VMFwL'] : '',
                '00N6g00000VMFwO'   => !empty($_POST['00N6g00000VMFwO']) ? $_POST['00N6g00000VMFwO'] : '',
                '00N6g00000VMFwN'   => !empty($_POST['00N6g00000VMFwN']) ? $_POST['00N6g00000VMFwN'] : '',
                '00N6g00000TtToE'   => !empty($_POST['00N6g00000TtToE']) ? $_POST['00N6g00000TtToE'] : '',
                '00N6g00000TtToG'   => !empty($_POST['00N6g00000TtToG']) ? $_POST['00N6g00000TtToG'] : '',
                '00N6g00000U3avS'   => !empty($_POST['00N6g00000U3avS']) ? $_POST['00N6g00000U3avS'] : '',
                '00N6g00000TtToJ'   => !empty($_POST['00N6g00000TtToJ']) ? $_POST['00N6g00000TtToJ'] : '',
                '00N6g00000TUVGD'   => !empty($_POST['00N6g00000TUVGD']) ? $_POST['00N6g00000TUVGD'] : '',
                '00NUP000000pL5d' => !empty($_POST['utm_id']) ? $_POST['utm_id'] : 'N/A'
            );


            // send the post data with curl
            // Initialize cURL session
            $ch = curl_init('https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8&orgId=00D6g000003RNAt');

            $headers = array(
                "X-Custom-Header: website-",
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
            );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_HEADER, true);

            // Set cURL options
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            // local only
            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            // Execute cURL session and get the response
            $response = curl_exec($ch);

            // send email before we check for CURL errors
            // this allows the form to be emailed even if salesforce is down
            if (!empty($email_to)) {
                $email_to = array_map('trim', explode(',', $email_to));
                $email_subject = 'Reade RFQ Submission';
                $email_headers = array(
                    'MIME-Version' => '1.0',
                    'Content-type' => 'text/plain; charset=UTF-8',
                    'From' => 'reade-form-submissions@reade.com',
                    'Reply-To' => 'reade-form-submissions@reade.com',
                );
        
                $email_text = "RFQ Submission\n";
                $email_text .= "Submitted: " . date('n/d/y g:i A') . "\n";
                $email_text .= "First Name: " . (!empty($_POST['first_name']) ? $_POST['first_name'] : 'N/A') . "\n";
                $email_text .= "Last Name: " . (!empty($_POST['last_name']) ? $_POST['last_name'] : 'N/A') . "\n";
                $email_text .= "Company: " . (!empty($_POST['company']) ? $_POST['company'] : 'N/A') . "\n";
                $email_text .= "Phone: " . (!empty($_POST['phone']) ? $_POST['phone'] : 'N/A') . "\n";
                $email_text .= "Email: " . (!empty($_POST['email']) ? $_POST['email'] : 'N/A') . "\n";
                $email_text .= "Street: " . (!empty($_POST['street']) ? $_POST['street'] : 'N/A') . "\n";
                $email_text .= "City: " . (!empty($_POST['city']) ? $_POST['city'] : 'N/A') . "\n";
                $email_text .= "State: " . (!empty($_POST['state']) ? $_POST['state'] : 'N/A') . "\n";
                $email_text .= "ZIP: " . (!empty($_POST['zip']) ? $_POST['zip'] : 'N/A') . "\n";
                $email_text .= "Country: " . (!empty($_POST['country']) ? $_POST['country'] : 'N/A') . "\n";
                $email_text .= "Lead Source: " . (!empty($_POST['lead_source']) ? $_POST['lead_source'] : 'N/A') . "\n";
                $email_text .= "How did you find us?: " . (!empty($_POST['00N6g00000TtToG']) ? $_POST['00N6g00000TtToG'] : 'N/A') . "\n";
                $email_text .= "How did you find us? (Other): " . (!empty($_POST['00N6g00000U3avS']) ? $_POST['00N6g00000U3avS'] : 'N/A') . "\n\n";
                $email_text .= "Product 1: " . (!empty($_POST['00N6g00000VMFwG']) ? $_POST['00N6g00000VMFwG'] : 'N/A') . "\n";
                $email_text .= "Product 1 Details: \n\n" . (!empty($_POST['00N6g00000VMFwF']) ? $_POST['00N6g00000VMFwF'] : 'N/A') . "\n\n\n";
                $email_text .= "Product 2: " . (!empty($_POST['00N6g00000VMFwI']) ? $_POST['00N6g00000VMFwI'] : 'N/A') . "\n";
                $email_text .= "Product 2 Details: \n\n" . (!empty($_POST['00N6g00000VMFwH']) ? $_POST['00N6g00000VMFwH'] : 'N/A') . "\n\n\n";
                $email_text .= "Product 3: " . (!empty($_POST['00N6g00000VMFwK']) ? $_POST['00N6g00000VMFwK'] : 'N/A') . "\n";
                $email_text .= "Product 3 Details: \n\n" . (!empty($_POST['00N6g00000VMFwJ']) ? $_POST['00N6g00000VMFwJ'] : 'N/A') . "\n\n\n";
                $email_text .= "Product 4: " . (!empty($_POST['00N6g00000VMFwM']) ? $_POST['00N6g00000VMFwM'] : 'N/A') . "\n";
                $email_text .= "Product 4 Details: \n\n" . (!empty($_POST['00N6g00000VMFwL']) ? $_POST['00N6g00000VMFwL'] : 'N/A') . "\n\n\n";
                $email_text .= "Product 5: " . (!empty($_POST['00N6g00000VMFwO']) ? $_POST['00N6g00000VMFwO'] : 'N/A') . "\n";
                $email_text .= "Product 5 Details: \n\n" . (!empty($_POST['00N6g00000VMFwN']) ? $_POST['00N6g00000VMFwN'] : 'N/A') . "\n\n\n";
        
                foreach ($email_to AS $email_single) {
                    wp_mail($email_single, $email_subject, $email_text, $email_headers);
                }
            }

            // Check for cURL errors
            if (curl_errno($ch)) {
                die('there was an error, please try again later.');
                exit;
            }

            // Close cURL session
            curl_close($ch);

            // update database with last submission
            update_option('rfq_submit', time());

            // redirect
            header('Location: ' . $_POST['retURL']);
            exit;

        } else {
            header('Location: ' . site_url() . '/itemized-rfq/?error=invalid-captcha-response');
            exit;
        }

        // if we reached this point, we assume invalid
        header('Location: ' . site_url() . '/itemized-rfq/?error=general-invalid-captcha');
        exit;
    }