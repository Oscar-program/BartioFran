<?php
defined('BASEPATH') or  exit('No direct script access allowed');
class gastos_Controller extends CI_Controller{
    public function __construct(){
        parent:: __construct();
        $this->load->database();
        $this->load->model('bodegaProducto_Model');
        $this->load->model('gastos_Model');
        $this->load->helper('path');
    }

    //  funcion para mostrar la cabecera de los gastos
    public function  iniciargastos(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
         //echo  'llegando al controlador de ingreso de  gastos';
        // $datos["indicadorExistenciaProd"] =   $this->inventProducto_Model->indicadorExistenciaProd();
        //var_dump($this->datos["datosMArcas"]);
        $this->load->view("gastos/ingresarGastos"); 
        

    } 
    // funcion ára mostrar la  vista para  ingresar el detalle de la compra 
    public function  addDetgasto(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        // echo  'llegando al controlador de la MEDIDA del producto';
        // $datos["indicadorExistenciaProd"] =   $this->inventProducto_Model->indicadorExistenciaProd();
        //var_dump($this->datos["datosMArcas"]);
        $this->load->view("gastos/detGastos"); 
        

    } 


}