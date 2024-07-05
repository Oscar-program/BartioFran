<script src=" <?php echo  base_url();?>js/funciones_basica.js"></script>
<?php

?>
<div style= "padding:0; margin:0; height:100%; overflow:hidden;  opacity:2; margin-left:2px; ">
<?php  if(isset($submenu)){
    if(!empty($submenu)){
        foreach($submenu as  $row){ 
           
        ?>
           <div  style="float:left; width:25%; margin-left:3px; shadow p-3 mb-5 bg-white rounded" id  =" <?php echo   'familia'.$row->productoID ?>" 
              name  = 'familia' data-value=="<?php echo $row->productoID;?>" onclick="addVentaProducto(  <?php echo $row->famProdID ;?>, <?php echo $row->productoID ;?>, <?php echo "' $row->prodDescripcion '" ;?> ,  <?php echo $row->precioventa ;?>)">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                        <h6> <?php echo '$ '.$row->precioventa ?></h6>

                        <p style = "color:white; font-weight:bold; font-size:10px;"><?php echo $row->prodDescripcion?></p>
                        </div>
                       
                        <a href="#" class="small-box-footer" style = "color:white; font-weight:bold; font-size:10px; background: linear-gradient(darkred, pink);"> <?php echo 'Existencia'. $row->existencia?></a>
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