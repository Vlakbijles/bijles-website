<?php

// profile.php
//
// Display user profile

if (!isset($_GET["id"])) die("Invalid URL, no profile id specified");

require_once("api.php");
require_once("vars.php");


// Perform API requests

// User's profile
$request_uri = "/user/" . $_GET["id"] . "?";
$resp_profile = api_request($request_uri, "GET", NULL);

// User's offers
$request_uri = "/user/" . $_GET["id"] . "/offer?";
$resp_offers = api_request($request_uri, "GET", NULL);

// User's reviews
$request_uri = "/user/" . $_GET["id"] . "/review?";
$resp_reviews = api_request($request_uri, "GET", NULL);

// User's endorsments
$request_uri = "/user/" . $_GET["id"] . "/endorsment?";
$resp_endorsments = api_request($request_uri, "GET", NULL);


// Render header
switch($resp_profile["response_code"]) {
    case SUCCESS:
        $title = "Profiel van " . $resp_profile["response"]["meta.name"] . " "
                 . $resp_profile["response"]["meta.surname"] . " - " . SITENAME;
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
                     "subject_name" => "",
                     "subject_id" => "",
                     "show_logo" => false,
                     "postal_code" => $user_postal_code));


// Render profile or display error messages
switch($resp_profile["response_code"]) {

    case INVALID:
        echo render_template("templates/error.html", array(
                             "title" => ERROR_HEADING_GENERAL . " (" . $resp_profile["response_code"] . ")",
                             "message" => ERROR_USERNOTFOUND));
        break;

    case SUCCESS:
        $own_profile = ($user_id == $resp_profile["response"]["id"]);

        if ($own_profile) {
            echo render_template("templates/modals/editprofile.html", array(
                                 "email" => $resp_profile["response"]["email"],
                                 "description" => $resp_profile["response"]["meta.description"],
                                 "postal_code" => $resp_profile["response"]["meta.postal_code"]));
            echo render_template("templates/modals/addoffers.html", array(
                                 "user_id" => $user_id));
        } elseif($logged_in) {
            echo render_template("templates/modals/contactuser.html", array(
                                 "user_id" => $resp_profile["response"]["id"],
                                 "name" => $resp_profile["response"]["meta.name"],
                                 "surname" => $resp_profile["response"]["meta.surname"],
                                 "offers" => $resp_offers["response"]));
            echo render_template("templates/modals/review.html", array(
                                 "name" => $resp_profile["response"]["meta.name"],
                                 "surname" => $resp_profile["response"]["meta.surname"],
                                 "offers" => $resp_offers["response"]));
        }

        echo render_template("templates/profile.html", array(
                             "name" => $resp_profile["response"]["meta.name"],
                             "surname" => $resp_profile["response"]["meta.surname"],
                             "city" => $resp_profile["response"]["meta.city"],
                             "age" => $resp_profile["response"]["meta.age"],
                             "description" => $resp_profile["response"]["meta.description"],
                             "photo" => $resp_profile["response"]["meta.photo_id"],
                             "endorsments" => $resp_endorsments["response"],
                             "num_endorsers" => count($resp_endorsments["response"]),
                             "num_endorsed" => $resp_profile["response"]["meta.no_endorsed"],
                             "offers" => $resp_offers["response"],
                             "num_offers" => count($resp_offers["response"]),
                             "logged_in" => $logged_in,
                             "user_id" => $user_id,
                             "own_profile" => $own_profile));
        echo render_template("templates/reviews.html", array(
                             "reviews" => $resp_reviews["response"]));
        break;

    default:
        echo render_template("templates/error.html", array(
                             "title" => ERROR_HEADING_GENERAL . " (-)",
                             "message" => $resp_profile["response_code"]));
        break;

}

?>
