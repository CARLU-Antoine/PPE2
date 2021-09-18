<?php
session_start();
include_once '_head.inc.php';    
        
        $pdo = gestionnaireDeConnexion() ;
        
        $collectionReservation = listeRerservation();
        
        ?>
            <div id="formul-session" >
                <strong>Vos Réservations:</strong>
                <?php
                foreach ($collectionReservation as $lesReservations) :
                    ?>
                        <p>La date de début de votre réservation: <?php echo $lesReservations["dateDebutReservation"]; ?></p>
                        <p>La date de fin de votre réservation: <?php echo $lesReservations["datefinReservation"]; ?></p>
                        <p>le volume : <?php echo $lesReservations["volumeEstime"]; ?></p>
                        <p>Ville d'arrivé: <?php echo $lesReservations["nomVille"]; ?></p>
                        <p>type de containers: <?php echo $lesReservations["libelleTypeContainer"];?></p>
                        <p>quantité de containers: <?php echo $lesReservations["qteReserver"];?></p>
                        <p>état de votre réservation: <?php echo $lesReservations["etat"];?></p>
                        
                       
       
                <?php endforeach; ?>
        </div>
<?php include_once '_footer.inc.php';

