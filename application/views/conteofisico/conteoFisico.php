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
               <!-- Registra los conteos fisicos   -->
                <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">
                   

                        <div class="container-fluid m-top">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <H4 style="color:#5DADE2; font-weight:bold;"> CONTEO FISICO</H4>
                                </div>
                                <br>
                                <br>
                              
                                <div class="col-lg-5">
                                    <form id="FormConteoFisico" name="FormConteoFisico"  method="post" >
                                        <input type="hidden" name="conteoID" id="conteoID"  value ="0" >
                                        <input type="hidden" name="detConteoID" id="detConteoID" value ="0">

                                        <div class="mb-3">
                                            <input type="date"  class="form-control"  name="fechaC" id="fechaC"  value="<?php  date_default_timezone_set("America/El_Salvador"); echo $date = date("Y-m-d"); ?>"> 
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-control  custom-margin" name="turno" id="turno" selected="this.selectedText">
                                                <option value="Apertura" selected>Seleccione un turno</option>
                                                <?php  foreach( $turnos as  $row): ?>
                                                        <option value="<?php  echo  $row->turnOperaID ?>"> <?php echo  $row->turnOperaDescripcion;  ?></option>
                                                <?php endforeach; ?>      
                                                
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                        <select class="form-control  custom-margin" name="bodega" id="bodega" selected="this.selectedText">
                                                <option value="Apertura" selected>Seleccione una bodega</option>
                                                <?php  foreach( $bodegas as  $row): ?>
                                                        <option value="<?php  echo  $row->bodegaProductoID ?>"> <?php echo  $row->bodProdDescripcion;  ?></option>
                                                <?php endforeach; ?>      
                                                
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <select class="form-control custom-margin chosen" name="producto" id="producto" selected="this.selectedValue">
                                                <?php foreach ($listaProductos as $row){?>
                                                    <option value="<?=$row->productoID?>" <?php if($row->productoID == 1) echo " selected" ?>>
                                                        <?=$row->prodDescripcion?>
                                                    </option>
                                                    <?php }?>
                                            </select>
                                        </div>
                                   
                                        <div class="mb-3">
                                            <input type="text" class="form-control   custom-margin" id="tcierreant" name ="tcierreant" value="" placeholder="Total cierre anterior">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control custom-margin"  id="existenciaF"  name="existenciaF"   placeholder="Existencia física">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control  custom-margin"  id="aberia"   name="aberia" placeholder="Aberías">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control custom-margin"  id="refil" name="refil"  placeholder="Refíl">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control   custom-margin"  id="stockf"  name="stockf"  placeholder="Existencia Real">
                                        </div>

                                        
                                    </form> 
                                 
                                    <div class="mb-3 text-right">
                                                <button  id ="btnSaveConteo" name="btnSaveConteo"  class="btn btn-lg btn-primary"  style="background-color: #5DADE2 ;  border-color:aliceblue; border-width:1px;"  title="Procesar Conteo físico" onclick="saveCompraproducto()">  <i class="fa fa-database" aria-hidden="true"></i> Guardar Conteo </button>
                                                <!-- <button id ="btnSaveCompra" name="btnSaveCompra"  class="btn btn-lg btn-primary"  style="background-color: #5DADE2 ;  border-color:aliceblue; border-width:1px;"  title="Procesar compra" onclick="saveCompraproducto()">  <i class="fa fa-database" aria-hidden="true"></i> Guardar compra </button> -->
                                                <button id ="btnVerModalDetComp" name="btnVerModalDetComp"  class="btn btn-lg btn-primary" style="background-color: #5DADE2; border-color:aliceblue; border-width:1px;" title="Agregar detalle de conteo1" onclick="guardarConteoFisico1()">  <i class="fa fa-plus" aria-hidden="true"></i></button>
                                                        
                                     </div>
                                </div>   
                              

                            
                                <div class="col-lg-7">
                                    <table  class="table table-hover" id="detalleConteo" style="border-width: 1px; border-color:#5DADE2 ;" >
                                            <thead>
                                                <tr style="font-size: 9px;">
                                                    <th style="font-size: 10px;">#</th>   
                                                    <th style="font-size: 10px;">Descripcion</th>
                                                    <th style="font-size: 10px;"> T. Cierre</th>
                                                    <th style="font-size: 10px;">Existencia</th>
                                                    <th style="font-size: 10px;">Aberias</th>
                                                    <th style="font-size: 10px;">Refil</th>
                                                    <th style="font-size: 10px;">Existencia Real</th>
                                                    <th style="font-size: 10px;">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="detConteo" > 
                                            </tbody>  
                                    </table> 
                                    <div class="mb-3 text-right">
                                            
                                                    
                                    </div>

                                </div>
                            </div>
                        </div>
                  
                </div>

                <!-- lista los conteos fisicos  -->
                <div class="tab-pane fade  p-3" id="two" role="tabpanel" aria-labelledby="two-tab">
                    <div class="container-fluid m-top">
                        <div class="row">
                            <div class="col-12 text-center">
                                <H5> BUSQUEDA INVENTARIO DIARIO</H5> </div>
                                <br>
                                 <br>
                         
                                <div class="container-fluid mt-0">
                                    <div class="row">
                                        <div class="col-md"><input type="date"  class="form-control" name="FechIncio" id="FechIncio"></div>
                                        <div class="col-md"><input type="date" class="form-control" name="FechFin" id="FechFin"></div>
                                        <div class="col-md"><input type="button" id="btnBuscaConteo"  class="form-control" value="Buscar" onclick="getlistaConteo()"  style ="background-color: #5DADE2; width:30%;color:aliceblue; font-weight:bold;"></div>


                                    </div>
                                    <br>
                                    <div class="row">
                                        <table id="tblConteo" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>FECHA</th>  
                                                    <th>TURNO</th>
                                                    <th>CIERRE</th>
                                                    <th>EXISTENCIA</th>
                                                    <th>ABERIA</th>
                                                    <th>REFIL</th>                                
                                                    <th>TOTAL</th>                              
                                                    <th class="text-right">ACCIONES</th>                                
                                                </tr>
                                            </thead>
                                            <tbody id="detConteo">
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
    </div>
