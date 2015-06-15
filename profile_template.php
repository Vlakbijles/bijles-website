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

        <?php include("components/modals/contactuser.php"); ?>

        <?php include("components/modals/review.php"); ?>

        <?php include("components/modals/editprofile.php"); ?>

        <?php include("components/search_small.php"); ?>

        <!-- Main container -->
        <div class="container">

            <!-- Profile -->
            <div class="row ">

                <div class="col-sm-3 lead">
                    <div class="well">
                        <img src="img/profile/3.jpg" class="img-responsive img-thumbnail center-block bottommargin" alt="Henk Honk">
                        <h1 class="notopmargin text-center visible-xs">Bolle Henkie</h1>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" style="width: 80%"></div>
                            <div class="progress-bar progress-bar-warning" style="width: 20%"></div>
                        </div>
                        <p class="zeromargin"><span class="text-muted hidden-sm hidden-md">Locatie</span> Amsterdam</p>
                        <p class="zeromargin"><span class="text-muted hidden-sm hidden-md">Leeftijd</span> 12</p>
                    </div>

                    <div class="row" >
                        <a href="#" data-toggle="modal" data-target="#contactusermodal" class="btn btn-primary glyphicon col-xs-6">&#x2709;</a>
                        <a href="#" data-toggle="modal" data-target="#reviewmodal" class="btn btn-success glyphicon col-xs-6">&#xe065;</a>
                    </div>

                </div>

                <div class="col-sm-9 lead">

                    <h1 class="notopmargin hidden-xs">Bolle Henkie</h1>

                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#profile" data-toggle="tab" aria-expanded="true">Profiel</a></li>
                        <li class=""><a href="#offers" data-toggle="tab" aria-expanded="false">Vakken</a></li>
                    </ul>

                    <div id="myTabContent" class="tab-content topmargin" >

                        <!-- Profile tab -->
                        <div class="tab-pane fade active in" id="profile">
                            <a href="#" data-toggle="modal" data-target="#editmodal" class="btn btn-primary btn-sm glyphicon pull-right" style="margin: 0 0 10px 10px;">&#x270f;</a>
                            <p class="lead">Hello, i am bolle henkie. I give good lessons, i also know a lut from english, i play leage of legens a lut, so i talk wit de peoples there, i say hello, they sey HELLO bek. it are a nice community, becaus ei feel like a winner</p>
                            <p><?=$description?></p>
                        </div>

                        <!-- Offers tab -->
                        <div class="tab-pane fade" id="offers">
                            <table class="table table-striped table-hover vcenter">
                                <thead>
                                    <tr>
                                        <th class="col-xs-8">Vaknaam</th>
                                        <th class="col-xs-3">Niveau</th>
                                        <th class="col-xs-1"><a href="#" class="btn btn-success btn-sm btn-block glyphicon pull-right">&#x2b;</a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>League of legends</td>
                                        <td>Nerd</td>
                                        <td><a href="#" class="btn btn-danger btn-sm btn-block glyphicon pull-right">&#xe014;</a></td>
                                    </tr>
                                    <tr>
                                        <td>Microsoft Word</td>
                                        <td>Pro</td>
                                        <td><a href="#" class="btn btn-danger btn-sm btn-block glyphicon pull-right">&#xe014;</a></td>
                                    </tr>
                                    <tr>
                                        <td>Microsoft Excel</td>
                                        <td>Pro</td>
                                        <td><a href="#" class="btn btn-primary btn-sm btn-block glyphicon pull-right">&#x2709;</a></td>
                                    </tr>
                                    <tr>
                                        <td>VIM</td>
                                        <td>0/3</td>
                                        <td><a href="#" class="btn btn-primary btn-sm btn-block glyphicon pull-right">&#x2709;</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>

            <hr class="featurette-divider">

            <!-- Reviews -->
            <div id="reviews" class="row featurette">
                <h2 class="featurette-heading col-xs-11">Recensies <span class="text-muted">(3)</span></h2>
            </div>

            <div class="row">
                <div class="col-xs-9">
                    <blockquote class="pull-right">
                        <p class="lead">Hey asda ojspaodj asdpoaj apsodik ben henk, ik vind allemaal dingen, deze boy kan cker goed bijles geven whaha</p>
                        <small><cite title="Source Title">Henk Honk</cite></small>
                    </blockquote>
                </div>
                <div class="col-xs-3">
                    <img src="img/profile/1.jpg" class="img-responsive img-circle" alt="Henk Honk">
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3">
                    <img src="img/profile/2.jpg" class="img-responsive img-circle" alt="Henk Honk">
                </div>
                <div class="col-xs-9">
                    <blockquote>
                        <p class="lead">Ze noemen me ook wel robin klusboy, ik klaar graag klussies in me vrije tijd. Naast klusjes hou ik ook van motors, lekker sjezen. Over deze boy, naja deze boy ken best bijles geven</p>
                        <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
                    </blockquote>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-9">
                    <blockquote class="pull-right">
                        <p class="lead">ik ben de beste hekker, hekken is mijn ding gwn, I LUV LInuX ARTSSJ</p>
                        <small><cite title="Source Title">Nerd</cite></small>
                    </blockquote>
                </div>
                <div class="col-xs-3">
                    <img src="img/profile/4.jpg" class="img-responsive img-circle" alt="Henk Honk">
                </div>
            </div>

        </div>

        <?php include("components/footer.php"); ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </body>
</html>
