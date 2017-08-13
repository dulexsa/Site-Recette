<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">

<head>
    <?php
    header('Content-Type: text/html; charset=utf-8');
    require("../include/htmlHeader.php");
    include_once '../controller/c.databaseAction.php';
    ?>
    <script type="text/javascript" src="../../js/ImgPreview.js"></script>
    <script type="text/javascript" src="../../js/addFieldToForm.js"></script>
    <link href="../../../resources/css/styles.css" rel="stylesheet">
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
                <h1 class="intro-text text-center">Détail de la CIF :
                    <strong>
                        <?php
                        $_SESSION['cifId']= $_GET['cifID'];
                        $objController = new controllerDB();
                        $objController->createObjDatabase();
                        $objController->switchAction('selectCifName');
                        echo $_SESSION["cifInfo"][0]['cifNom'];
                        unset($objController);
                        ?>
                    </strong>
                </h1>
                <hr>
                <?php
                echo '<img class="img-responsive" src="../../../userContent/cifimg/' . $_SESSION["cifInfo"][0]["cifCheminImage"] . '" alt="">';
                ?>
                <hr class="visible-xs">
                <h2>Description :</h2>
                <?php
                echo '<p>'.$_SESSION["cifInfo"][0]['cifDescription'].'</p>';
                echo '<h4>Liste des objets :</h4>';
                foreach($_SESSION['objectInfo'] as $tabObject){
                    echo '<p>Nom de l\'objet : '.$tabObject['objNom'].'</p>';
                    echo '<p>Decription de l\'objet : '.$tabObject['objDescription'].'</p>';

                }
                ?>
                <h3>évaluation</h3>
                <div class="form" style="float: left">
                    <?php
                    echo '<form action="../controller/c.formAction.php?type=addEval&page='.basename(__FILE__).'&id='.$_GET['cifID'].'" method="post">'
                    ?>
                    <label class="control-label" for="cifCate">évaluer la CIF</label>
                        <div class="radio">
                            <label for="cifEval-0">
                                <input name="cifEval" id="cifEval-0" value="1" type="radio">1
                            </label>
                        </div>
                        <div class="radio">
                            <label for="cifEval-1">
                                <input name="cifEval" id="cifEval-1" value="2" type="radio">2
                            </label>
                        </div>
                        <div class="radio">
                            <label for="cifEval-2">
                                <input name="cifEval" id="cifEval-2" value="3" checked="checked" type="radio">3
                            </label>
                        </div>
                        <div class="radio">
                            <label for="cifEval-3">
                                <input name="cifEval" id="cifEval-3" value="4" type="radio">4
                            </label>
                        </div>
                        <div class="radio">
                            <label for="cifEval-4">
                                <input name="cifEval" id="cifEval-4" value="5" type="radio">5
                            </label>
                        </div>
                    <div class="form-group">
                        <div class="">
                            <input type="submit" value="Ajouter" id="addCIFButton" class="btn btn-primary">
                        </div>
                    </div>
                </form>
                </div>
                <div align="center">
                <p>Moyenne : </p>
                    <?php
                    echo '<p style="font-size: xx-large">'.round($_SESSION['cifInfo'][0]['cifEvalUtil'],2).'/5</p><p>Nombre de note totale: '.$_SESSION['cifInfo'][0]['cifNbEval'].' </p>';
                    ?>
                </div>
                <h2 style="clear: both">Auteur :</h2>
                <?php
                echo '<h4>'.$_SESSION['userInfo'][0]['utiPseudo'].'</h4><p>Date d\'inscription : '.$_SESSION['userInfo'][0]['utiInscription'].'</p>';
                echo '<p>Contribution totales : '.$_SESSION['userInfo'][0]['COUNT(t_cif.idCIF)'].'</p>';
                ?>
                </div>
        </div>
    </div>
</div>

</body>

<?php
require("../include/htmlFooter.php");
?>
</html>
