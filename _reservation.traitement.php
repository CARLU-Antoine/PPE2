<?php

include_once '_gestionBase.inc.php';
session_start();
$pdo = gestionnaireDeConnexion();

$ses=$_SESSION['login'];

if (isset($_SESSION['login'])) {
    $dateDebutReservation = date('d-m-Y');
    $dateFinReservation = date('d-m-Y', strtotime('+10 days'));
    $volumeEstime = $_POST["volumeEstime"];
    $codeVilleMiseDisposition = $_POST["codeVilleMiseDisposition"];
    $codeVilleRendre = $_POST["codeVilleRendre"];
    $etat = $_POST["etat"];
    
     $req = "SELECT code FROM utilisateur WHERE login='$ses'";
    echo $req;
    $prep = $pdo->prepare($req);
       $prep->execute();
    $resultat = $prep->fetch();
    $code=$resultat['code'];

    
    $sqlVilleDispo="SELECT * FROM ville where codeVille='$codeVilleMiseDisposition'";
     $prep = $pdo->prepare($sqlVilleDispo);
       $prep->execute();
    $resultat = $prep->fetch();
    $returnNomVille=$resultat['nomVille'];
    
    
    $sqlVilleRend="SELECT * FROM ville where codeVille='$codeVilleRendre'";
     $prepa= $pdo->prepare($sqlVilleRend);
       $prepa->execute();
    $resultate = $prepa->fetch();
    $returnNomVilleRend=$resultate['nomVille'];

    

    $sql = "INSERT INTO reservation(dateDebutReservation, dateFinReservation, volumeEstime, codeVilleMiseDisposition, codeVilleRendre, etat,codeUtilisateur) 
	 VALUES ('$dateDebutReservation', '$dateFinReservation', '$volumeEstime', '$codeVilleMiseDisposition', '$codeVilleRendre', '$etat',$code) ";
    $pdo->exec($sql);


    $_SESSION["codeReservation"] = $pdo->lastInsertId();
    
    header("location:_saisirLigneDeReservation.php");

}else{
     header("location:connexion.php");
}