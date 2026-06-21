<div class="container-fluid m-top">
        <div class="row">
            <div class="col-12 text-center">
                <H2 style="color:#5DADE2">  PRECIOS PRODUCTOS </H2>
            </div>
        </div>
</div> 

<div class="contenedor-tabla">
    <div class="tabla-responsive">
                <!--<div class="table-responsive"> -->
                    <input type="hidden" id="trasladoID" name="trasladoID">

                    <table id="tblListaProd" class="tabla  tabla-estiloOrdn">
                        <thead style="border-style: none !important;">
                            <tr class="thead-dark" style="border-style: none !important;">
                                <th>#</th>
                                <th>NOMBRE DEL  PRODUCTO</th>
                                <th>PRECIO ACTUAL</th>
                                <th>NEW. PRECIO</th>
                            
                                                        
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
                                        <td data-label="#"><?php echo $c; ?> </td>
                                            <td data-label="Descripción" ><?php echo strtoupper($row->prodDescripcion) ; ?></td>
                                            <td data-label="Precio actual" ><?php echo '$ '. $row->precioventa; ?> </td>
                                            
                                            
                                            <td data-label="Nuevo Precio"><input type="number"   class="form-control text-right"  id ="<?php echo  'precioventa' .  $c; ?>"    name ="<?php echo  'precioventa' .  $c; ?>"></td>
                                            <td  data-label="Nuevo Precio" class="text-right">

                                                <a href='#' class="btn btn-info btn-sm" style="margin:0px;  color:white;  background-color: #5DADE2  !important ;"
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

                <!--</div> -->
    </div>
</div>
