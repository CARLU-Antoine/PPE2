<?php
include_once '_gestionBase.inc.php';
include_once '_head.inc.php';
session_start();

$pdo = gestionnaireDeConnexion();
$collectionTypeContainer = obtenirTypeContainer();

?>
<h1 id="titre"><center>Finaliser votre réservation </center></h1>
<form id ="formulaire" action="traitement.php" method="post">

    Type Container 
    <select name="numTypeContainer">
        <?php
        foreach ($collectionTypeContainer as $typeContainer):
            ?>
            <option value="<?php echo $typeContainer["numTypeContainer"]; ?>">
                <?php echo $typeContainer["libelleTypeContainer"]; ?>
                <?php echo $typeContainer["tarif"]; ?>
            </option>
        <?php endforeach; ?>
    </select>



    quantité:
    <input type="text" name="qteReserver">
            <div>
            choix d'abonnement:
            <select name="codeDuree">
            <option value="JOUR">Jours</option>
            <option value="TRIMESTRE">Trimestre</option>
            <option value="ANNEE">Année</option>
            </select>
            <a type="button" href="_saisirLigneDeReservation.php"><button>choisir votre abonnement</button></a>
            </div>

            

    <input type="submit" value="Ajouter une ligne de reservation" >
    
      


</form>

<a href="index.php">finaliser votre réservation</a>
<div id="formul-reserv" >
                <strong>Vos Réservations:</strong>
                <?php
                $collectionReservationCourante = listeRerservationCourante();
                
                foreach ($collectionReservationCourante as $infos) :
                    ?>
                        <p>La date de début de votre réservation: <?php echo $infos["dateDebutReservation"]; ?></p>
                        <p>La date de fin de votre réservation: <?php echo $infos["datefinReservation"]; ?></p>
                        <p>le volume : <?php echo $infos["volumeEstime"]; ?></p>
                        <p>Ville d'arrivée: <?php echo $infos["nomVille"]; ?></p>
                        <p>type de containers: <?php echo $infos["libelleTypeContainer"];?></p>
                        <p>quantité de containers: <?php echo $infos["qteReserver"];?></p>
                        <p>état de votre réservation: <?php echo $infos["etat"];?></p>
                        <p>tarif à l'unité: <?php echo $infos["tarif"];?></p>
                        <p>tarif total: <?php echo $infos["qtarif"];?></p>
                        
       
                <?php endforeach; ?>
        </div>

