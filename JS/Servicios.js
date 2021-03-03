function agregarServicioNuevo () {
	var frmData=new FormData;
	frmData.append("file",$("input[name=file]")[0].files[0]);
	frmData.append("nombre",$("input[name=nombre]").val());
	frmData.append("Cont",$("textarea[name=Cont]").val());
	frmData.append("precio",$("input[name=precio]").val());
	frmData.append("MaxP",$("input[name=MaxP]").val());
	frmData.append("Ses",$("input[name=Ses]").val());
	var ses=$('#Ses').val();
	for (var i = 0; i < ses; i++) {
		frmData.append("SesN"+i,$("input[name=SesN"+i+"]").val());
		console.log($("input[name=Ses"+i+"]").val());
	}
	$.ajax({
		url:"PHP/Servicios/Nuevo_Ser.php",
		type:"POST",
		data:frmData,
		processData:false,
		contentType:false,
		cache:false,
		success:function(respuesta){
			respuesta=respuesta.trim();
			if (respuesta=="Bien") {
				swal("Agregado", "Servicio agregado correctamente", "success");
				$('#Tb_Gest_Ser').load("Vistas/Gestor/TablaGestorServicios.php");
				$("#FormSer")[0].reset();
			}else if (respuesta=="PoJ") {
				swal("Error", "Ingrese una imagen png o jpg", "error");
			}else if (respuesta=="NsI") {
				swal("Error", "Solo se admiten imagenes", "error");
			}
		}
	});
	return false;
}
function eliminarServicio(id){
	swal({
		title: "¿Deseas eliminar este servicio?",
		text: "Una vez eliminado no podra recuperar este servicio",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {
			$.ajax({
				type:"POST",
				data:"ID="+id,
				url:"PHP/Servicios/Eliminar_Ser.php",
				success:function(respuesta){
					respuesta=respuesta.trim();
					if (respuesta==1) {
						swal("Correcto", "Servicio eliminado", "success");
						$('#Tb_Gest_Ser').load("Vistas/Gestor/TablaGestorServicios.php");
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
function obteberDatosServ (id) {
	$.ajax({
		type:"POST",
		data:"ID="+id,
		url:"PHP/Servicios/ObtenerDat.php",
		success: function(respuesta){
			respuesta = jQuery.parseJSON(respuesta);
			$("#FormSerM")[0].reset();
			M.updateTextFields();
			$('#IDS').val(respuesta['ID']);
			$('#nombre1').val(respuesta['Nombre']);
			$('#Cont1').val(respuesta['Contenido']);
			$('#precio1').val(respuesta['Precio']);
			$('#MaxP1').val(respuesta['Personas']);
			$('#Ses1').val(respuesta['Sesiones']);
			$('#NuevosE').empty();
			for (var i = 0; i < respuesta['Sesiones']; i++) {
				dvsI='<div class="input-field col s12 l6">';
				int='<input id="SesE'+i+'" name="SesE'+i+'" type="text" class="validate" required>';
				lbl='<label for="SesE'+i+'">Horario '+(i+1)+'</label>';
				dvsE='</div>'
				campo = dvsI+int+lbl+dvsE;
				$("#NuevosE").append(campo); 
			}
		}
	});
}
function ModificarServicio(){
	var frmData=new FormData;
	frmData.append("file1",$("input[name=file1]")[0].files[0]);
	frmData.append("IDS",$("input[name=IDS]").val());
	frmData.append("nombre1",$("input[name=nombre1]").val());
	frmData.append("Cont1",$("textarea[name=Cont1]").val());
	frmData.append("precio1",$("input[name=precio1]").val());
	frmData.append("MaxP1",$("input[name=MaxP1]").val());
	frmData.append("Ses1",$("input[name=Ses1]").val());
	var ses=$('#Ses1').val();
	for (var i = 0; i < ses; i++) {
		frmData.append("SesE"+i,$("input[name=SesE"+i+"]").val());
		console.log($("input[name=Ses1"+i+"]").val());
	}
	$.ajax({
		url:"PHP/Servicios/ModificarSer.php",
		type:"POST",
		data:frmData,
		processData:false,
		contentType:false,
		cache:false,
		success:function(respuesta){
			respuesta=respuesta.trim();
			if (respuesta==1) {
				$('#Tb_Gest_Ser').load("Vistas/Gestor/TablaGestorServicios.php");
				swal("Correcto", "Servicio actualizado", "success");
			}else{
				swal("Error", "Servicio no actualizado", "error");
			}
		}
	});
	return false;
}