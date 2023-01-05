<?php

  require_once '../app/fpdf/fpdf.php';

  //objeto auxiliar para el manejo de FPDF
  $obj_fpdf = new FPDF();

  //NOTA IMPORTANTE -> No uses salidas de PHP como echo porque dañan todo el documento

  /**  creacion de una nueva pagina
   *  
   *  Recibe dos parametros:
   *    - Orientación [PORTRAIT, LANDSCAPE]
   *    - tamaño [A3, A4, A5, LETTER, LEGAL]
   * 
   *  Si no pasas nada toma los valores por default:
   *    - (PORTRAINT, A4)
   */

   //  AddPage(orientacion[PORTRAIT-LANDSCAPE], tamaño[A3,A4,A5,LETTER, LEGAL], rotar{180})
  $obj_fpdf->AddPage('portrait', 'letter');

  //Para agregar texto

  //Primero de manera obligatoria defino la fuente
  // SetFont(fuente[COURIER-HELVETICA-ARIAL-TIMES-SYMBOL-ZAPDINGBATS], estilo[normal(no se escribe nada), B, I, U], tamaño)
  //                (nombreFuente, estilo[normal[vacio]], tamañoFuente)
  $obj_fpdf->SetFont('Arial', '', 24);

  //Salto de linea
  $obj_fpdf->Ln();


  // Cell(ancho, largo, texto, borde, posicion_celda_siguiente[0-frente de esta | 1-en la siguiente linea], centrado)

  // ancho maximo de trabajo en letter -> 195

  //Cabeceras
  $obj_fpdf->Cell(95, 10, 'Curp', 1, 0, 'C');
  $obj_fpdf->Cell(100, 10, 'Nombre', 1, 1, 'C');
  
  // actualizacion de fuente
  $obj_fpdf->SetFont('Arial', '', 12);

  //datos
  $obj_fpdf->Cell(95, 10, 'CAME960115HMCLRN08', 1, 0, 'C');
  $obj_fpdf->Cell(100, 10, 'Enrique Calderas Martínez', 1, 1, 'C');

  //OutPut(destino[I-D-F-S], nombreArchivo, utf8)
  // Para que pueda salir al navegador el pdf
  $obj_fpdf->OutPut('D', 'reporte.pdf', true);

  //XVRRF-RRNJT-QG3RB-HH8JK-Y7XGG

  //5R7AT-L3G6V-MYTQM

?>