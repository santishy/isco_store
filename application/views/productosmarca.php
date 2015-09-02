<div class="container divProductosMarca">
	<div class="row">
		<div class="col-xs-9">
			<?php foreach($nombremarca->result() as $marca) { 
				if($ban == 1)
				{
			?>
				<h1 class="h1-seccion">PRODUCTOS MARCA <?=$marca->marca?></h1> 
			<?php } else { ?>
				<h1 class="h1-seccion"><?=$marca->seccion?></h1>
			<?php }}
				if($precio != '' && $preciof == '')
					echo '<p style="font-size:16px;"> Precios desde <strong>$'. $precio . '</strong></p>';
				else if($precio != '' && $preciof != '')
					echo '<p style="font-size:16px;"> Precios entre <strong>$'. $precio . ' y '.$preciof.' </strong></p>';
			?>	
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-sm-3 busqueda-rango" >
			<span id="prueba" class="glyphicon glyphicon-search"></span>
			<div class="panel panel-default">
  						<div class="panel-body">
						<p><strong>Búsqueda por precio</strong></p> <hr>
						<div class="row">
							<form action="<?=base_url()?>articulos/precio/<?=$this->uri->segment(3)?>/<?=$this->uri->segment(4)?>/<?=$this->uri->segment(5)?>" method="post" id="frmRange">
								<div class="col-sm-6 col-xs-6">
									<div class="form-group">
										<label for="txtRang">Desde:</label>
										<input type="number" min="0" name="txtRang" id="txtRang" class="form-control" required />
										<input type="hidden" name="linea" value="<?=$linea?>">
									</div>
								</div>
								<?php foreach($nombremarca->result() as $marca) { 
									if($ban == 1){
								?>
									<input type="hidden" name="txtId" value="<?=$marca->id_marca?>">
								<?php } else { ?>
									<input type="hidden" name="txtId" value="<?=$marca->id_seccion?>">
								<?php }}?>	
								<input type="hidden" name="txtBan" value="<?=$ban?>">
								<div class="col-sm-1 col-xs-2" style="margin-top:25px;text-align:center">
									<div class="form-group">
										<button class="btn btn-primary btn-sm" id="btnSearchQty">Ir</button>
									</div>
								</div>
							</form>
						</div> <hr style="display:<?php if($this->uri->segment(2)=='rango' || $this->uri->segment(2)=='precio') echo 'none';?>">
						<p style="display:<?php if($this->uri->segment(2)=='rango' || $this->uri->segment(2)=='precio') echo 'none';?>"><strong>Menor a mayor precio</strong></p> 
						<div class="row" style="display:<?php if($this->uri->segment(2)=='rango' || $this->uri->segment(2)=='precio') echo 'none';?>">
							<form action="<?=base_url()?>busqueda/precio" method="post" id="frmRange">
								<div class="col-xs-12">
									<div class="form-group">
										<?php if($this->uri->segment(4)=='linea'){ ?>
											<a href="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/linea/<?=$this->uri->segment(5)?>/2" class="btn btn-primary glyphicon ">Menor <span class="glyphicon-minus-sign"></span></a>
											<a href="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/linea/<?=$this->uri->segment(5)?>/1" class="btn btn-primary glyphicon ">Mayor <span class="glyphicon-plus-sign"></span></a>	
										<?php } else {?>
											<a href="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/2" class="btn btn-primary glyphicon ">Menor <span class="glyphicon-minus-sign" ></span></a>
											<a href="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/1" class="btn btn-primary glyphicon ">Mayor <span class="glyphicon-plus-sign"></span></a>
										<?php }?>
									</div>
								</div>
							</form>
						</div> <hr>
						<div class="row">
							<div class="col-xs-12">
								<p><strong>Por rango de precios</strong></p>
							</div>
							<form action="<?=base_url()?>articulos/rango/<?=$this->uri->segment(3)?>/<?=$this->uri->segment(4)?>/<?=$this->uri->segment(5)?>" method="post" id="frmRangeSearch">
								<div class="col-sm-4 col-xs-4">
									<div class="form-group">
										<label for="txtRange1">Desde:</label>
										<input type="number" min="0" name="txtRange1" id="txtRange1" class="form-control" required />
									</div>
								</div>
								<div class="col-sm-4 col-xs-4">
									<div class="form-group">
										<label for="txtRange2">Hasta:</label>
										<input type="number" min="0" name="txtRange2" id="txtRange2" class="form-control" required />
										<input type="hidden" name="txtban" value="<?=$ban?>">
										<input type="hidden" name="linea" value="<?=$linea?>">
									</div>
								</div>
								<?php foreach($nombremarca->result() as $marca) { 
									if($ban == 1){
								?>
									<input type="hidden" name="txtIdArt" value="<?=$marca->id_marca?>">
								<?php } else { ?>
									<input type="hidden" name="txtIdArt" value="<?=$marca->id_seccion?>">
								<?php }}?>	
								<input type="hidden" name="txtBan" value="<?=$ban?>">
								<div class="col-sm-2 col-xs-2">
									<div class="form-group" style="margin-top:25px;">
										<button class="btn btn-primary btn-sm" id="btnSearchRange">Ir</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		<div class="col-md-3">
			<div class="panel panel-primary">
			  <!-- Default panel contents -->
			  <div class="panel-heading">Categorias</div>
			  <!-- List group -->
			  <ul class="list-group">
			  	<?php foreach($categorias->result() as $row){?>
			    <li class="list-group-item"><a href="<?=base_url()?>articulos/<?php if($ban==2) echo 'secciones'; else echo 'marcas';?>/<?=$id?>/linea/<?=$row->id_linea?>"><?=$row->linea?></a><span class="badge"><?=$row->nume?></span></li>
			    <?php }?>
			  </ul>
			</div>
		</div>
		<div class="col-sm-9">
			<?php if($artmarca->num_rows() > 0){?>
				<?php foreach($artmarca->result() as $art) { ?>
				<article class="articulomarca">
					<div class="col-xs-12">
						<div class="col-xs-6 divImg">
							<figure>
								<a href="<?=base_url()?>productos/detallesproducto/<?=$art->id_articulo?>">
								<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($art->sku, 0,1)?>
								/<?=substr($art->sku, 1,1)?>/<?=$art->sku?>.jpg" class="image-responsive" alt="" data-sku="<?=$art->sku?>"  /></a>
							</figure>
						</div>
						<div class="col-xs-6">
							<a href="<?=base_url()?>productos/detallesproducto/<?=$art->id_articulo?>">
								<p class="pDesc descripcion"> <?=$art->descripcion?></p></a>
							<p class="marcap"><?=$art->marca?></p>
							<p>SKU <strong><?=$art->sku?></strong></p>
							<p class="price"><strong>$ <?php $utilidad=$art->utilidad; if($art->utilidad==0)$utilidad=$art->ut; echo number_format(ceil((($art->precio+(($art->precio*$utilidad)/100))*1.16)),2,".",",")?> </strong></p>
						</div>
					</div>
				</article>
				<?php } ?>
			<?php } else { ?> <p class="text-center">No hay resultados para la búsqueda</p> <?php } ?>
		</div>
	</div>
	<div class="text-center">
		<p style="text-align:center;"><?=$paginacion?></p>
	</div>
</div>
<script src="<?=base_url()?>js/busqueda.js"></script>