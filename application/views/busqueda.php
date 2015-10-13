<div class="container divProductosMarca">
	<div class="row">
		<div class="col-xs-9">
			<h3><?=$articulos->num_rows().' '?> resultados para: <?=$cadena?></h3>
			<?php 
				if($precio != '' && $preciof == '')
					echo '<p style="font-size:16px;"> Precio desde <strong>$'. $precio . '</strong></p>';
				else if($precio != '' && $preciof != '')
					echo '<p style="font-size:16px;"> Precios entre <strong>$'. $precio . ' y '.$preciof.' </strong></p>';
			?>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-sm-3">
			<p><strong>Búsqueda por precio</strong></p> <hr>
			<div class="row">
				<form action="<?=base_url()?>busqueda/precio" method="post" id="frmRange">
					<div class="col-sm-12 col-xs-12">
						<div class="form-group">
							<div class="input-group">
								<input type="number" min="0" name="txtPrecio" id="txtRang" class="form-control" placeholder="Desde" required />
								<input type="hidden" name="txtCadena" id="txtCadena" value="<?=$cadena?>" />
								<span class="input-group-btn">
					        		<button class="btn btn-primary" id="btnSearchQty">Ir</button>
					      		</span>
							</div>
						</div>
					</div>
					
				</form>
			</div> <hr>

			<p><strong>Menor a mayor precio</strong></p> <hr>
			<div class="row">
				<form action="<?=base_url()?>busqueda/precio" method="post" id="frmRange">
					<div class="col-xs-12">
						<div class="form-group">
							<a href="<?=base_url()?>busqueda/mayorMenor/2/<?=$cadena?>" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="de menor a mayor">
								<span class="glyphicon glyphicon-menu-down"></span>
								<span class="glyphicon glyphicon-menu-up"></span>
							</a>
							<a href="<?=base_url()?>busqueda/mayorMenor/1/<?=$cadena?>" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="de mayor a menor">
								<span class="glyphicon glyphicon-menu-up"></span>
								<span class="glyphicon glyphicon-menu-down"></span>
							</a>
						</div>
					</div>
				</form>
			</div> <hr>
			<div class="row">
				<div class="col-xs-12">
					<p><strong>Por rango de precios</strong></p>
				</div>
				<form action="<?=base_url()?>busqueda/rango" method="post" id="frmRangeSearch">
					<div  class="col-sm-12 col-xs-12">
						<div class="form-group">
							<div class="input-group">
								<input type="number" min="0" name="txtRange1" id="txtRange1" placeholder="Desde" class="form-control" required style="width: 50%;"/>
								<input type="hidden" name="txtCad" id="txtCad" value="<?=$cadena?>" />						
								<input type="number" min="0" name="txtRange2" id="txtRange2" placeholder="Hasta" class="form-control" required style="width: 50%;"/>
								<span class="input-group-btn">
					        		<button class="btn btn-primary" id="btnSearchRange">Ir</button>
					      		</span>
					      	</div>
						</div>
					</div>
					
				</form>
			</div>
		</div>
		<div class="col-sm-9">
			<?php if($articulos->num_rows() > 0){?>
			<?php foreach($articulos->result() as $art) { ?>
			<article >
				<div class=" row articulomarca">
					<div class="col-xs-6 col-md-4 divImg">
						<figure>
							<a href="<?=base_url()?>productos/detallesproducto/<?=$art->id_articulo?>">
								<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($art->sku, 0,1)?>									/<?=substr($art->sku, 1,1)?>/<?=$art->sku?>.jpg" class="img-responsive" alt="" data-sku="<?=$art->sku?>"  />
							</a>
						</figure>
					</div>
					<div class="col-xs-6 col-md-offset-1  col-md-6">
						<a href="<?=base_url()?>productos/detallesproducto/<?=$art->id_articulo?>">
							<p class="pDesc descripcion"> <?=$art->descripcion?></p></a>
						<p class="marcap"><?=$art->marca?></p>
						<p class="sku">SKU: <strong><?=$art->sku?></strong></p>
						<p class="price"><strong>$ <?php $utilidad=$art->utilidad; if($art->utilidad==0)$utilidad=$art->ut; echo number_format(ceil((($art->precio+(($art->precio*$utilidad)/100))*1.16)),2,".",",")?> </strong></p>
					</div>
				</div>
			</article>			
			<?php } ?>
			<?php } else { ?> 	<div class="col-md-12">
								<div class="ups figure">
									<b></b><b></b>
									<i></i>
								</div>
								
								</div>
								<p class="text-center">No hay resultados para la búsqueda</p>
								 <?php } ?>
		</div>
	</div>
</div>