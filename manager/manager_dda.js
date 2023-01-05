$(document).on('keyup', '#buscador', function(){
  var dato_busqueda= $(this).val();
  if(dato_busqueda != ""){
    buscar(dato_busqueda);
  }else{
    //buscar();
    precargar_tabla();
  }
});


function buscar(dato_busqueda){
  $.ajax({
      type: 'POST',
      data:"busqueda=" + dato_busqueda,
      url: 'control/control_dda.php',
      success: resultado => $('#datos_de_tabla').html(resultado)
  });
}

function sigPagina(pagina){
  $.ajax({
  type: 'POST',
  data: 'pagina='+pagina,
  url:'control/control_dda.php',
  success: resultado => $('#datos_de_tabla').html(resultado)
  });
}


// Target: presentar la informacion en la interfaz de DDA y darle la funcionalidad a cada boton de la tabla

// Precargar la tabla de contenido y funcionalidad a la GUI de DDA
function precargar_tabla(){

  // Creo un ajax para generar la preconstruccion de la tabla
  $.ajax({

    /**
     * Este mapeado toma en cuenta lo siguiente:
     * - este documento JS sera parte de una view
     * - dicha view sera parte de del maquetado del index
     * - por ende esto se mapea como si estuvieramos parados en el index
     */
    url: 'control/control_dda.php',
    // Pasé el estilo a Arrow (es6)
    success: resultado => $('#datos_de_tabla').html(resultado)

  });
}

// funcion utilizada desde la preconstruccion de la tabla y los botones en esta
// con ese ID se a que usuario trabajar exactamente
function ver_pdfs(id){
  
  //console.log(id);
  
  // me aseguro q el ID se vuelva cadena y a la vez lo concateno con una bandera
  colector = "id="+id.toString();

  // Hacemos este ajax para poder mostrar los documentos solicitados
  $.ajax({

    type: 'post',
    url: 'control/control_dda_modal.php',
    data: colector,
    //inyectamos maquetado a esta vicodigo PH => 
    success: resultado => $('#documentos_usuario').html(resultado)

  });

}

function elimina_pdfs(id){

  //console.log(id);

  colector = "id="+id.toString();

  $.ajax({
    type: 'post',
    data: colector,
    url: 'control/control_dda_elimina_pdfs.php',
    success: resultado => {

      if(resultado != null){

        swal({
  
          icon: "success",
          title: "Formatos Eliminados !",
          text:  '\n\n\n Actualizando la tabla...',
          closeOnClickOutside: false,
          closeOnEsc: true,
          value: true,    

        }).then((value) => {

          window.location="dda";

        });

        return false;

      }

    }

  });

}

function autoriza_pdfs(id){

  colector = "id="+id.toString();

  $.ajax({
    type: 'post',
    data: colector,
    url: 'control/control_dda_autoriza_pdfs.php',
    success: resultado => {

      if(resultado == 1){

        swal({
  
          icon: "success",
          title: "Formatos autorizados con exito !",
          text:  '\n\n\n Actualizando la tabla...',
          closeOnClickOutside: false,
          closeOnEsc: true,
          value: true,    

        }).then((value) => {

          window.location="dda";

        });

        return false;

      }
      
    }
  });

}

$('document').ready(function(){

  precargar_tabla();

})