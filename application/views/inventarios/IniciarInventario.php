 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="justify-content-center">
    <div class ="container-fluid" >
        <div class="card">
            <div class="card-header bg-danger">
                INICIAR INVENTARIO
            </div>
            <div class="card-footer text-muted text-right">
                <button type="submit" class="btn btn-lg btn-outline-danger" title="Cancelar"> <i class="fa fa-chevron-left" aria-hidden="true"></i> </button>
                <button type="submit" class="btn btn-lg btn-outline-danger" title="Iniciar toma"  onclick="javaScript:capturarExistencia();"> <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
            </div>
             <div class="card-body">
                <form action="">
                    <div class="row">
                        <div class="col-sm" style="display: inline-block;">
                          <label for="producto">Fecha</label>
                          <input type="date"   class="form-control"  id ="fechaInventario" value = "fechaInventario">                           
                        </div>
                                        
                        

                    </div>
                    <hr>
                    <div class="row">
                    <div class="col-sm" style="display: inline-block;">
                            <label for="bodega">Bodega</label>

                            <select name="medida" id="medida"  class="form-control chosen">  
                                    <option value="1"> Bodega 1 </option>
                                    <option value="2"> Bodega 2 </option>
                                    <option value="3"> Bodega 3 </option>
                               
                            </select>      
                        </div>           

                    </div>
                    <hr>
                    

                </form>
                
            </div>
           
        </div>

    </div>
    
</body>
</html>