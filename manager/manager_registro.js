//Todo lo que este dentro de esta funcion se ejecutará al terminar el correcto cargado de la pagina web
$(document).ready(function() {

    function valida_confirmacion_password() {

        // verifico que su password sea igual en ambas cajas

        //si no lo son aviso y reseteo la caja
        if ($('#registro_password').val() != $('#registro_password_confirmacion').val()) {

            swal('Upps', 'Los password no coinciden, por favor vuelvelo a confirmar', 'warning');
            $('#registro_password_confirmacion').val("");
            return false;

        } else {

            //aqui ya se que son iguales por lo que lo guardo para luego enviarlo por ajax
            registro_password = $('#registro_password').val();

            //inicio la recolecciond e la informacion de cada variable "registro" para despues enviar este acumulado por ajax
            //aqui ya se utiliza formato JSON
            recolector_de_informacion = "registro_nombre=" + registro_nombre +
                "&registro_paterno=" + registro_paterno +
                "&registro_materno=" + registro_materno +
                "&registro_fecha_nacimiento=" + registro_fecha_nacimiento +
                "&registro_telefono=" + registro_telefono +
                "&registro_carrera=" + registro_carrera +
                "&registro_mail=" + registro_mail +
                "&registro_password=" + registro_password;

            // Construccion de la interfaz ajax
            $.ajax({
                type: 'POST',
                /*digo por que protocolo nos vamos a comunicar*/
                data: recolector_de_informacion,
                /*digo que informacion vamos a enviar*/
                url: 'control/control_registro.php',
                /*digo a donde voy a enviar la informacion*/
                /*Programo el resultado que me retorne el documento al que envie la informacion*/
                /**
                 * - La llave es success
                 * - El valor de llave es una funcion anonima (osea un callback) -> aqui vamos a programr que hacer con el resultado
                 *    - resultado es una variable objeto que se recibe del documento al que enviamos la info con este ajax
                 */
                success: function(resultado) {

                    obj_datos = JSON.parse(resultado);

                    resultado_db = obj_datos['resultado_db'].toString();

                    resultado_mail = obj_datos['resultado_mail'].toString();

                    direccion_destinatario = obj_datos['mail'].toString();

                    if (resultado_db == "1") {

                        if (resultado_mail == "100") {

                            mensaje_resultado_mail = "El mail se envió exitosamente";

                        } else {

                            mensaje_resultado_mail = "Checking the email send process.... Upss.... This maybe Brick...";

                        }

                        swal({
                            icon: "success",
                            title: "Usuario creado con exito !!!",
                            html: true,
                            text: '\n\n Al cerrar esta venta regresarás al LogIn (^.^)' +
                                '\n\n Tus datos de acceso son:\n\nMAIL y PASSWORD' +
                                '\n\n Se te envió un correo con los datos de tu registro' +
                                '\n\n Direccion del envío: ' + direccion_destinatario,
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                            value: true,
                            buttons: false,
                            timer: 3000
                        }).then((value) => {
                            window.location = "login";
                        });

                        return false;

                    } else if (resultado_db == "correo_ya_existente") {

                        swal('Upps', 'El correo:\n\n' + direccion_destinatario +
                            '\n\nYa existe en el sistema\n\n' +
                            'Si olvidaste tu password revisa tu cuenta de email, ya que al registrarte enviamos tus datos de acceso ' +
                            'o escribenos a:\n\n contacto.preinscripcion.itma2@gmail.com',
                            'error');
                        return false;

                    } else {

                        swal('Upps', 'Error al crear el nuevo usuario', 'error');

                        return false;

                    }

                }

            });

        }

    }

    function valida_confirmacion_email() {

        //valido que el primer mail y su confirmacion sean iguales

        //Si son diferentes aviso
        if ($('#registro_mail').val() != $('#registro_mail_confirmacion').val()) {

            swal('Upps', 'Los email no coinciden, por favor vuelvelo a confirmar', 'warning');
            $('#registro_mail_confirmacion').val("");
            return false;

        } else {

            //aqui ya se que son iguales por lo que leo el valor para guardarlo y posteriormente mandarlo por ajax
            registro_mail = $('#registro_mail').val();

            //invoco la validacion del password
            valida_confirmacion_password();

        }

    }

    function valida_construccion_email() {

        //Evaluo la construccion del mail

        //primero leo el valor de la caja
        cadena = $('#registro_mail').val();

        //Evaluo la cadena a travez del metodo test con la expresion regular
        //test regresaria true -> si coincide con los parametros de busqueda
        //                false -> si NO coincide con los parametros de busqueda
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(cadena)) {

            // si existe una buena coincidencia paso a la siguiente validacion
            valida_confirmacion_email();

            //NOTA: aqui no guardo nada porque el que se enviará al sistema sera la confirmacion del mail

        } else {

            //en caso de que el mail no coincida avisamos que esta mal construido
            swal('Upps', 'Ingresa un email valido por favor \n\nEjemplo: candidato@miemail.com', 'warning');
            return false;

        }

    }

    function valida_seleccion_carrera() {

        //leemos la carrera seleccionada
        carrera = $('#registro_carrera').val();

        //la normalizamos a mayusculas
        carrera = carrera.toUpperCase();

        //Garantizo que sea una de las llaes validas
        if (carrera == "SIS" || carrera == "IND" || carrera == "GES") {

            //guardo ese dato para luego mandarlo por ajax
            registro_carrera = carrera;

            //invoco la siguiente validacion
            valida_construccion_email();

        }

    }

    function valida_telefono() {

        //leemos el valor de la caja de telefono
        telefono = $('#registro_telefono').val();

        // obligamos a que se comporte como numero entero -> ayudara en las validaciones facilitando el camino
        telefono = parseInt(telefono);

        //Validamos que no sean numeros negativos
        if (telefono < 0) {

            swal(' Alerta en: TELEFONO', 'No existen número de telefono negativos', 'warning');
            return false;

        } else {

            //aqui ya sabemos que es positivo por lo que lo regresamos a cadena para seguir validando de manera simple
            telefono = telefono.toString();

            //evaluamos que sea de una longitud de 10 digitos

            //aqui evaluamos que no sea menor a 10 digitos
            if (telefono.length < 10) {

                swal(' Alerta en: TELEFONO',
                    'Debes de tener al menos 10 digitos en tu telefono\n' +
                    'Recuerda que en zona metropolitana los números inician con 55\n' +
                    'Ejemplo:   5558442834',
                    'warning');
                return false;

                // aqui evaluamos que no sea mayor a 10 digitos
            } else if (telefono.length > 10) {

                swal(' Alerta en: TELEFONO',
                    'No debes tener más de 10 digitos\n' +
                    'Recuerda que en zona metropolitana los números inician con 55\n' +
                    'Ejemplo:   5558442834',
                    'warning');
                return false;

            } else {

                //aqui ya garantizamos que son 10 digitos

                //por lo cual lo almacenamos en una variable que despues era enviada por ajax
                registro_telefono = $('#registro_telefono').val();

                //invocamos la siguiente validacion
                valida_seleccion_carrera();

            }

        }

    }

    function valida_fecha_nacimiento() {

        /**
         * - Previo a esto... en la funcion "valida_vacios" revisamos que la fecha ya tuviera un dato precargado
         */

        //volvemos a verificar que el valor en la caja de fecha no este vacio
        if ($('#registro_fecha_nacimiento').val() != "") {

            //Traemos el valor de la fecha y llega en el formato: yyyy-mm-dd
            fecha_ingresada = $('#registro_fecha_nacimiento').val().split("-"); //traemos el valor de la caja y lo cortamos con split para generar un arreglo con año mes dia

            //calculamos la edad 
            edad = 2020 - fecha_ingresada[0];

            //verificamos que sea mayor a 16 años
            if (edad < 16) {

                swal(' Alerta en: FECHA DE NACIMIENTO', 'La fecha que indicas no es válida, \n\nEres muy jóven!!!', 'warning');
                return false;

                // Verificamos que sea menor a 100 años
            } else if (edad > 99) {

                swal(' Alerta en: FECHA DE NACIMIENTO', 'La fecha que indicas no es válida !!!', 'warning');
                return false;

            } else {

                //si es una edad valida almacenamos la fecha de nacimiento que despues sera enviada por ajax
                registro_fecha_nacimiento = $('#registro_fecha_nacimiento').val();

                //invocamos la siguiente validacion
                valida_telefono();

            }

        }

    }

    function valida_construccion_alfabetica() {

        // volvemos a leer el dato del control de nombre y lo bajamos a una variable local
        cadena = $('#registro_nombre').val();

        // Creamos dos expresiones regulares para validar los datos permitidos en la construccion delnombre
        regexp1 = /[^\w\s]/gi;
        regexp2 = /[^A-Z\s]/gi;

        // Hacemos el match (revisamos valor contra exprecion regular para sabr si todo va correcto en su formacion del nombre)
        //match -> retorna un objeto con las coincidencias
        //quiere decir que si encontramos algun dato en los resultados entonces la cadena posee algo que no debe de ir
        //Vacios -> la cadena esta bien
        //con valores -> la cadena esta mal
        resultado1 = cadena.match(regexp1);
        resultado2 = cadena.match(regexp2);


        //Esto lo hice xq era necesario para limpiar las impresiones hacia la interfaz
        // Si alguno de los resultados esta vacio... entonces....
        if (resultado1 != null || resultado2 != null) {

            // si el primer resultado es null, actualizalo a cadena vacia
            if (resultado1 == null) {
                resultado1 = "";
            }
            //si el resultado dos es null, actualizalo a cadena vacia 
            if (resultado2 == null) {
                resultado2 = "";
            }

            //Generamos la alerta para indicar que algo salio mal en la escritura del nombre
            swal(' Alerta en: NOMBRE', 'los siguientes caracteres no son validos:\n\n' + resultado2 + resultado1, 'warning');

            //paramos la ejecucion de la pagina
            return false;

        } else {

            // como ya garantizamos una buiena escritura ahora normalizamos la cadena nombre y lo almacenamos en una variable que sera enviada por ajax
            registro_nombre = $('#registro_nombre').val();
            registro_nombre = registro_nombre.trim();
            registro_nombre = registro_nombre.toUpperCase();

            //Aplica la misma explicacion del nombre pero ahora para el Paterno

            cadena = $('#registro_paterno').val();
            resultado1 = cadena.match(regexp1);
            resultado2 = cadena.match(regexp2);

            if (resultado1 != null || resultado2 != null) {

                if (resultado1 == null) {
                    resultado1 = "";
                }
                if (resultado2 == null) {
                    resultado2 = "";
                }
                swal(' Alerta en: APELLIDO PATERNO', 'los siguientes caracteres no son validos:\n\n' + resultado2 + resultado1, 'warning');
                return false;

            } else {

                // como ya garantizamos una buiena escritura ahora normalizamos la cadena Paterno y lo almacenamos en una variable que sera enviada por ajax
                registro_paterno = $('#registro_paterno').val();
                registro_paterno = registro_paterno.trim();
                registro_paterno = registro_paterno.toUpperCase();

                //Aplica la misma explicacion del nombre pero ahora para el Materno

                cadena = $('#registro_materno').val();
                resultado1 = cadena.match(regexp1);
                resultado2 = cadena.match(regexp2);

                if (resultado1 != null || resultado2 != null) {

                    if (resultado1 == null) {
                        resultado1 = "";
                    }
                    if (resultado2 == null) {
                        resultado2 = "";
                    }

                    swal(' Alerta en: APELLIDO MATERNO', 'los siguientes caracteres no son validos:\n\n' + resultado2 + resultado1, 'warning');
                    return false;

                } else {

                    // como ya garantizamos una buiena escritura ahora normalizamos la cadena Materno y lo almacenamos en una variable que sera enviada por ajax
                    registro_materno = $('#registro_materno').val();
                    registro_materno = registro_materno.trim();
                    registro_materno = registro_materno.toUpperCase();

                    // al tener los primero tres campos alfabeticos validados procedemos a invocar la siguiente funcion
                    valida_fecha_nacimiento();
                }

            }

        }

    }

    function valida_vacios() {

        /**
         *  - Seleccionamos por Jquery
         *  - comparamos el valor de cada una de las selecciones contra una cadena vacia para saber si recibimos datos o no
         *    - En caso de NO recibir datos en algono de los controles se dispara un sweetalert() avisando que nos hace falta
         *      y se para la ejecuciond e la pagina
         *    - En caso de que cada uno de los controles si tenga la informacion cargada (osea diferente a vacio) disparamos
         *      el else (logica inversa) y en este invocamos la siguiente funcion
         */

        if ($('#registro_nombre').val() == "") {
            swal('Upps', 'Ingresa tu "Nombre" por favor', 'warning');
            return false;
        } else if ($('#registro_paterno').val() == "") {
            swal('Upps', 'Ingresa tu "Apellido Paterno" por favor', 'warning');
            return false;
        } else if ($('#registro_materno').val() == "") {
            swal('Upps', 'Ingresa tu "Apellido Materno" por favor', 'warning');
            return false;
        } else if ($('#registro_fecha_nacimiento').val() == "") {
            swal('Upps', 'Ingresa tu "Fecha de Nacimiento" por favor', 'warning');
            return false;
        } else if ($('#registro_telefono').val() == "") {
            swal('Upps', 'Ingresa un "Telefono" para poderte contactar', 'warning');
            return false;
        } else if ($('#registro_carrera').val() == "") {
            swal('Upps', 'Ingresa tu "carrra" por favor', 'warning');
            return false;
        } else if ($('#registro_mail').val() == "") {
            swal('Upps', 'Ingresa tu "email" por favor', 'warning');
            return false;
        } else if ($('#registro_mail_confirmacion').val() == "") {
            swal('Upps', 'Por favor confirma tu email', 'warning');
            return false;
        } else if ($('#registro_password').val() == "") {
            swal('Upps', 'Ingresa un password para tu cuenta por favor', 'warning');
            return false;
        } else if ($('#registro_password_confirmacion').val() == "") {
            swal('Upps', 'Por favor confirma tu password por favor', 'warning');
            return false;
        } else {
            valida_construccion_alfabetica();
        }

    }

    // Programamos el click de nuestro boton de registro en la view/registro.php
    $('#btn_registro_usuario').click(function() {

        // Se invoca la funcion que valida los campos vacios del formulario
        valida_vacios();

    });

});