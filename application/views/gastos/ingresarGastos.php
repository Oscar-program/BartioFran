<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class ="padre">
    <div class ="allDevice">
        <div class="card">
            <div class="card-header bg-danger">
              INGRESAR GASTOS 
            </div>
            <div>
                
            </div>
            <div  class="card-body">
                <form action="">
                    <input type="hidden"   id="gastosID" name="gastosID">
                    <div class="row">
                        <div class="col-sm" style="display: inline-block;">
                          <label for="producto"> Fecha deingreso de gastos</label>
                          <input type="date"   class="form-control"  id ="fechaGasto" value = "fechaGasto" style="border-radius: 20px;">                           
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                    <div class="col-sm" style="display: inline-block;">
                            <label for="bodega">Bodega de ingreso </label>

                            <select name="medida" id="medida"  class="form-control chosen" style="border-radius: 20px;">  
                                    <option value="1"> Bodega 1 </option>
                                    <option value="2"> Bodega 2 </option>
                                    <option value="3"> Bodega 3 </option>
                               
                            </select>      
                        </div>           

                    </div>
                    <br>
                    <br>                    

                </form>
                
            </div>
            <div class="card-footer text-muted text-right">
            <button type="submit" class="btn btn-lg btn-outline-danger" title="Cancelar"> <i class="fa fa-chevron-left" aria-hidden="true"></i> </button>
            <button type="submit" class="btn btn-lg btn-outline-danger" title="Ingresear detalle de gastos"  onclick="javaScript:detalleGastos();"> <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
                
            </div>
           
        </div>
    </div>
    </div>
    
</body>
</html>