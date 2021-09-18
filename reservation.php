<?php include_once '_head.inc.php';
session_start();?>

<h1 id="titre"><center>Réaliser votre réservation</center></h1>

<div id="formulaire">
	<form action="_reservation.traitement.php" method="post" id="form_réservation">
                       
            <div>
            Volume éstimé :
            <input type="text" name="volumeEstime">
            </div>
            
            
            <?php
            
        
        $pdo = gestionnaireDeConnexion() ;
        
        $collectionVilles = obtenirVille();
        
 
        
        ?>
            <div>
            
            ville de départ:
            <select name="codeVilleMiseDisposition">
                <?php
                foreach ($collectionVilles as $ville) :
                    ?>
                    <option value="<?php echo $ville["codeVille"]; ?>">
                        <?php echo $ville["nomVille"]; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            </div>
            
            <div>
             ville d'arrivé:
            <select name="codeVilleRendre">
                <?php
                foreach ($collectionVilles as $ville) :
                    ?>
                    <option value="<?php echo $ville["codeVille"]; ?>">
                        <?php echo $ville["nomVille"]; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            </div>
             
            <div>
            état:
            <select name="etat">
            <option value="encours">en cours</option>
            <option value="arrêté">arrêté</option>
            <option value="validé">validé</option>
            </select>
            </div>
            
             <input type="submit" value="valider">
                  
        </form>
</div>
<?php include_once '_footer.inc.php';