<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class   invProducto_Controller extends CI_Controller{
    public   function  __construct(){
         parent::__construct();
         $this->load->database();
         $this->load->model("inventProducto_Model");
         $this->load->helper("path");   
         }

        //   funcion para  mostra  el indicador del   inventario  
        public function  indicadorExistenciaProd(){
                ini_set('display_errors',1);
                ini_set('display_startup_errors',1);
                error_reporting(E_ALL);
           // echo  'llegando al controlador de la MEDIDA del producto';
            $datos["indicadorExistenciaProd"] =   $this->inventProducto_Model->indicadorExistenciaProd();
            //var_dump($this->datos["datosMArcas"]);
             $this->load->view("inventarios/indicadorExistencia", $datos); 

        } 
        //  segmento para procesar los inventarios manuales  
        

     
    }