<?php

  session_start();
  require_once '../app/conexion.php';
  require_once '../app/php_mailer/PHPMailerAutoload.php';


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
                              Tus documentos tuvieron un detalle que hay que corregir. Se te ha habilitado nuevamente
                              el apartado para cargar los documentos. Te invitamos a que los subas nuevamente a la brevedad. Uno de nuestros 
                              ejecutivos se comunicar&aacute; por tel&eacute;fono contigo para darte detalles de la actualizaci&oacute;n requerida.
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

  //============= ELIMINAR UN DIRECTORIO ==========
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

  $conexion = conexion();

  $query = "SELECT * FROM usuario WHERE id_usuario={$_POST['id']}";

  $resultado = $conexion->query($query);

  $arreglo=$resultado->fetch_assoc();

  $directorio="../archivo/".$arreglo['mail_usuario'];

  enviar_mail_candidato($arreglo['mail_usuario']);
  
  deleteDirectory($directorio);

  $query1 = "UPDATE usuario SET rf_autorizo=0, dda_autorizo=0, subio_archivos=0 WHERE id_usuario={$_POST['id']}";
  $resultado1 = $conexion->query($query1);

  $conexion->close();
  
?>