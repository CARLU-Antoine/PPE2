<?php
session_start();
include_once '_head.inc.php';

$pdo = gestionnaireDeConnexion();
$codeReservationRecherche = $_POST["recherche"];
$collectionReservation = listeRerservation($codeReservationRecherche);
?>
<div id="formulaire-Affichage-Reservation" >
    <form action="reservfaites.php" method="POST" id="form_réservation">
        <b>Recherche du code de reservation:</b>
        <div>
            <input style="width: 80%" type="search" placeholder="Saisir un code réservation..." name="recherche">
            <a href="reservfaites.php"><button>Rechercher</button></a>
        </div>
    </form>
    <center> <h1>Vos Réservations:</h1></center>
    <div class="tableau-Reservation">
        <table border="3">        
            <tr>       
                <td ><strong>code réservation</strong></td>
                <td><strong>La date de début de votre réservation</strong></td>
                <td><strong>La date de fin de votre réservation</strong></td>       
                <td><strong>le volume</strong></td> 
                <td><strong>Ville d'arrivé</strong></td>
                <td><strong>type de containers</strong></td>
                <td><strong>quantité de containers</strong></td>   
                <td><strong>état de votre réservation</strong></td>     
            </tr>
            <?php
            foreach ($collectionReservation as $lesReservations) :
                ?>
                <tr>
                    <td><?php echo $lesReservations["codeReservation"]; ?></td>
                    <td> <?php
                        echo $lesReservations["dateDebutReservation"];
                        ;
                        ?></td>
                    <td><?php echo $lesReservations["datefinReservation"]; ?></td>
                    <td><?php echo $lesReservations["volumeEstime"]; ?></td>
                    <td><?php echo $lesReservations["nomVille"]; ?></td>
                    <td><?php echo $lesReservations["libelleTypeContainer"]; ?></td>
                    <td><?php echo $lesReservations["qteReserver"]; ?></td>
                    <td><?php echo $lesReservations["etat"]; ?></td>
                <?php endforeach; ?>
            </tr>
        </table>
    </div>
</div>
<?php
include_once '_footer.inc.php';

