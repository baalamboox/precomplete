<?php 
  require_once 'app/filtro_candidato.php'; 

  $server = 'localhost:3306';
    $ussername = 'tecmilpa_kike';
    $password = 'Temporal123';
    $database = 'tecmilpa_preregistro';

    try {
        $conexion = new PDO("mysql:host=$server;dbname=$database;",$ussername,$password);
    } catch (PDOException $e) {
        die('Connected falied: '.$getMessage());
    }

    $cinco=5;
  $consulta = $conexion->prepare('SELECT * FROM usuario WHERE mail_usuario = :mail AND habilitar_examen = :exa' );
        $consulta->bindParam(':mail',$_SESSION['usuario']);
        $consulta->bindParam(':exa',$cinco);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
  if($resultado){

    echo '<script>window.location="candidato"</script>';

  }

?>

<div class="" style="position:fixed; right: 0%; z-index:150">
  <div class="card">
    <div class="card-title text-center">
      <h3>Tiempo Restante</h3>
    </div>
    <div class="media">
      <i class="fas fa-clock fa-4x py-2 text-primary"></i>
      <div class="media-body">

        <div class="" id="cuenta"></div>
      </div>
    </div>
  </div>
</div>

<div class="container py-3">
  <div class="row py-3 rounded" style="background-color: rgba(255, 255, 255, 0.5);">
    <div class="col-md-3 align-self-center">
      <img src="img/SEP.svg" class="img-fluid mx-auto d-block" alt="">
    </div>
    <div class="col-md-6 align-self-center text-center">
      <h2>TECNOLÓGICO NACIONAL DE MÉXICO <br>CAMPUS MILPA ALTA II</h2>
    </div>
    <div class="col-md-3 align-self-center">
      <img src="img/itma2.png" class="mx-auto d-block" width="40%">
    </div>
  </div>
</div>

<div class="container mt-3">
  <div class="row">
    <div class="col">
      <h3>Bienvenido a tu examen de admisión. </h3>
      <ul class="lead text-justify mt-3">
        <li>Cada respuesta cuenta con su juego de respuestas, para seleccionar tu respuesta da click sobre el texto de
          la respuesta que quieras seleccionar. Esta, debe de pintarse en tono azul lo que te indicará que tu respuesta
          ya fue seleccionada.</li>
        <li>Si quieres cambiar tu respuesta solo da un nuevo click en tu nueva opción y esta se tornará azul dejando en
          gris la respuesta anterior.</li>
        <li>Cuentas con 2 horas para realizar tu examen y tienes un reloj arriba a la derecha para revisar el tiempo que
          te queda.</li>
        <li>Al finalizar tu examen encontrarás un botón azul para enviar tus respuestas. Si te falta alguna respuesta se
          te pedirá que confirmes el envío de tus resultados consciente de que te faltaron algunas preguntas.</li>
        <li>Toda pregunta no contestada no te sumará ni te restará puntos.</li>
        <li>Si el tiempo se te acaba el sistema se cerrará en automático y enviará tus resultados por lo que te pedimos
          por favor tomar tus precauciones.</li>
        <li>Los resultados llegarán a tu correo electrónico y quedará guardado en el sistema</li>
        <li>
          <strong style="color:red">
            <h4>
              No recargues o refresques la página, no cierres tu sesión o no cierres el navegador porque se terminará
              el examen de inmediato
            </h4>
          </strong>
        </li>
      </ul>
    </div>
  </div>
</div>

<div class="container">
  <div class="row border rounded py-3 mb-5">
    <div class="col-md-12">
      <form class="formulario" name="examen" id="examen">
        <?php 
          require 'candidato_questions_a.php';
          require 'candidato_questions_b.php'; 
          require 'candidato_questions_c.php';                    
        ?>
      </form>
      <div class="row justify-content-around">
        <div class="col-md-5 py-4">
          <button type="button" class="btn btn-lg btn-primary btn-block" id="btn_enviar"
            onclick="revisar_respuestas_vacias()">Terminar examen y enviar respuestas</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="js/countdown/simplyCountdown.min.js"></script>
<script src="js/countdown/countdown.js"></script>

<script src="manager/manager_candidato_examen.js"></script>

<script>
  $(document).ready(function() {
    cargaExamen();
  });
</script>

<!-- Script dedicado a evityar la pendejada de cerrar la ventana o recargarla... fuck yea -->
<script type="text/javascript">
  window.onbeforeunload = function(){    
    return "¿Desea abandonar la página web?";
  }

</script>

<?php

  //Testing exitoso, si esta la variable de session trabajando
  // echo "kike".$_SESSION['usuario'];

?>