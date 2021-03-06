<?php

// ajax/contactuser.php
//
// Send contact request to API

if (!isset($_POST["offer_id"]) || !isset($_POST["message"])) die();

include("../api.php");
include("../logincheck.php");

if ($logged_in) {

    $data = array("loggedin" => array("token_hash"  => $_COOKIE["token_hash"],
                                      "user_id"  => $_COOKIE["user_id"]),
                  "contact" => array("message" => $_POST["message"]));
    $request_uri = "/contact/" . $_POST["offer_id"] . "?";
    $response = api_request($request_uri, "POST", $data);

    if ($response["response_code"] == SUCCESS) {
        http_response_code(SUCCESS);
        die(json_encode(array()));
    } else {
        echo "asd";
        http_response_code(INVALID);
        die(json_encode(array()));
    }

}

http_response_code(INVALID);
die(json_encode(array()));

?>
