<?php

  session_start();

  unset($_SESSION['usuario']);
  session_destroy();

  //header("location:login");
  echo "<script>window.location='login'</script>";

?>