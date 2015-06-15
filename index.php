<?php include("include.php"); ?>

<html lang="nl">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Vind bijles bij jou in de buurt - Vlakbijles</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/theme.css" rel="stylesheet">

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <?php include("components/navbar.php"); ?>

        <?php include("components/modals/register.php"); ?>

        <?php include("components/modals/login.php"); ?>

        <?php include("components/search_large.php"); ?>

        <!-- Selling points container -->
        <div class="container">

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading">First featurette heading.<span class="text-muted ">It'll blow your mind.</span></h2>
                    <p class="lead text-justify">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                </div>
                <div class="col-md-5">
                    <h2 class="featurette-heading">First featurette heading.<span class="text-muted">Hey henk</span></h2>
                    <p class="lead text-justify">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-5">
                    <h2 class="featurette-heading">First featurette heading.<span class="text-muted">It'll blow your mind.</span></h2>
                    <p class="lead text-justify">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                </div>
                <div class="col-md-7">
                    <h2 class="featurette-heading">First featurette heading.<span class="text-muted">It'll blow your mind.</span></h2>
                    <p class="lead text-justify">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                </div>
            </div>

        </div>

        <?php include("components/footer.php"); ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </body>
</html>
