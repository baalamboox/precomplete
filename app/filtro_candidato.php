<?php

  if(isset($_SESSION['usuario'])){

    if($_SESSION['usuario'] == "dda_milpaalta2@tecnm.mx" ){

      header("location:dda");

    }else if( $_SESSION['usuario'] == "acad_milpaalta2@tecnm.mx"){
      header("location:acad_dda");
    
    }else if($_SESSION['usuario'] == "rf_milpaalta2@tecnm.mx"){

      header("location:financieros");
      
    }else if($_SESSION['usuario'] == "admon_milpaalta2@tecnm.mx"){

      header("location:admon_financieros");

    }else{
      // este hace la magia: la pagina se queda porque no estoy haciendo nada, 
      // simple los otros te van a correr si te identifican sino te quedas
    }

  }else{
  
      header("location:login");
      
  }
?>