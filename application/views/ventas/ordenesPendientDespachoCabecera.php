<!-- Creamos la cabecera de las ordenes de despacho  -->

<?php 
$c= 1; 
 if( isset($lstPendDespCabecera)){
   foreach( $lstPendDespCabecera as  $row){ 
            ?>
            <div class="container-fluid mt-10" style="background-color: #ffffff;">
                    <div class="accordion" id="accordionExample" style="background-color: #ffffff;">
                        <div class="accordion-item" style="background-color: #ffffff;">
                            <!-- <input type="hidden"  id =  "<? //echo  'OrdenID'.  $row->ordenPedidoID?>"    name  = "<? //echo  'OrdenID'.  $row->ordenPedidoID?>" value  ="<?php //echo  $row->ordenPedidoID?>"  > -->
                            <h2 class="accordion-header" id="headingOne" style="background-color: #ffffff;">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" onclick="mostrarDetalleORden( <?php echo $row->ordenPedidoID?>);" style="background-color: #ffffff;">
                                    <?php echo  "Ver detalle de orden #".$row->ordenPedidoID ?>             <label class="chk">  <input type="checkbox">  <span>Despachado</span> </label>
                                </button>
                            
                            </h2>
                        
                        </div>   
                             
                    </div>
            </div>
 <?php  }}?>

