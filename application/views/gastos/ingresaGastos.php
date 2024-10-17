
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  

    <script>

     $('#listDetGastos').stacktable();
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

$('#DeGastos').stacktable();
    </script>
   
</head>

<body>


<div class="row">
    <div class="col-12">
        <div class="card mt-3 tab-card">
            <div class="card-header tab-card-header ">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true" onclick="verificarstadotab(this.id)">Ingreso Inventario</a> </li>
                    <li class="nav-item"> <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false" onclick="verificarstadotab(this.id)">Busqueda Inventario</a> </li>
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">                   
                    <div class="container-fluid m-top">
                        <div class="row">
                            <!-- DIV PARA INGRESO DE  GASTOS -->
                            <div class="col-lg-6" >
                                <dIv class="row mt-2">  
                                        <div class="col-lg-8">
                                        
                                        
                                            <form id = "FormGastos" class = "FormGastos" action="javaScript:guardarGastos()" method="post">
                                            <input type="hidden"   id="gastosID" name="gastosID">
                                            <input type="hidden"   id="cerrado" name="cerrado">
                                                <div class="mb-3">
                                                <input type="date"   class="form-control"  id ="fechaGasto" name = "fechaGasto" >
                                                    <!-- <input type="date" name="fechaingb" id="fechaingb" class="form-control" value="<?php  date_default_timezone_set("America/El_Salvador");// echo $date = date("Y-m-d"); ?>"> -->
                                                </div>
                                                <div class="mb-3">
                                                    <select class="form-control  custom-margin" name="TipoMov" id="TipoMov" selected="this.selectedText">
                                                        <option value="Apertura" selected>Apertura</option>
                                                        <option value="Cierre">Cierre</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3"> 
                                                    <select name="sucursalGasto" id="sucursalGasto"  class="form-control chosen">  
                                                        <option value = "0"> Seleccione una sucrusal</option>
                                                        <?php foreach( $listaSucursales as  $row): ?>
                                                            <option  value="<?php echo $row->establecimientoID; ?>"> <?php echo  $row->estNombre   ?> </option>
                                                        <?php endforeach ?>           
                                                        
                                                    </select>     
                                                </div>
                                                <div class="mb-3">                                                  
                                                    <button id="btnguardar" name="btnguardar" type="submit"  class="form-control btn-primary "><i class="fa fa-save" aria-hidden="true"></i>  Guardar</button>
                                                   
                                                </div>
                                                <div class="mb-3"> 
                                                  
                                                   
                                                    <button id="btncerrargasto" name="btncerrargasto" class="form-control btn-danger" onclick="cerrarGastos()"><i class="fa fa-close" aria-hidden="true"></i>  Cerrar gastos</button>
                                                </div>
                                            </form>    
                                        </div>
                                     
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-12">
                                        <form  action="javaScript:guardarDetGastos()" method="POST" id  = "FormDetGastos" class = "FormDetGastos">  
                                        <input type="hidden"   id="gastosIDdet" name="gastosIDdet">
                                        <input type="hidden"  id ="detgastosID" name ="detgastosID">
                                        <!-- <input type="hidden"  id ="IdGasto" name ="IdGasto"> -->

                                        <input type="hidden"   id="cerrado"  name="cerrado"> 
                                            <div class="form-group" >                            
                                                <input type="number"   class="form-control text-right"  id ="cantidadgasto" name = "cantidadgasto" placeholder="Ingresa cantidad fisica" required>                           
                                                
                                            </div>
                                            <div class="form-group">                            
                                                <input type="number"   class="form-control text-right"  id ="preciogasto" name = "preciogasto" placeholder="Ingresa cantidad fisica" required>                           
                                              
                                            </div>
                                            <div class="form-group">                            
                                            <input type="number"   class="form-control text-right"  id ="totalDet" name = "totalDet"  >    
                                              
                                            </div>
                                            <div class="form-group">                            
                                                <textarea name="descripcionDetGast" id="descripcionDetGast"  class="form-control " rows="3"  placeholder="Ingrese la descripcion del  gasto" required></textarea>    
                                                                                     
                                            </div>
                                            <div class="mb-3 text-right">
                                            <button id ="btnsavedet" name="btnsavedet" type="submit" class="btn btn-lg btn-danger" title="Iniciar toma">  <i class="fa fa-plus" aria-hidden="true"></i></button>
                                                  <!--   <input type="submit"   class="form-control" value="Guardar"> -->
                                                </div>

                                        </form>     
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
                                                <th>Descripcion</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Total</th>
                                                <th>Accciones</th>
                                            </tr>
                                        </thead>
                                        <tbody > 
                                        </tbody>  
                                    </table> 
                                <!-- </div>    -->
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="tab-pane fade  p-3" id="two" role="tabpanel" aria-labelledby="two-tab">

                </div>
            </div>
       </div>
     </div>
</div>
</body>
 
 </html>     
<script>
$(document).ready(function()
{

//$("#nProducto").prop("selectedIndex", 0); // here 0 means select first option
//$('#nProducto').removeAttr('selected').find('option:first').attr('selected', 'selected');

});
</script>
