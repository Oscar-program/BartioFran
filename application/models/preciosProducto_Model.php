<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class  preciosProducto_Model extends CI_Model{

    public function lista_productoCostear() {
        $query =  $this->db->select("precprod.productoID, upper(prod.prodDescripcion)  as  prodDescripcion, sum(invprod.existenciaInvProd)  as  existencia, precprod.precioventa")
                  ->join("producto prod", "precprod.productoID  = prod.productoID","inner")
                  ->join("inventarioproducto invprod", "invprod.productoID  =  prod.productoID","inner")
                  ->group_by("prod.productoID")
                    //->where('prodprec.productoID',$productoID)               
                 ->get("precioproducto precprod")
                 ->result();
        return  $query;          
    }
    // funcio  que  identifica si e producto ya se encuentra  registrado en los  productos para asignar el precio  
    public function get_productoIDPrecios($productoID) {
        $query =  $this->db->select("prodprec.*")
                 ->where('prodprec.productoID',$productoID)
               
                 ->get("precioproducto prodprec")
                 ->row();
        return  $query;          
    }

    // funcion para insertar el productos en la lista de  productos para  asignar el precio      
     public function  addProductoPrec($data, $precProdID){
        if($precProdID ==   NULL){
            $this->db->insert("precioproducto",$data);
            return $this->db->insert_id();
        }
    } 
    //  funcion para actualizar el  precio de costo y precio de  venta fechactualizado
    public function  updateProductoPrec($data, $productoID){
        // Precio costo se registra cuando se ingresa compra de productos y se pone el del  comprobante del proveedor  

        if( $data["preciocosto"]>0){
            $this->db->set("preciocosto", $data["preciocosto"])            
            ->where("productoID", $productoID)
            ->where("precioProdStatus",  1)
            ->update("precioproducto");
         return $this->db->affected_rows();

        }else if ($data["precioventa"]>0){
            $this->db->set("precioventa", $data["precioventa"]) 
                     ->set("fechactualizado", $data["fechactualizado"])              
            ->where("productoID", $productoID)
            ->where("precioProdStatus",  1)
            ->update("precioproducto");
             return $this->db->affected_rows();
        }  

       
    } 



}