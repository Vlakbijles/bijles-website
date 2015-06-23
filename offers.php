<?php

require_once("api.php");
require_once("vars.php");

if (isset($_GET["subject_id"]) && isset($_GET["postal_code"])) {
    $request_uri = "/offer?subject_id="
        . $_GET["subject_id"]
        . "&postal_code=" . strtoupper($_GET["postal_code"])
        . "&page=1";
} else {
    $resp_offers["response_code"] = INVALID;
}

if (isset($_GET["order_by"])) {
    $request_uri .= "&order_by=" . $_GET["order_by"];
}

$request_method = "GET";
$resp_offers = api_request($request_uri, $request_method, NULL);

// Render header
switch($resp_offers["response_code"]) {
    case INVALID:
        $title = ERROR_HEADING_INVALIDSEARCH . " - " . SITENAME;
        break;

    case NO_RESULTS:
        $title = ERROR_HEADING_NORESULTS . " - " . SITENAME;
        break;

    case SUCCESS:
        $subject = $resp_offers["response"][0]["subject.name"];
        //TODO Postal code to city
        $city = $_GET["postal_code"];
        $title = $subject . " bijles in " . $city . " - " . SITENAME;
        break;
    default:
        $title = ERROR_HEADING_GENERAL . " - " . SITENAME;
}
echo render_template("templates/head.html", array(
                     "title" => $title));

// Render navbar
if (!$logged_in) {
    include("templates/modals/login.html");
}
echo render_template("templates/navbar.html", array(
                     "logged_in" => $logged_in,
                     "user_id" => $user_id));

// Render top search bar
echo render_template("templates/searchbar.html", array(
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
        echo render_template("templates/error.html", array(
                             "title" => ERROR_HEADING_NORESULTS,
                             "message" => ERROR_NORESULTS));
        break;

    case SUCCESS:
        echo render_template("templates/offers.html", array(
                             "results" => $resp_offers["response"]));
        break;

    default:
        echo render_template("templates/error.html", array(
                             "title" => ERROR_HEADING_GENERAL . " (-)",
                             "message" => $resp_offers["response_code"]));
        break;

}

?>
