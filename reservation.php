<?php
include_once '_head.inc.php';
$collectionVilles = obtenirVille();
?>


<div class="col-md-7 col-lg-8">
    <h3 style="position: absolute;top: 60%; left: 50%; transform: translate(-50%, -1000%);">Réaliser votre réservation</h3>
    <form style=" position: absolute;top: 50%; left: 50%; transform: translate(-50%, -20%);" class="needs-validation" novalidate action="traitement.php" method="POST">
  <?php

             if (isset($_GET['reserv_err'])) {
            $err = htmlspecialchars($_GET['reserv_err']);

            switch ($err) {
                    case 'ville_already':
                    ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> même ville saisie
                    </div>
                    <?php
                    break;
                case 'champs_Non_Saisie':
                    ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> un ou plusieurs champs n'ont pas était saisies
                    </div>
                <?php
            }
        }
        ?>
        <div class="col-12">
            <label for="address" class="form-label">Volume </label>
            <input type="text" class="form-control" name="volumeEstime" placeholder="Saisir le volume..." required>
        </div>
        
        <div class="col-12">
            <label for="dateDebutReservation" class="form-label">date début Reservation </label>
            <input type="date" class="form-control" name="dateDebutReservation" required>
        </div>
        
        <div class="col-12">
            <label for="dateFinReservation" class="form-label">date Fin Reservation </label>
            <input type="date" class="form-control" name="dateFinReservation" required>
        </div>
        
        <div>

            <div class="col-md-5">
                <label for="country" class="form-label">ville de départ:</label>
                <select class="form-select" id="country" name="codeVilleMiseDisposition" required>
                    <?php
                    foreach ($collectionVilles as $ville) :
                        ?>

                        <option value="<?php echo $ville["codeVille"]; ?>">
                            <?php echo $ville["nomVille"]; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-5">
                <label for="country" class="form-label">ville d'arrivé:</label>
                <select class="form-select" id="country" name="codeVilleRendre" required>
                    <?php
                    foreach ($collectionVilles as $ville) :
                        ?>
                        <option value="<?php echo $ville["codeVille"]; ?>">
                            <?php echo $ville["nomVille"]; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
          
            <div class="col-md-5" style="padding-top:15%;">  
            <label for="firstName" class="form-label">Choix service de fret routier</label>
                    </div>
        <input type="radio" name="choixFret" value="1"/>Oui
        <input type="radio" name="choixFret" value="0" checked>Non


            <hr class="my-4">
            <button style="margin-top: 5%;"class="w-100 btn btn-primary btn-lg" type="submit" name="validerReservation">Réserver</button>

    </form>
</div>
<?php
include_once '_footer.inc.php';
