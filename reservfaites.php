<?php
include_once '_head.inc.php';

$codeReservationRecherche = $_POST["recherche"];
$collectionReservation = listeRerservation($codeReservationRecherche);
?>
<div id="formulaire-Affichage-Reservation" >
    <form action="reservfaites.php" method="POST" id="form_réservation">
        <?php
        if (isset($_GET['remove_reservation_err'])) {
            $err = htmlspecialchars($_GET['remove_reservation_err']);

            switch ($err) {
                case 'ligne_supprimée':
                    ?>
                    <div class="alert alert-success">
                        <strong>Succès</strong> réservation supprimée !  
                    </div>
                    <?php
                    break;
                case 'modifier_Reservation':
                    ?>
                    <div class="alert alert-success">
                        <strong>Succès</strong> réservation modifiée !  
                    </div>
                    <?php
            }
        }
        ?>
        <b>Recherche du code de reservation:</b>
        <div>
            <input style="width: 80%" type="search" placeholder="Saisir un code réservation..." name="recherche">
            <a href="reservfaites.php"><button>Rechercher</button></a>
        </div>
    </form>
    <table class="table">
        <thead class="thead-dark">        
            <tr style="background-color: black; color:white;">       
                <td ><strong>code réservation</strong></td>
                <td><strong>La date de début de votre réservation</strong></td>
                <td><strong>La date de fin de votre réservation</strong></td>       
                <td><strong>le volume</strong></td> 
                <td><strong>Ville d'arrivé</strong></td>
                <td><strong>type de containers</strong></td>
                <td><strong>quantité de containers</strong></td>   
                <td><strong>état de votre réservation</strong></td>
                <td><strong>Supprimer réservation</strong></td>
                <td><strong>Modifier</strong></td>
            </tr>
        </thead>
        <?php
        foreach ($collectionReservation as $lesReservations) :
            ?>
            <tr>
                <td><?php echo $lesReservations["codeReservation"]; ?></td>
                <td> <?php echo $lesReservations["dateDebutReservation"]; ?></td>
                <td><?php echo $lesReservations["datefinReservation"]; ?></td>
                <td><?php echo $lesReservations["volumeEstime"]; ?></td>
                <td><?php echo $lesReservations["nomVille"]; ?></td>
                <td><?php echo $lesReservations["libelleTypeContainer"]; ?></td>
                <td><?php echo $lesReservations["qteReserver"]; ?></td>
                <td><?php echo $lesReservations["etat"]; ?></td>
                <td><a href='supprimerReservationLigne.php?code=<?php echo $lesReservations["codeReservation"]; ?>'><button class="btn btn-outline-danger" >Supprimer</button></a></td>
                <td><a href='modifierReservation.php?codeReservation=<?php echo $lesReservations["codeReservation"];$_SESSION['codeReservationModifier']=$lesReservations["codeReservation"]?>'><button class="btn btn-secondary" >Modifier</button></a></td>
            <?php endforeach; ?>
        </tr>
    </table>
</div>
<?php
include_once '_footer.inc.php';

