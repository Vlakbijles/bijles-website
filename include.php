<?php

    require_once ("api.php");

    // Login check
    $request_uri = "/user?";
    $request_method = "GET";
    $logged_in = false;

    if(!isset($_COOKIE["user_id"]) && !isset($_COOKIE["token_hash"])) {
        echo "Cookies are not set!";
        $logged_in = false;
    } else {
        $data = array("loggedin" => array("token_hash" => $_COOKIE["token_hash"], "user_id" => $_COOKIE["user_id"]));
        $response = api_request($request_uri, $request_method, $data);
    }

?>
