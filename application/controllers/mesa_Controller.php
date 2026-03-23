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
     public function listarMesas($areasEstablecimientoID){
        $data['listaMesas'] = $this->mesas_Model->get_listmesas($areasEstablecimientoID);
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
        $this->load->view('ordenes/ordenesPendientes',$data);

     }
 public function insertarMesaEstablecimiento(){
        $mesaID                   = (isset($_POST['mesaID']) && strlen($_POST['mesaID'])> 0 ) ? $_POST['mesaID']: NULL;   
        $establecimientoID        = (isset($_POST['establecimientoID'])) ? $_POST['establecimientoID']: NULL; 
        $areasEstablecimientoID   = (isset($_POST['areasEstablecimientoID'])) ? $_POST['areasEstablecimientoID']: NULL; 
        $mesNombre                = (isset($_POST['mesNombre'])) ? $_POST['mesNombre']: NULL;
        $mescapacidad             = (isset($_POST['mescapacidad'])) ? $_POST['mescapacidad']: NULL;
        
        $dataMesa = array('establecimientoID'=>$establecimientoID,
                          'areasEstablecimientoID'=>$areasEstablecimientoID,
                          'mesNombre'=>$mesNombre,
                          'mescapacidad'=>$mescapacidad,
                        );
      $this->mesas_Model->insertarMesaEstablecimiento($dataMesa, $mesaID);
 }

     


}