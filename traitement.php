<?php
include_once '_gestionBase.inc.php';
session_start();
$pdo = gestionnaireDeConnexion();


//Vérification pour verifier l'existence de la validation de la modification pour la réservation



if (isset($_POST['validerModifierReservation'])) {


    $dateDebutReservation = $_POST["dateDebutReservation"];
    $dateFinReservation = $_POST["dateFinReservation"];
    $volumeEstime = $_POST["volumeEstime"];
    $codeVilleMiseDisposition = $_POST["codeVilleMiseDisposition"];
    $codeVilleRendre = $_POST["codeVilleRendre"];
    $etat = $_POST["etat"];
    $login = $_SESSION['login'];
    $codeReservationModifier = $_SESSION['codeReservationModifier'];



//Récupération du code de l'utilisateur pour l'insérer dans la réservation

    $req = "SELECT code FROM utilisateur WHERE login='$login'";
    $prep = $pdo->prepare($req);
    $prep->execute();
    $resultat = $prep->fetch();
    $codeUtilisateur = $resultat['code'];



//Appel à la fonction pour modifier une reservation
    modifierReservation($codeReservationModifier, $dateDebutReservation, $dateFinReservation, $volumeEstime, $codeVilleMiseDisposition, $codeVilleRendre, $etat, $codeUtilisateur);
}




//Vérification pour verifier l'existence de la validation de la modification de la ligne courante sélectionnée



if (isset($_POST['validerModifierLigneCourante'])) {
    $codeReservationLigneModifier = $_SESSION['codeModifUdpate'];


    $numTypeContainer = $_POST["numTypeContainer"];
    $quantite = $_POST["qteReserver"];

//Appel à la fonction pour supprimer une reservation pendant la réservation

    modifierLigneReservation($codeReservationLigneModifier, $numTypeContainer, $quantite);
}



//Vérification pour verifier l'existence de la validation du mot de passe



if (isset($_POST['validerModifierMdp'])) {

    $ancienMdp = $_POST["mdp"];

//Appel à la fonction pour modifier le mot de passe

    modifierMotDePasse($ancienMdp);
}



//Vérification pour verifier l'existence de la validation de la saisie pour la vérification de l'adresse mail 



if (isset($_POST['validerVerifiction'])) {
    $verificationAdresseMail = $_POST["verificationMail"];


    verificationAdresseEmail($verificationAdresseMail);
}



//Vérification pour verifier l'existence de la validation de la saisie de la réservation


if (isset($_POST['validerReservation'])) {

    //Vérification de connexion de l'utilisateur 

    if (isset($_SESSION['login'])) {


        //Récupération des valeurs pour la réservation

        $dateDebutReservation = $_POST["dateDebutReservation"];
        $dateFinReservation = $_POST["dateFinReservation"];
        $volumeEstime = $_POST["volumeEstime"];
        $codeVilleMiseDisposition = $_POST["codeVilleMiseDisposition"];
        $codeVilleRendre = $_POST["codeVilleRendre"];
        $etat = "encours";
        $login = $_SESSION['login'];
        $choix = $_POST["codeDuree"];
        $_SESSION['codeDuree'] = $choix;

        $choixFret = $_POST["choixFret"];
        var_dump($choixFret);

        $sql = "SELECT codeReservation FROM reservation ORDER BY codeReservation DESC LIMIT  1";
        $prepa = $pdo->prepare($sql); //requête préparé
        $prepa->execute(); //excécuter la requête 
        $resultata = $prepa->fetch(); //création d'un tableau a partir du résultat de la requête SQL
        //Récupération des valeurs pour la ligne de réservation

        $codeReservation = $_SESSION["codeReservation"] = $resultata['codeReservation'];

        //Récupération du code de l'utilisateur pour l'insérer dans la réservation

        $req = "SELECT code FROM utilisateur WHERE login='$login'";
        $prep = $pdo->prepare($req);
        $prep->execute();
        $resultat = $prep->fetch();
        $code = $resultat['code'];


        //Appel à la fonction pour ajouter une réservation

        AjouterUneReservation($dateDebutReservation, $dateFinReservation, $volumeEstime, $codeVilleMiseDisposition, $codeVilleRendre, $etat, $code,$choixFret);
    } else {
        header("location:connexion.php");
    }
}





//Vérification pour verifier l'existence de la validation de la saisie pour ajouter la ligne de réservation


if (isset($_POST['codeDuree'])) { 
    
        //Vérification de connexion de l'utilisateur 

        if (isset($_SESSION['login'])) {
//Récupération du code de réservation pour identifier une réservation par rapport aux lignes de réservations 

            $sql = "SELECT codeReservation FROM reservation ORDER BY codeReservation DESC LIMIT  1";
            $prepa = $pdo->prepare($sql); //requête préparé
            $prepa->execute(); //excécuter la requête 
            $resultata = $prepa->fetch(); //création d'un tableau a partir du résultat de la requête SQL
            //Récupération des valeurs pour la ligne de réservation

            $codeReservation = $_SESSION["codeReservation"] = $resultata['codeReservation'];
            $choix = $_POST["codeDuree"];
            $_SESSION['codeDuree'] = $choix;
            $numTypeContainer = $_POST["numTypeContainer"];
            $quantite = $_POST["qteReserver"];
                header("location:_saisirLigneDeReservation.php");


            //Appel à la fonction pour ajouter une ligne de réservation

            AjouterLigneDeReservation($codeReservation, $numTypeContainer, $quantite);
        } else {
            header("location:connexion.php");
        }
}




//Vérification pour verifier l'existence de la validation de la saisie pour l'inscription


if (isset($_POST['validerInscription'])){


    $role = htmlspecialchars($_POST['role']);
$raisonSociale = htmlspecialchars($_POST['raisonSociale']);
$adresse = htmlspecialchars($_POST['adresse']);
$cp = htmlspecialchars($_POST['cp']);
$ville = htmlspecialchars($_POST['ville']);
$adrMel = htmlspecialchars($_POST['adrMel']);
$telephone = htmlspecialchars($_POST['telephone']);
$contact = htmlspecialchars($_POST['contact']);
$login = htmlspecialchars($_POST['login']);
$mdpAvant = htmlspecialchars($_POST['mdp']);
$mdpVerification = htmlspecialchars($_POST['mdpConfirmation']);
$pays = htmlspecialchars($_POST['codePays']);


//Appel à la fonction pour crééer un compte
 
creerCompte($role, $raisonSociale, $adresse, $cp, $ville, $adrMel, $telephone, $contact, $login, $mdpAvant, $mdpVerification, $pays);
}



if (isset($_POST['validerConnexion'])){
   $conlogin = $_POST["login"];
    $conmdp = $_POST["mdp"]; 
    connexion($conlogin, $conmdp);
    
}
?>