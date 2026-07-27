<style>
/*para checknox  */
.switch-container{
    display:inline-flex;
    align-items:center;
    cursor:pointer;
    user-select:none;
    font-family:Arial, Helvetica, sans-serif;
    font-size:12px;
    color:#444;
}

.switch-container input{
    display:none;
}

/* Fondo del switch */
.slider{
    position:relative;
    width:42px;
    height:22px;
    background:#d8d8d8;
    border-radius:30px;
    transition:.3s;
    margin-right:10px;
}

/* Botón */
.slider::before{
    content:"";
    position:absolute;
    width:16px;
    height:16px;
    left:3px;
    top:3px;
    background:#ffffff;
    border-radius:50%;
    box-shadow:0 1px 3px rgba(0,0,0,.35);
    transition:.3s;
}

/* Cuando está activado */
.switch-container input:checked + .slider{
    background:#0d6efd;
}

.switch-container input:checked + .slider::before{
    transform:translateX(20px);
}

.texto{
    margin-left:2px;
} 


</style>

<div class="container-fluid m-top">
        <div class="row">
            <div class="col-12 text-center">
                <H2 style="color:#5DADE2">  PRECIOS PRODUCTOS </H2>
            </div>
        </div>
</div>
<?php  
$proddisponible  =  0; ?> 

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
                            
                                <th>Disponible</th>                        
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
                                           

                                            <td>
                                                  <?php  
           
                                                        if($row->proddisponible ==  '1'){ ?>
                                                        
                                                        <label class="switch-container">
                                                            <input type="checkbox" id="<?php echo 'proddisponible'  .  $c; ?>" checked>
                                                            <span class="slider"></span>
                                                            <!--<span class="texto">Disponible</span> -->
                                                        </label>


                                                        
                                                        <?php   }else { ?>
                                                        <label class="switch-container">
                                                            <input type="checkbox" id="<?php echo 'proddisponible'  .  $c; ?>"  >
                                                            <span class="slider"></span>
                                                            <!--<span class="texto">Disponible</span> -->
                                                        </label>
                                                        <?php  } ?>

                                            </td>
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
