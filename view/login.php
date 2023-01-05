<!-- Target: GUI para iniciar sesion en el sistema -->
<?php
    /**
     * Se crean la validaciones para una correcta navegacion
     * 
     * Nota: Recordemos que en este momento ya hay un inicio de sesion por el
     *       session_start() que esta declarado en el index(linea 4), documento al cual 
     *       se integrará esta programación
     * 
     * A continuacion esta coleccion de ifs se encargan de saber si ya hay un usuario
     * logueado en el sistema y clasificar su destino de ser este el caso
     * 
     * Recordemos que esta interfaz solo puede ser visitada por usuarios no logueados
     * 
     * Esto a la larga evita fallos en la programacion al no permitir doble inicio de sesion
     */
    //si usuario es diferente a vacio...
    if($usuario != "") {
        //Si usuario es exactamente DDA
        if($usuario == "dda_milpaalta2@tecnm.mx") {
            //mandalo a su interfaz (se usa notacion de ruta amigable)
            header("location:dda");
            //Si el susuario es exactamente RF
        } else if($usuario == "acad_milpaalta2@tecnm.mx") {
            header("location:admon_dda");  
        } else if($usuario == "rf_milpaalta2qtecnm.mx") {
            //mandalo a su interfaz (se usa notacion de ruta amigable)
            header("location:financieros");
            // de lo contrario, si no fué ninguno de los anteriores pero es un usuario logueado
        } else if($usuario == "admon_milpaalta2qtecnm.mx") {
            header("location:admon_financieros");
        } else {
            // mandalo a la interfáz de candidato
            header("location:candidato");
        }
        // de lo contrario si no hay ningun usuario logueado.... muestra la interfaz...
    } else {
?>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="text-center">Sistema de preinscripción</div>
                </div>
            </div>
            
            <div class="row">
                <!-- <div class="col animado">Testing manual -->
                <div class="col">
                    <div id="rectangulo" class="display-3 text-center">
                        TecNM Campus Milpa Alta II
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">

                    <div class="card border-0" style="width: 18rem;">
                        <img class="card-img-top animate__animated animate__bounce" src="img/logo.png" alt="Card image cap">
                        <!--jalo bien para la imagen-->
                        <div class="card-body">

                            <form id="formulario_ingreso">
                                <div class="form-group d-flex justify-content-end">
                                    <a class="badge badge-light" href="registro">Registrarse</a>
                                </div>
                                <div class="form-group">
                                    <label for="ingreso_mail">Correo electrónico</label>
                                    <input type="text" class="form-control" id="ingreso_mail" name="ingreso_mail"
                                        placeholder="Ingresa tu mail">
                                </div>
                                <div class="form-group">
                                    <label for="ingreso_password">Password</label>
                                    <input type="password" class="form-control" id="ingreso_password" name="ingreso_password"
                                        placeholder="Password">
                                </div>
                                <div class="form-check d-flex justify-content-end">
                                    <span class="btn btn-dark" id="btn_ingreso_sistema">Entrar</span>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
                <div class="col-sm-4"></div>
            </div>
        </div>
        <!-- Funcionalidad de la vista -->
        <script src="manager/manager_login.js"></script>
<?php  
    }
?>