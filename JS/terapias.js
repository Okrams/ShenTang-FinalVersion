function agregarTerapiaNuevo(){
	var frmData=new FormData;
	frmData.append("file",$("input[name=file]")[0].files[0]);
	frmData.append("nombre",$("input[name=nombre]").val());
	frmData.append("info",$("textarea[name=info]").val());
	frmData.append("precio",$("input[name=precio]").val());
	$.ajax({
		url:"PHP/Terapias/Nuevo_Te.php",
		type:"POST",
		data:frmData,
		processData:false,
		contentType:false,
		cache:false,
		success:function(respuesta){
			respuesta=respuesta.trim();
			console.log(respuesta);
			if (respuesta=="Bien") {
				swal("Agregado", "Terapia agregada correctamente", "success");
				$('#Tb_Gest_Te').load("Vistas/Gestor/TablaGestorTerapias.php");
				$("#FormTe")[0].reset();
			}else if (respuesta=="PoJ") {
				swal("Error", "Ingrese una imagen png o jpg", "error");
			}else if (respuesta=="NsI") {
				swal("Error", "Solo se admiten imagenes", "error");
			}
		}
	});
	return false;
}
function eliminarTerapia(id){
	swal({
		title: "¿Deseas eliminar esta terapia?",
		text: "Una vez eliminado no podra recuperar esta terapia",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {
			$.ajax({
				type:"POST",
				data:"ID="+id,
				url:"PHP/Terapias/Eliminar_Te.php",
				success:function(respuesta){
					respuesta=respuesta.trim();
					if (respuesta>=1) {
						swal("Correcto", "Terapia eliminada", "success");
						$('#Tb_Gest_Te').load("Vistas/Gestor/TablaGestorTerapias.php");
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
function obteberDatosTe(id) {
	$.ajax({
		type:"POST",
		data:"ID="+id,  
		url:"PHP/Terapias/ObtenerDatTe.php",
		success: function(respuesta){
			respuesta = jQuery.parseJSON(respuesta);
			$("#FormTeM")[0].reset();
            M.updateTextFields();
            $('#IDS').val(respuesta['ID']);
			$('#nombre1').val(respuesta['Nombre']);
			$('#info1').val(respuesta['Info']);
			$('#precio1').val(respuesta['Precio']);
		}
	});
}
function ModificarTerapia(){
	var frmData=new FormData;
	frmData.append("file1",$("input[name=file1]")[0].files[0]);
	frmData.append("IDS",$("input[name=IDS]").val());
	frmData.append("nombre1",$("input[name=nombre1]").val());
	frmData.append("info1",$("textarea[name=info1]").val());
	frmData.append("precio1",$("input[name=precio1]").val());
	$.ajax({
		url:"PHP/Terapias/ModificarTe.php",
		type:"POST",
		data:frmData,
		processData:false,
		contentType:false,
		cache:false,
		success:function(respuesta){
			respuesta=respuesta.trim();
			console.log(respuesta);
			if (respuesta==1) {
				$('#Tb_Gest_Te').load("Vistas/Gestor/TablaGestorTerapias.php");
				swal("Correcto", "Terapia actualizada", "success");
			}else{
				swal("Error", "Terapia no actualizada", "error");
			}
		}
	});
	/*
	$.ajax({
		type:"POST",
		data:$('#FormTeM').serialize(),
		url:"PHP/Terapias/ModificarTe.php",
		success: function(respuesta){
			respuesta=respuesta.trim();
			if (respuesta==1) {
				$('#Tb_Gest_Te').load("Vistas/Gestor/TablaGestorTerapias.php");
				swal("Correcto", "Terapia actualizada", "success");
			}else{
				swal("Error", "Terapia no actualizada", "error");
			}
		}
	});*/
	return false;
}