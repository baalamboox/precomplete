function subir_documento(){

  let pdf_colector = new FormData ($('#formulario_upload')[0]);

  $.ajax({

    url: 'control/control_upload.php',
    type: 'post',
    data: pdf_colector,
    processData: false,
    contentType: false,
    success: function(resultado){

      obj_resultado = JSON.parse(resultado);

      resultado_curp = obj_resultado['resultado_curp'].toString();
      resultado_acta = obj_resultado['resultado_acta'].toString();
      resultado_constancia = obj_resultado['resultado_constancia'].toString();
      resultado_pago = obj_resultado['resultado_pago'].toString();
      resultado_domicilio = obj_resultado['resultado_domicilio'].toString();

      if(!(resultado_curp == 'ok')){

        swal('Upps', 'Existe un error en la CURP:\n ' + resultado['resultado_curp'], 'error');
        return false;

      }else{

        if(!(resultado_acta == 'ok')){

          //$('#formulario_upload')[0].reset();
          //mostrar_datos(); //comentada de momento xq aun no lo voy a testear
          swal('Upps', 'Existe un error en el Acta de Nacimiento: \n' + resultado['resultado_acta'], 'error');
          return false;
  
        }else{
  
          if(!(resultado_constancia == 'ok')){

            //$('#formulario_upload')[0].reset();
            //mostrar_datos(); //comentada de momento xq aun no lo voy a testear
            swal('Upps', 'Existe un error en la Constancia de Estudios: \n' + resultado['resultado_constancia'], 'error');
            return false;
    
          }else{
  
            if(!(resultado_pago == 'ok')){

              //$('#formulario_upload')[0].reset();
              //mostrar_datos(); //comentada de momento xq aun no lo voy a testear
              swal('Upps', 'Existe un error en el Comprobante de Pago: \n' + resultado['resultado_pago'], 'error');
              return false;
      
            }else{

              if(!(resultado_domicilio == 'ok')){

                swal('Upps', 'Existe un error en el Comprobante de Domicilio: \n' + resultado['resultado_domicilio'], 'error');
                return false;

              }else{

                // Lo dejo comentado xq no se para que lo usaba no hace mucho en realidad
                // $.ajax({

                //   type: 'GET',
                //   url: '../view/candidato_home.php',
                //   data: 'upload=ok'
  
                // });
  
                swal({
  
                  icon: "success",
                  title: "Tus formatos ya están en el servidor !!!",
                  text:  '\n\n\n Un ejecutivo de ITMA 2 se comunicará contigo a la brevedad'+
                          '\n\n Indicandote el siguiente paso en tu proceso y la fecha de examen',
                  closeOnClickOutside: false,
                  closeOnEsc: true,
                  value: true,    
  
                }).then((value) => {
  
                  window.location="candidato";
  
                });
  
                return false;

              }

            }

          }

        }
      
      }

    }

  });

}

