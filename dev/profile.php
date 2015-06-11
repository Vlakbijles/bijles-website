<?php
    $requested_user_id = "1";

    $api_user = "site-vlakbij";
    $api_key = "3aced6d2d652a5a7426daabff22e372c";

    $data = new ArrayObject();
    $timestamp = strval(time());

    $request_uri = "/user/{$requested_user_id}?";
    $request_method = "GET";

    // Create initial json
    $json_data = array("api_user" => $api_user,
                       "data" => $data,
                       "timestamp" => $timestamp);
    $request_json = json_encode($json_data);

    // Hash json
    $hash_algorithm = "sha256";
    $request_hash = hash_init($hash_algorithm, HASH_HMAC, $api_key);
    hash_update($request_hash, $request_json);
    hash_update($request_hash, $request_uri);
    hash_update($request_hash, $request_method);
    $final_hash = hash_final($request_hash);

    // Add hash to json data array
    $json_data["hash"] = $final_hash;

    // Create the final json request including the hash
    $final_request_json = json_encode($json_data);

    // Http GET request
    // $request_url = "localhost:5000{$request_uri}";
    $request_url = "vlakbijles.nl:5000{$request_uri}";

    // Send a post request and replace POST by GET
    $cs = curl_init($request_url);
    curl_setopt($cs, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cs, CURLOPT_POSTFIELDS, $final_request_json);
    curl_setopt($cs, CURLOPT_CUSTOMREQUEST, $request_method);
    curl_setopt($cs, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
    $response = curl_exec($cs);
    curl_close($cs);

    echo $response;
    echo "</br>";
    if(get_magic_quotes_gpc()){
      $d = stripslashes($response);
    }else{
      $d = $response;
    }
    $d = json_decode($d,true);
    echo $d["id"];
    echo $d["meta.description"];
    // $user_name = $user_data["meta.name"];
    // $user_surname = $user_data["surname"];
    // $user_picture = $user_data["picture"];
    // $user_description = $user_data["description"];
    // $user_phone = $user_data["phone"];
    // $user_email = $user_data["email"];
    // $page_title = "Profiel van {$user_name} {$user_surname}";
    $page_title = "asda";
?>
