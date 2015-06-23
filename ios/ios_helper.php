<?php
    require_once("../api.php");

    // $recv = $HTTP_RAW_POST_DATA;
    // $recv = json_decode($rcv, true);

    $uri = "/user/1?"; //$recv["uri"];
    $method = "GET"; //$recv["method"];
    $data = NULL; //$recv["data"];


    $resp = (api_request($uri, $method, $data));
    echo json_encode(resp);
?>
