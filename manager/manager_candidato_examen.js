function tiempoAgotado() {
  swal({
    icon: "warning",
    title: "Tiempo para examen agotado!",
    text: "Las 2hrs para contestar las 120 preguntas han terminado...",
    showConfirmButton: true,
    closeOnClickOutside: false,
    closeOnEsc: false,  
  }).then((value) => {
    window.onbeforeunload = null;
    enviaExamen();
    
  });
}

function enviaExamen() {

  $.ajax({
    type: "POST",
    data: $("#examen").serialize(),
    url: "./control/control_candidato_calificar_examen.php",
    success: function (r) {
      if (r != "error") {

        swal({
          icon: "success",
          title: "Muy bien :)",
          text: "Tus respuestas han sido enviadas!\n\nTu numero de aciertos obtenidos es: " +
            r +
             " de 120 posibles" +
             "\n\nEl Departamento de Desarrollo Academico dará continuidad para seguir tu proceso de ingreso"+
             "\n\n No salgas de casa :)   ... Nosotros nos comunicaremos contigo"
        })
        .then((value) => {
          window.location="candidato";
        });

      } else {
        swal("Algo salio mal");
        swal({
          icon: "error",
          title: "Upps",
          text:
            "Error al intentar enviar tus respuestas intentalo nuevamente\n\n",
          showConfirmButton: true,
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
          value: true,
          customClass: {
            confirmButton: "btn btn-danger btn-block",
          },
        });
      }
    }
  });
}

function revisar_respuestas_vacias() {
  var c = 1,
    contadorNoCheck = 0;

  for (var i = 0; i < 120; i++) {
    if (!$("#examen input[name='r" + c + "']:radio").is(":checked")) {
      contadorNoCheck++;
    }
    c++;
  }

  if (contadorNoCheck != 0) {
    swal({
      title: "Upps! ",
      text:
        "Si terminas tu examen las respuestas que no se contestaron se enviarán en blanco !!!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      
      if (willDelete) {

        //aqui invocare xq no hac enada
        enviaExamen()

        swal("Confirmado! Tu información se ha enviado a nuestros servidores", {
          icon: "success",
        });
        window.onbeforeunload = null;
        // Aqui redirigimos a la home del candidato porque pues ya termino el examen
        //window.location="candidato";
      } else {
        swal("Entendido! Tomate un tiempo más para contestar");
        window.onbeforeunload = function(){    
          return "¿Desea abandonar la página web?";
        }
      }
    });
  }
}

function cargaExamen() {
  swal({
    title: "TECNM CAMPUS MILPA ALTA II",
    text:
      "Bienvenido al examen de admisión \n\n" +
      " Al cerrar esta venta iniciará tu examen. \n\nLee con mucha atención las instrucciones antes de resolverlo" +
      " y recuerda que solo cuentas con 2 horas \n\n" +
      "¡ Mucha suerte !",
    showConfirmButton: true,
    closeOnClickOutside: false,
    closeOnEsc: false,
    dangerMode: true,
  });
}
