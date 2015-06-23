<?php
    require_once("../api.php");

    $recv = $HTTP_RAW_POST_DATA;
    $recv = json_decode($recv, true);

    $uri = $recv["uri"];
    $method = $recv["method"];
    $data = $recv["data"];
    if (empty($data)) {
        $data = NULL;
    }

    $resp = api_request($uri, $method, $data);
    http_response_code($resp["response_code"]);
    die(json_encode($resp["response"]));
?>
