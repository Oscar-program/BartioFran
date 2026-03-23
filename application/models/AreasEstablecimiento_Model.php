<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class AreasEstablecimiento_Model extends CI_Model{

    // funcion para cargar las las bodegas de producto existentes
  
    public function get_listAreasEstablecimiento($establecimientoID){
        $query =  $this->db->select("*")
                  ->where("estado",  1)
                   ->where("establecimientoID",  $establecimientoID)
                 ->get("areasestablecimiento areas")
                 ->result();
        return  $query;          
    }
}