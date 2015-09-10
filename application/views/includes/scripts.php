<input type="hidden" id="ruta" value="<?=base_url()?>" />   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>js/menu.js"></script>

<script src="<?=base_url()?>js/cart.js"></script>
    <script>
        /*$(document).on('ready',function(){
              var dispositivo = navigator.userAgent.toLowerCase();

      if( dispositivo.search(/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/) > -1 ){
        $('.descripcion').each(function(index)
                {
                    $(this).text($(this).text().substring(0,27)+'...');

                });
 }
            $(window).resize(function(){
                if($(document).width()<800)
                $('.descripcion').each(function(index)
                {
                    $(this).text($(this).text().substring(0,27)+'...');

                });
            })*/
            
            /*if($.browser.device = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()))){
                $('.descripcion').each(function(index)
                {
                    $(this).text($(this).text().substring(0,27)+'...');
                });
            }*/
        /*});*/
    </script>
<script src="<?=base_url()?>js/<?=$file?>"></script>
<script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
      $('#lnkCart').on('click',function(e){
                e.stopPropagation();
                $('#modalCart').modal('show');
            });
    })
</script>
