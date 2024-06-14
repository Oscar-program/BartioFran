<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class FamiliaProducto_Model extends CI_Model {
  
    // funcion para cargar las  categorias de los  productos  
    public function get_listFamiliaProducto() {
        $query =  $this->db->select("*")   
                 ->where("famProdStatus",  1)
                 ->get("familiaproducto")
                 ->result();
        return  $query;          
    }

    /*funcion para insert nueva medida de  producto */
    public function  addFamiliaProducto($data, $famProdID){
        if($famProdID ==   null){
            $this->db->insert("familiaproducto",$data);
            return $this->db->insert_id();
        }else{
            $this->db->set("famProdDescripcion", $data["famProdDescripcion"])
                    ->where("famProdID", $famProdID)
                    ->where("famProdStatus",  1)
                    ->update("familiaproducto");
            return $this->db->affected_rows();   
               
                }
    }

       
     // funcion para cargar la medida que  se  quiere  modificar  
    public function get_FamiliaProductoID($famProdID) {
        $query =  $this->db->select("*")   
                           ->where("famProdID",$famProdID)         
                           ->get("familiaproducto")
                           ->result();
        return  $query;          
    }

    /*Funcion para eliminar  una medida de  producto */
    public function delete_FamiliaProductoID($famProdID) {
        $this->db->where("famProdID",$famProdID)         
                 ->delete("familiaproducto");                 
        return  $this->db->affected_rows();          
    }


    



}
