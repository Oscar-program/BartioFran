
<?php
$c= 1; 
$orden = "";
$ultimo = 0;
?> 
<div class="contenedor-tabla">
<div class="tabla-responsive">
<table  class=" tabla  tabla-estiloOrdn">                
   <?php 
      $ultimo = count($lstPendDespCabecera);
   if( isset($lstPendDespCabecera)){
      foreach( $lstPendDespCabecera as  $row){       
             $estado     = "(Despachado)";   
             $comentario = "";
             $nameChek   = "Cobrar" .$c;
             $thCancelar = "total" .$row->ordenPedidoID;
             $acobrar    = (float) $row->ordPtotalcancelar;  
             $ordPAbono   = (float) $row->ordPAbono;

             $acronimo   = " AM"; 
             if(!empty($row->cliente)){
                $comentario = "Comentario :" . str_replace("%20", "", $row->cliente)  ; 
             }
             if( $row->hora>12){
                $acronimo =" PM";
             }
             if ($row->despachar == "0" || $row->despachar== 0){
                $estado ="(Pendiente Despachado)"; 
             }
            ?>
                 <?php  if($orden != $row->ordenPedidoID) {?>                  
                        <thead>
                              <tr>
                                 <th colspan="3"><?php echo  "Orden #".$row->ordenPedidoID . " Area: " . strtoupper($row->area ). " Hora Pedido " . $row->hora. ":" . $row->minuto .  $acronimo. " ". $comentario ; ?> </th> </th>
                                 <th colspan="1" id ="<?php  echo  $thCancelar; ?>" name  = "<?php  echo  $thCancelar; ?>"> <?php echo "Abonado $" .   round($ordPAbono,2) .  " A cobrar  $" . round($acobrar,2)   ?></th>
                                 <th colspan="1">
                                     <button type="button" class="form-control   btn-sm" data-title ="Abonar" onclick="mostrarModalAbono(<?php echo $row->ordenPedidoID?>)"><i class="fa fa-print" aria-hidden="true"></i></button>
                                 </th>
                                 <th colspan="1">
                                    <button type="button" class="form-control   btn-sm" data-title ="Procesar venta" onclick="realizarCobro(<?php echo $row->ordenPedidoID?>, <?php echo $row->mesaID?>  )"><i class="fa fa-print" aria-hidden="true"></i></button>
                                 </th>
                              </tr>
                        </thead>
                         <thead>
                              <tr>
                                    <th id ="titulos">Cantidad</th>
                                    <th id ="titulos" colspan="3">Descripción</th> 
                                    <th id ="titulos" colspan="2" >Precio</th>
                                    
                              </tr>
                        </thead>                         
                        <tr>
                           <td data-label="Cantidad"><?php echo  $row->catidad; ?></td>
                           <td data-label="Descripción" colspan="3" ><?php  echo  strtoupper($row->prodDescripcion . " " . str_replace("OTROS", '', $row->Presentacion) ). " ".$estado;  ?></td>                          
                           <td data-label="Total" colspan="2"><?php echo  $row->dettotal; ?></td>
                          
                        </tr>                
                        <?php  } else { ?> 
                              <tr>
                                 <td data-label="Catidad"><?php echo$row->catidad; ?></td>
                                 <td data-label="Descripción" colspan="2"><?php  echo   strtoupper($row->prodDescripcion . " " . str_replace("OTROS", '', $row->Presentacion)) . " ".$estado; ?></td>                           
                                  <td data-label="Total" ></td>
                                 <td data-label="Total" colspan="2"><?php echo  $row->dettotal; ?></td>
                                 
                              </tr> 
                        <?php  }?>
         
       <?php 
         $orden  =   $row->ordenPedidoID;
          $c+=1;
          ?>
          <?php }}?>
           </table>
    </div>
      </div>

      <!-- modal para abonar la cuenta  por cobrar -->
     <div class="modal fade" id="addAbonoPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
		    <div class="modal-content">
			
			  <div class="modal-header text-center">
				<h5 class="modal-title text-center" id="exampleModalLabel">  <?php echo 'Registrar Abono';?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div> 
			  <div class="modal-body">
				<form>
				
					<input type="text" class="form-control text-right" id="ordenPedidoID" name="ordenPedidoID" readonly>
                 <div class="form-group">
						<input type="number" class="form-control text-right" id="ordPAbono"  name="ordPAbono"  value ="" step="any">
					  </div> 
					  <div class="form-group">
						 
						  <button type="button" class="btn btn-danger btnActionVenta1" data-title ="Procesar venta" onclick="abonarOrden()">
						  <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
					  </div> 
				</form>
			  </div>
			
		    </div> 
		   </div> 
	  </div> 
    