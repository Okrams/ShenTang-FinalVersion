<!--Modla nuevo servicio-->
<div id="modal1t" class="modal">
	<div class="modal-content">
		<h5>Nuevo taller</h5> 
		<div class="row">
			<form id="FormTa" method="POST" onsubmit="return agregarTallerNuevo()">
				<div class="input-field col s12 l6">
					<input id="nombre" name="nombre" type="text" class="validate" required>
					<label for="nombre">Nombre</label>
				</div>
				<div class="input-field col s12 l6">
					<textarea id="info" name="info" class="validate materialize-textarea" required=""></textarea>
					<label for="info">contenido</label>
				</div>
                <div class="input-field col s12 l6">
					<input id="precio" name="precio" type="number" class="validate" required>
					<label for="precio">Precio</label>
                </div>
                <div class="file-field input-field col s12">
					<label>Imagen</label>
						<input type="file" id="file" name="file" required="">
					<div class="file-path-wrapper">
						<input class="file-path validate black-text" type="text">
					</div>
				</div>
				<div class="col s12">
					<button class="center btn btn-large amber lighten-1">Registrar</button>
				</div>
			</form>
		</div>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
	</div>
</div>
<!--Modal modificacion producto-->
<div id="modal2t" class="modal">
	<div class="modal-content">
		<h5>Modificar taller</h5>
		<div class="row">
			<form id="FormTaM" method="POST" onsubmit="return ModificarTaller()">
				<div class="input-field col s12 l6 hide">
					<input type="number" id="IDS" name="IDS" class="validate">
					<label for="IDS">ID</label>
				</div>
				<div class="input-field col s12 l6">
					<input placeholder="" id="nombre1" name="nombre1" type="text" class="validate" required>
					<label for="nombre1">Nombre</label>
				</div>
				<div class="input-field col s12 l6">
					<textarea placeholder="" id="info1" name="info1" class="validate materialize-textarea" required=""></textarea>
					<label for="info1">contenido</label>
				</div>
				<div class="input-field col s12 l6">
					<input placeholder="" id="precio1" name="precio1" type="number" class="validate" required>
					<label for="precio1">Precio</label>
				</div>
				<div class="file-field input-field col s12">
					<label>Imagen</label>
						<input type="file" id="file1" name="file1" required="">
					<div class="file-path-wrapper">
						<input class="file-path validate black-text" type="text">
					</div>
				</div>
				<div class="col s12">
					<button class="center btn btn-large amber lighten-1">Modificar</button>
				</div>
			</form>
		</div>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
	</div>
</div>