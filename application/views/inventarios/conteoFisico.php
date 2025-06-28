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
                    <form metod="POST" id="FormInvdiario" class="FormOnetab">
                        <div class="container-fluid m-top">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <H4 style="color:#5DADE2; font-weight:bold;"> CONTEO FISICO</H4>
                                </div>
                                <br>
                                <br>
                              
                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <input type="date" name="fecha" id="fecha" class="form-control" value="<?php  date_default_timezone_set("America/El_Salvador"); echo $date = date("Y-m-d"); ?>"> 
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
                                    <div class="mb-3 text-right">
                                                        <button  id ="btnSaveConteo" name="btnSaveConteo"  class="btn btn-lg btn-primary"  style="background-color: #5DADE2 ;  border-color:aliceblue; border-width:1px;"  title="Procesar Conteo físico" onclick="saveCompraproducto()">  <i class="fa fa-database" aria-hidden="true"></i> Guardar Conteo </button>
                                                        <!-- <button id ="btnSaveCompra" name="btnSaveCompra"  class="btn btn-lg btn-primary"  style="background-color: #5DADE2 ;  border-color:aliceblue; border-width:1px;"  title="Procesar compra" onclick="saveCompraproducto()">  <i class="fa fa-database" aria-hidden="true"></i> Guardar compra </button> -->
                                                        <button id ="btnVerModalDetComp" name="btnVerModalDetComp"  class="btn btn-lg btn-primary" style="background-color: #5DADE2; border-color:aliceblue; border-width:1px;" title="Agregar detalle de conteo" onclick="addDetCompra()">  <i class="fa fa-plus" aria-hidden="true"></i></button>
                                                        
                                     </div>
                               </div>

                            
                                <div class="col-lg-7">
                                <table  class="table table-hover" style="border-width: 1px; border-color:#5DADE2 ;" >
                                        <thead>
                                            <tr style="font-size: 9px;">
                                                <th style="font-size: 10px;">#</th>                                                
                                                <th style="font-size: 10px;">Cantidad</th>
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
                    </form>
                </div>


                <div class="tab-pane fade  p-3" id="two" role="tabpanel" aria-labelledby="two-tab">
                    <div class="container-fluid m-top">
                        <div class="row">
                            <div class="col-12 text-center">
                                <H2> BUSQUEDA INVENTARIO DIARIO</H2> </div>
                         
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <input type="date" name="fechab" id="fechab" class="form-control" value="<?php  date_default_timezone_set("America/El_Salvador"); echo $date = date("Y-m-d");?>"> </div>
                                    <div class="mb-3">
                                        <select class="form-control  custom-margin" name="TipoMovb" id="TipoMovb" selected="this.selectedText">
                                            <option value="Apertura" selected>Apertura</option>
                                            <option value="Cierre">Cierre</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-control custom-margin" name="Productob" id="Productob" selected="this.selectedValue">
                                            <?php foreach ($listaProductos as $row){?>
                                                <option value="<?=$row->productoID?>">
                                                    <?=$row->prodDescripcion?>
                                                </option>
                                                <?php }?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                     
                                <a href='#' class="btn btn-danger btn-sm" style="float:right" data-title="Buscar" onclick="BuscarInvDiario()">
                                   Buscar
                                </a> 
                                    </div>

                                </div>
                            </div>
                        </div>
								
						<div class="row" style="margin-top:20px" id="detalle">
                            <div class="col-lg-6">
									<div class="mb-3">
									<label for="invinicialb" class="col-form-label">Qty Inv Inicial:</label>
                                    <input type="text" class="form-control   custom-margin" id="invinicialb" value="" >
                                </div>
                                <div class="mb-3">
								<label for="conteob" class="col-form-label">Conteo:</label>
                                    <input type="text" class="form-control custom-margin"  id="conteob">
                                </div>
                                <div class="mb-3">
								<label for="invfinalb" class="col-form-label">Qty Inv Final:</label>
                                    <input type="text" class="form-control  custom-margin"  id="invfinalb">
                                </div>
                                <div class="mb-3">
								<label for="vnormalb" class="col-form-label">Qty Vendidos Precio Normal:</label>
                                    <input type="text" class="form-control custom-margin"  id="vnormalb">
                                </div>
                                <div class="mb-3">
								<label for="pnormalb" class="col-form-label">Monto Precio Normal:</label>
                                    <input type="text" class="form-control   custom-margin">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
								<label for="pespecialb" class="col-form-label">Monto Precio Especial:</label>
                                    <input type="text" class="form-control custom-margin"  id="pespecialb">
                                </div>
                                <div class="mb-3">
								<label for="vespecialb" class="col-form-label">Qty Vendidos Precio Especial:</label>
                                    <input type="text" class="form-control  custom-margin"  id="vespecialb">
                                </div>
                                <div class="mb-3">
								<label for="totalvb" class="col-form-label">Qty Total  Venta (Global):</label>
                                    <input type="text" class="form-control  custom-margin"  id="totalvb">
                                </div>
                                <div class="mb-3">
								<label for="totalamtb" class="col-form-label">Monto Total Venta (Global):</label>
                                    <input type="text" class="form-control custom-margin"  id="totalamtb">
                                </div>
                                <!-- 
                                <a href='#' class="btn btn-success btn-sm" style="float:right" data-title="Procesar Traslado" onclick="SaveInvDiario()">
                                    <i class="fa fa-save" aria-hidden="true">
												</i>
                                </a> -->

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
