<?php include_once '_head.inc.php'

?>

<main class="form-signin" style="margin-top:10%;">
    <form action="modifier.php" method="POST">
        <?php  $test=$_POST["mailtest"];
    if (isset($_POST["mailtest"])) {
        $pdo = gestionnaireDeConnexion();
        $sql = "SELECT *, count(*) as nb FROM utilisateur "
                . " WHERE adrMel='$test' GROUP BY code";
        $prep = $pdo->prepare($sql);
        $prep->execute();
        $resultat = $prep->fetch();

        if ($resultat["nb"] == 1) {
            $_SESSION['mailtest'] = $test;
            header("Location:modifiermdp.php");
        } else {
                ?><div class="alert alert-danger" role="alert">mauvaise adresse mail</div><?php
        }
    }?>

        <p style="text-align: center;">Modifier votre mot de passe</p>

        <div class="form-floating">
            <input type="text" class="form-control" name="mailtest" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Entrer votre adresse mail:</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">vérifier mon mail</button>
        <p style="text-align: center;">&copy; 2017–2021</p>
    </form>
    <a  href='inscription.php'><button>inscription</button></a>
</main>

<?php include_once '_footer.inc.php'; ?>
