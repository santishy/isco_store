<!-- carrusel de imagenes -->
<div class="container-full">
	<div class="row">
		<div class="col-md-12">
			<div id="mySlider" class="carousel slide" data-ride="carousel">
				<!--<ol class="carousel-indicators">
					<li data-target="#mySlider" data-slide-to="0" class="active prev"></li>
				    <li data-target="#mySlider" data-slide-to="1" class="prev"></li>
				    <li data-target="#mySlider" data-slide-to="2" class="prev"></li>
				</ol>-->
				<div class="carousel-inner" role="listbox">
					<div class="item ">
						<img src="<?=base_url()?>banner/s1.jpg" alt="" >
						<!--<div class="carousel-caption">
				        	<img src="img/1.jpg" alt="">
				     	</div>-->

					</div>

					<div class="item active">
						<img src="<?=base_url()?>banner/s2.jpg" alt="">
						<!--<div class="carousel-caption">
				       		<img src="img/2.jpg" alt="">
				      	</div>-->
					</div>
					<div class="item">
						<img src="<?=base_url()?>banner/18aniversario.jpg" alt="">
						
					</div>
				</div>
				 <!-- Controls -->
			    <a class="left carousel-control" href="#mySlider" role="button" data-slide="prev">
			    	<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    	<span class="sr-only">Anterior</span>
			    </a>
			    <a class="right carousel-control" href="#mySlider" role="button" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				    <span class="sr-only">Siguiente</span>
			    </a>
				
			</div>
		</div>
	</div>
