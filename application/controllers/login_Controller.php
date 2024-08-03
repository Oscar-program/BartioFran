<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class   login_Controller extends CI_Controller{
    public   function  __construct(){
         parent::__construct();
         $this->load->database();
         $this->load->model("usuarios_Model");
         $this->load->helper("path");    
    }

    //  funcion para  obtener los  datos del usuarios que se esta loguendo  
    public function validarUsuario(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        $usrLogin = 'admin';
        $usrPwd   = 'Admin20241';
        $datos["datoMedidaPeProd"] =   $this->usuarios_Model->getUserpwd($usrLogin, $usrPwd);
        if(!empty( $datos["datoMedidaPeProd"])){
           echo  'Programar  ingreso al  sistema';
        }else{
            echo  'No se encontraron los datos del usuario';
        }
    }
}