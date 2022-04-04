<?php

/* connexion a la base de données */


function gestionnaireDeConnexion() {
    try {
        $pdo = new PDO(
                'mysql:host=localhost;dbname=tholdi',
                'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );
    } catch (PDOException $err) {
        var_dump($err);
        die;
    }
    return $pdo;
}

/* fonction de récupérer la liste des types de contenairs dans la base de données sous forme de tableau */


function obtenirTypeContainer() {
    $choix = $_SESSION['codeDuree'];
    $pdo = gestionnaireDeConnexion();
    $req = "select * from typeContainer,tarificationContainer WHERE typeContainer.numTypeContainer=tarificationContainer.numTypeContainer AND codeDuree='$choix'";
    $pdoStatement = $pdo->query($req);
    $lesContainers = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $lesContainers;
}

function obtenirTypeContainerModif() {
    $pdo = gestionnaireDeConnexion();
    $req = "select * from typeContainer";
    $pdoStatement = $pdo->query($req);
    $typeContainerModif = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $typeContainerModif;
}

/* fonction de récupérer le montant total de la réservation courante */


function obtenirMontantTotal() {
    $choix = $_SESSION['codeDuree'];
    $codeReservation = $_SESSION["codeReservation"];

    $pdo = gestionnaireDeConnexion();
    $req = "SELECT codeReservation,SUM(qteReserver*tarif) as 'montantTotal' FROM reserver,tarificationContainer WHERE reserver.numTypeContainer=tarificationContainer.numTypeContainer "
            . "and reserver.codeReservation=$codeReservation and tarificationContainer.codeDuree='$choix' GROUP by codeReservation";
    $pdoStatement = $pdo->query($req);
    $lesContainers = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $lesContainers;
}


/* fonction de récupérer la liste des conteneurs dans la base de données sous forme de tableau en fonction du choix */


function listeConteneurs($choix) {
    $lesConteneurs = array();
    $pdo = gestionnaireDeConnexion();
    if ($pdo != NULL && !empty($choix)) {
        $req = "select * from tarificationContainer,typeContainer where tarificationContainer.numTypeContainer=typeContainer.numTypeContainer and tarificationContainer.codeDuree='$choix'";
        $pdoStatement = $pdo->query($req);
        $lesConteneurs = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    return $lesConteneurs;
}



/* fonction de récupérer la liste des paramètre de l'utilisateur connecté dans la base de données sous forme de tableau */


function listeSetting() {

    $lesSetting = array();
    $pdo = gestionnaireDeConnexion();
    if (isset($_SESSION['login'])) {
        $con = $_SESSION['login'];
        $req = "SELECT * FROM utilisateur where login='$con'";
        $pdoStatement = $pdo->query($req);
        $lesSetting = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    return $lesSetting;
}

//fonction permettant d'obtenir le pays


function obtenirPays() {
    $pdo = gestionnaireDeConnexion();
    $req = "select * from pays";
    $pdoStatement = $pdo->query($req);
    $pays = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $pays;
}

//fonction permettant d'obtenir les villes


function obtenirVille() {
    $pdo = gestionnaireDeConnexion();
    $req = "select * from ville ";
    $pdoStatement = $pdo->query($req);
    $ville = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $ville;
}


/* fonction de récupérer la liste des réservations de l'utilisateur */



function listeRerservation($codeReservationRecherche) {
    $lesReservations = array();
    $pdo = gestionnaireDeConnexion();
    $login = $_SESSION['login'];
    if (isset($_SESSION['login']) && !empty($codeReservationRecherche)) {


        $req = "SELECT * FROM reservation,reserver,utilisateur,typeContainer,ville"
                . " WHERE reservation.codeReservation=reserver.codeReservation and reservation.codeUtilisateur=utilisateur.code"
                . " and reserver.numTypeContainer=typeContainer.numTypeContainer and reservation.codeVilleRendre=ville.codeVille and reserver.codeReservation=$codeReservationRecherche and login='$login'";
        $pdoStatement = $pdo->query($req);
        $lesReservations = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    if (empty($codeReservationRecherche)) {
        $req = "SELECT *,reserver.code FROM reservation,reserver,utilisateur,typeContainer,ville"
                . " WHERE reservation.codeReservation=reserver.codeReservation and reservation.codeUtilisateur=utilisateur.code"
                . " and reserver.numTypeContainer=typeContainer.numTypeContainer and reservation.codeVilleRendre=ville.codeVille and login='$login'";
        $pdoStatement = $pdo->query($req);
        $lesReservations = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    return $lesReservations;
}

/* fonction qui permet d'afficher les lignes de réservations de la réservation courante */


function listeRerservationCourante() {

    $lesReservations = array();
    $pdo = gestionnaireDeConnexion();
    if ($pdo != NULL) {
        $choix = $_SESSION['codeDuree'];
        $codeReservation = $_SESSION["codeReservation"];
        $req = "SELECT code,nomVille,volumeEstime,dateDebutReservation,datefinReservation,qteReserver, tarif,libelleTypeContainer,codeDuree,(qteReserver)*(tarif) as qtarif"
                . " FROM reservation,reserver,tarificationContainer,typeContainer,ville WHERE reserver.numTypeContainer=tarificationContainer.numTypeContainer"
                . " and reservation.codeReservation=reserver.codeReservation and tarificationContainer.numTypeContainer=typeContainer.numTypeContainer and reservation.codeVilleRendre=ville.codeVille"
                . " and codeDuree='$choix'and reservation.codeReservation='$codeReservation'";
        $pdoStatement = $pdo->query($req);
        $lesReservations = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    return $lesReservations;
}

/* fonction pour créer un devis dans la base de donnée */


function creerDevis($dateDebutDevis, $montantDevis, $volume, $nbContainers) {

    if (isset($_SESSION['login'])) {
        $pdo = gestionnaireDeConnexion();

        $reqa = "INSERT INTO devis(dateDevis,montantDevis,volume,nbcontainers,valider)
	 VALUES ('$dateDebutDevis','$montantDevis','$volume','$nbContainers','1')";
        $pdo->exec($reqa);
    } else {
        header("location:connexion.php");
    }
}


//fonctions permettant pour récupérer le code devis de la table devis pour mettre à jours la réservation


function codeDevisRecuperation() {
    
    $pdo = gestionnaireDeConnexion();
$requeteRecupererCodeDevis = "SELECT codeDevis FROM devis ORDER BY codeDevis DESC LIMIT  1";
$prepaCodeDevis = $pdo->prepare($requeteRecupererCodeDevis); //requête préparé
$prepaCodeDevis->execute(); //excécuter la requête 
$resultatCodeDevis = $prepaCodeDevis->fetch(); //création d'un tableau a partir du résultat de la requête SQL


//Récupération des valeurs pour la ligne de réservation


$codeDevis = $resultatCodeDevis['codeDevis'];

$codeReservation = $_SESSION["codeReservation"];

 $codeDevisUpdate = "UPDATE `reservation` SET `codeDevis` = '$codeDevis' WHERE `reservation`.`codeReservation` ='$codeReservation'";
$pdo->exec($codeDevisUpdate);
}


//fonctions permettant d'afficher les devis de l'utilisateur connecté


function listeDevis(){
    $login = $_SESSION['login'];
    $pdo = gestionnaireDeConnexion();
    $code = "SELECT code FROM utilisateur WHERE login='$login'";
    $prep = $pdo->prepare($code);
    $prep->execute();
    $resultat = $prep->fetch();
    $codeUtilisateur = $resultat['code'];

    $req = "select devis.codeDevis,dateDevis,montantDevis,volume,nbcontainers from devis,reservation 
    where reservation.codeDevis=devis.codeDevis and reservation.codeUtilisateur='$codeUtilisateur'";
    $pdoStatement = $pdo->query($req);
    $devis = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $devis;
}

//fonctions permettant d'afficher les informations du devis que l'utilisateur connecté télécharge


function listeDevisCourante($codeDevisCourante){
    $pdo = gestionnaireDeConnexion();
    $req = "select * from reservation,devis,reserver,typecontainer 
    where reservation.codeDevis=devis.codeDevis and reserver.codeReservation=reservation.codeReservation 
    and reserver.numTypeContainer=typecontainer.numTypeContainer and devis.codeDevis='$codeDevisCourante'";
    
    $pdoStatement = $pdo->query($req);
    $devisCourant = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $devisCourant;
}



/// <sommaire>
    /// fonctions permettant de créer une réservation
    /// </summary>
    /// <remarques>
    /// vérification du contenue des valeurs saisies 
    /// vérification des villes identiques ou non 
    /// appel à la fonction gestionnaireDeConnexion() pour se connecter à la base de donnée
    /// déclaration de la requête SQL et exécution de celle-ci  
    /// redirection vers la page reservation pour afficher des messages d'erreurs 
    /// </remarques>
/// </sommaire>


function AjouterUneReservation($dateDebutReservation, $dateFinReservation, $volumeEstime, $codeVilleMiseDisposition, $codeVilleRendre, $etat, $code,$choixFret) {


    if (!empty($dateDebutReservation) && !empty($dateFinReservation) && !empty($volumeEstime) && !empty($codeVilleMiseDisposition) && !empty($codeVilleRendre) && !empty($etat) && !empty($code)) {
        if ($codeVilleMiseDisposition != $codeVilleRendre) { // si les villes sont identiques
            $pdo = gestionnaireDeConnexion();
            $sql = "INSERT INTO reservation(dateDebutReservation, dateFinReservation, volumeEstime, codeVilleMiseDisposition, codeVilleRendre, etat,codeUtilisateur,choixFret) 
	 VALUES ('$dateDebutReservation', '$dateFinReservation', '$volumeEstime', '$codeVilleMiseDisposition', '$codeVilleRendre', '$etat',$code,$choixFret) ";
            $pdo->exec($sql);
            header("location:_saisirLigneDeReservation.php");
        } else {
            header('Location: reservation.php?reserv_err=ville_already');
        }
    } else {
        header('Location: reservation.php?reserv_err=champs_Non_Saisie');
    }
}

//fonctions permettant d'ajouter une ligne de réservation


function AjouterLigneDeReservation($codeReservation, $numTypeContainer, $quantite) {
    if (!empty($codeReservation) && !empty($numTypeContainer) && !empty($quantite)){
    $pdo = gestionnaireDeConnexion();
    $sql = "INSERT INTO reserver(codeReservation, numTypeContainer , qteReserver) VALUES ('$codeReservation', '$numTypeContainer','$quantite') ";
    $pdo->exec($sql);
    header("location:_saisirLigneDeReservation.php");
    }
}

function supprimerLigneReservationCourante($codeReservationLigneCouranteSupprimer) {
    if (isset($_SESSION['login']) && isset($_GET['code'])) {
        $pdo = gestionnaireDeConnexion();
        $sql = "DELETE FROM `reserver` WHERE `reserver`.`code` = '$codeReservationLigneCouranteSupprimer'";
        $pdo->exec($sql);
        header('Location:_saisirLigneDeReservation.php?remove_ligne_reservation_err=success');
    } else {
        header("location:connexion.php");
    }
}

//fonctions permettant de supprimer une réservation


function supprimerReservation($codeReservationSupprimer) {
    if (isset($_SESSION['login']) && isset($_GET['code'])) {
        $pdo = gestionnaireDeConnexion();
        $sql = "DELETE FROM `reservation` WHERE `reservation`.`codeReservation` = '$codeReservationSupprimer'";
        $pdo->exec($sql);
        header('Location:reservfaites.php?remove_reservation_err=ligne_supprimée');
    } else {
        header("location:connexion.php");
    }
}

//fonctions permettant de modifier une reservation


function modifierReservation($codeReservationModifier, $dateDebutReservation, $dateFinReservation, $volumeEstime, $codeVilleMiseDisposition, $codeVilleRendre, $etat, $codeUtilisateur) {
    if (isset($_SESSION['login']) && isset($codeReservationModifier)) {
        if (!empty($dateDebutReservation) && !empty($dateFinReservation) && !empty($volumeEstime) && !empty($codeVilleMiseDisposition) && !empty($codeVilleRendre) && !empty($etat) && !empty($codeUtilisateur)) {
            if ($codeVilleMiseDisposition != $codeVilleRendre) { // si les villes sont identiques
                $pdo = gestionnaireDeConnexion();
                $sql = "UPDATE `reservation` SET `dateDebutReservation` = '$dateDebutReservation', `datefinReservation` = '$dateFinReservation', "
                        . "`volumeEstime` = '$volumeEstime', `codeVilleMiseDisposition` = '$codeVilleMiseDisposition', `codeVilleRendre` = '$codeVilleRendre', `codeUtilisateur` = '$codeUtilisateur',"
                        . " `etat` = '$etat' WHERE `reservation`.`codeReservation` = $codeReservationModifier;";
                $pdo->exec($sql);
                header("Location:panelReservationLigneCourante.php");
            } else {
                header('Location:modifierReservation.php?reserv_modif_err=ville_already');
            }
        } else {
            header('Location:modifierReservation.php?reserv_modif_err=champs_Non_Saisie');
        }
    } else {
        header("location:connexion.php");
    }
}

//fonctions permettant de modifier une reservation


function modifierLigneReservation($codeReservationLigneModifier, $numTypeContainer, $quantite) {
    if (isset($_SESSION['login']) && isset($codeReservationLigneModifier)) {
        $pdo = gestionnaireDeConnexion();
        $sql = "UPDATE `reserver` SET `numTypeContainer` = '$numTypeContainer', `qteReserver` = '$quantite' WHERE `reserver`.`code` = '$codeReservationLigneModifier'";
        $pdo->exec($sql);
        header("location:panelReservationLigneCourante.php");
    } else {
        header("location:connexion.php");
    }
}

//liste pour l'affichage pour modifier une réservation entière

function listeLigneRerservationModifierCourante($codeReservationModifier) {
    $pdo = gestionnaireDeConnexion();
    $req = "select * from reserver,reservation,typeContainer where reserver.codeReservation=reservation.codeReservation and reserver.numTypeContainer=typeContainer.numTypeContainer and reserver.codeReservation='$codeReservationModifier'";
    $pdoStatement = $pdo->query($req);
    $reservModifAffichage = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $reservModifAffichage;
}

//fonctions permettant de créer un compte 


function creerCompte($role, $raisonSociale, $adresse, $cp, $ville, $adrMel, $telephone, $contact, $login, $mdpAvant, $mdpVerification, $pays) {
    //Vérification des champs saisies

    if (!empty($role) && !empty($raisonSociale) && !empty($adresse) && !empty($cp) && !empty($ville) && !empty($adrMel) && !empty($telephone) && !empty($contact) && !empty($login) && !empty($mdpAvant) && !empty($mdpVerification) && !empty($pays)) {

        $pdo = gestionnaireDeConnexion();
        $sql = "SELECT *, count(*) as nb FROM utilisateur "
                . " WHERE adrMel='$adrMel' GROUP BY code";
        $prep = $pdo->prepare($sql);
        $prep->execute();
        $resultat = $prep->fetch();


        $req = "SELECT *, count(*) as nb FROM utilisateur "
                . " WHERE login='$login' GROUP BY code";
        $prepa = $pdo->prepare($req);
        $prepa->execute();
        $resultata = $prepa->fetch();


//Vérification compte déjà inscrit
        if ($resultat["nb"] == 0) {
            if ($resultata["nb"] == 0) {

                //Vérification compte déjà inscrit
                //Vérification des valeurs saisies

                if (strlen($login) >= 4) { // On verifie que la longueur du pseudo => 4
                    if (strlen($adrMel) >= 10) { // On verifie que la longueur du mail >= 10
                        if (filter_var($adrMel, FILTER_VALIDATE_EMAIL)) { // Si l'email est de la bonne forme
                            if (strlen($mdpAvant) >= 10) { // On verifie que la longueur du mot de passe >=10
                                if ($mdpAvant === $mdpVerification) { // si les deux mdp saisis sont bon
                                    $mdp = password_hash($mdpAvant, PASSWORD_BCRYPT, ["cost" => 14]);
                                    $sql = "INSERT INTO utilisateur(role,raisonSociale,adresse,cp,ville,adrMel,telephone,contact,login,mdp,codePays)
                                        VALUES ('$role','$raisonSociale','$adresse','$cp','$ville','$adrMel','$telephone','$contact','$login','$mdp','$pays')";
                                    $pdo->exec($sql);
                                    header('Location:inscription.php?reg_err=success');

                                    //Redirection en cas d'erreur
                                } else {
                                    header('Location: inscription.php?reg_err=password');
                                }
                            } else {
                                header('Location: inscription.php?reg_err=password_length');
                            }
                        } else {
                            header('Location: inscription.php?reg_err=email');
                        }
                    } else {
                        header('Location: inscription.php?reg_err=email_length');
                    }
                } else {
                    header('Location: inscription.php?reg_err=pseudo_length');
                }
            } else {
                header('Location: inscription.php?reg_err=login_already');
            }
        } else {
            header('Location: inscription.php?reg_err=email_already');
        }
    } else {
        header('Location: inscription.php?reg_err=champs_Non_Saisie');
    }
}
function connexion($conlogin,$conmdp){
    if (!empty($conlogin) && !empty($conmdp)) {
    $pdo = gestionnaireDeConnexion();

    $sql = "SELECT mdp from utilisateur WHERE LOGIN='$conlogin'";
    $prep = $pdo->prepare($sql);
    $prep->execute();
    $resultat = $prep->fetch();
    $cryptageMdp = $resultat["mdp"];
    $verifCryptage = password_verify($conmdp, $cryptageMdp);
    
    

    if ($verifCryptage == true) {
        $req = "SELECT count(*) as nb FROM utilisateur "
                . " WHERE LOGIN='$conlogin'and mdp='$cryptageMdp'";
        var_dump($req);
        $prepa = $pdo->prepare($req);
        $prepa->execute();
        $resultata = $prepa->fetch();

        if ($resultata["nb"] == 1) {

            $nom = $_POST['login'];
            $_SESSION['login'] = $nom;
            header("location:index.php");
        }
    }else{
        header('Location: connexion.php?con_err=non_connecté');
    }
} else {
        header('Location: connexion.php?con_err=champs_Non_Saisie');
    }
}

//fonctions permettant d'ajouter une ligne de réservation


function verificationAdresseEmail($verificationAdresseMail) {
    if (!empty($verificationAdresseMail)) {
        $pdo = gestionnaireDeConnexion();
        $sql = "SELECT count(*) as nb FROM utilisateur "
                . " WHERE adrMel='$verificationAdresseMail'";
        $prep = $pdo->prepare($sql);
        $prep->execute();
        $resultat = $prep->fetch();

        if ($resultat["nb"] == 1) {
            $_SESSION['mailVerification'] = $verificationAdresseMail;
            header("Location:modifierMdp.php");
        } else {
            header('Location: verification.php?verif_err=email_already');
        }
    } else {
        header('Location: verification.php?verif_err=champs_Non_Saisie');
    }
}

//fonctions permettant de modifier le mot de passe de l'utilisateur



function modifierMotDePasse($ancienMdp) {
    if (!empty($ancienMdp)) {
        if (strlen($ancienMdp) >= 10) { // On verifie que la longueur du mot de passe >=10
            $pdo = gestionnaireDeConnexion();
            $newMdp = password_hash($ancienMdp, PASSWORD_BCRYPT, ["cost" => 14]);
            $email = $_SESSION['mailVerification'];
            $sql = "UPDATE utilisateur SET mdp= '$newMdp' where adrMel= '$email' ";
            $pdo->exec($sql);
            header('Location:modifierMdp.php?modif_err=success');
        } else {
            header('Location:modifierMdp.php?modif_err=password_longueur');
        }
    } else {
        header('Location: modifierMdp.php?modif_err=champs_Non_Saisie');
    }
}
