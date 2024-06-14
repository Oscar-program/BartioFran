<?php  
defined('BASEPATH') or  exit('No direct script access allowed');
class trasladoProducto_Controller extends CI_Controller{
    public function __construct(){
        parent:: __construct();
        $this->load->database();
        $this->load->model('trasladoProducto_Model');
        $this->load->model('Producto_Model');
        $this->load->model('bodegaProducto_Model');
        $this->load->model('compraProducto_Model');
        $this->load->model('inventProducto_Model');
        

        $this->load->helper('path');
    }

    //  funcion para  listar  los  ultimos  

    public  function ListarTraslados(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        // echo  'llegando al controlador de la presentacion del producto';
        $datos["listaTraslados"] =   $this->trasladoProducto_Model->ListarTrasladoProducto();
        //var_dump($this->datos["datosMArcas"]);
        $this->load->view("traslados/listaTraslados", $datos); 
       // $this->load->view("traslados/listaTraslados"); 
    }

    /*Funcion paramostrar la  vista para  agregar datos del   invetario manual */
 public function addTrasladosProducto(){ 
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL); 
    //  cargamos los  datos para  los  select  
    $datos['listaProductos']     = $this->Producto_Model->get_ListProductoTrasladar();
    $datos['listBodegaProducto'] = $this->bodegaProducto_Model->get_listBodegaProducto();
 
    $this->load->view('inventarios/traslado_prodcto', $datos);
  }

  

    // funccion para procesar los traslados de los  prouctos
    public  function saveTraslado(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL); 
        //echo  'llegando al  controlador para procesar los  traslados';
        //$idTransac     = (isset($_POST["idTransac"]))?  $_POST["idTransac"] : 0;
        //echo  "El id de la transacciones es " .  $idTransac;
        
        
        //exit;
        $movtipo       ="TRASL" ;
        $productoID    = (isset($_POST["productoID"]))?  $_POST["productoID"] : 0;;
        $bodegaOrigen  =(isset($_POST["bodegaProductoID"]))?  $_POST["bodegaProductoID"] : 0;
        $bodegaDest    =(isset($_POST["bodegaDest"]))?  $_POST["bodegaDest"] : 0;   
        $salida        =(isset($_POST["cantidadtrasl"]))?  $_POST["cantidadtrasl"] : 0;
        $entrada       =(isset($_POST["cantidadtrasl"]))?  $_POST["cantidadtrasl"] : 0;
        $transaccionID =(isset($_POST["idTransac"]))?  $_POST["idTransac"] : 0;
        # preparando el algoritmo para  refleja la  salida en  el kardex
        $kardexProdID= NULL;
        $dataSalidaK =  array('transaccionID'    => $transaccionID,
                              'movtipo'          => $movtipo, 
                              'bodegaProductoID' => $bodegaOrigen,
                              'productoID'       => $productoID,
                              'entrada'          => 0,
                              'salida'           => $salida,
                              'precio_unit'      => 1,
                              'subtotal'         => 1,
                              'impuesto'         => 1,
                              'total'            => 0 
                            );
                            var_dump($dataSalidaK);  
                            $this->compraProducto_Model->addMoVKardex( $dataSalidaK, $kardexProdID) ;                        
        $dataEntradaaK =  array('transaccionID'    => $transaccionID,
                                  'movtipo'          => $movtipo, 
                                  'bodegaProductoID' => $bodegaDest,
                                  'productoID'       => $productoID,
                                  'entrada'          => $entrada,
                                  'salida'           => 0,
                                  'precio_unit'      => 1,
                                  'subtotal'         => 1,
                                  'impuesto'         => 1,
                                  'total'            => 0 
                                );
                            var_dump($dataEntradaaK);   
        $this->compraProducto_Model->addMoVKardex($dataEntradaaK, $kardexProdID) ;  
        $resulbInv = $this->inventProducto_Model->get_productoIDInventarios($productoID,$bodegaDest);
        if(Empty($resulbInv)){
          $invProdID = NULL;
          $data =array('productoID'=>$productoID ,  
                      'bodegaProductoID' =>$bodegaDest,  
                      'entradaInvProd' =>$entrada 
                      );
          $this->inventProducto_Model->addProductoInvent($data, $invProdID);
          //  se tiene que  disparar  un trigger para  actualizar la existencia real en cada bodega
        }

        

    }
}