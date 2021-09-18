<?php

include_once '_gestionBase.inc.php';
session_start();
$pdo = gestionnaireDeConnexion();


$ses=$_SESSION['login'];

if (isset($_SESSION['login'])) {
$dateDevis = date('d-m-Y');

$nbContainers= $_POST["nbcontainers"];
$_SESSION['nbcontainers'] = $nbContainers;
$volume= $_POST["volume"];

$sql = "INSERT INTO devis(dateDevis,volume,nbcontainers)
	 VALUES ('$dateDevis','$volume','$nbContainers')";
    $pdo->exec($sql);
    
    header('location:devispdf.php');
    
}else{
    header('location:connexion.php');
}