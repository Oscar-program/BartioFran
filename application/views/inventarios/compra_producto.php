<div class="container-fluid m-top">
        <div class="row" style="background-color:black; color:white;">
            <div class="col-12 text-center">
                <H3>  Ingreso de compras de productos </H3>
            </div>
        </div>
       
</div> 

<div class="container-fluid m-top">
   
    <input type="hidden"  id="idCompra"  name="idCompra" >
    <!-- para   el  tipo de  comprobante  y el numero del comprobante -->
    <div class="row">
        <div class="col-4 mt-1">
            <label for="proveedor">Proveedor</label>
            <select name="tipocomprobante" id="tipocomprobante"  class="form-control form-control-sm chosen">  
                    <option value="1"> Consumidor Final </option>
                    <option value="2"> Credito Fiscal </option>
                    <option value="3"> Nota de Remision </option>
                    <option value="4"> Factura de exportacion </option>
                
            </select>
        </div>
        <div class="col-2 mt-1">
            <label for="proveedor"># comprobante</label>
            <input type="text" id ="numComprobante"  name ="numComprobante"  class="form-control form-control-sm">  
        </div>

        <div class="col-4 mt-1">
           
        </div>
        <div class="col-1 mt-1 text-right">
        <button  data-title ="Guardar registro" class="btn btn-danger btn-lg" onclick="saveTransacCompraproducto()"> <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        
        </div>
        <div class="col-1 mt-1">
        <button  data-title ="Cacelar " class="btn btn-danger  btn-lg" onclick="addProducCompra()"> <i class="fa fa-times" aria-hidden="true"></i>  </button>
       
        </div>
       
       
    </div>
  
  <!-- select del proveedor -->
    <div class="row">
        <div class="col-6 mt-1">
            <label for="proveedor">Proveedor</label>

            <select name="proveedor" id="proveedor"  class="form-control chosen"> 
            <option value="0"> Selecccione un producto</option>              
                 <?php foreach ($proveedores as $row): ?>
                    <option value="<?php echo $row->proveedorID; ?>">
                    <?php echo $row->proveedorID . " - " .  $row->provDescripcion; ?>
                    </option>
                <?php endforeach ?>
            </select>

            
        </div>
        <div class="col-4 mt-1">
           
        </div>
        <div class="col-1 mt-1 text-right">
        
        
        </div>
        <div class="col-1 mt-1">
        
        
        </div>
       
       
    </div>
        <!-- telefono -->
        <div class="row mt-0">
        <div class="col-12">
            <label for="telefono">Direccion </label>
            <input type="text" id="telefono"  id="telefono" class ="form-control form-control-sm"  readonly>
        </div>
    </div>
     <!-- mail -->
    <div class="row mt-0">
        <div class="col-12">
        <label for="emial">E-mail </label>
        <input type="email" name="emial" id="email" class="form-control form-control-sm"  readonly>
        </div>
    </div>
   
        <!-- fecha de  ingreso -->
    <div class="row mt-1 ">
        <div class="col-8 mb-2" style ="padding-top: 25px;  padding-bottom: 0px;">
        <button  data-title ="Guardar registro" class="btn btn-danger" onclick="addProducCompra()"> <i class="fa fa-plus" aria-hidden="true"></i>  Agregar Producto </button> 
        </div>
        <div class="col-4">
            <label for="fechaing"> fecha de  ingreso</label>
            <input type="date" name="fechaing" id="fechaing" class ="form-control form-control-sm">
        </div>
    </div>
  
    <div class="row mt-1">
        
        <div class="col-12">
            <div class="table-responsive">
                <table id="tblListaProd" class="table table-hover">
                    <thead>
                        <tr class="thead-dark">
                            <th>#</th>
                            <th>Cantidad </th>
                            <th>Descripcion </th>
                            
                            <th>P.Unit</th>
                            <th>Impuesto</th>
                            <th>Total</th>
                                                    
                            <th class="text-right">ACCIONES</th>                                
                        </tr>
                    </thead>
                    <tbody id = "detTmpCompra">
                        
                                            
                    </tbody>
                </table>

            </div>
        </div>
        
    </div>
    <!-- formando los  totales  -->
    <div class="row mt-1 ">
        <div class="col-8 mb-2">       
        </div>
        <div class="col-2 text-right">
            <label for="fechaing"> Sub Total $</label>            
        </div>
        <div class="col-2">           
            <input type="text" name="sumas" id="sumas" class ="form-control  text-right" readonly>
        </div>
    </div>
    <!-- iva-->
    <div class="row mt-1 ">
        <div class="col-8 mb-2">       
        </div>
        <div class="col-2 text-right">
            <label for="fechaing"> Impuestos $</label>            
        </div>
        <div class="col-2">           
            <input type="text" name="impuesto" id="impuesto" class ="form-control  text-right" readonly>
        </div>
    </div>
    <!-- total-->
    <div class="row mt-1 ">
        <div class="col-8 mb-2">       
        </div>
        <div class="col-2 text-right">
            <label for="fechaing"> Total $</label>            
        </div>
        <div class="col-2">           
            <input type="text" name="total" id="total" class ="form-control  text-right" readonly>
        </div>
    </div>
    
</div>
<div id="addProductCompra">
        
</div>
