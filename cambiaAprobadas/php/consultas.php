<?php
include("../../Includes/connection.php");

$opcion = $_POST['opcion'];

if($opcion == 1){

    $fecha = $_POST['fecha'];
    $consulta_requisiciones = "SELECT * FROM CREQ_REQUISICIONES_GENERAL WHERE FECHA_CAPTURA BETWEEN '".$fecha." 00:00:00' AND '".$fecha." 23:59:59' AND ESTATUS = 'ENVIADA'";
    $ejecuta_consulta_requisiciones = mysqli_query($con, $consulta_requisiciones);
    if(mysqli_num_rows($ejecuta_consulta_requisiciones)>0){
        ?>
        <table class="tabla-mes">
            <tr>
                <th class="tabla-mes__head">Clave</th>
                <th class="tabla-mes__head">Fecha Captura</th>
                <th class="tabla-mes__head">Usuario Captura</th>
                <th class="tabla-mes__head">Cambia Aprobada</th>
            </tr>
        <?php
        while($fila = mysqli_fetch_array($ejecuta_consulta_requisiciones)){

            $clave = $fila['CLAVE_REQUISICION'];
            $fecha_captura = $fila["FECHA_CAPTURA"];
            $usuario_captura = $fila["USUARIO_CAPTURA"];

            $consulta_usuario = "SELECT * FROM CREQ_USUARIOS WHERE CLAVE = '".$usuario_captura."'";
            $ejecuta_consulta_usuario = mysqli_query($con, $consulta_usuario);
            $fila_usuario = mysqli_fetch_array($ejecuta_consulta_usuario);
            $nombre_usu =  $fila_usuario['NOMBRE'];

        ?>
            <tr>
                <th class="tabla-mes" style="cursor: pointer"><a href="../Requisiciones-PDF/<?php echo $clave; ?>.pdf" target="_blank"><?php echo $clave; ?></a></th>
                <th class="tabla-mes"><?php echo $fecha_captura; ?></th>
                <th class="tabla-mes"><?php echo $nombre_usu; ?></th>
                <th class="tabla-mes">
                    <select name="aprobar" id="aprobar" onChange="cambiaEstatus('<?php echo $clave; ?>')">
                        <option value=""> ---   SELECCIONE   --- </option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                    </select>
                </th>
            </tr>
        <?php
        }
        ?>
        </table>
       <?php
    }else{
        echo "No hay requisiciones con la fecha seleccionada!";
    }
}

?>