<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class mesas_Model extends CI_Model {
    //  funcion para listar las mesas  , esto funcionara para poder  agrear una o varias  ordenes a la   mesa 
     
    public function get_listmesas($areaEstablecimientoID){
        $query =  $this->db->select("mes.* ")
                    //->join('establecimientoempresa  est',  'bod.establecimientoID   =  est.establecimientoID', 'inner')
                   ->where("mestatus",  1) 
                 ->where("areaEstablecimientoID",  $areaEstablecimientoID)
                 ->get("mesa  mes")
                 ->result();
        return  $query;          
    }
    // funcion que muestra las mesas que tienen  ordenes pendientes de cobro  
    public function listaMesasPendienteCobro(){
        //  echo  "llegando al modelo" . "<br>" ;
       //  $this->db->distinct();         
        $query = $this->db->select("msa.mesaID, msa.mesNombre ")
                    ->join('ordenpedido as  ordenp',  'ordenp.mesaID = msa.mesaID', 'inner')
                     ->join('detordenpedido dt',  'dt.ordenPedidoID =  ordenp. ordenPedidoID', 'inner')
                   
                 ->where("ordenp.ordPpenditeDespacho",  1)
                 ->group_by("msa.mesaID")
                ->order_by("ordenp.ordPFecha", "DESC")
                 ->get("mesa as  msa")
                 ->result();
        return  $query;

    }
    // funcion para listar todas las ordenes que estan pendientes de cobro  por mesa 
    // diseñando para ordenes  por mesas  
     public function listaOrdenesPendienteDespacho1($mesaID){
          // echo  "El nivel del usuario esModelo " .  $_SESSION["nivelUsuaio"] .  "<br>" ;
            echo  "La mesa pendiente de despacho es  " . $mesaID ;

          // condicionamos  los datos a mostrar solo para cuado sea nivel usuario diferente de  1   mostrar  solo los productos de comedor 
           // -3 Boquitas,  4- platos,  10- tipicos
           /*echo  "el nivel de usuario Model" . $_SESSION["nivelUsuaio"];*/
           if($_SESSION["nivelUsuaio"] == "2"){
                echo  "aplicando condicion" ;
              $condicion  = "ordenp.ordPpenditeDespacho = 1";
              $this->db->where( $condicion );
           }

              // si el usuario es cocinero mostrar  solo las  ordenes que estan pendiente despachar  


        $this->db->distinct();         
        $query = $this->db->select("ordenp.ordenPedidoID, ordenp.ordPFecha, HOUR( ordenp.ordPFecha)  as hora,  MINUTE(ordenp.ordPFecha) as minuto,  upper(trim(ordenp.ordPcomentario)) as cliente, areEst.area,  ordenp.ordPpenditeDespacho ")
                    ->join('mesa as  msa',  ' msa.mesaID = ordenp.mesaID', 'inner')
                    ->join('detordenpedido dt',  ' dt.ordenPedidoID =  ordenp. ordenPedidoID', 'inner')
                    ->join('areasestablecimiento areEst',  '  areEst.areaEstablecimientoID =  msa.areaEstablecimientoID', 'inner')
                   
                 ->where("ordenp.mesaID",  $mesaID)
                  // ->where("ordenp.ordPpenditeDespacho",  1)
                   ->where("ordenp.ordPanulado",  0)
                ->order_by("ordenp.ordPFecha", "DESC")
                 ->get("nuevoestablo.ordenpedido ordenp ")
                 ->result();
        return  $query;

    }

    public function listaOrdenesPendienteCobro($mesaID){
  


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
                 ->where(" ordenp.ordPpenditeCobro",  1)
                   ->where("ped.detstatus",  1)
                ->order_by("ordenp.ordPFecha", "DESC")
                 ->get("nuevoestablo.ordenpedido ordenp")
                 ->result();
        return  $query;

    }


    // funcion para crear una nueva mesa en area de establecimiento 
     public function  insertarMesaEstablecimiento($data, $mesaID){
        if($mesaID ==   null){
    
            $this->db->insert("mesa",$data);
            return $this->db->insert_id();
        }else{

            $this->db->set("establecimientoID", $data["establecimientoID"])
                    ->set("areasEstablecimientoID", $data["areasEstablecimientoID"])
                    ->set("mesNombre", $data["mesNombre"])
                    ->set("mescapacidad", $data["mescapacidad"])
                    ->where("mesaID", $mesaID)
                    ->where("mestatus",  1)
                    ->update("mesa");
            return $this->db->affected_rows();   
               
                }
    }

    /*public function insertarEstablecimiento(){
        if($establecimientoID ==   NULL){
            $this->db->insert("establecimientoempresa",$data);
            return $this->db->insert_id();
        }else{           
            $this->db->set("estNombre",   $data["estNombre"])
                    ->set("estDireccion", $data["estDireccion"])
                    ->set("estTelefono",  $data["estTelefono"])                     
                   
                    ->where("establecimientoID", $establecimientoID)
                    
                    ->update("establecimientoempresa");
            return $this->db->affected_rows();   

       }  
    }*/

     // funcion para cargar la empresa que  se  quiere  modificar  
    public function get_MesaPorID($mesaID) {
        $query =  $this->db->select("*")   
                           ->where("mesaID",$mesaID)         
                           ->get("mesa")
                           ->result();
        return  $query;          
    }

    /*Funcion para eliminar  una medida de  producto */
    public function delete_MesaPorID($mesaID) {
        $this->db->where("mesaID",$mesaID)         
                 ->delete("mesa");                 
        return  $this->db->affected_rows();          
    }
    // funcion mostramos todas las mesas deñ  area  

    /*select  m.mesaID, m.establecimientoID, m.areaEstablecimientoID,  m.mesNombre, m.mescapacidad,  areStb.area,  m.mestatus      
 from  nuevoestablo.mesa  m 
 inner  join  nuevoestablo.establecimientoempresa   estb
 on m.establecimientoID  = estb.establecimientoID
 inner join  nuevoestablo.areasestablecimiento areStb
 on areStb.areaEstablecimientoID = m.areaEstablecimientoID
 where   m.mestatus  = 1 ;   
  */
     public function get_listAllmesas(){
        $query =  $this->db->select(" m.mesaID, m.establecimientoID, m.areaEstablecimientoID,  m.mesNombre as mesa, m.mescapacidad as capacidad,  areStb.area,  m.mestatus  ")
                    ->join('nuevoestablo.establecimientoempresa estb',  'm.establecimientoID  = estb.establecimientoID', 'inner')
                    ->join('nuevoestablo.areasestablecimiento areStb',  'areStb.areaEstablecimientoID = m.areaEstablecimientoID', 'inner')
                   ->where(" m.mestatus",  1) 
                 //->where("areaEstablecimientoID",  $areaEstablecimientoID)
                 ->get("mesa  m")
                 ->result();
        return  $query;          
    }





}