<div class="container">
	<div class="row" style="margin-top:10px;">
		<div class="col-sm-8">
			<div class="panel panel-default">
				<div class="panel-body">
					<p style="width:80%;display:inline-block">Datos de Envio</p><p id="datosEnvioAnterior" style="width:20px;height:20px;border-radius:20px;color:white;background-color:red;display:inline-block" data-ruta="<?=base_url()?>envios/obtenerUltimoEnvio"><span class="glyphicon glyphicon-send" ></span></p>
					<hr>
					<form class="form-horizontal" name="frm_envio" id="frm_envio" method="post" action="<?=base_url()?>envios/registroEnvio" >
						<div class="form-group">
							<label class="col-md-2 control-label">Nombre</label>
							<div class="col-md-10">
								<input type="text" name="nombre" class="form-control" value="<?=set_value('nombre')?>">
								<input type="hidden" name="id_usuario" value="<?=$id_usuario?>">
								<input type="hidden" name="correo" id="correo" value="<?=$correo?>">
								<input type="hidden" name="id_cliente" id="id_cliente">
							</div>	
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Paterno</label>
							<div class="col-md-4">
								<input type="text" name="apellido_paterno" class="form-control" value="<?=set_value('apellido_paterno')?>">
							</div>	
							<label class="col-md-2 control-label">Materno</label>
							<div class="col-md-4">
								<input type="text" name="apellido_materno" class="form-control" value="<?=set_value('apellido_materno')?>">
							</div>	
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Calle</label>
							<div class="col-md-10">
								<input name="calle" class="form-control" value="<?=set_value('calle')?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Int.</label>
							<div class="col-md-4">
								<input type="text" name="n_interior" class="form-control" value="<?=set_value('n_interior')?>">
							</div>	
							<label class="col-md-2 control-label">Ext.</label>
							<div class="col-md-4">
								<input type="text" name="n_exterior" class="form-control" value="<?=set_value('n_exterior')?>">
							</div>	
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Referencia</label>
							<div class="col-md-10">
								<input name="referencia" class="form-control" value="<?=set_value('referencia')?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Ciudad</label>
							<div class="col-md-4">
								<input type="text" name="ciudad" class="form-control" value="<?=set_value('ciudad')?>">
							</div>	
							<label class="col-md-2 control-label">Estado</label>
							<div class="col-md-4">
								<input type="text" name="estado" class="form-control" value="<?=set_value('estado')?>">
							</div>	
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Colonia</label>
							<div class="col-md-4">
								<input type="text" name="colonia" class="form-control" value="<?=set_value('colonia')?>">
							</div>	
							<label class="col-md-2 control-label">Telefono</label>
							<div class="col-md-4">
								<input type="text" name="telefono" class="form-control" value="<?=set_value('telefono')?>">
							</div>	
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">C.Postal</label>
							<div class="col-md-2">
								<input type="text" name="codigo_postal" class="form-control" value="<?=set_value('codigo_postal')?>">
							</div>	
							<label class="col-md-3 control-label">Razon social</label>
							<div class="col-md-5">
								<input type="text" name="razon_social" class="form-control" value="<?=set_value('razon_social')?>">
							</div>	
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">RFC</label>
							<div class="col-md-5">
								<input type="text" name="rfc" class="form-control" value="<?=set_value('rfc')?>">
							</div>	
							
							<div class="col-md-5">
								<button class="btn btn-primary">Guardar</button>
								<button type="button" id="btnLimpiar" class="btn btn-info">Limpiar</button>
							</div>	
						</div>
						<div class="form-group">
							<?=validation_errors()?>
						</div>
					</form>
				</div><!--panel-body-->
			</div><!--panel-default-->
		</div>
		<div class="col-md-4">
			<?php foreach($envios->result() as $row){?>
				<div class="panel panel-default">
				  	<div class="panel-body">
				  		<span class="last-envio" data-idenvio="<?=$row->id_cliente?>" data-ruta="<?=base_url()?>envios/obtenerUltimoEnvio">Escoger este envío</span>
				  		<hr class='hr-envio'>
				  	  	<div class="envios">
				  	  		<p><?php echo $row->nombre.' '.$row->apellido_paterno.' '.$row->apellido_materno?></p>
				  	  		<p><?=$row->calle?></p>
				  	  		<p><?=$row->ciudad?> (más)...</p>
				  	  	</div>
				 	</div>
				</div>
			<?php }?>
		</div>
	</div><!--row-->
</div><!--container-->
<script>
	$(document).on('ready',function()
	{
		var datos=$(".last-envio");
		
		$('#btnLimpiar').on('click',limpiar);
		datos.on('click',function(){
			var idenvio=$(this).data('idenvio');
			var ruta=$(".last-envio").data('ruta');
			$.ajax({
				url:ruta,
				beforeSend:function()	
				{
					//$('#frm_envio').find('input').attr('disabled','disabled');
				},
				dataType:'json',
				type:'post',
				data:{id_cliente:idenvio},
				success:function(resp)
				{
					if(!jQuery.isEmptyObject(resp))
					{
					//	$('#frm_envio').find('input').attr('disabled','enabled');
						jQuery.each(resp[0],function(i,valor)
						{
							$("#frm_envio input[name="+i+"]").val(valor);
							//$("#frm_envio input[name="+i+"]").attr('disabled','disabled');
						});
						$('#btnLimpiar').show();
					}
					
				},
				error:function(xhr,error,estado)
				{
					alert(xhr+" "+error+" "+estado);
				},
				complete:function()
				{
						
				}
			});//fin ajax
		});//fin envento
});
function limpiar()
{
	var id_usuario=$('#id_usuario').val();
	var correo=$('#correo').val();
	$("#frm_envio").find(':text').each(function(){
		$($(this)).val('');
	});
	$("#id_cliente").val('');
}
</script>