                                  
   <?php
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);     ?>       


  <?php 
  if(isset($listaDetConteo)){
      if(!empty($listaDetConteo)){
        $c= 1;
        foreach($listaDetConteo as  $row) :?>
        				<tr style="font-size: 12px; border:1px; border-color:cornflowerblue;">
                  <?php if(  $row->stockf> 0 ) { ?>
                        <td><?php  echo   $c; ?></td>                       
                        <td><?php  echo   $row->prodDescripcion; ?></td>  
                        <td><?php  echo   $row->tcierreant; ?></td>                      
                        <td><?php  echo   $row->existenciaF; ?></td>
                        <td><?php  echo   $row->aberia; ?></td>
                        <td><?php  echo   $row->refil; ?></td>
                        <td><?php  echo   $row->stockf; ?></td> 
                        <td class="text-right" style="font-size: 18px; text-align:justify;">                           
                            <a href='#' style="margin-left: 10px;"
                            title="Editar Detalle"                             
                                onclick="getDetConteoPorID(<?php  echo   $row->detConteoID; ?>);">
                                <i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                
                                <a href='#'  style="margin-left: 10px;" 
                                 title="Eliminar registro"
                                onclick="detDetalleConteoFisico(<?php echo $row->detConteoID;?>);">
                                <i class="fa fa-trash" aria-hidden="true"></i> </a>                                    
                        </td>
                       <?php }else{?> 
                         <td colspan="9" style="color:cornflowerblue; font-weight:bold;  text-align:center"> Sin datos</td>
                          <?php  }?>
                        </tr> 
        

        <?php  $c+= 1; endforeach ?>
     <?php } else{
       echo  "<p> No se encontradon datos   </p>  ";
     }   
  }    

?>
<!--  </tbody> -->
<!-- </table> -->