// JavaScript Validacion de registro
function GeneraProductos(){
	var num_productos = $("#num_productos").val();
	$.ajax(
		{
			url : '../Includes/php/inputDinamicos.php',
			type: "POST",
			data : {
					num_productos : num_productos
				}
		})
			.done(function(data) {
				$("#resultado_num_productos").html(data);
			})
			.fail(function(data) {
				alert( "error" );
			})
			.always(function(data) {
				
			});
}

function autoCompletar(id,id2){
	var producto = $("#"+id).val();

	if(producto.length > 1){
		
		$("#"+id).autocomplete({
			source: "busca_archivo.php",
			minLength: 2,
		});
	}
	//$("#"+id2).attr("disabled", true);
}

// function autoCompletar(id){
// 	var key = $("#"+id).val();

// 	//var key = $(this).val();		
// 	var dataString = 'key='+key;
// 	$.ajax({
// 		type: "POST",
// 		url: "busca_archivo.php",
// 		data: dataString,
// 		success: function(data) {
// 			//Escribimos las sugerencias que nos manda la consulta
// 			$('#suggestions').fadeIn(1000).html(data);
// 			//Al hacer click en alguna de las sugerencias
// 			$('.suggest-element').on('click', function(){
// 					//Obtenemos la id unica de la sugerencia pulsada
// 					var id2 = $(this).attr('id');
// 					//Editamos el valor del input con data de la sugerencia pulsada
// 					$('#'+id).val($('#'+id2).attr('data'));
// 					//Hacemos desaparecer el resto de sugerencias
// 					$('#suggestions').fadeOut(1000);
// 					return false;
// 			});
// 		}
// 	});
// }




function calculaCosto(id,id2,id3,id4,id5,id6){
	
	var num_productos = $("#num_productos").val();
	for(var i=0; i<num_productos; i++){
		texto = $("#producto_"+i).val().split("|");
		if(texto.length > 1){
			$("#producto_"+i).val(texto[0]);
			$("#hidden_"+i).val(texto[1]);
		}
	}
	
	var cantidad = $("#"+id3).val();
	var id_producto = $("#"+id5).val();

	$.ajax(
	{
		url : 'proceso.php',
		type: "POST",
		data : {
				opcion : 1,
				id_producto : id_producto,
				cantidad : cantidad
				}
	})
		.done(function(data) {
			vector = data.split("|");

			$("#"+id2).val("$ "+vector[0]);
			$("#"+id4).val("$ "+vector[1]);

			

		})
		.fail(function(data) {
			alert( "error" );
		})
		.always(function(data) {
			
		});
}

function habilita(id,id2,id3){
	var producto = $("#"+id2).val();

	var num_productos = $("#num_productos").val();
	var num_aux=0;
	for(var x=0; x<num_productos; x++){
		if( $('#agregar_'+x).prop('checked')){
			num_aux++;
		}
	}


	$("#"+id).removeAttr("readonly");
	$("#"+id).focus();
	$("#"+id).val("$ ");
	alert("Captura el precio Unitario");
	//alert(vector_auxiliar[1]);
	$.ajax(
	{
		url : 'proceso.php',
		type: "POST",
		data : {
				opcion : 4,
				numero : num_aux
				}
	})
		.done(function(data) {
			console.log(data);
			var nuevo_id = parseInt(data);
			var nuevo_producto = producto;
			$("#"+id2).val(nuevo_producto);
			$("#"+id3).val(nuevo_id);

		})
		.fail(function(data) {
			alert( "error" );
		})
		.always(function(data) {
			
		});
}

function calculaCosto2(id,id2,id3,id4){
	var precio = $("#"+id).val();
	var precio = precio.slice(1);
	var cantidad = $("#"+id2).val();
	var costo_total = precio * cantidad;
	$("#"+id3).val("$ "+costo_total);
	$("#"+id4).attr("disabled", true);
}

function agregaProducto(){

	var area = $("#area").val();
	var num_productos = $("#num_productos").val();

	for(var i=0; i<num_productos; i++){
		if( $('#agregar_'+i).prop('checked')){
			var producto = $("#producto_"+i).val();
			var precio = $("#precio_"+i).val();
			//alert(producto);

			$.ajax(
			{
				url : 'proceso.php',
				type: "POST",
				data : {
					opcion : 3,
					producto : producto,
					precio : precio,
					area : area
				}
			})
				.done(function(data) {
					console.log(data);
				})
				.fail(function(data) {
					alert( "error" );
				})
				.always(function(data) {
					
				});

		}else{
			
		}
	}
	Procesar();
}

function Procesar(){

	var area = $("#area").val();
	var patente = $("#patente").val();
	var prioridad = $("#prioridad").val();
	var num_productos = $("#num_productos").val();
	var comentarios = $("#comentarios").val();

	if(area == 0){
		alert("No has seleccionado el área");
		return;
	}
	if(patente == 0){
		alert("No has seleccionado la patente");
		return;
	}
	if(prioridad == 0){
		alert("No has seleccionado la prioridad");
		return;
	}
	if(num_productos == ''){
		alert("No has seleccionado ningun producto");
		return;
	}


	var vector_productos = "";
	var vector_cantidad = "";
	var vector_observaciones = "";
	var vector_precio_unitario = "";
	var vector_total = "";
	//alert("num "+num_productos);
	for(var i = 0; i<num_productos; i++){

		vector_productos = vector_productos+$("#hidden_"+i).val()+"|";
		//alert($("#hidden_"+i).val());
		vector_cantidad = vector_cantidad+$("#cantidad_"+i).val()+"|";
		vector_observaciones = vector_observaciones+$("#observaciones_"+i).val()+"|";
		vector_precio_unitario = vector_precio_unitario+$("#precio_"+i).val()+"|";
		vector_total = vector_total+$("#total_"+i).val()+"|";
	}

	$.ajax(
	{
		url : 'proceso.php',
		type: "POST",
		data : {
				opcion : 2,
				area : area,
				patente: patente,
				prioridad: prioridad,
				comentarios: comentarios,
				num_productos : num_productos,
				vector_productos : vector_productos,
				vector_cantidad : vector_cantidad,
				vector_observaciones : vector_observaciones,
				vector_precio_unitario : vector_precio_unitario,
				vector_total : vector_total
				}
	})
		.done(function(data) {
			generaPDF(data);
			console.log(data);
		})
		.fail(function(data) {
			alert( "error" );
		})
		.always(function(data) {
			
		});
}

function generaPDF(clave_requisicion){
	console.log(clave_requisicion);
	$.ajax(
	{
		url : 'mPDF.php',
		type: "POST",
		data : {
			clave_requisicion : clave_requisicion
				}
	})
		.done(function(data) {
			$("#resultadoPDF").html(data);
			envioMail(clave_requisicion);
		})
		.fail(function(data) {
			alert( "error" );
		})
		.always(function(data) {
			
		});
}

function envioMail(clave_requisicion){
	$.ajax(
	{
		url : 'proceso.php',
		type: "POST",
		data : {
			opcion : 5,
			clave_requisicion : clave_requisicion
				}
	})
		.done(function(data) {
			$("#muestra_mensaje").html(data);
			console.log(data);
		})
		.fail(function(data) {
			alert( "error" );
		})
		.always(function(data) {
			
		});
}

