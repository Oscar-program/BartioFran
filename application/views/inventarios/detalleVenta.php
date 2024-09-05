<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
//var_dump($detalleOrden);

  if(isset($detalleOrden)){
      if(!empty($detalleOrden)){
        $c= 1;
        foreach($detalleOrden as  $row) :?>
        								<tr>
                       
                        <td><?php  echo   $row->detcantidad; ?></td>
                        <td><?php  echo    mb_convert_case( $row->prodDescripcion, MB_CASE_LOWER, "UTF-8");?></td>
                        <td><?php  echo   $row->dettotal; ?></td>
                                                    
                        <td class="text-right"> 
                              <a href='#' class="btn btn-default btn-sm" style="margin:0px;  color:blue; font-weight:bold;"
                                 title="Editar detalle"
                                onclick="addVentaProducto(<?php echo $row->famProdID ;?>, <?php echo $row->productoID ;?>,  <?php echo $row->detPedID;?>, <?php echo "' $row->prodDescripcion '" ;?> ,  <?php echo $row->detprecioNormal ;?>)">
                                <i class="fa fa-pencil" aria-hidden="true"></i> </a>

                                <a href='#' class="btn btn-default btn-sm" style="margin:0px;  color:red; font-weight:bold;"
                                 title="Eliminar venta"
                                onclick="delete_FamiliaProductoID(<?php  echo   $row->detPedID; ?>);">
                                <i class="fa fa-trash" aria-hidden="true"></i> </a>

                        </td>
                        </tr> 
        

        <?php  $c+= 1; endforeach ?>
     <?php }
   
  }

 
?> 