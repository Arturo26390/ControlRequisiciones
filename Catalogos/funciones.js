function Muestra1(){
	document.getElementById("check_modificaciones").checked = false;
	document.getElementById("check_bajas").checked = false;
	$("#div_catalogos").show();
	$("#catalogos").val('0');
	$("#mustra_formularios").html("");
 }
 
 function Muestra2(){
	document.getElementById("check_altas").checked = false;
	document.getElementById("check_bajas").checked = false;
	$("#div_catalogos").show();
	$("#catalogos").val('0');
	$("#mustra_formularios").html("");
 }
 
 function Muestra3(){
	document.getElementById("check_altas").checked = false;
	document.getElementById("check_modificaciones").checked = false;
	$("#div_catalogos").show();
	$("#catalogos").val('0');
	$("#mustra_formularios").html("");
 }

 function Procesa(){
	var catalogo = $("#catalogos").val();
	var opcion = "";
	if(catalogo == 0){
		alert("Selecciona una opcion Diferente");
		$("#catalogos").focus();
		return;
	}
	if($('#check_altas').prop('checked')){
		opcion = "altas";
	}
	if($('#check_modificaciones').prop('checked')){
		opcion = "modificaciones";
	}
	if($('#check_bajas').prop('checked')){
		opcion = "bajas";
	}

	$.ajax(
	{
		url : 'php/consultas.php',
		type: "POST",
		data : {
				opcion : opcion,
				catalogo : catalogo
			}
	})
		.done(function(data) {
			$("#mustra_formularios").html(data);
		})
		.fail(function(data) {
			alert( "error" );
		})
		.always(function(data) {
			
		});
 }

 function agregaProducto(){

	var nombre_producto = $("#nombre_producto").val();
	var precio_producto = $("#precio_producto").val();
	var area_producto = $("#area_producto").val();

	if(nombre_producto == ""){
		alert("No has ingresado el nombre del producto");
		$("#nombre_producto").focus();
		return;
	}
	if(precio_producto == ""){
		alert("No has ingresado el precio del producto");
		$("#precio_producto").focus();
		return;
	}
	if(area_producto == 0){
		alert("Selecciona un Departamento");
		$("#area_producto").focus();
		return;
	}

	$.ajax(
	{
		url : 'php/proceso.php',
		type: "POST",
		data : {
				opcion : 1,
				nombre_producto : nombre_producto,
				precio_producto : precio_producto,
				area_producto : area_producto
			}
	})
		.done(function(data) {
			$("#muestra_resultados").html('<img src="../asset/imgs/login/login_mes_actual.gif" alt=""></img>');
			setTimeout(function(){
				$("#muestra_resultados").html(data);
			}, 2000);
			//sleep(3000);
			
		})
		.fail(function(data) {
			alert( "error" );
		})
		.always(function(data) {
			
		});

 }

function consulta_asigna(){

	var id_producto = $("#id_producto").val();
	$.ajax(
	{
		url : 'php/proceso.php',
		type: "POST",
		data : {
				opcion : 2,
				id_producto : id_producto
			}
	})
		.done(function(data) {
			var vector = data.split("|");
			$("#nombre_producto").val(vector[2]);
			$("#precio_producto").val(vector[1]);
			$("#area_producto").val(vector[0]);
		})
		.fail(function(data) {
			alert( "error" );
		})
		.always(function(data) {
			
		});
}

function consulta_asigna2(){

	var id_departamento = $("#id_departamento").val();
	$.ajax(
	{
		url : 'php/proceso.php',
		type: "POST",
		data : {
				opcion : 6,
				id_departamento : id_departamento
			}
	})
		.done(function(data) {
			var vector = data.split("|");
			$("#nombre_departamento").val(vector[0]);
			$("#clave_departamento").val(vector[1]);
		})
		.fail(function(data) {
			alert( "error" );
		})
		.always(function(data) {
			
		});
}

