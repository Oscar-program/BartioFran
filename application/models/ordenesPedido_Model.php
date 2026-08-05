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
         //echo  "llamando a funcion  agregar orden pedido" ;
        if($ordenPedidoID ==   null){
          //  ECHO  "INSERTANDO UNA NUEVA ORDEN DE PEDIDO  \n" ;
            $this->db->insert("ordenpedido",$data);
            return $this->db->insert_id();
        }else{
         //   ECHO  "actualizando  UNA NUEVA ORDEN DE PEDIDO  \n" . $ordenPedidoID  ;
           



            $this->db->set("ordPcomentario", $data["ordPcomentario"])
                    ->set("ordPCantidadPrd", $data["ordPCantidadPrd"])
                    ->set("ordPtotalcancelar", $data["ordPtotalcancelar"])
                    ->set("ordPAbono",         $data["ordPAbono"])
                    ->set("ordPAcobrar",       ($data["ordPtotalcancelar"] - $data["ordPAbono"]))
                    //->set("ordPpenditeCobro", $data["ordPpenditeCobro"])
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
                ->join('usuario  u',  'ordp.usuarioID = u.usuarioID ', 'inner')
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
        $query =  $this->db->select("msa.mesNombre,  u.usrNombre , detOr.detPedID, date_format( ord.ordPFecha,'%d-%m-%Y') as  ordPFecha,  detOr.ordenPedidoID, detOr.detcantidad, 
		prod.prodDescripcion, (detOr.detprecioNormal + detOr.detprecioEspecial)  preciounit, detOr.dettotal"
                                    )
                ->join('ordenpedido ord',  'detOr.ordenPedidoID =  ord.ordenPedidoID', 'inner')
                ->join('usuario u ',  'ord.usuarioID =  u.usuarioID', 'inner')
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
           //echo  "anulando la  orden de pedido " . $ordenID. "<br>" ;
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
  /*  public function  listaDetOrdenPendienteDespacho($ordenPedidoID){
         // echo  "llegando al  modelo  " . $ordenPedidoID ;

          // condicionamos  los datos a mostrar solo para cuado sea nivel usuario diferente de  1   mostrar  solo los productos de comedor 
           // -3 Boquitas,  4- platos,  10- tipicos
          // echo  "el nivel de usuario " . $_SESSION["nivelUsuaio"];
           if($_SESSION["nivelUsuaio"] = "2"){             
              $condicion  = "prod.famProdID = 3 or  prod.famProdID = 4 or   prod.famProdID  =  5";
              $this->db->where($condicion );
           }
            $this->db->distinct();
           $query =  $this->db->select(" prod.prodDescripcion , presen.presProdDescripcion as Presentacion,  pre.presentacionProd as tipo,  ped.detcantidad as catidad,  prod.famProdID")
                 ->join("producto prod", "prod.productoID =  ped.productoID", "inner")
                 ->join("presentacionproducto presen", "presen.presProdID = prod.presProdID", "inner")
                 ->join("nuevoestablo.presentacionprod pre", "pre.presProdID = prod.presProdID", "inner")
                 ->join("nuevoestablo.familiaproducto fam", "fam.famProdID = prod.famProdID", "left")
               
             

                ->where("ped.detstatus",  1)
                ->where("ped.ordenPedidoID",  $ordenPedidoID)
                ->get("detordenpedido ped")
                ->result();
        return  $query;     

   }*/

    public function listaOrdenesPendienteDespacho($mesaID){
           //   echo  $_SESSION["nivelUsuaio"] = "2" // es cocinero los demas usuarios podran ver lo que despacharon ;
           $condicion  = "";
         if($_SESSION["nivelUsuaio"] == "2"){             
              $condicion  = "prod.prodctucocina = 1" ; // "prod.famProdID = 3 or  prod.famProdID = 4 or   prod.famProdID  =  5";
              
           }else{
                $condicion  = "ped.despachar =  0 or ped.despachar =  1 ";
           }
  
     


        $this->db->distinct();         
        $query = $this->db->select("ordenp.mesaID,msa.mesNombre as mesa,   ordenp.ordenPedidoID, ordenp.ordPFecha, HOUR( ordenp.ordPFecha)  as hora, 
                                    MINUTE(ordenp.ordPFecha) as minuto,  
                                    upper(trim(ordenp.ordPcomentario)) as cliente, areEst.area,  ordenp.ordPpenditeDespacho, ordenp.ordPtotalcancelar, 
                                    prod.prodDescripcion , presen.presProdDescripcion as Presentacion,  pre.presentacionProd as tipo, 
                                    ped.detPedID ,ped.detcantidad as catidad,  prod.famProdID,  ped.dettotal, ped.cobrar,ped.despachar")                    
                      ->join('mesa as  msa',  ' msa.mesaID = ordenp.mesaID', 'inner')
                      ->join('areasestablecimiento areEst',  'areEst.areaEstablecimientoID =  msa.areaEstablecimientoID', 'inner')
                      ->join('detordenpedido ped',  ' ped.ordenPedidoID =  ordenp.ordenPedidoID', 'inner')
                      ->join('producto prod',  'prod.productoID =  ped.productoID', 'inner')
                      ->join('presentacionproducto presen',  'presen.presProdID = prod.presProdID', 'inner')
                      ->join('presentacionprod pre',  'pre.presProdID = prod.presProdID', 'inner')
                      ->join('familiaproducto fam',  'fam.famProdID = prod.famProdID', 'inner')

                    
                   
                 ->where("ordenp.mesaID",  $mesaID)
                 ->where(" ped.despachar",  0)
                   ->where("ped.detstatus",  1)
                    ->where("ordenp.ordPanulado",  0)
                   ->where($condicion )
                ->order_by("ordenp.ordPFecha", "DESC")
                 ->get("nuevoestablo.ordenpedido ordenp")
                 ->result();
        return  $query;

    }

    public function listaOrdenesPendienteCobro($mesaID){
   // echo  "mostrando los datos del  pedido" ;


        $this->db->distinct();         
        $query = $this->db->select("ordenp.mesaID,msa.mesNombre as mesa,   ordenp.ordenPedidoID, ordenp.ordPFecha, HOUR( ordenp.ordPFecha)  as hora, 
                                    MINUTE(ordenp.ordPFecha) as minuto,
                                    IF( LENGTH(ordenp.ordFechaVisto)> 0, CONCAT(
                                    TIMESTAMPDIFF( MINUTE, ordenp.ordPFecha,  ordenp.ordFechaVisto), 'MINUTOS TRASNCURRIDOS '), 'SIN ASIGNAR') AS minutos_transcurridos,
                                    upper(trim(ordenp.ordPcomentario)) as cliente, areEst.area,  ordenp.ordPpenditeDespacho,  ordenp.ordPAbono, ordenp.ordPAcobrar  as  ordPtotalcancelar, 
                                    prod.prodDescripcion , presen.presProdDescripcion as Presentacion,  pre.presentacionProd as tipo, 
                                    ped.detPedID ,ped.detcantidad as catidad,  prod.famProdID,  ped.dettotal, ped.cobrar,ped.despachar")                    
                      ->join('mesa as  msa',  ' msa.mesaID = ordenp.mesaID', 'inner')
                      ->join('areasestablecimiento areEst',  'areEst.areaEstablecimientoID =  msa.areaEstablecimientoID', 'inner')
                      ->join('detordenpedido ped',  ' ped.ordenPedidoID =  ordenp.ordenPedidoID', 'inner')
                      ->join('producto prod',  'prod.productoID =  ped.productoID', 'inner')
                      ->join('presentacionproducto presen',  'presen.presProdID = prod.presProdID', 'inner')
                      ->join('presentacionprod pre',  'pre.presProdID = prod.presProdID', 'inner')
                      ->join('familiaproducto fam',  'fam.famProdID = prod.famProdID', 'inner')

                    
                   
                 ->where("ordenp.mesaID",  $mesaID)
                 ->where(" ordenp.ordPpenditeCobro",  1)
                   ->where("ped.detstatus",  1)
                ->order_by("ordenp.ordPFecha", "DESC")
                 ->get("nuevoestablo.ordenpedido ordenp")
                 ->result();
        return  $query;

    }



   // funcion que pone como despachada una orden 
    //  funcion para anular  la orden de pedido  
    public function  despacharOrden($detPedID, $estado){
          //echo  "anulando la  orden de pedido".$ordenID.   "\n";
               $this->db->set("despachar", $estado) 
                 ->where("detPedID", $detPedID)
                 ->update("detordenpedido");
        return $this->db->affected_rows();  

    }

    // funcion para poner marca de cobro a  elemnto de la orden 
    // detordenpedido
        //despachar
        //cobrar
        // procesado

        public function  cobrarOrden($detPedID, $estado){
         // echo  "Cobrando en el model".$detPedID.   "\n";
               $this->db->set("cobrar", $estado) 
                 ->where("detPedID", $detPedID)
                 ->update("detordenpedido");
        return $this->db->affected_rows();  
       



    }
    // funcion suma todos lo detalles de la ordenes marcadas para cobrar  
    public function sumCobrar($ordenPedidoID){
        $query = $this->db->select("sum(dettotal) as sumas" )
          ->where("ordenPedidoID",  $ordenPedidoID)
         ->where("cobrar",  1)
         ->where("procesado",  0)
         ->get("detordenpedido")
         ->row();
         return $query ;
    }
    // funcionn marca como procesado todas las  ordenes 
    
        public function  procesarCobro($ordenPedidoID, $ordPtotalcancelar ){  
            
            // identificamos si no hay ningun elemento seleccionado 
           // echo  "poniendo procesados" ;     
               $this->db->set("procesado", 1) 
                         ->where("ordenPedidoID",  $ordenPedidoID)
                         //->where("cobrar",  1)
                         //->where("despachar",  1)                 
                 ->update("detordenpedido");
        // return $this->db->affected_rows();  
        // poenemos abonado toda la cabecesra del abono  ordPAbono
          $this->db->set("ordPAbono", $ordPtotalcancelar) 
                    ->set("ordPAcobrar", 0.0)
                     ->set("ordPpenditeDespacho", 0)
                     ->set("ordPpenditeCobro", 0)
                     
                         ->where("ordenPedidoID",  $ordenPedidoID)
                                        
                 ->update("ordenpedido");
                 return $this->db->affected_rows();  

        }

        // funcion para abonar  el  cobro de la orden 
    public function  abonarOrden($ordenPedidoID,  $ordPAbono, $ordPAcobrar){   
               $this->db->set("ordPAbono", $ordPAbono)
                          ->set("ordPAcobrar", $ordPAcobrar) 
               
                 ->where("ordenPedidoID", $ordenPedidoID)
                 ->update("ordenpedido");
        return $this->db->affected_rows();  

    }
    // funcion para  retornar los datos de la  cabecera del pedido 
    public function infoPedido($ordenPedidoID){
        $query = $this->db->select("*" )
          ->where("ordenPedidoID",  $ordenPedidoID)
         //->where("cobrar",  1)
        // ->where("procesado",  0)
         ->get("ordenpedido")
         ->row();
         return $query ;
    }

    // funcion mustra todas las ordenes cobradas  
    public function listaOrdenesProcesadas(){
   // echo  "mostrando los datos del  pedido" ;


        $this->db->distinct();         
        $query = $this->db->select("ordenp.mesaID,msa.mesNombre as mesa,   ordenp.ordenPedidoID, ordenp.ordPFecha, HOUR( ordenp.ordPFecha)  as hora, 
                                    MINUTE(ordenp.ordPFecha) as minuto,  
                                    upper(trim(ordenp.ordPcomentario)) as cliente, areEst.area,  ordenp.ordPpenditeDespacho,  ordenp.ordPAbono, ordenp.ordPAcobrar  as  ordPtotalcancelar, 
                                    prod.prodDescripcion , presen.presProdDescripcion as Presentacion,  pre.presentacionProd as tipo, 
                                    ped.detPedID ,ped.detcantidad as catidad,  prod.famProdID,  ped.dettotal, ped.cobrar,ped.despachar")
                      ->join('usuario as  u',  ' u.usuarioID = ordenp.usuarioID', 'inner') 
                      ->join('nivelusuario as  nlu',  ' nlu.nivelUsuarioID = u.nivelUsuarioID', 'inner')  

                      ->join('mesa as  msa',  ' msa.mesaID = ordenp.mesaID', 'inner')
                      ->join('areasestablecimiento areEst',  'areEst.areaEstablecimientoID =  msa.areaEstablecimientoID', 'inner')
                      ->join('detordenpedido ped',  ' ped.ordenPedidoID =  ordenp.ordenPedidoID', 'inner')
                      ->join('producto prod',  'prod.productoID =  ped.productoID', 'inner')
                      ->join('presentacionproducto presen',  'presen.presProdID = prod.presProdID', 'inner')
                      ->join('presentacionprod pre',  'pre.presProdID = prod.presProdID', 'inner')
                      ->join('familiaproducto fam',  'fam.famProdID = prod.famProdID', 'inner')

                    
                   
                 //->where("ordenp.mesaID",  $mesaID)
                 ->where(" ordenp.ordPpenditeCobro",  0)
                   ->where("ped.detstatus",  1)
                ->order_by("ordenp.ordPFecha", "DESC")
                 ->get("nuevoestablo.ordenpedido ordenp")
                 ->result();
        return  $query;

    }

    public function  procesarPedido($ordenPedidoID){
       // echo  "la orden a procesar es "    . $ordenPedidoID ;    
       date_default_timezone_set('America/El_Salvador');       
          $this->db->set("ordVisto", 1) 
                    ->set("ordFechaVisto", date("Y-m-d H:i:s"))
                    ->where("ordenPedidoID",  $ordenPedidoID)
                                        
                 ->update("ordenpedido");
                 return $this->db->affected_rows();  

        }
    
    





    // funcio para actualizar el abono 










  







}
