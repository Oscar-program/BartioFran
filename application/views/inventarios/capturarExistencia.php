<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="m-0 row justify-content-center">
    <div class ="container-fluid" >
        <div class="card">
            <div class="card-header bg-danger">
                CAPTURAR EXISTENCIA
            </div>
            
             <div class="card-body">
                <form action="">
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
                          <label for="existenciaprod">Existencia</label>
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
    
</body>
</html>
><script>
    $("#document").ready(  function(){
        $("#producto").select2({
        theme: 'bootstrap4',
        placeholder: "Select producto",
        allowClear: true,
        width: 'resolve',
    });
    });
</script>