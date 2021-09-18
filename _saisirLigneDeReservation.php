<?php
include_once '_gestionBase.inc.php';
include_once '_head.inc.php';
session_start();
?>
<?php
$pdo = gestionnaireDeConnexion();

$collectionTypeContainer = obtenirTypeContainer();
?>
<h1 id="titre"><center>Finaliser votre réservation </center></h1>
<form id ="formulaire" action="_saisirLigneDeReservation.traitement.php" method="post">

    Type Container 
    <select name="numTypeContainer">
        <?php
        foreach ($collectionTypeContainer as $typeContainer):
            ?>

            <option value="<?php echo $typeContainer["numTypeContainer"]; ?>">
                <?php echo $typeContainer["libelleTypeContainer"]; ?>
            </option>

        <?php endforeach; ?>
    </select>



    quantité:
    <input type="text" name="qteReserver">


    <input type="submit" value="Ajouter une ligne de reservation" >


</form>

<a href="index.php">finaliser votre réservation</a>
<div>
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
                        
                       
       
                <?php endforeach; ?>
        </div>

