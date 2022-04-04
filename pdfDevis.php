<?php
include_once '_gestionBase.inc.php';
require('fpdf.php');
session_start();
$pdo = gestionnaireDeConnexion();

$collectionSetting = listeSetting();

$codeDevisCourante=$_GET['codeDevis'];

$collectionDevisCourante=listeDevisCourante($codeDevisCourante);

$codeReserv= "select reservation.codeReservation from reservation,devis where reservation.codeDevis=devis.codeDevis and devis.codeDevis='$codeDevisCourante'";
$prep = $pdo->prepare($codeReserv);
$prep->execute();
$resultat = $prep->fetch();
$codeStocke = $resultat['codeReservation'];


$dateRequete= "select dateDebutReservation,dateFinReservation from reservation,devis where devis.codeDevis='$codeDevisCourante' and reservation.codeReservation='$codeStocke'";
$prepaDate = $pdo->prepare($dateRequete);
$prepaDate->execute();
$dateStocke = $prepaDate->fetch();

$dateDebutReservation = $dateStocke['dateDebutReservation'];
$dateFinReservation = $dateStocke['dateFinReservation'];




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


    foreach ($collectionSetting as $user) :
    $pdf->Cell(120, 5, '01 30 60 20 38', 0, 0);
    $pdf->Cell(50, 5, 'Numero client', 0, 0);
    $pdf->Cell(34, 5, $user["code"], 0, 1); //end of line
endforeach;
    $pdf->Cell(120, 5, '', 0, 0);
    $pdf->Cell(50, 5, 'Date debut reservation', 0, 0);
    $pdf->Cell(34, 5, $dateDebutReservation, 0, 1); //end of line

    $pdf->Cell(120, 5, '', 0, 0);
    $pdf->Cell(50, 5, 'Date fin reservation', 0, 0);
    $pdf->Cell(34, 5, $dateFinReservation, 0, 1); //end of line

//make a dummy empty cell as a vertical spacer
    $pdf->Cell(189, 10, '', 0, 1); //end of line

    foreach ($collectionSetting as $user) :
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

$pdf->Cell(60, 5, '', 0, 0);
$pdf->Cell(17, 5, 'Volume', 1, 0);
$pdf->Cell(34, 5, 'quantite', 1, 0);
$pdf->Cell(83, 5, 'Description', 1, 1); //end of line

$pdf->SetFont('Arial', '', 12);

//Numbers are right-aligned so we give 'R' after new line parameter
foreach ($collectionDevisCourante as $infosDevis) :
    $pdf->Cell(60, 5, '', 0, 0);  
    $pdf->Cell(17, 5, $infosDevis["volumeEstime"], 1, 0);
    $pdf->Cell(34, 5, $infosDevis["qteReserver"], 1, 0);
    $pdf->Cell(83, 5, $infosDevis["libelleTypeContainer"], 1, 1, 'R'); //end of line
endforeach;
//summary
foreach ($collectionDevisCourante as $infosDevis) :
$pdf->Cell(125, 5, '', 0, 0);
$pdf->Cell(35, 5, 'Montant (Euros)', 0, 0);
$pdf->Cell(34, 5,$infosDevis["montantDevis"], 1, 1, 'R'); //end of line

$pdf->Output("devis $codeDevisCourante.pdf",'D');

endforeach;
