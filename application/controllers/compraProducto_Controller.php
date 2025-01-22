<?php 
$GLOBALS['arrCabecera'] = array();
$GLOBALS['arrDetalle']  = array();
defined('BASEPATH') OR exit('No direct script access allowed');
include getcwd(). "/application/libraries/operacionInvnt/operacionesInventario.php";

class CompraProducto_Controller extends CI_Controller {  
    public function __construct()
    {
           parent::__construct();     
           $this->load->database();                  
           $this->load->model('Producto_Model');
           $this->load->model('Proveedor_Model');
           $this->load->model('FamiliaProducto_Model');
           $this->load->model('TipoProducto_Model');
           $this->load->model('MedidaProducto_Model');
           $this->load->model('Marcas_Model');
           $this->load->model('PresentacioProducto_Model');
           $this->load->model('CompraProducto_Model');   
           $this->load->model("prodPresentacion_Model");     

           $this->load->helper('path');  
        
    }   

   /*Carga la vista principal para  ingresa las compras */
   public function addCompraProducto(){ 
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL); 
      //  obtener los  datos de los proveedores  existentes  
      $datos['proveedores'] =  $this->Proveedor_Model->get_listaProveedores();
      $this->load->view('compras/procesarCompras', $datos);

     // $this->load->view('inventarios/compra_producto', $datos);
   }
   // funcion que carga el detalle de la compra  
   public function addDetCompra(){ 
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL); 
      
     // echo  'llegando al  controlador para cargar los productso a la compra';
      $compraProdID =null;
      $datos['ListProducto']        = $this->Producto_Model->get_ListProducto();
      $datos["prodPresentacion"]    = $this->prodPresentacion_Model->get_PresentacionProd();
      $fecha                        = (isset($_POST['fecha']))? $_POST['fecha']:null;
      $tipocomprobante              = (isset($_POST['tipocomprobante']))? $_POST['tipocomprobante']:null;
      $numcomprobante               = (isset($_POST['numcomprobante']))? $_POST['numcomprobante']:null;
      $proveedor                    = (isset($_POST['proveedor']))? $_POST['proveedor']:null;
      $data                        = array(
                                             'empresaID'=> 1,
                                             'establecimientoID'=>$_SESSION["establecimientoID"],
                                             'compProdFecha'=>$fecha,                    
                                             'comprobanteTipo'=>$tipocomprobante,
                                             'comprobantenum'=>$numcomprobante,
                                             'proveedorID'=>$proveedor,
                                              'usuarioID'  =>  $_SESSION["usuarioID"]
                                          );

     
     // $_SESSION["EncCompra"]= $arrar ;
     // Creamos un  arrar vacio 
     // $_SESSION["detCompra"]= array() ;
    //  print_r($_SESSION["detlistadecompra"])  ;
    
    // insertamos la cabecera y  retornamos el id de la cabecera  
   // var_dump($data);
     $compraResultID =  $this->CompraProducto_Model->addCabeceracompra($data, $compraProdID);
     $datos["compraResultID"]    =$compraResultID;
      

      $this->load->view('compras/addProcompra', $datos);
     // echo  'lo qe se  tiene almacenado es' ;
       
    }


    //  funcion  para  insertar el  producto temporal 
    public function addtmpdetcompra(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        /* Creamos una variable para determinar el  modelo  a ejecutar*/
        //
       // echo 'llegando al  controlador';
        if(isset( $_SESSION["EncCompra"])){
          //  var_dump($_SESSION["EncCompra"]);
         foreach($_SESSION["EncCompra"] as $row){
            //   echo  'recorriendo arr'. $row->tipocomprobante;

         }
        }
        $idtmp = null;       
       /* if($_POST['idtmp']!=''){         
          $idtmp = $_POST['idtmp'];
        }*/

        $idCompra             = (isset($_POST['compraProdID'])) ? $_POST['compraProdID']:  null;
        $productoID           = (isset($_POST['producto'])) ? $_POST['producto']:  null;
        $descripcion          = (isset($_POST['nameproductotmp'])) ? $_POST['nameproductotmp']:  null;
        $cantidad             = (isset($_POST['cantidad'])) ? $_POST['cantidad']:  0;
        $preCosto             = (isset($_POST['preCosto'])) ? $_POST['preCosto']:  0;
        $sub_total            =  $cantidad *  $preCosto;
        $impuesto             = 0 ;
        $total                = $sub_total+ $impuesto   ;


      //if($idCompra!=null ){
            $data =  array("compraProdID"=>  $idCompra, 
                           "productoID"=>$productoID,                           
                           "cantidad"=>$cantidad,
                           "precUnit"=>$preCosto,
                           "sub_total"=>$sub_total,
                           "impuesto"=>$impuesto,
                           "total"=>$total,

                           );
         //var_dump($data);                  
         if($productoID !=null   and  $total> 0 ){
            //echo  'insertando el detalle de la compra ';
             $this->CompraProducto_Model->addtmpdetcompra($data, $idtmp);
            //  calculamos    y  retornamos los nuevos valores de total  
            $datostotaltmp =  $this->CompraProducto_Model->get_sumastotaltmp($idCompra);
            echo  json_encode($datostotaltmp);

         }else{
            //echo   'No se puede almacenar el  productod';
         } 
      //}else{
         //echo 'el id de la compra es  null  no se  puede  procesar ';
     // }
        
      
    }
   // 
   public function get_ListTmp($idCompra){ 
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);  
        $datos['ListTmpCompra'] =  $this->CompraProducto_Model->get_ListTmp($idCompra);
       $this->load->view('compras/detTmpCompra', $datos);
        
      }
      //  funcion  para obtener  los totales   de las compras  
   public function get_sumastotaltmp($idCompra){ 
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL); 
      //$idCompra = (isset($_POST['idCompra'])) ? $_POST['idCompra']:  null;
      //echo  'Se mantiene la valiable globla'.  $idCompra ;
      
      $datostotaltmp =  $this->CompraProducto_Model->get_sumastotaltmp($idCompra);
      echo   json_encode($datostotaltmp);
      }
      //  segmento para almacenar la compra detalle de  compra   y movimientos en  el kardex  
   public function saveTransacCompraproducto(){
      //  ontenemos el   idtemprotal  dela compra 
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL); 
      $operacionesInventario  =  new  operacionesInvenatarios();
      //echo  'llegando al  controlador para  guardar las  ventas ';
      $empresaID         = 1; 
      $establecimientoID = 2;
      $usuarioID         = 1;
      $compProdCantidad  = 1;
      $compProdGravado   = 0;
      $compProdExcento   = 0;

      $idCompratmp       = (isset($_POST['idCompratmp'])) ? $_POST['idCompratmp']:  null;
      // obtenemos los  datos de los encabezados de las compras
      $tipocomprobante   = (isset($_POST['tipocomprobante'])) ? $_POST['tipocomprobante']:  null;
      $numComprobante    = (isset($_POST['numComprobante'])) ? $_POST['numComprobante']:  null;
      $proveedor         = (isset($_POST['proveedor'])) ? $_POST['proveedor']:  null;
      $fechaing          = (isset($_POST['fecha'])) ? $_POST['fecha']:  null;
      $sumas             = (isset($_POST['sumas'])) ? $_POST['sumas']:  0;
      $impuesto          = (isset($_POST['impuesto'])) ? $_POST['impuesto']:  0;
      $total             = (isset($_POST['total'])) ? $_POST['total']:  0;
      //  creamos el  array del encabezado para  gardar las compras 
      $compraProdID      = NULL;
      $data  = array(
                           'empresaID'        => $empresaID,
                           'establecimientoID'=> $establecimientoID,
                           'compProdFecha'    => $fechaing,
                           'proveedorID'      => $proveedor, 
                           'comprobanteTipo'  => $tipocomprobante,
                           'comprobantenum'   => $numComprobante,
                           'usuarioID'        => $usuarioID,     
                           'compProdCantidad' => $compProdCantidad,
                           'compProdNoSujeto' => $sumas,                             
                           'compProdIva'      => $impuesto,                          
                           'compProdTotal'    => $total 
                        );
      // var_dump($data);
      // insertamos el encabezado de la  compra  
      $transaccionID  = $this->compraProducto_Model->addCabeceracompra($data, $compraProdID);

      //echo  'el Id temporal  para  buscar en la tanla temp es ' . $idCompratmp . '<br>';                  
      $dListTmpCompra =  $this->compraProducto_Model->get_ListTmp($idCompratmp);
      //echo  'mostrando los  datos de la table temporal';
      //var_dump($dListTmpCompra);

   
      // variables para  el kardex 
      
      $movtipo           ='COMP';
      $bodegaProductoID  = 1;

      foreach ($dListTmpCompra as $row) {
         //  iniciando variables para el  detalle  de la venta 
         $productoID = 0;
         $cantidad   = 0;
         $precUnit   = 0;
         $impuesto   = 0;
         $sub_total  = 0;
         $total      = 0;
         // cargando  datos del set de datos 

         //productoID
         $detCompraId= NULL;
         $productoID = $row->productoID;
         $cantidad   = $row->cantidad ;
         $precUnit   = $row->precUnit;       
         $sub_total  = $row->sub_total;
         $impuesto   = $row->impuesto;
         $total      = $row->total;
         
         //  para  el detalle de las compras
         
         $dataDetComp  = array( 'compraProdID'=> $transaccionID,
                                 'productoID'=>$productoID,
                                 'cantidad'=>$cantidad,
                                 'precUnit'=>$precUnit,                                   
                                 'impuesto'=>$impuesto,
                                 'sub_total'=>$sub_total,                                    
                                 'total'=>$total
                              );
         //  insertamos el  detalle de la  compra 
         $this->compraProducto_Model->adddetcompra($dataDetComp, $detCompraId);  
         
         # Creamos el segmento  para insertar en el invenrio si  no existe 
         

         # fin  del segmento para actualizar el inventario  
         

         //creadno el   array para  el  kardex  

         /* $kardexProdID = NULL;
   
         $dataDetkardex  = array('transaccionID'=>$transaccionID,
                                 'movtipo'=>$movtipo,  
                                 'bodegaProductoID'=> $bodegaProductoID,
                                 'productoID'=>$productoID,
                                 'entrada'=>$cantidad,            
                                 'precio_unit'=>   $precUnit,
                                 'subtotal'=> $sub_total,
                                 'impuesto'=> $impuesto,
                                 'total'=>$total
                           );
         // insertamos los  datos del  kardex 
         $this->compraProducto_Model->addMoVKardex($dataDetkardex, $kardexProdID) ;*/ 
         
         $operacionesInventario ->actualizarInventario($productoID, $movtipo,$bodegaProductoID, $bodegaProductoID, $cantidad ); 

      }



   } 
    // segmento para alamacenar en  un  arrar   los datos que  se estan   ingresando 
   public function createArray(){
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL); 
    //  $datos['ListTmpCompra'] =  $this->compraProducto_Model1->get_ListTmp();
      //session_start();
     // $_SESSION["usuario"] 
    //  $_SESSION['idDetCompra']='1';
     // $_SESSION["IdTempComprea"]= rand();
      //$_SESSION['detlistadecompra']=null;
      $usuario =  $_SESSION['usuario']; //   $_SESSION["usuario"];
      echo  'variables de  session  creadas '.    $usuario . ' sdfsdf';
    //  session_start();
