<?php

require_once("api.php");

if (isset($_GET["id"])) {

    $title = "henkies profile";

    $user_profile = array();
    $user_offers = array();
    $user_reviews = array();

    // Request user profile data
    $request_uri = "/user/" . $_GET["id"] . "?";
    $request_method = "GET";
    $response = api_request($request_uri, $request_method, $data);

    if ($response["response_code"] == 0) {
        echo "api server down";
    } elseif ($response["response_code"] == 404) {
        echo $response["response"]["message"];
    } elseif ($response["response_code"] == 200) {
        $user_profile = $response["response"];
    }

    // Request users offers
    $request_uri = "/user/" . $_GET["id"] . "/offer?";
    $request_method = "GET";
    $response = api_request($request_uri, $request_method, $data);

    if ($response["response_code"] == 0) {
        echo "api server down";
    } elseif ($response["response_code"] == 404) {
        echo $response["response"]["message"];
    } elseif ($response["response_code"] == 200) {
        $user_offers = $response["response"];
    }

    // Request users reviews
    $request_uri = "/user/" . $_GET["id"] . "/review?";
    $request_method = "GET";
    $response = api_request($request_uri, $request_method, $data);

    //TODO handle errors
    if ($response["response_code"] == 0) {
        echo "api server down";
    } elseif ($response["response_code"] == 200) {
        $user_reviews = $response["response"];
    }

    if (!empty($user_profile) && !empty($user_offers)) {

        $title = "Vind bijles bij jou in de buurt - Vlakbijles";

        echo render_template("templates/head.html",
                             array("title" => $title));

        echo render_template("templates/navbar.html",
                             array("logged_in" => $logged_in,
                                   "user_id" => $user_id));

        echo render_template("templates/modals/editprofile.html",
                             array("description" => $user_profile["meta.description"],
                                   "postal_code" => $user_profile["meta.description"]));

        echo render_template("templates/modals/contactuser.html",
                             array("offers" => $user_offers));

        echo render_template("templates/modals/review.html",
                             array("offers" => $user_offers));

        include("templates/modals/register.html");
        include("templates/modals/login.html");

        include("templates/search_small.html");

        echo render_template("templates/profile.html",
                             array("name" => $user_profile["meta.name"],
                                   "surname" => $user_profile["meta.surname"],
                                   "city" => $user_profile["meta.city"],
                                   "description" => $user_profile["meta.description"],
                                   "offers" => $user_offers));

        echo render_template("templates/reviews.html",
                             array("reviews" => $user_reviews));

        include("templates/footer.html");

    }


} else {

    echo "no profile id provided";

}

?>
