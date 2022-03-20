<?php
include_once '_head.inc.php';
session_start();
?>


<div class="col-md-7 col-lg-8">
    <h3 style="position: absolute;top: 75%; left: 50%; transform: translate(-50%, -1000%);">Réaliser votre réservation</h3>
    <form style=" position: absolute;top: 50%; left: 50%; transform: translate(-50%, -20%);" class="needs-validation" novalidate action="traitement.php" method="POST">

        <div class="col-12">
            <label for="address" class="form-label">Volume </label>
            <input type="text" class="form-control" name="volumeEstime" placeholder="Saisir le volume..." required>
        </div>

        <?php
        $pdo = gestionnaireDeConnexion();
        $collectionVilles = obtenirVille();
        ?>
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

            <div class="col-md-5">
                <label for="country" class="form-label">état</label>
                <select class="form-select" id="country" name="etat" required>
                    <option value="encours">en cours</option>
                    <option value="arrêté">arrêté</option>
                    <option value="validé">validé</option>
                </select>
            </div>
                    <hr class="my-4">
            <button style="margin-top: 5%;"class="w-100 btn btn-primary btn-lg" type="submit" name="valider">Inscription</button>

    </form>
</div>
<?php
include_once '_footer.inc.php';
