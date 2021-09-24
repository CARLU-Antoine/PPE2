<?php include_once '_head.inc.php'; 
 session_start();
  $pdo = gestionnaireDeConnexion() ;
        
        $collectionVilles = obtenirVille();
        $collectioninfosDevis = listeConteneursDevis();

?>

<h1 id="titre-devis"><center>Réaliser votre devis</center></h1>
<div id="formulaire" margin-top:1% >
    <form action="pdf.php" method="post" id="form_réservation">
            
            <div>
            nombre de containers:
            <input type="text" name="nbcontainers">
            </div>
            
            <div>
            Volume:
            <input type="text" name="volume">
            </div>
            
            <div>
            choix d'abonnement:
            <select name="codeDuree">
            <option value="JOUR">Jours</option>
            <option value="TRIMESTRE">Trimestre</option>
            <option value="ANNEE">Année</option>
            </select>
            </div>

    Type Container 
    <select name="numTypeContainer">
        <?php
        foreach ($collectioninfosDevis as $typeContainer):
            ?>

            <option value="<?php echo $typeContainer["numTypeContainer"]; ?>">
                <?php echo $typeContainer["libelleTypeContainer"]; ?>
            </option>

        <?php endforeach; ?>
    </select>      
            <div>
            
            ville de départ:
            <select name="codeVilleMiseDisposition">
                <?php
                foreach ($collectionVilles as $ville) :
                    ?>
                    <option <?php echo $ville["codeVille"]; ?>">
                        <?php echo $ville["nomVille"]; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            </div>
            
            <div>
             ville d'arrivé:
            <select name="codeVilleRendre">
                <?php
                foreach ($collectionVilles as $ville) :
                    ?>
                    <option value="<?php echo $ville["codeVille"]; ?>">
                        <?php echo $ville["nomVille"]; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            </div>
            

          <input type="submit" value="valider">
</div>

    <div class="container">
<table width=100% border="2" align="center" cellpadding="1">
<tr>
<td rowspan=3><center>TYPE CONTAINER</center></td>
<td rowspan=2><center>TAILLE</center></td>
<td  width=56% colspan=3><center>TARIF</center></td>
<tr>
<td width=11%><center>JOUR</center></td>
<td><center>TRIMESTRE</center></td>
<td width=23%><center>ANNUEL</center></td>
</tr> 
</table>
</div>
  
     


<div class="container">
<table width=100% border="2" align="center" cellpadding="1">        
<tr>       
<td width=29%>Classique</td>
<td width=15% rowspan=5><center>20’ x 8’ x 8’6’’ </center></td>
<td width=11%>8 €</td>       
<td>585 €  (6.50 €/J)</td> 
<td>1260 €  (3.50 €/J)</td>      
    
 </tr>

 <tr>       
 <td>frigorifique</td> 
 <td>11 €</td>      
 <td>765 €  (8.50 €/J)</td> 
 <td>2190 €  (6 €/J)</td>   
    
 </tr>
  <tr>       
 <td>Tank</td>       
 <td>9.50 €</td>
 <td>630 €  (7 €/J)</td>
 <td>2160 €  (5 €/J)</td>    
   
 </tr>
 <tr>       
 <td>Toit ouvert</td>     
 <td>9 €</td>      
 <td>585 €  (6.50 €/J)</td>
 <td>1620 €  (4.50 €/J)</td>     
 </tr>

 <tr> 
 <td>Plat-Rack</td>     
 <td>9 €</td>      
 <td>585 €  (6.50 €/J)</td>
 <td>1620 €  (4.50 €/J)</td>   
     
 </tr>
 </table>
</div>

 
<div class="container">
<table width=100% border="2" align="center" cellpadding="1">        
<tr>       
<td width=29% >Classique</td>
<td width=15% rowspan=5><center>40’ x 8’ x 8’6’’</center></td>
<td>9.25 €</td>   
<td>623.70 € (6.93 €/J)</td>       
<td>1663.20 € (4.62 €/J)</td>       
    
 </tr> 
 <tr>       
 <td>frigorifique</td>
<td>14 €</td>    
 <td>990 € (11 €/J)</td>      
 <td>3510 € (9.75 €/J)</td>     
    
 </tr>
  <tr>       
 <td>Tank</td>          
 <td>11 €</td>
 <td>810 € (9 €/J)</td>
 <td>2520 € (7 €/J)</td>
      
 </tr>

 <tr>       
 <td>Toit ouvert</td>     
 <td>10 €</td>      
 <td>765 € (8.50 €/J)</td> 
 <td>2700 € (7.50 €/J)</td>     
 </tr>

 <tr> 
 <td>Plat-Rack</td>      
 <td>10 €</td>      
 <td>765 € (8.50 €/J)</td>
 <td>2700 € (7.50 €/J)</td>   
     
 </tr>
 
 </table>
</div>

<div class="container">
 <table width=100% border="2" align="center" cellpadding="1" >

<tr>       
<td width=29% >Classique</td>
<td width=15% rowspan=3><center>40’ x 8’ x 9’6’’</center></td>
<td>10 €</td>   
<td>765 € (8.50 €/J)</td>       
<td>2700 € (7.50 €/J)</td>       
    
</tr> 
<tr>       
<td>frigorifique</td>
<td>15 €</td>    
<td>1080 € (12 €/J)</td>      
<td>3600 € (10 €/J)</td>     
    
 </tr>
  <tr>       
 <td>Tank</td>          
 <td>12 €</td>
 <td>900 € (10 €/J)</td>
 <td>2880 € (8 €/J)</td>
  </tr>
  
</table>
</div>
<?php include_once '_footer.inc.php';



