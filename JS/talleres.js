function agregarTallerNuevo(){
	var frmData=new FormData;
	frmData.append("file",$("input[name=file]")[0].files[0]);
	frmData.append("nombre",$("input[name=nombre]").val());
	frmData.append("info",$("textarea[name=info]").val());
	frmData.append("precio",$("input[name=precio]").val());
	$.ajax({
		url:"PHP/Talleres/Nuevo_Ta.php",
		type:"POST",
		data:frmData,
		processData:false,
		contentType:false,
		cache:false,
		success:function(respuesta){
			respuesta=respuesta.trim();
			if (respuesta=="Bien") {
				swal("Agregado", "Taller agregado correctamente", "success");
				$('#Tb_Gest_Ta').load("Vistas/Gestor/TablaGestorTalleres.php");
				$("#FormTa")[0].reset();
			}else if (respuesta=="PoJ") {
				swal("Error", "Ingrese una imagen png o jpg", "error");
			}else if (respuesta=="NsI") {
				swal("Error", "Solo se admiten imagenes", "error");
			}
		}
	});
	return false;
}
function eliminarTaller(id){
	swal({
		title: "¿Deseas eliminar este taller?",
		text: "Una vez eliminado no podra recuperar este taller",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {
			$.ajax({
				type:"POST",
				data:"ID="+id,
				url:"PHP/Talleres/Eliminar_Ta.php",
				success:function(respuesta){
					respuesta=respuesta.trim();
					if (respuesta>=1) {
						swal("Correcto", "Taller eliminado", "success");
						$('#Tb_Gest_Ta').load("Vistas/Gestor/TablaGestorTalleres.php");
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
function obteberDatosTa(id) {
	$.ajax({
		type:"POST",
		data:"ID="+id,  
		url:"PHP/Talleres/ObtenerDatTa.php",
		success: function(respuesta){
			respuesta = jQuery.parseJSON(respuesta);
			$("#FormTaM")[0].reset();
            M.updateTextFields();
            $('#IDS').val(respuesta['ID']);
			$('#nombre1').val(respuesta['Nombre']);
			$('#info1').val(respuesta['Info']);
			$('#precio1').val(respuesta['Precio']);
		}
	});
}
function ModificarTaller(){
	var frmData=new FormData;
	frmData.append("file1",$("input[name=file1]")[0].files[0]);
	frmData.append("IDS",$("input[name=IDS]").val());
	frmData.append("nombre1",$("input[name=nombre1]").val());
	frmData.append("info1",$("textarea[name=info1]").val());
	frmData.append("precio1",$("input[name=precio1]").val());
	$.ajax({
		url:"PHP/Talleres/ModificarTa.php",
		type:"POST",
		data:frmData,
		processData:false,
		contentType:false,
		cache:false,
		success:function(respuesta){
			respuesta=respuesta.trim();
			console.log(respuesta);
			if (respuesta==1) {
				$('#Tb_Gest_Ta').load("Vistas/Gestor/TablaGestorTalleres.php");
				swal("Correcto", "Taller actualizado", "success");
				$("#FormTaM")[0].reset();
			}else{
				swal("Error", "Taller no actualizado", "error");
			}
		}
	});
	/*$.ajax({
		type:"POST",
		data:$('#FormTaM').serialize(),
		url:"PHP/Talleres/ModificarTa.php",
		success: function(respuesta){
			respuesta=respuesta.trim();
			if (respuesta==1) {
				$('#Tb_Gest_Ta').load("Vistas/Gestor/TablaGestorTalleres.php");
				swal("Correcto", "Taller actualizado", "success");
			}else{
				swal("Error", "Taller no actualizado", "error");
			}
		}
	});*/
	return false;
}