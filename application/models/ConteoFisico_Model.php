<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ConteoFisico_Model extends CI_Model{
    // funcion que inserta registros en  el conteo fisico  
    public function insertar_conteo($data, $id){
        if($id ==   null){
            $this->db->insert("conteofisico",$data);
            return $this->db->insert_id();
        }else{
            $this->db->set("fecha", $data["fecha"])
                      ->set("turnOperaID", $data["turnOperaID"])
                    ->where("conteoID", $id)
                    ->where("anulado",  0)
                    ->update("conteofisico");
            return $this->db->affected_rows();   
               
         }

     
    }
    // funcion que inserta del detalle del conteo fisico 
    public function insertar_detconteofisico($data, $id){
        if($id ==   null){
            $this->db->insert("det_conteofisico",$data);
            return $this->db->insert_id();
        }else{
            $this->db->set("bodegaProductoID", $data["bodegaProductoID"])
                      ->set("productoID", $data["productoID"])
                      ->set("existenciaF", $data["existenciaF"])
                      ->set("aberia", $data["aberia"])
                    ->where("detConteoID", $id)
                    ->where("activo",  1)
                    ->update("det_conteofisico");
            return $this->db->affected_rows();   
               
         }

    } 


} 

?>