<?php

// ajax/review.php
//
// Handles API requests for submission of offer reviews, returns posted review
// in JSON format on success

if (!isset($_POST["action"])) die();

include("../api.php");
include("../logincheck.php");

if ($logged_in) {

    switch($_POST["action"]) {

        case "create":
            if (isset($_POST["offer_id"])
                && isset($_POST["description"])
                && isset($_POST["endorsed"])) {

                // Convert POST string to boolean
                $endorsed = true;
                if ($_POST["endorsed"] == "false") $endorsed = false;

                $data = array("loggedin" => array("token_hash"  => $_COOKIE["token_hash"],
                                                  "user_id"     => $_COOKIE["user_id"]),
                              "review" => array("offer_id" => $_POST["offer_id"],
                                                "description" => $_POST["description"],
                                                "endorsed" => $endorsed));

                $request_uri = "/review?";
                $request_method = "POST";
                $response = api_request($request_uri, $request_method, $data);

                if ($response["response_code"] == CREATED) {
                    http_response_code(CREATED);
                    die(json_encode($response["response"]));
                } elseif ($response["response_code"] == SUCCESS) {
                    http_response_code(SUCCESS);
                    die(json_encode(array()));
                } else {
                    http_response_code(INVALID);
                    die(json_encode(array()));
                }

            }

        default:
            http_response_code(INVALID);
            die(json_encode(array()));

    }

}

?>
