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

}