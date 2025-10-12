
<?php
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
    // var_dump($ListTmpCompra);
    //  class="btn-edit"
    // class="btn-eraser"
    // style="background-color: #5DADE2 ;  border-color:aliceblue; border-width:1px;" ?>
     <!-- <table id="tblConteo" class="table table-hover">-->
      <thead>
          <thead>
              <tr style="font-size: 12px; border:1px; border-color:cornflowerblue;">
                  <th style="font-size: 10px;">#</th>                                                
                  <th style="font-size: 10px;">Fecha</th>
                  <th style="font-size: 10px;">Turno</th>
                  <th style="font-size: 10px;"> T. Cierre</th>
                  <th style="font-size: 10px;">Existencia</th>
                  <th style="font-size: 10px;">Aberias</th>
                  <th style="font-size: 10px;">Refil</th>
                  <th style="font-size: 10px;">Existencia Real</th>
                  <th style="font-size: 10px;">Acciones</th>
              </tr>
          </thead>
      </thead>
      <tbody id="detConteo">
                                       
   


  <?php 
  if(isset($listaConteo)){
      if(!empty($listaConteo)){
        $c= 1;
        foreach($listaConteo as  $row) :?>
        				<tr style="font-size: 9px; border:1px; border-color:cornflowerblue;">
                  <?php if(  $row->stockf> 0 ) { ?>
                        <td><?php  echo   $c; ?></td>
                         <td><?php  echo   $row->fecha; ?></td> 
                        <td><?php  echo   $row->turnOperaDescripcion; ?></td>  
                        <td><?php  echo   $row->tcierreant; ?></td>                      
                        <td><?php  echo   $row->existenciaF; ?></td>
                        <td><?php  echo   $row->aberia; ?></td>
                        <td><?php  echo   $row->refil; ?></td>
                        <td><?php  echo   $row->stockf; ?></td>                      
                                                    
                        <td class="text-right" style="font-size: 18px; text-align:justify;">
                           
                            <a href='#' style="margin-left: 10px;"
                            title="Editar Detalle"                             
                                onclick="getDetConteo(<?php  echo   $row->conteoID; ?>);">
                                <i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                
                                <a href='#'  style="margin-left: 10px;" 
                                 title="Eliminar registro"
                                onclick="getDetConteo(<?php  echo   $row->conteoID; ?>);">
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
 </tbody>
<!-- </table> -->