<?php

// ajax/verify.php
//
// Verifies form input via API

include("../api.php");
include("../logincheck.php");

if(isset($_GET['verify_type']) && isset($_GET['verify_data'])) {
    $request_uri = "/verify?verify_type=" . $_GET['verify_type'] .
        "&verify_data=" . $_GET['verify_data'];

    $request_method = "GET";

    if ($logged_in) {
        $data = array("loggedin" => array("token_hash" => $_COOKIE["token_hash"],
                                          "user_id"    => $_COOKIE["user_id"]));
    } else {
        $data = NULL;
    }

    $response = api_request($request_uri, $request_method, $data);

    if ($response["response_code"] == SUCCESS) {
        echo 'true';
    } else {
        echo 'false';
    }

}

?>
