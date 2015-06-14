<?php
    require_once ("model.php");

    $request_uri = "/login?";
    $request_method = "POST";

    $data = array("user" => array("email" => "ed@plus.nl",
                                  "password" => "edmin"));

    $response = api_request($request_uri, $request_method, $data);

    setcookie("user_id", $response["user_id"], time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie("token_hash", $response["token_hash"], time() + (86400 * 30), "/"); // 86400 = 1 day

?>
