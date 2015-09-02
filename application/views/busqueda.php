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
					<div class="col-sm-6">
						<div class="form-group">
							<label for="txtPrecio">Desde:</label>
							<input type="number" min="0" name="txtPrecio" id="txtRang" class="form-control" required />
							<input type="hidden" name="txtCadena" id="txtCadena" value="<?=$cadena?>" />
						</div>
					</div>
					<div class="col-sm-1" style="margin-top:25px;text-align:center">
						<div class="form-group">
							<button class="btn btn-primary btn-sm" id="btnSearchQty">Ir</button>
						</div>
					</div>
				</form>
			</div> <hr>

			<p><strong>Menor a mayor precio</strong></p> <hr>
			<div class="row">
				<form action="<?=base_url()?>busqueda/precio" method="post" id="frmRange">
					<div class="col-xs-12">
						<div class="form-group">
							<a href="<?=base_url()?>busqueda/mayorMenor/2/<?=$cadena?>" class="btn btn-primary glyphicon ">Menor <span class="glyphicon-minus-sign"></span></a>
							<a href="<?=base_url()?>busqueda/mayorMenor/1/<?=$cadena?>" class="btn btn-primary glyphicon ">Mayor <span class="glyphicon-plus-sign"></span></a>
						</div>
					</div>
				</form>
			</div> <hr>
			<div class="row">
				<div class="col-xs-12">
					<p><strong>Por rango de precios</strong></p>
				</div>
				<form action="<?=base_url()?>busqueda/rango" method="post" id="frmRangeSearch">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="txtPrecioo">Desde:</label>
							<input type="number" min="0" name="txtRange1" id="txtRange1" class="form-control" required />
							<input type="hidden" name="txtCad" id="txtCad" value="<?=$cadena?>" />
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="txtRange2">Hasta:</label>
							<input type="number" min="0" name="txtRange2" id="txtRange2" class="form-control" required />
						</div>
					</div>
					<div class="col-sm-1 col-sm-offset-6" style="text-align:center">
						<div class="form-group">
							<button class="btn btn-primary btn-sm" id="btnSearchRange">Ir</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-sm-9">
			<?php foreach($articulos->result() as $art) { ?>
			<article class="articulomarca">
				<div class="col-xs-12">
					<div class="col-xs-6 divImg">
						<figure>
							<a href="<?=base_url()?>productos/detallesproducto/<?=$art->id_articulo?>">
							<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($art->sku, 0,1) ?>
							/<?=substr($art->sku, 1,1)?>/<?=$art->sku?>.jpg" alt="" data-sku="<?=$art->sku?>"  /></a>
						</figure>
					</div>
					<div class="col-xs-6">
						<a href="<?=base_url()?>productos/detallesproducto/<?=$art->id_articulo?>">
							<p class="descripcion"><?=$art->descripcion?></p></a>
						<p class="marcap"><?=$art->marca?></p>
						<p>SKU <strong><?=$art->sku?></strong></p>
						<p class="price"><strong>$ <?php $utilidad=$art->utilidad; if($art->utilidad==0)$utilidad=$art->ut; echo number_format(ceil(($art->precio+(($art->precio*$utilidad)/100))*1.16),2,".",",")?></strong></p>
					</div>
				</div>
			</article>
			<?php } ?>
		</div>
	</div>
</div>