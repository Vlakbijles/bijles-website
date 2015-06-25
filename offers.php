<?php

// offers.php
//
// Display available offers

require_once("api.php");
require_once("vars.php");


// Perform API request
if (isset($_GET["subject_id"]) && isset($_GET["postal_code"])
    && isset($_GET["level_id"]) && isset($_GET["order_by"])
    && isset($_GET["p"])) {

    $request_uri = "/offer"
        . "?subject_id=" . $_GET["subject_id"]
        . "&postal_code=" . strtoupper($_GET["postal_code"])
        . "&order_by=" . $_GET["order_by"]
        . "&page=" . $_GET["p"];
    if ($_GET["level_id"] != "")
        $request_uri = $request_uri . "&level_id=" . $_GET["level_id"];
} else {
    $resp_offers["response_code"] = INVALID;
}
$resp_offers = api_request($request_uri, "GET", NULL);


// Render header
switch($resp_offers["response_code"]) {
    case INVALID:
        $title = ERROR_HEADING_INVALIDSEARCH . " - " . SITENAME;
        break;

    case NO_RESULTS:
        $title = ERROR_HEADING_NORESULTS . " - " . SITENAME;
        break;

    case SUCCESS:
        $subject = $resp_offers["response"]["offers"][0]["subject"];
        $city = $resp_offers["response"]["offers"][0]["city"];
        $title = $subject . " bijles in " . $city . " - " . SITENAME;
        break;
    default:
        $title = ERROR_HEADING_GENERAL . " - " . SITENAME;
}
echo render_template("templates/head.html", array("title" => $title));


// Render navbar
if (!$logged_in) include("templates/modals/login.html");
echo render_template("templates/navbar.html", array(
                     "logged_in" => $logged_in,
                     "user_id" => $user_id));


// Render top search bar
echo render_template("templates/searchbar.html", array(
                     "subject_name" => $_GET["subject_name"],
                     "subject_id" => $_GET["subject_id"],
                     "show_logo" => false,
                     "postal_code" => $user_postal_code));


// Render found offers or display errors
switch($resp_offers["response_code"]) {

    case INVALID:
        echo render_template("templates/error.html", array(
                             "title" => ERROR_HEADING_INVALIDSEARCH,
                             "message" => ERROR_INVALIDSEARCH));
        break;

    case NO_RESULTS:
        echo render_template("templates/sortbar.html", array(
                             "postal_code" => $_GET["postal_code"],
                             "order_by" => $_GET["order_by"],
                             "subject_id" => $_GET["subject_id"],
                             "subject_name" => $_GET["subject_name"],
                             "level_id" => $_GET["level_id"],
                             "p" => $_GET["p"]));
        echo render_template("templates/error.html", array(
                             "title" => ERROR_HEADING_NORESULTS,
                             "message" => ERROR_NORESULTS));
        break;

    case SUCCESS:
        echo render_template("templates/sortbar.html", array(
                             "postal_code" => $_GET["postal_code"],
                             "order_by" => $_GET["order_by"],
                             "subject_id" => $_GET["subject_id"],
                             "subject_name" => $_GET["subject_name"],
                             "level_id" => $_GET["level_id"],
                             "p" => $_GET["p"]));

        echo render_template("templates/offers.html", array(
                             "num_offers" => $resp_offers["response"]["total_offers"],
                             "results" => $resp_offers["response"]["offers"]));
        break;

    default:
        echo render_template("templates/error.html", array(
                             "title" => ERROR_HEADING_GENERAL,
                             "message" => $resp_offers["response_code"]));
        break;

}

?>
