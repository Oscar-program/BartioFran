<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ConteoFisico_Model extends CI_Model{
    // funcion que inserta registros en  el conteo fisico  
    public function insertar_conteo($data, $conteoID){
        if($conteoID ==   null){
            $this->db->insert("conteofisico",$data);
            return $this->db->insert_id();
        }else{
            $this->db->set("fecha", $data["fecha"])
                      ->set("turnOperaID", $data["turnOperaID"])
                    ->where("conteoID", $conteoID)
                    ->where("anulado",  0)
                    ->update("conteofisico");
            return $this->db->affected_rows();   
               
         }

     
    }
    // funcion que inserta del detalle del conteo fisico 
    public function insertar_detconteofisico($data, $detConteoID){
        if($detConteoID ==   null){
            $this->db->insert("det_conteofisico",$data);
            return $this->db->insert_id();
        }else{
            $this->db->set("bodegaProductoID", $data["bodegaProductoID"])
                      ->set("productoID", $data["productoID"])
                      ->set("existenciaF", $data["existenciaF"])
                      ->set("aberia", $data["aberia"])
                    ->where("detConteoID", $detConteoID)
                    ->where("activo",  1)
                    ->update("det_conteofisico");
            return $this->db->affected_rows();   
               
         }

    } 
    // funcion que retorna la lista del  detalle del conteo 
    public function  get_listaDetConteo($conteoID){
          $query =  $this->db->select(" contf.conteoID, dtCont.detConteoID,
                                        contf.fecha,
                                        prod.prodDescripcion,
                                        dtCont.tcierreant,
                                        dtCont.existenciaF,
                                        dtCont.aberia,
                                        dtCont.refil,
                                        dtCont.stockf"
                                     )
                    ->join("conteofisico contf","contf.conteoID = dtCont.conteoID",'inner')
                    ->join("producto prod","prod.productoID = dtCont.productoID",'inner')
                    ->where("contf.anulado", 0)
                    ->where("contf.conteoID", $conteoID)
                    ->get("det_conteofisico dtCont")
                    ->result();
            return  $query;  

    }
    // function   listar conteo
     public function  get_listaConteo($fechaInicio, $fechaFin ){
       // echo  'LLegando al conteo en el  modelo';
          $query =  $this->db->select("contf.conteoID, contf.fecha, contf.turnOperaID,  turn.turnOperaDescripcion, SUM(dtCont.tcierreant) AS tcierreant ,
                                        sum(dtCont.existenciaF) as existenciaF ,
                                        sum(dtCont.aberia) as  aberia,
                                        sum(dtCont.refil) as refil ,
                                        sum(dtCont.stockf) as   stockf "
                                     )
                    ->join("turnooperacion turn","turn.turnOperaID = contf.turnOperaID",'inner')
                    ->join("det_conteofisico dtCont","dtCont.conteoID =  contf.conteoID",'inner')
                    ->where("contf.anulado", 0)
                    ->where("contf.fecha>=", $fechaInicio)
                    ->where("contf.fecha<=", $fechaFin)
                    ->get("conteofisico contf")
                    ->result();
            return  $query;  

    }
    // obtnemos los datos del detalle del conteo 
    public function get_DetConteoID($detConteoID){
       // echo  "llegando al  modelo ". $detConteoID ."<br>"; 
            $query =  $this->db->select("dtCont.detConteoID, 
                                        dtCont.conteoID,
                                         dtCont.bodegaProductoID,
                                           dtCont.productoID, dtCont.tcierreant ,
                                        dtCont.existenciaF ,
                                        dtCont.aberia,
                                        dtCont.refil,
                                        dtCont.stockf"
                                     )
                    
                    ->where("dtCont.activo", 1)
                    ->where("dtCont.detConteoID", $detConteoID)
                    
                    ->get("det_conteofisico dtCont")
                    ->row();
            return  $query; 

    }
 // funcion para eliminar un detalle de conteo  
 public function detDetalleConteoFisico($detConteoID){ 
       //  echo "llegando al  modelo en la eliminacion del detalle del conteo" ; 
        $this->db->where("detConteoID",$detConteoID)         
             ->delete("det_conteofisico");                 
        return  $this->db->affected_rows();   
 }




} 

?>