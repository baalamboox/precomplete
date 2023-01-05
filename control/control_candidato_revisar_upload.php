<?php
  // iniciamos la sesion del usuario de existir esta
  // una vez que logramos hacer el login asi que hasta que no se destuya la variable
  // esta puede verse en todos los documentos PHP (visuales o logicos del sistema)

  // Nota: Todo documento que se use en la navegacion debe de tener un sesion start para ser un documento validado
  session_start();
  
  //print_r($_SESSION['usuario']);//testing exitoso
  //print_r("\n");// para que se escape bien el salto de line usa comillas dobles

  /**
    * Hack: - es evidente que debe de existir un usuario logueado para ver esta ventana
    *         - como existe, entonces lo uso para saber de que usuario quiero saber si sus documentos ya estan arriba 
    */


  /**
   * Comprobamos que exista la carpeta de archivos del usuario logueado
   *  - Si esta existe entonces hacemos echo 1 (retornamos 1)
   *  - Si No existe la carpeta entonces hacemos echo 0 (retornamos 0)
   */
  if(file_exists("../archivo/".$_SESSION['usuario'])){
    //print_r('Existe su directorio');
    echo 1;
  }else{
    //print_r('Brick...... NOO Existe su directorio');
    echo 0;
  }
?>