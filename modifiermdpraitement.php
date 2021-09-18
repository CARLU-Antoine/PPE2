<?php
session_start();
include_once '_gestionBase.inc.php';  

$pseudo=$_SESSION['mailtest'];
$newmdp= $_GET['newmdp'];
echo $pseudo;
$pdo = gestionnaireDeConnexion();

$sql = "UPDATE utilisateur SET mdp= '$newmdp' where adrMel= '$pseudo' ";
$pdo->exec($sql);
header('location:connexion.php');

 