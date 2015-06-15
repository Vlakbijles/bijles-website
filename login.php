<?php

    // login.php
    // description

    $email = $password = "";

    function verify_input($input) {
        return htmlspecialchars(stripslashes(trim($input)));;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = verify_input($_POST["login_email"]);
        $password = verify_input($_POST["login_pwd"]);
    }

    // Perform login
    $request_uri = "/login?";
    $request_method = "POST";
    $data = array("user" => array("email" => $email, "password" => $password));
    $response = api_request($request_uri, $request_method, $data);

    echo $response;

    setcookie("user_id", $response["user_id"], time() + (86400 * 7), "/"); // 86400 = 1 day
    setcookie("token_hash", $response["token_hash"], time() + (86400 * 7), "/"); // 86400 = 1 day

?>
