<?php

  session_start();
  require_once '../app/conexion.php';

  $id_ruta=$_SESSION['usuario'];
  $conexion = conexion();

  function registra_subida($id_ruta, $conexion){

    $busqueda_usuario = "UPDATE usuario SET subio_archivos=1 WHERE mail_usuario=?";
    $busqueda_usuario_preparada =  $conexion->prepare($busqueda_usuario);
    $busqueda_usuario_preparada->bind_param('s', $id_ruta);
    $busqueda_usuario_preparada->execute();
    $conexion->close();
  }

  function sube_pdf($pdf, $id_ruta){

    $sub_directorio = "../archivo/".$id_ruta;

    if(!file_exists($sub_directorio)){

      mkdir($sub_directorio, 0777, TRUE) or die("No se logró crear el sub directorio");

      $dir = opendir($sub_directorio);

      $ruta_seleccionada = $sub_directorio.'/'.$pdf['name'];

      if(move_uploaded_file($pdf['tmp_name'], $ruta_seleccionada)){

        return "ok";
  
      }else{
  
        closedir($dir);

        return "error";
  
      }

    }else{

      $dir = opendir($sub_directorio);

      $ruta_seleccionada = $sub_directorio.'/'.$pdf['name'];

      if(move_uploaded_file($pdf['tmp_name'], $ruta_seleccionada)){
  
        return "ok";
  
      }else{
  
        closedir($dir);

        return "error";
  
      }

    }

  }

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

  $resultado_total = array(

    'resultado_curp' => 'ok',
    'resultado_acta' => 'ok',
    'resultado_constancia' => 'ok',
    'resultado_pago' => 'ok',
    'resultado_domicilio'=> 'ok',

  );

  $bandera_curp = validar_archivo($_FILES['pdf_curp']);
  $bandera_acta = validar_archivo($_FILES['pdf_acta']);
  $bandera_constancia = validar_archivo($_FILES['pdf_constancia']);
  $bandera_pago = validar_archivo($_FILES['pdf_pago']);
  $bandera_domicilio = validar_archivo($_FILES['pdf_domicilio']);

  $resultado_total['resultado_curp' ]=$bandera_curp;
  $resultado_total['resultado_acta']=$bandera_acta;
  $resultado_total['resultado_constancia' ]=$bandera_constancia;
  $resultado_total['resultado_pago']=$bandera_pago;
  $resultado_total['resultado_domicilio']=$bandera_domicilio;

  if(! ($bandera_curp ==  "ok") ){

    $resultado_total['resultado_curp'] = $bandera_curp;

  }else{

    if(! ($bandera_acta ==  "ok") ){

      $resultado_total['resultado_acta'] = $bandera_acta;
  
    }else{

      if(! ($bandera_constancia ==  "ok") ){

        $resultado_total['resultado_constancia'] = $bandera_constancia;
    
      }else{

        if(! ($bandera_pago ==  "ok") ){

          $resultado_total['resultado_pago'] = $bandera_pago;
      
        }else{

          if(! ($bandera_domicilio ==  "ok") ){

            $resultado_total['resultado_domicilio'] = $bandera_domicilio;
        
          }else{
    
            
            if(! (sube_pdf($_FILES['pdf_curp'], $id_ruta) == "ok") ){

              $resultado_total['resultado_curp'] = "error_upload";

            }else{

              if(! (sube_pdf($_FILES['pdf_acta'], $id_ruta) == "ok") ){

                $resultado_total['resultado_acta'] = "error_upload";

              }else{

                if(! (sube_pdf($_FILES['pdf_constancia'], $id_ruta) == "ok") ){

                  $resultado_total['resultado_constancia'] = "error_upload";

                }else{

                  if(! (sube_pdf($_FILES['pdf_pago'], $id_ruta) == "ok") ){

                    $resultado_total['resultado_pago'] = "error_upload";

                  }else{

                    if(! (sube_pdf($_FILES['pdf_domicilio'], $id_ruta) == "ok") ){

                      $resultado_total['resultado_domicilio'] = "error_upload";

                    }else{

                      registra_subida($_SESSION['usuario'], $conexion);
                      echo json_encode($resultado_total, JSON_FORCE_OBJECT);

                    }

                  }

                }

              }

            }
            
          }

        }

      }

    }

  }

?>