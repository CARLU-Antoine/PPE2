<?php include_once '_head.inc.php'; ?>

<?php
include_once '_gestionBase.inc.php';

$pdo = gestionnaireDeConnexion();

$collectionPays = obtenirPays();
?>


<div class="col-md-7 col-lg-8">
    <h4 style="position: absolute;top: 50%; left: 50%; transform: translate(-50%, -1000%);">Inscription</h4>
    <form style=" position: absolute;top: 50%; left: 50%; transform: translate(-50%, -20%);" class="needs-validation" novalidate action="inscription.php" method="POST">
        <?php
        //création d'un compte
        $role = htmlspecialchars($_POST['role']);
        $raisonSociale = htmlspecialchars($_POST['raisonSociale']);
        $adresse = htmlspecialchars($_POST['adresse']);
        $cp = htmlspecialchars($_POST['cp']);
        $ville = htmlspecialchars($_POST['ville']);
        $adrMel = htmlspecialchars($_POST['adrMel']);
        $telephone = htmlspecialchars($_POST['telephone']);
        $contact = htmlspecialchars($_POST['contact']);
        $login = htmlspecialchars($_POST['login']);
        $mdpAvant = htmlspecialchars($_POST['mdp']);
        $pays = htmlspecialchars($_POST['codePays']);
        if (!empty($mdpAvant)) {
            $mdp = md5($mdpAvant);
        }



        if (isset($_POST['valider'])) {
            $pdo = gestionnaireDeConnexion();
            $sql = "SELECT *, count(*) as nb FROM utilisateur "
                    . " WHERE adrMel='$adrMel' or login='$login' GROUP BY code";
            $prep = $pdo->prepare($sql);

            $prep->execute();
            $resultat = $prep->fetch();


            if ($resultat["nb"] == 1) {
                ?><div class="alert alert-danger" role="alert">un compte est déjà inscrit avec ses paramètres</div><?php
            } else if (!empty($role) && !empty($raisonSociale) && !empty($adresse) && !empty($cp) && !empty($ville) && !empty($adrMel) && !empty($telephone) && !empty($contact) && !empty($login) && !empty($mdpAvant) && !empty($pays)) {
                $sql = "INSERT INTO utilisateur(role,raisonSociale,adresse,cp,ville,adrMel,telephone,contact,login,mdp,codePays)
	 VALUES ('$role','$raisonSociale','$adresse','$cp','$ville','$adrMel','$telephone','$contact','$login','$mdp','$pays')";
                $pdo->exec($sql);
                header("location:connexion.php");
            } else {
                ?><div class="alert alert-danger" role="alert">un ou plusieurs champs sont imcomplet</div><?php
            }
        }
        ?>
        <div class="row g-3">
            <div class="col-sm-6">
                <label for="firstName" class="form-label">Rôle de l'entreprise</label>
                <input type="text" class="form-control" name="role" id="firstName" placeholder="rôle" required>
            </div>

            <div class="col-sm-6">
                <label for="lastName" class="form-label">Raison sociale</label>
                <input type="text" class="form-control" name="raisonSociale" id="lastName" placeholder="Raison sociale" required>
            </div>
            <div class="col-sm-6">
                <label for="firstName" class="form-label">adresse</label>
                <input type="text" class="form-control" name="adresse" id="firstName" placeholder="adresse" required>
            </div>
            <div class="col-sm-6">
                <label for="firstName" class="form-label">code Postale</label>
                <input type="text" class="form-control" name="cp" id="firstName" placeholder="code Postale" required>

            </div>
            <div class="col-sm-6">
                <label for="firstName" class="form-label">Ville</label>
                <input type="text" class="form-control" name="ville" id="firstName" placeholder="Ville"  required>
            </div>

            <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control"  name="adrMel" placeholder="you@example.com">
            </div>
            <div class="col-12">
                <label for="firstname" class="form-label">Téléphone</label>
                <input type="tel" class="form-control" name="telephone" placeholder="Téléphone">
            </div>
            <div class="col-12">
                <label for="address" class="form-label">Contact</label>
                <input type="text" class="form-control" name="contact" placeholder="Contact" required>
            </div>

            <div class="col-12">
                <label for="username" class="form-label">Identifiant</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">@</span>
                    <input type="text" class="form-control" name="login" placeholder="Identifiant" required>
                </div>
            </div>

            <div class="col-12">
                <label for="address2" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="mdp" placeholder="mot de passe">

            </div>

            <div class="col-md-5">
                <label for="country" class="form-label">Pays</label>
                <select class="form-select" name="codePays" required>
                    <?php
                    foreach ($collectionPays as $pays) :
                        ?>
                        <option value="<?php echo $pays["codePays"]; ?>">
                            <?php echo $pays["nomPays"]; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button class="w-100 btn btn-primary btn-lg" type="submit" name="valider">Inscription</button>
    </form>
</div>
</div>
<?php include_once '_footer.inc.php'; ?>