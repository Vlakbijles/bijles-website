<?php

if (!isset($_GET["subject_id"]) || !isset($_GET["postal_code"])) die("Invalid URL, no subject id and/or postal code provided");

require_once("api.php");

$request_uri = "/offer?subject="
                . $_GET["subject_id"]
                . "&loc=" . strtoupper($_GET["postal_code"])
                . "&page=1&range=10000000&level=2&sortby=apj";
$request_method = "GET";
$resp_offers = api_request($request_uri, $request_method, NULL);

// Render header
switch($resp_offers["response_code"]) {
    case 200:
        //TODO city and subject name in title
        $title = "placeholder - Vlakbijles";
        break;
    default:
        $title = "Er is iets misgegaan - Vlakbijles";
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
echo render_template("templates/search_small.html");

// Render found offers or display errors
switch($resp_offers["response_code"]) {

    case 400:
        echo render_template("templates/error.html", array(
                             "title" => "Er is iets misgegaan (" . $resp_offers["response_code"] . ")",
                             "message" => "Onjuist vak en/of niet bestaande postcode ingevoerd"));
        break;

    case 404:
        echo render_template("templates/error.html", array(
                             "title" => "Geen resultaten (" . $resp_offers["response_code"] . ")",
                             "message" => "Er zijn geen bijles aanbiedingen gevonden die voldoen aan de gespecifeerde criteria"));
        break;

    case 200:
        echo render_template("templates/offers.html", array(
                             "results" => $resp_offers["response"]));

        break;

    default:
        echo render_template("templates/error.html", array(
                             "title" => "Er is iets misgegaan (-)",
                             "message" => "Undefined error"));
        break;

}

include("templates/footer.html");


?>
