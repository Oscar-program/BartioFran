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
                    <tr >
                        <th colspan="3"><?php echo  "Orden #".$row->ordenPedidoID . " Area: " . strtoupper($row->area ). " Hora Pedido " . $row->hora. ":" . $row->minuto .  $acronimo. " ". $comentario ; ?> </th>
                       
                    </tr>
                    <tr >
                        <th id ="titulos">Cantidad</th>
                        <th id ="titulos" >Descripción</th>                       
                        <th id ="titulos" >Despachar</th> 
                       
                    </tr>
                    </thead>                         
                        <tr>
                           <td data-label="Catidad"><?php echo  $row->catidad; ?></td>
                           <td data-label="Descripción"><?php  echo  strtoupper($row->prodDescripcion . " " . str_replace("OTROS", '', $row->Presentacion) );  ?></td> 
                           <?php  if($row->despachar == 1) {?>                         
                            <td data-label="Despachar"> <input type="button" value ="Despachado"  name="<?php echo $nameChek; ?>" id="<?php echo $nameChek; ?>" onclick="despacharOrden(<?php echo $c ?>, <?php echo $row->detPedID?> );"> </td>
                           <?php }else {?> 
                             <td data-label="Despachar"> <input type="button"  value ="Despachar" name="<?php echo $nameChek; ?>" id="<?php echo $nameChek; ?>" onclick="despacharOrden(<?php echo $c ?>, <?php echo $row->detPedID?> );"  class="form-control btn-sm" style="background-color: #243458; color:white;"> </td>
                           <?php }?>
                        </tr>    
                        

      
                
                               
                   
               
                  <?php  } else { ?> 
                      <tr>
                           <td data-label="Número"><?php echo$row->catidad; ?></td>
                           <td data-label="Descripción"><?php  echo   strtoupper($row->prodDescripcion . " " . str_replace("OTROS", '', $row->Presentacion)); ?></td>                           
                             <?php  if($row->despachar == 1) {?>                         
                            <td data-label="Cantidad"> <input type="checkbox"  class="btn-check"  name="<?php echo $nameChek; ?>" id="<?php echo $nameChek; ?>" onclick="despacharOrden(<?php echo $c ?>, <?php echo $row->detPedID?> );"></td>
                           <?php }else {?> 
                             <td data-label="Cantidad"> <input type="checkbox" class="btn-check" name="<?php echo $nameChek; ?>" id="<?php echo $nameChek; ?>" onclick="despacharOrden(<?php echo $c ?>, <?php echo $row->detPedID?> );"></td>
                           <?php }?>

                           <!-- <td data-label="Cantidad"> <input type="checkbox" name="<?php //echo $nameChek; ?>" id="<?php //echo $nameChek; ?>" onclick="despacharOrden(<?php //echo $c ?>, <?php //echo $row->detPedID?> );"></td>  -->
                            
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


