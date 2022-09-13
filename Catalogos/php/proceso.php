<?php
include("../../Includes/connection.php");

$opcion = $_POST['opcion'];

if($opcion == 1){

    $nombre_producto = $_POST['nombre_producto'];
    $precio_producto = $_POST['precio_producto'];
    $area_producto = $_POST['area_producto'];

    $insert_producto = "INSERT INTO CREQ_PRODUCTOS (NOMBRE, DEPARTAMENTO, PRECIO) VALUES ('".$nombre_producto."','".$area_producto."','".$precio_producto."')";
    $ejecuta_insert_producto = mysqli_query($con, $insert_producto);

    echo "Producto Registrado Correctamente";
}

if($opcion == 2){

    $id_producto = $_POST['id_producto'];
    $consulta = "SELECT * FROM CREQ_PRODUCTOS WHERE ID = '".$id_producto."'";
    $ejecuta_consulta = mysqli_query($con, $consulta);
    $row3=mysqli_fetch_assoc($ejecuta_consulta);
    $nombre=$row3['NOMBRE'];
    $id=$row3['ID']; 
    $precio=$row3['PRECIO']; 
    $area=$row3['DEPARTAMENTO'];

    echo $area."|".$precio."|".$nombre;
}

if($opcion == 3){

    $nombre_producto = $_POST['nombre_producto'];
    $precio_producto = $_POST['precio_producto'];
    $area_producto = $_POST['area_producto'];
    $id_producto = $_POST['id_producto'];

    $update_producto = "UPDATE CREQ_PRODUCTOS SET NOMBRE = '".$nombre_producto."', DEPARTAMENTO = '".$area_producto."', PRECIO = '".$precio_producto."' WHERE ID = '".$id_producto."'";
    $ejecuta_update_producto = mysqli_query($con, $update_producto);

    echo "Producto Modificdo Correctamente";
}

if($opcion == 4){
    $id_producto = $_POST['id_producto'];

    $delete_producto = "DELETE FROM CREQ_PRODUCTOS WHERE ID = '".$id_producto."'";
    $ejecuta_delete_producto = mysqli_query($con, $delete_producto);

    echo "Producto Eliminado Correctamente";
}

if($opcion == 5){

    $nombre_departamento = $_POST['nombre_departamento'];
    $clave_departamento = $_POST['clave_departamento'];

    $insert_departamento = "INSERT INTO CREQ_DEPARTAMENTOS (NOMBRE, CLAVE) VALUES ('".$nombre_departamento."','".$clave_departamento."')";
    $ejecuta_insert_departamento = mysqli_query($con, $insert_departamento);

    echo "Departamento Registrado Correctamente";
}

if($opcion == 6){

    $id_departamento = $_POST['id_departamento'];
    $consulta = "SELECT * FROM CREQ_DEPARTAMENTOS WHERE ID = '".$id_departamento."'";
    $ejecuta_consulta = mysqli_query($con, $consulta);
    $row3=mysqli_fetch_assoc($ejecuta_consulta);
    $nombre=$row3['NOMBRE'];
    $clave=$row3['CLAVE'];

    echo $nombre."|".$clave;
}

if($opcion == 7){

    $id_departamento = $_POST['id_departamento'];
    $nombre_departamento = $_POST['nombre_departamento'];
    $clave_departamento = $_POST['clave_departamento'];

    $update_departamento = "UPDATE CREQ_DEPARTAMENTOS SET NOMBRE = '".$nombre_departamento."', CLAVE = '".$clave_departamento."' WHERE ID = '".$id_departamento."'";
    $ejecuta_update_departamento = mysqli_query($con, $update_departamento);

    echo "Departamento Modificdo Correctamente";

}

if($opcion == 8){

    $id_departamento = $_POST['id_departamento'];

    $update_departamento = "DELETE FROM CREQ_DEPARTAMENTOS WHERE ID = '".$id_departamento."'";
    $ejecuta_update_departamento = mysqli_query($con, $update_departamento);

    echo "Departamento Eliminado Correctamente";
}

if($opcion == 9){

}

if($opcion == 10){

}

if($opcion == 11){

}

if($opcion == 12){

}

?>
