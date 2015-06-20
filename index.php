<?php

// index.php
//
// Main entry point of site

require_once("api.php");
include("logincheck.php");

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

// Landing page if no page parameter is specified
$page = "home";
if (isset($_GET["page"])) $page = $_GET["page"];

switch ($page) {

    case "home":
        include("home.php");
        break;
    case "profile":
        include("profile.php");
        break;
    case "offers":
        include("offers.php");
        break;
    default:
        die("Invalid URL, no valid page specified");

}

?>
