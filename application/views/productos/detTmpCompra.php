<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
var_dump($ListTmpCompra);

  if(isset($ListTmpCompra)){
      if(!empty($ListTmpCompra)){
        $c= 1;
        foreach($ListTmpCompra as  $row) :?>
        								<tr>

                        <td><?php  echo   $c; ?></td>
                        <td><?php  echo   $row->cantidad; ?></td>
                        <td><?php  echo   $row->descripcion; ?></td>
                       
                        <td><?php  echo   $row->precUnit; ?></td>
                        <td><?php  echo   $row->impuesto; ?></td>
                        <td><?php  echo   $row->total; ?></td>
                       
                                                    
                        <td class="text-right">

                            <a href='#' class="btn btn-default btn-sm" style="margin:0px;  color:blue;"
                            title="Editar Detalle"                             
                                onclick="get_FamiliaProductoID(<?php  echo   $row->idtmp; ?>);">
                                <i class="fa fa-pencil" aria-hidden="true"></i> </a>

                            
                                
                        


                                <a href='#' class="btn btn-default btn-sm" style="margin:0px;  color:red; font-weight:bold;"
                                 title="Eliminar registro"
                                onclick="delete_FamiliaProductoID(<?php  echo   $row->idtmp; ?>);">
                                <i class="fa fa-trash" aria-hidden="true"></i> </a>    

                            


                                
                        </td>
                        </tr> 
        

        <?php  $c+= 1; endforeach ?>
     <?php }
   
  }

 
?> 