<?php

if (!isset($_GET["action"])) die();

include("../api.php");

switch($_GET["action"]) {

    case "all":
        $request_uri = "/level/all?";
        $request_method = "GET";
        $response = api_request($request_uri, $request_method, NULL);

        if ($response["response_code"] == SUCCESS) {
            echo json_encode($response["response"]);
        }

}

?>

