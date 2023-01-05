
<?php
  require_once 'app/filtro_candidato.php';
?>
    <div class="container mt-4">
      <div class="row">
        <div class="col">
          <div class="display-3 text-center">Panel de Aspirante</div>
        </div>
      </div>

      <div class="row mt-4 d-flex justify-content-around">
        <div class="col-sm-5">

          <div class="card" style="width: 100%;">
            <img src="img/upload.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title text-center">Subir archivos</h5>
              <p class="card-text text-justify mt-2">
                En este apartado podrás subir tu documentación en formato 
                <strong style="color: red;">PDF</strong> con un peso de hasta 
                <strong style="color: green;">1MB</strong> por cada documento
              </p>
              <a href="upload" class="btn btn-primary btn-block" id="btn_go_upload">Vamos</a>
            </div>
          </div>

        </div>
        <div class="col-sm-5">

          <div class="card " style="width: 100%;">
            <div class="d-flex justify-content-center">
              <img src="img/test.png" class="card-img-top imgen-panel-candidato" alt="...">
            </div>
            <div class="card-body">
              <div id="kike">
              <h4 class="card-text text-justify">
                El acceso al exámen aparecerá aquí:
              </h4>
              </div>
              <div class="mt-4" id="habilitar_examen"></div>
            </div>
          </div>

        </div>
      </div>

    </div>

    <script src="manager/manager_candidato_info_mostrar.js"></script>

