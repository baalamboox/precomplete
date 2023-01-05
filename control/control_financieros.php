<?php

  // iniciamos la sesion de existir esta
  session_start();
  // importamos la conexion a la base de datos
  require_once '../app/conexion.php';

  //guardamos en un objeto local el objeto que retorna la funcion conexion
  $conexion = conexion();

  //creamos el query para buscar TODO usuario que no sea admin y que ya tenga los archivos arriba y la autorizacion de DDA
  //$query = "SELECT * FROM usuario WHERE rol=0 AND subio_archivos=1 AND dda_autorizo=1";


  if(isset($_POST['busqueda'])){
    $buscar=$_POST['busqueda'];
  }else{
    $buscar="";
    $conteo=$conexion->query('SELECT * from usuario');
  }

  if(!isset($_POST['pagina'])){
		$pagina=1;
	}else{
		$pagina=$_POST['pagina']; 
	}
    $inicio=($pagina-1)*10; 

  $query = "SELECT * FROM usuario WHERE rol=0 AND (subio_archivos=1 AND dda_autorizo=1 AND nombre_usuario LIKE '%".$buscar."%') OR (subio_archivos=1 AND dda_autorizo=1 AND paterno_usuario LIKE '%".$buscar."%') OR (subio_archivos=1 AND dda_autorizo=1 AND materno_usuario LIKE '%".$buscar."%') OR (subio_archivos=1 AND dda_autorizo=1 AND carrera_usuario LIKE '%".$buscar."%') OR (subio_archivos=1 AND dda_autorizo=1 AND telefono_usuario LIKE '%".$buscar."%') OR (subio_archivos=1 AND dda_autorizo=1 AND mail_usuario LIKE '%".$buscar."%') LIMIT $inicio,10";

  /**
   * Nota: 
   * 
   *  - Como es un query simple no se necesita preparar el mismo
   * 
   *  - Para ejecutar un query simple se usa el metodo query
   * 
   */
  $resultado = $conexion->query($query); // En este momento ya tenemos un arreglo en $resultado compuesto por varias lineas (una x cada usuario encontrado)
  if(isset($_POST['busqueda'])){
		$conteo_resultados_sql=$resultado->num_rows;
	}else{
    $conteo_resultados_sql=$resultado->num_rows;
    if($conteo_resultados_sql>10){
      $conteo_resultados_sql=$conteo->num_rows;      
    }
		
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

    //Construimos las combinaciones posibles de datos que podrían existir en cada una de las lineas de $datos

    //evaluamos llaves especificas con valores especificos

    //Si ya se subieron archivos y DDA ya los autorizó...
    if(($datos['subio_archivos']==1)&&($datos['dda_autorizo']==1)&&($datos['rf_autorizo']==0)){

      //definimos la imagen con ADVERTENCIA -> que indica que RF debe de atenderlo
      //Nota: solo se necesita el nombre ya que lo concatenaremos a una ruta de HTML
      $img_estado='warning.png';
      
      //Son variables de estado... que consumiremos despues en la construccion
      //inicializamos los estados de los botones (esto permite usar los botones [atributo HTML5] )
      $estado_btn_ver='';//estan vacios para no concatenar NADA en la construccion de la tabla
      $estado_btn_autorizar='';
      $estado_btn_eliminar='';

    }else if(($datos['subio_archivos']==1)&&($datos['dda_autorizo']==1)&&($datos['rf_autorizo']==1)){

      //definimos la imagen con SUCCESS -> que indica que RF ya valido 
      //Nota: solo se necesita el nombre ya que lo concatenaremos a una ruta de HTML
      $img_estado='succes.png';

      //Son variables de estado... que consumiremos despues en la construccion
      //inicializamos los estados de los botones
      $estado_btn_ver='';
      //A estos dos los desabilitaremos
      $estado_btn_autorizar='disabled';
      $estado_btn_eliminar='disabled';

    }

    //Recordemos que seguimos dentro del While y esto ocurre linea a linea

    //Actualizamos el valor de la pretabla concatenandole una linea de la tabla en formato HTML combinandole variables PHP
    $pre_tabla=$pre_tabla.'
    <tr>
      <!-- Diseñamos el icono concatenando la variable con el nombre de la imafgen ya que la ruta es estandar -->
      <td><img id="img_estado" src="img/'.$img_estado.'" class="img-fluid" style="width:2rem;"></td>
      <!-- A partir de aqui jalamos a cada celda (o columna) cada uno de los valores leidos x llave -->
      <td>'.$datos['id_usuario'].'</td>
      <td>'.$datos['nombre_usuario'].'</td>
      <td>'.$datos['paterno_usuario'].'</td>
      <td>'.$datos['materno_usuario'].'</td>
      <td>'.$datos['telefono_usuario'].'</td>
      <td>'.$datos['mail_usuario'].'</td>
      <td>'.$datos['carrera_usuario'].'</td>
      <td>
      <!--
      /**
       * Nota:
       *  
       *  - Para el atributo onclick="" solo le puedes pasar valores enteros (ya hice test) por lo que no se logro enviar el mail directamente (osea un string), 
       *    en su lugar se manda el ID del usuario que sí es entero nativo
       */

        Por otro lado: 
        - Primero, se concatena el estado de los botones para saber si estaran deshabilitados o no 
        - Segundo, le pasamos la variable del ID del usuario que servira como detonador a la programación de este boton para su clic
                    asi sabiendo esta funcion que usuario especifico afectara con sus acciones
      -->
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

  //Cerramos la conexion a la base de datos
  $paginasTotal=round($conteo_resultados_sql/10);
  if($paginasTotal<1){
    $paginasTotal=1;
  }
  $conexion->close();

  for ($i=1; $i <=$paginasTotal ; $i++){
    $botones_pagina=$botones_pagina.'<button class="btn btn-lg btn-outline-primary mx-2" title="Pagina '.$i.'"type="button" onclick="sigPagina('.$i.')">'.$i.'</button>';
  }
  //Hacemos echo (retornamos) todo el texto que arma la tabla de contenido 
  echo '
      <table class="table table striped">
        <thead>
          <th>Estado</th>
          <th>Ficha</th>
          <th>Nombre</th>
          <th>Ap. Paterno</th>
          <th>Ap. Materno</th>
          <th>Movil</th>
          <th>Mail</th>
          <th>Carrera</th>
          <th>Ver Documentos</th>
          <th>Autorizar Documentos</th>
          <th>Eliminar Documentos</th>
        </thead>
        <tbody>
        <!-- Aqui agregamos toda la preconstruccion de linea a linea que trabajamos en el while -->
          '.$pre_tabla.'
        </tbody>
      </table>
      <div class="row justify-content-around">
        <div class="col-md-6 align-content-center text-center">
          '.$botones_pagina.'
        </div>
      <div>';

?>