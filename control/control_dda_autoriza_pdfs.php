<?php

  session_start();
  
  require_once '../app/conexion.php';

  $conexion = conexion();

  $query = "UPDATE usuario SET dda_autorizo=1 WHERE id_usuario={$_POST['id']}";

  $resultado = $conexion->query($query);

  echo 1;

  $conexion->close();

?>