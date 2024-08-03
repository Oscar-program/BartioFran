<?php
class operacionesInvenatarios{
    function actualizarInventario($productoID, $movtipo,$bodegaOrigen, $bodegaDest ,$cantidad){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        /*
            Tipos de  movimientos sobre  un inventario
            'COMP'   =======> copra de producto 
            "TRASL"  =======> traslado de producto 
            "VENT"   =======> venta de producto 
            "AJUST"  =======> ajuste de producto
        */

        $CI = & get_instance();
        $CI->load->model('inventProducto_Model');
        
        $invProdID      =  0;
        $entradaInvProd =  0; 
        $salidaInvProd  =  0; 
        $existencia     =  0;  

        // echo 'SE INSERTARON OPREACINES EN  EL  KARDEZ' .  '<br>';
        $resulbInv = $this->inventProducto_Model->get_productoIDInventarios($productoID,$bodegaDest);        
        if(Empty($resulbInv)){
            // indica que  se creara la  linea del   inventario 
            $invProdID = NULL;
        }else{
            $invProdID      =  $resulbInv->invProdID;
            $entradaInvProd =  $resulbInv->entradaInvProd; 
            $salidaInvProd  =  $resulbInv->salidaInvProd; 
            $existencia     =  $resulbInv->existencia;   
         } 

       
                if($movtipo == "COMP"){
                    $data =array('productoID'      =>$productoID ,  
                    'bodegaProductoID' =>$bodegaDest,  
                    'entradaInvProd'   => $entradaInvProd + $cantidad, 
                    'salidaInvProd'   =>$salidaInvProd,
                    'usuarioID'        =>1,
                    'existenciaInvProd'=>$existencia , 
                    );

                }else if($movtipo == "TRASL"){

                }else if($movtipo == "VENT"){

                }else if($movtipo == "AJUST"){

                }
       

        if(Empty($resulbInv)){
          // indica que  se creara la  linea del   inventario 
          $invProdID = NULL;
        }else{
          $invProdID =  $resulbInv->invProdID;

        }  
       /* invProdFecha
        productoID
        bodegaProductoID
        usuarioID
        inicialInvProd
        entradaInvProd
        salidaInvProd
        existenciaInvProd*/
          echo 'SE EXTRAJERON PRODUCTOS DEL  INVENTARIO' .  '<br>';
          $data =array('productoID'      =>$productoID ,  
                      'bodegaProductoID' =>$bodegaDest,  
                      'entradaInvProd'   =>$cantidad, 
                      'usuarioID'        =>1,
                      'existenciaInvProd'=>0
                      );
                      /*$data =array('productoID'      =>$productoID ,  
                      'bodegaProductoID' =>$bodegaDest,                       
                      'usuarioID'        =>1,
                      
                      );*/
           
                      var_dump($data);

          $this->inventProducto_Model->addProductoInvent($data, $invProdID);
      


    }

}  
?>