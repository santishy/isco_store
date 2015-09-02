<div class="container container-article">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1 div-article">
			<?php foreach($articulo->result() as $art){ ?>
			<div class="col-xs-12">
				<h3><?=$art->descripcion?></h3>
				<hr>
			</div>
			<div class="col-xs-12">
				<div class="col-sm-6 div-image">
					<figure>
						<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($art->sku, 0,1)?>/<?=substr($art->sku, 1,1)?>/<?=$art->sku?>.jpg"
						 alt="imagen de producto"  />
					</figure>
				</div>
				<div class="col-sm-6 div-compra">
					<p>Precio: <span>$<?=number_format($costo,2,".",",")?></span></p>
					<p>El precio incluye IVA</p>
					<p>Costo de envio $99 pesos Enviamos a toda la República</p>
					<div class="col-xs-12 container-cant-first">
						<div class="col-xs-2 col-xs-offset-1 col-lg-offset-2 div-existencia">
							<div>
								<p><?=$existencia?></p>
								<p class="exis">disponibles</p>
							</div>
						</div>
						<div class="col-xs-5 col-xs-offset-1 div-cant">
							<form action="<?=base_url()?>cart/addCart" name="frmCart" method="post" id="frmCart">
								<div class="form-group">
									<label for="txtCantidad">Cantidad</label>
									<input type="number" class="form-control" name="txtCantidad" value="1" min="1" max="<?=$existencia?>" id="txtCantidad" />
									<input type="hidden" name="id_articulo" value="<?=$art->id_articulo?>" />
									<input type="hidden" name="txtNombre" value="<?=$art->descripcion?>" />
									<input type="hidden" name="txtAlmacen" value="<?=$almacen?>" />
									<input type="hidden" name="txtSku" value="<?=$sku?>" />
									<input type="hidden" name="txtPrecio" value="<?=$costo?>" />
									<input type="hidden" name="moneda" value="<?=$moneda?>">
									<input type="hidden" name="txtExis" value="<?=$existencia?>" />
								</div>
								<div class="form-group">
									<button id="btnCart" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Agregar al carrito</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div><hr>
	<div class="row container-especificaciones">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="table-responsive">
				<table class="table table-hover">
					<caption>ESPECIFICACIONES DEL PRODUCTO</caption>
					<thead>
						<tr>
							<th colspan="2" class="success">CARACTERÍSTICAS</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="success">Linea</td>
							<td><?=$linea?></td>
						</tr>
						<tr>
							<td class="success">Sección</td>
							<td><?=$seccion?></td>
						</tr>
						<tr>	
							<td class="success">Marca</td>
							<td><?=$marca?></td>
						</tr>	
						<tr>
							<td class="success">Serie</td>
							<td><?=$serie?></td>
						</tr>
					</tbody>
					<thead>	
						<tr>
							<th colspan="2" class="info">
								MEDIDAS
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="info">Alto</td>
							<td><?=$alto?> cm</td>
						</tr>	
						<tr>
							<td class="info">Ancho</td>
							<td><?=$ancho?> cm</td>
						</tr>
						<tr>	
							<td class="info">Largo</td>
							<td><?=$largo?> cm</td>
						</tr>
						<tr>	
							<td class="info">Peso</td>
							<td><?=$peso?> kg</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

