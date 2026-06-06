<?php  
defined('BASEPATH') or  exit('No direct script access allowed');
 ini_set('display_errors',1);
 ini_set('display_startup_errors',1);
 error_reporting(E_ALL); 
 date_default_timezone_set('America/El_Salvador');  

class Ordenes_Controller extends CI_Controller{
     public function __construct(){
        parent:: __construct();
        $this->load->database();
        $this->load->model('ordenesPedido_Model');
        $this->load->model('mesas_Model'); 
        $this->load->helper('path');
    }

    //  1-  Muestra las mesas que  tiene ordenes pendientes de despacho  
    public function get_OrdenesPendientesDespachar(){   
      //echo  "Pendientes despachar " . "<br>" ;        
       $data['listaMesasPendientesCobro'] = $this->mesas_Model->listaMesasPendienteCobro();
       $this->load->view('ordenes/ordenesDespacho', $data);
    }
    
    // funcion muestra las ordenes pendientes de despacho 
    public function get_OrdenesPendientesCobro(){   
       //echo  "PendientesCobro " . "<br>" ;        
       $data['listaMesasPendientesCobro'] = $this->mesas_Model->listaMesasPendienteCobro();
       $this->load->view('ordenes/ordenesCobrar', $data);
    }




    // 2- muestra las  ordenes que estan pendientes de despacho agrupadas por numero de orden    
      public  function listaOrdenesPendienteDespacho(){
         //echo  "Detalle de ordenes Despacho" . "<br>" ;
         $mesaID =  (isset($_POST['mesaID']) AND  strlen($_POST['mesaID'])>0) ? $_POST['mesaID'] : "0" ; 
        // echo "la mesa para mostrar los despachos es " .  $mesaID ;
           $data['lstPendDespCabecera'] = $this->ordenesPedido_Model->listaOrdenesPendienteDespacho($mesaID);

         
         //$data['lstPendDespCabecera'] = $this->mesas_Model->listaOrdenesPendienteDespacho($mesaID);
        //var_dump($data['lstPendDespCabecera']);
         //echo "dibuja cabecera" . "<br>";          
         $this->load->view('ordenes/ordenesPendientDespachoCabecera',$data);
      }


       // funcion para  mostrar las ordenes Pendientes de cobro
        
      public  function listaOrdenesPendienteCobro(){
          //   echo  "Pendiente de cobro en funcion  " ;
         $mesaID =  (isset($_POST['mesaID']) AND  strlen($_POST['mesaID'])>0) ? $_POST['mesaID'] : "0" ;     
        // echo  "la mesa seleccionada es " .  $mesaID  ;  
        $data['lstPendDespCabecera'] = $this->ordenesPedido_Model->listaOrdenesPendienteCobro($mesaID);

        // $data['lstPendDespCabecera'] = $this->mesas_Model->listaOrdenesPendienteDespacho($mesaID);
         if(!empty($data['lstPendDespCabecera'])){
            $this->load->view('ordenes/ordenesPendienCobrar',$data);
         }else{
            echo "no se encontraron  datos " . "<br>";          
         }
         
        
      }






    // 3- lista el detalle interno de la lista de ordenes pendientes de despacho 
     public function listaDetOrdenPendienteDespacho(){   
           // echo  "el nivel de usuario " . $_SESSION["nivelUsuaio"];    
        $ordenPedidoIDCab = (isset($_POST['ordenPedidoIDCab']) &&  $_POST['ordenPedidoIDCab'] !=0) ? $_POST['ordenPedidoIDCab'] :  0;   
        $data['listaDespachoPendiente'] = $this->ordenesPedido_Model->listaDetOrdenPendienteDespacho($ordenPedidoIDCab);
        $this->load->view('ordenes/detallePendienteDespacho',$data);

     }
     // funcion para anular la orden de pedido 
       public function despacharOrden(){
          $detPedID =  (isset($_POST['detPedID']) AND  $_POST['detPedID']!=0) ? $_POST['detPedID'] : "0" ;
          $estado = (isset($_POST['estado']) AND  $_POST['estado']!=0) ? $_POST['estado'] : "0" ;

          echo  "el detalle del pedido a despachar es " . $detPedID  .  "Estyado"  . $estado;
          $result   =  $this->ordenesPedido_Model->despacharOrden($detPedID, $estado);
          echo   $result ;
       }
      
       // funcion para poner marca de cobrar a todos aquellos item marcados
       public function cobrarOrden(){
          $detPedID =  (isset($_POST['detPedID']) AND  $_POST['detPedID']!=0) ? $_POST['detPedID'] : "0" ; 
          $estado   = (isset($_POST['estado']) AND  $_POST['estado']!=0) ? $_POST['estado'] : "0" ;
          $ordenPedidoID  = (isset($_POST['ordenPedidoID']) AND  $_POST['ordenPedidoID']!=0) ? $_POST['ordenPedidoID'] : "0" ;
       //  echo  "El detalle a cobrar es " . $detPedID  ;   
          $this->ordenesPedido_Model->cobrarOrden($detPedID, $estado);
         //  echo  "Despues de cobrar " . $detPedID  ;  

          $dato = $this->ordenesPedido_Model->sumCobrar($ordenPedidoID);
          echo $dato->sumas ;

       }

       // funcion para abonar la ordenCabcera 

        public function abonarOrden(){
        // echo  "llegando al  controlador de abono  " ; 
         
          $ordPAbonoRealizar = (isset($_POST['ordPAbono']) AND  $_POST['ordPAbono']!=0) ? $_POST['ordPAbono'] :0;          
          $ordenPedidoID     = (isset($_POST['ordenPedidoID']) AND  $_POST['ordenPedidoID']!=0) ? $_POST['ordenPedidoID'] : 0 ;  
           // echo  "Los  datos antes del abono  " .  $ordenPedidoID  . "pendiente"  .    $ordPtotalcancelar  . "Abonado" .  $Abonado   ;

          $infoPedido        = $this->ordenesPedido_Model->infoPedido($ordenPedidoID) ;
        //  var_dump(  $infoPedido ) ;
          $ordPtotalcancelar = $infoPedido->ordPtotalcancelar;
          $Abonado           = $infoPedido->ordPAbono;
            //  echo  "Los  datos antes del abono  " .  $ordenPedidoID  . "pendiente"  .    $ordPtotalcancelar  . "Abonado" .  $Abonado   ;
        // echo  "Los  datos antes del abono  " .     $ordPtotalcancelar  . "Abonado" .  $Abonado   ;
          $ordPAbono         = ($Abonado + $ordPAbonoRealizar );
          $ordPAcobrar       = ($ordPtotalcancelar  - $ordPAbono ) ;

          $datos   = array('ordPtotalcancelar'=>$ordPtotalcancelar, 
                            'ordPAbono'=>$ordPAbono,
                             'ordPAcobrar'=>$ordPAcobrar) ;
          //var_dump($datos )   ;               
          



          $this->ordenesPedido_Model->abonarOrden($ordenPedidoID, $ordPAbono,   $ordPAcobrar);
        

       }

      public function listaOrdenesProcesadas(){
          $datos['listaOrdenesProcesadas']  =  $this->ordenesPedido_Model->listaOrdenesProcesadas(); 
          
      }
      public function procesarPedido($ordenPedidoID){
         $datos =  $this->ordenesPedido_Model->procesarPedido($ordenPedidoID); 

      }





      

     

     




}
?>