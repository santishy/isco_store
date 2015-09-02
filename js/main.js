$(function(){
	var ruta = $('#ruta').val();
	$('img').error(function(){
		$(this).unbind("error").attr('src',ruta+"imgsku/"+$(this).data('sku')+".jpg").error(function(){
		$(this).unbind("error").attr('src',ruta+"img/broken.jpg");
	});
	});
	/*$('img').error(function(){
		$(this).unbind("error").attr('src',ruta+"img/broken.jpg");
	});
*/
	$('#btnSearchRange').click(function(e){
		e.preventDefault();
		if(isNaN(parseFloat($('#txtRange2').val())) || isNaN(parseFloat($('#txtRange1').val())))
			alert('Debes introducir números');
		else
			if(parseFloat($('#txtRange2').val()) <= parseFloat($('#txtRange1').val()))
			{
				alert('El valor de "Hasta" no puede ser menor a "Desde"');
				$('#txtRange2').val(parseFloat($('#txtRange1').val())+100);
			}
			else
				$('#frmRangeSearch').submit();
		
	});

	$('#btnSearchQty').click(function(e){
		e.preventDefault();
		if(isNaN(parseFloat($('#txtRang').val())))
			alert('Debes introducir un número');
		else
			$('#frmRange').submit();
	});
	
	$('.btn-menu').click(function(){
		/*if($('.cbp-hrmenu').css('display')=="none" || $('.cbp-hrmenu').css('display')=="NONE" )
			$('.cbp-hrmenu').css('display','block');
		else
			$('.cbp-hrmenu').css('display','none');*/
			
			$('.cbp-hrmenu').animate({height:'toggle'});
	})
	$('#lnkRango').click(function(e){
		e.preventDefault();
		clearFields(1);
		$('#divRange').slideUp();
		$('#divFrom').slideDown();
		
	});
	$('#lnkComeBack').click(function(e){
		e.preventDefault();
		clearFields(2);
		$('#divRange').slideDown();
		$('#divFrom').slideUp();
	});

	function clearFields(ban){
		if(ban == 1){
			$('#txtRange1').val('');
			$('#txtRange2').val('');
		}else
			$('#txtRang').val('');
			
	}
});