<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class ventaProducto_Controller extends CI_Controller {  
    public function __construct()
    {
           parent::__construct();     
           $this->load->database();                  
           $this->load->model('Producto_Model');
           $this->load->model('bodegaProducto_Model');
           $this->load->model('PrecioEspecial_Model');
           $this->load->helper('path');  
        
    }
  

    /* funcion para cargar la modal  para  procesar la venta del producto */
    public function addVentaProducto($famProdID, $id  ){  
        $data['comandas']           = $this->Producto_Model->get_comandas();
        $data['bodegas']            = $this->bodegaProducto_Model->get_listBodegaProducto();
        $data['precioespporfamilia'] = $this->PrecioEspecial_Model->ListPreciosEspPorFamiliaProd($famProdID);

        $this->load->view('menuinterno/add_ventaProducto',$data);
     

     }
     // funcion para  guardar la  venta del producto 
     public  function saveVentaProducto(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL); 
        //echo  'llegando al  controlador para procesar los  traslados';
        //$idTransac     = (isset($_POST["idTransac"]))?  $_POST["idTransac"] : 0;
        //echo  "El id de la transacciones es " .  $idTransac;
        //productoID:productoID, precioregular:precioregular, 
        //comanda:comanda, bodsalida:bodsalida, precincremento:precincremento, cantiadVenta:cantiadVenta,totalVenta:totalVenta 
        
        
        
        //exit;
        $movtipo         = "VNTA" ;
        $productoID      = (isset($_POST["productoID"]))?  $_POST["productoID"] : 0;
        // $bodegaOrigen    = (isset($_POST["bodegaProductoID"]))?  $_POST["bodegaProductoID"] : 0; 
        $comanda         = (isset($_POST["comanda"]))?  $_POST["comanda"] : 0;
        $bodegaOrigen       = (isset($_POST["bodegaOrigen"]))?  $_POST["bodegaOrigen"] : 0;
        $bodegaDest      =  10;// por defecto sera la bodega de  ventas  (isset($_POST["bodegaDest"]))?  $_POST["bodegaDest"] : 0;
        $precioregular   = (isset($_POST["precioregular"]))?  $_POST["precioregular"] : 0; 
        $precincremento  = (isset($_POST["precincremento"]))?  $_POST["precincremento"] : 0;   
        $salida          = (isset($_POST["cantiadVenta"]))?  $_POST["cantiadVenta"] : 0;
        $entrada         = (isset($_POST["cantiadVenta"]))?  $_POST["cantiadVenta"] : 0;
        $totalVenta      = (isset($_POST["totalVenta"]))?  $_POST["totalVenta"] : 0;
        $transaccionID   = (isset($_POST["idTransac"]))?  $_POST["idTransac"] : 0;

        # procesamos la venta de los  ´rpuctos   

        
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