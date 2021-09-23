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

function obtenirTypeContainer() {
    $choix=$_SESSION['codeDuree'];
    $pdo = gestionnaireDeConnexion();
    $req = "select * from typeContainer,tarificationContainer WHERE typeContainer.numTypeContainer=tarificationContainer.numTypeContainer AND codeDuree='$choix'";
    $pdoStatement = $pdo->query($req);
    $lesContainers = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $lesContainers;
}


/* fonction de récupérer la liste des conteneurs dans la base de données sous forme de tableau */

function listeConteneurs() {
    $lesConteneurs = array();
    $pdo = gestionnaireDeConnexion();
    if ($pdo != NULL) {
        $req = "SELECT * FROM tarificationContainer,typeContainer WHERE tarificationContainer.numTypeContainer=typeContainer.numTypeContainer ORDER by tarificationContainer.numTypeContainer";
        $pdoStatement = $pdo->query($req);
        $lesConteneurs = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    return $lesConteneurs;
}
/* fonction de récupérer la liste des conteneurs dans la base de données sous forme de tableau */

function listeConteneursDevis() {
    $lesInfosDevis = array();
    $pdo = gestionnaireDeConnexion();
    if ($pdo != NULL) {
        $req = "SELECT * from typeContainer ORDER by numTypeContainer";
        $pdoStatement = $pdo->query($req);
        $lesInfosDevis = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    return $lesInfosDevis;
}

/* fonction de récupérer la liste des paramètre de l'utilisateur connecté dans la base de données sous forme de tableau */
function listeSetting() {
    
    $lesSetting = array();
    $pdo = gestionnaireDeConnexion();
    if (isset($_SESSION['login'])) {
        $con=$_SESSION['login'];
        $req = "SELECT * FROM utilisateur where login='$con'";
        $pdoStatement = $pdo->query($req);
        $lesSetting = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    return $lesSetting;
}
/* fonction de récupérer la liste des Devis de l'utilisateur connecté dans la base de données sous forme de tableau */
function listeDevis() {
    $lesDevis=array();
    $pdo = gestionnaireDeConnexion();
     if (isset($_SESSION['login'])) {
         $req = "SELECT * FROM devis ";
        $pdoStatement = $pdo->query($req);
        $lesDevis = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    return $lesDevis;
}
    
//fonction permettant d'obtenir le pays
function obtenirPays() {
    $pdo = gestionnaireDeConnexion();
    $req = "select * from pays";
    $pdoStatement = $pdo->query($req);
    $pays= $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $pays;
}

//fonction permettant d'obtenir la ville
function obtenirVille() {
    $pdo = gestionnaireDeConnexion();
    $req = "select * from ville ";
    $pdoStatement = $pdo->query($req);
    $ville= $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $ville;
}

function listeRerservation() {
    $lesReservations = array();
    $pdo = gestionnaireDeConnexion();
    if ($pdo != NULL) {
        $ses=$_SESSION['login'];
        
        $req = "SELECT * FROM reservation,reserver,utilisateur,typeContainer,ville"
                . " WHERE reservation.codeReservation=reserver.codeReservation and reservation.codeUtilisateur=utilisateur.code"
                . " and reserver.numTypeContainer=typeContainer.numTypeContainer and reservation.codeVilleRendre=ville.codeVille and login='$ses'";
        $pdoStatement = $pdo->query($req);
        $lesReservations = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    return $lesReservations;
}

function listeRerservationCourante() {
  
    $lesReservations = array();
    $pdo = gestionnaireDeConnexion();
    if ($pdo != NULL) {
        $choix=$_SESSION['codeDuree'];
        $codeReservation=$_SESSION["codeReservation"];
        $req = "SELECT nomVille,volumeEstime,dateDebutReservation,datefinReservation,qteReserver, tarif,libelleTypeContainer,codeDuree,(qteReserver)*(tarif) as qtarif"
               . " FROM reservation,reserver,tarificationContainer,typeContainer,ville WHERE reserver.numTypeContainer=tarificationContainer.numTypeContainer"
               . " and reservation.codeReservation=reserver.codeReservation and tarificationContainer.numTypeContainer=typeContainer.numTypeContainer and reservation.codeVilleRendre=ville.codeVille"
               . " and codeDuree='$choix'and reservation.codeReservation='$codeReservation'";
        $pdoStatement = $pdo->query($req);
        $lesReservations = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    return $lesReservations;
}


function infosDevis(){
           $infosDevis= array();
    $pdo = gestionnaireDeConnexion();
    if ($pdo != NULL) {
        $req = "SELECT * FROM devis ORDER BY codeDevis DESC LIMIT  1";
        $pdoStatement = $pdo->query($req);
        $infosDevis = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    return $infosDevis;  
}

function creerDevis($dateDebutDevis,$volume,$nbContainers){ 
             
    if (isset($_POST['nbcontainers']) && isset($_POST['volume'])){
        session_start();
        $pdo = gestionnaireDeConnexion();
        
          $sql= "SELECT codeDevis FROM devis ORDER BY codeDevis DESC LIMIT  1";
              $prepa = $pdo->prepare($sql);
              $prepa->execute();
             $resultata = $prepa->fetch();
            
             $codeDevis=$_SESSION["codeDevis"]=$resultata['codeDevis'];
             
             $liba=$_SESSION['numTypeContainer'];
             $sqla= "SELECT libelleTypeContainer,numTypeContainer from typeContainer WHERE numTypeContainer=$liba";
              $prepaz = $pdo->prepare($sqla);
              $prepaz->execute();
             $resultataz = $prepaz->fetch();
             $libelle=$_SESSION["libelleTypeContainer"]=$resultataz['libelleTypeContainer'];

        $reqa = "INSERT INTO devis(dateDevis,volume,nbcontainers)
	 VALUES ('$dateDebutDevis','$volume','$nbContainers')";
    $pdo->exec($reqa);

    
    }
}

//fonctions permettant de faire une réservation

function AjouterUneReservation($dateDebutReservation, $dateFinReservation, $volumeEstime, $codeVilleMiseDisposition, $codeVilleRendre,$etat,$code){
     if (isset($_POST['volumeEstime'])){
      
    $pdo = gestionnaireDeConnexion() ;
    $sql = "INSERT INTO reservation(dateDebutReservation, dateFinReservation, volumeEstime, codeVilleMiseDisposition, codeVilleRendre, etat,codeUtilisateur) 
	 VALUES ('$dateDebutReservation', '$dateFinReservation', '$volumeEstime', '$codeVilleMiseDisposition', '$codeVilleRendre', '$etat',$code) ";

    $pdo->exec($sql);
    header("location:_saisirLigneDeReservation.php");
     }
}

function AjouterLigneDeReservation($codeReservation, $numTypeContainer,$quantite){
     if (isset($_POST["qteReserver"])){
         session_start();
     $pdo = gestionnaireDeConnexion() ;
     $sql = "INSERT INTO reserver(codeReservation, numTypeContainer , qteReserver) VALUES ('$codeReservation', '$numTypeContainer','$quantite') ";
    $pdo->exec($sql);
      header("location:_saisirLigneDeReservation.php");
    }
}

function VerificationAdrMel($test){
    if (isset($_POST["mailtest"])){
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
    else{
        header("Location: connexionmauvaise.php");
    $prep->closeCursor();
        }

    }
}

function modifierMDP($newmdp,$pseudo){
    if (isset($_GET["newmdp"])){
    
$pdo = gestionnaireDeConnexion();
$sql = "UPDATE utilisateur SET mdp= '$newmdp' where adrMel= '$pseudo' ";
echo $sql;
$pdo->exec($sql);

    }
    
}

function connexion($conlogin,$conmdp){
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
    header("Location: connexionmauvaise.php");
    $prep->closeCursor();
    }   
  }

}

function ajouterUtilisateur($role,$raisonSociale,$adresse,$cp,$ville,$adrMel,$telephone,$contact,$login,$mdp,$pays){
    if (isset($_POST['contact']) && isset($_POST['role'])){
 
    $pdo = gestionnaireDeConnexion();
    $sql = "SELECT *, count(*) as nb FROM utilisateur "
            . " WHERE adrMel='$adrMel' GROUP BY code";
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
  }
}




