<?php
include_once '_head.inc.php';
?>
<main class="form-signin" style="margin-top:10%;">
    <form action="traitement.php" method="POST">
        <?php
        if (isset($_GET['modif_err'])) {
            $err = htmlspecialchars($_GET['modif_err']);

            switch ($err) {
                case 'success':
                    ?>
                    <div class="alert alert-success">
                        <strong>Succès</strong> modification réussite !
                    </div>
                    <?php
                    break;
                case 'password_longueur':
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

        <p style="text-align: center;">Modifier votre mot de passe</p>
        <div class="form-floating">
            <input type="password" class="form-control" name="mdp" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">mot de passe</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" name="validerModifierMdp" type="submit">CONNEXION</button>
        <p style="text-align: center;">&copy; 2017–2022</p>
    </form>
    <a  href='inscription.php'><button>inscription</button></a>
</main>

<?php include_once '_footer.inc.php'; ?>