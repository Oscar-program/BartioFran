<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ConteoFisico_Controller extends CI_Controller{
    public function __construct()
    {
           parent::__construct();     
           $this->load->database();                  
           $this->load->model('Producto_Model');
            $this->load->model('InvDiario_Model');

           $this->load->model('ConteoFisico_Model');
           $this->load->model('BodegaProducto_Model');
           $this->load->model('Turnos_Model');
               

           $this->load->helper('path');  
        
    }   
    // funcion que muestra la vista principal del conteo fisico  
    public function capturaConteo(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        
        $data['listaProductos'] = $this->InvDiario_Model->get_ListProducto();
        $data['turnos']         = $this->Turnos_Model->get_listaTurnos();
        $data['bodegas']        = $this->BodegaProducto_Model->get_listBodegaProducto() ; // get_listBodegaProducto

        $this->load->view('inventarios/conteoFisico',$data);
    }
    // funcion para almacenal el conteo fisco de productos
    public function  insertar_conteo(){
       $resultInsert= 0;
       $insertaDetalle = false; 
       // datos para el almacenaje de la cabecera

       if($resultInsert ==  0){
            $fecha             =  (isset($_POST['fecha']) && strlen($_POST['fecha']) > 0) ? $_POST['fecha'] : null; 
            $establecimientoID =   $_SESSION["establecimientoID"] ;
            $turnOperaID       =   (isset($_POST[$fecha]) && strlen($_POST[$fecha]) > 0) ? $_POST[$fecha] : null; 
            $usuarioID         =   $_SESSION["usuarioID"]  ; 

            if(strlen($fecha)>0  && strlen($establecimientoID) &&   strlen($turnOperaID)>0  ){
                  $dataEncConteo  = array('establecimientoID' =>$establecimientoID,
                                     'fecha '            =>$fecha,
                                     'turnOperaID'       =>$turnOperaID , 
                                     'usuarioID'         =>$usuarioID 
                                     );

                $resultInsert= $this->ConteoFisico_Model->insertar_conteo( $dataEncConteo);
                $conteoID = $resultInsert;

             }

       }          
       if($resultInsert>0){
            $bodegaProductoID          =  (isset($_POST['bodega']) && strlen($_POST['bodega']) > 0) ? $_POST['bodega'] : null;
            $productoID        =  (isset($_POST['producto']) && strlen($_POST['producto']) > 0) ? $_POST['producto'] : null;   
            $tcierreant      =  (isset($_POST['tcierreant']) && strlen($_POST['tcierreant']) > 0) ? $_POST['tcierreant'] : null;
            $existenciaF     =  (isset($_POST['existenciaF']) && strlen($_POST['existenciaF']) > 0) ? $_POST['existenciaF'] : null;  
            $aberia          =  (isset($_POST['aberia']) && strlen($_POST['aberia']) > 0) ? $_POST['aberia'] : null;  '' ; 
            $refil           =  (isset($_POST['refil']) && strlen($_POST['refil']) > 0) ? $_POST['refil'] : null;  
           // $stockf          =  (isset($_POST['stockf']) && strlen($_POST['stockf']) > 0) ? $_POST['stockf'] : null;
           $dataDetconteo  =  array('conteoID'        =>$conteoID,  
                                    'bodegaProductoID'=>$bodegaProductoID, 
                                    'productoID'      =>$productoID,  
                                    'tcierreant'      =>$tcierreant  ,
                                    'existenciaF'     =>$existenciaF,
                                    'aberia'          =>$aberia,
                                    'refil'           =>$refil
                                     );

             if( $bodegaProductoID != null ){
                $resultInsert= $this->ConteoFisico_Model->insertar_detconteofisico( $dataDetconteo);
             }
             


       }
    

       //para detalle  

       


       
       $resultInsert= $this->ConteoFisico_Model->insertar_conteo();
       if($resultInsert>0){
        $resultInsert= $this->ConteoFisico_Model->insertar_detconteofisico();

       }

    }
   



}
?>