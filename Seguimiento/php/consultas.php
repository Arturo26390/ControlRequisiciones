<?php
include("../../Includes/connection.php");

$opcion = $_POST['opcion'];

if($opcion == 1){

    $fecha = $_POST['fecha'];
    $consulta_requisiciones = "SELECT * FROM CREQ_REQUISICIONES_GENERAL WHERE FECHA_CAPTURA BETWEEN '".$fecha." 00:00:00' AND '".$fecha." 23:59:59'";
    $ejecuta_consulta_requisiciones = mysqli_query($con, $consulta_requisiciones);

       ?>
        <table class="tabla-mes">
            <tr>
                <th class="tabla-mes__head">Clave</th>
                <th class="tabla-mes__head">Fecha Captura</th>
                <th class="tabla-mes__head">Usuario Captura</th>
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
                <th class="tabla-mes" style="cursor: pointer" onClick="muestraDetalle('<?php echo $clave; ?>')"><?php echo $clave; ?></th>
                <th class="tabla-mes"><?php echo $fecha_captura; ?></th>
                <th class="tabla-mes"><?php echo $nombre_usu; ?></th>
            </tr>
        <?php
        }
        ?>
        </table>
       <?php
}

if($opcion == 2){

    $requisicion = $_POST['requisicion'];
    $consulta_requisiciones = "SELECT * FROM CREQ_REQUISICIONES_GENERAL WHERE CLAVE_REQUISICION = '".$requisicion."'";
    $ejecuta_consulta_requisiciones = mysqli_query($con, $consulta_requisiciones);

       ?>
        <table class="tabla-mes">
            <tr>
                <th class="tabla-mes__head">Prioridad</th>
                <th class="tabla-mes__head">Patente</th>
                <th class="tabla-mes__head">Departamento</th>
            </tr>
        <?php
        while($fila = mysqli_fetch_array($ejecuta_consulta_requisiciones)){

            $prioridad = $fila['PRIORIDAD'];
            $patente = $fila["PATENTE"];
            $departamento = $fila["DEPARTAMENTO"];

            $consulta_departamento = "SELECT * FROM CREQ_DEPARTAMENTOS WHERE ID = '".$departamento."'";
            $ejecuta_consulta_departamento = mysqli_query($con, $consulta_departamento);
            $fila_departamento = mysqli_fetch_array($ejecuta_consulta_departamento);
            $nombre_dep =  $fila_departamento['NOMBRE'];

        ?>
            <tr>
                <th class="tabla-mes"><?php echo $prioridad; ?></th>
                <th class="tabla-mes"><?php echo $patente; ?></th>
                <th class="tabla-mes"><?php echo $nombre_dep; ?></th>
            </tr>
        <?php
        }
        ?>
        </table>
        <table class="tabla-mes">
            <tr>
                <th class="tabla-mes__head">PRODUCTO</th>
                <th class="tabla-mes__head">CANTIDAD</th>
                <th class="tabla-mes__head">OBSERVACIONES</th>
                <th class="tabla-mes__head">RECIBIR</th>
                <th class="tabla-mes__head oculto" id="encabezado_extra1">PENDIENTES</th>
                <th class="tabla-mes__head oculto" id="encabezado_extra2">CANTIDAD ENTREGADA</th>
            </tr>
            <?php 
            $consulta_requisiciones_detalle = "SELECT * FROM CREQ_REQUISICIONES_DETALLE WHERE CLAVE_REQUISICION = '".$requisicion."'";
            $ejecuta_consulta_requisiciones_detalle = mysqli_query($con, $consulta_requisiciones_detalle);
            
            $var1 = 1;
            while($fila_detalle = mysqli_fetch_array($ejecuta_consulta_requisiciones_detalle)){
                $clave_producto =  $fila_detalle['CLAVE_PRODUCTO'];
                $cantidad_producto =  $fila_detalle['CANTIDAD_PRODUCTO'];
                $cantidad_faltante =  $fila_detalle['CANTIDAD_FALTANTE'];
                $observaciones =  $fila_detalle['OBSERVACIONES'];
                $clave_requisicion_2 =  $fila_detalle['CLAVE_REQUISICION'];  

                $select_producto = "SELECT * FROM CREQ_PRODUCTOS WHERE ID = '".$clave_producto."'";
                $ejecuta_consulta_producto = mysqli_query($con, $select_producto);
                $fila_producto = mysqli_fetch_array($ejecuta_consulta_producto);
                $nombre_producto =  $fila_producto['NOMBRE'];
                ?>
                <tr>
                    <th class="tabla-mes"><?php echo $nombre_producto; ?></th> 
                    <th class="tabla-mes"><?php echo $cantidad_producto; ?></th>
                    <th class="tabla-mes"><?php echo $observaciones; ?></th>
                    
                    <th class="table-mes">
                        <?php
                        if($cantidad_faltante == 0){
                            ?>
                                Completado!
                            <?php
                        }else{
                            ?>
                             <table>
                            <tr>
                                <th class="table-mes">
                                    <div class="contenedor-checkbox">
                                        <input type="checkbox" class="form-checkbox" name="" id="si_<?php echo $var1?>" onclick="checks_respuestas('si_<?php echo $var1?>');">
                                        <span>SI</span>
                                    </div>
                                </th>
                                <th class="table-mes">
                                    <div class="contenedor-checkbox">
                                        <input type="checkbox" class="form-checkbox" name="" id="no_<?php echo $var1?>" onclick="checks_respuestas('no_<?php echo $var1?>');">
                                        <span>NO</span>
                                    </div>
                                </th>
                                <th></th>
                            </tr>
                        </table>
                            <?php
                        }

                        ?>
                       
                    </th>
                    <th class="table-mes oculto" id="columna_extra1_<?php echo $var1?>"><input type="text" value="<?php echo $cantidad_faltante?>" class="form__text-validador" style="width: 200px;" disabled></th>
                    <th class="table-mes oculto" id="columna_extra2_<?php echo $var1?>">
                    <div>
                            <input type="text" placeholder="Ingrese información" class="form__text-validador" style="width: 200px;" id="cantidad_entregada_<?php echo $var1?>" onchange="modifica_cantidad('<?php echo $var1?>','<?php echo $cantidad_faltante?>','<?php echo $clave_producto?>','<?php echo $clave_requisicion_2?>')">
                        </div>
                    </th>
                </tr>
            <?php 
            $var1++;
            }
            ?>
        </table>
        <br><br>
        <div>
            <button class="form__submit" type="button" id="procesar" onclick="carga()">Procesar</button>
        </div>
        <br>
        <div class="contenedor-descarga"  id="cargando">
           
        </div>
       <?php

}

?>