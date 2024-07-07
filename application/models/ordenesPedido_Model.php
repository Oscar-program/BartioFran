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
    public function  addDetOrdenPedido($data, $detPedID){
        if($detPedID ==   null){
           // echo   'llegando al   modelo para   insertar la orden de pedido';
            $this->db->insert("detordenpedido",$data);
            return $this->db->insert_id();
        }else{
            $this->db->set("bodProdDescripcion", $data["bodProdDescripcion"])
                    ->set("establecimientoID",  $data["establecimientoID"])
                    ->where("detPedID", $detPedID)
                    ->where("bodProdStatus",  1)
                    ->update("detordenpedido");
            return $this->db->affected_rows();   
               
                }
    }
    //   funcion para listar  el  detalle  de la orden de pedido del  cliente  
    public function get_listDetOrden($ordenPedidoID){
        $query =  $this->db->select("detOr.detPedID, detOr.ordenPedidoID, detOr.detcantidad, prod.prodDescripcion, detOr.dettotal")
                ->join('producto prod',  'detOr.productoID =  prod.productoID', 'inner')
                ->where("detOr.ordenPedidoID",  $ordenPedidoID) 
                ->where("detOr.detstatus",  1)
                ->get("detordenpedido detOr")
                ->result();
        return  $query;          
    }
    
    // funcion para  retornar la sumatoria del detalle de orde3n de producto 
    public function get_TotalDetOrden($ordenPedidoID){
        $query =  $this->db->select("sum(dettotal) as dettotal")
                //->join('producto prod',  'detOr.productoID =  prod.productoID', 'inner')
                ->where("detOr.ordenPedidoID",  $ordenPedidoID) 
                ->where("detOr.detstatus",  1)
                ->get("detordenpedido detOr")
                ->row();
        return  $query;          
    }

    // funcion que  muestra todas las  ordenes pendientes  de cobro 
    public function get_OrdenesPendientesCobro(){
        $query =  $this->db->select(" msa.mesNombre, ordp.ordenPedidoID, date_format(ordp.ordPFecha,  '%d-%m-%Y') as ordPFecha,   mesr.meserNombre,  ordp.ordPpenditeCobro ")
                ->join('mesero  mesr',  'ordp.meseroID = mesr.meseroID ', 'inner')
                ->join('mesa msa ',  'ordp.mesaID =  msa.mesaID', 'inner')
                //->where("ordp.mesaID",  $mesaID) 
                ->where("ordp.ordPpenditeCobro",  1)               
                ->where("ordp.ordPanulado",  0)
                ->get("ordenpedido ordp")
                ->result();
        return  $query;          
    }
    // funcion para  retornar los  datos con los  cuales  se  va  a emitir el  recibo  
    public function get_datosticket($ordenPedidoID){
        $query =  $this->db->select(" msa.mesNombre,  mro.meserNombre , detOr.detPedID,
                                      date_format( ord.ordPFecha,'%d-%m-%Y') as  ordPFecha,  
                                      detOr.ordenPedidoID, detOr.detcantidad, 
		                              prod.prodDescripcion, (detOr.detprecioNormal + detOr.detprecioEspecial)  preciounit, 
                                      detOr.dettotal"
                                    )
                ->join('ordenpedido ord',  'ordp.meseroID = mesr.meseroID ', 'inner')
                ->join('mesero mro ',  'ord.meseroID =  mro.meseroID', 'inner')
                ->join('mesa msa',  'ord.mesaID =  msa.mesaID', 'inner')
                ->join('producto prod',  'detOr.productoID =  prod.productoID', 'inner')                
                ->where("detOr.ordenPedidoID",  $ordenPedidoID)               
                ->where("detOr.detstatus",  1)
                ->get("detordenpedido detOr")
                ->result();
        return  $query;          
    }








}
