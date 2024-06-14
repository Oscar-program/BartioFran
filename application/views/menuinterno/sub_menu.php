<script src=" <?php echo  base_url();?>js/funciones_basica.js"></script>
<?php

?>
<div style= "padding:0; margin:0; height:100%; overflow:hidden;  opacity:2;">
<?php  if(isset($submenu)){
    if(!empty($submenu)){
        foreach($submenu as  $row){ 
           
        ?>
           <div class="col-lg-3 col-6" style="float:left;" id  =" <?php echo   'familia'.$row->productoID ?>" 
              name  = 'familia' data-value=="<?php echo $row->productoID;?>" onclick="addVentaProducto(  <?php echo $row->famProdID ;?>, <?php echo $row->productoID ;?>, <?php echo "' $row->prodDescripcion '" ;?> ,  <?php echo $row->precioventa ;?>)">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                        <h3> <?php echo '$ '.$row->precioventa ?></h3>

                        <p style = "color:white; font-weight:bold;"><?php echo $row->prodDescripcion?></p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer"> <?php echo 'Existencia Gen: '. $row->existencia?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    </div>

                    
    
                    <?php } ?>
<?php } ?>
<?php } ?>




 <?php //echo  base_url(); ?>     
 
          <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
<div  id = "addVenta">
</div>

<script>
   // $("#familia").on("click", function(){
        
       // var valorid  = 0;
       //  valorid = document.getElementById('familia').dataset.value;
       // valorid      = $("#familia").val();
       // alert("se ha hecho  click"+ valorid  + " capturado");
    
</script>