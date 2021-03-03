function obteberDatosPe (id) {
	$.ajax({
		type:"POST",
		data:"ID="+id,  
		url:"PHP/Productos/ObtenerDatPed.php",
		success: function(respuesta){
			respuesta = jQuery.parseJSON(respuesta);
			$('#tablaGTP tbody').empty();
			for (var i = 0; i < respuesta['Num']*3; i=i+3) {
				var htmlTags = '<tr>'+
				'<td>' + respuesta[i] + '</td>'+
				'<td>' +respuesta[i+1] + '</td>'+
				'<td>' +respuesta[i+2] + '</td>'+
				'</tr>';
				$('#tablaGTP tbody').append(htmlTags);
			}
		}
	});
}
function PedidoListo(id,nombre){
	var parametros = {
		"ID" : id,
		"Nombre" : nombre
	};
	swal({
		title: "¿El pedido ya esta listo?",
		text: "Se notificara al usuario que puede recoger su pedido",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {
			$.ajax({
				type:"POST",
				data:parametros,
				url:"PHP/Productos/Pedido_listo.php",
				success:function(respuesta){
					respuesta=respuesta.trim();
					console.log(respuesta);
					if (respuesta==1) {
						swal("Correcto", "Pedido listo para entrega", "success");
						$('#Tb_Gest_Pe').load("Vistas/Gestor/TablaGestorPedidos.php");
					}else if (respuesta=="Ya") {
						swal("Error", "El pedido ya fue surtido", "error");
					}else if (respuesta=="YEN") {
						swal("Error", "El pedido ya fue entregado", "error");
					}
					else{
						swal("Error", "No se ha surtido el pedido", "error");
					}
				}
			});
		} else {
		}
	});
	return false;
}
function Entregado(id,nombre){
	var parametros = {
		"ID" : id,
		"Nombre" : nombre
	};
	swal({
		title: "¿El usuario ya recogio su pedido?",
		text: "Se enviara una notificacion al usuario agradeciendo su compra",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {
			$.ajax({
				type:"POST",
				data:parametros,
				url:"PHP/Productos/Pedido_Entr.php",
				success:function(respuesta){
					respuesta=respuesta.trim();
					console.log(respuesta);
					if (respuesta==1) {
						swal("Correcto", "Pedido Entregado", "success");
						$('#Tb_Gest_Pe').load("Vistas/Gestor/TablaGestorPedidos.php");
					}else if (respuesta=="Ya") {
						swal("Error", "El pedido ya fue entregado", "error");
					}else if (respuesta=="NOS") {
						swal("Error", "El pedido aun no es surtido", "error");
					}
					else{
						swal("Error", "No se ha surtido el pedido", "error");
					}
				}
			});
		} else {
		}
	});
	return false;
}