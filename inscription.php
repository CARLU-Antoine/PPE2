<?php
include_once '_head.inc.php';
$collectionPays = obtenirPays();
?>


<div class="col-md-7 col-lg-8">
    <h4 style="position: absolute;top: 70%; left: 50%; transform: translate(-50%, -1000%);">Inscription</h4>
    <form style=" position: absolute;top: 80%; left: 50%; transform: translate(-50%, -20%);" class="needs-validation" novalidate action="traitement.php" method="POST">
        <?php
        if (isset($_GET['reg_err'])) {
            $err = htmlspecialchars($_GET['reg_err']);

            switch ($err) {
                case 'success':
                    ?>
                    <div class="alert alert-success">
                        <strong>Succès</strong> inscription réussie !
                    </div>
                    <?php
                    break;

                case 'password':
                    ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> mot de passe différent
                    </div>
                    <?php
                    break;

                case 'email':
                    ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> email non valide
                    </div>
                    <?php
                    break;

                case 'email_length':
                    ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> email trop court
                    </div>
                    <?php
                    break;

                case 'pseudo_length':
                    ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> pseudo trop court
                    </div>
                    <?php
                    break;
                case 'email_already':
                    ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> compte deja existant avec cet email
                    </div>
                    <?php
                    break;
                case 'login_already':
                    ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> compte deja existant avec cet identifiant
                    </div>
                    <?php
                    break;
                    case 'password_length':
                    ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> mot de passe trop court (10 caractères minimum)
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
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="mdp" placeholder="mot de passe">

            </div>
            <div class="col-12">
                <label for="address2" class="form-label">Confirmation mot de passe</label>
                <input type="password" class="form-control" name="mdpConfirmation" placeholder="mot de passe">

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

            <button class="w-100 btn btn-primary btn-lg" type="submit" name="validerInscription">Inscription</button>
    </form>
</div>
</div>
<?php include_once '_footer.inc.php'; ?>