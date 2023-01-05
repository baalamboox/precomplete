<?php

  // inicio la sesion de existir esta
  session_start();

  // importo el codigo de la conexion a la base de datos (esta me retornma un objeto el cual me permitira manipular la conexion)
  require_once '../app/conexion.php';

  // Atrapo el objeto retornado en un objeto local de este documento
  $conexion = conexion();

  // construyo la instruccion de busqueda de usuario popr mail (dejo un ? puesto que el parametro lo blindare y despues lo aguregare de manera segura)
  $query_busqueda_usuario = 'SELECT habilitar_examen FROM usuario WHERE mail_usuario = ?';

  /** 
   * Prepara la consulta SQL y devuelve un manejador de sentencia para ser utilizado por operaciones adicionales sobre la sentencia. 
   *  - Nota: La consulta debe constar de una única sentencia SQL.
   * */
  $manejador_de_sentencia = $conexion->prepare($query_busqueda_usuario);

  // Gracias al manejador enlazo de manera segura el parametro a donde dejé el ? en el query ya preparado
  // (defino el tipo de dato, mando el dato que será el parametro)
  $manejador_de_sentencia->bind_param('s', $_SESSION['usuario']);

  // ejecuto mi manejador (y de hecho dentro de el la sentencia)
  // [La diferencia con query() es que esto es una sentencia preparada a ejecutarse y solo se logra ejecutar de esta forma]
  $manejador_de_sentencia->execute();

  // Guardo de manera local el resultado de la ejecucion anterior, este resultado lo extraigo del manejador con get_result()
  $resultado = $manejador_de_sentencia->get_result();

  /**
   * fetch_assoc()
   * 
   * Devuelve un array asociativo de strings que representa a la fila obtenida del conjunto de resultados, donde cada clave del array 
   * representa el nombre de cada una de las columnas de éste; o NULL si no hubieran más filas en dicho conjunto de resultados
   */

  //guardo en un arreglo de cadenas local el resultado extraido en ese formato específico (arreglo de cadenas)
  $arreglo_resultante = $resultado->fetch_assoc();

  /**
   * Este objeto se veria así:
   * 
   * usuario{
   *  id_usuario:21,
   *  nombre_usuario:ENRIQUE,
   *  paterno_usuario:CALDERAS,
   *  ...
   *  subio_archivos:0,
   *  dda_autorizo:0,
   *  rf_autorizo:0,
   *  habilitar_examen:0,
   *  calificacion_usuario:0,
   *  rol:0
   * }
   */

  // como testing hago la impresion del arreglo completo
  // print_r($arreglo_resultante);

  // imprimo solo una llave del arreglo
  // print_r($arreglo_resultante['habilitar_examen']);

  date_default_timezone_set('America/Mexico_City');
  setlocale(LC_TIME, 'es_MX.UTF-8');
  $fecha_actual=strftime("%Y-%m-%d");
  $hora_actual=strftime("%H:%M:%S");

  
  if($arreglo_resultante['habilitar_examen'] == 1)
    if($fecha_actual == "2021-02-04")
      echo 1;
    /*
      if($hora_actual == "09:00:00")
        echo 1;
      else
        echo 4;
        */
    else
      echo 3;
  else if($arreglo_resultante['habilitar_examen'] == 5)
    echo 5;
  else
    echo 2;
  
  // cerramos la conexion a la BD
  $conexion->close();

?>
