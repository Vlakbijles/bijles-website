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

// print_r($resp_profile);
// echo "<br />";
// echo "<br />";
// print_r($resp_offers);
// echo "<br />";
// echo "<br />";
// print_r($resp_reviews);


$title = "Vind bijles bij jou in de buurt - Vlakbijles";

echo render_template("templates/head.html",
    array("title" => $title));

echo render_template("templates/navbar.html",
    array("logged_in" => $logged_in,
    "user_id" => $user_id));

if (!$logged_in) {
    include("templates/modals/register.html");
    include("templates/modals/login.html");
}

echo render_template("templates/search_small.html");

if ($resp_profile["response_code"] == 404) {
    echo render_template("templates/error.html");
} else {
    $own_profile = ($user_id == $user_profile["id"]);

        if ($own_profile) {
            echo render_template("templates/modals/editprofile.html",
                                 array("description" => $user_profile["meta.description"],
                                       "zipcode" => $user_profile["meta.zipcode"]));
            echo render_template("templates/modals/addsubjects.html",
                                 array("user_id" => $user_id));
        }

        if (!$own_profile && $logged_in) {
            echo render_template("templates/modals/contactuser.html",
                                 array("offers" => $user_offers));
            echo render_template("templates/modals/review.html",
                                     array("offers" => $user_offers));
        }

        echo render_template("templates/profile.html",
                             array("name" => $user_profile["meta.name"],
                                   "surname" => $user_profile["meta.surname"],
                                   "city" => $user_profile["meta.city"],
                                   "age" => $user_profile["meta.age"],
                                   "description" => $user_profile["meta.description"],
                                   "offers" => $user_offers,
                                   "logged_in" => $logged_in,
                                   "user_id" => $user_id,
                                   "own_profile" => $own_profile));

        echo render_template("templates/reviews.html",
                             array("reviews" => $user_reviews));


}

include("templates/footer.html");





if (isset($_GET["id"])) {

    $user_profile = array();
    $user_offers = array();
    $user_reviews = array();

    // Request user profile data
    $request_uri = "/user/" . $_GET["id"] . "?";
    $request_method = "GET";
    $resp_profile = api_request($request_uri, $request_method, NULL);

    // if ($response_profile["response_code"] == 0) {
    //     echo "api server down";
    // } elseif ($response_profile["response_code"] == 404) {
    //     echo $response_profile["response_profile"]["message"];
    // } elseif ($response_profile["response_code"] == 200) {
    //     $user_profile = $response_profile["response"];
    // }

    if ($response_profile["response_code"] == 200) {
        $user_profile = $response_profile["response"];
    }

    // Request users offers
    $request_uri = "/user/" . $_GET["id"] . "/offer?";
    $request_method = "GET";
    $resp_offers = api_request($request_uri, $request_method, NULL);

    // if ($response_offers["response_code"] == 0) {
    //     echo "api server down";
    // } elseif ($response_offers["response_code"] == 404) {
    //     echo $response_offers["response_offers"]["message"];
    // } elseif ($response_offers["response_code"] == 200) {
    //     $user_offers = $response_offers["response"];
    // }

    if ($response_offers["response_code"] == 200) {
        $user_offers = $response_offers["response"];
    }

    // Request users reviews
    $request_uri = "/user/" . $_GET["id"] . "/review?";
    $request_method = "GET";
    $resp_reviews = api_request($request_uri, $request_method, NULL);

    //TODO handle errors
    if ($response_reviews["response_code"] == 200) {
        $user_reviews = $response_reviews["response"];
    }

    if (!empty($user_profile) && !empty($user_offers)) {

        $title = "Vind bijles bij jou in de buurt - Vlakbijles";
        $own_profile = ($user_id == $user_profile["id"]);

        echo render_template("templates/head.html",
                             array("title" => $title));

        echo render_template("templates/navbar.html",
                             array("logged_in" => $logged_in,
                                   "user_id" => $user_id));

        include("templates/modals/register.html");
        include("templates/modals/login.html");

        if ($response_profile["response_code"] != 200) {
            echo render_template("templates/error.html");
        }

        if ($own_profile) {
            echo render_template("templates/modals/editprofile.html",
                                 array("description" => $user_profile["meta.description"],
                                       "zipcode" => $user_profile["meta.zipcode"]));
            echo render_template("templates/modals/addsubjects.html",
                                 array("user_id" => $user_id));
        }

        if (!$own_profile && $logged_in) {
            echo render_template("templates/modals/contactuser.html",
                                 array("offers" => $user_offers));
            echo render_template("templates/modals/review.html",
                                     array("offers" => $user_offers));
        }


        echo render_template("templates/search_small.html",
                             array("zipcode" => $user_profile["meta.zipcode"]));

        echo render_template("templates/profile.html",
                             array("name" => $user_profile["meta.name"],
                                   "surname" => $user_profile["meta.surname"],
                                   "city" => $user_profile["meta.city"],
                                   "age" => $user_profile["meta.age"],
                                   "description" => $user_profile["meta.description"],
                                   "offers" => $user_offers,
                                   "logged_in" => $logged_in,
                                   "user_id" => $user_id,
                                   "own_profile" => $own_profile));

        echo render_template("templates/reviews.html",
                             array("reviews" => $user_reviews));

        include("templates/footer.html");

    }


} else {

    echo "no profile id provided";

}

?>
