<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class configuracioProd_Controller extends CI_Controller {  
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
}