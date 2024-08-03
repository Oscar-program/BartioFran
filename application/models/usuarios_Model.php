<?php 
class usuarios_Model extends CI_Model{
  // cast(aes_decrypt(usrPwd,'xyz123') as char)

  //  funcion  para determinar  el acceso a los  usuarios  
  function getUserpwd($usrLogin, $usrPwd){
           $query =  $this->db->select("usr.*" )   
                                ->where('usr.usrLogin',$usrLogin )
                               // ->where("cast(AES_DECRYPT(usr.usrPwd,'xyz123') as char)", $usrPwd) 
                                ->where("AES_DECRYPT(usr.usrPwd,'xyz123')", $usrPwd)                 
                                // ->where("idCompra", $idCompra)
                                ->get("usuario usr")
                                ->row();
            return  $query;  
  }
}
