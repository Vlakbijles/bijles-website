<?php

// ajax/verify.php
//
// Verifies form input values via API, for use with jQuery Validator plugin

include("../api.php");
include("../logincheck.php");

if(isset($_GET["verify_type"]) && isset($_GET["verify_data"])) {

    $data = NULL;
    $request_uri = "/verify?verify_type=" . $_GET["verify_type"] .
                   "&verify_data=" . $_GET["verify_data"];

    if ($logged_in) {
        $data = array("loggedin" => array("token_hash" => $_COOKIE["token_hash"],
                                          "user_id"    => $_COOKIE["user_id"]));
    }

    $response = api_request($request_uri, "GET", $data);

    if ($response["response_code"] == SUCCESS) {
        echo "true";
    } else {
        echo "false";
    }

}

?>
