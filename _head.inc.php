<?php
include_once '_gestionBase.inc.php';
session_start();
?>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="menu.css" />
        <link rel="stylesheet" href="login.css" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>
  </body>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>
  </body>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>

<body style="  background:whitesmoke;">
        <header>
            <nav id="barre">
                <ul>
                    <li><a href="index.php"><img src="Image/tholdi.png"/></a></li>
                    <li id="bordure"><a href="index.php">ACCUEIL</a></li>
                    <li id="bordure"><a href="reservation.php">RESERVATION</a></li>
                    <li id="bordure"><a href="conteneur.php">CONTENEUR</a></li>
                        <?php if (isset($_SESSION['login'])) {
                            ?> <li class="deroulant"><?php echo "Bienvenue " . $_SESSION['login']; ?>
                            <ul class="sous">
                                <li><a href="setting.php">Paramètre</a></li>
                                <li><a href="reservfaites.php">Vos réservations</a></li>
                                <li><a href="deconnexion.php">deconnexion</a></li>
                            </ul>
                        </li>
                        <?php
                    } else {
                        ?> <li id="connexion"><a href="connexion.php">CONNEXI0N</a></li>

                        <?php }
                    ?> 
                </ul>
            </nav>
        </header>


        <?php include_once '_footer.inc.php'; ?>





