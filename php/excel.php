<?php
    header('Content-type:application/xls');
    header('Content-Disposition: attachment; filename=Registro.xls');

    require_once('../app/conexion.php');
    // $conn=new Conexion();
    // $link = $conn->conectarse();

    $conexion = conexion();

    $query="SELECT * FROM usuario";

    $result=mysqli_query($conexion, $query);
?>

<table border="1">
    <tr style="background-color:rgb(10,148,68);">
        <th>Nombre</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Fecha de Nacimiento</th>
        <th>Telefono</th>
        <th>Carrera</th>
        <th>Mail</th>
        <th>Calificacion</th>
    </tr>
    <?php
        while ($row=mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $row['nombre_usuario']; ?></td>
                    <td><?php echo $row['paterno_usuario']; ?></td>
                    <td><?php echo $row['materno_usuario']; ?></td>
                    <td><?php echo $row['fecha_nacimiento_usuario']; ?></td>
                    <td><?php echo $row['telefono_usuario']; ?></td>
                    <td><?php echo $row['carrera_usuario']; ?></td>
                    <td><?php echo $row['mail_usuario']; ?></td>
                    <td><?php echo $row['calificacion_usuario']; ?></td>
                </tr>

            <?php
        }

    ?>
</table>