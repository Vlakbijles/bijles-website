<?php

require_once("api.php");
$GLOBALS["logged_in"] = false;

if(isset($_COOKIE["user_id"]) && isset($_COOKIE["token_hash"])) {
    $data = array("loggedin" => array("token_hash" => $_COOKIE["token_hash"],
        "user_id" => $_COOKIE["user_id"]));
    $request_uri = "/user?";
    $request_method = "GET";
    $response = api_request($request_uri, $request_method, $data);
    if ($response["response_code"] == 200) {
        $GLOBALS["logged_in"] = true;
        print_r($response);
        echo "henkies";
    } else {
        print_r($response);
        echo "vriend";
    }
}

?>