function modificaProducto(){

	var nombre_producto = $("#nombre_producto").val();
	var precio_producto = $("#precio_producto").val();
	var area_producto = $("#area_producto").val();
	var id_producto = $("#id_producto").val();

	$.ajax(
	{
		url : 'php/proceso.php',
		type: "POST",
		data : {
				opcion : 3,
				nombre_producto : nombre_producto,
				precio_producto : precio_producto,
				area_producto : area_producto,
				id_producto : id_producto
			}
	})
		.done(function(data) {
			$("#muestra_resultados").html('<img src="../asset/imgs/login/login_mes_actual.gif" alt=""></img>');
			setTimeout(function(){
				$("#muestra_resultados").html(data);
			}, 2000);
			//sleep(3000);
			
		})
		.fail(function(data) {
			alert( "error" );
		})
		.always(function(data) {
			
			});
}

function eliminaProducto(){

	var nombre_producto = $("#nombre_producto").val();
	var precio_producto = $("#precio_producto").val();
	var area_producto = $("#area_producto").val();
	var id_producto = $("#id_producto").val();

	$.ajax(
	{
		url : 'php/proceso.php',
		type: "POST",
		data : {
				opcion : 4,
				nombre_producto : nombre_producto,
				precio_producto : precio_producto,
				area_producto : area_producto,
				id_producto : id_producto
			}
	})
		.done(function(data) {
			$("#muestra_resultados").html('<img src="../asset/imgs/login/login_mes_actual.gif" alt=""></img>');
			setTimeout(function(){
				$("#muestra_resultados").html(data);
			}, 2000);
			//sleep(3000);
			
		})
		.fail(function(data) {
			alert( "error" );
		})
		.always(function(data) {
			
		});

}

function agregaDepartamento(){

	var nombre_departamento = $("#nombre_departamento").val();
	var clave_departamento = $("#clave_departamento").val();

	if(nombre_departamento == ""){
		alert("No has ingresado el nombre del departamento");
		$("#nombre_departamento").focus();
		return;
	}
	if(clave_departamento == ""){
		alert("No has ingresado la clave del departamento");
		$("#clave_departamento").focus();
		return;
	}

	$.ajax(
	{
		url : 'php/proceso.php',
		type: "POST",
		data : {
				opcion : 5,
				nombre_departamento : nombre_departamento,
				clave_departamento : clave_departamento
			}
	})
		.done(function(data) {
			$("#muestra_resultados").html('<img src="../asset/imgs/login/login_mes_actual.gif" alt=""></img>');
			setTimeout(function(){
				$("#muestra_resultados").html(data);
			}, 2000);
			//sleep(3000);
			
		})
		.fail(function(data) {
			alert( "error" );
		})
		.always(function(data) {
			
		});
}

function modificaDepartamento(){

	var nombre_departamento = $("#nombre_departamento").val();
	var clave_departamento = $("#clave_departamento").val();
	var id_departamento = $("#id_departamento").val();

	$.ajax(
	{
		url : 'php/proceso.php',
		type: "POST",
		data : {
				opcion : 7,
				id_departamento : id_departamento,
				nombre_departamento : nombre_departamento,
				clave_departamento : clave_departamento
			}
	})
		.done(function(data) {
			$("#muestra_resultados").html('<img src="../asset/imgs/login/login_mes_actual.gif" alt=""></img>');
			setTimeout(function(){
				$("#muestra_resultados").html(data);
			}, 2000);
			//sleep(3000);
			
		})
		.fail(function(data) {
			alert( "error" );
		})
		.always(function(data) {
			
				});

}

function eliminaDepartamento(){

	var nombre_departamento = $("#nombre_departamento").val();
	var clave_departamento = $("#clave_departamento").val();
	var id_departamento = $("#id_departamento").val();

	$.ajax(
	{
		url : 'php/proceso.php',
		type: "POST",
		data : {
				opcion : 8,
				id_departamento : id_departamento,
				nombre_departamento : nombre_departamento,
				clave_departamento : clave_departamento
			}
	})
		.done(function(data) {
			$("#muestra_resultados").html('<img src="../asset/imgs/login/login_mes_actual.gif" alt=""></img>');
			setTimeout(function(){
				$("#muestra_resultados").html(data);
			}, 2000);
			//sleep(3000);
			
		})
		.fail(function(data) {
			alert( "error" );
		})
		.always(function(data) {
			
				});
}


function sleep(milliseconds) {
	
	var start = new Date().getTime();
	for (var i = 0; i < 1e7; i++) {
		if ((new Date().getTime() - start) > milliseconds) {
			break;
		}
	}
}