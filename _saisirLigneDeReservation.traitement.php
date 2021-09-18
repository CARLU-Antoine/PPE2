<?php
include_once '_gestionBase.inc.php';
 $pdo = gestionnaireDeConnexion();
   
session_start();

   if (isset($_SESSION['login'])) {
    $codeReservation = $_SESSION["codeReservation"];
    $numTypeContainer = $_POST["numTypeContainer"];
    $quantite = $_POST["qteReserver"];
    var_dump($_POST);
    $sql = "INSERT INTO reserver(codeReservation, numTypeContainer , qteReserver) VALUES ('$codeReservation', '$numTypeContainer','$quantite') ";
    $pdo->exec($sql);
        header("location:_saisirLigneDeReservation.php");
}else{
    header("location:connexion.php");
}



