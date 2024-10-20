<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include getcwd(). "/application/libraries/operacionInvnt/aes_encrypt.php";
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
      //  session_unset();
        session_destroy();
        session_start();
       // $_SESSION["usuario"] ="fhsdjfhjk";
        //$_SESSION['idDetCompra']='1';
        //$_SESSION["IdTempComprea"]= rand();
        //$_SESSION['detlistadecompra']=null;
        unset($_SESSION['detlistadecompra']);

        $aes_encrypt  =  new  aes_encrypt();
       // $_SESSION["usuario"] = "";
        $userRerotno       = "";
        $RetornaUser       = 1;
        $usrLogin          =  (isset($_POST["user"]))?  $_POST["user"] : ""; // 'admin';
        //$usrPwd      =  (isset($_POST["pwd"]))?  $_POST["pwd"] : ""; // 'Admin20241';
        $usrPwd            =  (isset($_POST["pwd"]))? $aes_encrypt->aes_encryptAcceso($_POST["pwd"] ,"encrypt"): ""; // 'Admin20241';
        $establecimientoID =  (isset($_POST["establecimientoID"]))?  $_POST["establecimientoID"] : ""; // 'admin';
        //$aes_encrypt->aes_encryptAcceso($_POST["Password"] ,"encrypt")
        //echo  'los  valores capturados son ' . $usrLogin . ' ' . $usrPwd   .  '<br>'  ;
        
        $datosUser   =  $this->usuarios_Model->getUserpwd($usrLogin, $usrPwd);
        if(empty($datosUser)){
            $RetornaUser = 0;
           // echo $RetornaUser ; 

            
        }else{
            $_SESSION["usuario"]           = $datosUser->usrNombre; 
            $_SESSION["usrLogin"]          = $datosUser->usrLogin; 
            $_SESSION["establecimientoID"] = $datosUser->establecimientoID; 
            $_SESSION["idDetCompra"]=1;
            $_SESSION["IdTempComprea"]= rand();
            $_SESSION["detlistadecompra"]= array();

             
            // echo 'la variable de  session contiene' . $_SESSION["usuario"] ; 
        }
        echo $RetornaUser ; 
      
    }
    //  segmento para  desemcrptar la clave de usuario  
    public function  desempcriptar(){
        $aes_encrypt  =  new  aes_encrypt();
        $datosUser  = $this->usuarios_Model->allUserSystem();

        foreach ($datosUser as $row) {

            echo  $row->usrLogin . ' '. $aes_encrypt->aes_encryptAcceso($row->usrPwd ,"decrypt") .  ' #'.  '<br>';

            # code...
        }

        //$aes_encrypt->aes_encryptAcceso($_POST["pwd"] ,"encrypt")

    }
    // funcion para almacenar los  datos de usuarios  
    public function saveUser(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        session_start();
        $aes_encrypt  =  new  aes_encrypt();
       
        $aes_key    ='xyz123';
        $Fullname   =  (isset($_POST["Fullname"]))?  $_POST["Fullname"] : "";
        $Email      =  (isset($_POST["Email"]))?  $_POST["Email"] : "";
        $niveluser  =  (isset($_POST["niveluser"]))?  $_POST["niveluser"] : "";
        $Password   = (isset($_POST["Password"]))?  $aes_encrypt->aes_encryptAcceso($_POST["Password"] ,"encrypt") : "";
        //"AES_ENCRYPT('{$data['usrPwd']}','{$aes_key}')", FALSE);

        $data  =  array(
            'usrNombre' =>$Fullname ,
            'usrLogin' => $Email,
            'usrPwd' => $Password,
            
        );
       // echo  'el valor del  nuevo password es '. $Password  ;
      // var_dump($data);
       $this->usuarios_Model->insert_user($data, $aes_key);

    }
}