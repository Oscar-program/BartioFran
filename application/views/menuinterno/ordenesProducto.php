<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<?php  $ordenID = 0;  ?>
<?php  $total  = 0;  ?>
<div class = "container-fluid">   
    <div class="row">    
            <div  class="shadow-lg p-3 mb-5 bg-white rounded" style ="width:15%;"> 
                <div class="table-responsive">
                    <table id="tblFamiliaProd" class="table table-hover" style ="width:100%;">
                        <thead>
                            <tr class="thead-danger"  style="background-color:darkred; color:aliceblue;">
                               
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

                                         
                                            <td  onclick="cargar_listaProductos(<?php echo $row->famProdID ;?>)"> <i class="fa fa-book "aria-hidden="true" style="color:brown;"></i> <?php  echo   $row->famProdDescripcion; ?></td>
                                                                        
                                           
                                            </tr> 
        

                                <?php  $c+= 1; endforeach ?>
     <?php }}?>
   
                                   
                                                                
                        </tbody>
                    </table>
                </div>     
            </div> 
            <div id="listaProductos" class ="col-md 9 shadow-sm p-3 mb-5 bg-white rounded" style="margin-left: 3px;">  
            <?php   $this->load->view('menuinterno/sub_menu');?>            
                    
            </div> 
            <div class ="col-md 2 shadow-sm p-3 mb-5 bg-white rounded" style="margin-left: 3px;">
                <?php  
                  if(isset($datordenID)){
                    $ordenID = $datordenID;
                  }
                ?>
                
                <form action="" id="formcabpedido"  name="formcabpedido">
                <label> ORDEN DE PEDIDO  #</label> <input type="text" class="text-left text-warning border-0" name="ordenID" id="ordenID" value="<?php  echo strval($ordenID); ?>" readonly>
            
                
                <div class="table-responsive">
                    <table id="tblFamiliaProd" class="table table-hover">
                        <thead>
                            <tr class="thead-danger"  style="background-color:darkred; color:aliceblue;  background: linear-gradient(darkred, pink);" >
                                <th>Cantidad</th>
                                <th>Descripcion</th> 
                                <th>Total</th>                                      
                                <th class="text-right">ACCIONES</th>                                
                            </tr>
                        </thead>
                        <tbody  id ="detOrdenesPedido">   
                          <?php  $this->load->view('inventarios/detalleVenta'); ?>                           
                                                                
                        </tbody>
                    </table>
                </div>
                <label>           CANCELAR $</label>
                <?php  
                  if(isset($datTotal)){
                  //  var_dump($datTotal);

                    $total =  number_format($datTotal,2);
                   // echo  'La  variable tiene '. $total; 
                  }
                ?>

                <input type="number"  class="text-right border-0" name="totalOrden" id="totalOrden" value="<?php  echo  $total;?>" readonly>
                <button type="button" class="btn btn-danger" data-title ="Procesar venta" onclick="crear_pdf_ticket()" ><i class="fa fa-print" aria-hidden="true"></i></button>
                </form>
            </div>             
            
    </div>
    
 
</div>
