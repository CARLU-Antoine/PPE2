<!-- prépare les variables inclut dans "post" afin d'appeler la fonction "creerCompte" -->
<?php
 include_once '_gestionBase.inc.php';
 $pdo = gestionnaireDeConnexion();
        
$conadr=$_POST['adrMel'];

if (isset($_POST)) {
  
    $role = htmlspecialchars($_POST['role']);
    $raisonSociale = htmlspecialchars($_POST['raisonSociale']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $cp = htmlspecialchars($_POST['cp']);
    $ville = htmlspecialchars($_POST['ville']);
    $adrMel = htmlspecialchars($_POST['adrMel']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $contact = htmlspecialchars($_POST['contact']);
    $login = htmlspecialchars($_POST['login']);
    $mdp = htmlspecialchars($_POST['mdp']);
    $pays = htmlspecialchars($_POST['codePays']);
}
    
     
    $pdo = gestionnaireDeConnexion();
    $sql = "SELECT *, count(*) as nb FROM utilisateur "
            . " WHERE adrMel='$conadr' GROUP BY code";
    $prep = $pdo->prepare($sql);
    
    $prep->execute();
    $resultat = $prep->fetch();
         
    if ($resultat["nb"] == 1) {
 
          header("Location: connexionmauvaise.php");
        
    } else {
         $sql = "INSERT INTO utilisateur(role,raisonSociale,adresse,cp,ville,adrMel,telephone,contact,login,mdp,codePays)
	 VALUES ('$role','$raisonSociale','$adresse','$cp','$ville','$adrMel','$telephone','$contact','$login','$mdp','$pays')";
    
        $pdo->exec($sql);
        header("location:index.php");
    }
 

 ?>
         
