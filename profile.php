<?php

require_once("api.php");

if (!isset($_GET["id"])) die("Invalid URL, no profile id specified");

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
    case 200:
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

    case 404:
        echo render_template("templates/error.html", array(
                             "title" => "Er is iets misgegaan (" . $resp_profile["response_code"] . ")",
                             "message" => "Gebruiker niet gevonden"));
        break;

    case 200:
        $user_profile = $resp_profile["response"];
        $user_offers = $resp_offers["response"];
        $user_reviews = $resp_reviews["response"];
        $own_profile = ($user_id == $user_profile["id"]);

        if ($own_profile) {
            echo render_template("templates/modals/editprofile.html", array(
                                 "description" => $user_profile["meta.description"],
                                 "zipcode" => $user_profile["meta.zipcode"]));
            echo render_template("templates/modals/addsubjects.html",
                                 array("user_id" => $user_id));
        } elseif($logged_in) {
            echo render_template("templates/modals/contactuser.html", array(
                                 "offers" => $user_offers));
            echo render_template("templates/modals/review.html", array(
                                 "offers" => $user_offers));
        }

        echo render_template("templates/profile.html", array(
                             "name" => $user_profile["meta.name"],
                             "surname" => $user_profile["meta.surname"],
                             "city" => $user_profile["meta.city"],
                             "age" => $user_profile["meta.age"],
                             "description" => $user_profile["meta.description"],
                             "offers" => $user_offers,
                             "logged_in" => $logged_in,
                             "user_id" => $user_id,
                             "own_profile" => $own_profile));
        echo render_template("templates/reviews.html", array(
                             "reviews" => $user_reviews));
        break;

    default:
        echo render_template("templates/error.html", array(
                             "title" => "Er is iets misgegaan (-)",
                             "message" => "Undefined error"));
        break;

}

include("templates/footer.html");
