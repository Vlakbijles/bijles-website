<?php

require_once("api.php");

// Login check
$logged_in = false;
$user_id = NULL;
if(isset($_COOKIE["user_id"]) && isset($_COOKIE["token_hash"])) {
    $data = array("loggedin" => array("token_hash" => $_COOKIE["token_hash"],
                                      "user_id" => $_COOKIE["user_id"]));
    $request_uri = "/user?";
    $request_method = "GET";
    $response = api_request($request_uri, $request_method, $data);
    if ($response["response_code"] == 200) {
        $logged_in = true;
        $user_id = $_COOKIE["user_id"];
    } elseif ($response["response_code"] == 0) {
        echo "api server down";
    }
}

// Template rendering
class MissingTemplateException extends Exception {}
function render_template($template_file, $vars = array()) {
    if(file_exists($template_file)) {
        ob_start();
        extract($vars);
        include($template_file);
        return ob_get_clean();
    } else {
        throw new MissingTemplateException("Template: {$template_file} could not be found!");
    }
}

if (isset($_GET["page"])) {

    switch ($_GET["page"]) {

        case "home":
            include("home.php");
            break;
        case "profile":
            include("profile.php");
            break;
        default:
            echo "no way jose";

    }

} else {

    echo "no way jose";

}

?>
