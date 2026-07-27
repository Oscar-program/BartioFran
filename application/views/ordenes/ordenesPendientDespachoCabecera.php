<!-- Creamos la cabecera de las ordenes de despacho  -->

<?php
$c= 1; 
$orden = "";
$ultimo = 0;
?> 
<div class="contenedor-tabla1">
 <div class="tabla-responsive1">
          <table  class="tabla-estiloOrdn">
                
<?php 
   $ultimo = count($lstPendDespCabecera);
  // echo  "el total de items es "  . $ultimo ."<br>";
 if( isset($lstPendDespCabecera)){
   foreach( $lstPendDespCabecera as  $row){          
             $comentario ="";
             $nameChek = "Despachar" .$c;
             $acronimo =" AM"; 
             if(!empty($row->cliente)){
                $comentario = "Comentario :" . str_replace("%20", "", $row->cliente)  ; 
             }
             if( $row->hora>12){
                $acronimo =" PM";
             }
   
            ?>
                 <?php  if($orden != $row->ordenPedidoID) {?> 
                    
                    <thead>
                        <tr>
                           <th colspan="4"><?php echo  "Orden #".$row->ordenPedidoID . " Area: " . strtoupper($row->area ). " Hora Pedido " . $row->hora. ":" . $row->minuto .  $acronimo. " ". $comentario ; ?>                         
                           </th>
                           <th> 
                              <button type="button"  class="form-control   btn-sm" data-title ="Abonar" name="procesar" id="procesar" onclick="procesarPedido(<?php echo $c ?>, <?php echo $row->ordenPedidoID?> );"  class="form-control btn-sm" style="background-color: #efeff1; color:#243458;">   <i class="fa fa-eye" aria-hidden="true"></i> </button> 
                           </th>
                           <th> 
                               <button type="button"  class="form-control   btn-sm" data-title ="Anular" name="<?php echo $nameChek; ?>" id="<?php echo $nameChek; ?>"  onclick="anularOrdenID( <?php echo $row->ordenPedidoID?>, <?php echo $row->mesaID?> );"  class="form-control btn-sm" style="background-color: #ffffff; color:red; text-align: center;">   <i class="fa fa-trash" aria-hidden="true"></i> </button> 
                           </th>

                        </tr>
                       <tr >
                        <th id ="titulos">Cantidad</th>
                        <th id ="titulos"  colspan="3" >Descripción</th>                       
                        <th id ="titulos"  colspan="1" style="text-align: right">Despachar</th> 
                        <th id ="titulos"  colspan="1" style="text-align: right">Anular</th>
                       
                    </tr>
                    </thead>                         
                        <tr>
                           <td data-label="Catidad"><?php echo  $row->catidad; ?></td>
                           <td data-label="Descripción"  colspan="3"><?php  echo  strtoupper($row->prodDescripcion . " " . str_replace("OTROS", '', $row->Presentacion) );  ?></td> 
                            
                           <td data-label="Despachar"  colspan="2" style="text-align: right"> 
                               <?php  if($row->despachar == 1) {?>  
                             <button type="button"  class="form-control   btn-sm" data-title ="Despachar" name="<?php echo $nameChek; ?>" id="<?php echo $nameChek; ?>"  onclick="despacharOrden(<?php echo $c ?>, <?php echo $row->ordenPedidoID?> );"  class="form-control btn-sm" style="background-color: #ffffff; color:#243458; text-align: center;" disabled>   <i class="fa fa-cutlery" aria-hidden="true"></i> </button> 
                           <?php }else {?>                          
                            <button type="button"  class="form-control   btn-sm" data-title ="Despachar" name="<?php echo $nameChek; ?>" id="<?php echo $nameChek; ?>"  onclick="despacharOrden(<?php echo $c ?>, <?php echo $row->ordenPedidoID?> );"  class="form-control btn-sm" style="background-color: #ffffff; color:#243458; text-align: center;">   <i class="fa fa-cutlery" aria-hidden="true"></i> </button> 
                            
                           <?php }?>                          
                              
                           </td>
                          

                        </tr>    
                        

      
                
                               
                   
               
                  <?php  } else { ?> 
                      <tr>
                           <td data-label="Cantidad"><?php echo$row->catidad; ?></td>
                           <td data-label="Descripción" colspan="3"><?php  echo   strtoupper($row->prodDescripcion . " " . str_replace("OTROS", '', $row->Presentacion)); ?></td>                           
                            
                            <td data-label="Despachar"  colspan="2" style="text-align: right"> 
                           <?php  if($row->despachar == 1) {?>  
                             <button type="button"  class="form-control   btn-sm" data-title ="Despachar" name="<?php echo $nameChek; ?>" id="<?php echo $nameChek; ?>"  onclick="despacharOrden(<?php echo $c ?>, <?php echo $row->ordenPedidoID?> );"  class="form-control btn-sm" style="background-color: #ffffff; color:#243458;" disabled>   <i class="fa fa-cutlery" aria-hidden="true"></i> </button> 
                           <?php }else {?>                          
                            <button type="button"  class="form-control   btn-sm" data-title ="Despachar" name="<?php echo $nameChek; ?>" id="<?php echo $nameChek; ?>"  onclick="despacharOrden(<?php echo $c ?>, <?php echo $row->ordenPedidoID?> );"  class="form-control btn-sm" style="background-color: #ffffff; color:#243458;">   <i class="fa fa-cutlery" aria-hidden="true"></i> </button> 
                            
                           <?php }?>
                            

                           <!-- <td data-label="Cantidad"> <input type="checkbox" name="<?php //echo $nameChek; ?>" id="<?php //echo $nameChek; ?>" onclick="despacharOrden(<?php //echo $c ?>, <?php //echo $row->detPedID?> );"></td>  -->
                           </td> 
                           

                          
                        </tr> 
                      <?php  }?>
         
 <?php 
         $orden  =   $row->ordenPedidoID;
          $c+=1;
          }?>
           
          
         <?php }?>
           </table>
    </div>
       </div>


