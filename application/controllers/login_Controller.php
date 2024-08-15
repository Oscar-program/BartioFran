<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class   login_Controller extends CI_Controller{
    public   function  __construct(){
         parent::__construct();
         $this->load->database();
         $this->load->model("usuarios_Model");
         $this->load->model('mesas_Model');
         $this->load->helper("path");    
        // $this->load->library('session');
    }

    //  funcion para  obtener los  datos del usuarios que se esta loguendo  
    public function validaUser(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        session_start();
       // $_SESSION["usuario"] = "";
        $userRerotno = "";
        $RetornaUser = 1;
        $usrLogin    =  (isset($_POST["user"]))?  $_POST["user"] : ""; // 'admin';
        $usrPwd      =  (isset($_POST["pwd"]))?  $_POST["pwd"] : ""; // 'Admin20241';
        //echo  'los  valores capturados son ' . $usrLogin . ' ' . $usrPwd   .  '<br>'  ;
        
        $datosUser   =  $this->usuarios_Model->getUserpwd($usrLogin, $usrPwd);
        if(empty($datosUser)){
            $RetornaUser = 0;
           // echo $RetornaUser ; 

            
        }else{
            $_SESSION["usuario"] = $datosUser->usrNombre; 
            $_SESSION["usrLogin"]=  $datosUser->usrLogin; 
             
            // echo 'la variable de  session contiene' . $_SESSION["usuario"] ; 
        }
        echo $RetornaUser ; 
      
    }
    // funcion para almacenar los  datos de usuarios  
    public function saveUser(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        session_start();
       
        $aes_key    ='xyz123';
        $Fullname   =  (isset($_POST["Fullname"]))?  $_POST["Fullname"] : "";
        $Email      =  (isset($_POST["Email"]))?  $_POST["Email"] : "";
        $niveluser  =  (isset($_POST["niveluser"]))?  $_POST["niveluser"] : "";
        $Password   = (isset($_POST["Password"]))?  $_POST["Password"] : "";

        $data  =  array(
            'usrNombre' =>$Fullname ,
            'usrLogin' => $Email,
            'usrPwd' =>$Password,
            
        );
       var_dump($data);
       $this->usuarios_Model->insert_user($data, $aes_key);

    }
}