<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class Proveedor_Model extends CI_Model {
  
    // funcion para cargar las  categorias de los  productos  
    public function get_listaProveedores() {
        $query =  $this->db->select("*")   
                 ->get("proveedor")
                 ->result();
        return  $query;          
    }

    


}