<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('cinema.png',10,8,14);
    // Arial bold 15
    $this->SetFont('Arial','B',13);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,utf8_decode('Reporte de las películas con mejor puntuación de IMDb'),0,0,'C');
    $this->SetFillColor(125,60,152);
    $this->SetTextColor(255,255,255);
    // Salto de línea
    $this->Ln(20);

    $this->Cell(85,10,utf8_decode('Título'), 1, 0, 'C', true);
    $this->Cell(25,10,utf8_decode('Estreno'), 1, 0, 'C', true);
    $this->Cell(30,10,'Presupuesto', 1, 0, 'C', true);
    $this->Cell(30,10,utf8_decode('Recaudación'), 1, 0, 'C', true);
    $this->Cell(20,10,utf8_decode('Puntaje'), 1, 1, 'C', true);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

require 'cn.php';
$consulta = "SELECT *FROM peliculas";
$resultado = $mysqli->query($consulta);

// Cracion del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',11);

  while($row = $resultado->fetch_assoc()){
    $pdf->Cell(85,10, utf8_decode($row['titulo']), 1, 0, 'C', 0);
    $pdf->Cell(25,10, $row['lanzamiento'], 1, 0, 'C', 0);
    $pdf->Cell(30,10, $row['presupuesto'], 1, 0, 'C', 0);
    $pdf->Cell(30,10, $row['recaudacion'], 1, 0, 'C', 0);
    $pdf->Cell(20,10, $row['score'], 1, 1, 'C', 0);
  }

$pdf->Output();
?>