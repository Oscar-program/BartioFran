<?php  
defined('BASEPATH') or  exit('No direct script access allowed');

class Ordenes_Controller extends CI_Controller{
     public function __construct(){
        parent:: __construct();
        $this->load->database();
        $this->load->model('ordenesPedido_Model');
        $this->load->helper('path');
    }

    // listaDetOrdenPendienteDespacho($ordenPedidoID)
     public function listaDetOrdenPendienteDespacho(){
        //echo  "el id de orden para mostrar detalle es " + @$ordenPedidoID  ;

      $ordenPedidoIDCab = (isset($_POST['ordenPedidoIDCab']) &&  $_POST['ordenPedidoIDCab'] !=0) ? $_POST['ordenPedidoIDCab'] :  0;
       // echo  "el alor capturado es " . $ordenPedidoIDCab;
        $data['listaDespachoPendiente'] = $this->ordenesPedido_Model->listaDetOrdenPendienteDespacho($ordenPedidoIDCab);
        //var_dump($data['listaDespachoPendiente']);
        $this->load->view('ventas/detallePendienteDespacho',$data);

     }



}
?>