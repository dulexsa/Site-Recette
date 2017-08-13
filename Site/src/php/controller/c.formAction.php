<?php
/**
 * Location: ETML
 * User: dulexsa
 * Date: 31.03.2017
 * Time: 13:37
 * Summary: c.formAction.php
 */

include 'c.databaseAction.php';

//Création d'un nouvel objet controller
$objController = new controllerDB();
$objController->createObjDatabase();
$objController->switchAction($_GET['type'],$_POST,$_FILES);
if(isset($_GET['id'])) {
    header('Location:../view/' . $_GET['page'] . '?cifID=' . $_GET['id']);
}
else{
    header('Location:../view/index.php');
}
?>