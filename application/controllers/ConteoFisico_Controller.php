<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);

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
       
        
        $data['listaProductos'] = $this->InvDiario_Model->get_ListProducto();
        $data['turnos']         = $this->Turnos_Model->get_listaTurnos();
        $data['bodegas']        = $this->BodegaProducto_Model->get_listBodegaProducto() ; // get_listBodegaProducto

        $this->load->view('conteofisico/conteoFisico',$data);
    }
    // funcion para almacenal el conteo fisco de productos
    public function  insertar_conteo(){
        //ini_set('display_errors',1);
        //ini_set('display_startup_errors',1);
        //error_reporting(E_ALL);
       $resultInsert   = 0;
       $insertaDetalle = 0; 
       // Codigos errores  
       /*
        200 =>exito
        404=> el servidor no puso encontrar el recurso solicitado
       */
    

       $conteoID     = (isset($_POST['conteoID']) &&  $_POST['conteoID']> 0)?  $_POST['conteoID']: null;
       $detConteoID = (isset($_POST['detConteoID']) &&  $_POST['detConteoID']> 0) ? $_POST['detConteoID']: null;

       //echo  "los datos de cabecera  en la nueva insercion son Conteo  " . $conteoID . "DetConteo" .  $detConteoID  ."<br>";

       // datos para el almacenaje de la cabecera
       if($conteoID> 0 ){
         $resultInsert =  $conteoID ;
       }

       if($resultInsert ==  0){
            $fecha             =  (isset($_REQUEST['fechaC']) && strlen($_REQUEST['fechaC']) > 0) ? $_REQUEST['fechaC'] : null; 
            $establecimientoID =   $_SESSION["establecimientoID"] ;
            $turnOperaID       =   (isset($_POST['turno']) && strlen($_POST['turno']) > 0) ? $_POST['turno'] : null; 
            $usuarioID         =   $_SESSION["usuarioID"]  ; 
            //echo 'antes de insertar la cabecera Fecha'. $fecha. 'as'.$_REQUEST['fechaC'].  'fdsd' . $establecimientoID .  'Turno' .$turnOperaID. '<br>';
            if(strlen($fecha)>0  && strlen($establecimientoID)> 0 &&   strlen($turnOperaID)>0  && $conteoID == null   ){
                       //echo 'antes de insertando cabecera' .  '<br>';
                  $dataEncConteo  = array('establecimientoID' =>$establecimientoID,
                                     'fecha '            =>$fecha,
                                     'turnOperaID'       =>$turnOperaID , 
                                     'usuarioID'         =>$usuarioID 
                                     );
                $resultInsert = $this->ConteoFisico_Model->insertar_conteo( $dataEncConteo, $conteoID);
                $conteoID     = $resultInsert;
             }

       }          
       if($resultInsert>0){
            $bodegaProductoID  =  (isset($_POST['bodega']) && strlen($_POST['bodega']) > 0) ? $_POST['bodega'] : null;
            $productoID        =  (isset($_POST['producto']) && strlen($_POST['producto']) > 0) ? $_POST['producto'] : null;   
            $tcierreant        =  (isset($_POST['tcierreant']) && strlen($_POST['tcierreant']) > 0) ? $_POST['tcierreant'] : null;
            $existenciaF       =  (isset($_POST['existenciaF']) && strlen($_POST['existenciaF']) > 0) ? $_POST['existenciaF'] : 0;  
            $aberia            =  (isset($_POST['aberia']) && strlen($_POST['aberia']) > 0) ? $_POST['aberia'] : 0;  '' ; 
            $refil             =  (isset($_POST['refil']) && strlen($_POST['refil']) > 0) ? $_POST['refil'] : 0;  
           // $stockf          =  (isset($_POST['stockf']) && strlen($_POST['stockf']) > 0) ? $_POST['stockf'] : null;
           $dataDetconteo  =  array('conteoID'        =>$conteoID,  
                                    'bodegaProductoID'=>$bodegaProductoID, 
                                    'productoID'      =>$productoID,  
                                    'tcierreant'      =>$tcierreant  ,
                                    'existenciaF'     =>$existenciaF,
                                    'aberia'          =>$aberia,
                                    'refil'           =>$refil
                                     );
           
        $insertaDetalle= $this->ConteoFisico_Model->insertar_detconteofisico($dataDetconteo, $detConteoID);
        $retorno  = array('nError'=>"200",  'msgError'=>"Resgistro almacenado con éxito", 'conteoID'=>$conteoID, 'detConteoID'=> 0 );  
       header("Content-Type: application/json");   
        echo  json_encode($retorno);


       }else{ 
           // echo "Error en la ejacucion" .  "<br>";
           
              $retorno  =array('nError'=>"404",  'msgError'=>"Surgio un error durante la ejecucion", 'conteoID'=>0, 'detConteoID'=> 0 );  
              header("Content-Type: application/json");
              echo  json_encode($retorno);
          
       } 
      

    }
    // funcion retona la lista de conteo fisico

    public function get_listaDetConteo($conteoID){
      //echo  "llegando al controldor" ;
      $data['listaDetConteo']        = $this->ConteoFisico_Model->get_listaDetConteo($conteoID) ; // get_listBodegaProducto
     // var_dump( $data['listaDetConteo'] );
       $this->load->view('conteofisico/detConteoFisico',$data);

    } 
    // funcion  lista los conteos fisicos  
   public function  get_listaConteo(){
    //echo  "llegando al controldor" ;
     $FechIncio             =  (isset($_REQUEST['FechIncio']) && strlen($_REQUEST['FechIncio']) > 0) ? $_REQUEST['FechIncio'] : null; 
     $FechFin               =  (isset($_REQUEST['FechFin']) && strlen($_REQUEST['FechFin']) > 0) ? $_REQUEST['FechFin'] : null; 
     //echo  "Enviando datos";       
      $data['listaConteo']        = $this->ConteoFisico_Model->get_listaConteo($FechIncio, $FechFin  ) ; // get_listBodegaProducto
      //var_dump( $data['listaConteo'] );
       $this->load->view('conteofisico/detListaconteo',$data);

   }

   public function get_DetConteoID() {
    //echo  "llegando al controlador  para cargar los datros del  conteo";
    $detConteoID = (isset($_REQUEST['detConteoID'])) ?$_REQUEST['detConteoID']:  null;
    $DetConteo      = $this->ConteoFisico_Model->get_DetConteoID($detConteoID) ; // get_listBodegaProducto
    echo  json_encode($DetConteo);

   }
   // funcion para eliminar el detalle del conteo 
   public function detDetalleConteoFisico($detConteoID) {
    // echo  "llegando a la funcion del controlador" ; 
    $result  = $this->ConteoFisico_Model->detDetalleConteoFisico($detConteoID) ;
    echo  $result ; 
   }
   //  funcion para actualizar el  detalle del  conteo  
   public function edit_DetConteoID($detConteoID) {
    //echo  "llegando al controlador  para cargar los datros del  conteo". $detConteoID . "<br>";
    //$detConteoID = (isset($_REQUEST['detConteoID'])) ?$_REQUEST['detConteoID']:  null;
    $DetConteo      = $this->ConteoFisico_Model->get_DetConteoID($detConteoID) ; // get_listBodegaProducto
    echo  json_encode($DetConteo);

   }

   // funcion para buscar el  conteo  realizado  y  poder modificarlo  

   



}
?>