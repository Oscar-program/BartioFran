<script src=" <?php echo  base_url();?>js/funciones_basica.js"></script>
<?php

?>
<div style= "padding:0; margin:0; height:100%; overflow:hidden;  opacity:50;">
<?php  if(isset($listaMesas)){
    if(!empty($listaMesas)){
        foreach($listaMesas as  $row){ 
           
        ?>
           <div class="col-lg-3 col-6" style="float:left;" id  =" <?php echo   'mesa'.$row->mesaID ?>" 
              name  = 'familia' data-value=="<?php echo $row->mesaID;?>">
                    <!-- small box   background-color:#043B5F; class="inner" -->
                    <div class="small-box justify-content: flex-start"  style="background-color:#000406; color:white;">
                    <img class="animation__shake" src="/BartioFran/img/mesa5.png" alt="AdminLTELogo" height="100"
                    width="100" style="border-radius:5%;"> <?php echo  ''. $row->mesNombre?> 
                        <a href="#" class="small-box-footer" title="Agregar orden" style="color:greenyellow;"  onclick="cargar_addordenes(<?php  echo   $row->mesaID ; ?>);" > <i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Ordenes</a>
                        <a href="#" class="small-box-footer" title="Ver ordenes sin cobro" style="color:gold;" onclick="get_OrdenesPendientesCobro(<?php  echo   $row->mesaID ; ?>);"> <i class="fa fa-search" aria-hidden="true"> </i> Ver ordenes sin cobro</a>
                    </div>
                    </div>

                    
    
                    <?php } ?>
<?php } ?>
<?php } ?>




 <?php //echo  base_url(); ?>     
 
          <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
<div  id = "addVentas">
</div>

<script>
   // $("#familia").on("click", function(){
        
       // var valorid  = 0;
       //  valorid = document.getElementById('familia').dataset.value;
       // valorid      = $("#familia").val();
       // alert("se ha hecho  click"+ valorid  + " capturado");
    
</script>