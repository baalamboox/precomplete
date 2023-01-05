<!-- Traemos la dependencia que filtra a los usuarios activos del sistema -->
<?php require_once 'app/filtro_candidato.php' ?>
<div class="container">
  <div class="row mt-3">
    <div class="col">
      <div class="display-4 text-center text-capitalize">Documentaci&oacute;n del aspirante</div>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-sm-4 mt-4">
      <div class="card" style="max-width: 18rem;">
        <div class="card-body">
          <p class="card-text lead">Prepara tus documentos:</p>
          <ul>
            <li>Solo se admite formato <strong style="color: red;">PDF</strong></li>
            <li>No deben pesar m&aacute;s de <strong style="color: green;">1MB</strong></li>
            <li>Usa los siguientes nombres para cada caso:</li>
            <ul>
                <li>curp.pdf</li>
                <li>acta.pdf</li>
                <li>constancia.pdf</li>
                <li>pago.pdf</li>
                <li>domicilio.pdf</li>
              </ul>
          </ul>
          <p class="card-text">Si necesitas ajustar el peso o convertir tus imagenes a PDF visita el siguiente enlace: <a href="https://www.ilovepdf.com/es" target="_blank"><strong>Visitar</strong></a> </p>
        </div>
      </div>
      <div class="card" style="max-width: 18rem;">
        <div class="card-body">
          <p class="card-text lead">Si tus documentos ya estan listos:</p>
          <ul>
            <li>Selecciona cada uno de ellos en su apartado correspondiente</li>
            <li>Valida cada uno de ellos</li>
            <li>Al validar los 5 formatos de manera exitosa, sube tus documentos dando click al boton <span class="text-success">verde</span></li>
          </div>
      </div>
    </div>
    <div class="col-sm-8">
      <div class="row">
        <div class="col-sm-12">
          <form action="control/control_upload.php"
                  id="formulario_upload" 
                  name="formulario_upload"
                  method="post" 
                  enctype="multipart/form-data"
          >
          <div class="form-group justify-content-around py-4">
            <div class="row">
              <div class="col-sm-8">
                <label for="pdf_curp" class="lead">C U R P </label>
                <div id="pdf_curp_contenedor" class="pdf_contenedor">
                  <input 
                    type="file" 
                    class="form-control" 
                    id="pdf_curp" 
                    name="pdf_curp" 
                    accept="application/pdf"
                  >
                </div> 
              </div>
              <div class="col-sm-4">
                <div class="row mt-4">
                  <div class="col-sm-8 py-3">
                    <span class="btn btn-info btn-block" id="btn_valida_curp">Validar</span>
                  </div>
                  <div class="col-sm-4 py-2">
                    <img id="img_curp" src="img/minus.png" class="img-fluid p-2">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group justify-content-around py-4">
            <div class="row">
              <div class="col-sm-8">
                <label for="pdf_acta" class="lead">Acta de Nacimiento </label>
                <div id="pdf_acta_contenedor" class="pdf_contenedor">
                  <input 
                    type="file" 
                    class="form-control" 
                    id="pdf_acta" 
                    name="pdf_acta" 
                    accept="application/pdf"
                  >
                </div> 
              </div>
              <div class="col-sm-4">
                <div class="row mt-4">
                  <div class="col-sm-8 py-3">
                    <span class="btn btn-info btn-block" id="btn_valida_acta">Validar</span>
                  </div>
                  <div class="col-sm-4 py-2">
                    <img id="img_acta" src="img/minus.png" class="img-fluid p-2">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group justify-content-around py-4">
            <div class="row">
              <div class="col-sm-8">
                <label for="pdf_constancia" class="lead">Constancia de bachillerato / &Uacute;ltimo semestres (Media Superior)</label>
                <div id="pdf_constancia_contenedor" class="pdf_contenedor">
                  <input 
                    type="file" 
                    class="form-control" 
                    id="pdf_constancia" 
                    name="pdf_constancia" 
                    accept="application/pdf"
                  >
                </div> 
              </div>
              <div class="col-sm-4">
                <div class="row mt-4">
                  <div class="col-sm-8 py-3">
                    <span class="btn btn-info btn-block" id="btn_valida_constancia">Validar</span>
                  </div>
                  <div class="col-sm-4 py-2">
                    <img id="img_constancia" src="img/minus.png" class="img-fluid p-2">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group justify-content-around py-4">
            <div class="row">
              <div class="col-sm-8">
                <label for="pdf_pago" class="lead">Comprobante de Pago</label>
                <div id="pdf_pago_contenedor" class="pdf_contenedor">
                  <input 
                    type="file" 
                    class="form-control" 
                    id="pdf_pago" 
                    name="pdf_pago" 
                    accept="application/pdf"
                  >
                </div> 
              </div>
              <div class="col-sm-4">
                <div class="row mt-4">
                  <div class="col-sm-8 py-3">
                    <span class="btn btn-info btn-block" id="btn_valida_pago">Validar</span>
                  </div>
                  <div class="col-sm-4 py-2">
                    <img id="img_pago" src="img/minus.png" class="img-fluid p-2">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group justify-content-around py-4">
            <div class="row">
              <div class="col-sm-8">
                <label for="pdf_domicilio" class="lead">Comprobante de Domicilio</label>
                <div id="pdf_domicilio_contenedor" class="pdf_contenedor">
                  <input 
                    type="file" 
                    class="form-control" 
                    id="pdf_domicilio" 
                    name="pdf_domicilio" 
                    accept="application/pdf"
                  >
                </div> 
              </div>
              <div class="col-sm-4">
                <div class="row mt-2">
                  <div class="col-sm-8 py-3">
                    <span class="btn btn-info btn-block" id="btn_valida_domicilio">Validar</span>
                  </div>
                  <div class="col-sm-4 py-2">
                    <img id="img_domicilio" src="img/minus.png" class="img-fluid p-2">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group justify-content-around py-4">
            <label for="btn_upload" class="lead text-muted">Si acumulaste 5 palomitas verdes entonces ya puedes subir tus documentos al servidor</label>
            <label for="btn_upload" class="lead text-muted">Warning: A veces tarda un poquito el servidor , No desesperes</label>
            <br>
            <span class="btn btn-success btn-block"  id="btn_upload" name="btn_upload" disabled> Subir Documentaci&oacute;n </span>
          </div>
          <div class="form-group d-flex justify-content-end">
            <a class="btn btn-dark btn-lg" href="candidato"><span class="lead"><i class="fas fa-window-close"></i> Cancelar Proceso</span> </a>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Invocamos el manager de subida de documentos para el usuario -->
<script src="manager/manager_candidato_upload.js"></script>