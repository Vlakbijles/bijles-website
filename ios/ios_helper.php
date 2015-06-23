<?php
    require_once("../api.php");

    $request_uri= $_SERVER["REQUEST_URI"];
    echo "URI=" . $request_uri;
    $request_method = "GET"; //$_SERVER["REQUEST_METHOD"];
    echo "METHOD=" . $request_method;
    $data = $HTTP_RAW_POST_DATA;
    echo "DATA=" . $data;
    $data = json_decode($data, true);

    $response_array = api_request($request_uri, $request_method, $data);
    $response_json = json_encode($response_array);

    echo $response_json;
?>
