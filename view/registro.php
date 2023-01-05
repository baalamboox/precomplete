<!-- Target: GUI para registrar nuevos usuarios en el sistema -->

<div class="container-fluid mt-3">
  <div class="row justify-content-around bg-light border shadow py-4">
    <div class="col">
      <div class="display-4 text-center">
        Registro para nuevos aspirantes
      </div>
    </div>
  </div>
  <div class="row justify-content-around py-4">
    <div class="col-sm-5 mt-1">
      <div style="font-size: 3rem;" class="lead">
        <i class="fas fa-user-plus mr-4"></i>
        Datos Personales
      </div>
      <hr>
      <form id="formulario_registro_a"><!--ID Muy importante para manipular el formulario en conjunto desde JS-->
        <div class="form-group">
          <label for="registro_nombre" class="lead">Nombre(s)</label>
          <!--Cada input debe de tener su ID para una posterior manipulacion de su información-->
          <input 
            type="text" 
            class="form-control form-control-sm" 
            id="registro_nombre" 
            name="registro_nombre" 
          >
        </div>
        <div class="form-group">
          <label for="registro_paterno" class="lead">Apellido Paterno</label>
          <input 
            type="text" 
            class="form-control form-control-sm" 
            id="registro_paterno" 
            name="registro_paterno" 
          >
        </div>
        <div class="form-group">
          <label for="registro_materno" class="lead">Apellido Materno</label>
          <input 
            type="text" 
            class="form-control form-control-sm" 
            id="registro_materno" 
            name="registro_materno" 
          >
        </div>
        <div class="form-group">
          <label for="registro_fecha_nacimiento" class="lead">Fecha de nacimiento</label>
          <input 
            type="date" 
            class="form-control form-control-sm" 
            id="registro_fecha_nacimiento" 
            name="registro_fecha_nacimiento" 
          >
        </div>
        <div class="form-group">
          <label for="registro_telefono" class="lead">Tel&eacute;fono de contacto (Preferente M&oacute;vil)</label>
          <input 
            type="number" 
            class="form-control form-control-sm" 
            id="registro_telefono" 
            name="registro_telefono" 
          >
        </div>
        <div class="form-group">
          <label for="registro_carrera" class="lead">Carrera de tu elección</label>
          <select id="registro_carrera" name="registro_carrera" class="form-control form-control-sm" >
            <option value="">Seleccionar</option>
            <option value="GES">Ingeniería En Gestión Empresarial</option>
            <option value="IND">Ingeniería Industrial</option>
            <option value="SIS">Ingeniería En Sistemas Computacionales</option>
          </select>
        </div>
      </form>
    </div>
    <div class="col-sm-5 mt-1">
    <div style="font-size: 3rem;" class="lead">
      <i class="fas fa-user-shield mr-3"></i>
      Datos para iniciar sesión
    </div>
    <hr>
      <form id="formulario_registro_b"><!--ID Muy importante para manipular el formulario en conjunto desde JS-->
        <div class="form-group">
          <label for="registro_mail" class="lead">Mail Personal</label>
          <input 
            type="email" 
            class="form-control form-control-sm" 
            id="registro_mail" 
            name="registro_mail" 
          >
        </div>
        <div class="form-group">
          <label for="registro_mail_confirmacion" class="lead">Confirma tu <strong>Mail Personal</strong></label>
          <input 
            type="email" 
            class="form-control form-control-sm" 
            id="registro_mail_confirmacion" 
            name="registro_mail_confirmacion" 
          >
        </div>
        <div class="form-group">
          <label for="registro_password" class="lead">Password</label>
          <input 
            type="password" 
            class="form-control form-control-sm" 
            id="registro_password"
            name="registro_password" 
          >
        </div>
        <div class="form-group">
          <label for="registro_password_confirmacion" class="lead">Confirmar <strong>Password</strong></label>
          <input 
            type="password" 
            class="form-control form-control-sm" 
            id="registro_password_confirmacion"
            name="registro_password_confirmacion" 
          >
        </div>
        <div class="form-group">
          <!-- Programacion del boton por span para evitar recargar la pagina -->
          <span class="btn btn-success btn-block" id="btn_registro_usuario">
            <span class="lead">
              <i class="fas fa-plus-circle mr-2"></i>
              <strong>Registrarse</strong>
            </span>
          </span>
        </div>
        <div class="form-group d-flex justify-content-end">
          <!-- Navegacion simple por etiqueta a, pero pasando soli una palabra valida de las rutas amigables definidas en los casos del index -->
          <a class="btn btn-dark btn-lg" href="login">
            <span class="lead">
              <i class="fas fa-window-close"></i> 
              Cancelar
            </span>
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Importacion del manager en JS -->
<script src="manager/manager_registro.js"></script>