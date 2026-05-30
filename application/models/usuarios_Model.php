<?php 
class Usuarios_Model extends CI_Model{
  // cast(aes_decrypt(usrPwd,'xyz123') as char)
  protected $table = 'usuario';

  //  funcion  para determinar  el acceso a los  usuarios  
  function getUserpwd($usrLogin, $usrPwd){
           $query =  $this->db->select("usr.*" )   
                                ->where('usr.usrLogin',$usrLogin )                             
                                ->where("usr.usrPwd", $usrPwd)              
                             
                                ->get("usuario usr")
                                ->row();
            return  $query;  
  }

  //funcion para  almacenar los datos del  usuario 
 

    public function insert_user($data, $usuarioID)
    {

    if($usuarioID ==   NULL){
         // ECHO  "HACER INSERCION" ;
    
            $this->db->insert("usuario",$data);
            return $this->db->insert_id();
        }else{
             // ECHO  "HACER UPDATE    CLJDSKCSKDNJ" ;

           $this->db->set("usrNombre", $data["usrNombre"])
                    ->set("usrLogin", $data["usrLogin"])
                    ->set("usrPwd", $data["usrPwd"])
                    ->set("empresaID", $data["empresaID"])
                    ->set("nivelUsuarioID", $data["nivelUsuarioID"])
                    ->where("usuarioID", $usuarioID)
                    ->where("usrStatus",  1)
                    ->update("usuario");
            return $this->db->affected_rows();  


      //$this->db->insert("usuario",$data);
      //return $this->db->insert_id();
    }
     }

    // funcion  retorna todos los usuarios  
    public function allUserSystem(){
      $query =  $this->db->select("u.usuarioID, u.usrNombre, u.usrLogin,  u.usrPwd,  u.empresaID , u.nivelUsuarioID , 
                                   emp.empNombre, nlu.nivel ,   u.usrStatus" )
                           ->join('nuevoestablo.empresa emp','u.empresaID =  emp.empresaID','inner')
                           ->join('nuevoestablo.nivelusuario nlu','nlu.nivelUsuarioID =  u.nivelUsuarioID','inner')          
          
   
      ->get("nuevoestablo.usuario u ")
      ->result();
      return  $query;  
    }

    //  funcion para cargar los  establecimientos
    public function lit_establecimientos(){
      $query =  $this->db->select("estb.*" )   
            
   
      ->get("establecimientoempresa estb")
      ->result();
      return  $query;  
    }




}
