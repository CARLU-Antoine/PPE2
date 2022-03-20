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

/* fonction de récupérer la liste des types de conteneurs dans la base de données sous forme de tableau */

function obtenirTypeContainer() {
    $choix = $_SESSION['codeDuree'];
    $pdo = gestionnaireDeConnexion();
    $req = "select * from typeContainer,tarificationContainer WHERE typeContainer.numTypeContainer=tarificationContainer.numTypeContainer AND codeDuree='$choix'";
    $pdoStatement = $pdo->query($req);
    $lesContainers = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $lesContainers;
}

/* fonction de récupérer le montant total de la réservation courante */

function obtenirMontantTotal() {
    $choix = $_SESSION['codeDuree'];
    $codeReservation = $_SESSION["codeReservation"];

    $pdo = gestionnaireDeConnexion();
    $req = "SELECT codeReservation,SUM(qteReserver*tarif) as 'montantTotal' FROM reserver,tarificationContainer WHERE reserver.numTypeContainer=tarificationContainer.numTypeContainer "
            . "and reserver.codeReservation=$codeReservation and tarificationContainer.codeDuree='$choix' GROUP by codeReservation";
    $pdoStatement = $pdo->query($req);
    $lesContainers = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $lesContainers;
}

/* fonction de récupérer la liste des conteneurs dans la base de données sous forme de tableau */

function listeConteneurs($choix) {
    $lesConteneurs = array();
    $pdo = gestionnaireDeConnexion();
    if ($pdo != NULL) {
        $req = "select * from tarificationContainer,typeContainer where tarificationContainer.numTypeContainer=typeContainer.numTypeContainer and tarificationContainer.codeDuree='$choix'";
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
        $con = $_SESSION['login'];
        $req = "SELECT * FROM utilisateur where login='$con'";
        $pdoStatement = $pdo->query($req);
        $lesSetting = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    return $lesSetting;
}

//fonction permettant d'obtenir le pays
function obtenirPays() {
    $pdo = gestionnaireDeConnexion();
    $req = "select * from pays";
    $pdoStatement = $pdo->query($req);
    $pays = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $pays;
}

//fonction permettant d'obtenir les villes
function obtenirVille() {
    $pdo = gestionnaireDeConnexion();
    $req = "select * from ville ";
    $pdoStatement = $pdo->query($req);
    $ville = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $ville;
}

/* fonction de récupérer la liste des réservations de l'utilisateur */

function listeRerservation($codeReservationRecherche) {
    $lesReservations = array();
    $pdo = gestionnaireDeConnexion();
    if (isset($_SESSION['login']) && !empty($codeReservationRecherche)) {
        $ses = $_SESSION['login'];

        $req = "SELECT * FROM reservation,reserver,utilisateur,typeContainer,ville"
                . " WHERE reservation.codeReservation=reserver.codeReservation and reservation.codeUtilisateur=utilisateur.code"
                . " and reserver.numTypeContainer=typeContainer.numTypeContainer and reservation.codeVilleRendre=ville.codeVille and reserver.codeReservation=$codeReservationRecherche and login='$ses'";
        $pdoStatement = $pdo->query($req);
        $lesReservations = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    if (empty($codeReservationRecherche)) {
        $ses = $_SESSION['login'];
        $req = "SELECT * FROM reservation,reserver,utilisateur,typeContainer,ville"
                . " WHERE reservation.codeReservation=reserver.codeReservation and reservation.codeUtilisateur=utilisateur.code"
                . " and reserver.numTypeContainer=typeContainer.numTypeContainer and reservation.codeVilleRendre=ville.codeVille and login='$ses'";
        $pdoStatement = $pdo->query($req);
        $lesReservations = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    return $lesReservations;
}

/* fonction de récupérer la liste des réservations de l'utilisateur */

function supprimerReservation($codeReservationSupprimer) {

    if (isset($_SESSION['login'])) {
        $req = "SELECT code FROM utilisateur WHERE login='$ses'";
        $prep = $pdo->prepare($req);
        $prep->execute();
        $resultat = $prep->fetch();
        $code = $resultat['code'];
        session_start();
        $pdo = gestionnaireDeConnexion();
        $reqa = "";
        $pdo->exec($reqa);
    } else {
        header("location:connexion.php");
    }
}

/* fonction qui permet d'afficher les lignes de réservations de la réservation courante */

function listeRerservationCourante() {

    $lesReservations = array();
    $pdo = gestionnaireDeConnexion();
    if ($pdo != NULL) {
        $choix = $_SESSION['codeDuree'];
        $codeReservation = $_SESSION["codeReservation"];
        $req = "SELECT nomVille,volumeEstime,dateDebutReservation,datefinReservation,qteReserver, tarif,libelleTypeContainer,codeDuree,(qteReserver)*(tarif) as qtarif"
                . " FROM reservation,reserver,tarificationContainer,typeContainer,ville WHERE reserver.numTypeContainer=tarificationContainer.numTypeContainer"
                . " and reservation.codeReservation=reserver.codeReservation and tarificationContainer.numTypeContainer=typeContainer.numTypeContainer and reservation.codeVilleRendre=ville.codeVille"
                . " and codeDuree='$choix'and reservation.codeReservation='$codeReservation'";
        $pdoStatement = $pdo->query($req);
        $lesReservations = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    return $lesReservations;
}

/* fonction pour créer un devis dans la base de donnée */

function creerDevis($dateDebutDevis, $montantDevis, $volume, $nbContainers) {

    if (isset($_SESSION['login'])) {
        session_start();
        $pdo = gestionnaireDeConnexion();

        $reqa = "INSERT INTO devis(dateDevis,montantDevis,volume,nbcontainers)
	 VALUES ('$dateDebutDevis','$montantDevis','$volume','$nbContainers')";
        $pdo->exec($reqa);
    } else {
        header("location:connexion.php");
    }
}

//fonctions permettant de créer une réservation
function AjouterUneReservation($dateDebutReservation, $dateFinReservation, $volumeEstime, $codeVilleMiseDisposition, $codeVilleRendre, $etat, $code) {
    if (isset($_POST['volumeEstime'])) {

        $pdo = gestionnaireDeConnexion();
        $sql = "INSERT INTO reservation(dateDebutReservation, dateFinReservation, volumeEstime, codeVilleMiseDisposition, codeVilleRendre, etat,codeUtilisateur) 
	 VALUES ('$dateDebutReservation', '$dateFinReservation', '$volumeEstime', '$codeVilleMiseDisposition', '$codeVilleRendre', '$etat',$code) ";

        $pdo->exec($sql);
        header("location:_saisirLigneDeReservation.php");
    }
}

//fonctions permettant d'ajouter une ligne de réservation
function AjouterLigneDeReservation($codeReservation, $numTypeContainer, $quantite) {
    if (isset($_POST["qteReserver"])) {
        session_start();
        $pdo = gestionnaireDeConnexion();
        $sql = "INSERT INTO reserver(codeReservation, numTypeContainer , qteReserver) VALUES ('$codeReservation', '$numTypeContainer','$quantite') ";
        $pdo->exec($sql);
        header("location:_saisirLigneDeReservation.php");
    }
}


