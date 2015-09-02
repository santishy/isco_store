<div class="container">
	<div class="row">
		
  			<div class="panel panel-info">
			  <!-- Default panel contents -->
			  	<div class="panel-heading">Envios</div>
			  	<div class="panel-body">
			    	<p><?=$paginacion?></p>
			 	 </div>
			  	<!-- Table -->
			  	<table class="table table bordered tablaR">
			   		<THEAD>
			   			<TH>NOMBRE</TH>
			   			<TH>ESTADO</TH>
			   			<TH>CALLE</TH>
			   			<TH>TELEFONO</TH>
			   			<th>PAGO</th>
			   			<TH>OPCIONES</TH>
			   		</THEAD>
			   		<TBODY>
			   			<?PHP foreach($query->result() as $row){ ?>
			   				<tr>
			   					<td>
			   						<p><?=$row->nombre?></p>
			   						<p><?=$row->apellido_paterno?></p>
			   						<p><?=$row->apellido_materno?></p>
			   					</td>
			   					<td>
			   						<p><?=$row->estado?></p>
			   						<p><?=$row->ciudad?></p>
			   					</td>
			   					<td>
			   						<p><?=$row->calle?></p>
			   						<p><?=$row->n_interior?></p>
			   						<p><?=$row->n_exterior?></p>
			   					</td>
			   					<td>
			   						<p><?=$row->telefono?></p>
			   					</td>
			   					<td>
			   						<p><?=$row->total?></p>
			   						<p><?=$row->fecha_pago?></p>
			   						<p><?=$row->tipo_pago?></p>
			   					</td>
			   					<td data-pago="<?=$row->id_pago?>" data-envio="<?=$row->id_cliente?>">
			   						<button type="button" class="btn btn-info btn-xs btnRemision"><span class="glyphicon glyphicon-registration-mark"></span></button>
			   						<button type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-folder-open"></span></button>
			   					</td>
			   				</tr>
			   			<?php } ?>
			   		</TBODY>
			  	</table>
			</div>
		</div><!--panel-->
	</div>
</div><!--container-->