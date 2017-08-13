<?php

header('Content-Type: text/html; charset=utf-8');
include_once '../controller/c.databaseAction.php';

?>
<!DOCTYPE html>
<html lang="fr">

<head>
<?php
require("../include/htmlHeader.php");
?>
</head>

<body>
<?php
require("../include/htmlNav.php");

?>
    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12 text-center">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <?php
                            $objController = new controllerDB();
                            $objController->createObjDatabase();
                            $objController->switchAction('last5Img');
                            echo $_SESSION['indicators'];
                            ?>
                        </ol>


                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                        <?php
                        $objController = new controllerDB();
                        $objController->createObjDatabase();
                        $objController->switchAction('last5Img');
                        echo $_SESSION['slides']
                        ?>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="icon-prev"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="icon-next"></span>
                        </a>
                    </div>

                    <div id="carousel-generic" class="carousel slide">
                        <div class="carrousel-inner">

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Php et MySQL
                        <strong>Projet Web 2</strong>
                    </h2>
                    <hr>
                    <img class="img-responsive img-border img-left" src="../../../resources/images/intro-pic.jpg" alt="">
                    <hr class="visible-xs">
                    <p>Le projet effectué en projet Web 2 consiste à créer un site internet qui se connectera à une base de donnée MySQL grâce au langage php. Ces données seront correctement affichées selon les points demandés dans le cahier des charges.</p>
                    <p>Le projet consiste à consolider les connaissances de mise en œuvre des langages HTML, CSS, PHP, JavaScript et MySQL.</p>
                    <p>Au final, le site web réalisé devra être exploitable et livrable. Dès lors, un rendu professionnel et un soin particulier de la documentation du projet devra être rendu.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->

<?php
require("../include/htmlFooter.php");
?>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>
</html>

<?php
unset($_SESSION['indicators']);
unset($_SESSION['slides']);
?>