</div>
<!-- Carrusel de imagenes -->
<div class="container container-mov">
	<div class="row">
		<!--<div class="slider">
			
		</div>-->
		<div class="col-xs-12 col-md-12 padding-container ">
			<h2 style="color:#0066FF !important;">OFERTAS</h1><hr>
			<div class="col-xs-12 div Ofertas ">
				<?php foreach($articles->result() as $ar) { ?>
					<div class="col-md-3 col-xs-6" >
						<div class="col-sm-12 divArticles ">
							<figure>
								<a href="<?=base_url()?>productos/detallesproducto/<?=$ar->id_articulo?>"><img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($ar->sku, 0,1)?>/<?=substr($ar->sku, 1,1)?>/<?=$ar->sku?>.jpg" alt="" data-sku="<?=$ar->sku?>" class="img-responsive thumb"/></a>
							</figure>
							<p class="descripcion">
								<a href="<?=base_url()?>productos/detallesproducto/<?=$ar->id_articulo?>"><?=$ar->descripcion?></a>
							</p>
							<div class="descripcion-costo">
								<!--<p><del>$ <?=$ar->precio?></del> </p>-->
								<?php if($ar->descuento > 0){ ?>
									<p class="spnCosto">$ <?php $utilidad=$ar->utilidad; if($ar->utilidad==0)$utilidad=$ar->ut; echo number_format(ceil((($ar->precio+(($ar->precio*$utilidad)/100))-(($ar->precio*$ar->descuento)/100)*1.16)),2,".",",")?></p>
								<?php } else { ?>
									<p class="spnCosto">$ <?php $utilidad=$ar->utilidad; if($ar->utilidad==0)$utilidad=$ar->ut; echo number_format(ceil(($ar->precio+(($ar->precio*$utilidad)/100))*(1.16)),2,".",",")?></p>
								<?php } ?>	
							</div>
							<!--<div>
								<a href="#"><button class="btn btn-primary btn-sm pull-right  btnCart">Añadir <span class="glyphicon glyphicon-shopping-cart white" style="color:white;" aria-hidden="true"></span></button></a>
							</div>-->
						</div>
					</div>
				<?php } ?>	
			</div>
		</div>
		<div class="col-xs-12 col-md-12 padding-container">
			<h2 style="color:#33CCCC !important;">DESTACADOS</h2><hr>
			<div class="col-xs-12 div Ofertas">
				<?php foreach($destacados->result() as $des) { ?>
					<div class="col-md-3 col-xs-6" >
						<div class="col-sm-12 divArticles">
							<figure>
								<a href="<?=base_url()?>productos/detallesproducto/<?=$des->id_articulo?>"><img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($des->sku, 0,1)?>/<?=substr($des->sku, 1,1)?>/<?=$des->sku?>.jpg" alt="" data-sku="<?=$des->sku?>"  class="img-responsive thumb" /></a>
							</figure>
							<p class="descripcion">
								<a href="<?=base_url()?>productos/detallesproducto/<?=$des->id_articulo?>"><?=$des->descripcion?></a>
							</p>
							<div class="descripcion-costo">
								<!--<p><del>$ <?=$ar->precio?></del> </p>-->
								<?php if($des->descuento > 0){ ?>
									<p class="spnCosto">$ <?php $utilidad=$des->utilidad; if($des->utilidad==0)$utilidad=$des->ut; echo number_format(ceil(($des->precio+($des->precio*$utilidad/100))-(($des->precio*$des->descuento)/100)*1.16),2,",",".")?></p>
								<?php } else { ?>
									<p class="spnCosto">$ <?php $utilidad=$des->utilidad; if($des->utilidad==0)$utilidad=$des->ut; echo number_format(ceil(($des->precio+($des->precio*$utilidad/100))*1.16),2,".",",")?></p>
								<?php } ?>	
							</div>
							<!--<div>
								<a href="#"><button class="btn btn-primary btn-sm pull-right  btnCart">Añadir <span class="glyphicon glyphicon-shopping-cart white" style="color:white;" aria-hidden="true"></span></button></a>
							</div>-->
						</div>
					</div>
				<?php } ?>	
			</div>
		</div>
		<div class="col-xs-12 divBanners">
			<div class="col-xs-12 col-md-6" >
				<figure>
					<img src="<?=base_url()?>banner/s1.jpg" class="img-responsive" alt="">
				</figure>
			</div>
			<div class="col-xs-12 col-md-6">
				<figure>
					<img src="<?=base_url()?>banner/s2.jpg" class="img-responsive"  alt="">
				</figure>
			</div>
		</div>
		<div class="col-xs-12 col-md-12 padding-container">
			<h2 style="color:#000 !important;">RECOMENDADOS</h2><hr>
			<div class="col-xs-12 div Ofertas">
				<?php foreach($recomendados->result() as $rec) { ?>
					<div class="col-md-3 col-xs-6" >
						<div class="col-sm-12 divArticles">
							<figure>
								<a href="<?=base_url()?>productos/detallesproducto/<?=$rec->id_articulo?>"><img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($rec->sku, 0,1)?>/<?=substr($rec->sku, 1,1)?>/<?=$rec->sku?>.jpg" alt="" data-sku="<?=$rec->sku?>"  class="img-responsive thumb"/></a>
							</figure>
							<p class="descripcion">
								<a href="<?=base_url()?>productos/detallesproducto/<?=$rec->id_articulo?>"><?=$rec->descripcion?></a>
							</p>
							<div class="descripcion-costo">
								<!--<p><del>$ <?=$ar->precio?></del> </p>-->
								<?php if($rec->descuento > 0){ ?>
									<p class="spnCosto">$ <?php $utilidad=$rec->utilidad; if($rec->utilidad==0)$utilidad=$rec->ut; echo number_format(ceil(($rec->precio+(($rec->precio*$utilidad)/100))-(($des->precio*$rec->descuento)/100)*1.16),2,".",",")?></p>
								<?php } else { ?>
									<p class="spnCosto">$ <?php $utilidad=$rec->utilidad; if($rec->utilidad==0)$utilidad=$rec->ut; echo number_format(ceil(($rec->precio+(($rec->precio*$utilidad)/100))*1.16),2,".",",")?></p>
								<?php } ?>	
							</div>
							<!--<div>
								<a href="#"><button class="btn btn-primary btn-sm pull-right  btnCart">Añadir <span class="glyphicon glyphicon-shopping-cart white" style="color:white;" aria-hidden="true"></span></button></a>
							</div>-->
						</div>
					</div>
				<?php } ?>	
			</div>
		</div>
	</div>
</div>

