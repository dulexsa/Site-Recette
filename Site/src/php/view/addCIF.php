<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    header('Content-Type: text/html; charset=utf-8');
    include_once '../controller/c.databaseAction.php';
require("../include/htmlHeader.php");
?>
    <script type="text/javascript" src="../../js/ImgPreview.js"></script>
    <script type="text/javascript" src="../../js/addFieldToForm.js"></script>
    <script type="text/javascript" src="../../js/verifFormAddCIF.js"></script>
    <link href="../../../resources/css/styles.css" rel="stylesheet">
</head>

<body>
<?php
require("../include/htmlNav.php");
$objController = new controllerDB();
$objController->createObjDatabase();
$objController->switchAction('selectAllCate');
?>

<div class="container">


    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <?php
                if(isset($_SESSION['session'])) {
                    ?>
                    <hr>
                    <h2 class="intro-text text-center">Ajouter une CIF
                        <strong>formulaire</strong>
                    </h2>
                    <hr>
                    <p>Vous pouvez ajouter une chose intéressante à faire sur cette page</p>
                    <?php
                    echo '<form class="form-horizontal" onsubmit="return verifFormAddCIF()" action="../controller/c.formAction.php?type=addCIF" method="post" enctype="multipart/form-data">'
                    ?>
                    <form class="form-horizontal" onsubmit="return verifFormAddCIF()"
                          action="../controller/c.formAction.php?type=addCIF" method="post"
                          enctype="multipart/form-data">
                        <fieldset>

                            <!-- Form Name -->
                            <legend>Ajouter une CIF</legend>
                            <div class="outer">

                                <!-- Form for image -->
                                <div id="photo-upload" style="float: left; width: 17%;">
                                    <fieldset>
                                        <label>Uploader une image:</label>
                                        <input type="file" name="imgInp" id="imgInp" onblur=""
                                               onchange="loadFile(event);">
                                        <img class="preview" id="preview" alt="Votre image">
                                    </fieldset>
                                </div>

                                <!-- Text input-->

                                <!-- <div class="outer">-->
                                <div id="inner" style="overflow: hidden">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="cifName">Nom de la CIF</label>
                                        <div class="col-md-5">
                                            <input id="cifName" name="cifName" placeholder="Jouer à Street Fighter"
                                                   onblur="verifWriting(this)" class="form-control input-md"
                                                   type="text">
                                            <span class="help-block">ex: Titre de l'activité ou du film</span>
                                        </div>
                                    </div>

                                    <!-- Multiple Checkboxes -->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="cifCate">Catégorie</label>
                                        <div class="col-md-4">
                                            <?php
                                            foreach ($_SESSION['catName'] as $tableCat){
                                                ?>
                                                <div class="radio">
                                                    <?php
                                                    echo '<label for="cifCate-'.$tableCat['catNom'].'">';
                                                    if($tableCat['catNom'] != 'Autre') {
                                                        echo '<input name="cifCate" id="cifCate-' . $tableCat['catNom'] . '" value="' . $tableCat['catNom'] . '" type="radio">' . $tableCat['catNom'];
                                                    }
                                                    else{
                                                        echo '<input name="cifCate" id="cifCate-' . $tableCat['catNom'] . '" value="' . $tableCat['catNom'] . '" type="radio" checked="checked">' . $tableCat['catNom'];
                                                    }
                                                        ?>
                                                    </label>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <!-- Textarea -->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="cifDescription">Description</label>
                                        <div class="col-md-4">
                                            <textarea class="form-control" onblur="verifWriting(this)"
                                                      placeholder="Jouer au tout dernier jeu de la saga Street Fighter sur sa console."
                                                      id="cifDescription" name="cifDescription"></textarea>
                                        </div>
                                    </div>

                                    <!-- Multiple Radios (inline) -->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="cifEval">Evaluation</label>
                                        <div class="col-md-4">
                                            <label class="radio-inline" for="cifEval-0">
                                                <input name="cifEval" id="cifEval-0" value="1" checked="checked"
                                                       type="radio">
                                                1
                                            </label>
                                            <label class="radio-inline" for="cifEval-1">
                                                <input name="cifEval" id="cifEval-1" value="2" type="radio">
                                                2
                                            </label>
                                            <label class="radio-inline" for="cifEval-2">
                                                <input name="cifEval" id="cifEval-2" value="3" type="radio">
                                                3
                                            </label>
                                            <label class="radio-inline" for="cifEval-3">
                                                <input name="cifEval" id="cifEval-3" value="4" type="radio">
                                                4
                                            </label>
                                            <label class="radio-inline" for="cifEval-4">
                                                <input name="cifEval" id="cifEval-4" value="5" type="radio">
                                                5
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Objet(s) de la CIF</label>
                                        <div class="col-md-4">
                                            <div id="champs">
                                                <div>
                                                    <label class="control-label">Nom de l'objet</label>
                                                    <div class="">
                                                        <input class="form-control input-md" onblur="verifWriting(this)"
                                                               placeholder="Une console" id="objName" type="text"
                                                               name="objNom[]">
                                                    </div>
                                                    <label class="control-label">Description de l'objet</label>
                                                    <div class="">
                                                        <input class="form-control input-md" onblur="verifWriting(this)"
                                                               id="objDescription"
                                                               placeholder="La tout dernière console sortie sur le marché."
                                                               name="objDescription[]">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" onclick="addField()">+</button>
                                        </div>
                                    </div>
                                </div><!-- end of .inner-->
                            </div> <!-- end of .outer-->
                            <div class="form-group">
                                <div class="col-lg-offset-10">
                                    <input type="submit" value="Ajouter" id="addCIFButton"
                                           class="btn btn-block btn-primary">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <?php
                }
                else{
                    echo 'Vous n\'êtes pas connecté';
                }
                ?>
            </div>
        </div>
    </div>

</div>
<!-- /.container -->

<?php
require("../include/htmlFooter.php");
?>

</body>

</html>

<?php
unset($_SESSION['catName']);
?>