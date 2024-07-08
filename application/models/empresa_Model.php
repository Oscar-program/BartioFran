<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class  empresa_Model  extends CI_Model{
    public function get_datoEmpresa() {
        //echo  'el id de  compra es '.  $idCompra;
    $query =  $this->db->select("emp.*")   
            
           // ->where("idCompra", $idCompra)
            ->get("empresa emp")
            ->row();
    return  $query;          
}

}