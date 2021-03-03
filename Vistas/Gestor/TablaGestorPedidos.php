<?php
session_start();
require("../../PHP/conexiondb.php"); 
?>
<div  id="prin" class="row">
	<div class="col col s12 m10 offset-m1  l10 offset-l1">
		<!--<a href="#"  onclick="enviar();" class="btn">Enviar</a>-->
		<table class="responsive-table highlight centered " id="GestorDatatable">
			<thead class="deep-purple lighten-4">
				<tr>
					
					<th>ID Pedido</th>
					<th class="">Usuario</th>
					<th>Total</th>
					<th>Estado</th>
					<th>Fecha</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$sql="SELECT * FROM pedido";
				$resultado=$base->prepare($sql);
				$resultado->execute();
				while($registro=$resultado->fetch(PDO::FETCH_OBJ)){
					?>
					<tr>
						
						<td><?php echo $registro->ID_Pedido; ?></td>
						<td><?php echo $registro->N_Usuario; ?></td>
						<td><?php echo $registro->Total; ?></td>
						<td><?php echo $registro->Estado; ?></td>
						<td><?php echo $registro->fecha ?></td>
						<td> 
							<?php
							//if($_SESSION['Permisos']<=2){

								?>
								<span href="#modal1p" onclick="obteberDatosPe(<?php echo $registro->ID_Pedido; ?>)" class="btn-small blue modal-trigger" style="margin-left: 1px;"><i class="material-icons ">remove_red_eye</i></span>
								<span onclick="PedidoListo(<?php echo $registro->ID_Pedido.",'".$registro->N_Usuario."'"; ?>)" class="btn-small green" style="margin-left: 1px;"><i class="material-icons ">shopping_basket</i></span>
								<span onclick="Entregado(<?php echo $registro->ID_Pedido.",'".$registro->N_Usuario."'"; ?>)" class="btn-small green accent-2" style="margin-left: 1px;"><i class="material-icons ">thumb_up</i></span>
								<?php
							//}
							?>
						</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		t = $('#GestorDatatable').DataTable({
			/*dom: 'Bflrtip',
			buttons: [
            'excelHtml5',
            'pdfHtml5'
        	]*/

		});
		$('.dt-buttons').after("<br><br>");
		$("select").formSelect();
	});
	var specialElementHandler={
		'#editor':function(element,render){
			return true;
		}
	}
</script>