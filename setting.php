<?php
include_once '_head.inc.php';

$pdo = gestionnaireDeConnexion();

$collectionSetting = listeSetting();
?>
<div id="formulaire-setting" >
    <strong  style="text-align: center;padding: 15%;">Vos informations personnelles:</strong>
    <hr></hr>
<?php
foreach ($collectionSetting as $user) :
    ?>
        <p>votre pseudo: <?php echo $user["login"]; ?></p>
        <p>votre adresse mail: <?php echo $user["adrMel"]; ?></p>
        <p>votre raison sociale: <?php echo $user["raisonSociale"]; ?></p>
        <p>votre adresse: <?php echo $user["adresse"]; ?></p>
        <p>votre Code postale: <?php echo $user["cp"]; ?></p>
        <p>votre Ville: <?php echo $user["ville"]; ?></p>
        <p>votre numéro de téléphone: <?php echo $user["telephone"]; ?></p>
        <p>votre contact: <?php echo $user["contact"]; ?></p>
        <p>votre Pays: <?php echo $user["codePays"]; ?></p>

<?php endforeach; ?>
    <hr></hr>
</div>
