<?php include_once '_head.inc.php';
?>

<main class="form-signin" style="margin-top:10%;">
    <form action="traitement.php" method="POST">
        <?php
        
        if (isset($_GET['verif_err'])) {
            $err = htmlspecialchars($_GET['verif_err']);

            switch ($err) {
                case 'email_already':
                    ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> pas de compte avec cette adresse mail
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

        <p style="text-align: center;">Entrer votre adresse mail:</p>

        <div class="form-floating">
            <input type="email" class="form-control" name="verificationMail" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Entrer votre adresse mail:</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" name="validerVerifiction" type="submit">vérifier mon mail</button>
        <p style="text-align: center;">&copy; 2017–2022</p>
    </form>
    <a  href='inscription.php'><button>inscription</button></a>
</main>

<?php include_once '_footer.inc.php'; ?> 