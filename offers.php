<?php

if (!isset($_GET["subject_id"]) || !isset($_GET["postal_code"])) die("Invalid URL, no subject id and/or postal code provided");

require_once("api.php");
require_once("vars.php");

$request_uri = "/offer?subject="
                . $_GET["subject_id"]
                . "&loc=" . strtoupper($_GET["postal_code"])
                . "&page=1&range=10000000&level=2&sortby=apj";
$request_method = "GET";
$resp_offers = api_request($request_uri, $request_method, NULL);

// Render header
switch($resp_offers["response_code"]) {
    case SUCCESS:
        //TODO city and subject name in title
        $title = "placeholder - " . SITENAME;
        break;
    default:
        $title = ERROR_HEADING . " - " . SITENAME;
}
echo render_template("templates/head.html", array(
                     "title" => $title));

// Render navbar
if (!$logged_in) {
    include("templates/modals/register.html");
    include("templates/modals/login.html");
}
echo render_template("templates/navbar.html", array(
                     "logged_in" => $logged_in,
                     "user_id" => $user_id));

// Render top search bar
echo render_template("templates/search_small.html", array(
                     "postal_code" => $user_postal_code));

// Render found offers or display errors
switch($resp_offers["response_code"]) {

    case INVALID:
        echo render_template("templates/error.html", array(
                             "title" => ERROR_HEADING . " (" . $resp_offers["response_code"] . ")",
                             "message" => ERROR_INVALIDSEARCH));
        break;

    case NO_RESULTS:
        echo render_template("templates/error.html", array(
                             "title" => ERROR_HEADING . " (" . $resp_offers["response_code"] . ")",
                             "message" => ERROR_NORESULTS));
        break;

    case SUCCESS:
        echo render_template("templates/offers.html", array(
                             "results" => $resp_offers["response"]));

        break;

    default:
        echo render_template("templates/error.html", array(
                             "title" => ERROR_HEADING . " (-)",
                             "message" => ERROR_UNDEFINED));
        break;

}

include("templates/footer.html");

?>
