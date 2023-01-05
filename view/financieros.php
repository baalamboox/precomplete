<!-- 
  Target: Home de la cuenta RF
  Nota: es un esqueleto ya que los datos reales se forman desde PHP
-->

<?php
  //validamos que la variable global SESSION sea diferente de null
  if(isset($_SESSION['usuario'])){
    //validamos que el usuario que esta logueado sea específicamente RF
    if($_SESSION['usuario'] == "rf_milpaalta2@tecnm.mx"){

?>
      <div class="container-fluid mt-4">
        <div class="row">
          <div class="col">
            <!-- inicio: construccion de la card -->
            <div class="card bg-light mb-3">
                <div class="card-header">
                  <i class="fab fa-battle-net mr-2" style="font-size: 35;"></i>
                </div>
                <div class="card-body">
                  <div class="row mt-1 mb-2">
                    <div class="col-md-5">
                      <input type="text" class="form-control input" name="buscador" id="buscador" placeholder="Buscar">
                    </div>
                    <div class="col-md-2">
                      <a href="php/excel.php" class="btn border border-dark btn-light mr-2" type="button">Excel</a>
                      <a href="php/pdf.php" class="btn border border-dark btn-light mr-2">PDF</a>
                    </div>
                    <div class="col-md-12">
                      <hr>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="row">
                        <div class="col-sm-2">
                          <img id="img_estado" src="img/error.png" class="img-fluid" style="width:2rem;">
                        </div>
                        <div class="col-sm-10">
                          <p class="lead">No han subido documentos</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-2">
                          <img id="img_estado" src="img/warning.png" class="img-fluid" style="width:2rem;">
                        </div>
                        <div class="col-sm-10">
                          <p class="lead">Documentos listos para revisar</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-2">
                          <img id="img_estado" src="img/succes.png" class="img-fluid" style="width:2rem;">
                        </div>
                        <div class="col-sm-10">
                          <p class="lead">Aprobaste los documentos</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- inicio: construccion del espacio para el boton de agregar con icono -->
                  <div class="row">
                    <div class="col">
                      <div class="table-wrapper-scroll-y">
                        <!-- Aqui se crearán los datos de la tabla gracias a la inyección de datos de PHP -->
                        <div id="datos_de_tabla" class="mt-3"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer lead text-muted text-right">
                  By Coder 
                </div>
              </div>
          </div>
        </div>
      </div>

      <script src="manager/manager_financieros.js"></script>

<?php
      //importación de la ventana para cargar los documentos en la interfaz
      require_once 'view/financieros_modal.php';

    }else{

      //si no eres RF te mandamos a login
      header('location:login');

    }

  }else{

    //si no hay sesion iniciada te mandamos a login
    header('location:login');

  }

?>