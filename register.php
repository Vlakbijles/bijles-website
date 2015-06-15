<?php

    // register.php
    // description

    require_once("api.php");

    $email =  "";
    $password = "";
    $facebook_token = "";

    function clean_input($input) {
        return htmlspecialchars(stripslashes(trim($input)));
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["register_email"])) {
            $email = clean_input($_POST["register_email"]);
        }
        if (isset($_POST["register_pwd"])) {
            $password = clean_input($_POST["register_pwd"]);
        }
        if (isset($_POST["register_facebook_token"])) {
            $facebook_token = clean_input($_POST["register_facebook_token"]);
        }
    }

    // Perform login
    $request_uri = "/register?";
    $request_method = "POST";
    $data = array("user" => array("email" => $email, "password" => $password, "facebook_token" => $facebook_token));
    $response = api_request($request_uri, $request_method, $data);

    if ($response["response_code"] == 200) {
        // succesful registration, proceed to login
    } else {
        // Check for faulty data (duplicate email, invalid fb token)
        print_r($response["response"]);
    }

    header("Location: " . $_SERVER["HTTP_REFERER"]);

?>
