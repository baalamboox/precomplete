<?php

  session_start();

  $id_ruta=$_SESSION['usuario'];

  function sube_pdf($pdf, $id_ruta){

    $directorio = '../archivo/';

/*
    print_r($pdf);
    print_r($id_ruta);
    print_r("\n");
    print_r($directorio);
    print_r("\n");
*/
  $sub_directorio = "../archivo/".$id_ruta;

    if(!file_exists($sub_directorio)){

      /**
       * mkdir construye directorios fisicos
       * 1st param -> path a crear
       * 2nd param -> privilegios del directorio
       * 3rd param -> recursividad (true/false) para construcciones de directorios con anidaciones
       * 
       */
     // mkdir ('testdir/testdir2/testdir3',0777,TRUE);
      mkdir($sub_directorio, 0777, TRUE) or die("No se logró crear el sub directorio");

      $dir = opendir($sub_directorio);

      $ruta_seleccionada = $sub_directorio.'/'.$pdf['name'];

      if(move_uploaded_file($pdf['tmp_name'], $ruta_seleccionada)){
  
        //print_r($pdf['name']."     .....Almacenado de manera exitosa\n");
        return "ok";
  
      }else{
  
        closedir($dir);
        //print_r($pdf['name']."      .....No se logró almacenar\n");
        return "error";
  
      }

    }else{

      $dir = opendir($sub_directorio);

      $ruta_seleccionada = $sub_directorio.'/'.$pdf['name'];

      if(move_uploaded_file($pdf['tmp_name'], $ruta_seleccionada)){
  
        //print_r($pdf['name']."     .....Almacenado de manera exitosa\n");
        return "ok";
  
      }else{
  
        closedir($dir);
        //print_r($pdf['name']."      .....No se logró almacenar\n");
        return "error";
  
      }

    }

  }

/*
    $apertura_directorio = opendir($directorio);
    $ruta_seleccionada = $directorio.'/'.$pdf['name'];

    if(!file_exists($ruta_seleccionada)){

      if(move_uploaded_file($pdf['tmp_name'], $ruta_seleccionada)){

        print_r("Almacenado de manera exitosa");
        return "ok";

      }else{

        print_r("No se logró almacenar");
        return "error";

      }

      closedir($apertura_directorio);

    }
*/
  

  function validar_archivo($archivo){

    if ($archivo) {
      
      if($archivo['size'] < (1000*1024)){

        $nombre_original = $archivo['name'];
        
        if (strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION)) == 'pdf') {
          
          return "ok";

        }else{

          return "error_extension";

        }

      }else{

        return "error_peso";

      }

    }else{

      return "error_exist";

    }

  }
/*
  function subir_archivo($archivo, $id_ruta, $dimension){

    //print_r($archivo); //testing exitoso
    //print_r($archivo['tmp_name']); //testing exitoso
    if($archivo){//es diferente de null el contenido de este archivo?
      //print_r("archivo existente"); //testing exitoso
      //print_r("si existe el archivo" . $archivo['tmp_name']);

      if($archivo['size'] <= (1000*1024)){// su peso es menor a 1MB

        //print_r("Si cumple con el tamaño: " . $archivo['size']);

        $nombre_original = $archivo['name'];
        $nombre_temporal = $archivo['tmp_name'];

        $directorio = '../archivo/'.$id_ruta;

        $extencion_fichero = strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION));

        if($extencion_fichero == 'pdf'){

          //print_r("extencion valida");

          if(!file_exists($directorio)){
            mkdir($directorio, 0777) or die("No se logró crear el directorio");
          }

          $apertura_directorio = opendir($directorio);
          $ruta_seleccionada = $directorio.'/'.$nombre_original;

          if(!file_exists($ruta_seleccionada)){

            if(move_uploaded_file($nombre_temporal, $ruta_seleccionada)){

              print_r("Almacenado de manera exitosa");

            }else{

              

            }

            closedir($apertura_directorio);

          }

        }else{

          

        }

      }else{

        

      }
    }else{

      

    }

  }
*/
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

  $resultado_total = array(

    'resultado_curp' => 'ok',
    'resultado_acta' => 'ok',
    'resultado_constancia' => 'ok',
    'resultado_pago' => 'ok'

  );

  $bandera_curp = validar_archivo($_FILES['pdf_curp']);
  $bandera_acta = validar_archivo($_FILES['pdf_acta']);
  $bandera_constancia = validar_archivo($_FILES['pdf_constancia']);
  $bandera_pago = validar_archivo($_FILES['pdf_pago']);

  $resultado_total['resultado_curp' ]=$bandera_curp;
  $resultado_total['resultado_acta']=$bandera_acta;
  $resultado_total['resultado_constancia' ]=$bandera_constancia;
  $resultado_total['resultado_pago']=$bandera_pago;

  print_r($resultado_total);

/*
  if(! ($bandera_curp ==  "ok") ){

    $resultado_total['resultado_curp'] = $bandera_curp;

    print_r($resultado_total);
  }else{
/*
    if(! ($bandera_acta ==  "ok") ){

      $resultado_total['resultado_acta'] = $bandera_acta;
  
    }else{

      if(! ($bandera_constancia ==  "ok") ){

        $resultado_total['resultado_constancia'] = $bandera_constancia;
    
      }else{

        if(! ($bandera_pago ==  "ok") ){

          $resultado_total['resultado_pago'] = $bandera_pago;
      
        }else{
  
          
          if(! (sube_pdf($_FILES['pdf_curp'], $id_ruta) == "ok") ){
            $resultado_total['resultado_curp'] = "error_upload";
          }

          if(! (sube_pdf($_FILES['pdf_acta'], $id_ruta) == "ok") ){
            $resultado_total['resultado_acta'] = "error_upload";
          }

          if(! (sube_pdf($_FILES['pdf_constancia'], $id_ruta) == "ok") ){
            $resultado_total['resultado_constancia'] = "error_upload";
          }

          if(! (sube_pdf($_FILES['pdf_pago'], $id_ruta) == "ok") ){
            $resultado_total['resultado_pago'] = "error_upload";
          }
          
          echo json_encode($resultado_total, JSON_FORCE_OBJECT);

        //  print_r($resultado_total);
        //  print_r($id_ruta);

        //  sube_pdf($_FILES['pdf_curp'], $id_ruta);
        }

      }

    }

  }

*/
//print_r($resultado_total);

?>