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

  //funcion para  almacenar los datos del  usuario 
  protected $table = 'usuario';

    public function insert_user($data, $aes_key)
    {
        $builder = $this->db->table( $this->table );

        $builder->set('usrPwd', "AES_ENCRYPT('{$data['usrPwd']}','{$aes_key}')", FALSE);
        $builder->set('usrNombre', $data['usrNombre'], TRUE);
        $builder->set('usrLogin', $data['usrLogin'], TRUE);

        $builder->insert();
    }


}
