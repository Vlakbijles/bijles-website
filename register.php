<pre>
<?php

    // register.php
    // description

    require_once("api.php");

    $email =  "";
    $password = "";
    $zipcode = "";
    $fb_token = "";

    function clean_input($input) {
        return htmlspecialchars(stripslashes(trim($input)));
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["reg_email"])) {
            $email = clean_input($_POST["reg_email"]);
        }
        if (isset($_POST["reg_pwd"])) {
            $password = clean_input($_POST["reg_pwd"]);
        }
        if (isset($_POST["reg_zipcode"])) {
            $zipcode = clean_input($_POST["reg_zipcode"]);
        }
        if (isset($_POST["reg_fb_token"])) {
            $fb_token = clean_input($_POST["reg_fb_token"]);
        }
    }

    // Perform login
    $request_uri = "/user?";
    $request_method = "POST";
    $usermeta = array("fb_token" => $fb_token, "zipcode" => $zipcode);
    $user = array("email" => $email, "password" => $password);
    $data = array("user" => $user, "usermeta" => $usermeta);

    print_r($data);

    $response = api_request($request_uri, $request_method, $data);

    if ($response["response_code"] == 200) {
        // succesful registration, proceed to login
    } else {
        // Check for faulty data (duplicate email, invalid fb token)
        print_r($response["response"]);
    }

    // header("Location: " . $_SERVER["HTTP_REFERER"]);

?>
</pre>
