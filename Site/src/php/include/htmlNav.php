<?php
/**
 * Created by PhpStorm.
 * User: stocchetjo
 * Date: 10.03.2017
 * Time: 14:01
 */
header('Content-Type: text/html; charset=utf-8');
?>

<div class="brand">P_40-Web2-CIF</div>
<div class="address-bar">École des Métier de Lausanne | Rue de Sébeillon 12, 1004 Lausanne</div>

<!-- Navigation -->
<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
            <a class="navbar-brand" href="index.php">P_40-Web2-CIF</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="index.php">Accueil</a>
                </li>
                <li>
                    <a href="seeCIF.php">Toutes les CIFs</a>
                </li>
                <?php
                    if(isset($_SESSION['session'])){
                        echo '<li><a href="addCIF.php">Ajouter une CIF</a></li>';
                    }
                    else
                    {
                        echo '<li><a href="inscription.php">S\'inscrire</a></li>';
                    }
                ?>
            </ul>
            <?php
            if(isset($_SESSION['session'])){
                echo '<h5 align="center">Vous êtes bien connecter !</h5>';

                echo '<a href="../controller/c.formAction.php?type=disconnect"><button type="button" class="btn btn-danger pull-right navbar-btn">Se déconnecter</button></a>';

            }
            else {
                ?>
                <ul class="nav navbar-nav">
                    <div class="container-fluid">
                            <form id="signin" class="navbar-form navbar-right"
                                  action="../controller/c.formAction.php?type=checkUser" method="post">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="email" type="text" class="form-control" name="email" value=""
                                           placeholder="Nom d'utilisateur">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="password" type="password" class="form-control" name="password" value=""
                                           placeholder="Mot de passe">
                                </div>
                                <button type="submit" class="btn btn-primary">Se connecter</button>
                            </form>
                    </div>
                </ul>
                <?php
            }
            ?>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->

</nav>
<?php
?>