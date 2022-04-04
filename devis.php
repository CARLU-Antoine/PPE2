<?php
include_once '_head.inc.php';

$collectionDevis=listeDevis();
?>
<div id="formulaire-Affichage-Reservation" >
    <table class="table">
        <thead class="thead-dark">        
            <tr style="background-color: black; color:white;">       
                <td ><strong>code devis</strong></td>
                <td><strong>La date du devis</strong></td>
                <td><strong>Le montant du devis</strong></td>       
                <td><strong>le volume</strong></td> 
                <td><strong>le nombre de containers</strong></td>
                <td><strong>Téléchargement</strong></td>
            </tr>
        </thead>
        <?php
        foreach ($collectionDevis as $lesDevis) :
            ?>
            <tr>
                <td><?php echo $lesDevis["codeDevis"]; ?></td>
                <td> <?php echo $lesDevis["dateDevis"]; ?></td>
                <td><?php echo $lesDevis["montantDevis"];echo' €';?></td>
                <td><?php echo $lesDevis["volume"]; ?></td>
                <td><?php echo $lesDevis["nbcontainers"]; ?></td>
                <td><a href='pdfDevis.php?codeDevis=<?php echo $lesDevis["codeDevis"];?>'><button class="btn btn-secondary" >télécharger</button></a></td>
                <?php endforeach; ?>
        </tr>
    </table>
</div>
<?php
include_once '_footer.inc.php';

