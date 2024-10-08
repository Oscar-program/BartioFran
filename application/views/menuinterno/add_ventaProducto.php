<style>
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
</style>
<?php  
$detPedID           = null;
$ordenPedidoID      = null;
$productoID         = null;
$bodSaldID          = null;
$detcantidad        = 0;
$detprecioNormal    = 0;
$detprecioEspecial  = 0;
$dettotal           = 0;
 if(isset($DetOrdenpedido)){
  $detPedID           = $DetOrdenpedido->detPedID;
  $ordenPedidoID      = $DetOrdenpedido->ordenPedidoID;
  $productoID         = $DetOrdenpedido->productoID;
  $bodSaldID          = $DetOrdenpedido->bodSaldID;
  $detcantidad        = $DetOrdenpedido->detcantidad;
  $detprecioNormal    = $DetOrdenpedido->detprecioNormal;
  $detprecioEspecial  = $DetOrdenpedido->detprecioEspecial;
  $dettotal           = $DetOrdenpedido->dettotal;
 }
?>

<div class="modal fade" id="addVentaProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title text-center" id="exampleModalLabel">    Registrar Venta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
        <input type="hidden" class="form-control text-right" id="productoID" name="productoID"   value ="<?php echo  $productoID   ;?>" readonly>
        <input type="hidden" class="form-control text-right" id="detPedID" name="detPedID" value ="<?php echo  $detPedID  ;?>" readonly>
        <input type="hidden" class="form-control text-right" id="ordenPedidoID" name="ordenPedidoID" value ="<?php echo $ordenPedidoID  ;?>" readonly>
        <input type="hidden" class="form-control text-right" id="bodSaldID" name="bodSaldID" value ="<?php echo $bodSaldID  ;?>" readonly>
       


        <div class="form-group text-center">
           <p id="prodDescripcion" style = "color:red; font-weight:bold; font-size:20px;"> </p>
        </div>

        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Precio regular $:</label>
            <input type="text" class="form-control text-right" id="precioregular" name="precioregular"   value ="<?php echo  $detprecioNormal  ;?>"  readonly>
        </div>

          <!-- <div class="form-group">
            <label for="comanda" class="col-form-label">Comanda:</label>
            <select name="comanda" id="comanda"  class="form-control chosen">                
                 <?php //foreach ($comandas as $row): ?>
                    <option value="<?php //echo $row->commandaPedProdID; ?>">
                    <?php //echo $row->commandaPedProdID . " - " .  $row->comPedProdDesc; ?>
                    </option>
                <?php //endforeach ?>
            </select>
            
          </div>-->
          <div class="form-group">
            <label for="bodsalida" class="col-form-label">Bodega de Salida:</label>
            <select name="bodsalida" id="bodsalida"  class="form-control chosen" onchange="chekStockProduct();">                
                 <?php foreach ($bodegas as $row): ?>
                    <option value="<?php echo $row->bodegaProductoID; ?>">
                    <?php echo $row->bodegaProductoID . " - " .  $row->bodProdDescripcion; ?>
                    </option>
                <?php endforeach ?>
            </select>
            
          </div>
          <div class="form-group">
            <label for="precioespecial" class="col-form-label">Precio Especial:</label>
            <select name="precioespecial" id="precioespecial"  class="form-control chosen" onchange="get_PreciosEspParaventa();"> 
            <option value="0">Seleccione Precio especial   </option>              
                 <?php foreach ($precioespporfamilia as $row): ?>
                    <option value="<?php echo $row->precioEspecialProdID; ?>">
                    <?php echo $row->precioEspecialProdID . " - " .  $row->descPrecioEspecial; ?>
                    </option>
                <?php endforeach ?>
            </select>
            
          </div>


          <div class="form-group">
            <label for="message-text" class="col-form-label">Incremento $:</label>
            <input type="number" class="form-control text-right" id="precincremento" name="precincremento"  value ="<?php echo  $detprecioEspecial   ;?>"  step="any">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Cantidad $:</label>
            <input type="number" class="form-control text-right" id="cantiadVenta"  name="cantiadVenta"  value ="<?php echo  $detcantidad   ;?>" step="any" onkeypress="calculartotalVenta(event);" >
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Total $:</label>
            <input type="number" class="form-control text-right" id="totalVenta" name="totalVenta"   value ="<?php echo  $dettotal   ;?>" step="any" readonly>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-title ="Procesar venta" onclick="saveVentaProducto()" ><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        <!-- <button type="button" class="btn btn-primary"> <i class="fa fa-cog" aria-hidden="true"></i> Procesar</button> -->
      </div>
    </div>
  </div>
</div>

