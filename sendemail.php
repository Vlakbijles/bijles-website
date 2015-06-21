<?php
	// Template for sending an email, needs configuration with profile.php and javascript (?)
	// TODO: Email Configurations

	require_once("api.php");
	require_once("vars.php");

	// Request recipient's user profile data
	$request_uri = "/user/" . $_GET["id"] . "?";
	$request_method = "GET";
	$resp_profile = api_request($request_uri, $request_method, NULL);

	// Request sender's email data
	$request_uri = "/user/" . $user_id . "/email?"
	$request_method = "GET";
	$resp_email = api.request($request_uri, $request_method, NULL);

	if (!$logged_in) {
	    include("templates/modals/login.html");
	}
	
	// Check if contact_offer and contact_msg is set
	if (isset($_POST["contact_offer"]) && isset($_POST["contact_msg"]) {
		$contact_offer = $_POST["contact_offer"];
		$contact_msg = $_POST["contact_msg"];

		// Fill in the email variables
		$to = $resp_profile["response"]["email"];
		$subject = "Een gebruiker op VlakBijles heeft je een bericht gestuurd over " . $contact_offer; //automated response met offer verkregen vanuit html/js 
		$message = $contact_msg;
		$headers = array("From:  vlakbijles@gmail.com",
"Reply-To: " . $resp_email["response"]["email"],
			"X-Mailer: PHP/" . PHP_VERSION);

		mail($to, $subject, $message, $headers)
	}
?>
