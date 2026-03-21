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
          //  ECHO  "INSERTANDO UNA NUEVA ORDEN DE PEDIDO  \n" ;
            $this->db->insert("ordenpedido",$data);
            return $this->db->insert_id();
        }else{
            // ECHO  "actualizando  UNA NUEVA ORDEN DE PEDIDO  \n" ;
            $this->db->set("ordPcomentario", $data["ordPcomentario"])
                    ->set("ordPCantidadPrd", $data["ordPCantidadPrd"])
                    ->set("ordPtotalcancelar", $data["ordPtotalcancelar"])
                    ->set("ordPpenditeCobro", $data["ordPpenditeCobro"])
                    ->where("ordenPedidoID", $ordenPedidoID)
                    ->where("ordPanulado",  0)
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
            $this->db->set("detcantidad", $data["detcantidad"])
                    ->set("detprecioNormal",  $data["detprecioNormal"])
                    ->set("dettotal",  $data["dettotal"])
                    

                    ->where("detPedID", $detPedID)
                    ->where("detstatus",  1)
                    ->update("detordenpedido");
            return $this->db->affected_rows();   
               
                }
    }
    //   funcion para listar  el  detalle  de la orden de pedido del  cliente  
    public function get_listDetOrden($ordenPedidoID){
        //  echo  "la orden del pedido es  " . $ordenPedidoID ;
        $query =  $this->db->select("detOr.detPedID, detOr.ordenPedidoID, detOr.productoID, detOr.detprecioNormal, detOr.detcantidad, prod.prodDescripcion, detOr.dettotal, prod.famProdID")
                           ->join('producto prod',  'detOr.productoID =  prod.productoID', 'inner')        
                           ->join('ordenpedido ordp',  'detOr.ordenPedidoID =  ordp.ordenPedidoID', 'inner')
                ->where("detOr.ordenPedidoID",  $ordenPedidoID) 
                 ->where("ordp.ordPanulado",  0)
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
        $query =  $this->db->select("msa.mesNombre,  mro.meserNombre , detOr.detPedID, date_format( ord.ordPFecha,'%d-%m-%Y') as  ordPFecha,  detOr.ordenPedidoID, detOr.detcantidad, 
		prod.prodDescripcion, (detOr.detprecioNormal + detOr.detprecioEspecial)  preciounit, detOr.dettotal"
                                    )
                ->join('ordenpedido ord',  'detOr.ordenPedidoID =  ord.ordenPedidoID', 'inner')
                ->join('mesero mro ',  'ord.meseroID =  mro.meseroID', 'inner')
                ->join('mesa msa',  'ord.mesaID =  msa.mesaID', 'inner')
                ->join('producto prod',  'detOr.productoID =  prod.productoID', 'inner')                
                ->where("detOr.ordenPedidoID",  $ordenPedidoID)               
                ->where("detOr.detstatus",  1)
                ->get("detordenpedido detOr")
                ->result();
        return  $query;          
    }
    //  funcion para obtener los  totales de los  productos  de la  venta 
    public function get_TotalVenta($ordenPedidoID){
        $query =  $this->db->select("sum(detOr.detcantidad) as cantProd, sum(detOr.dettotal) as ventatotal")
                //->join('producto prod',  'detOr.productoID =  prod.productoID', 'inner')
                ->where("detOr.ordenPedidoID",  $ordenPedidoID) 
                ->where("detOr.detstatus",  1)
                ->get("detordenpedido detOr")
                ->row();
        return  $query;          
    
    }
    // funcion para  eliminar elemento del detalle de  la orden de pedido  
    public function deleteDetOrdenPedido($marcProdID) {
        $this->db->where("marcProdID",$marcProdID)         
                 ->delete("detordenpedido");                 
        return  $this->db->affected_rows();          
    }
    // funcion para  obtener  el detalla de la orden de pedido  
    public function get_DetOrden($detPedID){
        $query =  $this->db->select("detor.*, fam.famProdID, prod.prodDescripcion")
                 ->join("producto  prod", "prod.productoID =  detor.productoID", "inner")
                 ->join("familiaproducto fam", "fam.famProdID = prod.famProdID", "inner")
                ->where("detOr.detstatus",  1)
                ->where("detOr.detPedID",  $detPedID)
                ->get("detordenpedido detOr")
                ->row();
        return  $query;          
    }
    //  funcion para anular  la orden de pedido  
    public function  anularOrden($ordenID){
          // echo  "anulando la  orden de pedido   \n";
               $this->db->set("ordPanulado", 1) 
                 ->where("ordenPedidoID", $ordenID)
                 ->update("ordenpedido");
        return $this->db->affected_rows();  

    }
   // funcion para eliminar el detalle de la venta 
   public function  anularDetOrden($detPedID){
     // echo  "eliminando la orden de pedido   \n";
               $this->db->where("detPedID", $detPedID)
                 ->delete("detordenpedido");
        return $this->db->affected_rows();  

   }
   // funcion para  mostrar el detalle de la orden pendiente de despacho  
    public function  listaDetOrdenPendienteDespacho($ordenPedidoID){
         // echo  "llegando al  modelo  " . $ordenPedidoID ;
     $query =  $this->db->select(" prod.prodDescripcion , presen.presProdDescripcion as Presentacion,  pre.presentacionProd as tipo,  ped.detcantidad as catidad")
                 ->join("producto prod", "prod.productoID =  ped.productoID", "inner")
                 ->join("presentacionproducto presen", "presen.presProdID = prod.presProdID", "inner")
                 ->join(" nuevoestablo.presentacionprod pre", "pre.presProdID = prod.presProdID", "inner")
                ->where("ped.detstatus",  1)
                ->where("ped.ordenPedidoID",  $ordenPedidoID)
                ->get("detordenpedido ped")
                ->result();
        return  $query;     

   }
   // funcion que pone como despachada una orden 
    //  funcion para anular  la orden de pedido  
    public function  despacharOrden($ordenID){
          //echo  "anulando la  orden de pedido".$ordenID.   "\n";
               $this->db->set("ordPpenditeDespacho", 0) 
                 ->where("ordenPedidoID", $ordenID)
                 ->update("ordenpedido");
        return $this->db->affected_rows();  

    }




  







}
