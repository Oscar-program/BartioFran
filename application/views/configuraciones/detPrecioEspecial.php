<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
var_dump($listPrecioEspecial);

  if(isset($listPrecioEspecial)){
      if(!empty($listPrecioEspecial)){
        $c= 1;
        foreach($listPrecioEspecial as  $row) :?>
        								<tr>

                        <td style="font-size: 15px;"><?php  echo   $c; ?></td>
                        <td style="font-size: 15px;"><?php  echo   $row->turnOperaDescripcion; ?></td>
                        <td style="font-size: 15px;"><?php  echo   $row->famProdDescripcion; ?></td>
                        <td style="font-size: 15px;" ><?php  echo  $row->descPrecioEspecial; ?></td>
                        <td style="font-size: 15px;"><?php  echo   $row->precioEspecial; ?></td>
                                                    
                        <td class="text-right">

                            <a href='#' class="btn btn-default btn-sm" style="margin:0px;  color:blue;"
                            title="Editar Detalle"                             
                                onclick="get_PreciosEspProductoID(<?php  echo   $row->precioEspecialProdID; ?>);">
                                <i class="fa fa-pencil" aria-hidden="true"></i> </a>

                            
                                
                        


                                <a href='#' class="btn btn-default btn-sm" style="margin:0px;  color:red; font-weight:bold;"
                                 title="Eliminar registro"
                                onclick="delete_PreciosEspProductoID(<?php  echo   $row->precioEspecialProdID; ?>);">
                                <i class="fa fa-trash" aria-hidden="true"></i> </a>    

                            


                                
                        </td>
                        </tr> 
        

        <?php  $c+= 1; endforeach ?>
     <?php }
   
  }

 
?> 