<?php

    // register.php
    // description

    require_once("../api.php");

    function clean_input($input) {
        return htmlspecialchars(stripslashes(trim($input)));
    }

    $request_uri = "/user?";
    $request_method = "POST";

    if (isset($_POST["email"]) && isset($_POST["postal_code"]) &&
        isset($_POST["access_token"]) && isset($_POST["description"])) {

        $email = $_POST["email"];
        $postal_code = $_POST["postal_code"];
        $fb_token = $_POST["access_token"];
        $description = $_POST["description"];

        $user = array("email" => $email);
        $usermeta = array("fb_token" => $fb_token,
                          "postal_code" => $postal_code,
                          "description" => $description);

        $data = array("user" => $user, "usermeta" => $usermeta);

        $response = api_request($request_uri, $request_method, $data);

        if ($response["response_code"] == CREATED) {
            http_response_code(CREATED);
            die(json_encode($response["response"]));
        } else if ($response["response_code"] == INVALID) {
            http_response_code(INVALID);
            die(json_encode($response["response"]));
        } else {
            die(json_encode($response["response"]));
        }
    }

    die();

?>
