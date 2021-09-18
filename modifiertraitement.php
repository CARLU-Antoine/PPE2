<?php
session_start();
include_once '_gestionBase.inc.php'; 


$test=$_POST["mailtest"];
   

    $pdo = gestionnaireDeConnexion();
    $sql = "SELECT *, count(*) as nb FROM utilisateur "
            . " WHERE adrMel='$test' GROUP BY code";
    $prep = $pdo->prepare($sql);


    $prep->execute();
    $resultat = $prep->fetch();
 
    if ($resultat["nb"] == 1) {
        $_SESSION['mailtest'] = $test;
          header("Location:modifiermdp.php");
        
    }
    else 
    header("Location: connexionmauvaise.php");
    $prep->closeCursor();
 
?>