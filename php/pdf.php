<?php 
	require_once '../app/fpdf/fpdf.php';
	require_once '../app/conexion.php';

	$conexion = conexion();
    
  // $server = 'localhost';
	// $ussername = 'root';
	// $password = '';
	// $database = 'tecmilpa_preregistro';

	// try {
	// 	$conexion = new PDO("mysql:host=$server;dbname=$database;",$ussername,$password);
	// } catch (PDOException $e) {
	// 	die('Connected falied: '.$getMessage());		
	// }
   
class PDF extends FPDF{

	function Header(){
 
	    // Logos
	    // Tipo de fuente: Arial bold 12 
	    // Título
	    $this->SetFont('Arial','B',16);//PERMITE DEFINIR EL TIPO DE LETRA EFECTO Y TAMAÑO. ESTE SE APLICA A TODO LO QUE LE SIGA.
	    $this->SetTextColor(0,0,0);//PERMITE ASIGNAR UN COLOR AL TEXTO EN FORMATO RBG, TAMBIEN SE APLICA A TODO LO QUE LE SIGA
	    $this->SetY(10); //posicion en Y 
	    $this->SetX(135); //pisicon en X
	    $this->Cell(30,5,utf8_decode('Sistema de Preinscripción'),0,1,'C'); //celda titulo
	    /*PRIMER VALOR LARGO DE LA CELDA
	      SEGUNDO VALOR ALTO DE LA CELDA
	      FORMARTO DE CODIFICACION PARA PERMITIR ACENTOS ETC.
	      PERMITE ASIGNAR UN BORDE A LA CELDA
	      GENERA UN SALTO DE LINEA
	      PERMITE CENTRAR EL CONTENIDO DE LA CELDA
	    */
	    $this->Ln(10);// Salto de línea
	}

	//FUNCION Pie de página
	function Footer(){
	    // Posición: a 1,5 cm del final
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Número de página
	    $this->Cell(0,10,utf8_decode('Pagína ').$this->PageNo().'/{nb}',0,0,'C');
	}
}
	
	// Creación del objeto de la clase heredada
    $pdf = new PDF('L','mm','A4');
	$pdf->AliasNbPages();//permite añadir pie de pagina
    $pdf->AddPage(); //añade pagina
    

	$pdf->SetFillColor(27,57,106);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(15,10,'Ficha',1,0,'C',true);
	$pdf->Cell(40,10,'Nombre',1,0,'C',true);
	$pdf->Cell(35,10,'Apellido Paterno',1,0,'C',true);
	$pdf->Cell(35,10,'Apellido Materno',1,0,'C',true);
	$pdf->Cell(30,10,'F. Nacimiento',1,0,'C',true);
	$pdf->Cell(30,10,'Telefono',1,0,'C',true);
	$pdf->Cell(18,10,'Carrera',1,0,'C',true);
	$pdf->Cell(65,10,'email',1,0,'C',true);
	$pdf->Cell(10,10,'Cal',1,1,'C',true);

	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('Arial','',10);    
	foreach ($conexion->query("SELECT * from usuario WHERE rol=0") as $dato){
		$pdf->Cell(15,10,''.$dato['id_usuario'],1,0,'C');
		if(strlen($dato['nombre_usuario']) > 14){
			$pdf->SetFont('Arial','',8);  
			$pdf->Cell(40,10,''.$dato['nombre_usuario'],1,0,'C');
		}else{
			$pdf->Cell(40,10,''.$dato['nombre_usuario'],1,0,'C');
		}
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(35,10,''.$dato['paterno_usuario'],1,0,'C');
		$pdf->Cell(35,10,''.$dato['materno_usuario'],1,0,'C');
		$pdf->Cell(30,10,''.$dato['fecha_nacimiento_usuario'],1,0,'C');
		$pdf->Cell(30,10,''.$dato['telefono_usuario'],1,0,'C');
		$pdf->Cell(18,10,''.$dato['carrera_usuario'],1,0,'C');
		$pdf->Cell(65,10,''.$dato['mail_usuario'],1,0,'C');
		$pdf->Cell(10,10,''.$dato['calificacion_usuario'],1,1,'C');
	}
	


	//$pdf->MultiCell(181,5,'');
	$pdf->Ln(10);

	/*$pdf->SetFillColor(1,93,153);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(30,6,'texto prueba',1,0,'C',true);
	$pdf->Cell(30,6,'texto prueba2',1,1,'C',true);*/



	$pdf->Output('I', 'informe.pdf'); //cierre del documento PDF


 ?>