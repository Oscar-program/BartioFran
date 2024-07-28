<div class="container-fluid m-top">
        <div class="row">
            <div class="col-12 text-center">
                <H2> Existencia productos </H2>
            </div>
        </div>
</div> 


<div class="container-fluid m-top">
    <div class="row">
        
        <div class="col-12">
            <div class="table-responsive">
                <input type="hidden" id="trasladoID" name="trasladoID">

                <table id="tblListaProd" class="table table-hover">
                    <thead>
                        <tr class="thead-secondary" style="background-color:dodgerblue; color:aliceblue;">                           
                            <th>PRODUCTO</th>                            
                            <th>BODEGA</th>                           
                            <th>EXISTENCIA</th>
                                             
                                                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($indicadorExistenciaProd)){
                            if(!empty($indicadorExistenciaProd)){
                                $c= 1;
                                foreach($indicadorExistenciaProd as  $row) :?>
                                 
                                    
                                     <?php 
                                     $minimo      =  0;
                                     $normal      =  10;
                                     $maximo      =  20;
                                     $existencia  = $row->existenciaInvProd; 
                                     ?>
                                    <tr>
                                 
                                        <td><?php echo strtoupper($row->prodDescripcion) ; ?></td>
                                        <td><?php echo strtoupper($row->bodProdDescripcion) ; ?> </td>

                                       
                                        <td class="text-left">
                                        <?php echo  $row->existenciaInvProd ; ?>
                                          <?php 
                                           if($existencia == $minimo){?> 
                                         
                                              <a href='#' class="btn btn-danger btn-sm" style="margin:0px;  color:white; border-radius: 20px"
                                                data-title="Procesar Traslado">   Comprar  </a>
                                                <?php }else if($existencia == $normal){ ?>
                                               <a href='#' class="btn btn-warning btn-sm" style="margin:0px;  color:white; border-radius: 20px"
                                            data-title="Procesar Traslado">Observar </a>
                                          

                                           <?php }else if( $existencia>$normal && $existencia<= $maximo){ ?>   
                                            <a href='#' class="btn btn-success btn-sm" style="margin:0px;  color:white; border-radius: 20px"
                                            data-title="Procesar Traslado">Maximo </a>
                                            <?php  }?>              
                                                
                                        </td>
                                        
                                    </tr>
                        
                       
                                       
                                <?php  $c =+1;      endforeach ?>
                        <?php }
                            } ?>
                    </tbody>
                </table>

            </div>
        </div>
        
    </div>
</div>