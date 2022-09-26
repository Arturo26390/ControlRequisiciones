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

function muestraDetalle(requisicion){
	$("#resultado").show();
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
		$("#encabezado_extra2").show();
		$("#columna_extra2_"+vector_resp[1]).show();
	}else{
		document.getElementById("si_"+vector_resp[1]).checked = false;
		$("#encabezado_extra1").hide();
		$("#columna_extra1_"+vector_resp[1]).hide();
		$("#encabezado_extra2").hide();
		$("#columna_extra2_"+vector_resp[1]).hide();
	}
}


function modifica_cantidad(indice,cantidad_producto,clave_producto,clave_requisicion){
	var cantidad_entregada = $("#cantidad_entregada_"+indice).val();
	//alert("Se resta "+cantidad_entregada+" a "+cantidad_producto+" del producto "+clave_producto+" de la requisicion "+clave_requisicion);
	if(cantidad_entregada > cantidad_producto){
		alert("La cantidad entregada no puede ser mayor a la esperada");
	}else{
		$.ajax(
		{
			url : 'php/proceso.php',
			type: "POST",
			data : {
					opcion : 1,
					requisicion : clave_requisicion,
					producto : clave_producto,
					cantidad_producto : cantidad_producto,
					cantidad_entregada : cantidad_entregada
				}
		})
			.done(function(data) {
				//$("#resultado").html(data);
				console.log(data);
			})
			.fail(function(data) {
				alert( "error" );
			})
			.always(function(data) {
				
			});
	}	
}

function carga(){
	$.ajax(
	{
		url : 'php/proceso.php',
		type: "POST",
		data : {
				opcion : 2
			}
	})
		.done(function(data) {
			//$("#resultado").html(data);
			if(data == 1){
				$("#cargando").html('<img src="../asset/imgs/login/login_mes_actual.gif" alt="">');
				setTimeout(function(){
					$("#cargando").html('Procesado Correctamente!');
				}, 2000);
			}
			console.log(data);
		})
		.fail(function(data) {
			alert( "error" );
		})
		.always(function(data) {
			
		});
}