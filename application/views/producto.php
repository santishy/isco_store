<div class="container ">
	<div class="row">
		<div class="col-md-12 ">
			<?php foreach($articulo->result() as $art){ ?>			
			<div class="col-xs-12">
				<div class="col-md-5 ">
					<figure>
						<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($art->sku, 0,1)?>/<?=substr($art->sku, 1,1)?>/<?=$art->sku?>.jpg"
						 alt="imagen de producto" class="img-responsive" />
					</figure>
				</div>
				<div class="col-md-7 div-compra">
					<div class="col-md-12">
						<h3><?=$art->descripcion?></h3>
					</div>
					<div class="col-md-7">
						<h4>Descripción breve</h4>
						<div class="descripcion">

							<table class="table table-hover">
								
								<tbody>
									<tr>
										<td class="">Linea</td>
										<td><?=$linea?></td>
									</tr>
									<tr>
										<td class="">Sección</td>
										<td><?=$seccion?></td>
									</tr>
									<tr>	
										<td class="">Marca</td>
										<td><?=$marca?></td>
									</tr>	
									<tr>
										<td class="">Serie</td>
										<td><?=$serie?></td>
									</tr>
								</tbody>					
							</table>
						</div>
						<p class="text-right"><a href="#especificaciones">Ver especificaciones completas</a></p>
					</div>
					<div class="col-md-5  container-cant-first text-center">
						<p class="precio">$<?=number_format($costo,2,".",",")?></p>
						<p class="iva">El precio incluye IVA</p>						
						<p class="disponible col-md-11 text-left">Disponibles: <span><?=$existencia?></span></p>
						<div class="col-md-12 div-cant">
							<form action="<?=base_url()?>cart/addCart" name="frmCart" method="post" id="frmCart">
								<div class="form-group">
									<div class="input-group">
										<input type="number" class="form-control" name="txtCantidad" value="1" min="1" max="<?=$existencia?>" id="txtCantidad" />
										<input type="hidden" name="id_articulo" value="<?=$art->id_articulo?>" />
										<input type="hidden" name="txtNombre" value="<?=$art->descripcion?>" />
										<input type="hidden" name="txtAlmacen" value="<?=$almacen?>" />
										<input type="hidden" name="txtSku" value="<?=$sku?>" />
										<input type="hidden" name="txtPrecio" value="<?=$costo?>" />
										<input type="hidden" name="moneda" value="<?=$moneda?>">
										<input type="hidden" name="txtExis" value="<?=$existencia?>" />
										<span class="input-group-btn" >
											<button id="btnCart" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Agregar al carrito</button>
										</span>
									</div>
								</div>

								
									
							
							</form>
						</div>
						<p class="costo-envio">Costo de envio $99 pesos Enviamos a toda la República</p>	
						
					</div>
										
				</div>

			</div>
			<?php } ?>
		</div>
	</div><hr>
	<div class="row container-especificaciones" id="especificaciones">
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