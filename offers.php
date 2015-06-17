<?php

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
        $title = "Henkies profile - Vlakbijles";
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



if (isset($_GET["subject_id"]) && isset($_GET["postal_code"])
    && !empty($_GET["subject_id"]) && !empty($_GET["postal_code"])) {

    $request_uri = "/offer?subject="
                    . $_GET["subject_id"]
                    . "&loc=" . strtoupper($_GET["postal_code"])
                    . "&page=1&range=10000000&level=2&sortby=apj";
    $request_method = "GET";
    $response = api_request($request_uri, $request_method, NULL);


    if ($response["response_code"] == 0) {
        echo "api server down";
    } elseif ($response["response_code"] == 404) {
        echo $response["response"]["message"];
    } elseif ($response["response_code"] == 200) {
        $search_results = $response["response"];
    }
    print_r($response);

    if (isset($search_results)) {

        $title = "Vind bijles bij jou in de buurt - Vlakbijles";

        echo render_template("templates/head.html",
                             array("title" => $title));

        echo render_template("templates/navbar.html",
                             array("logged_in" => $logged_in,
                                   "user_id" => $user_id,
                                   "subject_id" => $_GET["subject_id"],
                                   "postal_code" => $_GET["postal_code"]));

        include("templates/modals/register.html");
        include("templates/modals/login.html");

        echo render_template("templates/search_small.html",
                             array("subject_id" => $_GET["subject_id"],
                                   "postal_code" => $_GET["postal_code"]));

        echo render_template("templates/offers.html",
                             array("results" => $search_results));

        include("templates/footer.html");

    }


} else {

    echo "ja zo werrekt het niet";

}

?>
