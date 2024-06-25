  <?php 
  defined('BASEPATH') or exit('No direct script access allowed');
  class ordenesPedido_Model extends CI_Model{

    public function get_listBodegaProducto(){
        $query =  $this->db->select("bod.bodegaProductoID, bod.bodProdDescripcion , est.estNombre ")
                    ->join('establecimientoempresa  est',  'bod.establecimientoID   =  est.establecimientoID', 'inner')
                   
                 //->where("famProdStatus",  1)
                 ->get("bodegaproducto  bod")
                 ->result();
        return  $query;          
    }


    //funcion para insert nueva medida de  producto 
    public function  addOrdenPedido($data, $ordenPedidoID){
        if($ordenPedidoID ==   null){
            $this->db->insert("ordenpedido",$data);
            return $this->db->insert_id();
        }else{
            $this->db->set("ordPcomentario", $data["ordPcomentario"])
                    ->set("ordPCantidadPrd", $data["ordPCantidadPrd"])
                    ->set("ordPtotalcancelar", $data["ordPtotalcancelar"])
                    ->where("ordenPedidoID", $ordenPedidoID)
                    ->where("ordPanulado",  1)
                    ->update("ordenpedido");
            return $this->db->affected_rows();   
               
                }
    }
    // funcion para agregar el detalle de la orden  de pedido 
    public function  addDetOrdenPedido($data, $bodegaProductoID){
        if($bodegaProductoID ==   null){
            $this->db->insert("detordenpedido",$data);
            return $this->db->insert_id();
        }else{
            $this->db->set("bodProdDescripcion", $data["bodProdDescripcion"])
                    ->set("establecimientoID",  $data["establecimientoID"])
                    ->where("bodegaProductoID", $bodegaProductoID)
                    ->where("bodProdStatus",  1)
                    ->update("detordenpedido");
            return $this->db->affected_rows();   
               
                }
    }


}
