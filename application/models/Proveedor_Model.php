<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class Proveedor_Model extends CI_Model {
  
    // funcion para cargar las  categorias de los  productos  
    public function get_listaProveedores() {
        $query =  $this->db->select("*")   
                 ->get("proveedores")
                 ->result();
        return  $query;          
    }
    // funcion que retorna  la informacion general del proveedor , (Gran contribiyente, mediano y otros) (Gravados-excento-no sujetos)  
    public function  get_infoProveedor($proveedorID){
        $query =  $this->db->select("prov.proveedorID,  prov.provDescripcion,  clasf.clasfiscalID,  tipc.tipoContribID") 
                        ->join("clasificacion_fiscal clasf", "clasf.clasfiscalID =  prov.clasfiscalID","inner")
                        ->join("tipo_contribuyente tipc", "tipc.tipoContribID =  prov.tipoContribID","inner") 
                        ->where("proveedorID", $proveedorID)
                        ->get("proveedores prov")
                        ->result();
        return  $query;

    }

    


}