<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    require("../include/htmlHeader.php");
    include_once '../controller/c.databaseAction.php';
    ?>
</head>

<body>
<?php
require("../include/htmlNav.php");
?>

    <div class="container">
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Toutes
                        <strong>Les CIFs</strong>
                    </h2>
                    <hr>
                </div>
                <?php
                $objController = new controllerDB();
                $objController->createObjDatabase();
                $objController->switchAction('seeAllCIF');
                echo $_SESSION['tabAllCIF'];
                unset($_SESSION['tabAllCIF']);
                ?>
                <div class="clearfix"></div>
            </div>
        </div>

    </div>
    <!-- /.container -->

<?php
require("../include/htmlFooter.php");
?>

</body>

</html>
