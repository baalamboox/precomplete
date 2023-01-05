<?php

  //echo $_POST['id'];

  session_start();
  require_once '../app/conexion.php';

  $conexion = conexion();

  $query = "SELECT * FROM usuario WHERE id_usuario={$_POST['id']}";

  $resultado = $conexion->query($query);

  $datos = $resultado->fetch_assoc();

  //echo $datos['mail_usuario'];

  $conexion->close();


  $sub_directorio = "../archivo/".$datos['mail_usuario'];
  $path = "archivo/".$datos['mail_usuario'];
  //echo $sub_directorio;

  if(!file_exists($sub_directorio)){
    echo "no existe";
  }else{

    echo '
      <div class="row">
        <div class="col">
          <h1 class="text-center">Curp</h1>
          <div class="embed-responsive embed-responsive-1by1">
            <iframe class="embed-responsive-item" src="'.$path.'/curp.pdf"></iframe>
          </div>
        </div>
        <div class="col">
          <h1 class="text-center">Acta de nacimiento</h1>
          <div class="embed-responsive embed-responsive-1by1">
            <iframe class="embed-responsive-item" src="'.$path.'/acta.pdf"></iframe>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <h1 class="text-center">Comprobante de Domicilio</h1>
          <div class="embed-responsive embed-responsive-1by1">
            <iframe class="embed-responsive-item" src="'.$path.'/domicilio.pdf"></iframe>
          </div>
        </div>
        <div class="col">
          <h1 class="text-center">Constancia de Estudios</h1>
          <div class="embed-responsive embed-responsive-1by1">
            <iframe class="embed-responsive-item" src="'.$path.'/constancia.pdf"></iframe>
          </div>
        </div>
      </div>

      
    ';

  }

?>


