<!-- Modal Carrito -->
<div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Carrito de compras</h4>
        <a href="<?=base_url()?>cart/destroyCart" class="btn btn-danger btn-xs" id="btnDelCar">
            Eliminar carrito
        </a>
      </div>
      <div class="modal-body container-cart" id="container-cart">
        <div><p id="pMsjVacio" style="text-align:center;font-size:18px;"></p></div>
        <div class="table-responsive">
          	<table class="table table-hover table-cart">
          		<thead>
          			<tr>
          				<th>Imagen</th>
                  <th>Código</th>
          				<th>Producto</th>
          				<th>Precio</th>
          				<th>Cantidad</th>
                  <th>Subtotal</th>
          			</tr>
          		</thead>
          		<tbody id="tblCart">
          		<?php foreach($this->cart->contents() as $items){ ?>
          			<tr>
          				<td class="cartImage">
          					<figure>
          						<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($items['sku'], 0,1)?>/<?=substr($items['sku'], 1,1)?>/<?=$items['sku']?>.jpg" alt="" OnError="Error_Cargar()" />
          					</figure>
          				</td>
                        <td class="code"><?=$items['id']?></td>
                		<td><?=$items['name']?></td>
                		<td><?=$items['price']?></td>
                		<td class="qty">
                            <form action="<?=base_url()?>cart/update" method="post" id="frmScart" name="frmScart">
                              <input type="hidden" name="id" value="<?=$items['id']?>" />
                              <input type="hidden" name="exis" value="<?=$items['existencia']?>" />
                              <input type="number" class="form-control txtCant" name="cant" value="<?=$items['qty']?>" min="0" max="<?=$items['existencia']?>" /> 
                            </form>
                            <button class="btn btn-xs btn-success btnUpdate" title="modificar cantidad" disabled>
                              <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                            </button>
                        </td>
                        <td class="tdSub"><?=$items['subtotal']?></td>
          			</tr>
          		<?php } ?>
                </tbody>
              
                <tbody>
                    <tr>
                        <td colspan="5" class="center tdTotal">
                           TOTAL MN
                        </td>
                        <td class="tdTotalCant" id="tdTotalCant">
                           <strong><?php echo $this->cart->format_number($this->cart->total()); ?> </strong>
                        </td>
                    </tr>
                </tbody>   
                         
          	</table>
        </div>
      </div>
      <div class="modal-footer">
      	<span class="loader"></span>
        <?php
          $arr=$this->cart->contents();
            if(count($arr) > 0){
         ?>
            <button type="button" class="btnConfirmPass btn btn-primary" id="btnConfirmPass" data-ruta="<?=base_url()?>envios/registrarUsuario">Siguiente Paso</button>
        <?php } else { ?>
            <button type="button" class="btnConfirmPass btn btn-primary" id="btnConfirmPass" data-ruta="<?=base_url()?>envios/registrarUsuario" disabled>Siguiente Paso</button>
       <?php } ?>
        <button type="button" class="btn btn-default btnClose" id="btnClose" data-dismiss="modal">Seguir comprando</button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal -->