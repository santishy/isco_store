<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1" />
	<title><?=$title?></title>
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Michroma' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?=base_url()?>css/normalize.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<!--<link rel="stylesheet" href="<?=base_url()?>css/bootstrap.min.css" />-->
	<link rel="stylesheet" href="<?=base_url()?>css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="<?=base_url()?>css/menu.css" />
	<link rel="stylesheet" href="<?=base_url()?>css/style.css" />
	<link rel="stylesheet" href="<?=base_url()?>css/style-sm.css" />
	<script type="text/javascript">
		function Error_Cargar() {
			window.event.srcElement.style.display = "None";
		}
	</script>
	
</head>
<body>
	<header class="header">
		<div class="divSearch">
			<div class="row">
				<div class="col-sm-4">
					<figure class="logo">
						<a href="<?=base_url()?>"><img src="<?=base_url()?>img/logotipo.png" alt=""></a>
					</figure>
				</div>
				<div class="col-sm-4" style="line-height:50px;">
					<span class="spnTel">Llamanos </span><span >01 353 532 7373 y 01 353 532 5500</span>
				</div>
				<div class="col-sm-3 col-sm-offset-1" style="margin-top:5px;">
					<form action="<?=base_url()?>busqueda" method="post">
						<div class="form-group">
						    <div class="input-group">
						      <input type="text" class="form-control" id="txtSearch" name="txtSearch" placeholder="Búsqueda en Isco" title="Escribe lo que buscas" required />
						      <div class="input-group-addon adSearch">
						      	<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
						      </div>
						    </div>
					   </div>
					</form>
				</div>
			</div>
		</div>
		<div class="btn-menu">
			<a href="#"><span id="btn-menu" class="glyphicon glyphicon-th"></span> Menu</a>
		</div>
		<nav id="cbp-hrmenu" class="cbp-hrmenu" style="z-index:1000000">
			<ul>
				<li>
					<a href="<?=base_url()?>" id="lnkHome">INICIO</a>
					
				</li>
				<li>
					<a href="#">PRODUCTOS</a>
					<div class="cbp-hrsub" style="z-index:1000000">
						<div class="cbp-hrsub-inner">
							<!--<div class="cbp-hrsub-child">-->
							<?php $arreglo = array();
							  $arreglo = $secciones->result_array();
							  $cont = 0;
							  for($x =$cont ; $x < count($arreglo) ; $x++)
							  {
							  	if($cont ===0 || (($cont % 10) === 0 && $cont < count($arreglo))){
							  ?>
									<div>
										<ul>
											<?php for($y = $cont ; $y < count($arreglo) ; $y++){?>
											<li><a href="<?=base_url()?>articulos/secciones/<?=$arreglo[$y]['id_seccion']?>"><?=$arreglo[$y]['seccion']?></a></li>
											<?php 

												$cont++; 
												if(($cont % 10) === 0 || $cont > count($arreglo))
													break;		
											}?>
										</ul>
									</div>
							<?php } } ?>
						</div><!-- /cbp-hrsub-inner -->
					</div><!-- /cbp-hrsub -->
				</li>
				<li>
					<a href="#">MARCAS</a>
					<div class="cbp-hrsub" style="z-index:1000000">
						<div class="cbp-hrsub-inner"> 
							<?php $arreglo = array();
							  $arreglo = $marcas->result_array();
							  $cont = 0;
							  for($x =$cont ; $x < count($arreglo) ; $x++)
							  {
							  	 if($cont ===0 || (($cont % 20) === 0 && $cont < count($arreglo))){
							  ?>
									<div>
										<ul>
											<?php for($y = $cont ; $y < count($arreglo) ; $y++){?>
											<li><a href="<?=base_url()?>articulos/marcas/<?=$arreglo[$y]['id_marca']?>">
												<?=$arreglo[$y]['marca']?></a></li>
											<?php 

												$cont++; 
												if(($cont % 20) === 0 || $cont > count($arreglo))
													break;		
											}?>
										</ul>
									</div>
							<?php } }  ?>
						</div><!-- /cbp-hrsub-inner -->
					</div><!-- /cbp-hrsub -->
				</li>
				<li>
					<a href="#">OFERTAS</a>
				</li>
				<li>
					<a href="#" id="lnkContacto" data-contacto="<?=base_url()?>contacto">CONTACTO</a>
					
				</li>
				<li>
					<a href="#" id="lnkCart" class="lnkCart">
						<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
						<span class="badge cantCart" id="cantCart">
							<?php if($this->session->userdata('carrito')){?>
								<?=$this->session->userdata('carrito')?>
							<?php } else { echo 0; }?>
						</span>
					</a>
				</li>
			</ul>
		</nav>
	</header>	