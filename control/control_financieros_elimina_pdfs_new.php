<?php

  // iniciamos la sesion si es que esta existe
  session_start();
  // importamos la conexion a la base de datos
  require_once '../app/conexion.php';
  // importamos las dependencias para poder mandar mails
  require_once '../app/php_mailer/PHPMailerAutoload.php';

  //Enviamos mail para avisarle al usuario que algo salio mal con sus documentos y que necesita volver a subir todo
  function enviar_mail_candidato($mail){

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
    $correo_electronico -> Subject = 'Aviso: Cambio en tus documentos';
    $correo_electronico -> Body = ' 
                            <img src="http://itmilpaalta2.net/preregistro/img/logo.png" style="width: 300px; height: auto;">
                            <h3>Sistema de preregistro del TecNM Campus Milpa Alta II</h3><br><br>
                            <h4>Cambio en tu documentaci&oacute;n</h4>
                            <p>Hola estimado candidato,</p>
                            <p>
                              Tu recibo de pago presenta detalles por favor vuelve a subir tus documentos
                              <br><span style="color:gray;">Eliminaremos - todos los documentos - para que puedas subir todo de manera Limpia</span>
                            </p>
                            <p>Accede al sistema desde <a href="http://www.itmilpaalta2.net/preregistro"><strong>aqu&iacute;<strong></a></p>
                            <br>
                            <p><h3>M&aacute;s Informaci&oacute;n</h3> 
                            <a href="http://www.itmilpaalta2.net/"><strong>P&aacute;gina Web</strong></a></p>
                            <p>Mandanos un mail:  <strong>dda_milpaalta2@tecnm.mx</strong></p>
                            <p>Tel Institucional:  <strong>58446824</strong></p>
                            <p>What\'s App: <strong>5562128790</strong></p>
                          ';

    $correo_electronico -> isHTML(true);
    
    $correo_electronico -> send();

  }

  // ELIMINAR UN DIRECTORIO 
  function deleteDirectory($dir) {
    if(!$dh = @opendir($dir)) return;
    while (false !== ($current = readdir($dh))) {
        if($current != '.' && $current != '..') {
            echo 'Se ha borrado el archivo '.$dir.'/'.$current.'<br/>';
            if (!@unlink($dir.'/'.$current)) 
                deleteDirectory($dir.'/'.$current);
        }       
    }
    closedir($dh);
    echo 'Se ha borrado el directorio '.$dir.'<br/>';
    @rmdir($dir);
  }

  // guardamos en un objeto local el objeto de la conexion a la base de datos
  $conexion = conexion();

  // buscamos a un usario por id en la base de datos
  $query = "SELECT * FROM usuario WHERE id_usuario={$_POST['id']}";

  // almacenamos los resultados de la ejecucion del query
  $resultado = $conexion->query($query);

  // generamos un arreglo asociativo a partir de los resultados
  $arreglo=$resultado->fetch_assoc();

  // generamos la variable del directorio concatenandole el mail del usuario
  $directorio="../archivo/".$arreglo['mail_usuario'];

  // enviamos mail de aviso al usuario que se le eliminaran sus documentos
  enviar_mail_candidato($arreglo['mail_usuario']);
  
  // borramos el directorio especifico
  deleteDirectory($directorio);

  // actualizamos la bandera de la base de datos para saber que debe resubir sus documentos
  $query1 = "UPDATE usuario SET rf_autorizo=0, dda_autorizo=0, subio_archivos=0 WHERE id_usuario={$_POST['id']}";
  
  $resultado1 = $conexion->query($query1);

  $conexion->close();
  
?>