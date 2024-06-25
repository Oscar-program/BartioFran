<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Menu_internoController extends CI_Controller {  
    public function __construct()
    {
           parent::__construct();     
           $this->load->database();                  
           $this->load->model('Producto_Model');
           $this->load->model('bodegaProducto_Model');
           $this->load->model('PrecioEspecial_Model');
           $this->load->model('familiaProducto_Model');
           $this->load->model('ordenesPedido_Model');
           

           $this->load->helper('path');  
        
    }
    //Creamos la funncion para  agrear el menu  interno 
    public function index(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        
                $data['sds'] = $this->Producto_Model->get_producto();
                //var_dump($data['sds'] );
         
                 //$this->load->view('menuinterno/menu_interno');

        $this->load->view('menuinterno/menu_interno',$data);
    }
    public function cargar_submenu($famProdID){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
       // echo 'llegando al  menu interno de la familia de  productos'. $famProdID .  "<br>";
        $data['submenu'] = $this->Producto_Model->get_submenu($famProdID);
        //var_dump($data['submenu']);
        $data['comandas'] = $this->Producto_Model->get_comandas();
        $data['familia']  = $famProdID;
        //var_dump($data['comandas'] );
        $this->load->view('menuinterno/sub_menu',$data);

     }

    /* funcion para cargar la modal  para  procesar la venta del producto */
    public function addVentaProducto($famProdID, $id  ){  
        $data['comandas'] = $this->Producto_Model->get_comandas();
        $data['bodegas'] = $this->bodegaProducto_Model->get_listBodegaProducto();
        $data['precioespporfamilia'] = $this->PrecioEspecial_Model->ListPreciosEspPorFamiliaProd($famProdID);

        $this->load->view('menuinterno/add_ventaProducto',$data);
     

     }
     // funcion para cargar la pantalla principal de  ordenes  
     public function cargar_addordenes($mesaID){
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
        $meseroID  =  1;
        $mesaID    = $mesaID;
        $comandaID =  1;
        $ordenPedidoID =null;

       $dataarr  =  array( 'meseroID' =>$meseroID,
                            'mesaID' =>$mesaID,
                            'comandaID' =>$comandaID,
                        );
       // echo  'llegadno al controlador';                
       $ordenID  =  $this->ordenesPedido_Model->addOrdenPedido($dataarr, $ordenPedidoID); 

       
        $data['familia']  = $mesaID;
        $data['datordenID']  =    $ordenID ;

        //var_dump($data['comandas'] );
        $this->load->view('menuinterno/ordenesProducto',$data);
                      
        //return  $ordenID ;

     }
     

  }
 
