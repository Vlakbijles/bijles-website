<?php

    require_once ("model.php");

    $request_uri = "/user?";
    $request_method = "GET";


    if(!isset($_COOKIE["user_id"]) && !isset($_COOKIE["token_hash"])) {
        echo "Cookies are not set!";
    } else {
        $data = array("loggedin" => array("token_hash" => $_COOKIE["token_hash"],
                                          "user_id" => $_COOKIE["user_id"]));

        $response = api_request($request_uri, $request_method, $data);

    }

    class MissingTemplateException extends Exception {}

    function render_template($template_file, $vars = array())
    {
        if(file_exists($template_file))
        {
            ob_start();
            extract($vars);
            include($template_file);
            return ob_get_clean();
        }else
            throw new MissingTemplateException("Template: {$template_file} could not be found!");
    }

    echo render_template('profile.html', array('description' => $response['meta.description']));

?>
