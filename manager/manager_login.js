//validamos la construcción del mail

//Nota: no se valida el password xq este ya se cotejará contra el valor guardado en la BD corresponduiente a la cuenta de mail
function valida_construccion_email() {

    //leo el valor del mail
    cadena = $('#ingreso_mail').val();

    //los testeo contrta la la expresion regular que garantiza su buena construccion
    // si test devuelve falso por una mala coincidencia, lo invierto con el ! y muestro la alerta dentro de if
    //si test devuelve true -> lo invierto con el !, esto me dispara al else
    //NOTA: solo fue para seguir avanzando a travez del else
    if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(cadena))) {

        //indicamos que el mail esta mal construido
        swal('Upps', 'Ingresa un email valido por favor \n\nEjemplo: candidato@miemail.com', 'warning');

        //detenemos las acciones del sitio
        return false;

        //Si el if no entra sigo por el else (osea q va bien)
    } else {

        //defino un objeto ajax
        $.ajax({

            type: 'POST',
            /* defino por que protocolo de comunicacion viajará */
            data: $('#formulario_ingreso').serialize(),
            /* recolecto la informacion del formulario y cada uno de sus elementos gracias a serialize() */
            url: 'control/control_login.php',
            /*indico a que documento se enviará la informacion recolectada*/
            /*  
                programo la respuesta 

                    - esto es una funcion anonima (una promesa)(un proceso asincrono)
                    - recibiremos para trabajar el objeto "resultado"
                        - El objeto resultado lo enviará el documento que recibio la info (control/control_login.php)
            */
            success: function(resultado) {

                //si el contenido del objeto es un...
                if (resultado == 1) {

                    //emito una alerta de "acceso correcto"
                    swal({
                        icon: "success",
                        title: "Candidato Encontrado !!!",
                        html: true,
                        text: '\n\n Estas siendo redirigido automaticamente, no desesperes (^.^)',
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                        value: true,
                        buttons: false,
                        timer: 10
                    }).then((value) => {

                        //redirecciono a la interfaz de candidato (notacion de rutas amigables)
                        window.location = "candidato";

                    });

                    return false;

                } else if (resultado == 2) {

                    swal({
                        icon: "success",
                        title: "Bienvenida Regina",
                        html: true,
                        text: '\n\n Iniciando tu interfaz (^.^)',
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                        value: true,
                        buttons: false,
                        timer: 1500
                    }).then((value) => {

                        window.location = "dda";

                    });

                    return false;

                }else if (resultado == 3) {

                    swal({
                        icon: "success",
                        title: "Hola Nelly",
                        html: true,
                        text: '\n\n Cargando tu interfaz <3',
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                        value: true,
                        buttons: false,
                        timer: 1500
                    }).then((value) => {

                        window.location = "financieros";

                    });

                    return false;

                }else if (resultado == 4) {

                    swal({
                        icon: "success",
                        title: "Hola Edgar",
                        html: true,
                        text: '\n\n Cargando tu interfaz',
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                        value: true,
                        buttons: false,
                        timer: 1500
                    }).then((value) => {

                        window.location = "admon";

                    });

                    return false;

                }else if (resultado == 5) {

                    swal({
                        icon: "success",
                        title: "Hola Omar",
                        html: true,
                        text: '\n\n Cargando tu interfaz',
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                        value: true,
                        buttons: false,
                        timer: 1500
                    }).then((value) => {

                        window.location = "acad";

                    });

                    return false;

                }else {

                    $('#formulario_ingreso')[0].reset();
                    swal('Upss', "Los datos que ingresas no existen en el sistema\n\n Vuelve a intentar por favor", 'warning');
                    return false;

                }

            }

        });

    }

}

//Validamos que los campos no estén vacios
function valida_vacios() {

    //si la caja para el mail esta vacia...
    if ($('#ingreso_mail').val() == "") {

        //generamos una ventana emergente notificando lo que falta
        swal("Upps", "Falta ingresar tu dirección de EMAIL", "warning")

        //detenemos la ejecucion del sitio
        return false;

        // Ó si la caja para la constraseña esta vacia...
    } else if ($('#ingreso_password').val() == "") {

        //lanzamos la alerta
        swal("Upps", "Falta el PASSWORD", "warning")

        //detenemos la ejecuc¿on de la pagina
        return false;

        //si las dos anteriores no aplicaron
    } else {

        //invocamos la validacion de la construccion del mail
        valida_construccion_email();

    }

}

//Cuando el documento este 100% cargado en el navegador...
$(document).ready(function() {

    //programamos el click del boton
    $('#btn_ingreso_sistema').click(function() {

        //invocamos la funcion valida vacios
        valida_vacios();

    });
});