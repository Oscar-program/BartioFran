<div class="container-fluid m-top">
        <div class="row">
            <div class="col-12 text-center">
                <H2>  Asignar precios productos </H2>
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
                        <tr class="thead-dark">
                            <th>#</th>
                            <th>NOMBRE DEL  PRODUCTO</th>
                            <th>EXISTENCIA</th>
                            <th>PRECIO VENTA</th>
                           
                                                    
                            <th class="text-right">ACCIONES</th>                                
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($lista_productoCostear)){
                            if(!empty($lista_productoCostear)){
                                $c= 1;
                                foreach($lista_productoCostear as  $row) :?>
                                 
                                    
                                    
                                    <tr>
                                    <td><?php echo $c; ?> </td>
                                        <td><?php echo strtoupper($row->prodDescripcion) ; ?></td>
                                        <td><?php echo $row->existencia; ?> </td>
                                        
                                        
                                        <td><input type="number"   class="form-control text-right"  id ="<?php echo  'precioventa' .  $c; ?>"    name ="<?php echo  'precioventa' .  $c; ?>"></td>
                                        <td class="text-right">

                                            <a href='#' class="btn btn-danger btn-sm" style="margin:0px;  color:white;"
                                                data-title="Actualizar precio"
                                                onclick="updatePrecProd(<?php echo $row->productoID; ?>, <?php echo $c; ?>)">
                                                <i class="fa fa-refresh" aria-hidden="true"></i> </a>
                                                
                                        </td>
                                    </tr>
                        
                       
                                       
                                <?php  $c +=1; endforeach ?>
                        <?php }
                            } ?>
                    </tbody>
                </table>

            </div>
        </div>
        
    </div>
</div>