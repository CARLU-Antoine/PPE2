
<?php 
include_once '_head.inc.php';
?>
   <div id="container" >
       <form  id="formu" action="modifiermdpraitement.php" "method="POST">
                <h1>Modifier votre mot de passe</h1>
                
                <label><b>Entrer votre nouveau mot de passe:</b></label>
                <input type="password" name="newmdp" placeholder="Entrer votre nouveau mot de passe" required>

                <input type="submit" id='submit' value='Validé'>
                <a href='inscription.php'><span>inscription</span></a>
            </form>
        </div>

