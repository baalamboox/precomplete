<?php

  session_start();

  require_once '../app/conexion.php';

  $conexion = conexion();

  $datos_login = array (

    $conexion->real_escape_string(htmlentities($_POST['ingreso_mail'])),
    $conexion->real_escape_string(htmlentities($_POST['ingreso_password']))

  );

  $query_busqueda_usuario = 'SELECT * FROM usuario WHERE mail_usuario = ? AND password_usuario = ?';
  $busqueda_preparada_usuario = $conexion->prepare($query_busqueda_usuario);
  $busqueda_preparada_usuario->bind_param('ss', $datos_login[0], $datos_login[1]);
  $busqueda_preparada_usuario->execute();

  $resultado = $busqueda_preparada_usuario->get_result();

  $arreglo_resultante = $resultado->fetch_assoc();
  if($resultado != null){

    if($arreglo_resultante != null){

      if($arreglo_resultante['mail_usuario'] != null){

        if($arreglo_resultante['mail_usuario'] == "dda_milpaalta2@tecnm.mx"){

          $_SESSION['usuario']=$_POST['ingreso_mail'];
          echo 2;

        }else if($arreglo_resultante['mail_usuario'] == "rf_milpaalta2@tecnm.mx"){

          $_SESSION['usuario']=$_POST['ingreso_mail'];
          echo 3;

        }else if($arreglo_resultante['mail_usuario'] == "angelito_motitas@hotmail.com"){

          $_SESSION['usuario']=$_POST['ingreso_mail'];
          echo 3;

        }else if($arreglo_resultante['mail_usuario'] == "admon_milpaalta2@tecnm.mx"){

          $_SESSION['usuario']=$_POST['ingreso_mail'];
          echo 4;

        }else if($arreglo_resultante['mail_usuario'] == "acad_milpaalta2@tecnm.mx"){

          $_SESSION['usuario']=$_POST['ingreso_mail'];
          echo 5;

        }else{

          $_SESSION['usuario']=$_POST['ingreso_mail'];
          echo 1;

        }

      }else{

        echo 0;

      }

    }else{

      echo 0;

    }

  }else{

    echo 0;

  }

  $conexion->close();

?>