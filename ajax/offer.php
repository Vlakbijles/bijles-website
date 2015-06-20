<?php

// ajax/offer.php
//
// Handles API requests for offer creation and deletion, uses POST data.
// Creation returns created offer in JSON format, deletion responds with string
// "ok" on success

if (!isset($_POST["action"])) die();

include("../api.php");
include("logincheck.php");

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
                    echo json_encode($response["response"]);
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

        default: ;

    }

}

?>
