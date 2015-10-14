<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1" />
	<title><?=$title?></title>
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Michroma' rel='stylesheet' type='text/css'>
	<!--<link rel="stylesheet" href="<?=base_url()?>css/normalize.css" />-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<!--<link rel="stylesheet" href="<?=base_url()?>css/bootstrap.min.css" />-->	
	<link rel="stylesheet" href="<?=base_url()?>css/menu.css" />
	<link rel="stylesheet" href="<?=base_url()?>css/style.css" />
	<link rel="stylesheet" href="<?=base_url()?>css/style-sm.css" />
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>css/galeria/lightgallery.css" /> 
	<!-- Facebook Conversion Code for Pagos -Isco Computadoras -->
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', '6035702015202', {'value':'0.00','currency':'MXN'}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6035702015202&amp;cd[value]=0.00&amp;cd[currency]=MXN&amp;noscript=1" /></noscript>
	<script type="text/javascript">
		function Error_Cargar() {
			window.event.srcElement.style.display = "None";
		}
	</script>
	
</head>
<body>
	<header class="header">
		<div class="row">
			
			<div class="col-md-4 col-xs-8 col-md-offset-2 text-right" style="line-height:50px;">
				<span class="glyphicon glyphicon-earphone earphone"></span>
					<a href="tel:+523535327373" class="earphone">
						<span >SHY</span>
					</a>y
					<a href="tel:+523535325500" class="earphone">
						<span >GDL</span>
					</a>

			</div>
			<div class="col-md-1 col-xs-4" style="line-height:50px;">
				<ul class="list-inline row">									
					<li class="col-md-5 col-xs-5">
						<a href="https://www.facebook.com/OficialIscoComputadoras?fref=ts" target="_blank">
							<img src="<?=base_url()?>img/face2.png" title="nuestra página en facebook" alt="facebook" class="img-responsive" style="margin: 0 auto;"/>
						</a>
					</li>
					<li class="col-md-5 col-xs-5">
						<a href="#">
						<img src="<?=base_url()?>img/twi.png" title="siguenos en twitter" alt="twitter" class="img-responsive" style="margin: 0 auto;"/>
						</a>
					</li>	
				</ul>
			</div>
			<div class="col-md-3 col-xs-12" style="margin-top:5px;">
				<form action="<?=base_url()?>busqueda" method="post">
					<div class="form-group">
					    <div class="input-group">
					      <input type="text" class="form-control" id="txtSearch" name="txtSearch" placeholder="Búsqueda en Isco" title="Escribe lo que buscas" required />
					      <span class="input-group-btn">
					      	<button class="btn btn-primary adSearch" id="btnSearch">
					      		<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
					      	</button>
					      </span>
					    </div>
				   </div>
				</form>
			</div>
			<div class="col-md-2 text-center">
				<a id="login"  href="#" style="line-height:50px;" data-toggle="modal" data-target=".bs-example-modal-sm">
					<span >
						<?php if($this->session->userdata('id_usuario')>0) echo $this->session->userdata('correo'); else echo 'Mi Cuenta'; ?>
					</span>
				</a>
				<a class="btn btn-link cerrarSesion" style="display:<?php if(!$this->session->userdata('correo')) echo 'none;';?>" href="<?=base_url()?>envios/cerrarSesion" data-toggle="tooltip" data-placement="right" title="Cerrar Sesion"><span class="glyphicon glyphicon-log-out"></span></a>
			</div>
			
		</div>
		
		<div class="row nav-separador">
		<div class="col-md-offset-1 col-xs-6 col-md-4 col-md-3 ">
			<figure class="col-xs-12 col-sm-10 col-md-9">
				<a href="<?=base_url()?>"><img src="<?=base_url()?>img/isco-rosa.png" alt="Isco Computadoras" class="img-responsive"/></a>
			</figure>		
		</div>
		<div class="col-md-7">
			<nav class="navbar navbar-default" style="margin-bottom: 0px;margin-top: 20px;">
				<div class="">
				<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
					  	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						    <span class="sr-only">Isco Computadoras</span>
						    <span class="icon-bar"></span>
						    <span class="icon-bar"></span>
						    <span class="icon-bar"></span>
					  	</button>				  
					  			  
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					  <ul class="nav navbar-nav navbar-right">
					    <li ><a href="<?=base_url()?>" id="lnkHome">INICIO</a></li>
					    <li class="dropdown">
					      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					      	PRODUCTOS <span class="caret"></span>
					      </a>
					      <ul class="dropdown-menu row" style="width:56em;">
					        <?php $arreglo = array();
									  $arreglo = $secciones->result_array();
									  $cont = 0;
									  for($x =$cont ; $x < count($arreglo) ; $x++)
									  {
									  	if($cont ===0 || (($cont % 10) === 0 && $cont < count($arreglo))){
									  ?>
											
												
													<?php for($y = $cont ; $y < count($arreglo) ; $y++){?>
													<li class="col-xs-11 col-md-3">
													<a href="<?=base_url()?>articulos/secciones/<?=$arreglo[$y]['id_seccion']?>">
														<?=$arreglo[$y]['seccion']?>
													</a>
													</li>
													<?php 

														$cont++; 
														if(($cont % 10) === 0 || $cont > count($arreglo))
															break;		
													}?>
												
											
									<?php } } ?>
					      	</ul>
					    </li>
					    <li class="dropdown">
					      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MARCAS <span class="caret"></span></a>
					      <ul class="dropdown-menu row" style="width:56em;">
					        <?php $arreglo = array();
									  $arreglo = $marcas->result_array();
									  $cont = 0;
									  for($x =$cont ; $x < count($arreglo) ; $x++)
									  {
									  	 if($cont ===0 || (($cont % 20) === 0 && $cont < count($arreglo))){
									  ?>
											
												
													<?php for($y = $cont ; $y < count($arreglo) ; $y++){?>
													<li class="col-xs-11 col-md-3">
													<a href="<?=base_url()?>articulos/marcas/<?=$arreglo[$y]['id_marca']?>">
														<?=$arreglo[$y]['marca']?></a></li>
													<?php 

														$cont++; 
														if(($cont % 20) === 0 || $cont > count($arreglo))
															break;		
													}?>
												
											
									<?php } } ?>
					      	</ul>
					    </li>
					    <li ><a href="#">OFERTAS</a></li>
					    <li>
							<a href="#" id="lnkContacto" data-contacto="<?=base_url()?>contacto">CONTACTO</a>
							
						</li>
						<li>
							<a href="#" id="lnkCart" class="lnkCart">
								<span class="glyphicon glyphicon-shopping-cart icon" aria-hidden="true"></span>
								<span class="badge cantCart" id="cantCart">
									<?php if($this->session->userdata('carrito')){?>
										<?=$this->session->userdata('carrito')?>
									<?php } else { echo 0; }?>
								</span>
							</a>
						</li>
					  </ul>			  
					 
					</div><!-- /.navbar-collapse -->
					</div><!-- /.container-fluid -->
			</nav>
		</div>
		</div>
	</header>
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-ruta="<?=base_url()?>producto/agregarPrecio">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
			  <div class="modal-header" >
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <p class="titulo-login">Mi Cuenta</p>
			  </div>
			  <div class="modal-body">
			    <form name="frmLoginCliente" id="frmLoginCliente" action="<?=base_url()?>envios/loginCliente">
		          <div class="form-group">
		            <label style="">Correo</label>
		            <input type="email" name="usuario" id="usuario"class="form-control" placeholder="usuario@dominio.com">
		          </div>
		          <div class="form-group">
		            <label style="">Contraseña</label>
		            <input type="password" name="password" id="password" class="form-control">
		          </div>
		        </form>
			  </div>
			  <div class="modal-footer text-center">
			    <button type="button" id="btnLoginCliente" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Ingresar</button>
			  </div>
			</div>
		</div>
	</div>	