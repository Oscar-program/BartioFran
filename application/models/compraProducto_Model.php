<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class  compraProducto_Model  extends CI_Model{

    
    // funcion para mostrar todas las   compras   ingresadas 
    public function get_ListCompras(){
          //  echo  'el id de  compra es '.  $idCompra;
        $query =  $this->db->select("date_format(cmp.compProdFecha, '%d-%m-%Y') as fecha , prov.provDescripcion,
                                        (case
                                        when  cmp.comprobanteTipo = 1  then   'CCF'
                                        when  cmp.comprobanteTipo = 2  then   'FC' 
                                        when  cmp.comprobanteTipo = 3  then   'FEX' 
                                        else ''	
                                        end ) comprobanteTipo,
                                        cmp.comprobantenum , usr.usrNombre,
                                     cmp.compProdNoSujeto ,cmp.compProdIva, cmp.compProdTotal"
                                    )   
                        ->join('proveedor prov', 'cmp.proveedorID  =  prov.proveedorID', 'inner')
                        ->join('usuario usr', 'cmp.usuarioID =   usr.usuarioID', 'inner')                
                      // ->where("idCompra", $idCompra)
                       ->get("compraproducto as  cmp")
                       ->result();
        return  $query;          
    }


    //   funcion para  insertar la  cabecera de las compras 
    public function  addCabeceracompra($data, $compraProdID){
     
        if($compraProdID ==   NULL){
            echo  'Agregando la  cabecera de la  compra' . $compraProdID;
            $this->db->insert("compraproducto",$data);
            return $this->db->insert_id();
        }else{
            echo  'para  actualizar Cabecera de la compra';
            $this->db->set("empresaID",        $data["empresaID"])
                    ->set("establecimientoID", $data["precUnit"])
                    ->set("proveedorID",       $data["sub_total"])                     
                    ->set("comprobanteTipo",   $data["comprobanteTipo"])                    
                    ->set("comprobantenum",    $data["comprobantenum"])
                    ->set("usuarioID",         $data["usuarioID"])
                    ->set("compProdNoSujeto",  $data["compProdNoSujeto"])
                    ->set("compProdIva",       $data["compProdIva"])
                    ->set("compProdTotal",     $data["compProdTotal"]) 
                    ->where("compraProdID",    $compraProdID)
                    
                    ->update("compraproducto");
            return $this->db->affected_rows();   
            
        }

    }
    //  Creando el detalle de la  compra  
    public function  adddetcompra($data, $detCompraId){
      
        if($detCompraId==   NULL){
            echo  'Insertando el  item del  detalle de la compra ' . $detCompraId;
            $this->db->insert("compra_det_producto",$data);
            return $this->db->insert_id();
        }else{
            echo  'para  actualizar';
            $this->db->set("cantidad",     $data["cantidad"])
                    ->set("precUnit",      $data["precUnit"])
                    ->set("sub_total",     $data["sub_total"])                     
                    ->set("impuesto",      $data["impuesto"])
                    ->set("total",         $data["total"])
                    ->where("detCompraId", $detCompraId)
                    
                    ->update("compra_det_producto");
            return $this->db->affected_rows();   
            
                }

    }
      // Creando el movimiento de producto en el kardex 
     
      public function  addMoVKardex($data, $kardexProdID){      
        if($kardexProdID ==   NULL){
           // echo  'Insertando el  item del  KARDEX' . $kardexProdID;
            $this->db->insert("kardexproducto",$data);
            return $this->db->insert_id();
        }else{
            echo  'Actualizanod El Kardex';  
            $this->db->set("movtipo",         $data["movtipo"])
                    ->set("bodegaProductoID", $data["bodegaProductoID"])
                    ->set("productoID",       $data["productoID"])                     
                    ->set("entrada",          $data["entrada"])
                    ->set("precio_unit",      $data["precio_unit"])
                    ->set("subtotal",         $data["subtotal"])
                    ->set("impuesto",         $data["impuesto"])
                    ->set("total",             $data["total"])                   
                    ->where("kardexProdID", $kardexProdID)
                    
                    ->update("kardexproducto");
            return $this->db->affected_rows();   
            
                }

    }



    # segmento para controlar los  movimiento en la tabla tempora de detalle de compra  
        /*funcion para insertar   datos en la tabla temporal*/
        public function  addtmpdetcompra($data, $idtmp){
            echo  'el valor temp es ' . $idtmp;
            if($idtmp ==   null){
                $this->db->insert("tmpdetcompra",$data);
                return $this->db->insert_id();
            }else{
                echo  'para  actualizar';
                $this->db->set("cantidad", $data["cantidad"])
                        ->set("precUnit", $data["precUnit"])
                        ->set("sub_total", $data["sub_total"])                     
                        ->set("impuesto", $data["impuesto"])
                        ->set("total",    $data["total"])
                        ->where("idtmp", $idtmp)
                        
                        ->update("tmpdetcompra");
                return $this->db->affected_rows();   
                
                    }

        }
        // funcion para mostrar los productos  registrados de  forma temporal en las compras
        public function get_ListTmp($idCompra) {
                echo  'el id de  compra es '.  $idCompra;
            $query =  $this->db->select("tmp.*")   
                    
                    ->where("idCompra", $idCompra)
                    ->get("tmpdetcompra tmp")
                    ->result();
            return  $query;          
        }  

         //  funcion para calcular el total del comprobante de  compra 
        public function get_sumastotaltmp($idCompra) {       
            $query =  $this->db->select("sum(tmp.sub_total) as  sumas , sum(tmp.impuesto) as  impuestos, sum(tmp.total) as  totalcompra ")   
                    
                    ->where("tmp.idCompra", $idCompra)
                    ->group_by("tmp.idCompra")
                    ->get("tmpdetcompra tmp")
                    ->row();
            return  $query;          
        }  

    # fin de segmento para controlar los  movimiento en la tabla tempora de detalle de compra   


}