<div class="container-fluid m-top">
        <div class="row">
            <div class="col-12 text-center">
                <H2>  Traslado de productos </H2>
            </div>
        </div>
</div> 

<div class="container-fluid m-top">
    <div class="row">
        
        <div class="col-12">
            <div class="table-responsive">
                <input type="text" id="trasladoID" name="trasladoID">

                <table id="tblListaProd" class="table table-hover">
                    <thead>
                        <tr class="thead-dark">
                            <th>#</th>
                            <th>NOMBRE DEL  PRODUCTO</th>
                            <th>EXISTENCIA</th>
                            <th>BODEGA ORIGEN</th>
                            <th>BODEGA DESTINO</th>
                            <th>CANTIDAD</th>
                            >                         
                            <th class="text-right">ACCIONES</th>                                
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($listaProductos)){
                            if(!empty($listaProductos)){
                                $c= 1;
                                foreach($listaProductos as  $row) :?>
                                 <?php foreach($listBodegaProducto as  $lbod ): 
                                    if($lbod->bodegaProductoID!=1){
                                    ?>
                                    
                                    
                                    <tr>
                                    <td><?php echo $c; ?> </td>
                                        <td><?php echo strtoupper($row->prodDescripcion) ; ?></td>
                                        <td><?php echo $row->existencia; ?> </td>
                                        <td>
                                      
                                        <input type="text"   class="form-control"  id ="bodegaOrigen" name ="bodegaOrigen"  value = "<?php echo $row->bodProdDescripcion;?>"  readonly> 
                                        </td>
                                        <td>
                                        <input type="text"   class="form-control"  id ="bodegaDest" name ="bodegaDest"  value = "<?php echo $lbod->bodProdDescripcion;?>"  readonly>     
                                       
                                        </td>
                                        <td><input type="number"   class="form-control"  id ="<?php echo  'cantidadtrasl' .  $c; ?>"    name ="<?php echo  'cantidadtrasl' .  $c; ?>"></td>
                                        <td class="text-right">

                                            <a href='#' class="btn btn-danger btn-sm" style="margin:0px;  color:white;"
                                                data-title="Procesar Traslado"
                                                onclick="saveTraslado(<?php echo $row->productoID; ?> , <?php echo $row->bodegaProductoID; ?> ,<?php echo $row->existencia; ?>, <?php echo   $lbod->bodegaProductoID; ?>,<?php echo   $c; ?> )">
                                                <i class="fa fa-check-square-o" aria-hidden="true"></i> </a>
                                                
                                        </td>
                                    </tr>
                        
                       
                                <?php } endforeach ?>            
                                <?php  $c =+1; endforeach ?>
                        <?php }
                            } ?>
                    </tbody>
                </table>

            </div>
        </div>
        
    </div>
</div>