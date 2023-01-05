<?php 
    // Mantiene una sesion viva de existir alguna (esto solo pasa en los documentos que visitas despues de que ya iniciaste la sesion)
    session_start();
    /**
    * - isset -> es el metodo que evalua
    * - $_SESSION -> objeto arreglo global de php exclusiva pasa sesiones de usuario en el navegador/sistema
    * - 'usuario' -> es la llave que buscamos para el valor especifico dentro de session
    */
    if(isset($_SESSION['usuario'])) { //evaluamos si en la variable global de $sesion existe un dato colocado (regresa false si no esta definida)
        $usuario = $_SESSION['usuario']; //Si existe... Bajamos el valor de la llave a variable local
        //Nota: Bajamos dicho valor a una var local xq se usa en la barra de navegacion para mostrar que suario esta logueado
    } else {
        $usuario = ''; //Si no existe...  dejamos la variable local vacia
    }
    require_once 'app/config.php'; // Traemos la programacion de este documento
    //Nota: es crucial que este en esta posicion para que los demás bloques de PHP funcionen correctamente
    //ya que esta importacion contiene dos rutas generales usadas en casi todas las referencias posteriores
?>
<!DOCTYPE html>
<html lang="es-MX" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistema de preinscripción</title>
        <?php require_once 'app/dependencias.php';?>
        <!-- Importo dependencias CCS y JS vía PHP pero es maquetado HTML  -->
    </head>
    <body>
        <!-- INICIO ZONA DE CONTROL LOGICO -->
        <?php
            /**
            * isset() -> revisa que la variable global tenga un valor diferente a false
            * $_GET -> Objeto global dedicada a capturar la solicitud del cliente en la URL del navegador
            * 'vista_solicitada' -> llave a buscar dentro del objeto GET
            */
            if(isset($_GET['vista_solicitada'])){ //verificamos que la solicitud en la url no este vacia
                /**
                * En .htacces:   RewriteRule ^([a-zA-Z0-9/_]+)$ index.php?vista_solicitada=$1
                * 
                * - eso va a tomar la URL completa hasta el inde.php y al momento de escribir una / algo para visitar un apartado
                * - esa /algo, queda atrapada a partir de ? y se guarda en vista_previa_solicitada 
                */
                /**
                * - explode(simbolo a buscar, cadena a cortar) -> hace lo mismo que trim
                * - para este caso 
                */
                //Se ahcia asi xq se tenian pensados dos nuveles de diagonales en las rutas amigables
                //Pero se dejara directo ya que todo el sistema silo funciona con una sola / para los accesos
                //$direccion_solicitada = explode('/', $_GET['vista_solicitada']);
                //Pruevas de impresion para ver si eran el mismo valor puro y despues del explode
                //echo $_GET['vista_solicitada'];
                //echo $direccion_solicitada[0];
                //recordar que esta variable y su index 0 eran los que estaban antes en el switch
                switch($_GET['vista_solicitada']) { //Se evalua la cadena solicitada x url
                    case 'login': {
                        //este caso es especial pos si de algun modo necesitammis llegar por url a este lugar que es el login
                        require_once 'view/login.php'; //solicita la carga del codigo correspondiente a dicha vista
                        break;
                    }
                    // De aqui en adelante todos los casos apuntan a vistas distintas y unicas
                    case 'registro': {
                        require_once 'view/registro.php'; //IDEM en cada caso de aqui hacia abajo
                        break;
                    }
                    case 'upload': {
                        require_once 'view/candidato_upload.php';
                        break;
                    }
                    case 'candidato': {
                        require_once 'view/candidato_home.php';
                        break;
                    }
                    case 'dda': {
                        require_once 'view/dda.php';
                        break;
                    }
                    case 'acad': {
                        require_once 'view/acad_dda.php';
                        break;
                    }
                    case 'financieros': {
                        require_once 'view/financieros.php';
                        break;
                    }
                    case 'admon': {
                        require_once 'view/admon_financieros.php';
                        break;
                    }
                    case 'salir': {
                        require_once 'control/control_salir.php';
                        break;
                    }
                    case 'examen': {
                        require_once 'view/candidato_evaluacion.php';
                        break;
                    } 
                    default: { 
                        require_once 'view/login.php'; // Cualquier ruta no valida mandaria al login
                        break;
                    }
                }
            } else {
                require_once 'view/login.php'; // Si alguien intentase la nave sin estar logueado lo devolveria en a utomatico al login
            }
        ?>
        <!-- FIN ZONA DE CONTROL LOGICO -->
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col">
                    <hr>
                    <p class="text-center lead"> TecNM Campus Milpa Alta II</p>
                    <p class="text-center lead"> Enero 2021</p>
                </div>
            </div>
        </div>
    </body>
</html>