<?php
defined('BASEPATH') or  exit('No direct script access allowed');
class gastos_Controller extends CI_Controller{
    public function __construct(){
        parent:: __construct();
        $this->load->database();
        $this->load->model('bodegaProducto_Model');
        $this->load->model('gastos_Model');
        $this->load->helper('path');
    }

    //  funcion para mostrar la cabecera de los gastos
    public function  iniciargastos(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);        
        $this->load->view("gastos/ingresarGastos"); 
    } 
    public function  guardarGastos(){
    // funcion para almacenar la cabecera de los  gatos 

	$cerrado            = ($_POST['cerrado']>0)? $_POST['cerrado'] : 0;
    $gastosID           = ($_POST['gastosID']>0)? $_POST['gastosID'] : null;
    $establecimientoID  = (isset($_POST['sucursalGasto']))? $_POST['sucursalGasto'] : null;
    $fecha              = (isset($_POST['fechaGasto']))? $_POST['fechaGasto'] : null;
    $data = array('establecimientoID'=>$establecimientoID, 'fecha'=>$fecha );
    //var_dump($data);
    //echo  'el valor de cerrado es '. $cerrado  . '<br>';
    if($cerrado== 0){
        $gastosID = $this->gastos_Model->saveGastos($data, $gastosID);
        echo  $gastosID;
    }
    
 }
    // funcion ára mostrar la  vista para  ingresar el detalle de la compra 
    public function  addDetgasto(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        // echo  'llegando al controlador de la MEDIDA del producto';
        // $datos["indicadorExistenciaProd"] =   $this->inventProducto_Model->indicadorExistenciaProd();
        //var_dump($this->datos["datosMArcas"]);
        $this->load->view("gastos/detGastos"); 
        

    } 
    # funcion para almacernar el detalle de los gastos 
    public function saveDetGastos(){
        echo 'llegando al segmento para almacenar el detalle de los gastos';
        $detgastosID  = ($_POST['detgastosID']>0)? $_POST['detgastosID'] : null ;        
        $gastosID     = (isset($_POST['IdGasto']))? $_POST['IdGasto'] : null ;      
        $descDetGasto = (isset($_POST['descripcionDetGast']))? $_POST['descripcionDetGast'] :"";
        $cantidad     = ($_POST['cantidadgasto']>0)? $_POST['cantidadgasto'] : 0  ;
        $precio       = ($_POST['preciogasto']>0)? $_POST['preciogasto'] : 0  ;
        $total        = ($_POST['totalDet']>0)? $_POST['totalDet'] : 0  ;
        $data =  array( 'gastosID'=>$gastosID,
                        'descDetGasto'=>$descDetGasto,
                        'cantidad'=>$cantidad,
                        'precio'=>$precio,
                        'total'=>$total,
                    );
       if($total>0  && strlen( $descDetGasto)>0 ){
        $this->gastos_Model->saveDetGastos($data, $detgastosID);
       }             

    }

    public function  listarDetGastos(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        // echo  'llegando al controlador de la MEDIDA del producto';
        $datos["listaDetGastos"] =   $this->gastos_Model->listarDetGastos();        
        $this->load->view("gastos/listarDetGastos",$datos); 
        

    } 


}