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
           $this->load->model('ordenesPedido_Model');
           $this->load->model('compraProducto_Model');
           $this->load->model('familiaProducto_Model');
           

           
           

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
        //echo  'llegando al  controlador Ventas ';
        //$idTransac     = (isset($_POST["idTransac"]))?  $_POST["idTransac"] : 0;
        //echo  "El id de la transacciones es " .  $idTransac;
        //productoID:productoID, precioregular:precioregular, 
        //comanda:comanda, bodsalida:bodsalida, precincremento:precincremento, cantiadVenta:cantiadVenta,totalVenta:totalVenta 
        
        
        
        //exit;
        $transaccionID   = (isset($_POST["idTransac"]))?  $_POST["idTransac"] : 0;
        $movtipo         = "VNTA" ;
        $productoID      = (isset($_POST["productoID"]))?  $_POST["productoID"] : 0;
        //ordenID
        $ordenID         = (isset($_POST["ordenID"]))?  $_POST["ordenID"] : 0;
        // $bodegaOrigen    = (isset($_POST["bodegaProductoID"]))?  $_POST["bodegaProductoID"] : 0; 
        $comanda         = (isset($_POST["comanda"]))?  $_POST["comanda"] : 0;
        $bodegaOrigen    = (isset($_POST["bodegaOrigen"]))?  $_POST["bodegaOrigen"] : 0;
        $bodegaDest      =  10;// por defecto sera la bodega de  ventas  (isset($_POST["bodegaDest"]))?  $_POST["bodegaDest"] : 0;
        $precioregular   = (isset($_POST["precioregular"]))?  $_POST["precioregular"] : 0; 
        $precincremento  = (isset($_POST["precincremento"]))?  $_POST["precincremento"] : 0;   
        $salida          = (isset($_POST["cantiadVenta"]))?  $_POST["cantiadVenta"] : 0;
        $entrada         = (isset($_POST["cantiadVenta"]))?  $_POST["cantiadVenta"] : 0;
        $totalVenta      = (isset($_POST["totalVenta"]))?  $_POST["totalVenta"] : 0;
     

        # procesamos la venta en el detalle de ordenes  
            $ordenPedidoID     = $ordenID;  
            $productoID        = $productoID; 
            $bodSaldID         = $bodegaOrigen; 
            $detcantidad       = $salida; 
            $detprecioNormal   = $precioregular;
            $detprecioEspecial = $precincremento;
            $dettotal          = $totalVenta; 
            $detPedID         =null;
            $dataDelOrdenes  =  array('ordenPedidoID' =>$ordenPedidoID , 
                                      'productoID' =>$productoID ,
                                      'bodSaldID' =>$bodSaldID,
                                      'detcantidad' =>$detcantidad,
                                      'detprecioNormal' =>$detprecioNormal,
                                      'detprecioEspecial' =>$detprecioEspecial,
                                      'dettotal' =>$dettotal 
                                      );
                                     // var_dump($dataDelOrdenes); 
          $this->ordenesPedido_Model->addDetOrdenPedido($dataDelOrdenes, $detPedID);                    

        # Fin del procesamiento del detalle de ordenes 
        # preparando el algoritmo para  refleja la  salida en  el kardex
        /*$kardexProdID= NULL;
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
                            //var_dump($dataSalidaK);  
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
                            //var_dump($dataEntradaaK);   
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
        }*/
        //echo 'antes de la consulta';  
        $data['detalleOrden'] = $this->ordenesPedido_Model->get_listDetOrden($ordenPedidoID);
       // var_dump(  $data['detalleOrden']);
        $this->load->view('inventarios/detalleVenta',$data);

        

    }
    public function get_TotalDetOrden($ordenPedidoID){
      $total = $this->ordenesPedido_Model->get_TotalDetOrden($ordenPedidoID);
      echo $total->dettotal;

    }
    //  funcion para  retornar las   ordenes que estan  pendientes de cobro   por mesa 
    public function get_OrdenesPendientesCobro($mesaID){
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL); 
      $data['OrdenesPendientesCobro'] = $this->ordenesPedido_Model->get_OrdenesPendientesCobro($mesaID);
      // var_dump(  $data['detalleOrden']);
       $this->load->view('ventas/ordenesPendientes',$data);


    }

    public function ver_ordenePedido($ordenPedidoID){
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL);
     // echo 'llegando al  menu interno de la familia de  productos'. $mesaID .  "<br>";
      $data['listFamiliaProducto'] = $this->familiaProducto_Model->get_listFamiliaProducto();
     // var_dump($data['listFamiliaProducto'] );
     // $data['submenu'] = $this->Producto_Model->get_submenu($famProdID);
      //var_dump($data['submenu']);
      //$data['comandas'] = $this->Producto_Model->get_comandas();
      # segmento para  generar la  cabecera  de la  orden de pedido  
      //  $meseroID  =  1;
      // $mesaID    = $mesaID;
      //$comandaID =  1;
      //$ordenPedidoID =null;
      $famProdID = 1;

     /*$dataarr  =  array( 'meseroID' =>$meseroID,
                          'mesaID' =>$mesaID,
                          'comandaID' =>$comandaID,
                      );*/
     // echo  'llegadno al controlador';                
     $data['detalleOrden'] =  $this->ordenesPedido_Model->get_listDetOrden($ordenPedidoID); 

     $data['submenu'] = $this->Producto_Model->get_submenu($famProdID);
      $data['familia']  = 110 ;//$mesaID;
      $data['datordenID']  =    $ordenPedidoID ;
       $Rdettotal =  $this->ordenesPedido_Model->get_TotalDetOrden($ordenPedidoID);
      $data['datTotal']  =   $Rdettotal->dettotal;


      //var_dump($data['comandas'] );
      $this->load->view('menuinterno/ordenesProducto',$data);
                    
      //return  $ordenID ;

   }



     

  }