</div>
<script>
     $(document).ready( function(){
       $("#btnSaveConteo").prop("disabled",true);
         
     });

</script>
<script>
    $(document).ready( function(){
      $("#tcierreant").on("change", function(){

         console.log("haciendo cambios en el cierre anterior");
         calcularexistenciaReal();
      })

    });

</script>
<script>
    $(document).ready( function(){
      $("#existenciaF").on("change", function(){
         console.log("Cambiando la existencia fisica");
         calcularexistenciaReal();
      })

    });

</script>
<script>
    $(document).ready( function(){
      $("#aberia").on("change", function(){
         console.log("Cambiando la existencia fisica");
         calcularexistenciaReal();
      })

    });

</script>
<script>
    $(document).ready( function(){
      $("#refil").on("change", function(){
         console.log("Cambiando la existencia fisica");
         calcularexistenciaReal();
      })

    });

</script>

<script>
    function activarTab(){
        let tab = document.getElementById("one-tab");
         tab.click();

        /*tab.addEventListener("click", function(){
           
        });*/

    }
   // $(document).ready(function (){

        
    /*  $("#btnBuscaConteo").on('click', function(){
        var FechIncio =  ($("#FechIncio").val().length>0 ) ? $("#FechIncio").val() : "";
        var FechFin   =  ($("#FechFin").val().length>0 )   ? $("#FechFin").val() : "";
        if(FechIncio.length== 0 ||  FechFin.length ==  0 ){
            console.log("Las fechas no pueden estar vacias");
            return   false;
        }
        var urlDest = "index.php/ConteoFisico_Controller/get_listaConteo/";
        var datJson ={FechIncio:FechIncio, FechFin:FechFin};
        $.ajax({
                 url: base_url(urlDest),
                 type: "POST" ,
                 data: datJson,
                 beforeSend: function(){},
                 success: function (data){
                    console.log(data);
                 $("#detConteo").html(data);
                   $("#detConteo").change();
                 //$("#detCompra").html(data);

                 },
                 complete:  function (){} 

         });

         //console.log("Buscar datos de  conteo fisico");               
        });*/

    //});
    

</script>


<!-- funcion que hace la sumatoia de los valores -->
<script>
    function calcularexistenciaReal(){
        var suma        = 0 ;
        var tcierreant  = ($("#tcierreant").val().length>0)? parseInt($("#tcierreant").val()) :  0;
        var existenciaF = ($("#existenciaF").val().length>0)? parseInt($("#existenciaF").val()) :  0;
        var aberia      = ($("#aberia").val().length>0)? parseInt($("#aberia").val()) :  0;
        var refil       = ($("#refil").val().length>0)? parseInt($("#refil").val()) :  0;
        suma            = (tcierreant - existenciaF- aberia) + refil ;
        if(suma>0) {
            $("#stockf").val(suma);
        }else{
            $("#stockf").val(null);
        }

    }
</script>


<script>

$(document).ready(function()
{
 $("#Producto").select2({
                                        theme: 'bootstrap4',
                                        placeholder: "Select producto",
                                        allowClear: true,
                                        width: 'resolve',
                                    });


});
</script>
