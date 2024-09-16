<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class prodPresentacion_Model extends CI_Model{

    public function get_datoProdPresentacion($productoID, $presProdID){
        $query =  $this->db->select("*")
                            ->where("productoID",  $productoID)     
                            ->where("presProdID",  $presProdID)
                            ->get("prodpresentacion")
                            ->result();
return  $query; 
    }
}