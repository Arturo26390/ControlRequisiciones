<?php
include("../../Includes/connection.php");

$opcion = $_POST['opcion'];
$catalogo = $_POST['catalogo'];

//////////////////////////////////////////////////////////////////////////////  PRODUCTOS   ////////////////////////////////////////////////////////////////////////////// 
if($catalogo == 1){
    //////////////////////////////////////////////////////////////////////////////  ALTAS   ////////////////////////////////////////////////////////////////////////////// 

    if($opcion == "altas"){
        ?>
        <div>
            <span> NOMBRE: &nbsp;</span>
            <input type="text" placeholder="Ingrese información" class="form__text-validador" style="width: 200px;" id="nombre_producto" required>
        </div>
        <br>
        <div>
            <span> PRECIO: &nbsp;</span>
            <input type="text" placeholder="Ingrese información" class="form__text-validador" style="width: 200px;" id="precio_producto" required>
        </div>
        <br>
        <span> DEPARTAMENTO: &nbsp;</span>
        <select name="area" id="area_producto" class="form__select-esp" required>
            <option value="0">- SELECCIONE -</option>
            <?php
                $query3=mysqli_query($con, "SELECT * FROM CREQ_DEPARTAMENTOS");
                while($row3=mysqli_fetch_assoc($query3))
                {
                    $nombre=$row3['NOMBRE'];
                    $id=$row3['ID']; ?>
                    <option value="<?php echo $id; ?>"><?php echo $nombre;?></option><?php
                }
            ?>
        </select>
        <br><br>
        <div>
            <button class="form__submit" type="button" id="procesar" onclick="agregaProducto()">Guardar</button>
        </div>
        <?php
    }

    //////////////////////////////////////////////////////////////////////////////  MODIFICACIONES   ////////////////////////////////////////////////////////////////////////////// 

    if($opcion == "modificaciones"){
        ?>
        <span> PRODUCTO: &nbsp;</span>
        <select name="area" id="id_producto" class="form__select-esp" required onChange="consulta_asigna()">
            <option value="0">- SELECCIONE -</option>
            <?php
                $query3=mysqli_query($con, "SELECT * FROM CREQ_PRODUCTOS");
                while($row3=mysqli_fetch_assoc($query3))
                {
                    $nombre=$row3['NOMBRE'];
                    $id=$row3['ID']; ?>
                    <option value="<?php echo $id; ?>"><?php echo $nombre;?></option><?php
                }
            ?>
        </select>
        <br><br><br>
        <div>
            <span> NOMBRE: &nbsp;</span>
            <input type="text" placeholder="Ingrese información" class="form__text-validador" style="width: 200px;" id="nombre_producto" required>
        </div>
        <br>
        <div>
            <span> PRECIO: &nbsp;</span>
            <input type="text" placeholder="Ingrese información" class="form__text-validador" style="width: 200px;" id="precio_producto" required>
        </div>
        <br>
        <span> DEPARTAMENTO: &nbsp;</span>
        <select name="area" id="area_producto" class="form__select-esp" required>
            <option value="0">- SELECCIONE -</option>
            <?php
                $query3=mysqli_query($con, "SELECT * FROM CREQ_DEPARTAMENTOS");
                while($row3=mysqli_fetch_assoc($query3))
                {
                    $nombre=$row3['NOMBRE'];
                    $id=$row3['ID']; ?>
                    <option value="<?php echo $id; ?>"><?php echo $nombre;?></option><?php
                }
            ?>
        </select>
        <br><br>
        <div>
            <button class="form__submit" type="button" id="procesar" onclick="modificaProducto()">Guardar</button>
        </div>
        <?php
    }
    //////////////////////////////////////////////////////////////////////////////  BAJAS   ////////////////////////////////////////////////////////////////////////////// 

    if($opcion == "bajas"){
        ?>
        <span> PRODUCTO: &nbsp;</span>
        <select name="area" id="id_producto" class="form__select-esp" required onChange="consulta_asigna()">
            <option value="0">- SELECCIONE -</option>
            <?php
                $query3=mysqli_query($con, "SELECT * FROM CREQ_PRODUCTOS");
                while($row3=mysqli_fetch_assoc($query3))
                {
                    $nombre=$row3['NOMBRE'];
                    $id=$row3['ID']; ?>
                    <option value="<?php echo $id; ?>"><?php echo $nombre;?></option><?php
                }
            ?>
        </select>
        <br><br><br>
        <div>
            <span> NOMBRE: &nbsp;</span>
            <input type="text" placeholder="Ingrese información" class="form__text-validador" style="width: 200px;" id="nombre_producto" disabled>
        </div>
        <br>
        <div>
            <span> PRECIO: &nbsp;</span>
            <input type="text" placeholder="Ingrese información" class="form__text-validador" style="width: 200px;" id="precio_producto" disabled>
        </div>
        <br>
        <span> DEPARTAMENTO: &nbsp;</span>
        <select name="area" id="area_producto" class="form__select-esp" disabled>
            <option value="0">- SELECCIONE -</option>
            <?php
                $query3=mysqli_query($con, "SELECT * FROM CREQ_DEPARTAMENTOS");
                while($row3=mysqli_fetch_assoc($query3))
                {
                    $nombre=$row3['NOMBRE'];
                    $id=$row3['ID']; ?>
                    <option value="<?php echo $id; ?>"><?php echo $nombre;?></option><?php
                }
            ?>
        </select>
        <br><br>
        <div>
            <button class="form__submit" type="button" id="procesar" onclick="eliminaProducto()">Eliminar</button>
        </div>
        <?php
    }
}

