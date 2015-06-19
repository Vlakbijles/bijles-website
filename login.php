<?php

    // login.php
    // description

    require_once("api.php");

    $email = "";
    $password = "";

    function clean_input($input) {
        return htmlspecialchars(stripslashes(trim($input)));
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["login_email"])) {
            $email = clean_input($_POST["login_email"]);
        }
        if (isset($_POST["login_pwd"])) {
            $password = clean_input($_POST["login_pwd"]);
        }
    }

    // Perform login
    $request_uri = "/fblogin?";
    $request_method = "POST";
    $data = array("user" => array("email" => $email, "password" => $password));
    $response = api_request($request_uri, $request_method, $data);

    if ($response["response_code"] == 200) {
        setcookie("user_id", $response["response"]["user_id"], time() + (86400 * 7), "/"); // 86400 = 1 day
        setcookie("token_hash", $response["response"]["token_hash"], time() + (86400 * 7), "/"); // 86400 = 1 day
    } else {
        print_r($response["response"]);
    }

    header("Location: " . $_SERVER["HTTP_REFERER"]);

?>
