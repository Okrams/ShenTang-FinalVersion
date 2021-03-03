function agregarProductoNuevo(){
	var frmData=new FormData;
	frmData.append("file",$("input[name=file]")[0].files[0]);
	frmData.append("nombre",$("input[name=nombre]").val());
	frmData.append("Cant",$("input[name=Cant]").val());
	frmData.append("tp",$("input[name=tp]").val());
	frmData.append("precio",$("input[name=precio]").val());
	frmData.append("stock",$("input[name=stock]").val());
	frmData.append("marca",$("input[name=marca]").val());
	frmData.append("modelo",$("input[name=modelo]").val());
	frmData.append("caracteristicas",$("input[name=caracteristicas]").val());
	$.ajax({
		url:"PHP/Productos/Nuevo_Pro.php",
		type:"POST",
		data:frmData,
		processData:false,
		contentType:false,
		cache:false,
		success:function(respuesta){
			respuesta=respuesta.trim();

			if (respuesta=="Bien") {
				swal("Agregado", "Producto agregado correctamente", "success");
				$('#Tb_Gest_Pro').load("Vistas/Gestor/TablaGestorProductos.php");
				$("#FormPro")[0].reset();
			}else if (respuesta=="PoJ") {
				swal("Error", "Ingrese una imagen png o jpg", "error");
			}else if (respuesta=="NsI") {
				swal("Error", "Solo se admiten imagenes", "error");
			}
		}
	});
	return false;
}
function eliminarProducto(id){
	swal({
		title: "¿Deseas eliminar este producto?",
		text: "Una vez eliminado no podra recuperar este producto",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {
			$.ajax({
				type:"POST",
				data:"ID="+id,
				url:"PHP/Productos/Eliminar_Pro.php",
				success:function(respuesta){
					respuesta=respuesta.trim();
					if (respuesta>=1) {
						swal("Correcto", "Producto eliminado", "success");
						$('#Tb_Gest_Pro').load("Vistas/Gestor/TablaGestorProductos.php");
					}else{
						swal("Error", "No se ha eliminado", "error");
					}
				}
			});
		} else {
			//swal("");
		}
	});
	return false;
}
function obteberDatosPro(id) {
	$.ajax({
		type:"POST",
		data:"ID="+id,  
		url:"PHP/Productos/ObtenerDatPro.php",
		success: function(respuesta){
			respuesta = jQuery.parseJSON(respuesta);
			$("#FormProM")[0].reset();
            M.updateTextFields();
            $('#IDS1').val(respuesta['Id']);
			$('#nombre1').val(respuesta['Nombre']);
			$('#Cant1').val(respuesta['Cantidad']);
			$('#Tp1').val(respuesta['Tp']);
			$('#precio1').val(respuesta['Precio']);
            $('#stock1').val(respuesta['Stock']);
            $('#marca1').val(respuesta['Marca']);
            $('#modelo1').val(respuesta['Modelo']);
            $('#carac1').val(respuesta['Carac']);
		}
	});
}
function ModificarProducto(){
	var frmData=new FormData;
	frmData.append("file1",$("input[name=file1]")[0].files[0]);
	frmData.append("IDS1",$("input[name=IDS1]").val());
	frmData.append("nombre1",$("input[name=nombre1]").val());
	frmData.append("Cant1",$("input[name=Cant1]").val());
	frmData.append("Tp1",$("input[name=Tp1]").val());
	frmData.append("precio1",$("input[name=precio1]").val());
	frmData.append("stock1",$("input[name=stock1]").val());
	frmData.append("marca1",$("input[name=marca1]").val());
	frmData.append("modelo1",$("input[name=modelo1]").val());
	frmData.append("carac1",$("input[name=carac1]").val());
	$.ajax({
		url:"PHP/Productos/ModificarPro.php",
		type:"POST",
		data:frmData,
		processData:false,
		contentType:false,
		cache:false,
		success:function(respuesta){
			respuesta=respuesta.trim();
			if (respuesta==1) {
				$('#Tb_Gest_Pro').load("Vistas/Gestor/TablaGestorProductos.php");
				$("#FormProM")[0].reset();
				swal("Correcto", "Producto actualizado", "success");
			}else{
				swal("Error", "Producto no actualizado", "error");
			}
		}
	});
	return false;
}