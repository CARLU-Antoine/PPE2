<?php include_once '_head.inc.php';
?>
<main class="form-signin" style="margin-top:10%;">
    <form action="connexion.php" method="POST">
        <?php
        //connexion de l'utilisateur
        $conlogin = $_POST["login"];
        $conmdp = $_POST["mdp"];
        $secureMdp = md5($conmdp);


        if (isset($_POST["login"]) && isset($_POST["mdp"])) {
            $pdo = gestionnaireDeConnexion();
            $sql = "SELECT *, count(*) as nb FROM utilisateur "
                    . " WHERE LOGIN='$conlogin' AND MDP='$secureMdp' GROUP BY code";
            $prep = $pdo->prepare($sql);


            $prep->execute();
            $resultat = $prep->fetch();

            if ($resultat["nb"] == 1) {
                $nom = $_POST['login'];
                $_SESSION['login'] = $nom;
                header("Location:index.php");
            } else {
                ?><div class="alert alert-danger" role="alert">mauvais login ou mot de passe</div><?php
            }
            $prep->closeCursor();
        }
        ?>

        <p style="text-align: center;">CONNEXION</p>

        <div class="form-floating">
            <input type="text" class="form-control" name="login" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Identifiant</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" name="mdp" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">mot de passe</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">CONNEXION</button>
        <p style="text-align: center;">&copy; 2017–2021</p>
    </form>
    <a href='modifier.php'><button>mot de passe oublié?</button></a>
    <a  href='inscription.php'><button>inscription</button></a>
</main>

<?php include_once '_footer.inc.php'; ?>
