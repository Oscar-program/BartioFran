<?php  
defined('BASEPATH') or  exit('No direct script access allowed');
class AreasEstablecimiento_Controller extends CI_Controller{
    public function __construct(){
        parent:: __construct();
        $this->load->database();
        $this->load->model('AreasEstablecimiento_Model');
        $this->load->helper('path');
    }
     public function get_listAreasEstablecimiento($establecimientoID){
        // echo  "llegando al controlador" ;
        $data['listAreasEstablecimiento'] = $this->AreasEstablecimiento_Model->get_listAreasEstablecimiento($establecimientoID);
        // var_dump($data['listAreasEstablecimiento']);
        $this->load->view('mesas/listaAreasEstablecimiento',$data);

     }
}