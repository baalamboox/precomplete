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
  function valida_domicilio($archivo){

    if ($archivo) {
      
      if($archivo['size'] < (1000*1024)){

        if($archivo['name'] == "domicilio.pdf"){

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

  if($_POST['pdf'] == "curp"){

    echo valida_curp($_FILES['pdf_curp']);

  }else if($_POST['pdf'] == "acta"){

    echo valida_acta($_FILES['pdf_acta']);

  }else if($_POST['pdf'] == "constancia"){

    echo valida_constancia($_FILES['pdf_constancia']);

  }else if($_POST['pdf'] == "pago"){

    echo valida_pago($_FILES['pdf_pago']);

  }else if($_POST['pdf'] == "domicilio"){

    echo valida_domicilio($_FILES['pdf_domicilio']);

  }

?>