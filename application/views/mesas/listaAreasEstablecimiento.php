<script src=" <?php echo  base_url();?>js/funciones_basica.js"></script>
<?php

?>
<div style= "padding:0; margin:0; height:100%; overflow:hidden;  opacity:50;">
<?php  if(isset($listAreasEstablecimiento)){
    if(!empty($listAreasEstablecimiento)){
        foreach($listAreasEstablecimiento as  $row){ 
        ?>
           <div class="col-lg-4 col-4 justify-content-center mt-1 ml-2  border border-info" style="float:left; text-align:justify; display: flex; align-items: center;height:110px; background-color: #5DADE2 ;  border-color:aliceblue; border-width:1px; box-shadow: 0px 0px 3px #21618C; " id  =" <?php echo   'establecimiento'.$row->areasEstablecimientoID ?>" 
              name  = 'familia' data-value=="<?php echo $row->areasEstablecimientoID;?>"  onclick="listarMesas(<?php  echo   $row->areasEstablecimientoID ; ?>);" >
                    <h4 class="text-center tituloBotones"> <?php echo  ''. $row->area?> </h4>
                    </div>    
                    <?php } ?>
<?php } ?>
<?php } ?>
         
</div>
<div  id = "addVentas">
</div>

<script>
  
    
</script>