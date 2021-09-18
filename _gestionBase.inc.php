<?php
/* connexion a la base de données */
function gestionnaireDeConnexion() {
    try {
        $pdo = new PDO(
                'mysql:host=localhost;dbname=tholdi',
                'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );
    } catch (PDOException $err) {
        var_dump($err);
        die;
    }
    return $pdo;
}

/* fonction permettant de véri  fier que l'utilisateur à un compte */


function obtenirTypeContainer() {
    $pdo = gestionnaireDeConnexion();
    $req = "select * from typeContainer,tarificationContainer WHERE typeContainer.numTypeContainer=tarificationContainer.numTypeContainer";
    $pdoStatement = $pdo->query($req);
    $lesContainers = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $lesContainers;
}
//fonctions permettant de faire une réservation

/* fonction de récupérer la liste des conteneurs dans la base de données sous forme de tableau */

function listeConteneurs() {
    $lesConteneurs = array();
    $pdo = gestionnaireDeConnexion();
    if ($pdo != NULL) {
        $req = "select * from typeContainer order by numTypeContainer";
        $pdoStatement = $pdo->query($req);
        $lesConteneurs = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    return $lesConteneurs;
}
/* fonction de récupérer la liste des conteneurs dans la base de données sous forme de tableau */

/* fonction de récupérer la liste des paramètre de l'utilisateur connecté dans la base de données sous forme de tableau */
function listeSetting() {
    
    $lesSetting = array();
    $pdo = gestionnaireDeConnexion();
    if (isset($_SESSION['login'])) {
        $con=$_SESSION['login'];
        $req = "SELECT * FROM utilisateur where login='$con'";
        $pdoStatement = $pdo->query($req);
        $lesSetting = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    return $lesSetting;
}
/* fonction de récupérer la liste des Devis de l'utilisateur connecté dans la base de données sous forme de tableau */
function listeDevis() {
    $lesDevis=array();
    $pdo = gestionnaireDeConnexion();
     if (isset($_SESSION['login'])) {
         $req = "SELECT * FROM devis ";
        $pdoStatement = $pdo->query($req);
        $lesDevis = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    return $lesDevis;
}

/* fonction permettant de créer un compte */

function creerCompte($code,$role,$raisonSociale, $adresse, $cp, $ville, $adrMel, $telephone, $contact,$login, $mdp,$pays) {
    $pdo = gestionnaireDeConnexion();
        $req = "insert into utilisateur"
            . " (code,role,raisonSociale,adresse,cp,ville"
            . " adrMel,telephone,contact"
            . "login,mdp,codePays)"
                . "values ($code,$role,$raisonSociale, $adresse, $cp, $ville, $adrMel, $telephone, $contact,$login, $mdp,$pays)";
        $pdo->execute($req);
}
    
//fonction permettant d'obtenir le pays
function obtenirPays() {
    $pdo = gestionnaireDeConnexion();
    $req = "select * from pays";
    $pdoStatement = $pdo->query($req);
    $pays= $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $pays;
}

//fonction permettant d'obtenir la ville
function obtenirVille() {
    $pdo = gestionnaireDeConnexion();
    $req = "select * from ville ";
    $pdoStatement = $pdo->query($req);
    $ville= $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $ville;
}




$ses=$_SESSION['login'];

function listeRerservation() {
    $lesReservations = array();
    $pdo = gestionnaireDeConnexion();
    if ($pdo != NULL) {
        $ses=$_SESSION['login'];
        
        $req = "SELECT * FROM reservation,reserver,utilisateur,typeContainer,ville"
                . " WHERE reservation.codeReservation=reserver.codeReservation and reservation.codeUtilisateur=utilisateur.code"
                . " and reserver.numTypeContainer=typeContainer.numTypeContainer and reservation.codeVilleRendre=ville.codeVille and login='$ses'";
        $pdoStatement = $pdo->query($req);
        $lesReservations = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    return $lesReservations;
}

function listeRerservationCourante() {
    $lesReservations = array();
    $pdo = gestionnaireDeConnexion();
    if ($pdo != NULL) {
        $ses=$_SESSION['login'];
        $codeReservation = $_SESSION["codeReservation"];
        $req = "SELECT * FROM reservation,reserver,utilisateur,typeContainer,ville"
                . " WHERE reservation.codeReservation=reserver.codeReservation and reservation.codeUtilisateur=utilisateur.code"
                . " and reserver.numTypeContainer=typeContainer.numTypeContainer and reservation.codeVilleRendre=ville.codeVille "
                . " and login='$ses' and reserver.codeReservation='$codeReservation'";
        $pdoStatement = $pdo->query($req);
        $lesReservations = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    return $lesReservations;
}



