<?php
require_once("../api.php");

function get_content($URL){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_URL, $URL);

    $out = curl_exec($ch);
    curl_close($ch);

    return rtrim($out,1);
}

if(!empty($_GET['access_token'])) {

    $request_uri = "/fblogin?";
    $request_method = "POST";
    $data = array("facebook" => array("access_token" => $_GET['access_token']));
    $response = api_request($request_uri, $request_method, $data);

    if ($response["response_code"] == 200) {
        setcookie("user_id", $response["response"]["user_id"], time() + (86400 * 7), "/"); // 86400 = 1 day
        setcookie("token_hash", $response["response"]["token_hash"], time() + (86400 * 7), "/"); // 86400 = 1 day
        echo json_encode($response["response"]);
    } elseif ($response["response_code"] == 202) {
        echo json_encode($response["response"]);
    }

}

?>
