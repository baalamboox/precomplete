<?php
    /*  Como las respuestas en el maquetado es son con NAME por cada conjunto de respuestas
        de cada pregunta individual, de la forma r + #  (r1, r2, ..., r#)
        entonces numero_respuesta sera el auxiliar para ir revisando la respuesta de cada pregunta   
    */

    //le agregue el session xq yaku no lo puso
session_start();

$numero_respuesta = 1; 

  //ok
$opcion_para_vacios = 'x';

  //ok
$numero_aciertos = 0;

  //ok
$respuestaUss= array();

  //ok
$resExamen= array('a','c','d','c','b','b','b','b','a','e','e','b','d','d','b','c','a','a','e','e','b','a',
                    'e','d','a','d','e','c','e','c','d','a','c','a','b','d','d','c','e','c','c','c','a','e',
                    'c','c','b','b','d','d','d','c','b','d','e','e','d','b','a','c','d','c','a','d','d','a',
                    'c','c','b','a','b','e','b','a','d','c','b','c','d','a','e','b','d','a','a','b','b','a',
                    'b','b','a','e','b','b','d','e','a','d','a','d','a','a','e','b','e','b','b','d','c','b',
                    'e','d','c','d','b','c','d','b','e','b');

//echo "".$_POST['r1'];
//print_r($_POST['r19']);

for( $i = 0 ; $i < count($resExamen) ; $i++ ){

    if(isset( $_POST['r'.$numero_respuesta])){

        array_push($respuestaUss,$_POST['r'.$numero_respuesta]);

    }else{

        array_push($respuestaUss,$opcion_para_vacios);
    }

    if($respuestaUss[$i] == $resExamen[$i]){
        
        $numero_aciertos++;  

    }

    $numero_respuesta++;
}

  //Enviando la calificacion a la base de datos

  require_once '../app/conexion.php';

  $conexion = conexion();

  $usuario =$_SESSION['usuario'];

   $query = "UPDATE usuario SET calificacion_usuario='$numero_aciertos' WHERE mail_usuario='$usuario'";
   $resultado = $conexion->query($query);
   if($resultado){

        $query22 = "UPDATE usuario SET habilitar_examen='5' WHERE mail_usuario='$usuario'";
        $resultado22 = $conexion->query($query22);
        if($resultado22){
          
          echo $numero_aciertos;
        }else{
          echo "error";
        }

    //  echo $numero_aciertos;
   }else{
     echo "error";
   }

  //  echo $numero_aciertos;
  // print_r($_SESSION['usuario']);
  // echo "".$_SESSION['usuario'];
?>