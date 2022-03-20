<?php

require('fpdf.php');
include_once '_gestionBase.inc.php';
session_start();
$pdo = gestionnaireDeConnexion();

$collectionSetting = listeSetting();
$collectionMontantTotal = obtenirMontantTotal();
$collectionReservationCourante = listeRerservationCourante();

$dateDebutReservation = date('d-m-Y');
$dateFinReservation = date('d-m-Y', strtotime('+10 days'));
$choix = $_SESSION['codeDuree'];
$codeReservation = $_SESSION["codeReservation"];

$req = "select SUM(qteReserver) as 'code' from reserver where codeReservation=$codeReservation";
$prep = $pdo->prepare($req);
$prep->execute();
$resultat = $prep->fetch();
$nbContainers = $resultat['code'];


$sql = "select volumeEstime from reservation ORDER by codeReservation DESC LIMIT 1 ";
$prepa = $pdo->prepare($sql);
$prepa->execute();
$resultata = $prepa->fetch();
$volume = $resultata['volumeEstime'];

$reqa = "SELECT codeReservation,SUM(qteReserver*tarif) as 'montantTotal' FROM reserver,tarificationContainer WHERE reserver.numTypeContainer=tarificationContainer.numTypeContainer "
      . "and reserver.codeReservation=$codeReservation and tarificationContainer.codeDuree='$choix' GROUP by codeReservation";
$prepaz = $pdo->prepare($reqa);
$prepaz->execute();
$resultataz = $prepaz->fetch();
$montantDevis = $resultataz['montantTotal'];



creerDevis($dateDebutReservation,$montantDevis,$volume, $nbContainers);

foreach ($collectionSetting as $user) :

    class PDF extends FPDF {

// En-tête
        function Header() {
            // Logo
            $this->Image('Image/tholdi.png', 10, 6, 24);
            // Police Arial gras 15
            $this->SetFont('Arial', 'B', 15);
            // Décalage à droite
            $this->Cell(80);
            // Titre
            $this->Cell(30, 10, 'Devis', 1, 0, 'C');
            // Saut de ligne
            $this->Ln(20);
        }

// Pied de page
        function Footer() {
            // Positionnement à 1,5 cm du bas
            $this->SetY(-15);
            // Police Arial italique 8
            $this->SetFont('Arial', 'I', 8);
            // Numéro de page
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        }

    }

// Instanciation de la classe dérivée
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 14);

//Cell(width , height , text , border , end line , [align] )

    $pdf->Cell(130, 5, 'ADRESSE', 0, 0);
    $pdf->Cell(59, 5, 'FACTURE ACHAT', 0, 1); //end of line
//set font to arial, regular, 12pt
    $pdf->SetFont('Arial', '', 12);

    $pdf->Cell(130, 5, '23 rue Bartelot', 0, 0);
    $pdf->Cell(59, 5, '', 0, 1); //end of line


    $pdf->Cell(130, 5, '78000', 0, 0);
    $pdf->Cell(40, 5, 'choix abonnement', 0, 0);
    $pdf->Cell(34, 5, $choix, 0, 1); //end of line

    $pdf->Cell(130, 5, '01 30 60 20 38', 0, 0);
    $pdf->Cell(40, 5, 'Numero client', 0, 0);
    $pdf->Cell(34, 5, $user["code"], 0, 1); //end of line

    $pdf->Cell(130, 5, '', 0, 0);
    $pdf->Cell(30, 5, 'Date', 0, 0);
    $pdf->Cell(34, 5, $dateDebutReservation, 0, 1); //end of line

    $pdf->Cell(130, 5, '', 0, 0);
    $pdf->Cell(30, 5, 'Date livraison', 0, 0);
    $pdf->Cell(34, 5, $dateFinReservation, 0, 1); //end of line
//make a dummy empty cell as a vertical spacer
    $pdf->Cell(189, 10, '', 0, 1); //end of line
//billing address
    $pdf->Cell(100, 5, 'Facturer a', 0, 1); //end of line
//add dummy cell at beginning of each line for indentation
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(90, 5, $user["contact"], 0, 1);

    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(90, 5, $user["raisonSociale"], 0, 1);

    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(90, 5, $user["adresse"], 0, 1);

    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(90, 5, $user["telephone"], 0, 1);

    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(90, 5, $user["codePays"], 0, 1);
endforeach;
//make a dummy empty cell as a vertical spacer
$pdf->Cell(189, 10, '', 0, 1); //end of line
//invoice contents
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(17, 5, 'Volume', 1, 0);
$pdf->Cell(30, 5, 'nb containers', 1, 0);
$pdf->Cell(83, 5, 'Description', 1, 0);
$pdf->Cell(30, 5, 'Prix unitaire', 1, 0);
$pdf->Cell(34, 5, 'Tarif', 1, 1); //end of line

$pdf->SetFont('Arial', '', 12);

//Numbers are right-aligned so we give 'R' after new line parameter
foreach ($collectionReservationCourante as $infos) :
    $pdf->Cell(17, 5, $infos["volumeEstime"], 1, 0);
    $pdf->Cell(30, 5, $infos["qteReserver"], 1, 0);
    $pdf->Cell(83, 5, $infos["libelleTypeContainer"], 1, 0);
    $pdf->Cell(30, 5, $infos["tarif"], 1, 0);
    $pdf->Cell(34, 5, $infos["qtarif"], 1, 1, 'R'); //end of line
endforeach;
//summary

foreach ($collectionMontantTotal as $montant):
    $pdf->Cell(135, 5, '', 0, 0);
    $pdf->Cell(25, 5, 'Montant', 0, 0);
    $pdf->Cell(4, 5, '$', 1, 0);
    $pdf->Cell(30, 5, $montant["montantTotal"], 1, 1, 'R'); //end of line
endforeach;
$pdf->Output("devis $codeReservation.pdf",'D');
