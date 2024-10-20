<?php  
defined('BASEPATH') or exit('No direct script access allowed');
class gastos_Model extends CI_Model{
 # funcion almacenar la cabecera de los gastos  
    public function saveGastos($data, $gastosID){
      //  ECHO  ' LCA CABECERA DEL  GASTO ES ' . $gastosID.  '<br>'; 
        if($gastosID == null){
        //    ECHO  'iNSERTANDO LA CABECERA DE LOS  GASTOS#######';
            $this->db->insert("gastosOperativos",$data);
            return $this->db->insert_id();
        }else{
           echo  'CERRANDO LOS  GASTOS';
            //var_dump($data);
            
            $this->db->set("unidades", $data["unidades"])
                    ->set("total", $data["total"])
                    ->set("cerrado", $data["cerrado"])
                    ->where("gastosID",  $gastosID)
                    ->update("gastosOperativos");
            return $this->db->affected_rows();   
        }
    } 

 # funcion para actualizar los totales de cabecera de gastos
 public function gettotales($gastosID){
    $query  =$this->db->select("sum(deg.cantidad) as cantidad, sum( deg.total) as total")
                       ->where("gastosID", $gastosID)
                       ->get("det_gastos deg")
                       ->row();
                       return  $query;    

 }
 # funcion para mostrar detalle de gastos por  id de encabezado 

 # funcion para  insertar detalle de gastos
 public function saveDetGastos($data, $detgastosID){
    if($detgastosID ==   null){
        $this->db->insert("det_gastos",$data);
        return $this->db->insert_id();
    }else{
        $this->db->set("cantidad", $data["cantidad"])
                ->set("descDetGasto", $data["descDetGasto"])
                ->set("precio", $data["precio"])
                ->set("total", $data["total"])
                ->where("detgastosID",  $detgastosID)
                ->update("det_gastos");
        return $this->db->affected_rows();   
    }
} 

 # funcion para mostrar los detalles del los gastos aun no cerrados 
 public function listarDetGastos($gastosID) {
    $query =  $this->db->select("encg.establecimientoID, encg.fecha,   deg.*")   
              ->join('gastosOperativos encg','encg.gastosID = deg.gastosID','inner')
              ->where('encg.cerrado',0)
              ->where('deg.gastosID',$gastosID)
             ->get("det_gastos deg")
             ->result();
    return  $query;          
}
 # funcion selecciona detalle por id
 public function editDetGastos($detgastosID) {
    $query =  $this->db->select("deg.*")   
              //->join('gastosOperativos encg','encg.gastosID = deg.gastosID','inner')
              //->where('encg.cerrado',0)
              ->where('deg.detgastosID',$detgastosID)
             ->get("det_gastos deg")
             ->result();
    return  $query;          
} 

 # funcion para eliminar detalle de gastos
 public function delDetGasto($detgastosID) {
    //echo 'el id a eliminar es' .$detgastosID;
    $this->db->where("detgastosID",$detgastosID)         
             ->delete("det_gastos");                 
    return  $this->db->affected_rows();          
}


}