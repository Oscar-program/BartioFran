<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<!--  container-fluid-->
<body>
    <div class="padre">
    <div class ="allDevice">
        <div class="card">
            <div class="card-header bg-danger">
               TRASLADO DE PRODUCTOS
            </div>
            
             <div class="card-body">
                <form action="">
                <div class="row">
                        <div class="col-sm" style="display: inline-block;">
                                <label for="bodOrigen">Bodega origen</label>
                            

                                <select name="bodOrigen" id="bodOrigen"  class="form-control chosen">                                  
                                <?php foreach ($listBodegaProducto as $row): ?>
                                    <option value="<?php echo $row->bodegaProductoID; ?>">
                                    <?php echo $row->bodegaProductoID . " - " .  $row->bodProdDescripcion; ?>
                                    </option>
                                <?php endforeach ?>
                                            
                                </select>      
                        </div>           

                    </div>

                <div class="row">
                        <div class="col-sm" style="display: inline-block;">
                                <label for="producto">Producto</label>
                            

                                <select name="producto" id="producto"  class="form-control chosen">                                  
                                <?php foreach ($listaProductos as $row): ?>
                                    <option value="<?php echo $row->productoID; ?>">
                                    <?php echo $row->productoID . " - " .  $row->prodDescripcion; ?>
                                    </option>
                                <?php endforeach ?>
                                            
                                </select>      
                        </div>           

                </div>
                <div class="row">
                    <div class="col-sm" style="display: inline-block;">
                            <label for="producto">Existencia en unidades</label>                      

                            <input type="text"  class="form-control" id="existenciaReal" name="existenciaReal" readonly>   
                    </div>        

                </div>

                <div class="row">
                        <div class="col-sm" style="display: inline-block;">
                                <label for="producto">Unidad medida a trasladar</label>
                            

                                <select name="producto" id="producto"  class="form-control chosen">                                  
                                <?php foreach ($listaProductos as $row): ?>
                                    <option value="<?php echo $row->productoID; ?>">
                                    <?php echo $row->productoID . " - " .  $row->prodDescripcion; ?>
                                    </option>
                                <?php endforeach ?>
                                            
                                </select>      
                        </div>           

                </div>
                <div class="row">
                    <div class="col-sm" style="display: inline-block;">
                            <label for="producto">Unidades que componen la presentacio</label>                      

                            <input type="text"  class="form-control" id="unidadpresenta" name="unidadpresenta" readonly>   
                    </div>        

                </div>

                    

                    <div class="row">
                        <div class="col-sm" style="display: inline-block;">
                                <label for="producto">Bodega destino</label>
                            

                                <select name="bodDestino" id="bodDestino"  class="form-control chosen">                                  
                                <?php foreach ($listBodegaProducto as $row): ?>
                                    <option value="<?php echo $row->bodegaProductoID; ?>">
                                    <?php echo $row->bodegaProductoID . " - " .  $row->bodProdDescripcion; ?>
                                    </option>
                                <?php endforeach ?>
                                            
                                </select>      
                        </div>           

                    </div>
                    <div class="row">
                        <div class="col-sm" style="display: inline-block;">
                          <label for="existenciaprod">Cantidad a traladar</label>
                          <input type="number"   class="form-control "  id ="existenciaprod" name = "existenciaprod" step="any">                           
                        </div>
                                        
                        

                    </div>
                    
                    
                    
                    

                </form>
                
            </div>
            <div class="card-footer text-muted text-right">
                <button type="submit" class="btn btn-lg btn-outline-danger" title="Procesar"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                
            </div>
           
        </div>

    </div>
    </div>
    
</body>
</html>
<script>
    $("#document").ready(  function(){
        $("#producto").select2({
        theme: 'bootstrap4',
        placeholder: "Select producto",
        allowClear: true,
        width: 'resolve',
    });
    });
</script>