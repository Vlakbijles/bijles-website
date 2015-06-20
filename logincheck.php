<?php

// logincheck.php
//
// Login check via API, checks and sets cookies, sets globally used variables

require_once("api.php");

$logged_in = false;
$user_id = NULL;
$user_postal_code = NULL;

if(isset($_COOKIE["user_id"]) && isset($_COOKIE["token_hash"])) {
    $data = array("loggedin" => array("token_hash" => $_COOKIE["token_hash"],
                                      "user_id" => $_COOKIE["user_id"]));
    $request_uri = "/user?";
    $request_method = "GET";
    $response = api_request($request_uri, $request_method, $data);
    if ($response["response_code"] == 200) {
        $logged_in = true;
        $user_id = $_COOKIE["user_id"];
        $user_postal_code = $response["response"]["meta.zipcode"];
    } elseif ($response["response_code"] == 0) {
        die("Unable to connect to API server");
    }
}

?>
