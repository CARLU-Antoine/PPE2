<?php
session_start();
include_once '_head.inc.php';  

        
        $pdo = gestionnaireDeConnexion() ;
        
        $collectionDevis = listeDevis();
        
        ?>
            <div id="formul-session" >
                <strong>Vos devis:</strong>
                <?php
                foreach ($collectionDevis as $devis) :
                    ?>
                        <p>La date de votre devis: <?php echo $devis["dateDevis"]; ?></p>
                        <p>Nombre de containers: <?php echo $devis["nbcontainers"]; ?></p>
                        <p>Montant du devis: <?php echo $devis["montantDevis"]; ?></p>
       
                <?php endforeach; ?>
        </div>
<?php include_once '_footer.inc.php';