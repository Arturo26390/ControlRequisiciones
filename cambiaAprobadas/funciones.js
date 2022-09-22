function consultaRequis(){
	$("#resultado").hide();
	var fecha = $("#fecha_requi").val();

	$.ajax(
	{
		url : 'php/consultas.php',
		type: "POST",
		data : {
				opcion : 1,
				fecha : fecha
			}
	})
		.done(function(data) {
			$("#muestra_tabla").html(data);
		})
		.fail(function(data) {
			alert( "error" );
		})
		.always(function(data) {
			
		});
}

function cambiaEstatus(clave_requisicion){
	var select = $("#aprobar").val();

	$.ajax(
	{
		url : 'php/proceso.php',
		type: "POST",
		data : {
				opcion : 1,
				select : select,
				clave_requisicion : clave_requisicion
			}
	})
		.done(function(data) {
			$("#muestra_detalle").html(data);
		})
		.fail(function(data) {
			alert( "error" );
		})
		.always(function(data) {
			
		});

}