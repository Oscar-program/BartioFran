<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 ini_set('display_errors',1);
   ini_set('display_startup_errors',1);
   error_reporting(E_ALL); 

class ConfEstablec_Controller extends CI_Controller {  
    public function __construct()
    {
           parent::__construct();     
           $this->load->database();                  
           $this->load->model('Producto_Model');
           $this->load->model('Proveedor_Model');
           $this->load->model('FamiliaProducto_Model');
           $this->load->model('TipoProducto_Model');
           $this->load->model('MedidaProducto_Model');
           $this->load->model('Marcas_Model');
           $this->load->model('PresentacioProducto_Model');  
           $this->load->model('equivalenteProducto_Model');             
           

           $this->load->helper('path');  
        
    }
     /*Funcio  para cargar las  congiraciones de los productos */
 public function setthingEstablecimineto(){
  //echo  "llegando al controlador " ;  
   //  cramos los set  de  datos para el  turno  y  la  familia de los productos existentes 
   //$datos['turnos']          = $this->FamiliaProducto_Model->get_listFamiliaProducto();
   //$datos['familiaProducto'] = $this->Producto_Model->get_turnooperacion();  

   //$datos['equivalentes']          = $this->equivalenteProducto_Model->get_listaEquivalentes();
   //var_dump($datos['equivalentes']);
   //$datos["listaProductos"] =   $this->Producto_Model->get_ListProducto(); 

   //  var_dump(  $datos['familiaProducto'] );

   $this->load->view('configuraciones/configEstablecimiento');


 }

}