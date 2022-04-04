<?php
include_once '_head.inc.php';
$collectionTypeContainer = obtenirTypeContainerModif();

$_SESSION['codeModifUdpate']= $_GET['codeModifUdpate'];



?>

<div class="container">
    <main>
        <div class="row g-5">
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Modifier votre ligne de réservation</h4>
                <form class="needs-validation" novalidate action="traitement.php" method="post">
                    <div class = "row g-3">
                        <div class = "col-sm-6">
                            <label for = "firstName" class = "form-label">Type de container</label>
                            <select class = "form-select" name = "numTypeContainer">
                                <?php
                                foreach ($collectionTypeContainer as $typeContainer):
                                    
                                    ?>
                                    <option value="<?php echo $typeContainer["numTypeContainer"]; ?>">
                                        <?php echo $typeContainer["libelleTypeContainer"]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div style="margin-top:-0.5%;"class="col-md-3">
                            <label for="zip" class="form-label">Quantité</label>
                            <input type="text" class="form-control" placeholder="Quantité" name="qteReserver" required>
                        </div>
                    </div>


                    <hr class="my-4">

                    <button class="w-100 btn btn-primary btn-lg"  name="validerModifierLigneCourante" type="submit">Modifier ligne de réservation</button>
                </form>
            </div>
        </div>
    </main>
</div>
<?php
include_once '_footer.inc.php';












