<?php

$title = "Vind bijles bij jou in de buurt - Vlakbijles";

echo render_template("templates/head.html", array(
                     "title" => $title));
echo render_template("templates/navbar.html", array(
                     "logged_in" => $logged_in,
                     "user_id" => $user_id));

include("templates/modals/register.html");
include("templates/modals/login.html");

echo render_template("templates/search_large.html", array(
                     "postal_code" => $user_postal_code));

include("templates/home.html");

include("templates/footer.html");

?>
