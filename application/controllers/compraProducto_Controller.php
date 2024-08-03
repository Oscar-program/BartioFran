<?php 
$GLOBALS['idCompra'] = 0;
$GLOBALS['idCompratmp'] = 0;
defined('BASEPATH') OR exit('No direct script access allowed');

class compraProducto_Controller extends CI_Controller {  
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
           $this->load->model('compraProducto_Model');        

           $this->load->helper('path');  
        
    }
    //  funcion para cargar  la vista principal de  compras 
    public function get_ListCompras(){ 
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL); 
      //  obtener los  datos de los proveedores  existentes  
      $datos['listCompras'] =  $this->compraProducto_Model->get_ListCompras();
      $this->load->view('compras/listaComprasProducto', $datos);

   
    }

     /*funcion para  ingresar el detalle de compra del los  productos*/
 public function addCompraProducto(){ 
   ini_set('display_errors',1);
   ini_set('display_startup_errors',1);
   error_reporting(E_ALL); 
   //  obtener los  datos de los proveedores  existentes  
   $datos['proveedores'] =  $this->Proveedor_Model->get_listaProveedores();

   $this->load->view('inventarios/compra_producto', $datos);
 }

    //  funcion  para  insertar el  producto temporal 
    public function addtmpdetcompra(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        /* Creamos una variable para determinar el  modelo  a ejecutar*/
        //
        //echo 'llegando al  controlador';
        $idtmp = null;       
        if($_POST['idtmp']!=''){         
          $idtmp = $_POST['idtmp'];
        }

        $idCompra             = (isset($_POST['idCompratmp'])) ? $_POST['idCompratmp']:  null;
        $productoID           = (isset($_POST['producto'])) ? $_POST['producto']:  null;
        $descripcion          = (isset($_POST['nameproductotmp'])) ? $_POST['nameproductotmp']:  null;
        $cantidad             = (isset($_POST['cantidad'])) ? $_POST['cantidad']:  0;
        $preCosto             = (isset($_POST['preCosto'])) ? $_POST['preCosto']:  0;
        $sub_total            =  $cantidad *  $preCosto;
        $impuesto             = 0 ;
        $total                = $sub_total+ $impuesto   ;
      if($idCompra!=null ){
            $data =  array("idCompra"=>  $idCompra, 
                           "productoID"=>$productoID, 
                           "descripcion"=>$descripcion,  
                           "productoID"=>$productoID,
                           "cantidad"=>$cantidad,
                           "precUnit"=>$preCosto,
                           "sub_total"=>$sub_total,
                           "impuesto"=>$impuesto,
                           "total"=>$total,

                           );
         //var_dump($data);                  
         if($productoID !=null   and  $total> 0 ){
            $result = $this->compraProducto_Model->addtmpdetcompra($data, $idtmp);
         }else{
            //echo   'No se puede almacenar el  productod';
         } 
      }else{
         //echo 'el id de la compra es  null  no se  puede  procesar ';
      }
        
      
    }
   // 
    public function get_ListTmp($idCompra){ 
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL); 
        //$idCompra = (isset($_POST['idCompra'])) ? $_POST['idCompra']:  null;
        //echo  'Se mantiene la valiable globla'.  $idCompra ;
        
        $datos['ListTmpCompra'] =  $this->compraProducto_Model->get_ListTmp( $idCompra);
        $this->load->view('productos/detTmpCompra', $datos);
      }
      //  funcion  para obtener  los totales   de las compras  
      public function get_sumastotaltmp($idCompra){ 
         ini_set('display_errors',1);
         ini_set('display_startup_errors',1);
         error_reporting(E_ALL); 
         //$idCompra = (isset($_POST['idCompra'])) ? $_POST['idCompra']:  null;
         //echo  'Se mantiene la valiable globla'.  $idCompra ;
         
         $datostotaltmp =  $this->compraProducto_Model->get_sumastotaltmp($idCompra);
         echo   json_encode($datostotaltmp);
       }
       //  segmento para almacenar la compra detalle de  compra   y movimientos en  el kardex  
      public function saveTransacCompraproducto(){
         //  ontenemos el   idtemprotal  dela compra 
         ini_set('display_errors',1);
         ini_set('display_startup_errors',1);
         error_reporting(E_ALL); 
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
            $datoProducto =  $this->inventProducto_Model->get_productoIDInventarios($productoID,$bodegaProductoID);
            if(!empty($datoProducto)){
                // Actualizamos el  inventario  sino Creamos la linea  en el inventario  del producto 

            }else{
               
            }

            # fin  del segmento para actualizar el inventario  
          

           //creadno el   array para  el  kardex  

           $kardexProdID = NULL;
      
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
            $this->compraProducto_Model->addMoVKardex($dataDetkardex, $kardexProdID) ;                    
         }



      } 


      
}