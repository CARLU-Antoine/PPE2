<?php include_once '_head.inc.php'; ?>


        <div id="container" >
            <form  id="formu" action="traitement.php" method="POST">
                <h1>Connexion</h1>
            </p>mauvais login ou mot de passe</p>
                
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" name="login" placeholder="Entrer le nom d'utilisateur" required>

                <label><b>Mot de passe</b></label>
                <input type="password" name="mdp" placeholder="Entrer le mot de passe" required>

                <input type="submit" id='submit' value='LOGIN'>
                
                <a href='modifier.php'><span>mot de passe oublié?</span></a>
                                
                <a href='inscription.php'><span>inscription</span></a>
            </form>
        </div>

<?php include_once '_footer.inc.php'; ?>
