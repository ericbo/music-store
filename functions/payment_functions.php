<?php
/*
* This function was taken from the following tutorial: https://www.youtube.com/watch?v=qyiv3ndRcZI&feature=youtu.be
*/
function makeBuyButton ($price, $txt = "Agree and Continue") {
	//Variables to be used in this function.
	$user = "";
	$vendor = "";
	$partner = "";
	$pwd = "";
	$mode = "text";
	$host = "https://pilot-payflowpro.paypal.com"; //TEST
	//$host = "https://payflowpro.paypal.com"; //Live

	//Create a post string.
	$secureTokenId = uniqid('', true);
	$postData = "USER=" . $user .
				"&VENDOR=" . $vendor .
				"&PARTNER=" . $partner .
				"&PWD=" . $pwd .
				"&CREATESECURETOKEN=Y" .
				"&SECURETOKENID=" . $secureTokenId .
				"&TRXTYPE=S" .
				"&AMT=" . $price .
				"&CURRENCY=CAN";

	//Initialize curl request.
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $host);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

	//Post to paypal and store the response.
	$response = curl_exec($ch);

	//Check for http errors.
	if(!$response) {
		return "<p>Payment system is down.</p>";
	}

	//Parse response string to an array.
	parse_str($response, $arr);

	//Check for parse errors.
	if ($arr['RESULT'] != 0) {
		return "<p>Payment system is down.</p>";
	}

	return "<form method='post' action='https://payflowlink.paypal.com/'>
				<input type='hidden' name='SECURETOKEN' value='" . $arr['SECURETOKEN'] . "'>
				<input type='hidden' name='SECURETOKENID' value='" . $secureTokenId . "'>
				<input type='hidden' name='MODE' value='" . $mode . "'>
				<inpit type='submit' value='" . $txt . "'>
			</form>";
}