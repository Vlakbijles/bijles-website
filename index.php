<?php

// index.php
//
// Main entry point of site, contains switch for available pages

date_default_timezone_set("Europe/Amsterdam");

require_once("api.php");
require_once("common.php");
include("logincheck.php");

// Landing page if no page parameter is specified
$page = "home";
if (isset($_GET["page"])) $page = $_GET["page"];

switch ($page) {

    case "home":
        include("home.php");
        include("templates/footer.html");
        break;
    case "profile":
        include("profile.php");
        include("templates/footer.html");
        break;
    case "offers":
        include("offers.php");
        include("templates/footer.html");
        break;
    default:
        die("Invalid URL, no valid page specified");

}

?>
