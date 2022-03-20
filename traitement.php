<?php

include_once '_gestionBase.inc.php';
session_start();
$pdo = gestionnaireDeConnexion();



     
if (isset($_SESSION['login'])) {
    $dateDebutReservation = date('d-m-Y');
    $dateFinReservation = date('d-m-Y', strtotime('+10 days'));
    $volumeEstime = $_POST["volumeEstime"];
    $codeVilleMiseDisposition = $_POST["codeVilleMiseDisposition"];
    $codeVilleRendre = $_POST["codeVilleRendre"];
    $etat = $_POST["etat"];
    $ses=$_SESSION['login'];
    $choix= $_POST["codeDuree"];
    $_SESSION['codeDuree']=$choix;

     $req = "SELECT code FROM utilisateur WHERE login='$ses'";
    $prep = $pdo->prepare($req);
       $prep->execute();
    $resultat = $prep->fetch();
    $code=$resultat['code'];

    
    AjouterUneReservation($dateDebutReservation, $dateFinReservation, $volumeEstime, $codeVilleMiseDisposition, $codeVilleRendre, $etat, $code);
    
    $sql= "SELECT codeReservation FROM reservation ORDER BY codeReservation DESC LIMIT  1";
    $prepa = $pdo->prepare($sql);//requête préparé
       $prepa->execute();//excécuter la requête 
    $resultata = $prepa->fetch();//création d'un tableau a partir du résultat de la requête SQL

    $codeReservation=$_SESSION["codeReservation"]=$resultata['codeReservation'];
     $choix= $_POST["codeDuree"];
    $_SESSION['codeDuree']=$choix;
    $numTypeContainer = $_POST["numTypeContainer"];
    $quantite = $_POST["qteReserver"];

    AjouterLigneDeReservation($codeReservation, $numTypeContainer, $quantite);
        
        if (isset($_POST['nbcontainers']) && isset($_POST['volume'])){
            $dateDebutDevis = date('d-m-Y');
            $dateFinEstimée= date('d-m-Y', strtotime('+10 days'));
            $nbContainers= $_POST["nbcontainers"];
            $_SESSION['nbcontainers'] = $nbContainers;
            $volume= $_POST["volume"];
            
            creerDevis($dateDebutDevis, $volume, $nbContainers);
        } 
        
}else{
      header("location:connexion.php");
}

