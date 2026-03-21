<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class mesas_Model extends CI_Model {
    //  funcion para listar las mesas  , esto funcionara para poder  agrear una o varias  ordenes a la   mesa 
     
    public function get_listmesas(){
        $query =  $this->db->select("mes.* ")
                    //->join('establecimientoempresa  est',  'bod.establecimientoID   =  est.establecimientoID', 'inner')
                   
                 ->where("mestatus",  1)
                 ->get("mesa  mes")
                 ->result();
        return  $query;          
    }
    // funcion que muestra las mesas que tienen  ordenes pendientes de cobro  
    public function listaMesasPendienteCobro(){
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
     public function listaOrdenesPendienteDespacho($mesaID){
        $this->db->distinct();         
        $query = $this->db->select("ordenp.ordenPedidoID, ordenp.ordPFecha, HOUR( ordenp.ordPFecha)  as hora,  MINUTE(ordenp.ordPFecha) as minuto,  upper(trim(ordenp.ordPcomentario)) as cliente ")
                    ->join('mesa as  msa',  ' msa.mesaID = ordenp.mesaID', 'inner')
                    ->join('detordenpedido dt',  ' dt.ordenPedidoID =  ordenp. ordenPedidoID', 'inner')
                   
                 ->where("ordenp.mesaID",  $mesaID)
                  ->where("ordenp.ordPpenditeDespacho",  1)
                   ->where("ordenp.ordPanulado",  0)
                ->order_by("ordenp.ordPFecha", "DESC")
                 ->get("nuevoestablo.ordenpedido ordenp ")
                 ->result();
        return  $query;

    }



}