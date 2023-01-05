<?php

  session_start();

  $id_ruta=$_SESSION['usuario'];

  function valida_curp($archivo){

    if ($archivo) {
      
      if($archivo['size'] < (1000*1024)){

        if($archivo['name'] ==  "curp.pdf"){

          $nombre_original = $archivo['name'];
        
          if (strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION)) == 'pdf') {
            
            return "ok";

          }else{

            return "Extensión invalida";

          }

        }else{

          return "No es el nombre correcto";

        }

      }else{

        return "Pasa el 1MB permitido";

      }

    }else{

      return "No existe el archivo";

    }

  }
  function valida_acta($archivo){

    if ($archivo) {
      
      if($archivo['size'] < (1000*1024)){

        if($archivo['name'] == "acta.pdf"){

          $nombre_original = $archivo['name'];
        
          if (strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION)) == 'pdf') {
            
            return "ok";

          }else{

            return "Extensión invalida";

          }

        }else{

          return "No es el nombre correcto";

        }

      }else{

        return "Pasa el 1MB permitido";

      }

    }else{

      return "No existe el archivo";

    }

  }
  function valida_constancia($archivo){

    if ($archivo) {
      
      if($archivo['size'] < (1000*1024)){

        if($archivo['name'] == "constancia.pdf"){

          $nombre_original = $archivo['name'];
        
          if (strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION)) == 'pdf') {
            
            return "ok";

          }else{

            return "Extensión invalida";

          }

        }else{

          return "No es el nombre correcto";

        }

      }else{

        return "Pasa el 1MB permitido";

      }

    }else{

      return "No existe el archivo";

    }

  }
  function valida_pago($archivo){

    if ($archivo) {
      
      if($archivo['size'] < (1000*1024)){

        if($archivo['name'] == "pago.pdf"){

          $nombre_original = $archivo['name'];
        
          if (strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION)) == 'pdf') {
            
            return "ok";

          }else{

            return "Extensión invalida";

          }

        }else{

          return "No es el nombre correcto";

        }

      }else{

        return "Pasa el 1MB permitido";

      }

    }else{

      return "No existe el archivo";

    }

  }

/**
 *  1 -> nombre del input tipo file
 *  2 -> nombre temporal del archivo cargado en el input
 * 
 *   //                  1       2  
*    $pdf_curp=$_FILES['pdf_curp']['tmp_name'];
 * 
 */

  //print_r($pdf_curp.'<br>'.$pdf_acta.'\n'.$pdf_constancia.'\n'.$pdf_pago); //se reciben correctamente los 4 documentos

  //estad dos imprimen exactamente lo mismo por lo cual si son equivalentes
  //print_r($_FILES['pdf_curp']['tmp_name']); //C:\xampp\tmp\phpB526.tmp
  //print_r($pdf_curp);  //C:\xampp\tmp\phpB526.tmp
/*

// esto lo usaba para regresar muchos datos a la vez

  $resultado_total = array(

    'resultado_curp' => 'ok',
    'resultado_acta' => 'ok',
    'resultado_constancia' => 'ok',
    'resultado_pago' => 'ok'

  );
*/
  if($_POST['pdf'] == "curp"){

    //print_r('Dentro del IF');
    echo valida_curp($_FILES['pdf_curp']);

  }else if($_POST['pdf'] == "acta"){

    //print_r('Dentro del IF');
    echo valida_acta($_FILES['pdf_acta']);

  }else if($_POST['pdf'] == "constancia"){

    //print_r('Dentro del IF');
    echo valida_constancia($_FILES['pdf_constancia']);

  }else if($_POST['pdf'] == "pago"){

    //print_r('Dentro del IF');
    echo valida_pago($_FILES['pdf_pago']);

  }

/*
  $bandera_curp = validar_archivo($_FILES['pdf_curp']);
  $bandera_acta = validar_archivo($_FILES['pdf_acta']);
  $bandera_constancia = validar_archivo($_FILES['pdf_constancia']);
  $bandera_pago = validar_archivo($_FILES['pdf_pago']);


  $resultado_total['resultado_curp' ]=$bandera_curp;
  $resultado_total['resultado_acta']=$bandera_acta;
  $resultado_total['resultado_constancia' ]=$bandera_constancia;
  $resultado_total['resultado_pago']=$bandera_pago;

  echo json_encode($resultado_total, JSON_FORCE_OBJECT);
*/
/*
  print_r($_FILES['pdf_curp']);
  print_r($_FILES['pdf_acta']);
  print_r($_FILES['pdf_constancia']);
  print_r($_FILES['pdf_pago']);
  print_r($_POST['pdf']);
*/
?>