$(document).ready(function(){
  
  $('#btn_valida_curp').click(function(){
    
    if($('#pdf_curp').val() == ""){

      swal('Upps', 'No has cargado ningun documento', 'error');
      return false;

    }else{

      var pdf_colector = new FormData ($('#formulario_upload')[0]);
      pdf_colector.append("pdf", "curp");

      $.ajax({

        url: 'control/control_valida_upload.php',
        type: 'post',
        data: pdf_colector,
        processData: false,
        contentType: false,
        success: function(resultado){
    
          console.log(resultado);

          if(!(resultado == "ok")){

            $('#img_curp').attr("src","img/error.png");
            swal('Upps', resultado, 'error');
            return false;

          }else{

            $('#img_curp').attr("src","img/succes.png");
            //$('#pdf_curp').hide();
            $('#pdf_curp').prop("readonly", true);
            //$('#pdf_curp_contenedor').text("Documento Aceptado");
            //$('#btn_valida_curp').hide();
            //$('#pdf_curp').prop("disabled", true);
            swal('Perfecto', 'Tu documento cumple con los requisitos', 'success');
            return false;

          }

        }
    
      });

    }

  });

  $('#btn_valida_acta').click(function(){
    
    if($('#pdf_acta').val() == ""){

      swal('Upps', 'No has cargado ningun documento', 'error');
      return false;

    }else{

      var pdf_colector = new FormData ($('#formulario_upload')[0]);
      pdf_colector.append("pdf", "acta");

      $.ajax({

        url: 'control/control_valida_upload.php',
        type: 'post',
        data: pdf_colector,
        processData: false,
        contentType: false,
        success: function(resultado){
    
          console.log(resultado);

          if(!(resultado == "ok")){

            $('#img_acta').attr("src","img/error.png");
            swal('Upps', resultado, 'error');
            return false;

          }else{

            $('#img_acta').attr("src","img/succes.png");
            $('#pdf_acta').prop("readonly", true);
            //$('#pdf_acta').();
            //$('#pdf_acta').hide();
            //$('#pdf_acta_contenedor').text("Documento Aceptado");
            //$('#btn_valida_acta').hide();
            swal('Perfecto', 'Tu documento cumple con los requisitos', 'success');
            return false;

          }

        }
    
      });

    }

  });

  $('#btn_valida_constancia').click(function(){
    
    if($('#pdf_constancia').val() == ""){

      swal('Upps', 'No has cargado ningun documento', 'error');
      return false;

    }else{

      /**
       * Con esta forma podemos jalar todos los inputs de una vez siempre y cuando estos tengan 
       * el atributo NAME ya que a travez de el se lee el campo
       * 
       * Nota: no se jalar solo uno
       * 
       * var pdf_colector = new FormData ($('#formulario_upload')[0]);
       * pdf_colector.append("pdf", "constancia");  //esta line es para agregar info extra al arreglo y se lee desde el otro lado con POST en lugar de FILES
       * */

      var pdf_colector = new FormData ($('#formulario_upload')[0]);
      pdf_colector.append("pdf", "constancia");

      $.ajax({

        url: 'control/control_valida_upload.php',
        type: 'post',
        data: pdf_colector,
        processData: false,
        contentType: false,
        success: function(resultado){
    
          console.log(resultado);

          if(!(resultado == "ok")){

            $('#img_constancia').attr("src","img/error.png");
            swal('Upps', resultado, 'error');
            return false;

          }else{

            $('#img_constancia').attr("src","img/succes.png");
            $('#pdf_constancia').prop("readonly", true);
            //$('#pdf_constancia').hide();
            //$('#pdf_constancia_contenedor').text("Documento Aceptado");
            //$('#btn_valida_constancia').hide();
            swal('Perfecto', 'Tu documento cumple con los requisitos', 'success');
            return false;

          }

        }
    
      });

    }

  });

  $('#btn_valida_pago').click(function(){
    if($('#pdf_pago').val() == ""){

      swal('Upps', 'No has cargado ningun documento', 'error');
      return false;

    }else{

      /**
       * Con esta forma podemos jalar todos los inputs de una vez siempre y cuando estos tengan 
       * el atributo NAME ya que a travez de el se lee el campo
       * 
       * Nota: no se jalar solo uno
       * 
       * var pdf_colector = new FormData ($('#formulario_upload')[0]);
       * pdf_colector.append("pdf", "constancia");  //esta line es para agregar info extra al arreglo y se lee desde el otro lado con POST en lugar de FILES
       * */

      var pdf_colector = new FormData ($('#formulario_upload')[0]);
      pdf_colector.append("pdf", "pago");

      $.ajax({

        url: 'control/control_valida_upload.php',
        type: 'post',
        data: pdf_colector,
        processData: false,
        contentType: false,
        success: function(resultado){
    
          console.log(resultado);

          if(!(resultado == "ok")){

            $('#img_pago').attr("src","img/error.png");
            swal('Upps', resultado, 'error');
            return false;

          }else{

            $('#img_pago').attr("src","img/succes.png");
            $('#pdf_pago').prop("readonly", true);
            //$('#pdf_pago').hide();
            //$('#pdf_pago_contenedor').text("Documento Aceptado");
            //$('#btn_valida_pago').hide();
            swal('Perfecto', 'Tu documento cumple con los requisitos', 'success');
            return false;

          }

        }
    
      });

    }

  });

  $('#btn_valida_domicilio').click(function(){
    if($('#pdf_domicilio').val() == ""){

      swal('Upps', 'No has cargado ningun documento', 'error');
      return false;

    }else{

      var pdf_colector = new FormData ($('#formulario_upload')[0]);
      pdf_colector.append("pdf", "domicilio");

      $.ajax({

        url: 'control/control_valida_upload.php',
        type: 'post',
        data: pdf_colector,
        processData: false,
        contentType: false,
        success: function(resultado){
    
          console.log(resultado);

          if(!(resultado == "ok")){

            $('#img_domicilio').attr("src","img/error.png");
            swal('Upps', resultado, 'error');
            return false;

          }else{

            $('#img_domicilio').attr("src","img/succes.png");
            $('#pdf_domicilio').prop("readonly", true);
            //$('#pdf_pago').hide();
            //$('#pdf_pago_contenedor').text("Documento Aceptado");
            //$('#btn_valida_pago').hide();
            swal('Perfecto', 'Tu documento cumple con los requisitos', 'success');
            return false;

          }

        }
    
      });

    }

  });

  $('#btn_upload').click(function(){

    if ($('#img_curp').attr("src") != "img/succes.png"){

      swal('Upps', 'Todavia hay errores en el documento de curp', 'error');
      return false;

    }else{

      if ($('#img_acta').attr("src") != "img/succes.png"){

        swal('Upps', 'Todavia hay errores en el documento de acta', 'error');
        return false;
  
      }else{
  
        if ($('#img_constancia').attr("src") != "img/succes.png"){

          swal('Upps', 'Todavia hay errores en el documento de constancia', 'error');
          return false;
    
        }else{
    
          if ($('#img_pago').attr("src") != "img/succes.png"){

            swal('Upps', 'Todavia hay errores en el documento de pago', 'error');
            return false;
      
          }else{
      
            if ($('#img_domicilio').attr("src") != "img/succes.png"){

              swal('Upps', 'Todavia hay errores en el documento de domicilio', 'error');
              return false;
        
            }else{
        
              subir_documento();
        
            }
      
          }
    
        }
  
      }

    }

  });

});