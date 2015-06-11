<!DOCTYPE html>
<html>
    <!-- Retrieve data from API first -->
    <?php
        // Retrieve data from API

        // TODO Authentication

        // Create initial json
        date_default_timezone_set("UTC");
        $api_user = "";
        $data  = array();
        $timestamp = time();
        $json_data = array("api_user" => $api_user,
                           "data" => $data,
                           "timestamp" => $timestamp);

        $request = json_encode($json_data);

        // Hash json
        $hash_algorithm = "sha256";
        $api_key = "3aced6d2d652a5a7426daabff22e372c";
        $request_method = "GET";
        $request_uri = "/user/user_id";
        
        $request_hash = hash_init($hash_algorithm);
        hash_update($request_hash, $api_key);
        hash_update($request_hash, $request);        
        hash_update($request_hash, $request_uri);        
        hash_update($request_hash, $request_method);

        $final_hash = hash_final($request_hash);

        // $request_url = "localhost{$request_uri}:5000";
        // $request = json_encode(
        //
        // // Decode json & fill variables
        // $user_data = json_decode($request_response, true);
        //
        // $user_name = $user_data["user"];
        // $user_surname = $user_data["surname"];
        // $user_picture = $user_data["picture"];
        // $user_description = $user_data["description"];
        // $user_phone = $user_data["phone"];
        // $user_email = $user_data["email"];
        //
        // $page_title = "Profiel van {$user_name} {$user_surname}";
        $page_title = "Profiel van";
    ?>
    <head>
        <title>
            Vlakbijles.nl - <?php echo $page_title; ?>
        </title>
    </head>

    <body>
        <?php
            echo $final_hash;



 
            // echo $user_name;
            // echo $user_surname;
            // echo $user_picture;
            // echo $user_description;
            // echo $user_phone;
            // echo $user_email;
            // echo $page_title;
        ?>
    </body>
</html>
