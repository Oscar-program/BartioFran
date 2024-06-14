<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class ="container-fluid" >
        <div class="card">
            <div class="card-header bg-danger">
                LEVANTAMINETO DE  INVENTARIO
            </div>

             <div class="card-body">
                <form action="">
                    <div class="row">
                        <div class="col-md 7">
                          <label for="producto">Producto</label>
                          <input type="text"   class="form-control"  id ="prodcto" value = "product0">                           
                        </div>
                        <div class="col-md 2">
                            <label for="bodega">Bodega</label>
                            <select name="medida" id="medida"  class="form-control chosen">  
                                    <option value="1"> Bodega 1 </option>
                                    <option value="2"> Bodega 2 </option>
                                    <option value="3"> Bodega 3 </option>
                               
                            </select>      
                        </div>                           
                        <div class="col-md 1">
                            <label for="bodega">Entradas</label>
                           <input type="text"  class="form-control"  id ="entradas" value = "10">
                        </div>
                        <div class="col-md 1">
                            <label for="bodega">salidas</label>
                            <input type="text"   class="form-control"  id ="entradas" value = "3">
                        </div>

                        <div class="col-md 1">
                            <label for="bodega">existencia</label>
                            <input type="text"  class="form-control"  id ="entradas" value = "7" readonly>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md 7">
                          <label for="producto">Producto</label>
                          <input type="text"  class="form-control"  id ="prodcto" value = "product0">                           
                        </div>
                        <div class="col-md 2">
                            <label for="bodega">Bodega</label>
                            <select name="medida" id="medida"  class="form-control chosen">  
                                    <option value="1"> Bodega 1 </option>
                                    <option value="2"> Bodega 2 </option>
                                    <option value="3"> Bodega 3 </option>
                               
                            </select>  
                        </div>                           
                        <div class="col-md 2">
                            <label for="bodega">Entradas</label>
                           <input type="text"  class="form-control"  id ="entradas" value = "10">
                        </div>
                        <div class="col-md 2">
                            <label for="bodega">salidas</label>
                            <input type="text"  class="form-control"  id ="entradas" value = "3">
                        </div>

                        <div class="col-md 3">
                            <label for="bodega">existencia</label>
                            <input type="text" class="form-control"   id ="entradas" value = "7" readonly>
                        </div>

                    </div>
                    <hr>
                    

                </form>
                
            </div>
            <div class="card-footer text-muted text-right">
            <button type="submit" class="btn btn-danger"> enviar</button>
        </div>
        </div>

    </div>
    
</body>
</html>