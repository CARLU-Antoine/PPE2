<?php
include_once '_head.inc.php';

$pdo = gestionnaireDeConnexion();
$collectionTypeContainer = obtenirTypeContainer();
$collectionReservationCourante = listeRerservationCourante();


$choix = $_SESSION['codeDuree'];

//Récupération du nombre de ligne de réservation pour la réservation courante afin de l'afficher
$codeReservation = $_SESSION["codeReservation"];
$req = "SELECT count(*) as nbReservation"
        . " FROM reservation,reserver,tarificationContainer,typeContainer,ville WHERE reserver.numTypeContainer=tarificationContainer.numTypeContainer"
        . " and reservation.codeReservation=reserver.codeReservation and tarificationContainer.numTypeContainer=typeContainer.numTypeContainer and reservation.codeVilleRendre=ville.codeVille"
        . " and codeDuree='$choix'and reservation.codeReservation='$codeReservation'";
$prep = $pdo->prepare($req);
$prep->execute();
$resultat = $prep->fetch();
$nbCOntainerAffichage = $resultat['nbReservation'];
?>
<div class="container">
    <main>
        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Votre réservation</span>
                    <span class="badge bg-primary rounded-pill"><?php echo $nbCOntainerAffichage ?></span>
                </h4>
                <?php
                //affichage des détails de la réservation courante
                foreach ($collectionReservationCourante as $infos) :
                    ?>

                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Type containers</h6>
                                <small class="text-muted"><?php echo $infos["libelleTypeContainer"]; ?></small>
                            </div>
                            <span class="text-muted"><?php echo $infos["tarif"]; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Quantité</h6>
                                <small class="text-muted"><?php echo $infos["qteReserver"]; ?></small>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div>
                                <h6 class="my-0">Tarif Total</h6>
                                <small class="text-muted"><?php echo $infos["qtarif"]; ?></small>
                            </div>
                             <a href='supprimerReservationCourante.php?code=<?php echo $infos["code"]; ?>'><button class="btn btn-outline-danger" >Supprimer</button></a>
                        </li>
                    <?php endforeach; ?>
                    <?php
                    //Retourner le montant total de la réservation courante
                    $collectionMontantTotal = obtenirMontantTotal();
                    foreach ($collectionMontantTotal as $montant):
                        ?>
                        <li style="color:#9a1515;"class="list-group-item d-flex justify-content-between bg-light">
                            <span>Total (€)</span>
                            <strong>€<?php echo $montant["montantTotal"]; ?></strong>
                        <?php endforeach; ?>
                    </li>
                </ul>
            </div>
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Finaliser votre réservation</h4>
                <form class="needs-validation" novalidate action="traitement.php" method="post">
                                        <?php
                    if (isset($_GET['remove_ligne_reservation_err'])) {
                        $err = htmlspecialchars($_GET['remove_ligne_reservation_err']);

                        switch ($err) {
                            case 'success':
                                ?>
                                <div class="alert alert-success">
                                    <strong>Succès</strong> Ligne de réservation supprimée !
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
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">Type de container</label>
                            <select class="form-select" name="numTypeContainer">
                                <?php
                                foreach ($collectionTypeContainer as $typeContainer):
                                    ?>
                                    <option value="<?php echo $typeContainer["numTypeContainer"]; ?>">
                                        <?php echo $typeContainer["libelleTypeContainer"]; ?>
                                        <?php echo $typeContainer["tarif"]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div style="margin-top:-0.5%;"class="col-md-3">
                            <label for="zip" class="form-label">Quantité</label>
                            <input type="text" class="form-control" placeholder="Quantité" name="qteReserver" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="state" class="form-label">Choisir votre abonnement</label>

                        <select class="form-select" name="codeDuree">
                            <option value="<?php echo($choix); ?>"><?php echo($choix);?></option>
                            <option value="Jour">Jours</option>
                            <option value="Trimestre">Trimestre</option>
                            <option value="Annee">Année</option>
                        </select>
                        <a href="_saisirLigneDeReservation.php"><button class="btn btn-secondary">choisir </button></a>
                    </div>

                    <hr class="my-4">

                    <button class="w-100 btn btn-primary btn-lg" type="submit">Ajouter ligne de réservation</button>
                </form>
                <a href="pdfreserv.php" ><button class="btn btn-outline-secondary">Télécharger PDF</button></a>
            </div>
        </div>
    </main>
</div>
<?php
include_once '_footer.inc.php';
