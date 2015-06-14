<?php

    require_once ("model.php");

    $request_uri = "/user?";
    $request_method = "GET";


    if(!isset($_COOKIE["user_id"]) && !isset($_COOKIE["token_hash"])) {
        echo "Cookies are not set!";
    } else {
        $data = array("loggedin" => array("token_hash" => $_COOKIE["token_hash"],
                                          "user_id" => $_COOKIE["user_id"]));

        $response = api_request($request_uri, $request_method, $data);

        echo "<pre>";
        print_r($response);
        echo "</pre>";
    }

?>
