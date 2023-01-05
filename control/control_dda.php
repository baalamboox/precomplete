<?php

  // iniciamos la sesion de existir esta
  session_start();
  // importamos la conexion a la base de datos
  require_once '../app/conexion.php';

  //guardamos en un objeto local el objeto que retorna la funcion conexion
  $conexion = conexion();
  
  //creamos el query para buscar TODO usuario que no sea admin y que ya tenga los archivos arriba y la autorizacion de DDA
  //$query = "SELECT * FROM usuario WHERE rol=0";
  if(isset($_POST['busqueda'])){
    $buscar=$_POST['busqueda'];
  }else{
    $buscar="";
    $conteo=$conexion->query('SELECT * from usuario');
  }

  if(!isset($_POST['pagina'])){
		$pagina=1;
	}else{
		$pagina=( int )$_POST['pagina']; 
	}
    $inicio=($pagina-1)*10;  

    
	  
  
  $query = "SELECT * FROM usuario WHERE rol=0 AND (nombre_usuario LIKE '%".$buscar."%') OR (paterno_usuario LIKE '%".$buscar."%') OR (materno_usuario LIKE '%".$buscar."%') OR (carrera_usuario LIKE '%".$buscar."%') OR (telefono_usuario LIKE '%".$buscar."%') OR (mail_usuario LIKE '%".$buscar."%') LIMIT $inicio,10";
 

  /**
   * Nota: 
   * 
   *  - Como es un query simple no se necesita preparar el mismo
   * 
   *  - Para ejecutar un query simple se usa el metodo query
   * 
   */
  $resultado = $conexion->query($query);// En este momento ya tenemos un arreglo en $resultado compuesto por varias lineas (una x cada usuario encontrado)
  if(isset($_POST['busqueda'])){
		$conteo_resultados_sql=$resultado->num_rows;
	}else{
		$conteo_resultados_sql=$conteo->num_rows;
	}
  
  // Creamos una variable tipo cadena para que en esta se almacene contenido
  $pre_tabla="";
  $estado_btn_ver='';
  $estado_btn_autorizar='';
  $estado_btn_eliminar='';
  $botones_pagina='';

  /**
   *  - While inicia su evaluación...
   *    - En sus parentesis pasa que primero FECH_ASSOC lee una linea de su propio arreglo a la vez
   *      - si su linea tiene info esta se la da a $datos  (equivalente a un TRUE)
   *      - si su linea ya no tiene datos este da null y ya no se hace la asignacion a $datos (equivalente a un FALSE)
   *    
   *    - Estos dos posibles resultados en las asignaciones son leidas por el while ya que TODO esto esta pasando en sus parentesis 
   * 
   *    - Por ende...
   * 
   *      -  Mientras fech_assoc logre asignarle una nueva linea a $resultados...  Entonces entramos al bucle...   ( y while entonces funcionará por cada line que te de fech_assoc )
   */

  // obtener un array asociativo
  
  while($datos = $resultado->fetch_assoc()){

    if($datos['subio_archivos']==0){

      $img_estado='error.png';
      $estado_btn_ver='disabled';
      $estado_btn_autorizar='disabled';
      $estado_btn_eliminar='disabled';

    }else if(($datos['subio_archivos']==1)&&($datos['dda_autorizo']==0)){

      $img_estado='warning.png';
      $estado_btn_ver='';
      $estado_btn_autorizar='';
      $estado_btn_eliminar='';

    }else if(($datos['subio_archivos']==1)&&($datos['dda_autorizo']==1)){

      $img_estado='succes.png';
      $estado_btn_ver='';
      $estado_btn_autorizar='disabled';
      $estado_btn_eliminar='disabled';

    }

    $pre_tabla=$pre_tabla.'
    <tr>
      <td><img id="img_estado" src="img/'.$img_estado.'" class="img-fluid" style="width:2rem;"></td>
      <td>'.$datos['id_usuario'].'</td>
      <td>'.$datos['nombre_usuario'].'</td>
      <td>'.$datos['paterno_usuario'].'</td>
      <td>'.$datos['materno_usuario'].'</td>
      <td>'.$datos['telefono_usuario'].'</td>
      <td>'.$datos['mail_usuario'].'</td>
      <td>'.$datos['carrera_usuario'].'</td>
      <td>'.$datos['calificacion_usuario'].'</td>
      <td>
        <button '.$estado_btn_ver.' type="button" class="btn btn-warning" onclick="ver_pdfs('.$datos['id_usuario'].')"><i class="fas fa-eye"></i></button>
      </td>
      <td>
        <button '.$estado_btn_autorizar.' type="button" class="btn btn-success" onclick="autoriza_pdfs('.$datos['id_usuario'].')"><i class="fas fa-check-circle"></i></button>
      </td>
      <td>
        <button '.$estado_btn_eliminar.' type="button" class="btn btn-danger" onclick="elimina_pdfs('.$datos['id_usuario'].')"><i class="fas fa-trash-alt"></i></button>
      </td>
    </tr>';

  }
  $paginasTotal=round($conteo_resultados_sql/10);
  $conexion->close();

  for ($i=1; $i <=$paginasTotal ; $i++){
    $botones_pagina=$botones_pagina.'<button class="btn btn-lg btn-outline-primary mx-2" title="Pagina '.$i.'"type="button" onclick="sigPagina('.$i.')">'.$i.'</button>';
  }

  echo '
      <table class="table table striped" id="tabla_de_datos">
        <thead>
          <th>Estado</th>
          <th>Ficha</th>
          <th>Nombre</th>
          <th>Ap. Paterno</th>
          <th>Ap. Materno</th>
          <th>Movil</th>
          <th>Mail</th>
          <th>Carrera</th>
          <th>Calificacion</th>
          <th>Ver Documentos</th>
          <th>Autorizar Documentos</th>
          <th>Eliminar Documentos</th>
        </thead>
        <tbody>
          '.$pre_tabla.'
        </tbody>
      </table> 
      <div class="row justify-content-around">
        <div class="col-md-6 align-content-center text-center">
          '.$botones_pagina.'
        </div>
      <div>
      ';

?>