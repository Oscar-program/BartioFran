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
       
       session_destroy();
        session_start();       
        $aes_encrypt  =  new  aes_encrypt();    
        $userRerotno  = "";
        $RetornaUser  = 1;
        $usrLogin     =  (isset($_POST["user"]))?  $_POST["user"] : ""; 
        $establecimID =  (isset($_POST["establecimID"]))?  $_POST["establecimID"] : ""; 
        $usrPwd       =  (isset($_POST["pwd"]))? $aes_encrypt->aes_encryptAcceso($_POST["pwd"] ,"encrypt"): "";         
        $datosUser   =  $this->usuarios_Model->getUserpwd($usrLogin, $usrPwd);

        if(empty($datosUser)){
            $RetornaUser = 0;   
        }else{
            $_SESSION["usuario"]           = $datosUser->usrNombre; 
            $_SESSION["usrLogin"]          = $datosUser->usrLogin;
            $_SESSION["usuarioID"]         = $datosUser->usuarioID; 
            $_SESSION["empresaID"]         = $datosUser->empresaID; 
            $_SESSION["nivelUsuaio"]       = $datosUser->nivelUsuarioID;              
            
            $_SESSION["establecimientoID"] = $establecimID;
            $_SESSION["idDetCompra"]=1;
            $_SESSION["IdTempComprea"]= rand();
            $_SESSION["detlistadecompra"]= array();        }
       // echo   'el establecimiento  capturado es ' .  $_SESSION["establecimientoID"];
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
    }
    // funcion para almacenar los  datos de usuarios  
    public function saveUser(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        //session_start();
        $aes_encrypt  =  new  aes_encrypt();
       
        $aes_key       ='xyz123';
        $usuarioID     = (isset($_POST["usuarioID"])  and   strlen($_POST["usuarioID"])> 0) ?  $_POST["usuarioID"] : NULL;         
        $usrNombre     = (isset($_POST["Fullname"]))?  $_POST["Fullname"] : "";
        $usrLogin      = (isset($_POST["Email"]))?  $_POST["Email"] : "";
        $usrPwd        = (isset($_POST["Password"]))?  $aes_encrypt->aes_encryptAcceso($_POST["Password"] ,"encrypt") : "";
        $empresaID     = $_SESSION["empresaID"] ; //(isset($_POST["empresaID"]))?  $_POST["empresaID"] : "1"; 
        $nivelUsuarioID = (isset($_POST["niveluser"]))?  $_POST["niveluser"] : "";  
        $data  =  array(           
                        'usrNombre'      => $usrNombre,
                        'usrLogin'       => $usrLogin,
                        'usrPwd'         => $usrPwd,
                        'empresaID'      => $empresaID,
                        'nivelUsuarioID' => $nivelUsuarioID,
                        
                    );
       $this->usuarios_Model->insert_user($data, $usuarioID);

    }

    // funcion para listar los usuarios del sistema 
    function allUserSystem(){
    $datos['allUserSystem'] = $this->usuarios_Model->allUserSystem(); 
     $this->load->view('usuarios/listaUsuarios', $datos);

    }
}