<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class ConfEstablec_Controller extends CI_Controller {  
    public function __construct()
    {
           parent::__construct();     
           $this->load->database();   
           $this->load->model('empresa_Model');  
           $this->load->model('Establecimiento_Model'); 
           $this->load->model('AreasEstablecimiento_Model');
           $this->load->model('mesas_Model');
           $this->load->helper('path');  
        
    }
     /*Funcio  para cargar las  congiraciones de los productos */
 public function setthingEstablecimineto(){
   //$establecimientoID = 2 ;
  /*cargamos los datos principales para los select  */
 
   $data['datosEmpresa']          = $this->empresa_Model->listaEmpresas();
   $data['datosEstablecimientos'] = $this->Establecimiento_Model->listaEstablecimientos();
   $data['datosAreas']            = $this->AreasEstablecimiento_Model->get_listAllAreas();
 //  var_dump( $data['datosAreas']) ;
   $this->load->view('confEmpresa/configEstablecimiento', $data);
 }

 /* funcion pra listar los establecimientos para mostrar el detalle  */

 public function listaEstablecimientos(){
      $data['datosEstablecimiento'] =      $this->Establecimiento_Model->listaEstablecimientos();
      $this->load->view('confEmpresa/detEstablecimiento', $data);
 }

 // funcion para inserta nuevo establecimiento  
 public function insertarEstablecimiento(){
  echo  "llegando al controlador" ; 

  $establecimientoID = (isset($_REQUEST['establecimientoID'])   AND  strlen($_REQUEST['establecimientoID'])>0 )   ? $_REQUEST['establecimientoID']  : NULL;
  $estNombre         = (isset($_REQUEST['estNombre'])           AND  strlen($_REQUEST['estNombre']) > 0 )   ? $_REQUEST['estNombre'] : '' ;
  $estDireccion      = (isset($_REQUEST['estDireccion'])        AND  strlen($_REQUEST['estDireccion'])>0 )   ? $_REQUEST['estDireccion'] : '' ;
  $estTelefono       = (isset($_REQUEST['estTelefono'])         AND  strlen($_REQUEST['estTelefono'])>0 )   ? $_REQUEST['estTelefono']  :'' ;
  $data  = array( 'establecimientoID'=>$establecimientoID,
                 'estNombre'=>$estNombre,
                'estDireccion'=>$estDireccion,
                'estTelefono'=>$estTelefono,
                
                );

var_dump($data) ;

 $result = $this->Establecimiento_Model->insertarEstablecimiento($establecimientoID, $data);
 echo  $result ;



 }
public function get_EstablecimientoPorID($establecimientoID){
   $result = $this->Establecimiento_Model->get_EstablecimientoPorID($establecimientoID) ;
      echo  json_encode($result);


}

  public function delete_EstablecimientoPorID($establecimientoID){
      $result =  $this->Establecimiento_Model->delete_EstablecimientoPorID($establecimientoID);
      echo  $result;

  }

    /* funcion listar todas las areas con su establecimiento */
 

  public function  listarMesasArea(){
    $data['listMesas'] = $this->mesas_Model->get_listAllmesas();
       // var_dump($data['listAllAreas']) ;
        $this->load->view('confEmpresa/detMesas',$data);
  }
  public function registraNewMesa(){
   // echo  "llegando al controlador para  registrar nueva mesa " ; 


    $mesaID              = (isset($_REQUEST['mesaID'])       AND  strlen($_REQUEST['mesaID'])> 0 )   ? $_REQUEST['mesaID']  : NULL;
    $establecimientoID    = (isset($_REQUEST['SEstablecimiento'])       AND  $_REQUEST['SEstablecimiento'] !=0 )   ? $_REQUEST['SEstablecimiento']  : NULL;
    $areaEstablecimientoID               = (isset($_REQUEST['SArea'])   AND  $_REQUEST['SArea'] !=0 )   ? $_REQUEST['SArea'] : '' ;
    $mesNombre             = (isset($_REQUEST['txtmesa'])                     AND  strlen($_REQUEST['txtmesa'])>0 )   ? $_REQUEST['txtmesa'] : '' ;
    $mescapacidad        = (isset($_REQUEST['txtcapacidad'])                AND  strlen($_REQUEST['txtcapacidad'])>0 )   ? $_REQUEST['txtcapacidad']  :'' ;
    $data  = array( 'mesaID'=>$mesaID,
      'establecimientoID'=>$establecimientoID,
                 'areaEstablecimientoID'=>$areaEstablecimientoID,
                'mesNombre'=>$mesNombre,
                'mescapacidad'=>$mescapacidad,
                
                );

   //var_dump($data) ;
   //exit ;

 $result = $this->mesas_Model->insertarMesaEstablecimiento($data, $mesaID);
 echo  $result ;


  }
  // funcion para  registrar   nueva area del establecimiento  
  public function registrarAreaEstb(){
    echo  "almacenando el  area del establecimiento " ; 

    $areasEstablecimientoID = (isset($_REQUEST['SEstab'])       AND  strlen($_REQUEST['SEstab'] )>0 )   ? $_REQUEST['SEstab']  : NULL; 

     $SEstab     = (isset($_REQUEST['SEstab'])       AND  $_REQUEST['SEstab'] !=0 )   ? $_REQUEST['SEstab']  : NULL;
    $Area               = (isset($_REQUEST['Area'])   AND  $_REQUEST['Area'] !=0 )   ? $_REQUEST['Area'] : '' ;
     $data  = array( 'SEstablecimiento'=>$SEstablecimiento,
                 'SArea'=>$SArea,
                'txtmesa'=>$txtmesa,
                'txtcapacidad'=>$txtcapacidad,
                
                );

                




  }





}