<?php

if (!isset($_GET["id"])) die("Invalid URL, no profile id specified");

require_once("api.php");
require_once("vars.php");

// Request user profile data
$request_uri = "/user/" . $_GET["id"] . "?";
$request_method = "GET";
$resp_profile = api_request($request_uri, $request_method, NULL);

// Request user's offers
$request_uri = "/user/" . $_GET["id"] . "/offer?";
$request_method = "GET";
$resp_offers = api_request($request_uri, $request_method, NULL);

// Request user's reviews
$request_uri = "/user/" . $_GET["id"] . "/review?";
$request_method = "GET";
$resp_reviews = api_request($request_uri, $request_method, NULL);

// Render header
switch($resp_profile["response_code"]) {
    case SUCCESS:
        $title = "Profiel van " . $resp_profile["response"]["meta.name"] . " "
                 . $resp_profile["response"]["meta.surname"] . " - Vlakbijles";
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

// Render profile or display error messages
switch($resp_profile["response_code"]) {

    case NO_RESULTS:
        echo render_template("templates/error.html", array(
                             "title" => "Er is iets misgegaan (" . $resp_profile["response_code"] . ")",
                             "message" => "Gebruiker niet gevonden"));
        break;

    case SUCCESS:
        $own_profile = ($user_id == $resp_profile["response"]["id"]);

        if ($own_profile) {
            echo render_template("templates/modals/editprofile.html", array(
                                 "description" => $resp_profile["response"]["meta.description"],
                                 "zipcode" => $resp_profile["response"]["meta.zipcode"]));
            echo render_template("templates/modals/addsubjects.html",
                                 array("user_id" => $user_id));
        } elseif($logged_in) {
            echo render_template("templates/modals/contactuser.html", array(
                                 "offers" => $resp_offers["response"]));
            echo render_template("templates/modals/review.html", array(
                                 "offers" => $resp_offers["response"]));
        }

        echo render_template("templates/profile.html", array(
                             "name" => $resp_profile["response"]["meta.name"],
                             "surname" => $resp_profile["response"]["meta.surname"],
                             "city" => $resp_profile["response"]["meta.city"],
                             "age" => $resp_profile["response"]["meta.age"],
                             "description" => $resp_profile["response"]["meta.description"],
                             "offers" => $resp_offers["response"],
                             "logged_in" => $logged_in,
                             "user_id" => $user_id,
                             "own_profile" => $own_profile));
        echo render_template("templates/reviews.html", array(
                             "reviews" => $resp_reviews["response"]));
        break;

    default:
        echo render_template("templates/error.html", array(
                             "title" => "Er is iets misgegaan (-)",
                             "message" => "Undefined error"));
        break;

}

include("templates/footer.html");
