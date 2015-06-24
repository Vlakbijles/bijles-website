<?php

// ajax/notification.php
//
// Returns render of noticiation template for use with jQuery's load function,
// the 'type' variable corresponds with the Bootstrap color classes:
// default, primary, success, info, warning, danger

include("../vars.php");
include("../common.php");

if (isset($_POST["message"]) && isset($_POST["type"])) {

    http_response_code(SUCCESS);
    echo render_template("../templates/notification.html",
                         array("type" => $_POST["type"],
                               "message" => $_POST["message"]));

}

?>
