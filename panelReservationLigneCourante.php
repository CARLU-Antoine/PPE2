<?php
include_once '_head.inc.php';

$codeReservationModifier = $_SESSION['codeReservationModifier'];

$collectionListeLigneReservationModifier = listeLigneRerservationModifierCourante($codeReservationModifier);
?>

<div id="formulaire-Affichage-Reservation" >
<table class="table">
    <thead class="thead-dark">        
        <tr style="background-color: black; color:white;">       
            <td ><strong>code réservation</strong></td>
            <td><strong>type de containers</strong></td>
            <td><strong>quantité de containers</strong></td>
            <td><strong>modifier ligne</strong></td>  
        </tr>
    </thead>
    <?php
    foreach ($collectionListeLigneReservationModifier as $lesReservations) :
        ?>
        <tr>
            <td><?php echo $lesReservations["codeReservation"]; ?></td>
            <td><?php echo $lesReservations["libelleTypeContainer"]; ?></td>
            <td><?php echo $lesReservations["qteReserver"]; ?></td>
            <td><a href='modifierLigneCouranteModif.php?codeModifUdpate=<?php echo $lesReservations["code"]; ?>'><button class="btn btn-outline-secondary" target="_blank" >modifier ligne</button></a></td>
        <?php endforeach; ?>
    </tr>
</table>
<a href='reservfaites.php?remove_reservation_err=modifier_Reservation'><button class="btn btn-secondary" >finir la modification</button></a>
 </div>