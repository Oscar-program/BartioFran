<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  
    <script>
      window.addEventListener("beforeunload", (event) => {
        console.log("a punto de avandonar la pagina.");
      });
     /* window.addEventListener("unload", (event) => {
        console.log("I am the 3rd one.");
      });*/
    </script>
    <script>

  //   $('#listDetGastos').stacktable();
</script>



<style>       
          
        #cantidadgasto::placeholder {
            text-align: start;
        }
        
        #preciogasto::placeholder{
           text-align: start;
        }

        /*#password::placeholder{
          color: white;
        }

        #Rpassword::placeholder{
          color: white;
        }*/
       
    </style>
    <script>

// $('#DeGastos').stacktable();
    </script>
   
</head>

<body>


<div class="row">
    <div class="col-12">
        <div class="card mt-3 tab-card">
            <div class="card-header tab-card-header ">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true" onclick="verificatabgasto(this.id)">Ingresar compras!!</a> </li>
                    <li class="nav-item"> <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false" onclick="verificatabgasto(this.id)">Compras procesadas</a> </li>
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">                   
                    <div class="container-fluid m-top">
                        <div class="row">
                            <!-- DIV PARA INGRESO DE  GASTOS -->
                            <div class="col-lg-6" >
                                <div>
                               <!-- <button id ="btnSalir" name="btnSalir" class="btn btn-lg btn-danger" title="Abandonar toma de gastos">Abandonar  <i class="fa fa-sign-out" aria-hidden="true"></i></button> -->
                                </div>
                                <dIv class="row mt-2">  
                                        <div class="col-lg-12">
                                            <Form id = "FormCompras" class = "FormCompras"  method="post">
                                            <input type="hidden"   id="compraProdID" name="compraProdID">
                                            
                                                <div class="mb-3">
                                                <input type="date"   class="form-control"  id ="fechaCompra" name = "fechaCompra"   required>                                                    
                                                   
                                                </div>                                                
                                                <div class="mb-3"> 
                                                    <select name="tipocomprobante" id="tipocomprobante"  class="form-control chosen" required>  
                                                        <option value = "0">Select tipo comprobante</option>
                                                        <option value = "1">Consumidor final</option>
                                                        <option value = "2">Credito fiscal</option>
                                                        <option value = "3">Sin comprobante</option>
                                                    </select>     
                                                </div>
                                                <div class="mb-3">
                                                <input class="form-control text-end" type="text"   class="form-control"  id ="numcomprobante" name = "numcomprobante"    placeholder="845755" >                                                    
                                                   
                                                </div> 
                                                <div class="mb-3"> 
                                                    <select name="proveedor" id="proveedor"  class="form-control chosen" required>  
                                                        <option value = "0">Select proveedor</option>
                                                        <?php foreach( $proveedores as  $row): ?>
                                                            <option  value="<?php echo $row->proveedorID; ?>"> <?php echo  $row->provDescripcion   ?> </option>
                                                        <?php endforeach; ?>           
                                                        
                                                    </select>     
                                                </div>
                                                <div class="mb-3">
                                                   
                                                    <input type="number" class="form-control text-right" id="sumas"  name="sumas" step ="any" placeholder="Sumas $100.00"  disabled>            
                                                </div>

                                                <div class="mb-3">
                                                   
                                                    <input type="number" class="form-control text-right" id="compProdIva" name="compProdIva" step ="any" placeholder="Sumas $10.13" disabled >  
                                                </div>
                                                <div class="mb-3">                                                   
                                                    <input type="number" class="form-control text-right" id="compProdTotal" name="compProdTotal" step ="any" placeholder="Sumas $110.13" disabled>  
                                                </div>

                                           
                                                
                                                
                                                
                                            </form>  
                                            <div class="mb-3 text-right">
                                            <button id ="btnSaveCompra" name="btnSaveCompra"  class="btn btn-lg btn-primary" title="Iniciar toma" onclick="addDetCompra()">  <i class="fa fa-database" aria-hidden="true"></i> Guardar compra </button>
                                                 
                                              
                                                 <button id ="btnVerModalDetComp" name="btnVerModalDetComp"  class="btn btn-lg btn-danger" title="Iniciar toma" onclick="addDetCompra()">  <i class="fa fa-plus" aria-hidden="true"></i></button>
                                                 
                                                </div>  
                                        </div>
                                </div>
                                   
                            </div>
                            <!-- DIV PARA MOSTRA DETALLE DE INGRESO AL MOMENTO DE  INGRESARLO -->
                            <div id= "mostrarTabla" class="col-lg-6">
                               <!--  <div class="row mt-2"> -->
                             

                                 <table  class="table table-hover" style="border-width: 0px;" >
                                        <thead>
                                            <tr>
                                                <th>#</th>                                                
                                                <th>Cantidad</th>
                                                <th>Descripcion</th>
                                                <th>P. unit</th>
                                                <th>iva</th>
                                                <th>Total</th>
                                                <th>Accciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="detCompra" > 
                                        </tbody>  
                                    </table> 
                                    <div class="mb-3 text-right">
                                          
                                                  <!--   <input type="submit"   class="form-control" value="Guardar"> -->
                                    </div>

                                <!-- </div>    -->
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="tab-pane fade  p-3" id="two" role="tabpanel" aria-labelledby="two-tab">
                    <div class="container-fluid m-top">
                        <div class="row">
                            <h1>Lista General de gastos</h1>
                        </div>
                        <div class="row">
                        <div id= "listaGastos" class="col-lg-12">
                                 <table  class="table table-hover" style="border-width: 0px;" >
                                        <thead>
                                            <tr>
                                                <th>#</th>                                                
                                                <th>Fecha</th>
                                                <th>Establecimiento</th>
                                                <th>unidades</th>
                                                <th>Total</th>                                                                                                
                                                <th style="text-align: right;">Accciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id ="cuerpolistagastos"> 

                                        </tbody>  
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
     </div>
</div>
<div id = "conteModalDetCompra"></div>
</body>
 
 </html> 
 <script>
   /* $(document).ready(function(){
        $("#sucursalGasto").on('change', function(){
            //console.log(this.value);
            $("#btnguardar").css("display", "block");
        });
    });  */  
 </script> 

<script>
    $(document).ready(function()
    {
       /* $("#descripcionDetGast").on('change', function(){
                //console.log(this.value);
                if($(this).val().length > 0) {
                    document.getElementById('btnsavedet').disabled = false;
                }else{
                    document.getElementById('btnsavedet').disabled = true;
                }
            });*/
    });
</script>

<script> 

    /*window.addEventListener("unload", function(event) { 
        console.log("El usuario a avandonado la pagina")

    });*/
</script>
