<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<?php  $ordenID = 0;  ?>
<div class = "container-fluid">   
    <div class="row">    
            <div  class="shadow-sm" style ="width:15%;"> 
                <div class="table-responsive">
                    <table id="tblFamiliaProd" class="table table-hover" style ="width:100%;">
                        <thead>
                            <tr class="thead-dark">
                               
                                <th>Familia</th>                                      
                                                               
                            </tr>
                        </thead>
                        <tbody  id ="detMArcas">
                            <?php
                        if(isset($listFamiliaProducto)){
                            if(!empty($listFamiliaProducto)){
                                $c= 1;
                                foreach($listFamiliaProducto as  $row) :?>
        								<tr>

                                         
                                            <td  onclick="cargar_listaProductos(<?php echo $row->famProdID ;?>)"> <i class="fa fa-book" aria-hidden="true"></i></i> <?php  echo   $row->famProdDescripcion; ?></td>
                                                                        
                                           
                                            </tr> 
        

                                <?php  $c+= 1; endforeach ?>
     <?php }}?>
   
                                   
                                                                
                        </tbody>
                    </table>
                </div>     
            </div> 
            <div id="listaProductos" class ="col-md 9">              
                    
            </div> 
            <div class ="col-md 2 shadow-sm p-3 mb-5 bg-white rounded">
                <?php  
                  if(isset($datordenID)){
                    $ordenID = $datordenID;
                  }
                ?>
                <label> ORDEN DE PEDIDO  #</label>
                <input type="text" class="text-right border-0" name="ordenID" id="ordenID" value="<?php  echo strval($ordenID); ?>  ">
                <div class="table-responsive">
                    <table id="tblFamiliaProd" class="table table-hover">
                        <thead>
                            <tr class="thead-dark">
                                <th>Cantidad</th>
                                <th>Descripcion</th> 
                                <th>Total</th>                                      
                                <th class="text-right">ACCIONES</th>                                
                            </tr>
                        </thead>
                        <tbody  id ="detMArcas">                                   
                                                                
                        </tbody>
                    </table>
                </div>
                <label>           CANCELAR $</label>
                <input type="text"  class="text-right border-0" name="totalOrden" id="totalOrden" value="">
                <button type="button" class="btn btn-danger" data-title ="Procesar venta" onclick="saveVentaProducto()" ><i class="fa fa-print" aria-hidden="true"></i></button>
            </div>             
            
    </div>
    
 
</div>
