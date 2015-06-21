<?php

// index.php
//
// Main entry point of site

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
