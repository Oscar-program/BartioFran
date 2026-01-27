<?php  
defined('BASEPATH') or  exit('No direct script access allowed');
class mesa_Controller extends CI_Controller{
    public function __construct(){
        parent:: __construct();
        $this->load->database();
        $this->load->model('mesas_Model');
        $this->load->helper('path');
    }
    //   funcion para  mostrar las mesas en el menu  principal   para que se le   pueda  agregar  una  o  varias  ordenes
     public function listarMesas(){
        $data['listaMesas'] = $this->mesas_Model->get_listmesas();
        //var_dump($data['submenu']);
        //  $data['comandas'] = $this->Producto_Model->get_comandas();
        //$data['familia']  = $famProdID;
        //var_dump($data['comandas'] );
        $this->load->view('mesas/listaMesas',$data);
     }
     // funcion  que lista las mesas que tiene ordenes pendientes de cobro

     public function listaMesasPendienteCobro(){

         $data['listaMesasPendientesCobro'] = $this->mesas_Model->listaMesasPendienteCobro();
        //var_dump($data['submenu']);
        //  $data['comandas'] = $this->Producto_Model->get_comandas();
        //$data['familia']  = $famProdID;
        //var_dump($data['comandas'] );
        $this->load->view('mesas/ordenesPendientes',$data);

     }
     // muestra las  ordenes que estan pendientes de despacho  
      public  function listaOrdenesPendienteDespacho(){
         $mesaID=  (isset($_POST['mesaID']) AND  strlen($_POST['mesaID'])>0) ? $_POST['mesaID'] : "0" ;
          // echo  "la mesa capturada antes de la peticion es  " . $mesaID .  "\n" ;
         $data['lstPendDespCabecera'] = $this->mesas_Model->listaOrdenesPendienteDespacho($mesaID);
         //var_dump($data['listaOrdenesPendienteDespachoCabecera']);

         $this->load->view('ventas/ordenesPendientDespachoCabecera',$data);


      }


}