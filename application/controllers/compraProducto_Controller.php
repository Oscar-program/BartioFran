<?php 
 ini_set('display_errors',1);
 ini_set('display_startup_errors',1);
 error_reporting(E_ALL);
$GLOBALS['arrCabecera'] = array();
$GLOBALS['arrDetalle']  = array();
defined('BASEPATH') OR exit('No direct script access allowed');
include getcwd(). "/application/libraries/operacionInvnt/operacionesInventario.php";
include getcwd(). "/application/libraries/operacionInvnt/calculaPrecioProduc.php";

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

   # CARGA LA VISTA PRINCIPAL PARA HACER EL INGRESO DE LAS COMPRAS 
      public function addCompraProducto(){ 
         ini_set('display_errors',1);
         ini_set('display_startup_errors',1);
         error_reporting(E_ALL); 
         //  obtener los  datos de los proveedores  existentes  
         $datos['proveedores'] =  $this->Proveedor_Model->get_listaProveedores();
         $this->load->view('compras/procesarCompras', $datos);
      // $this->load->view('inventarios/compra_producto', $datos);
      }
   # CARGA LA VISTA PRINCIPAL PARA HACER EL INGRESO DE LAS COMPRAS 
   
   # FUNCION QUE  RETORNA LA INFORMACION DEL PROVEEDOR  
      public function getInfoProveedor(){
         ini_set('display_errors',1);
         ini_set('display_startup_errors',1);
         error_reporting(E_ALL);
         //echo  'llegando al  controlador';
         $infoProveedor = null;
         $proveedorID = (isset($_POST['proveedorID'])) ?  $_POST['proveedorID'] : 0;
          //echo  'dato del proveedor' . $proveedorID ;  
         if($proveedorID > 0){ 
            $infoProveedor  = $this->Proveedor_Model->get_infoProveedor($proveedorID);
         }
         echo  json_encode($infoProveedor);
        // echo  json_encode($datostotaltmp);

      }
   # FIN  DE FUNCION QUE  RETORNA LA INFORMACION DEL PROVEEDOR 


   # FUNCION RETONA LA INFORMACION DEL PRODUCTO (PRODUCTO-SERVICIO) (GRAVADO, EXCENTO, NO SUJETO)
   public function get_InfoProducto(){ 
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL); 
      echo  'llegando al controlador';
      $InfoProducto =  null;
      $productoID =  (isset($_POST['productoID']))? $_POST['productoID'] : null;
      if($productoID >0 ){
         $InfoProducto =  $this->Producto_Model->get_InfoProducto($productoID);
      }      
      echo  json_encode($InfoProducto );
      //$this->load->view('compras/detTmpCompra', $datos);
      
    }
   # FINFUNCION RETONA LA INFORMACION DEL PRODUCTO 

   # FUNCION ALMACENA LA CABERA DE LA COMPRA, RETORNA EL ID DE  LA COMPRA y CARGA MODAL PARA AGREGAR LOS PRODUCTOS   
      public function addDetCompra(){ 
         ini_set('display_errors',1);
         ini_set('display_startup_errors',1);
         error_reporting(E_ALL);      
        // echo  'llegando al  controlador para cargar los productso a la compra';
         $compraProdID =null;
         $datos['ListProducto']        = $this->Producto_Model->get_ListProducto();
         $datos["prodPresentacion"]    = $this->prodPresentacion_Model->get_PresentacionProd();
         $proveedorID                  = (isset($_POST['proveedor']))? $_POST['proveedor']:null;

         // conseguimos la informacion del proveedor
        // $infoProveedor  = $this->Proveedor_Model->get_infoProveedor($proveedorID);
         // clasf.clasfiscalID,  tipc.tipoContribID
         //$clasfiscalID  =  $infoProveedor->clasfiscalID;// (isset($_POST['clasfiscalID']))? $_POST['clasfiscalID']:null;
         //$tipoContribID =  $infoProveedor->tipoContribID;// (isset($_POST['tipoContribID']))? $_POST['tipoContribID']:null;


         
         $fecha                        = (isset($_POST['fechaCompra']))? $_POST['fechaCompra']:null;
         $tipocomprobante              = (isset($_POST['tipocomprobante']))? $_POST['tipocomprobante']:null;
         $numcomprobante               = (isset($_POST['numcomprobante']))? $_POST['numcomprobante']:null;
        
         
         $data                        = array(
                                                'empresaID'=> 1,
                                                'establecimientoID'=>$_SESSION["establecimientoID"],
                                                'compProdFecha'=>$fecha,                    
                                                'comprobanteTipo'=>$tipocomprobante,
                                                'comprobantenum'=>$numcomprobante,
                                                'proveedorID'=>$proveedorID,
                                                'usuarioID'  =>  $_SESSION["usuarioID"]
                                             );
                                             $datosprov=  array('tipocomprobante'=>$tipocomprobante,'proveedorID'=>$proveedorID );

         //var_dump($data );
         //exit ;
         $compraResultID =  $this->CompraProducto_Model->addCabeceracompra($data, $compraProdID);
         $datos["datosProvedor"] = $datosprov ;
        // var_dump($datos["datosProvedor"]);
         $datos["compraResultID"]    =$compraResultID;
         $this->load->view('compras/addProcompra', $datos);
         // echo  'lo qe se  tiene almacenado es' ;       
      }
   # FIN FUNCION ALMACENA LA CABERA DE LA COMPRA Y RETORNA EL ID DE  LA COMPRA



    //  FUNCION PARA ALMACENAR EL DETALLE DE LA COMPRA addDetCompra 
     public function saveDetCompra(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        $idtmp                   = null;  
        $proceso                 = 1;
       // datos para la configuracion del calculo de   costo del producto  
        
        $idCompra                = (isset($_POST['compraProdID'])) ? $_POST['compraProdID']:  null;
        $productoID              = (isset($_POST['producto'])) ? $_POST['producto']:  null;
        $proveedorID             = (isset($_REQUEST['proveedorID'])) ? $_REQUEST['proveedorID']:  null;
        $descripcion             = (isset($_POST['nameproductotmp'])) ? $_POST['nameproductotmp']:  null;
        $cantidad                = (isset($_POST['cantidad'])) ? $_POST['cantidad']:  0;
        $preCosto                = (isset($_POST['preCosto'])) ? $_POST['preCosto']:  0;
        $comprobanteTipo         = (isset($_POST['tipocomprobante'])) ? $_POST['tipocomprobante']:  0;
        //echo  'El producto Capturado es ' .   $productoID  ; 
        $InfoProducto            =  $this->Producto_Model->get_InfoProducto($productoID);
        //var_dump($InfoProducto  );
        $tipomovinvtId           =  $InfoProducto->tipomovinvtId; 
        $presentacion_invId      =  $InfoProducto->presentacion_invId; 
        $infoProveedor           =  $this->Proveedor_Model->get_infoProveedor($proveedorID);     
        $provClasfiscalID        =  $infoProveedor[0]->clasfiscalID;
        $provTipoContribID       =  $infoProveedor[0]->tipoContribID;
        $tipocomprobante_INPUT  =  $comprobanteTipo;

        $datosPrecalculo         = array( 'proceso'=>$proceso,
                                          'provClasfiscalID'=> $provClasfiscalID ,
                                          'provTipoContribID'=> $provTipoContribID, 
                                          'tipomovinvtId'=> $tipomovinvtId,
                                          'presentacion_invId'=> $presentacion_invId,
                                          'tipomovinvtId'=> $tipomovinvtId,
                                          'tipocomprobante_INPUT'=> $tipocomprobante_INPUT,
                                          'cantidad' => $cantidad, 
                                          'preCosto'=> $preCosto  
                                       );
        
                                       //echo 'echo  datos precalculo  ' . '<br>';
                                      // var_dump($datosPrecalculo);

       // intaciamos la clase para realizar el calculo del precio del prodducto  
         $CalculaPrecioProduc  =  new calculaPrecioProduc();
         $datosCalculados      =  $CalculaPrecioProduc->calculaPrecio($datosPrecalculo) ; 
         
         $datosCalculados = json_decode( $datosCalculados, true );
        // echo  'valor de iva Retornado'. $datosCalculados['subtotal']. '<br>';

         //$datosCalculados      = $datosCalculados;
        // var_dump($datosCalculados);
        // exit ; 
         
         //$sub_total             =  $cantidad *  $preCosto;
          //$impuesto              = 0 ;
         // $total                 = $sub_total+ $impuesto   ;
         $subtotal = 1400;
         $compProdIva = 10;
         $total = 230;



      //if($idCompra!=null ){
            $data =  array("compraProdID"=>  $idCompra, 
                           "productoID"=>$productoID,                           
                           "cantidad"=>$cantidad,
                           "precUnit"=>$preCosto,
                           "sub_total"=>$subtotal,
                           "impuesto"=>$compProdIva,
                           "total"=>$total,

                           );
        // var_dump($data);                  
         if($productoID !=null   and  $total> 0 ){
            //echo  'insertando el detalle de la compra ';
             $this->CompraProducto_Model->addtmpdetcompra($data, $idtmp);
            //  calculamos    y  retornamos los nuevos valores de total  
            $datostotaltmp =  $this->CompraProducto_Model->get_sumastotaltmp($idCompra);
            echo  json_encode($datostotaltmp);

         }else{
            echo   'No se puede almacenar el  productod';
         } 
        
      
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
    //  funcion  para obtener la  informacion del  proveedor  al  momento de seleccionarlo  

    public function addArrDetalle1(){
      
    } 
     // funcion lista las compras      
     public function get_infoProveedor(){ 
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL); 
      //  obtener los  datos de los proveedores  existentes  
      $datos_provedor=  $this->Proveedor_Model->get_infoProveedor();
       echo  json_encode($datos_provedor);
    

   
    }
    // funcion para obtener la informacion del producto (GRAVADO -- SERVICIO  O PRODUCTO COMO TAL)
     // funcion lista las compras      
    

      
}