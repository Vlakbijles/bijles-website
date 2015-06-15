<?php

$title = "Vind bijles bij jou in de buurt - Vlakbijles";

echo render_template("templates/head.html", array("title" => $title));
echo render_template("templates/navbar.html", array("logged_in" => $logged_in));

include("templates/modals/register.html");
include("templates/modals/login.html");
include("templates/search_large.html");

include("templates/home.html");

include("templates/footer.html");

?>
