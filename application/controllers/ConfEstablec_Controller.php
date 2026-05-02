<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 ini_set('display_errors',1);
   ini_set('display_startup_errors',1);
   error_reporting(E_ALL); 

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
  /*cargamos los datos principales para los select  */
  $establecimientoID = 2 ;
   $data['datosEmpresa']          = $this->empresa_Model->listaEmpresas();
   $data['datosEstablecimientos'] = $this->Establecimiento_Model->listaEstablecimientos();
   $data['datosAreas']            = $this->AreasEstablecimiento_Model->get_listAreasEstablecimiento($establecimientoID);
   $this->load->view('confEmpresa/configEstablecimiento', $data);
 }

 /* funcion pra listar los establecimientos para mostrar el detalle  */

 public function listaEstablecimientos(){
      $data['datosEstablecimiento'] =      $this->Establecimiento_Model->listaEstablecimientos();
      $this->load->view('confEmpresa/detEstablecimiento', $data);
 }

 // funcion para inserta nuevo establecimiento  
 public function insertarEstablecimiento($establecimientoID, $data){
  $establecimientoID = (isset($_REQUEST['establecimientoID'])   AND  strlen($_REQUEST['establecimientoID']) )   ? NULL ;
  $estNombre         = (isset($_REQUEST['estNombre'])           AND  strlen($_REQUEST['estNombre']) )   ? '' ;
  $estDireccion      = (isset($_REQUEST['estDireccion'])        AND  strlen($_REQUEST['estDireccion']) )   ? '' ;
  $estTelefono       = (isset($_REQUEST['estTelefono'])         AND  strlen($_REQUEST['estTelefono']) )   ? '' ;
  $data  = array('estNombre'=>$estNombre,
                'estDireccion'=>$estDireccion,
                'estTelefono'=>$estTelefono,
                
                );


 $result = $this->Establecimiento_Model-insertarEstablecimiento($establecimientoID, $data);
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




}