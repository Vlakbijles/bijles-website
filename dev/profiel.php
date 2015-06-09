<!DOCTYPE html>
<html>

    <!-- Retrieve data from API first -->
    <?php
        // Retrieve data from API
        // TODO Authentication
        // TODO http get

        date_default_timezone_set("UTC");
        $utc_timestamp = time();
        $hash_algorithm = "sha256";

        $request_uri = "/user/user_id";
        $request_method = "GET";
        $private_key = "32487f987a897987d8739d8a987ff987";

        $user_data_json = "";

        $user_name = "Henk";
        $user_lastname = "Henksen";
        $user_picture = "";
        $user_description = "";
        $user_phone = "";
        $user_email = "";
        $user_phone = "";

        $page_title = "Profiel van {$user_name} {$user_lastname}";
    ?>

    <head>
        <title>
            Vlakbijles.nl - <?php echo $page_title; ?>
        </title>
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <link href = "css/bootstrap.min.css" rel = "stylesheet">
        <link href = "css/style.css" rel = "stylesheet">
    </head>

    <body>
        <!-- Navbar at top of page -->
        <?php include "navbar.php"; ?>



    <!-- content -->

    <div class = container>
        <div class = "row">
            <div class = "col-md-9 text-center">
                <img class="roundrect" src="<?php echo $user_picture; ?>" class="img-responsive center-block">
                <h4><b><?php echo $user_name; echo $user_lastname; ?></b></h4>
            </div>
            <div class = "col-md-3">
                <br><br>
                <h4><p><?php echo $user_phone; ?></p></h4>
            </div>
        </div>
        <br>
        <div class = "row">
            <div class = "jumbotron col-md-9" id="lesspadding1">
                <div role="tabpanel">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#beschrijving" aria-controls="beschrijving" role="tab" data-toggle="tab">Beschrijving</a>
                        </li>
                        <li role="presentation">
                            <a href="#vakken" aria-controls="vakken" role="tab" data-toggle="tab">Vakken</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="beschrijving">
                            <div class = container>
                                <?php echo $user_description; ?>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="vakken">
                            <div class = container>
                                <h4>-Natuurkunde (VWO)</h4>
                                <h4>-Scrummasteren (theCoesWay)</h4>
                                <h4>-Scheikunde (MBO)</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <!--  REVIEUWS -->
        <div class=container>
          <div class="row">
            <div class="col-md-3">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#">Revieuws</a></li>

                <li>
                    <h3>HotAssNigga</h3>
                    <button type="button" class="btn btn-default" aria-label="Left Align">
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    </button>
                    <h4>Dit was echt super goede bijles whoehoe, leip leip! Maar wel chill dat deze mensen dit doen</h4>
                </li>

                <li>
                    <h3>HotAssNigga</h3>
                    <button type="button" class="btn btn-default" aria-label="Left Align">
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    </button>
                    <h4>Dit was echt super goede bijles whoehoe, leip leip! Maar wel chill dat deze mensen dit doen</h4>
                </li>

                <li>
                    <h3>HotAssNigga</h3>
                    <button type="button" class="btn btn-default" aria-label="Left Align">
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    </button>
                    <h4>Dit was echt super goede bijles whoehoe, leip leip! Maar wel chill dat deze mensen dit doen</h4>
                </li>

                <li>
                    <h3>HotAssNigga</h3>
                    <button type="button" class="btn btn-default" aria-label="Left Align">
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    </button>
                    <h4>Dit was echt super goede bijles whoehoe, leip leip! Maar wel chill dat deze mensen dit doen</h4>
                </li>

                <li>
                    <h3>HotAssNigga</h3>
                    <button type="button" class="btn btn-default" aria-label="Left Align">
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    </button>
                    <h4>Dit was echt super goede bijles whoehoe, leip leip! Maar wel chill dat deze mensen dit doen</h4>
                </li>

                <li>
                    <h3>HotAssNigga</h3>
                    <button type="button" class="btn btn-default" aria-label="Left Align">
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    </button>
                    <h4>Dit was echt super goede bijles whoehoe, leip leip! Maar wel chill dat deze mensen dit doen</h4>
                </li>
              </ul>
            </div>
          </div>
        </div>
    </div>

        <!-- Scripts -->
        <script src = "js/bootstrap.min.js"></script>
    </body>

</html>
