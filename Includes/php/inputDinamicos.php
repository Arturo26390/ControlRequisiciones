<table class="tabla-mes">
    <tr>
        <th class="tabla-mes__head">Producto</th>
        <th class="tabla-mes__head">Cantidad</th>
        <th class="tabla-mes__head">Observaciones</th>
        <th class="tabla-mes__head">Precio Unitario</th>
        <th class="tabla-mes__head">Total</th>
        <th class="tabla-mes__head">¿Agregar a Catalogo?</th>
    </tr>

<?php
$num_productos = $_POST["num_productos"];
for($i=0; $i<$num_productos; $i++){
    ?>
    <tr>
        <th>
            <input type="text" placeholder="Producto" class="form__text-validador" style="width: 200px;" id="producto_<?php echo $i?>" onkeypress="autoCompletar('producto_<?php echo $i?>','agregar_<?php echo $i?>')">
            <input type="hidden" id="hidden_<?php echo $i?>">
        </th>
        <th><input type="number" placeholder="Cantidad" class="form__text-validador" style="width: 200px;" id="cantidad_<?php echo $i?>" onChange="calculaCosto('producto_<?php echo $i?>','precio_<?php echo $i?>','cantidad_<?php echo $i?>','total_<?php echo $i?>','hidden_<?php echo $i?>','agregar_<?php echo $i?>')"></th>
        <th><input type="text" placeholder="Observaciones"    class="form__text-validador" style="width: 200px;" id="observaciones_<?php echo $i?>"></th>
        <th><input type="text" placeholder="Precio Unitario"  class="form__text-validador" style="width: 200px;" id="precio_<?php echo $i?>" readonly onChange="calculaCosto2('precio_<?php echo $i?>','cantidad_<?php echo $i?>','total_<?php echo $i?>','agregar_<?php echo $i?>')"></th>
        <th><input type="text" placeholder="Costo Total"      class="form__text-validador" style="width: 200px;" id="total_<?php echo $i?>" readonly></th>
        <th><input type="checkbox" class="form-checkbox" name="" id="agregar_<?php echo $i?>" onClick="habilita('precio_<?php echo $i?>','producto_<?php echo $i?>','hidden_<?php echo $i?>')"></th>
    </tr>
    <?php
}
?>
</table>
<?php
echo "<a href='consulta_productos.php' target='_blank'>Consulta Catalogo de Productos</a>";
?>