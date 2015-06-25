<?php

// ajax/fb_auth.php
//
// Used in login/register modal to forward Facebook authentication to API
// server

require_once("../api.php");

if(isset($_POST["access_token"])) {

    $request_uri = "/fblogin?";
    $data = array("facebook" => array("access_token" => $_POST["access_token"]));
    $response = api_request($request_uri, "POST", $data);

    if ($response["response_code"] == SUCCESS) {

        setcookie("user_id", $response["response"]["user_id"], time() + (86400 * 7), "/"); // 86400 = 1 day
        setcookie("token_hash", $response["response"]["token_hash"], time() + (86400 * 7), "/"); // 86400 = 1 day
        http_response_code(SUCCESS);
        echo json_encode(new ArrayObject());

    } elseif ($response["response_code"] == ACCEPTED) {

        http_response_code(ACCEPTED);
        echo json_encode($response["response"]);

    }

}

?>
