<?php

  session_start();
  require_once '../app/conexion.php';

  $conexion = conexion();

  $query = "UPDATE usuario SET rf_autorizo=1 WHERE id_usuario={$_POST['id']}";
  $resultado = $conexion->query($query);

  if($resultado){
    $query2 = "UPDATE usuario SET habilitar_examen=1 WHERE id_usuario={$_POST['id']}";
    $resultado2 = $conexion->query($query2);
    echo 1;
  }

  $conexion->close();
?>