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
            echo  'INSERTANDO EN EL   INVENTARIO';
            $this->db->insert("inventarioproducto",$data);
            return $this->db->insert_id();
        }else{
            echo  'ACTUALIZANDO EN EL   INVENTARIO';
            $this->db->set("existenciaInvProd", $data["existenciaInvProd"])            
                ->where("productoID", $data["productoID"] )
                ->where("bodegaProductoID", $data["bodegaProductoID"])        
                ->update("inventarioproducto");
            return $this->db->affected_rows();
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

    // funcion para  identificar la existncia de producto en bodega selaccionada  
    public function  chekStockProduct($productoID,$bodegaProductoID){    
        $query =  $this->db->select("invent.existenciaInvProd as  existencia")
             ->where('invent.productoID',$productoID)
             ->where('invent.bodegaProductoID',$bodegaProductoID)
             ->get("inventarioproducto invent")
             ->row();
    return  $query;      
     

   
    } 
    //   consulta  para   obtner  el  indicador de  existencia de productos  

    public function  indicadorExistenciaProd(){    
        $query =  $this->db->select(" inv.productoID,  prod.prodDescripcion, bodp.bodProdDescripcion, inv.existenciaInvProd")
          ->join("producto prod", "prod.productoID = inv.productoID", "inner")
          ->join("bodegaproducto bodp", "bodp.bodegaProductoID  =   inv.bodegaProductoID", "inner")           
          ->get("inventarioproducto  inv")
          ->result();
        return  $query;      
     

   
    } 



}