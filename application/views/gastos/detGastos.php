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
                    <div class="row">
                        <div class="col-sm" style="display: inline-block;">
                          <label for="producto"> Cantidad</label>
                          <input type="number"   class="form-control"  id ="cantidadgasto" name = "cantidadgasto" style="border-radius: 20px;">                           
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm" style="display: inline-block;">
                        <label for="precio"> precio</label>
                        <input type="number"   class="form-control"  id ="preciogasto" name = "preciogasto" style="border-radius: 20px;">    
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm" style="display: inline-block;">
                        <label for="descripcion"> Descripcion</label>
                         <textarea name="descripcion" id="descripcion"  class="form-control" rows="3" ></textarea>    
                        </div>
                    </div>


                    


                    <br>
                    <br>                    

                </form>
                
            </div>
            <div class="card-footer text-muted text-right">
            <button type="submit" class="btn btn-lg btn-outline-danger" title="Cancelar"> <i class="fa fa-chevron-left" aria-hidden="true"></i> </button>
            <button type="submit" class="btn btn-lg btn-outline-danger" title="Iniciar toma"  onclick="javaScript:addDetgasto();"> <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
                
            </div>
           
        </div>
    </div>
    </div>
    
</body>
</html>