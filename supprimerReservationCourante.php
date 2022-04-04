<?php
include_once '_head.inc.php';



$codeReservationLigneCouranteSupprimer = $_GET['code'];



//Appel à la fonction pour supprimer une reservation

supprimerLigneReservationCourante($codeReservationLigneCouranteSupprimer);
