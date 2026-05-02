<?php  
defined('BASEPATH') or  exit('No direct script access allowed');
class AreasEstablecimiento_Controller extends CI_Controller{
    public function __construct(){
        parent:: __construct();
        $this->load->database();
        $this->load->model('AreasEstablecimiento_Model');
        $this->load->helper('path');
    }
     public function get_listAreasEstablecimiento($establecimientoID){
        $data['listAreasEstablecimiento'] = $this->AreasEstablecimiento_Model->get_listAreasEstablecimiento($establecimientoID);       
        $this->load->view('mesas/listaAreasEstablecimiento',$data);

     }

     /* funcion listar todas las areas con su establecimiento */
    public function  get_listAllAreas(){          
        $data['listAllAreas'] = $this->AreasEstablecimiento_Model->get_listAllAreas();
        $this->load->view('mesas/listaAreasEstablecimiento',$data);
    }


    public function insertarAreaEstablecimiento(){
     $areaEstablecimientoID =  (isset($_REQUEST['areaEstablecimientoID'])   AND  strlen($_REQUEST['areaEstablecimientoID']) )   ? NULL ;
     $establecimientoID     =  (isset($_REQUEST['establecimientoID'])       AND  strlen($_REQUEST['establecimientoID']) )   ? '' ;
     $area                  =  (isset($_REQUEST['area'])                    AND  strlen($_REQUEST['area']) )   ? '' ;
     $data = array('establecimientoID'=>$establecimientoID, 
                    'area'=>$area,  
                    );
    $result= $this->AreasEstablecimiento_Model->insertarAreaEstablecimiento( $areaEstablecimientoID, $area);
    echo $result ;
    }

     // funcion para cargar la empresa que  se  quiere  modificar  
    public function get_AreaEstablecimientoPorID($areaEstablecimientoID) {
        $areaEstablecimientoID =  (isset($_REQUEST['areaEstablecimientoID'])   AND  strlen($_REQUEST['areaEstablecimientoID']) )   ? 0 ;
         $result= $this->AreasEstablecimiento_Model->get_AreaEstablecimientoPorID($areaEstablecimientoID);
         echo  json_encode($result);
    }

    /*Funcion para eliminar  una medida de  producto */
    public function delete_AreaEstablecimientoPorID($areaEstablecimientoID) {
        $areaEstablecimientoID =  (isset($_REQUEST['areaEstablecimientoID'])   AND  strlen($_REQUEST['areaEstablecimientoID']) )   ? 0 ;
        $result= $this->AreasEstablecimiento_Model->delete_AreaEstablecimientoPorID($areaEstablecimientoID);
        echo   $result ;     
    }

}