<?php

// ajax/profile.php
//
// Handles API requests for editing a user profile, returns updated profile in
// JSON format on success

if (!isset($_POST["action"])) die();

include("../api.php");
include("../logincheck.php");

if ($logged_in) {

    switch($_POST["action"]) {

        case "edit":
            if (isset($_POST["email"])
                && isset($_POST["postal_code"])
                && isset($_POST["description"])) {

                $data = array("loggedin" => array("token_hash"  => $_COOKIE["token_hash"],
                                                  "user_id"     => $_COOKIE["user_id"]),
                              "user"     => array("email"       => $_POST["email"]),
                              "user_meta" => array("postal_code" => $_POST["postal_code"],
                                                  "description" => $_POST["description"]));

                $request_uri = "/user?";
                $request_method = "PUT";
                $response = api_request($request_uri, $request_method, $data);

                if ($response["response_code"] == SUCCESS) {
                    http_response_code(SUCCESS);
                    die(json_encode($response["response"]));
                }
            }

        default:
            http_response_code(INVALID);
            die(json_encode(array()));

    }

}

?>