// initialize session variables 
  //$_SESSION['logged_in_user_id'] = '1';
//$_SESSION['logged_in_user_name'] = 'Tutsplus';
      
   }

   // funcion para agregar detalles  de compras 
   public function adddetCompraarr(){
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL); 
      echo  $_SESSION['idDetCompra'];
      $idDetCompra = $_SESSION["idDetCompra"];
      if($idDetCompra == 1 ){
         $idDetCompra +=1;
      }
      $descripcion = 'Prueba de envio a arr';
      $cantidad    = 1;
      $precUnit    = 20;
      $impuesto    = 1.13;
      $total       = 21.13;

      $productos    = array("idDetCompra" => $idDetCompra, "cantidad" => $cantidad, 'descripcion'=>$descripcion , 'precUnit'=>$precUnit, 'impuesto'=>$impuesto, 'total'=>$total );


                       

      $datos['ListTmpCompra'] =    $productos ;
      $this->load->view('compras/detTmpCompra', $datos);

      /*if (empty($_SESSION["detlistadecompra"])) {
      }*/
      array_push($_SESSION["detlistadecompra"],  $productos);
      //$_SESSION["detlistadecompra"] = $productos;
      var_dump($_SESSION["detlistadecompra"]);  

   }
   

    public function addArrCabecera(){
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL); 
       if(isset($arrCabecera)){
           // 
           echo 'se tiene que  agregar elementos a la cabecera del array';
       }else{
         echo 'no exisate un array  creado';
       }
    } 
    public function addArrDetalle(){
      
    } 
     // funcion lista las compras      
     public function get_ListCompras(){ 
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL); 
      //  obtener los  datos de los proveedores  existentes  
      $datos['listCompras'] =  $this->compraProducto_Model->get_ListCompras();
      $this->load->view('compras/listaComprasProducto', $datos);

   
    }

      
}