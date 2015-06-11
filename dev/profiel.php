<!DOCTYPE html>
<html>
    <!-- Retrieve data from API first -->
    <?php
        // Retrieve data from API
        // TODO Authentication

        // Create request hash
        date_default_timezone_set("UTC");
        $utc_timestamp = time();
        $client_name = "";
        $client_key = "3aced6d2d652a5a7426daabff22e372c";


        $hash_algorithm = "sha256";
        $hash_data = "?";

        $request_data = hash_hmac($hash_algorithm, $hash_data, $hash_key);

        // Http get
        $request_uri = "/user/user_id";
        $request_url = "localhost{$request_uri}:5000";

        $request_response = http_get($request_url, array("timeout"=>1), $request_data);

        // Decode json & fill variables
        $user_data = json_decode($request_response, true);

        $user_name = $user_data["user"];
        $user_surname = $user_data["surname"];
        $user_picture = $user_data["picture"];
        $user_description = $user_data["description"];
        $user_phone = $user_data["phone"];
        $user_email = $user_data["email"];

        $page_title = "Profiel van {$user_name} {$user_surname}";
    ?>
    <head>
        <title>
            Vlakbijles.nl - <?php echo $page_title; ?>
        </title>
    </head>

    <body>
        <!-- Navbar at top of page -->
        <?php
            echo $user_name;
            echo $user_surname;
            echo $user_picture;
            echo $user_description;
            echo $user_phone;
            echo $user_email;
            echo $page_title;
        ?>
    </body>
</html>
