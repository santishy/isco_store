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
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-12 div relacionados"> 	
			<div class="container">
  
		  <div class="span8">
		    
		    <h1>Te puede interesar</h1>
		    
		    <div class="">
		     
		    <div id="myCarousel" class="carousel slide">
		     
		    
		     
		    <!-- Carousel items -->
		    <div class="carousel-inner">
		        
		    
		     	<div class="item active">
		        	<div class="row-fluid">
		          <?php for($i=0;$i<count($query);$i++) { ?>
		          	<?php if ($i<4) {?>
		          	
		          	<div class="col-md-3 col-xs-6 col-sm-6 p-relacionado" >
						<div class="col-xs-12 col-sm-12 col-md-12 divArticles">
		          		<a href="<?=base_url()?>productos/detallesproducto/<?=$query[$i]['id_articulo']?>" >			          			
							<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($query[$i]['sku'], 0,1)?>/<?=substr($query[$i]['sku'], 1,1)?>/<?=$query[$i]['sku']?>.jpg" alt="" data-sku="<?=$query[$i]['sku']?>" class="img-responsive thumb"/>						
		          		</a>
		          		<p class="descripcion">
							<a href="<?=base_url()?>productos/detallesproducto/<?=$query[$i]['id_articulo']?>"><?=$query[$i]['descripcion']?></a>
						</p>
							<div class="descripcion-costo">
								<!--<p><del>$ <?=$ar->precio?></del> </p>-->
								<?php if($query[$i]['descuento'] > 0){ ?>
									<p class="spnCosto">$ <?php $utilidad=$query[$i]['utilidad']; if($query[$i]['utilidad']==0)$utilidad=$query[$i]['ut']; echo number_format(ceil(($query[$i]['precio']+(($query[$i]['precio']*$utilidad)/100))-(($des->precio*$query[$i]['descuento'])/100)*1.16),2,".",",")?></p>
								<?php } else { ?>
									<p class="spnCosto">$ <?php $utilidad=$query[$i]['utilidad']; if($query[$i]['utilidad']==0)$utilidad=$query[$i]['ut']; echo number_format(ceil(($query[$i]['precio']+(($query[$i]['precio']*$utilidad)/100))*1.16),2,".",",")?></p>
								<?php } ?>	
							</div>
							<!--<div>
								<a href="#"><button class="btn btn-primary btn-sm pull-right  btnCart">Añadir <span class="glyphicon glyphicon-shopping-cart white" style="color:white;" aria-hidden="true"></span></button></a>
							</div>-->
		          		</div>
		          	</div>
		          	
		        	<?php } ?>
		          	<?php } ?>
		         </div><!--/row-fluid-->
		    	</div><!--/item-->
		    	<div class="item ">
		        	<div class="row-fluid">
		          <?php for($i=0;$i<count($query);$i++) { ?>
		          	<?php if ($i>3 && $i<8){?>
		          	
		          	<div class="col-md-3 col-xs-6 col-sm-6 p-relacionado" >
						<div class="col-xs-12 col-sm-12 col-md-12 divArticles">
		          		<a href="<?=base_url()?>productos/detallesproducto/<?=$query[$i]['id_articulo']?>" >			          			
							<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($query[$i]['sku'], 0,1)?>/<?=substr($query[$i]['sku'], 1,1)?>/<?=$query[$i]['sku']?>.jpg" alt="" data-sku="<?=$query[$i]['sku']?>" class="img-responsive thumb"/>						
		          		</a>
		          		<p class="descripcion">
							<a href="<?=base_url()?>productos/detallesproducto/<?=$query[$i]['id_articulo']?>"><?=$query[$i]['descripcion']?></a>
						</p>
							<div class="descripcion-costo">
								<!--<p><del>$ <?=$ar->precio?></del> </p>-->
								<?php if($query[$i]['descuento'] > 0){ ?>
									<p class="spnCosto">$ <?php $utilidad=$query[$i]['utilidad']; if($query[$i]['utilidad']==0)$utilidad=$query[$i]['ut']; echo number_format(ceil(($query[$i]['precio']+(($query[$i]['precio']*$utilidad)/100))-(($des->precio*$query[$i]['descuento'])/100)*1.16),2,".",",")?></p>
								<?php } else { ?>
									<p class="spnCosto">$ <?php $utilidad=$query[$i]['utilidad']; if($query[$i]['utilidad']==0)$utilidad=$query[$i]['ut']; echo number_format(ceil(($query[$i]['precio']+(($query[$i]['precio']*$utilidad)/100))*1.16),2,".",",")?></p>
								<?php } ?>	
							</div>
							<!--<div>
								<a href="#"><button class="btn btn-primary btn-sm pull-right  btnCart">Añadir <span class="glyphicon glyphicon-shopping-cart white" style="color:white;" aria-hidden="true"></span></button></a>
							</div>-->
		          		</div>
		          	</div>
		          	
		        	<?php } ?>
		          	<?php } ?>
		         </div><!--/row-fluid-->
		    	</div><!--/item-->
				
		    
		     
		    </div><!--/carousel-inner-->
		     
		    <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
		    <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
		    </div><!--/myCarousel-->
		     
		    </div><!--/well-->
		  </div>
		</div>
 
	</div>
	</div>
	<hr>
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