//////////////////////////////////////////////////////////////////////////////  DEPARTAMENTOS   ////////////////////////////////////////////////////////////////////////////// 

if($catalogo == 2){

    //////////////////////////////////////////////////////////////////////////////  ALTAS   ////////////////////////////////////////////////////////////////////////////// 

    if($opcion == "altas"){
        ?>
        <div>
            <span> NOMBRE: &nbsp;</span>
            <input type="text" placeholder="Ingrese información" class="form__text-validador" style="width: 200px;" id="nombre_departamento" required>
        </div>
        <br>
        <div>
            <span> CLAVE: &nbsp;</span>
            <input type="text" placeholder="Ingrese información" class="form__text-validador" style="width: 200px;" id="clave_departamento" required>
        </div>
        <br><br>
        <div>
            <button class="form__submit" type="button" id="procesar" onclick="agregaDepartamento()">Guardar</button>
        </div>
        <?php
    }

    //////////////////////////////////////////////////////////////////////////////  MODIFICACIONES   ////////////////////////////////////////////////////////////////////////////// 

    if($opcion == "modificaciones"){
       
        ?>
        <span> DEPARTAMENTO: &nbsp;</span>
        <select name="area" id="id_departamento" class="form__select-esp" required onChange="consulta_asigna2()">
            <option value="0">- SELECCIONE -</option>
            <?php
                $query3=mysqli_query($con, "SELECT * FROM CREQ_DEPARTAMENTOS");
                while($row3=mysqli_fetch_assoc($query3))
                {
                    $nombre=$row3['NOMBRE'];
                    $id=$row3['ID']; ?>
                    <option value="<?php echo $id; ?>"><?php echo $nombre;?></option><?php
                }
            ?>
        </select>
        <br><br><br>
        <div>
            <span> NOMBRE: &nbsp;</span>
            <input type="text" placeholder="Ingrese información" class="form__text-validador" style="width: 200px;" id="nombre_departamento">
        </div>
        <br>
        <div>
            <span> CLAVE: &nbsp;</span>
            <input type="text" placeholder="Ingrese información" class="form__text-validador" style="width: 200px;" id="clave_departamento">
        </div>
        <br><br>
        <div>
            <button class="form__submit" type="button" id="procesar" onclick="modificaDepartamento()">Guardar</button>
        </div>
        <?php
    }

    //////////////////////////////////////////////////////////////////////////////  BAJAS   ////////////////////////////////////////////////////////////////////////////// 

    if($opcion == "bajas"){
        
        ?>
        <span> DEPARTAMENTO: &nbsp;</span>
        <select name="area" id="id_departamento" class="form__select-esp" required onChange="consulta_asigna2()">
            <option value="0">- SELECCIONE -</option>
            <?php
                $query3=mysqli_query($con, "SELECT * FROM CREQ_DEPARTAMENTOS");
                while($row3=mysqli_fetch_assoc($query3))
                {
                    $nombre=$row3['NOMBRE'];
                    $id=$row3['ID']; ?>
                    <option value="<?php echo $id; ?>"><?php echo $nombre;?></option><?php
                }
            ?>
        </select>
        <br><br><br>
        <div>
            <span> NOMBRE: &nbsp;</span>
            <input type="text" placeholder="Ingrese información" class="form__text-validador" style="width: 200px;" id="nombre_departamento" disabled>
        </div>
        <br>
        <div>
            <span> CLAVE: &nbsp;</span>
            <input type="text" placeholder="Ingrese información" class="form__text-validador" style="width: 200px;" id="clave_departamento" disabled>
        </div>
        <br><br>
        <div>
            <button class="form__submit" type="button" id="procesar" onclick="eliminaDepartamento()">Eliminar</button>
        </div>
        <?php
    }
}

//////////////////////////////////////////////////////////////////////////////  USUARIOS   ////////////////////////////////////////////////////////////////////////////// 

if($catalogo == 3){

    //////////////////////////////////////////////////////////////////////////////  ALTAS   ////////////////////////////////////////////////////////////////////////////// 

    if($opcion == "altas"){
        echo "altas usuarios<br>";
    }

    //////////////////////////////////////////////////////////////////////////////  MODIFICACIONES   ////////////////////////////////////////////////////////////////////////////// 

    if($opcion == "modificaciones"){
        echo "modificaciones usuarios<br>";
    }

    //////////////////////////////////////////////////////////////////////////////  BAJAS   ////////////////////////////////////////////////////////////////////////////// 

    if($opcion == "bajas"){
        echo "bajas usuarios<br>";
    }
}
?>