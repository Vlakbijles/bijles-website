<!DOCTYPE html>
<html>

    <!-- Retrieve data from API first -->

    <?php
        // -- Retrieve data from API
        // TODO Authentication
        // TODO http get

        date_default_timezone_set("UTC");
        $utc_timestamp = time();
        $hash_algorithm = "sha256";

        $request_uri = "/user/user_id";
        $request_method = "GET";
        $private_key = 32487f987a897987d8739d8a987ff987;

        $user_data_json = "";

        $page_title = "get rekt";
    ?>

    <head>
        <title>Vlakbijles.nl - <?php echo $page_title; ?><title>
    </head>

    <body>
    <!-- Navbar at top of page -->
    <?php include "navbar.php"; ?>

    <!-- content -->

    <!-- Scripts -->
    <script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src = "js/bootstrap.js"></script>
    <script src = "js/costum.js"></script>
    </body>

</html>
