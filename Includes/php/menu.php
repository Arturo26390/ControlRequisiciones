<?php
include("connection.php");
$consulta_menu = "SELECT * FROM CREQ_MENU";
$ejecuta_consulta_menu = mysqli_query($con, $consulta_menu);
?>
<div class="sidebar">
    <div class="logo-details">
        <i class='bx bxl-deezer'></i>
        <span class="logo__name">Requisiciones de Compra</span>
    </div>
    <ul class="nav-links">
    <?php
    while($row=mysqli_fetch_array($ejecuta_consulta_menu))
    {
        $ubicacion = $row['UBICACION'];
        $nombre = $row['NOMBRE'];
        $logo = $row['LOGO'];

        ?>
        <li>
            <a href="<?php echo $ubicacion; ?>">
                <i class='<?php echo $logo; ?>'></i>
                <span class="link__name"><?php echo $nombre; ?></span>
            </a>
        </li>
        <?php
    }
    ?>
    </ul>
</div>

