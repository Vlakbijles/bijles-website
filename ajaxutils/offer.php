<?php

if (!isset($_POST["action"])) die();

include("../api.php");

// Login check
$logged_in = false;
$user_id = NULL;
if(isset($_COOKIE["user_id"]) && isset($_COOKIE["token_hash"])) {
    $data = array("loggedin" => array("token_hash" => $_COOKIE["token_hash"],
                                      "user_id" => $_COOKIE["user_id"]));
    $request_uri = "/user?";
    $request_method = "GET";
    $response = api_request($request_uri, $request_method, $data);
    if ($response["response_code"] == 200) {
        $logged_in = true;
        $user_id = $_COOKIE["user_id"];
    } elseif ($response["response_code"] == 0) {
        die("Unable to connect to API server");
    }
}


if ($logged_in) {

    switch($_POST["action"]) {

        case "create":
            if (isset($_POST["subject_id"]) && isset($_POST["level_id"])) {
                $data = array("loggedin" => array("token_hash" => $_COOKIE["token_hash"],
                                                  "user_id" => $_COOKIE["user_id"]),
                              "offer" => array("subject_id" => $_POST["subject_id"],
                                               "level_id" => $_POST["level_id"]));
                $request_uri = "/offer?";
                $request_method = "POST";
                $response = api_request($request_uri, $request_method, $data);

                if ($response["response_code"] == CREATED) {
                    die("ok");
                }
            }

        case "delete":
            if (isset($_POST["offer_id"])) {
                $request_uri = "/offer/" . $_POST["offer_id"] . "?";
                $request_method = "DELETE";
                $response = api_request($request_uri, $request_method, $data);

                if ($response["response_code"] == SUCCESS) {
                    die("ok");
                }
            }

        default:
            die("error");

    }

}

die("error");

?>
