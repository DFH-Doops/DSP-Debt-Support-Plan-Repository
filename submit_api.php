<?php
if ($_POST['form_name'] == 'questionaire-form' && isset($_POST['input_6'])
	&& isset($_POST['input_8'])
	&& isset($_POST['input_9'])){

        isset($_POST['input_7']) ? $l_name = $_POST['input_7'] : $l_name = '';
    
	$package = array(
			'Lead_ref'		=> urlencode('DSP Q')
			,'LeadSourceID' => urlencode('164') //required 
			,'IsLive' 	    => urlencode('1') //required
			,'Name' 		=> urlencode($_POST['input_6'].' '.$l_name) //required
			,'Mob' 			=> urlencode($_POST['input_8']) //required				
			,'Email' 		=> urlencode($_POST['input_9'])//Optional	
			,'DebtValue' 	=> urlencode($_POST['input_1']) //Optional	
			,'Creditors' 	=> urlencode($_POST['input_2']) //Optional	
			,'Employment'  => urlencode($_POST['input_4']) //Optional	
			,'ResidentialStatus' => urlencode($_POST['input_5']) //Optional 			
			,'DI' 				 => urlencode(str_replace('Â£', '', $_POST['input_3'])) //Optional	
			,'Form_Submit'  => urlencode('DSP - Form 09/05/18') //Optional 
			,'a_url'        => urlencode($_POST['get-data'])
			,'link'			=> urlencode('http://www.debtsupportplan.co.uk')
			,'opt_in'			=> urlencode(($_POST['input_10'] == 'on')?1:0)
		);

	$api_url = 'http://dfhapi.co.uk/api/SubmitApplication/DSC/index.php';

	$request_string = http_build_query($package, '', '&');

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$api_url.'?'.$request_string);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$response_string = curl_exec($ch);
	
	// Client Email -- Added by Sathish
	$client_email = $_POST['input_9'];
	$name = $_POST['input_6'];
	$client_email_subject = 'Your Recent Enquiry';
	$company_email = 'info@debtsupportplan.co.uk';
	/*	Client Email Body Content */
	$client_headers  = 'MIME-Version: 1.0' . "\r\n";
	$client_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$client_headers .= 'From: DSP <'.$company_email.'>' . "\r\n";
	$message = 'Hello '.$name.',<br/>
		    <br/>
	            Thank you for your recent enquiry with Debt Support Plan. We will contact you shortly to see how we can best assist you.<br/>
		    <br/>
		    By contacting Debt Support Plan, you have taken the first steps towards getting your finances back on track.<br/>
		    <br/>
		    <br/>
		    <strong>What happens next?</strong><br/>
		    <br/>
		    You will receive a call from our Manchester office, an 0161 number, where one of our specialist advisors will talk you through the best solutions available for your personal circumstances.<br/>
		    <br/>
		    Should you miss our call &ndash; don\'t worry! One of our specialist advisors will try and contact you again. Alternatively, you can call us on <a href="tel:01613597803" target="_blank" style="color: #fc8c00; text-decoration: none;">0161 359 7803</a> to start the process.<br/>
		    <br/>
		    We look forward to hearing from you soon.<br/>
		    <br/>
		    Kind regards<br/>
		    <br/>
		    Debt Support Plan<br/>
		    <a href="tel:01613597803" target="_blank" style="color: #666666; text-decoration: none;">0161 359 7803</a>';
	
	 ob_start();
         include dirname(__FILE__)."/email-template/index.php";
         $content = ob_get_clean();

	$client_message = $content;
				
} elseif ($_POST['form_name'] == 'callback-form' && isset($_POST['input_5']) && isset($_POST['input_7']) && isset($_POST['input_1']) && isset($_POST['input_2']) && isset($_POST['input_8'])) {

	$appointmentDay = date('Y-m-d', strtotime("next ". $_POST['input_1'])) . '/' . $_POST['input_2'];
	isset($_POST['input_6']) ? $l_name = $_POST['input_6'] : $l_name = '';
    
	$package = array(
			'Lead_ref'		=> urlencode('DSP A')
			,'LeadSourceID' => urlencode('228') //required 
			,'IsLive' 	    => urlencode('1') //required
			,'Name' 		=> urlencode($_POST['input_5'].' '.$l_name) //required
			,'Mob' 			=> urlencode($_POST['input_7']) //required
			,'Email' 		=> urlencode($_POST['input_8'])//Optional	
			,'DebtValue' 	=> urlencode($_POST['input_3']) //Optional	
			,'Employment'  => urlencode($_POST['input_4']) //Optional	 			
			,'Form_Submit'  => urlencode('DSP - Appointment Form 09/05/18') //Optional
			,'BestTime_Call'  => urlencode($appointmentDay) //Optional 
			,'a_url'        => urlencode($_POST['get-data'])
			,'link'			=> urlencode('http://www.debtsupportplan.co.uk/book-an-appointment/')
			,'opt_in'		=> urlencode(($_POST['input_9'] == 'on')?1:0)
		);

	$api_url = 'http://dfhapi.co.uk/api/SubmitApplication/DSC/index.php';

	$request_string = http_build_query($package, '', '&');
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$api_url.'?'.$request_string);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$response_string = curl_exec($ch);

	// Client Email -- Added by Sathish
	$client_email = $_POST['input_8'];
	$name = $_POST['input_5'];
	$client_email_subject = 'Appointment Confirmation';
	$company_email = 'info@debtsupportplan.co.uk';
	/*	Client Email Body Content */
	$client_headers  = 'MIME-Version: 1.0' . "\r\n";
	$client_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$client_headers .= 'From: DSP <'.$company_email.'>' . "\r\n";
	$message = 'Hello '.$name.',<br/>
		    <br/>
	            Thank you for booking an appointment with one of our Debt Support Plan advisors. We will contact you on '. date('Y-m-d', strtotime("next ". $_POST['input_1'])) .' between ' . $_POST['input_2'] . ' to run through the best options available to you.<br/>
		    <br/>
		    By contacting Debt Support Plan, you have taken the first steps towards getting your finances back on track.<br/>
		    <br/>
		    <br/>
		    <strong>What happens next?</strong><br/>
		    <br/>
		    You will receive a call from our Manchester office, an 0161 number, where one of our specialist advisors will talk you through the best solutions available for your personal circumstances.<br/>
		    <br/>
		    Should you miss our call &ndash; don\'t worry! One of our specialist advisors will try and contact you again. Alternatively, you can call us on <a href="tel:01613597803" target="_blank" style="color: #fc8c00; text-decoration: none;">0161 359 7803</a> to start the process.<br/>
		    <br/>
		    Kind regards<br/>
		    <br/>
		    Debt Support Plan<br/>
		    <a href="tel:01613597803" target="_blank" style="color: #666666; text-decoration: none;">0161 359 7803</a>';
	
	 ob_start();
         include dirname(__FILE__)."/email-template/index.php";
         $content = ob_get_clean();

	$client_message = $content;

}

mail($client_email, $client_email_subject, $client_message, $client_headers);

header("Location: /thanks"); 
?>