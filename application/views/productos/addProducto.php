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
  $productoID      = NULL;
  $prodDescripcion = '';
  $prodClasfInvent = 0;
  $famProdID       = 1;
  $presProdID      = 1;
  $tipProdID       = 1;
  $marcProdID      = 1;
  $medProdID       = 1;
  $proveedorID     = 1;
  $presentacion_invId = 1;
  $tipomovinvtId      = 1;

  if(isset($datoproducto)){ 
    if(!empty($datoproducto)){
      echo 'setiendo datos del  producto';
      $productoID         = $datoproducto->productoID;
      $prodDescripcion    = $datoproducto->prodDescripcion;
      $prodClasfInvent    = $datoproducto->prodClasfInvent;
      $famProdID          = $datoproducto->famProdID;
      $presProdID         = $datoproducto->presProdID;
      $tipProdID          = $datoproducto->tipProdID;
      $marcProdID         = $datoproducto->marcProdID;
      $medProdID          = $datoproducto->medProdID;
      $proveedorID        = $datoproducto->proveedorID;
      $presentacion_invId = $datoproducto->presentacion_invId;
      $tipomovinvtId      = $datoproducto->tipomovinvtId;
    }

  }
  
  

  ?>
<div class="modal fade" id="addProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title text-center" id="exampleModalLabel">    Registrar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  metod="POST"  id ="formAddProducto" class="formAddProducto" action="javascript:saveProducto()">
        <input type="hidden"  id="productoID"      name="productoID"      value =  "<?php echo $productoID; ?>">
        <input type="hidden"  id="prodDescripcion" name="prodDescripcion" value =  "<?php echo $prodDescripcion; ?>">
        <input type="hidden"  id="prodClasfInvent" name="prodClasfInvent" value =  " <?php echo $prodClasfInvent;?>">
        <input type="hidden"  id="famProdID"       name="famProdID"       value =  "<?php echo $famProdID; ?>">
        <input type="hidden"  id="presProdID"      name="presProdID"      value =  "<?php echo $presProdID; ?>">
        <input type="hidden"  id="tipProdID"       name="tipProdID"       value =  "<?php echo $tipProdID; ?>">
        <input type="hidden"  id="medProdID"       name="medProdID"       value =  "<?php echo $medProdID;  ?>">
        <input type="hidden"  id="proveedorID"     name="proveedorID"     value =  "<?php echo $proveedorID; ?>">
        <input type="hidden"  id="presentacion_invId" name="presentacion_invId" value =  "<?php echo $presentacion_invId;  ?>">
        <input type="hidden"  id="tipomovinvtId"      name="tipomovinvtId"      value =  "<?php echo $tipomovinvtId; ?>">

        <div class="form-group">
            <label for="proveedor" class="col-form-label">Proveedor:</label>
            <select name="proveedor" id="proveedor"  class="form-control chosen">                
                 <?php foreach ($proveedorProducto as $row): ?>
                    <option value="<?php echo $row->proveedorID; ?>">
                    <?php echo $row->proveedorID . " - " .  $row->provDescripcion; ?>
                    </option>
                <?php endforeach ?>
            </select>
            
        </div>

        <div class="form-group">
            <label for="familia" class="col-form-label">Familia:</label>
            <select name="familia" id="familia"  class="form-control chosen">                
                 <?php foreach ($familiaProducto as $row): ?>
                    <option value="<?php echo $row->famProdID; ?>">
                    <?php echo $row->famProdID . " - " .  $row->famProdDescripcion; ?>
                    </option>
                <?php endforeach ?>
            </select>
            
        </div>

          <div class="form-group">
            <label for="tipProducto" class="col-form-label">tipo producto:</label>
            <select name="tipProducto" id="tipProducto"  class="form-control chosen">                
                 <?php foreach ($tipoProducto as $row): ?>
                    <option value="<?php echo $row->tipProdID; ?>">
                    <?php echo $row->tipProdID . " - " .  $row->tipProdNombre; ?>
                    </option>
                <?php endforeach ?>
            </select>
            
          </div>

          <div class="form-group">
            <label for="marca" class="col-form-label">Marca:</label>
            <select name="marca" id="marca"  class="form-control chosen">                
                 <?php foreach ($MarcaProducto as $row): ?>
                    <option value="<?php echo $row->marcProdID; ?>">
                    <?php echo $row->marcProdID . " - " .  $row->marcProdDescripcion; ?>
                    </option>
                <?php endforeach ?>
            </select>
            
          </div>
          <div class="form-group">
            <label for="presentacion" class="col-form-label">Presentacion:</label>
            <select name="presentacion" id="presentacion"  class="form-control chosen">                
                 <?php foreach ($prsentacionProducto as $row): ?>
                    <option value="<?php echo $row->presProdID; ?>">
                    <?php echo $row->presProdID . " - " .  $row->presProdDescripcion; ?>
                    </option>
                <?php endforeach ?>
            </select>            
          </div>
          <div class="form-group">
            <label for="medida" class="col-form-label">Medida:</label>
            <select name="medida" id="medida"  class="form-control chosen">                
                 <?php foreach ($medidaProducto as $row): ?>
                    <option value="<?php echo $row->medProdID; ?>">
                    <?php echo $row->medProdID . " - " .  $row->medProdDescripcion; ?>
                    </option>
                <?php endforeach ?>
            </select>            
          </div>

          <div class="form-group">
            <label for="tipomovinvent" class="col-form-label">Tipo Mov Invt:</label>
            <select name="tipomovinvent" id="tipomovinvent"  class="form-control chosen">                
                 <?php foreach ($TipoMovInvnt as $row): ?>
                    <option value="<?php echo $row->tipomovinvtId; ?>">
                    <?php echo $row->tipomovinvtId . " - " .  $row->tipomovimientoinvt; ?>
                    </option>
                <?php endforeach ?>
            </select>            
          </div>
          <div class="form-group">
            <label for="presentacioninvent" class="col-form-label">Producto/servicio:</label>
            <select name="presentacioninvent" id="presentacioninvent"  class="form-control chosen">                
                 <?php foreach ($Presentacion_inv as $row): ?>
                    <option value="<?php echo $row->presentacion_invId; ?>">
                    <?php echo $row->presentacion_invId . " - " .  $row->presentacion_inv; ?>
                    </option>
                <?php endforeach ?>
            </select>            
          </div>



          <div class="form-group">
            <label for="message-text" class="col-form-label">Descripcion </label>
            <input type="text" class="form-control text-left" id="descripcion" name="descripcion" value ="<?php echo $prodDescripcion ?>  ">
          </div>
      <div class="modal-footer">
        <button  type="submit" class="btn btn-danger"> Enviar </button>
      </div>
          

        </form>
      </div>
      
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {

    $("#marca").select2({
        theme: 'bootstrap4',
        placeholder: "Select marca",
        allowClear: true,
        width: 'resolve',
    });
	
});
  </script>
