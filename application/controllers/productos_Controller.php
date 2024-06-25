<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class productos_Controller extends CI_Controller {  
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
           $this->load->model('bodegaProducto_Model');
           $this->load->model('preciosProducto_Model');
           $this->load->model('inventProducto_Model');
           //preciosProducto_Model

           
           $this->load->helper('path');          
    }
    //Creamos la funncion para  agrear el menu  interno 
    public function listarProductos(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);        
        $data['listaProductos'] = $this->Producto_Model->get_listaProductos();
        $this->load->view('productos/producto',$data);
    }

    /*Funcion para cargar la modal para  registrar los  productos  */
     /* funcion para cargar la modal  para  procesar la venta del producto */
     public function addProducto($productoID){ 
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL); 
        $data['proveedorProducto']   = $this->Proveedor_Model->get_listaProveedores();
        $data['familiaProducto']     = $this->FamiliaProducto_Model->get_listFamiliaProducto();
        $data['tipoProducto']        = $this->TipoProducto_Model->get_listaTipoProducto();
        $data['medidaProducto']      = $this->MedidaProducto_Model->get_listaMedidaProducto();
        $data['MarcaProducto']       = $this->Marcas_Model->get_listaMarcaProducto();
        $data['prsentacionProducto'] = $this->PresentacioProducto_Model->get_listaPresentacionProducto();
        $data['datoproducto'] = $this->Producto_Model->get_productoID($productoID);

        $this->load->view('productos/addProducto',$data);
     }
     //    funcion para modificar los  datos del  producto 
     public function updateDatProducto($productoID){ 
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL); 
      $data['proveedorProducto']   = $this->Proveedor_Model->get_listaProveedores();
      $data['familiaProducto']     = $this->FamiliaProducto_Model->get_listFamiliaProducto();
      $data['tipoProducto']        = $this->TipoProducto_Model->get_listaTipoProducto();
      $data['medidaProducto']      = $this->MedidaProducto_Model->get_listaMedidaProducto();
      $data['MarcaProducto']       = $this->Marcas_Model->get_listaMarcaProducto();
      $data['prsentacionProducto'] = $this->PresentacioProducto_Model->get_listaPresentacionProducto();
      $data['datoproducto'] = $this->Producto_Model->get_productoID($productoID);

      $this->load->view('productos/addProducto',$data);
   }

     /*Funcion para almacenar el  producto */
     public function saveProducto(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL); 
        /*determinamos si  el producto ya  existe   */        
        $productoID       = NULL;
        $rIdProd          = 0;
        $bodegaProductoID = 1;

        $proveedorID     = (isset($_POST['proveedor'])) ? $_POST['proveedor']: NULL;
        $famProdID       = (isset($_POST['familia'])) ? $_POST['familia']: NULL;
        $tipProdID       = (isset($_POST['tipProducto'])) ? $_POST['tipProducto']: NULL;
        $marcProdID      = (isset($_POST['marca'])) ? $_POST['marca']: NULL; 
        $presProdID      = (isset($_POST['presentacion'])) ? $_POST['presentacion']: NULL;
        $medProdID       = (isset($_POST['medida'])) ? $_POST['medida']: NULL;
        $prodDescripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion']: NULL;

        $dataProd = array('prodDescripcion'=>$prodDescripcion,
                          'famProdID'=>$famProdID,
                          'presProdID'=>$presProdID,
                          'tipProdID'=>$tipProdID,
                          'marcProdID'=>$marcProdID,
                          'medProdID'=>$medProdID,
                          'proveedorID'=>$proveedorID
                          
                        );
       // var_dump($dataProd);
       //  hacemos la  insercion en la tabla de precios 
        $rIdProd  = $this->Producto_Model->addProducto( $dataProd,$productoID);
        if($rIdProd!=0){
          $resulbPrec =  $this->preciosProducto_Model->get_productoIDPrecios($rIdProd);
            if(Empty( $resulbPrec )){
              $precProdID = NULL;
              $data =array('productoID'=>$rIdProd ,  
                          'preciocosto' =>0,  
                          'precioventa' =>0);
              $this->preciosProducto_Model->addProductoPrec($data, $precProdID);
            }
            // hacemos la  insercion en  el   inventario
          $resulbInv = $this->inventProducto_Model->get_productoIDInventarios($rIdProd,$bodegaProductoID) ;
            if(Empty($resulbInv)){
              $invProdID = NULL;
              $data =array('productoID'=>$rIdProd ,  
                          'bodegaProductoID' =>$bodegaProductoID,  
                          'existenciaInvProd' =>0);
              $this->inventProducto_Model->addProductoInvent($data, $invProdID);
            }
        }
        


       

        //  hacemos la  insercion en la tabla de precios 
       // $precProdID = NULL;
       //$resulb =  $this->preciosProducto_Model->get_productoIDPrecios($productoID)

       // addProductoPrec($data, $precProdID){
        //inventarioproducto 
          // hacemos la  insercion en  el   inventario


     }
     /*Funcion paramostrar la  vista para  agregar datos del   invetario manual */
  public function addInventManual(){ 
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL); 
      $this->load->view('inventarios/tblingresar_inventario');  

  }
 


  /*funcion para  ingresar el detalle de coventampra del los  productos*/
  public function addVentaProducto(){ 
   ini_set('display_errors',1);
   ini_set('display_startup_errors',1);
   error_reporting(E_ALL); 
   $this->load->view('inventarios/venta_producto');
 }

 /*Funcio  para cargar las  congiraciones de los productos */
 public function setthingProduct(){
  ini_set('display_errors',1);
   ini_set('display_startup_errors',1);
   error_reporting(E_ALL); 
   $datos['familiaProducto']          = $this->FamiliaProducto_Model->get_listFamiliaProducto();
   $datos['turnos'] = $this->Producto_Model->get_turnooperacion();  
  //   var_dump(  $datos['familiaProducto'] );
   $this->load->view('configuraciones/configuraciones', $datos);


 }
 //  funcion para mostrar los productos que se ingresa   en  el  formulario   de compra  
 
 
 public function addProductoCompra(){ 
  ini_set('display_errors',1);
  ini_set('display_startup_errors',1);
  error_reporting(E_ALL); 
  //echo  'llegando al  controlador';
  $datos['ListProducto'] =  $this->Producto_Model->get_ListProducto();
  $this->load->view('productos/addProcompra', $datos);
}
// funcion para  actualizar los precios de  los productos

public function preciosProducto(){ 
  ini_set('display_errors',1);
  ini_set('display_startup_errors',1);
  error_reporting(E_ALL); 
  //echo  'llegando al  controlador';
  $datos['lista_productoCostear'] =  $this->preciosProducto_Model->lista_productoCostear();
  $this->load->view('inventarios/precios_producto', $datos);
}
   
// funcion  para actualizar los precio  del  los productos 
public function  updatePrecProd (){  
  $productoID     = (isset($_POST["productoID"]))?  $_POST["productoID"] : 0;
  $preciocosto    = (isset($_POST["preciocosto"]))?  $_POST["preciocosto"] : 0;
  $precioventa    = (isset($_POST["precioventa"]))?  $_POST["precioventa"] : 0;    
  $fechactualizado = date("Y-m-d H:i:s");
  # preparando el algoritmo para  refleja la  salida en  el kardex
 
  $data =  array( 'preciocosto'      => $preciocosto,
                  'precioventa'      => $precioventa,
                  'fechactualizado'  => $fechactualizado                       
                );
  //var_dump($data); 
  // usamos  una nueva sincronizacin  para probar el  commit              

  $this->preciosProducto_Model->updateProductoPrec($data, $productoID);


} 


   

  }
 