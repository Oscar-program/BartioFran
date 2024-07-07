<script src=" <?php echo  base_url();?>js/funciones_basica.js"></script>
<?php ?>
<div style= "padding:0; margin:0; height:100%; overflow:hidden;  ">
<?php  if(isset($sds)){
    if(!empty($sds)){
        foreach($sds as  $row){ 
           
        ?>
           <div class="col-lg-3 col-6 " style="float:left; border: with 2px; border-color:orange;" id  =" <?php echo   'familia'.$row->famProdID ?>" 
              name  = 'familia' data-value=="<?php echo $row->famProdID;?>" onclick="cargar_listaProductos(<?php echo $row->famProdID ;?>)">
                    <!-- small box -->
                    <div class="small-box  border border-info" style="background:linear-gradient(70deg, #1465bb, #2196f3); box-shadow: 0px 0px 3px #21618C; ">
                        <div class="inner">
                        <h3 style = "color:#1465bb; ">.</h3>

                        <h4 style = "color:white;"><?php echo $row->famProdDescripcion;?></h4>
                        </div>
                        <div class="icon">
                        <i class="ion ion-bag" style = "color:#2196f3;"></i>
                        </div>
                        <a href="#" class="small-box-footer" style="background-color:#2196f3; color:white;">Detalle <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    </div>

                    
    
                    <?php } ?>
<?php } ?>
<?php } ?>




 <?php //echo  base_url(); ?>     
 
          <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
<script>
   // $("#familia").on("click", function(){
        
       // var valorid  = 0;
       //  valorid = document.getElementById('familia').dataset.value;
       // valorid      = $("#familia").val();
       // alert("se ha hecho  click"+ valorid  + " capturado");
    
</script>