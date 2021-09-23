<?php include_once '_head.inc.php'; ?>

<?php
include_once '_gestionBase.inc.php';         
        
        $pdo = gestionnaireDeConnexion() ;
        
        $collectionPays = obtenirPays();
        
 
        
        ?>

<div id="container">
    
                            
            <form id="formu"action="traitement.php" method="POST">
            <h1>Inscription</h1>
                
                <div>
                <label>role de l'entreprise:</label>
                <input type="text" class="form-control" name="role" placeholder="role" required>
                </div>
                
                <div>
                <label>raison Sociale:</label>
                <input type="text" class="form-control" name="raisonSociale" placeholder="raison sociale" required>
                </div>
                
                <div>
                <label>adresse </label>
                <input type="text" class="form-control" name="adresse" placeholder="adresse"required>
                </div>
                
                <div>
                <label>code postal :</label>
                <input type="text" class="form-control" name="cp" placeholder="code postal" required>
                </div>
                
                <div>
                <label>ville:</label>
                <input type="text" class="form-control" name="ville" placeholder="ville" required>
                </div>
                
                <div>
                <label>adresse mail :</label>
                <input id="email" type="email" class="form-control" name="adrMel" placeholder="adrMail" required>
                </div>
                <div>
                <label>telephone:</label>
                <input type="text" class="form-control" name="telephone" placeholder="telephone" required>
                </div>
                
                <div>
                <label>contact:</label>
                <input type="text" class="form-control" name="contact" placeholder="contact" required>
                </div>
                
                <div>
                <label>login:</label>
                <input type="text" class="form-control" name="login" placeholder="login"required>
                </div>
                
                <div>
                <label>Mot de passe :</label>
                <input type="password" class="form-control" name="mdp" placeholder="Mdp" required>
                </div>
                
                <div>
                 Pays:
                <select name="codePays">
                <?php
                foreach ($collectionPays as $pays) :
                    ?>
                    <option value="<?php echo $pays["codePays"]; ?>">
                        <?php echo $pays["nomPays"]; ?>
                    </option>
                <?php endforeach; ?>
            </select>
                </div>

            <input class="btn btn-primary" type="submit"/>
            
            </form>
</div>


<?php include_once '_footer.inc.php'; ?>