<?php
/**
 * Location: ETML
 * User: dulexsa
 * Date: 24.03.2017
 * Time: 13:30
 * Summary: c.databaseAction.php
 */

include_once '../model/m.databaseAction.php';
header('Content-Type: text/html; charset=utf-8');
extract($_GET, EXTR_OVERWRITE);

class controllerDB
{
    private $objDatabase;


    /**
     * Création d'un objet model
     */
    function createObjDatabase()
    {
        $this->objDatabase = new databaseAction();
        //Si aucune session est active en activer une
        if(session_status() == 1) {
            session_start();
        }
    }

    /**
     * Fonction pour les actions générale du site
     *
     * @param string $type Action à effectuer
     * @param array $post Variable contenant un $_POST[] par défaut null
     * @param array $file Variable contenant un $file par défaut null
     */
    function switchAction($type, $post = null, $file = null)
    {
        $this->objDatabase->connectionToDatabse();//Connection à la base de donnée

        //Switch général du site
        switch ($type) {

            //Si l'action à effectué est créer un utilisateur
            case "createUser":

                //Variable de login pour le nouvel utilisateur
                $email = $post["email"];
                $mdp = $post["password"];
                $nom = $post["nom"];
                $prenom = $post["prenom"];
                $pseudo = $post["pseudo"];

                //Envoi des donnée au model afin de l'intégrer dans la base de donnée
                $this->objDatabase->createLogin($email, $mdp, $nom, $prenom, $pseudo);

                break;

            //Si l'action à effectué est de vérifier si l'utilisateur peut se connecter
            case "checkUser":

                //Variable de Login entré
                $login = $post["email"];
                $password = $post["password"];

                //Récupération de l'utilisateur ainsi que de son mot de passe depuis la BD
                $tabUserWithPassword = $this->objDatabase->selectUserAndPassword($login);

                //Vérification que l'utilisateur et son mot de passe correspondent à la BD
                $this->checkUserNameAndPassword($login, $password, $tabUserWithPassword);

                break;

            //Si l'action à effectuer est de créer une nouvel CIF
            case "addCIF":

                //Vérification de l'image
                header('Content-Type: text/html; charset=utf-8');
                $target_dir = "../../../userContent/CifImg/";  //Endroit où l'image sera stocké
                $target_file = $target_dir . basename($file["imgInp"]["name"]); //Nom de l'image
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION); //Extension de l'image

                $uploadOk = $this->checkImage($imageFileType,$file); //Vérification que l'image est bien correct

                //Si c'est le cas
                if ($uploadOk == 1) {
                    $refactedName = "CIF_du_" . date('YmdHis') . "." . $imageFileType;//Renommage de l'image suivant une convention
                    move_uploaded_file($_FILES['imgInp']['tmp_name'], "./$target_dir" . $refactedName);//Déplacement de l'image de son emplacement temporaire vers son emplacement définitif

                    //Variable pour l'ajout d'une CIF
                    $cifName = $post["cifName"];
                    $cifCate = $post["cifCate"];
                    $cifDescription = $post["cifDescription"];
                    $cifEval = $post["cifEval"];
                    $objNom = $post["objNom"];
                    $objDescription = $post["objDescription"];
                    $email = $_SESSION["session"];
                    $imagePath = $refactedName; //Récupération du chemin de l'image

                    //Envoi des données au model afin des les intégrer dans la BD
                    $this->objDatabase->addNewCIF($cifName, $cifCate, $cifDescription, $cifEval, $objNom, $objDescription, $email, $imagePath);

                }

                break;
            //Si l'action à effectuer est d'afficher toutes les CIFs
            case "seeAllCIF":
                $tabCat = $this->objDatabase->selectAllCate();
                $_SESSION['tabAllCIF'] = '';
                foreach ($tabCat as $cat){
                    $_SESSION['tabAllCIF'] .= '<div class="col-lg-12"><hr><h3 class="intro-text text-center"><strong>'.$cat["catNom"].'</strong></h3><hr></div>';
                    $tabCIF = $this->objDatabase->seeAllCIF($cat["catNom"]);
                    foreach ($tabCIF as $cifImage) {
                        $_SESSION['tabAllCIF'] .= '<div class="col-sm-4 text-center"><a href="../view/object.php?cifID='.$cifImage["idCIF"].'"><img class="img-responsive" src="../../../userContent/cifimg/' . $cifImage["cifCheminImage"] . '" alt=""></a><h3>'.$cifImage["cifNom"].'<small> '.$cifImage["utiPseudo"].'</small></h3></div>';
                    }
                }

                //Insertion des CIFs dans une variable de sessions

            break;

            //Si l'action à effectuer est de récupérer les 5 dernières CIFs
            case "last5Img":

                //Demande au model les 5 dernière CIFs
                $tabCIF = $this->objDatabase->seeLast5CIF();
                $_SESSION['slides']='';//Variable contenant les images
                $_SESSION['indicators']='';//Variable contenant les boutons de mouvement
                $counter=0;

                foreach($tabCIF as $row)
                {
                    $title = $row['cifNom'];
                    $utilOfCif = $row['utiPseudo'];
                    $image = $row['cifCheminImage'];
                    //Si la Cif est la première alors on lui rajoute l'élément active
                    if($counter == 0)
                    {
                        $_SESSION['indicators'] .='<li data-target="#carousel-example-generic" data-slide-to="'.$counter.'" class="active"></li>';
                        $_SESSION['slides'] .= '<div class="item active" style="text-align:center">
                       <a href="../view/object.php?cifID='.$row['idCif'].'"><img src="../../../userContent/cifimg/'.$image.'" alt="'.$title.'" style="display:inline"></a>
                        <div class="carousel-caption">
                          <h3>'.$title.'</h3>
                          <p style="color : rgb(0,255,255); font-size: large;">Par: '.$utilOfCif.'</p>
                        </div>
                      </div>';

                    }
                    //Sinon on lui attribue les éléments normaux
                    else
                    {
                        $_SESSION['indicators'] .='<li data-target="#carousel-example-generic" data-slide-to="'.$counter.'"></li>';
                        $_SESSION['slides'] .= '<div class="item" style="text-align:center">
                        <a href="../view/object.php?cifID='.$row['idCif'].'"><img src="../../../userContent/cifimg/'.$image.'" alt="'.$title.'" style="display:inline" ></a>
                        <div class="carousel-caption">
                          <h3>'.$title.'</h3>
                          <p style="color : rgb(0,255,255); font-size: large;">Par: '.$utilOfCif.'</p>
                        </div>
                      </div>';
                    }
                    $counter++;
                }
            break;

            //Si l'action est de récupérer les info d'une CIF
            case "selectCifName":
                $_SESSION['cifInfo'] = $this->objDatabase->selectCifName($_SESSION['cifId']);
                $_SESSION['userInfo'] = $this->objDatabase->selectUserInfo($_SESSION["cifInfo"][0]['idUtilisateur']);
                $_SESSION['objectInfo'] = $this->objDatabase->selectAllCifObject($_SESSION['cifId']);
                break;

            //Si l'action est de récupérer les catégories des CIFs
            case 'selectAllCate':
                $_SESSION['catName'] = $this->objDatabase->selectAllCate();
                break;

            //Si l'action est d'ajouter une évaluation à la CIF
            case "addEval":
                $evalResult = ($_SESSION['cifInfo'][0]['cifEvalUtil']*$_SESSION['cifInfo'][0]['cifNbEval']+ $post['cifEval'])/($_SESSION['cifInfo'][0]['cifNbEval']+1);
                $this->objDatabase->addEval($evalResult,$_SESSION['cifInfo'][0]['cifNbEval']+1,$_SESSION['cifId']);
                break;

            //Si l'action est de se déconnecter
            case "disconnect":
                unset($_SESSION["session"]);
                break;
        }
        unset($this->objDatabase);//Suppression de la variable model
    }


    /**
     * Vérifie que le mot de passe ainsi que le nom utilisateur entré corresponde.
     *
     * @param string $login login utilisé pour se connecter
     * @param string $password Mot de passe utilisé pour se connecter
     * @param array $tabUserWithPassword Tableau contenant l'utilisateur ainsi que son mot de passe
     */
    function checkUserNameAndPassword($login, $password, $tabUserWithPassword)
    {
        $boolPassword = false;

        //Vérification que le mot de passe entré corresponde au mot de passe de l'utilisateur entré
        if (password_verify($password, $tabUserWithPassword[0]['utiMDP']) and $login == $tabUserWithPassword[0]['utiPseudo']) {
            $boolPassword = true;
        }

        //Si le mot de passe est correct on met le login dans une variable de session
        if ($boolPassword) {
            $_SESSION['session'] = $login;//Connection réussie

        }
    }

    /**
     * Vérifie les différentes propriétés d'une image
     *
     * @param string $imageFileType Extension de l'image
     * @param string $file Tableau contenant l'image
     *
     * @return int Valeur pour savoir si l'image correspond à nos exigences
     */
    function checkImage($imageFileType,$file){
        $uploadOk = 1;

        if ($file["imgInp"]["error"]) {
            print_r($file["imgInp"]);
            echo "Il y a une erreur dans l'upload. ";
            $uploadOk = 0;
        }

        if ($file["imgInp"]["size"] > 10000000) {
            echo "Le fichier est trop gros.";
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "tif" && $imageFileType != "bmp") {
            echo "Seulement les fichier JPG, JPEG, cylé TIF, PNG ou BMP sont autorisés.";
            $uploadOk = 0;
        }
        return $uploadOk;
    }
}


?>