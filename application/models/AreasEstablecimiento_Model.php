<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class AreasEstablecimiento_Model extends CI_Model{

    /*listar todas las areas de los restablecimientos */
      public function get_listAllAreas(){
            $query =  $this->db->select("areaEst.*, estbl.estNombre as Estabñecimiento")
                 ->join('establecimientoempresa estbl','estbl.establecimientoID = areaEst.establecimientoID','inner')
                  ->where("areaEst.estado",  1)                
                 ->get("areasestablecimiento areaEst")
                 ->result();
        return  $query;   

      }

    // funcion para cargar las las bodegas de producto existentes
  
    public function get_listAreasEstablecimiento($establecimientoID){
        $query =  $this->db->select("*")
                  ->where("estado",  1)
                   ->where("establecimientoID",  $establecimientoID)
                 ->get("areasestablecimiento areas")
                 ->result();
        return  $query;          
    }

    public function insertarAreaEstablecimiento(){
        if($areaEstablecimientoID ==   NULL){
            $this->db->insert("establecimientoempresa",$data);
            return $this->db->insert_id();
        }else{           
            $this->db->set("establecimientoID", $data["establecimientoID"])
                     ->set("area", $data["area"])
                     ->where("areaEstablecimientoID", $areaEstablecimientoID)
                    ->update("areasestablecimiento");
            return $this->db->affected_rows();   
       }  
    }

     // funcion para cargar la empresa que  se  quiere  modificar  
    public function get_AreaEstablecimientoPorID($areaEstablecimientoID) {
        $query =  $this->db->select("*")   
                           ->where("areaEstablecimientoID",$areaEstablecimientoID)         
                           ->get("areasestablecimiento")
                           ->result();
        return  $query;          
    }

    /*Funcion para eliminar  una medida de  producto */
    public function delete_AreaEstablecimientoPorID($areaEstablecimientoID) {
        $this->db->where("areaEstablecimientoID",$areaEstablecimientoID)         
                 ->delete("areasestablecimiento");                 
        return  $this->db->affected_rows();          
    }

}