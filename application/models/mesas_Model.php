<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class mesas_Model extends CI_Model {
    //  funcion para listar las mesas  , esto funcionara para poder  agrear una o varias  ordenes a la   mesa 
     
    public function get_listmesas($areasEstablecimientoID){
        $query =  $this->db->select("mes.* ")
                    //->join('establecimientoempresa  est',  'bod.establecimientoID   =  est.establecimientoID', 'inner')
                   ->where("mestatus",  1) 
                 ->where("areasEstablecimientoID",  $areasEstablecimientoID)
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
     public function listaOrdenesPendienteDespacho1($mesaID){
          // echo  "El nivel del usuario esModelo " .  $_SESSION["nivelUsuaio"] .  "<br>" ;
            // echo  "llegando al  modelo  " . $ordenPedidoID ;

          // condicionamos  los datos a mostrar solo para cuado sea nivel usuario diferente de  1   mostrar  solo los productos de comedor 
           // -3 Boquitas,  4- platos,  10- tipicos
           /*echo  "el nivel de usuario Model" . $_SESSION["nivelUsuaio"];*/
           if($_SESSION["nivelUsuaio"] == "2"){
               // echo  "aplicando condicion" ;
              $condicion  = "ordenp.ordPpenditeDespacho = 1";
              $this->db->where( $condicion );
           }

              // si el usuario es cocinero mostrar  solo las  ordenes que estan pendiente despachar  


        $this->db->distinct();         
        $query = $this->db->select("ordenp.ordenPedidoID, ordenp.ordPFecha, HOUR( ordenp.ordPFecha)  as hora,  MINUTE(ordenp.ordPFecha) as minuto,  upper(trim(ordenp.ordPcomentario)) as cliente, areEst.area,  ordenp.ordPpenditeDespacho ")
                    ->join('mesa as  msa',  ' msa.mesaID = ordenp.mesaID', 'inner')
                    ->join('detordenpedido dt',  ' dt.ordenPedidoID =  ordenp. ordenPedidoID', 'inner')
                    ->join('areasestablecimiento areEst',  ' areEst.areasEstablecimientoID =  msa. areasEstablecimientoID', 'inner')
                   
                 ->where("ordenp.mesaID",  $mesaID)
                  // ->where("ordenp.ordPpenditeDespacho",  1)
                   ->where("ordenp.ordPanulado",  0)
                ->order_by("ordenp.ordPFecha", "DESC")
                 ->get("nuevoestablo.ordenpedido ordenp ")
                 ->result();
        return  $query;

    }

    public function listaOrdenesPendienteDespacho($mesaID){
          // echo  "El nivel del usuario esModelo " .  $_SESSION["nivelUsuaio"] .  "<br>" ;
            // echo  "llegando al  modelo  " . $ordenPedidoID ;

          // condicionamos  los datos a mostrar solo para cuado sea nivel usuario diferente de  1   mostrar  solo los productos de comedor 
           // -3 Boquitas,  4- platos,  10- tipicos
           /*echo  "el nivel de usuario Model" . $_SESSION["nivelUsuaio"];*/
           if($_SESSION["nivelUsuaio"] == "2"){
               // echo  "aplicando condicion" ;
              $condicion  = "ordenp.ordPpenditeDespacho = 1";
              $this->db->where( $condicion );
           }

              // si el usuario es cocinero mostrar  solo las  ordenes que estan pendiente despachar 
              /*inner join mesa as  msa on    msa.mesaID = ordenp.mesaID
                inner join areasestablecimiento areEst on   areEst.areasEstablecimientoID =  msa. areasEstablecimientoID
                inner join detordenpedido ped  on   ped.ordenPedidoID =  ordenp.ordenPedidoID
                 inner join producto prod on prod.productoID =  ped.productoID
                  inner join presentacionproducto presen on   presen.presProdID = prod.presProdID
                 inner join nuevoestablo.presentacionprod pre on  pre.presProdID = prod.presProdID
                 inner join nuevoestablo.familiaproducto fam   on fam.famProdID = prod.famProdID
               where  ordenp.mesaID =  2 and    ped.detstatus =1 ;*/ 


        $this->db->distinct();         
        $query = $this->db->select("ordenp.ordenPedidoID, ordenp.ordPFecha, HOUR( ordenp.ordPFecha)  as hora,  MINUTE(ordenp.ordPFecha) as minuto,  
                      upper(trim(ordenp.ordPcomentario)) as cliente, areEst.area,  ordenp.ordPpenditeDespacho, 
                      prod.prodDescripcion , presen.presProdDescripcion as Presentacion,  pre.presentacionProd as tipo,  ped.detcantidad as catidad,  prod.famProdID")
                    
                      ->join('mesa as  msa',  ' msa.mesaID = ordenp.mesaID', 'inner')
                      ->join('mesa as  msa',  ' msa.mesaID = ordenp.mesaID', 'inner')
                      ->join('mesa as  msa',  ' msa.mesaID = ordenp.mesaID', 'inner')
                      ->join('mesa as  msa',  ' msa.mesaID = ordenp.mesaID', 'inner')

                    
                      ->join('mesa as  msa',  ' msa.mesaID = ordenp.mesaID', 'inner')
                    ->join('detordenpedido dt',  ' dt.ordenPedidoID =  ordenp. ordenPedidoID', 'inner')
                    ->join('areasestablecimiento areEst',  ' areEst.areasEstablecimientoID =  msa. areasEstablecimientoID', 'inner')
                   
                 ->where("ordenp.mesaID",  $mesaID)
                  // ->where("ordenp.ordPpenditeDespacho",  1)
                   ->where("ordenp.ordPanulado",  0)
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




}