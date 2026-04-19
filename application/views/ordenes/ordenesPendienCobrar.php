
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
                           <th colspan="2"><?php echo  "Orden #".$row->ordenPedidoID . " Area: " . strtoupper($row->area ). " Hora Pedido " . $row->hora. ":" . $row->minuto .  $acronimo. " ". $comentario ; ?> </th> </th>
                           <th colspan="1" id ="<?php  echo  $thCancelar; ?>" name  = "<?php  echo  $thCancelar; ?>">TOTAL A CANCELAR $ 000.00</th>
                           <th colspan="1">
                           <button type="button" class="form-control   btn-sm" data-title ="Procesar venta" onclick="realizarCobro(<?php echo $row->ordenPedidoID?>, <?php echo $row->mesaID?>  )"><i class="fa fa-print" aria-hidden="true"></i></button>
                           </th>
                        </tr>
                        <tr>
                              <th id ="titulos">Cantidad</th>
                              <th id ="titulos">Descripción</th> 
                              <th id ="titulos">Precio</th>
                              <th id ="titulos">Cobrar</th>  
                        </tr>
                    </thead>                         
                        <tr>
                           <td data-label="Número"><?php echo  $row->catidad; ?></td>
                           <td data-label="Descripción"><?php  echo  strtoupper($row->prodDescripcion . " " . str_replace("OTROS", '', $row->Presentacion) ). " ".$estado;  ?></td>                          
                           <td data-label="Número"><?php echo  $row->dettotal; ?></td>
                           <?php  if ($row->cobrar == 1){?>
                                  <td data-label="Cobrar"> <input type="checkbox" name="<?php echo $nameChek; ?>" id="<?php echo $nameChek; ?>" onclick="cobrarOrden(<?php echo $c ?>, <?php echo $row->detPedID?> , <?php echo $row->ordenPedidoID?> );" checked disabled></td>                           
                           <?php  }else{ ?>                               
                                  <td data-label="Cobrar"> <input type="checkbox" name="<?php echo $nameChek; ?>" id="<?php echo $nameChek; ?>" onclick="cobrarOrden(<?php echo $c ?>, <?php echo $row->detPedID?> , <?php echo $row->ordenPedidoID?> );"></td>
                                 <?php }?> 
                        </tr>                
                  <?php  } else { ?> 
                        <tr>
                           <td data-label="Catidad"><?php echo$row->catidad; ?></td>
                           <td data-label="Descripcion"><?php  echo   strtoupper($row->prodDescripcion . " " . str_replace("OTROS", '', $row->Presentacion)) . " ".$estado; ?></td>                           
                           <td data-label="Total"><?php echo  $row->dettotal; ?></td>
                            <?php  if ($row->cobrar == 1){?>                                
                                  <td data-label="Cobrar"> <input type="checkbox" name="<?php echo $nameChek; ?>" id="<?php echo $nameChek; ?>" onclick="cobrarOrden(<?php echo $c ?>, <?php echo $row->detPedID?> , <?php echo $row->ordenPedidoID?> );" checked disabled></td>
                           <?php  }else{ ?>
                                           <td data-label="Cobrar"> <input type="checkbox" name="<?php echo $nameChek; ?>" id="<?php echo $nameChek; ?>" onclick="cobrarOrden(<?php echo $c ?>, <?php echo $row->detPedID?> , <?php echo $row->ordenPedidoID?> );"></td>
                                 <?php }?> 
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

