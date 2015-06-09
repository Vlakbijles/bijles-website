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
        <meta name= "viewport" content="width=device-width, initial-scale=1.0">
        <link href = "css/bootstrap.min.css" rel = "stylesheet">
        <link href = "css/style.css" rel = "stylesheet">
    </head>

    <body>
    <!-- Navbar at top of page -->
    <?php include "navbar.php"; ?>


    <!-- content -->

    <!-- <div class = container> -->
    <!--     <div class = "row"> -->
    <!--         <div class = "col&#45;md&#45;9 text&#45;center"> -->
    <!--  -->
    <!--             <img class="roundrect" src="http://graph.facebook.com/mees.kalf/picture?type=large" class="img&#45;responsive center&#45;block"> -->
    <!--             <h4><b>Peter de Groot</b></h4> -->
    <!--         </div> -->
    <!--         <div class = "col&#45;md&#45;3"> -->
    <!--             <br><br> -->
    <!--             <button type="button" class="btn btn&#45;default" aria&#45;label="Left Align"> -->
    <!--                 <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                 <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                 <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--  -->
    <!--             </button> -->
    <!--             <h4><p>06&#45;23564909</p></h4> -->
    <!--             <a class="btn btn&#45;primary btn&#45;danger" href="https://www.hotmail.com" role="button">Peter@groot.nl</a> -->
    <!--             <br> -->
    <!--             <a class="btn btn&#45;primary btn&#45;lg" href="https://www.facebook.com/bdwnn?fref=ts" role="button">Facebook</a> -->
    <!--         </div> -->
    <!-- </div> -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!-- <br> -->
    <!-- <div class = "row"> -->
    <!--     <div class = "jumbotron col&#45;md&#45;9" id="lesspadding1"> -->
    <!--         <div role="tabpanel"> -->
    <!--  -->
    <!--             <ul class="nav nav&#45;tabs" role="tablist"> -->
    <!--                 <li role="presentation" class="active"><a href="#beschrijving" aria&#45;controls="beschrijving" role="tab" data&#45;toggle="tab">Beschrijving</a></li> -->
    <!--                 <li role="presentation"><a href="#vakken" aria&#45;controls="vakken" role="tab" data&#45;toggle="tab">Vakken</a></li> -->
    <!--             </ul> -->
    <!--  -->
    <!--             <div class="tab&#45;content"> -->
    <!--                 <div role="tabpanel" class="tab&#45;pane active" id="beschrijving"> -->
    <!--                     <div class = container> -->
    <!--                         <h4>whoop whoop dit was echt whoop whoop, whoop whoop met mn vlakbijles docent gedaan whoop whoop. was louter whoop whoop. Heb hem ook een whoop whoop rating gegeven.</h4> -->
    <!--                         <h4>whoop whoop dit was echt whoop whoop, whoop whoop met mn vlakbijles docent gedaan whoop whoop. was louter whoop whoop. Heb hem ook een whoop whoop rating gegeven. En daarom kan ik super goed bijles geven</h4> -->
    <!--                         <h4>whoop whoop dit was echt whoop whoop, whoop whoop met mn vlakbijles docent gedaan whoop whoop. was louter whoop whoop. Heb hem ook een whoop whoop rating gegeven.</h4> -->
    <!--                     </div> -->
    <!--                 </div> -->
    <!--                 <div role="tabpanel" class="tab&#45;pane" id="vakken"> -->
    <!--                     <div class = container> -->
    <!--                         <h4>&#45;Natuurkunde (VWO)</h4> -->
    <!--                         <h4>&#45;Scrummasteren (theCoesWay)</h4> -->
    <!--                         <h4>&#45;Scheikunde (MBO)</h4> -->
    <!--                     </div> -->
    <!--                 </div> -->
    <!--             </div> -->
    <!--         </div> -->
    <!--     </div> -->
    <!--  -->
    <!--  -->
    <!--     <!&#45;&#45;  REVIEUWS &#45;&#45;> -->
    <!--     <div class=container> -->
    <!--       <div class="row"> -->
    <!--         <div class="col&#45;md&#45;3"> -->
    <!--           <ul class="nav nav&#45;pills nav&#45;stacked"> -->
    <!--             <li class="active"><a href="#">Revieuws</a></li> -->
    <!--  -->
    <!--             <li> -->
    <!--                 <h3>HotAssNigga</h3> -->
    <!--                 <button type="button" class="btn btn&#45;default" aria&#45;label="Left Align"> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                 </button> -->
    <!--                 <h4>Dit was echt super goede bijles whoehoe, leip leip! Maar wel chill dat deze mensen dit doen</h4> -->
    <!--             </li> -->
    <!--  -->
    <!--             <li> -->
    <!--                 <h3>HotAssNigga</h3> -->
    <!--                 <button type="button" class="btn btn&#45;default" aria&#45;label="Left Align"> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                 </button> -->
    <!--                 <h4>Dit was echt super goede bijles whoehoe, leip leip! Maar wel chill dat deze mensen dit doen</h4> -->
    <!--             </li> -->
    <!--  -->
    <!--             <li> -->
    <!--                 <h3>HotAssNigga</h3> -->
    <!--                 <button type="button" class="btn btn&#45;default" aria&#45;label="Left Align"> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                 </button> -->
    <!--                 <h4>Dit was echt super goede bijles whoehoe, leip leip! Maar wel chill dat deze mensen dit doen</h4> -->
    <!--             </li> -->
    <!--  -->
    <!--             <li> -->
    <!--                 <h3>HotAssNigga</h3> -->
    <!--                 <button type="button" class="btn btn&#45;default" aria&#45;label="Left Align"> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                 </button> -->
    <!--                 <h4>Dit was echt super goede bijles whoehoe, leip leip! Maar wel chill dat deze mensen dit doen</h4> -->
    <!--             </li> -->
    <!--  -->
    <!--             <li> -->
    <!--                 <h3>HotAssNigga</h3> -->
    <!--                 <button type="button" class="btn btn&#45;default" aria&#45;label="Left Align"> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                 </button> -->
    <!--                 <h4>Dit was echt super goede bijles whoehoe, leip leip! Maar wel chill dat deze mensen dit doen</h4> -->
    <!--             </li> -->
    <!--  -->
    <!--             <li> -->
    <!--                 <h3>HotAssNigga</h3> -->
    <!--                 <button type="button" class="btn btn&#45;default" aria&#45;label="Left Align"> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                     <span class="glyphicon glyphicon&#45;star" aria&#45;hidden="true"></span> -->
    <!--                 </button> -->
    <!--                 <h4>Dit was echt super goede bijles whoehoe, leip leip! Maar wel chill dat deze mensen dit doen</h4> -->
    <!--             </li> -->
    <!--           </ul> -->
    <!--         </div> -->
    <!--       </div> -->
    <!--     </div> -->
    <!-- </div> -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!-- <script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
    <!-- <script src = "js/bootstrap.js"></script> -->
    <!-- <script src = "js/costum.js"></script> -->
    </body>

</html>
