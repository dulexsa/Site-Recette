<?php
/**
 * Created by PhpStorm.
 * User: stocchetjo
 * Date: 10.03.2017
 * Time: 14:16
 */
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        require("../include/htmlHeader.php");
    ?>
    <script type="text/javascript" src="../../js/verifFormInscription.js"></script>

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
                <h2 class="intro-text text-center">Formulaire
                    <strong>D'Inscription !</strong>
                </h2>
                <hr>
                <p>S'inscrire</p>
                <form name="form" onsubmit="return verifForm(this)" action ="../controller/c.formAction.php?type=createUser" method="post">
                    <fieldset>

                        <!-- Form Name -->
                        <legend>Veuillez insérer vos données.</legend>
                        <div class="row">
                            <div class="col-md-offset-2 col-md-3">
                                <div class="form-group">
                                    <label for="Nom">Nom</label>
                                    <input type="text" class="form-control" name="nom" id="nom" onblur="verifNom(this)" placeholder="Nom">
                                </div>
                            </div>
                            <div class="col-md-offset-1 col-md-3">
                                <div class="form-group">
                                    <label for="Prenom">Prénom</label>
                                    <input type="text" class="form-control" name="prenom" id="prenom" onblur="verifNom(this)" placeholder="Prénom">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-offset-2 col-md-7">
                                <div class="form-group">
                                    <label for="Email">Email address</label>
                                    <input type="text" class="form-control" name="email" id="email" onblur="verifMail(this)" placeholder="Enter email">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-offset-2 col-md-3">
                                <div class="form-group">
                                    <label for="Pseudo">Pseudo</label>
                                    <input type="text" class="form-control" name="pseudo" id="Pseudo"" placeholder="Pseudo">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-offset-2 col-md-3">
                                <div class="form-group">
                                    <label for="Password">Mot de passe</label>
                                    <input type="password" class="form-control" name="password" id="passwordForm" placeholder="Mot de passe">
                                </div>
                            </div>
                            <div class="col-md-offset-1 col-md-3">
                                <div class="form-group">
                                    <label for="Vpassword">Vérification mot de passe</label>
                                    <input type="password" class="form-control" name="vpassword" id="vpassword" onblur="verifMDP(document.getElementById('passwordForm'),document.getElementById('vpassword'))" placeholder="Vérification mot de passe">
                                </div>
                            </div>
                        </div>

                        <br/>
                        <div class="row">
                            <div class="col-md-offset-5 col-md-3">
                                <div class="form-group">
                                    <button type="submit" id="btnInscription" class="btn btn-primary">Envoyer mes informations</button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
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