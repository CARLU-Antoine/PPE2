<?php include_once '_head.inc.php'; 




?>

        <div id="container" >
            <form  id="formu" action="connexion.php" method="POST">
                  <?php
   $conlogin=$_POST["login"];
   $conmdp=$_POST["mdp"];
  
    if (isset($_POST["login"]) && isset($_POST["mdp"])){
    $pdo = gestionnaireDeConnexion();
    $sql = "SELECT *, count(*) as nb FROM utilisateur "
            . " WHERE LOGIN='$conlogin' AND MDP='$conmdp' GROUP BY code";
    $prep = $pdo->prepare($sql);


    $prep->execute();
    $resultat = $prep->fetch();
 
    if ($resultat["nb"] == 1) {
        $nom = $_POST['login'];
        $_SESSION['login'] = $nom;
          header("Location:index.php");
        
    }
    else{
        echo 'mauvais login ou mot de passe';
    $prep->closeCursor();
    }
    }
    ?>
    
                <h1>Connexion</h1>
                
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" name="login" placeholder="Entrer le nom d'utilisateur" required>

                <label><b>Mot de passe</b></label>
                <input type="password" name="mdp" placeholder="Entrer le mot de passe" required>

                <input type="submit" id='submit' value='LOGIN'>
                
                
                <a href='modifier.php'><span>mot de passe oublié?</span></a>

                <a href='inscription.php'><span>inscription</span></a>
            </form>
        </div>

<?php include_once '_footer.inc.php'; ?>
