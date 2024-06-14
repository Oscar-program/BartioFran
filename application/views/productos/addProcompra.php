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
  $productoID      = 0;
  $prodDescripcion = '';
  $prodClasfInvent = 0;
  $famProdID       = 0;
  $presProdID      = 0;
  $tipProdID       = 0;
  $marcProdID      = 0;
  $medProdID       = 0;
  $proveedorID     = 0;
  $idtmp           = '';
  
  if(isset($datoproducto)){

  }

  ?>
<div class="modal fade" id="addProducCompra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title text-center" id="exampleModalLabel">    Agrear producto a factura</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  metod="POST"  id ="formAddProducCompra" class="formAddProducCompra" action="javascript:saveTmpCompra()">
        <input type="hidden"  id="idtmp"  name="idtmp"      value =  "<?php echo $idtmp; ?>"> 
        <input type="hidden"  id="idCompratmp"  name="idCompratmp" >
        <input type="hidden"  id="nameproductotmp"  name="nameproductotmp" >
            
       
        <div class="form-group">
            <label for="proveedor" class="col-form-label">Producto:</label>
            <select name="producto" id="producto"  class="form-control chosen"> 
            <option value="0"> Selecccione un producto</option>              
                 <?php foreach ($ListProducto as $row): ?>
                    <option value="<?php echo $row->productoID; ?>">
                    <?php echo $row->productoID . " - " .  $row->prodDescripcion; ?>
                    </option>
                <?php endforeach ?>
            </select>
            
        </div>

        <div class="form-group">
            <label for="familia" class="col-form-label">Cantidad:</label>
            <input type="number" class="form-control text-right" id="cantidad"  name="cantidad" step ="any">            
        </div>

        <div class="form-group">
            <label for="tipProducto" class="col-form-label">Precio costo:</label> 
            <input type="number" class="form-control text-right" id="preCosto" name="preCosto" step ="any">  
        </div>
      <div class="modal-footer">
        <button  type="submit" class="btn btn-danger"> Procesar </button>
      </div>
          

        </form>
      </div>
      
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
            $("#producto").on("change", function(event) {
              
               var combo = document.getElementById("producto");
                var selected = combo.options[combo.selectedIndex].text;
                console.log("cambiando  la dscripcion del producto" +  selected );
                $("#nameproductotmp").val(selected);
             
            }); 
        });

</script>

<script type="text/javascript">
$(document).ready(function() {

    $("#producto").select2({
        theme: 'bootstrap4',
        placeholder: "Select producto",
        allowClear: true,
        width: 'resolve',
    });
	
});
  </script>
