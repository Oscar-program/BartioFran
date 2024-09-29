<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class gastos_Model extends CI_Model{
 # funcion almacenar la cabecera de los gastos  
    public function saveGastos($data, $gastosID){
        if($gastosID ==   null){
            $this->db->insert("gastosOperativos",$data);
            return $this->db->insert_id();
        }else{
            $this->db->set("unidades", $data["unidades"])
                    ->set("total", $data["total"])
                    ->set("cerrado", $data["cerrado"])
                    ->where("gastosID",  $gastosID)
                    ->update("gastosOperativos");
            return $this->db->affected_rows();   
        }
    } 

 # funcion para actualizar los totales de cabecera de gastos
 # funcion para mostrar detalle de gastos por  id de encabezado 

 # funcion para  insertar detalle de gastos
 public function saveDetGastos($data, $detgastosID){
    if($detgastosID ==   null){
        $this->db->insert("det_gastos",$data);
        return $this->db->insert_id();
    }else{
        $this->db->set("cantidad", $data["cantidad"])
                ->set("precio", $data["precio"])
                ->set("total", $data["total"])
                ->where("detgastosID",  $detgastosID)
                ->update("det_gastos");
        return $this->db->affected_rows();   
    }
} 

 # funcion para mostrar los detalles del los gastos aun no cerrados 
 public function listarDetGastos() {
    $query =  $this->db->select("encg.establecimientoID, encg.fecha,   deg.*")   
              ->join('gastosOperativos encg','encg.gastosID = deg.gastosID','inner')
              ->where('encg.cerrado',0)
             ->get("det_gastos deg")
             ->result();
    return  $query;          
}
 # funcion selecciona detalle por id 
 # funcion para eliminar detalle de gastos 

}