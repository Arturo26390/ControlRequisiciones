function consultaRequis(){
	
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

function muestraDetalle(requisicion){
	
	$.ajax(
	{
		url : 'php/consultas.php',
		type: "POST",
		data : {
				opcion : 2,
				requisicion : requisicion
			}
	})
		.done(function(data) {
			$("#resultado").html(data);
		})
		.fail(function(data) {
			alert( "error" );
		})
		.always(function(data) {
			
		});
}

function checks_respuestas(respuesta){
	var vector_resp = respuesta.split("_");
	if(vector_resp[0] == "si"){
		document.getElementById("no_"+vector_resp[1]).checked = false;
		$("#encabezado_extra1").show();
		$("#columna_extra1_"+vector_resp[1]).show();
	}else{
		document.getElementById("si_"+vector_resp[1]).checked = false;
		$("#encabezado_extra1").hide();
		$("#columna_extra1_"+vector_resp[1]).hide();
	}
}

function checks_respuestas_2(respuesta){
	var vector_resp = respuesta.split("_");
	if(vector_resp[1] == "si"){
		document.getElementById("completo_no_"+vector_resp[2]).checked = false;
	}else{
		document.getElementById("completo_si_"+vector_resp[2]).checked = false;
		$("#encabezado_extra2").show();
		$("#columna_extra2_"+vector_resp[2]).show();
	}
}