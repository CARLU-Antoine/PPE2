<?php include_once '_head.inc.php'; ?>

<div id="conteneur">
    <?php
    $listeConteneurs = obtenirTypeContainer();
    foreach ($listeConteneurs as $conteneurs):
        ?>
    <?php if ($conteneurs["numTypeContainer"] == 1) { ?>
            <div style="width: 18rem;">
                <img src="Image/smallDry.png" alt="Small dry conteneur">
                <div>
                    <h5 >Nom : <?php echo $conteneurs["libelleTypeContainer"] ?></h5>
                    <p >Numéro du conteneur : <?php echo $conteneurs["numTypeContainer"] ?><br>
                        Type de conteneur : <?php echo $conteneurs["codeTypeContainer"] ?><br>
                        Longueur : <?php echo $conteneurs["longueurCont"] ?><br>
                        Largeur : <?php echo $conteneurs["largeurCont"] ?><br>
                        Hauteur : <?php echo $conteneurs["hauteurCont"] ?><br>
                        Tarif : <?php echo $conteneurs["tarif"] ?><br>
                    <a href="reservation.php" class="btn btn-primary">Reserver ?</a>
                </div>
            </div>
    <?php } ?>
   
    <?php if ($conteneurs["numTypeContainer"] == 2) { ?>
            <div style="width: 18rem;">
                <img src="Image/mediumDry.png" alt="Small dry conteneur">
                <div >
                    <h5 >Nom : <?php echo $conteneurs["libelleTypeContainer"] ?></h5>
                    <p >Numéro du conteneur : <?php echo $conteneurs["numTypeContainer"] ?><br>
                        Type de conteneur : <?php echo $conteneurs["codeTypeContainer"] ?><br>
                        Longueur : <?php echo $conteneurs["longueurCont"] ?><br>
                        Largeur : <?php echo $conteneurs["largeurCont"] ?><br>
                        Hauteur : <?php echo $conteneurs["hauteurCont"] ?><br>
                        Tarif : <?php echo $conteneurs["tarif"] ?><br>
                    <a href="reservation.php" class="btn btn-primary">Reserver ?</a>
                </div>
            </div>
    <?php } ?>
 
    <?php if ($conteneurs["numTypeContainer"] == 3) { ?>
            <div style="width: 18rem;">
                <img src="Image/hightCube.png" alt="Small dry conteneur">
                <div >
                    <h5 >Nom : <?php echo $conteneurs["libelleTypeContainer"] ?></h5>
                    <p >Numéro du conteneur : <?php echo $conteneurs["numTypeContainer"] ?><br>
                        Type de conteneur : <?php echo $conteneurs["codeTypeContainer"] ?><br>
                        Longueur : <?php echo $conteneurs["longueurCont"] ?><br>
                        Largeur : <?php echo $conteneurs["largeurCont"] ?><br>
                        Hauteur : <?php echo $conteneurs["hauteurCont"] ?><br>
                        Tarif : <?php echo $conteneurs["tarif"] ?><br>
                    <a href="reservation.php" class="btn btn-primary">Reserver ?</a>
                </div>
            </div>
    <?php } ?>
      
    <?php if ($conteneurs["numTypeContainer"] == 4) { ?>
            <div style="width: 18rem;">
                <img src="Image/smallFlat.png" alt="Small dry conteneur">
                <div>
                    <h5 >Nom : <?php echo $conteneurs["libelleTypeContainer"] ?></h5>
                    <p >Numéro du conteneur : <?php echo $conteneurs["numTypeContainer"] ?><br>
                        Type de conteneur : <?php echo $conteneurs["codeTypeContainer"] ?><br>
                        Longueur : <?php echo $conteneurs["longueurCont"] ?><br>
                        Largeur : <?php echo $conteneurs["largeurCont"] ?><br>
                        Hauteur : <?php echo $conteneurs["hauteurCont"] ?><br>
                        Tarif : <?php echo $conteneurs["tarif"] ?><br>
                    <a href="reservation.php" class="btn btn-primary">Reserver ?</a>
                </div>
            </div>
    <?php } ?>
       
    <?php if ($conteneurs["numTypeContainer"] == 5) { ?>
            <div style="width: 18rem;">
                <img src="Image/mediumFlat.png" alt="Small dry conteneur">
                <div >
                   <h5 >Nom : <?php echo $conteneurs["libelleTypeContainer"] ?></h5>
                    <p >Numéro du conteneur : <?php echo $conteneurs["numTypeContainer"] ?><br>
                        Type de conteneur : <?php echo $conteneurs["codeTypeContainer"] ?><br>
                        Longueur : <?php echo $conteneurs["longueurCont"] ?><br>
                        Largeur : <?php echo $conteneurs["largeurCont"] ?><br>
                        Hauteur : <?php echo $conteneurs["hauteurCont"] ?><br>
                        Tarif : <?php echo $conteneurs["tarif"] ?><br>
                    <a href="reservation.php" class="btn btn-primary">Reserver ?</a>
                </div>
            </div>
    <?php } ?>
        
    <?php if ($conteneurs["numTypeContainer"] == 6) { ?>
            <div style="width: 18rem;">
                <img src="Image/smallOpen.png" alt="Small dry conteneur">
                <div >
                    <h5 >Nom : <?php echo $conteneurs["libelleTypeContainer"] ?></h5>
                    <p >Numéro du conteneur : <?php echo $conteneurs["numTypeContainer"] ?><br>
                        Type de conteneur : <?php echo $conteneurs["codeTypeContainer"] ?><br>
                        Longueur : <?php echo $conteneurs["longueurCont"] ?><br>
                        Largeur : <?php echo $conteneurs["largeurCont"] ?><br>
                        Hauteur : <?php echo $conteneurs["hauteurCont"] ?><br>
                        Tarif : <?php echo $conteneurs["tarif"] ?><br>
                    <a href="reservation.php" class="btn btn-primary">Reserver ?</a>
                </div>
            </div>
    <?php } ?>
       
    <?php if ($conteneurs["numTypeContainer"] == 7) { ?>
            <div style="width: 18rem;">
                <img src="Image/mediumOpen.png" alt="Small dry conteneur">
                <div >
                    <h5 >Nom : <?php echo $conteneurs["libelleTypeContainer"] ?></h5>
                    <p >Numéro du conteneur : <?php echo $conteneurs["numTypeContainer"] ?><br>
                        Type de conteneur : <?php echo $conteneurs["codeTypeContainer"] ?><br>
                        Longueur : <?php echo $conteneurs["longueurCont"] ?><br>
                        Largeur : <?php echo $conteneurs["largeurCont"] ?><br>
                        Hauteur : <?php echo $conteneurs["hauteurCont"] ?><br>
                        Tarif : <?php echo $conteneurs["tarif"] ?><br>
                    <a href="reservation.php" class="btn btn-primary">Reserver ?</a>
                </div>
            </div>
    <?php } ?>
        
    <?php if ($conteneurs["numTypeContainer"] == 8) { ?>
            <div style="width: 18rem;">
                <img src="Image/smallReefer.png" alt="Small dry conteneur">
                <div >
                   <h5 >Nom : <?php echo $conteneurs["libelleTypeContainer"] ?></h5>
                    <p >Numéro du conteneur : <?php echo $conteneurs["numTypeContainer"] ?><br>
                        Type de conteneur : <?php echo $conteneurs["codeTypeContainer"] ?><br>
                        Longueur : <?php echo $conteneurs["longueurCont"] ?><br>
                        Largeur : <?php echo $conteneurs["largeurCont"] ?><br>
                        Hauteur : <?php echo $conteneurs["hauteurCont"] ?><br>
                        Tarif : <?php echo $conteneurs["tarif"] ?><br>
                        <a href="reservation.php" class="btn btn-primary">Reserver ?</a>
                </div>
            </div>
    <?php } ?>
       
    <?php if ($conteneurs["numTypeContainer"] == 9) { ?>
            <div style="width: 18rem;">
                <img src="Image/mediumReefer.png" alt="Small dry conteneur">
                <div >
                    <h5 >Nom : <?php echo $conteneurs["libelleTypeContainer"] ?></h5>
                    <p >Numéro du conteneur : <?php echo $conteneurs["numTypeContainer"] ?><br>
                        Type de conteneur : <?php echo $conteneurs["codeTypeContainer"] ?><br>
                        Longueur : <?php echo $conteneurs["longueurCont"] ?><br>
                        Largeur : <?php echo $conteneurs["largeurCont"] ?><br>
                        Hauteur : <?php echo $conteneurs["hauteurCont"] ?><br>
                        Tarif : <?php echo $conteneurs["tarif"] ?><br>
                    <a href="reservation.php" class="btn btn-primary">Reserver ?</a>
                </div>
            </div>
    <?php } ?>
        

<?php endforeach; ?>
    
</div>

 <?php include_once '_footer.inc.php';

