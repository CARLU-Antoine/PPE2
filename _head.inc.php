<?php include_once 'init.php'; 
include_once '_gestionBase.inc.php';
session_start();
?>

<html lang="fr">
        <head>
            <meta charset="utf-8">
            <link rel="stylesheet" href="menu.css" />
            <link rel="stylesheet" href="reservation.css" />
            <link rel="stylesheet" href="login.css" />
        </head>
             
<body>
    <header>
        <nav>
            <ul id="bas">
        <li><a href="index.php"><img src="Image/tholdi.png"/></a></li>
        <li id="bordure"><a href="index.php">ACCUEIL</a></li>
        <li id="bordure"><a href="reservation.php">RESERVATION</a></li>
        <li id="bordure"><a href="devis.php">DEVIS</a></li>
        <li id="bordure"><a href="conteneur.php">CONTENEUR</a></li>
        <?php if (isset($_SESSION['login'])) {
            ?> <li id="menu-login"><?php echo "Bienvenue ".$_SESSION['login'];?>
                <ul class="menu-déroulant">
                <li><a href="setting.php">Paramètre</a></li>
                <li><a href="reservfaites.php">Vos réservations</a></li>
                <li><a href="devisfaits.php">Vos devis</a></li>
                <li><a href="deconnexion.php">deconnexion</a></li>
                </ul>
        </li>
        <?php
         }else{
               ?> <li id="connexion"><a href="connexion.php">CONNEXI0N</a></li>
               
                   <?php
               }?> 
    </ul>
    </nav>
 </header>
    
    
<?php include_once '_footer.inc.php';?>



       
  
        