
<?php
include_once '_head.inc.php';
?>
<main class="form-signin" style="margin-top:10%;">
    <form action="modifiermdp.php" "method="post">
        <?php
        $ancienMdp = $_GET["newmdp"];
        $newMdp = md5($ancienMdp);
        $pseudo = $_SESSION['mailtest'];
        $pdo = gestionnaireDeConnexion();
        $sql = "UPDATE utilisateur SET mdp= '$newMdp' where adrMel= '$pseudo' ";
        $pdo->exec($sql);
         
        ?>
        <p style="text-align: center;">Modifier votre mot de passe</p>

        <div class="form-floating">
            <input type="password" class="form-control" name="newmdp" id="floatingInput" placeholder="mot de passe...">
            <label for="floatingInput">Entrer votre nouveau mot de passe:</label>
        </div>

        <button class="w-100 btn btn-primary btn-lg" type="submit" name="valider">Modifier mot de passe</button>
        <p style="text-align: center;">&copy; 2017–2021</p>
    </form>
    <a  href='inscription.php'><button>inscription</button></a>
</main>

<?php include_once '_footer.inc.php'; ?>
