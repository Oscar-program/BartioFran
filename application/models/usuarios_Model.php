<?php 
class usuarios_Model extends CI_Model{
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
 

    public function insert_user($data)
    {
      $this->db->insert("usuario",$data);
      return $this->db->insert_id();
    }

    // funcion  retorna todos los usuarios  
    public function allUserSystem(){
      $query =  $this->db->select("usr.*" )   
      //->where('usr.usrLogin',$usrLogin )                             
      //->where("usr.usrPwd", $usrPwd)              
   
      ->get("usuario usr")
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
