<?php

  // echo $_POST['id']; // Verificacion de que SI llego correctamente el ID

  // inicio la variable de sesion si es que esta existe
  session_start();

  // importo la programacion de la conexion a la base de datos
  require_once '../app/conexion.php';

  // bajamos el objeto de la conexion a una variable local
  $conexion = conexion();

  // creamos la busqueda para la base de datos (esta sera simple)
  $query = "SELECT * FROM usuario WHERE id_usuario={$_POST['id']}";

  // ejecutamos la busqueda en la base de datos
  $resultado = $conexion->query($query);

  // generamos un arreglo asociativo con los datos de la busqueda gracis a fech_assoc
  $datos = $resultado->fetch_assoc();

  //echo $datos['mail_usuario'];
  
  // Cerramos la conexion a la base de datos
  $conexion->close();

  /**
   * Nota: - la busqueda anterior fue para traer los datos del usuario que buscamos por ID
   *       
   *       - el dato en especial que queremos es el mail
   */

  // creamos una variable que guarde el path completo de la posible busqueda donde revisaremos 
  // si ya existe una carpeta con el mail del usuario buscado
  // este mapeo se hace desde este archivo logico por eso va completo
  $sub_directorio = "../archivo/".$datos['mail_usuario'];

  // creamos una subruta que guarde solo la ultima carpeta y el mail del usuario buscado ya que lo usare para jalar el documento q me interese
  // Nota: dado que esto se usara en un HTML y ese HTML se hará parte del index, entonces el mapeo es diferente, se hace como si estuvieras en 
  //       el index (por eso es mas corto que $sub_directorio)
  $path = "archivo/".$datos['mail_usuario'];
  //echo $sub_directorio;

  // verificamos que el directorio con la carpeta del mail exista
  if(!file_exists($sub_directorio)){
    // Logica inversa... Si no existe... avisa con el echo (recuerda que es un return)
    echo "no existe";
  }else{

    //Logica inversa... Si si existe el directorio... fabrico con el echo el HTML para mostrar los documentos
    //Nota: esto se lo voy a inyectar a la view de la ventana emergente
    echo '
      <div class="row">
        <div class="col">
          <h1 class="text-center">Comprobante de Pago</h1>
          <div class="embed-responsive embed-responsive-1by1 mt-2">
          <!-- Concateno la variable path para llegar al documento que quiero mostrar -->
            <iframe class="embed-responsive-item" src="'.$path.'/pago.pdf"></iframe>
          </div>
        </div>
      </div>

      
    ';

  }

?>


