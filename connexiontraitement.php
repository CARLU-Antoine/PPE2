<?php
session_start();

include_once '_gestionBase.inc.php'; 


   $conlogin=$_POST["login"];
   $conmdp=$_POST["mdp"];
   

 
if (isset($_POST["login"]) && isset($_POST["mdp"]))
{
    $pdo = gestionnaireDeConnexion();
    $sql = "SELECT *, count(*) as nb FROM utilisateur "
            . " WHERE LOGIN='$conlogin' AND MDP='$conmdp' GROUP BY code";
    $prep = $pdo->prepare($sql);


    $prep->execute();
    $resultat = $prep->fetch();
 
    if ($resultat["nb"] == 1) {
        $nom = $_POST['login'];
        $_SESSION['login'] = $nom;
          header("Location:_head.inc.php");
        
    }
    else 
    header("Location: connexionmauvaise.php");
    $prep->closeCursor();
 
}   
?>