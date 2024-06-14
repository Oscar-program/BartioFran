<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class inventProducto_Model extends CI_Model{
 //   funcion que  identifica  si el  producto ya se  encuentra registrado en la  bodega que se esta  asignando 
 public function get_productoIDInventarios($productoID,$bodegaProductoID) {
    $query =  $this->db->select("prodinvent.*")
             ->where('prodinvent.productoID',$productoID)
             ->where('prodinvent.bodegaProductoID',$bodegaProductoID)
             ->get("inventarioproducto prodinvent")
             ->row();
    return  $query;          
  }
//  funcion para  insertar el  producto en la tabla de inventarios, para que este disponible para agrgar existencias  
    public function  addProductoInvent($data, $invProdID){
        if($invProdID ==   NULL){
            $this->db->insert("inventarioproducto",$data);
            return $this->db->insert_id();
        }
    } 
   //  funcion para actualizar  las existencia en   los   inventarios 
   public function  updateProductoInvent($data, $productoID,$bodegaProductoID){    
        $this->db->set("existenciaInvProd", $data["existenciaInvProd"])            
        ->where("productoID", $productoID)
        ->where("bodegaProductoID", $bodegaProductoID)        
        ->update("inventarioproducto");
     return $this->db->affected_rows();
     

   
} 



}