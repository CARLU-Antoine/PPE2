<?php
include_once '_head.inc.php';



$codeReservationSupprimer = $_GET['code'];

//Appel à la fonction pour supprimer une reservation pendant la réservation

supprimerReservation($codeReservationSupprimer);



