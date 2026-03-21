<?php  
defined('BASEPATH') or  exit('No direct script access allowed');
 ini_set('display_errors',1);
 ini_set('display_startup_errors',1);
 error_reporting(E_ALL); 

class Ordenes_Controller extends CI_Controller{
     public function __construct(){
        parent:: __construct();
        $this->load->database();
        $this->load->model('ordenesPedido_Model');
        $this->load->model('mesas_Model'); 
        $this->load->helper('path');
    }

    //  1-  Muestra las mesas que  tiene ordenes pendientes de despacho  
    public function get_OrdenesPendientesCobro(){           
       $data['listaMesasPendientesCobro'] = $this->mesas_Model->listaMesasPendienteCobro();
       $this->load->view('ordenes/ordenesDespacho', $data);
    }

    // 2- muestra las  ordenes que estan pendientes de despacho agrupadas por numero de orden    
      public  function listaOrdenesPendienteDespacho(){
         $mesaID =  (isset($_POST['mesaID']) AND  strlen($_POST['mesaID'])>0) ? $_POST['mesaID'] : "0" ;        
         $data['lstPendDespCabecera'] = $this->mesas_Model->listaOrdenesPendienteDespacho($mesaID);        
         $this->load->view('ordenes/ordenesPendientDespachoCabecera',$data);
      }
    // 3- lista el detalle interno de la lista de ordenes pendientes de despacho 
     public function listaDetOrdenPendienteDespacho(){       
        $ordenPedidoIDCab = (isset($_POST['ordenPedidoIDCab']) &&  $_POST['ordenPedidoIDCab'] !=0) ? $_POST['ordenPedidoIDCab'] :  0;   
        $data['listaDespachoPendiente'] = $this->ordenesPedido_Model->listaDetOrdenPendienteDespacho($ordenPedidoIDCab);
        $this->load->view('ordenes/detallePendienteDespacho',$data);

     }
     // funcion para anular la orden de pedido 
       public function despacharOrden(){
          $ordenID =  (isset($_POST['ordenID']) AND  $_POST['ordenID']!=0) ? $_POST['ordenID'] : "0" ;     
         // echo  "La orden a DEspachar  es " .  $ordenID  ;
          $this->ordenesPedido_Model->despacharOrden($ordenID);
       }
     

     




}
?>