<!-- Creamos la cabecera de las ordenes de despacho  -->
 <style type="css">
    .contenedor1 {
        margin-top: 20px;
        background-color: red;

    }
 </style>


<div class="container-fluid " style="background-color: #ffffff;  margin-top: 4px;  width:98%; " >
<?php 
$c= 1; 
 if( isset($lstPendDespCabecera)){
   foreach( $lstPendDespCabecera as  $row){
             $comentario ="";
             $nameChek = "Anular" .$c;
             $acronimo =" AM"; 
             if(!empty($row->cliente)){
                $comentario = "Comentario :" . str_replace("%20", "", $row->cliente)  ; 
             }
             if( $row->hora>12){
                $acronimo =" PM";

             }
            
            ?>
            
                    <div class="accordion " id="accordionExample" style="background-color: #9ed1f3;">
                        <div class="accordion-item justify-content-center" style="background-color: #ffffff; height:40px; margin-top:1px;" >
                            <!-- <input type="hidden"  id =  "<? //echo  'OrdenID'.  $row->ordenPedidoID?>"    name  = "<? //echo  'OrdenID'.  $row->ordenPedidoID?>" value  ="<?php //echo  $row->ordenPedidoID?>"  > -->
                            <!-- <h2 class="accordion-header" id="headingOne" style="background-color: #ffffff;"> -->
                              
                                <button  type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" onclick="mostrarDetalleORden( <?php echo $row->ordenPedidoID?>);"
                                    style="background-color: #ffffff; color: #1e6fd9; font-weight: 500;  text-decoration: none; border-width:0px; width:75%;text-align:left;" >
                                    <?php echo  "Orden #".$row->ordenPedidoID ." Hora Pedido " . $row->hora. ":" . $row->minuto .  $acronimo. " ". $comentario ; ?>           
                                </button>
                              
                                  
                            <!-- </h2> -->
                            <input type="checkbox" name ='<?php echo "Anular" .$c ;?>'  id ='<?php echo "Anular" .$c ;?>' style="background-color: chocolate; width:40px; height:20px ;margin-top:8px;" onclick="despacharOrden(<?php echo $c ?>, <?php echo $row->ordenPedidoID?> );">  <span style="color:black">Despachar</span> 
                        
                        </div>   
                             
                    </div>
         
 <?php  $c+=1; }}?>
    </div>

