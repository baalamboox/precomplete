<?php

  require_once '../app/conexion.php';
  require_once '../app/php_mailer/PHPMailerAutoload.php';

  $conexion = conexion();

  $datos_recibidos = array(

    $conexion->real_escape_string(htmlentities($_POST['registro_nombre'])),
    $conexion->real_escape_string(htmlentities($_POST['registro_paterno'])),
    $conexion->real_escape_string(htmlentities($_POST['registro_materno'])),
    $conexion->real_escape_string(htmlentities($_POST['registro_fecha_nacimiento'])),
    $conexion->real_escape_string(htmlentities($_POST['registro_telefono'])),
    $conexion->real_escape_string(htmlentities($_POST['registro_carrera'])),
    $conexion->real_escape_string(htmlentities($_POST['registro_mail'])),
    $conexion->real_escape_string(htmlentities($_POST['registro_password']))

  );

  $mail_temp = $datos_recibidos[6];
  $pass_temp = $datos_recibidos[7];

  function enviar_mail($mail, $password){

    $correo_electronico = new PHPMailer();
    $correo_electronico -> isSMTP();
    $correo_electronico -> SMTPAuth = true;
    $correo_electronico -> SMTPSecure = 'tls';
    $correo_electronico -> Host ='smtp.gmail.com';
    $correo_electronico -> Port = '587';
    $correo_electronico -> Username = 'contacto.preinscripcion.itma2@gmail.com';
    $correo_electronico -> Password = 'Temporal123';

    $correo_electronico -> setFrom('contacto.preinscripcion.itma2@gmail.com', 'TecNM Campus Milpa Alta II');
    $correo_electronico -> addAddress($mail, 'Dear future student...');
    $correo_electronico -> Subject = 'Proceso de preregisto TecNM Campus Milpa Alta II';
    $correo_electronico -> Body = ' 
                            <img src="http://itmilpaalta2.net/preregistro/img/logo.png" style="width: 300px; height: auto;">
                            <h3>Sistema de preregistro del TecNM Campus Milpa Alta II</h3><br><br>
                            <h5>Tus datos de acceso son:</h5>
                            <br>
                            <p>Usuario:  '.$mail.'</p>
                            <p>Password:  '.$password.'</p>
                            <br>
                            <p>Ingresa con tu cuenta y sube tus documentos en formato <strong>PDF</strong> para seguir tu proceso</p>
                            <p>Accede al sistema desde <a href="http://www.itmilpaalta2.net/preregistro"><strong>aqu&iacute;<strong></a></p>
                            <br>
                            <p><h3>M&aacute;s Informaci&oacute;n</h3> 
                            <a href="http://www.itmilpaalta2.net/"><strong>Visitar</strong></a></p>
                            <p>Mandanos un mail:  <strong>dda_milpaalta2@tecnm.mx</strong></p>
                            <p>Tel Institucional:  <strong>58446824</strong></p>
                            <p>What\'s App: <strong>5562128790</strong></p>
                          ';

    $correo_electronico -> isHTML(true);
    
    if($correo_electronico -> send()){

      return "100";

    }else{

      return "404";

    }
    
  }

  function verifica_correo_existente($correo){

    $conexion = conexion();
    $query_correo_existente = 'SELECT * FROM usuario WHERE mail_usuario = ?';
    $query_correo_existente = $conexion->prepare($query_correo_existente);
    $query_correo_existente->bind_param('s', $correo);
    $query_correo_existente->execute();

    if(($query_correo_existente->get_result()->num_rows)>0){

      return "correo_existente";

    }else{

      return "sin_problemas";

    }

    $conexion->close();

  }

  if(verifica_correo_existente($datos_recibidos[6]) == "correo_existente"){

    $resultado_total = array(

      'resultado_db' => 'correo_ya_existente',
      'resultado_mail' => 'no se realizo el envio por que el mail ya existe',
      'mail' => strval($mail_temp)

    );

    echo json_encode($resultado_total, JSON_FORCE_OBJECT);

  } else {

    $query_insert = "INSERT INTO usuario(nombre_usuario, 
                                paterno_usuario, 
                                materno_usuario, 
                                fecha_nacimiento_usuario, 
                                telefono_usuario,
                                carrera_usuario,
                                mail_usuario, 
                                password_usuario)
                                values(?, ?, ?, ?, ?, ?, ?, ?)";

    $insert_preparado = $conexion->prepare($query_insert);

    $insert_preparado->bind_param(
      'ssssssss', 
      $datos_recibidos[0], 
      $datos_recibidos[1],
      $datos_recibidos[2], 
      $datos_recibidos[3],
      $datos_recibidos[4], 
      $datos_recibidos[5],
      $datos_recibidos[6],
      $datos_recibidos[7]
    );

    $resultado_mail = 0;

    $resultado_insert = $insert_preparado->execute();

    if(strval($resultado_insert) == "1"){

      $resultado_mail = enviar_mail($mail_temp, $pass_temp);

    }

    $resultado_total = array(

      'resultado_db' => strval($resultado_insert),
      'resultado_mail' => $resultado_mail,
      'mail' => strval($mail_temp)

    );

    echo json_encode($resultado_total, JSON_FORCE_OBJECT);

    $conexion->close();

  }
