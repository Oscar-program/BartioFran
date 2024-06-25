<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class mesas_Model extends CI_Model {
    //  funcion para listar las mesas  , esto funcionara para poder  agrear una o varias  ordenes a la   mesa 
     
    public function get_listmesas(){
        $query =  $this->db->select("mes.* ")
                    //->join('establecimientoempresa  est',  'bod.establecimientoID   =  est.establecimientoID', 'inner')
                   
                 ->where("mestatus",  1)
                 ->get("mesa  mes")
                 ->result();
        return  $query;          
    }

}