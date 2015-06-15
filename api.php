<?php

    $api_user = "site-vlakbij";
    $api_key = "3aced6d2d652a5a7426daabff22e372c";
    $hash_algorithm = "sha256";
    $api_url = "vlakbijles.nl:5000";

    function api_request($request_uri, $request_method, $data) {

        global $api_url, $api_user, $api_key, $hash_algorithm;
        $timestamp = strval(time());

        $request_url = $api_url . $request_uri;

        // Create initial json
        $request_data = array("api_user" => $api_user,
                              "data" => $data,
                              "timestamp" => $timestamp);
        $request_json = json_encode($request_data);

        // Create hash from request data
        $request_hash = hash_init($hash_algorithm, HASH_HMAC, $api_key);
        hash_update($request_hash, $request_json);
        hash_update($request_hash, $request_uri);
        hash_update($request_hash, $request_method);
        $final_request_hash = hash_final($request_hash);

        // Add hash to json data array
        $request_data["hash"] = $final_request_hash;

        // Create the final json request including the hash
        $final_request_json = json_encode($request_data);

        // Create and execute cURL request
        $cs = curl_init($request_url);
        curl_setopt($cs, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cs, CURLOPT_POSTFIELDS, $final_request_json);
        curl_setopt($cs, CURLOPT_CUSTOMREQUEST, $request_method);
        curl_setopt($cs, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        $response = curl_exec($cs);
        $response_code = curl_getinfo($cs, CURLINFO_HTTP_CODE);
        curl_close($cs);

        // Strip incoming json string
        if(get_magic_quotes_gpc()){
            $response = stripslashes($response);
        }else{
            $response = $response;
        }
        $response = json_decode($response, true);

        return array("response" => $response, "response_code" => $response_code);

    }

?>
