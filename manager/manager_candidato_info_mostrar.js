
$(document).ready(function(){

    // Control para mostrar / no mostrar el boton de subir documentos
    $.ajax({
      type:"POST",
      url: 'control/control_candidato_revisar_upload.php',
      success: function(resultado_up){
        (resultado_up == 1) ? $('#btn_go_upload').hide() : $('#btn_go_upload').show()
      }
    })

    // Control para mostrar / no mostrar el boton de hacer examen
    $.ajax({
      type:"POST",
      url: 'control/control_candidato_revisar_habilitar_test.php',
      success:resultado_test => {
        console.log(resultado_test)
        switch(resultado_test){
          case '1':
            $('#habilitar_examen').html('<a href="examen" class="btn btn-danger btn-block" id="btn_go_test"><strong>Iniciar Examen</strong></a>')
            break;
          case '2':
            $('#habilitar_examen').html('<span class="lead">Aún no se ha autorizado tu examen</span>')
            break;
          case '3':
            $('#habilitar_examen').html('<p class="lead">Tu examen ya está aprobado</p><hr><span class="lead">Fecha de examen: <hr> Viernes 4-02-2021 a las 10 AM en punto</span>')
            break;
          case '4':
            $('#habilitar_examen').html('<span class="lead">Aún no es la hora del examen</span>')
            break;
          case '5':
            $('#habilitar_examen').html('<span class="lead" style="color:green;"><strong>Ya has realizado tu examen. <br><br>El Departamento de Desarrollo Academico se comunicará contigo. También puedes comunicarte vía mail a la cuenta dda_milpaalta2@tecnm.mx<br><br>O mandar un Whats App al número 5562128790</strong> </span>')
            break;
        }
      }
    })

})