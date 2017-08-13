<?php
/**
 * Location: ETML
 * User: dulexsa
 * Date: 24.03.2017
 * Time: 13:41
 * Summary: m.databaseAction.php
 */

class databaseAction {

    //Variable de dataBase
    private $db_host = "localhost";
    private $db_user = "editor";
    private $db_password = "";
    private $db_name = "projweb";
    private $connection;
    //


    /**
     * Initialise la connexion avec la base de donnée
     *
     * @return PDO retourne la connexion PDO
     */
    function connectionToDatabse()
    {
        try {
            $this->connection = new PDO("mysql:host=$this->db_host;dbname=$this->db_name;charset=utf8", $this->db_user, $this->db_password);
            return $this->connection;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    /**
     * Récupère l'utilisateur ainsi que son mot de passe correspondant au login
     *
     * @param $login string C'est la valeur du login a chercher
     * @return mixed tableau contenant le login et le mot de passe de l'utilisateur
     */
    function selectUserAndPassword($login){
        $query = "SELECT utiPseudo, utiMDP FROM t_utilisateur WHERE utiPseudo = '" . $login . "'";
        return $this->executeGetRequest($query);
    }


    /**
     * Insère dans la base de donnée un nouvel utilisateur
     *
     * @param $email string Email du nouvel utilisateur
     * @param $mdp string Mot de passe du nouvel utilisateur (hashé)
     * @param $nom string Nom du nouvel utilisateur
     * @param $prenom string Prénom du nouvel utilisateur
     * @param $pseudo string Pseudo du nouvel utilsateur
     */
    function createLogin($email,$mdp,$nom,$prenom,$pseudo)
    {
        $query = "INSERT INTO t_utilisateur (idUtilisateur, utiEmail, utiInscription, utiMDP, utiNom, utiPrenom, utiPseudo) VALUES (NULL,'".$email."','".date("Y-m-d")."','".password_hash($mdp, PASSWORD_DEFAULT)."','".$nom."','".$prenom."','".$pseudo."')";
        $this->executeSetRequest($query);
    }


    /**
     * Insère dans la base de donnée une nouvel CIF avec ses différents objets
     *
     * @param $cifName string nom de la CIF
     * @param $cifCate string Catégorie de la CIF
     * @param $cifDescription string Déscription de la CIF
     * @param $cifEval int Note personnel de la CIF
     * @param $objNom array Tableau des différents nom des objets de la CIF
     * @param $objDescription array Tableau des description des objets de la CIF
     * @param $email string Pseudo de l'utilisateur qui a créer la CIF
     * @param $cifImagePath string Chemin de l'image de la CIF
     */
    function addNewCIF($cifName,$cifCate,$cifDescription,$cifEval,$objNom,$objDescription,$email,$cifImagePath)
    {
        $query = 'INSERT INTO t_cif (idCIF, cifNom, cifDescription, idCategorie, cifEval, cifCheminImage, idUtilisateur) VALUES (NULL,"'.$cifName.'","'.$cifDescription.'",(SELECT idCategorie FROM t_categorie WHERE catNom="'.$cifCate.'"),'.$cifEval.',"'.$cifImagePath.'",(SELECT idUtilisateur FROM t_utilisateur WHERE utiPseudo = "'.$email.'"))';
        print_r($query);
        $this->executeSetRequest($query);
        for($i = 0; $i<count($objNom); $i++) {

            $query = 'INSERT INTO t_objet (idObjet, objNom, objDescription, idCIF) VALUES (NULL,"' . $objNom[$i] . '","' . $objDescription[$i] . '",(SELECT idCIF from t_cif WHERE cifNom = "' . $cifName . '" AND cifDescription = "' . $cifDescription . '"))';
            $this->executeSetRequest($query);
        }
    }


    /**
     * Récupère les 5 dernières CIF ajouté
     *
     * @return mixed Tableau de CIF
     */
    function seeLast5CIF(){
        $query = 'SELECT cifCheminImage, cifNom, idCif,`t_utilisateur`.`utiPseudo` from t_cif NATURAL JOIN `t_utilisateur` ORDER BY idCIF DESC LIMIT 5';
        return $this->executeGetRequest($query);
    }


    /**
     * Récupère toutes les CIF correspondant à une catégorie
     *
     * @param $catName string Nom de la catégorie
     * @return mixed Tableau de CIF
     */
    function seeAllCIF($catName){
        $query = 'SELECT *, `t_utilisateur`.`utiPseudo` from t_cif NATURAL JOIN `t_utilisateur` WHERE idCategorie=(SELECT idCategorie FROM t_categorie WHERE catNom="'.$catName.'") ORDER BY idCif';
        return $this->executeGetRequest($query);
    }


    /**
     * Récupère les info d'une CIF ainsi que le pseudo de l'utilisateur
     *
     * @param $cifID int Id de la CIF à récupérer
     * @return mixed Tableau des info d'une CIF
     */
    function selectCifName($cifID){
        $query = 'SELECT *,t_utilisateur.utiPseudo FROM t_cif NATURAL JOIN t_utilisateur WHERE idCIF="'.$cifID.'"';
        return $this->executeGetRequest($query);
    }


    /**
     * Récupère les infos d'un utilisateur ainsi que le nombre de CIF ajouté
     *
     * @param $userID int Id de l'utilisateur recherché
     * @return mixed Tableau d'info de l'utilisateur
     */
    function selectUserInfo($userID){
        $query = 'SELECT *,COUNT(t_cif.idCIF) FROM t_utilisateur NATURAL JOIN t_CIF WHERE idUtilisateur="'.$userID.'"';
        return $this->executeGetRequest($query);
    }


    /**
     * Récupère les info des objet d'une CIF
     *
     * @param $cifID int ID de la CIF dont on doit récupérer les objets
     * @return mixed Tableau avec les objet d'une CIF
     */
    function selectAllCifObject($cifID){
        $query = 'SELECT * FROM t_objet WHERE idCIF='.$cifID;
        return $this->executeGetRequest($query);
    }


    /**
     * Récupère toutes les catégorie de la base de donnée
     *
     * @return mixed Tableau avec les catégorie
     */
    function selectAllCate(){
        $query = 'SELECT catNom FROM t_categorie';
        return $this->executeGetRequest($query);
    }


    /**
     * Met à jour l'évaluation des utilisateur d'une CIF
     *
     * @param $evalResult float Nouveau résultat de l'évaluation de la CIF
     * @param $nbEval int Nombre total d'évaluation
     * @param $idCIF int ID de la CIF a modifier
     */
    function addEval($evalResult, $nbEval,$idCIF){
        $query = 'UPDATE t_cif SET cifEvalUtil="'.$evalResult.'",cifNBEval="'.$nbEval.'" WHERE idCIF='.$idCIF;
        $this->executeSetRequest($query);
    }


    /**
     * Execute les requêtes SELECT
     *
     * @param $query string requête SELECT
     * @return mixed Résultat de la requête
     */
    function executeGetRequest($query){
        try {
            $request = $this->connection->prepare($query);
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        $request->execute();
        $tab = $request->fetchAll(PDO::FETCH_ASSOC);
        $request->closeCursor();
        return $tab;
    }


    /**
     * Exécute les requête pour une modification ou un ajout
     *
     * @param $query strin Requête à exécuter
     */
    function executeSetRequest($query){
        try {
            $request = $this->connection->prepare($query);
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        $request->execute();
        $request->closeCursor();
    }
}

?>

