<?php include_once '_head.inc.php'; 
?>
     <div id="container" >
         <form  id="formu" action="modifiertraitement.php" method="POST">
                <h1>Modifier votre mot de passe</h1>
                
                <label><b>Entrer votre adresse mail:</b></label>
                <input id="email" type="email" name="mailtest" placeholder="Entrer votre adresse mail" required>

                <input type="submit" id='submit' value='Validé'>
                <a href='inscription.php'><span>inscription</span></a>
            </form>
        </div>
 

<?php include_once '_footer.inc.php'; ?>