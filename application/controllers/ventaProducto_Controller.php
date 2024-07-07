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
    public function get_OrdenesPendientesCobro(){
      ini_set('display_errors',1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL); 
      $data['OrdenesPendientesCobro'] = $this->ordenesPedido_Model->get_OrdenesPendientesCobro();
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
   //  funcion para  imprimir el  ticket  de la  venta de producto 
   public function pdfCrearTicket($ordenPedidoID){
   
    ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        // include getcwd(). "/application/libraries/fpdf/fpdf.php";
        $this->pdf = new FPDF('P', 'mm', array(72.1,297));
        $this->pdf->AddPage();
        $this->pdf->AliasNbPages();
        $this->pdf->SetTitle("Ticket");
        
        $this->pdf->SetFont('Arial', 'B', 9);
        $archivo    = 'Ticket01';
         $id_sucursal   =  0;
         $DatdetalleOrden =  $this->ordenesPedido_Model->get_datosticket($ordenPedidoID);
      
        // para  poner los datos del   establecimiento 
        $datos      = $this->Conf_model->get_info_configuracion($id_sucursal);

         
        // var_dump( $datos_fac);

        $Ntiquete   = 0; //Numero de tiquete
        $Datetime   = 0; //Fecha del ticket
        $Cajero     = 0; //Tipo de cajero
        $Ware       = 0; //Warehouse
        $wareouse   = 0; 
        $Ntiquete   = str_pad($DatdetalleOrden[0]->ordenPedidoID, 10, "0", STR_PAD_LEFT); //Numero de tiquete
        
        //$this->pdf->SetFont('Times', '', 5);
         $this->pdf->SetFont('Arial', 'B', 6);
        $this->pdf->Image('assets/img/star.png', 11);
        $this->pdf->Ln(3);

        $this->pdf->Cell(0, 4, utf8_decode($datos->nameEmpresa), 0, 0, 'C');
        $this->pdf->Ln();
        
        $this->pdf->MultiCell(0, 4,utf8_decode($datos->direccion) , 0, 'C');
      
        $this->pdf->Cell(0, 4, 'NIT: '.utf8_decode($datos->nit), 0, 0, 'C');
        $this->pdf->Ln();

        $this->pdf->Cell(0, 4, 'NCR: '.utf8_decode($datos->ncr) . '120938383-4', 0, 0, 'C');
        $this->pdf->Ln();

        $this->pdf->Cell(0, 4, utf8_decode('GIRO:'), 0, 0, 'C');
        $this->pdf->Ln();

         $this->pdf->SetFont('Arial', 'B', 6);
        $this->pdf->MultiCell(0, 2,utf8_decode($datos->giro),  0, 'C',false);
        $this->pdf->Ln();

         $this->pdf->SetFont('Arial', 'B', 6);
        $this->pdf->Cell(52, 5, utf8_decode('CAJA: ') .utf8_decode($datos->caja), 'B', 0, 'C');
        $this->pdf->Ln();

         $this->pdf->SetFont('Arial', 'B', 6);
        $this->pdf->Cell(0, 3, utf8_decode('No. RESOLUCION:') . utf8_decode($datos->nresolucion), 0, 0, 'C');
        $this->pdf->Ln();

        $this->pdf->Cell(0, 3, utf8_decode('FECHA DE AUTORIZACION:') . utf8_decode($datos->fautorizacion), 0, 0, 'C');
        $this->pdf->Ln();

        $this->pdf->Cell(0, 3, utf8_decode('RANGO AUTORIZADO:'), 0, 0, 'C');
        $this->pdf->Ln();

        $this->pdf->Cell(0, 3, utf8_decode($datos->rango), 0, 0, 'C');
        $this->pdf->Ln();
        $this->pdf->Cell(0, 4, utf8_decode('NUMERO DE TIQUETE: ') . $Ntiquete, 0, 0, 'L');
        $this->pdf->Ln();

        $this->pdf->Cell(0, 4, date('d-m-Y h:i:s'), 0, 0, 'L');
        $this->pdf->Ln();

        $this->pdf->Cell(30, 4, utf8_decode('CAJERO(A): ') . utf8_decode($datos_fac[0]->cajero), 0, 0, 'L');
        $this->pdf->SetFont('Arial', 'B', '7');

       // $datos_fac =   $this->Importacion_Model->obtener_servicios_facturados($id_enc_Comprobante);

        $this->pdf->Cell(30, 4, utf8_decode('WAREHOUSE: ') . $wareouse, 0, 0, 'C');
        $this->pdf->Ln(8);

        $Cantidad   = 0; //CA 
        $Producto   = 0; //Nombre del producto
        $Preciouni  = 0; //Precio Unitario
        $Total      = 0; //Total
        $Tot        = 0; //Exento, No gravado, No sujeto, Cuentas ajenas 
        $TotalE     = 0;//exento
        $TotalA     = 0;//ajenas
        $TotalN     = 0;//no sujeto
        $TotalG     = 0;//gravado
        $TotalF     = 0;//Total a pagar


        $this->pdf->SetX(10);
        $this->pdf->SetFont('Arial', 'B', 6);
        $this->pdf->Cell(4, 4, "CA", 'B', 0, 'C');
        $this->pdf->Cell(24, 4, "PRODUCTO", 'B', 0, 'C');
        $this->pdf->Cell(11, 4, "P/U", 'B', 0, 'C');
        $this->pdf->Cell(15, 4, "TOTAL", 'B', 0, 'C');
        $this->pdf->Ln(8);
        //  se carga el detalle de  venta 
        //$datos_fac =   $this->Importacion_Model->obtener_servicios_facturados($id_enc_Comprobante);
       // var_dump($datos_fac);
        
          foreach ($datos_fac as $key=> $servicioFact) {
               $this->pdf->SetFont('Arial', 'B', 6);
              // validando quien es el que contiene el  valor 
             if ($servicioFact->kdx_no_sujeto != 0  ) {
                 $this->pdf->SetX(10);
                 $this->pdf->Cell(4, 6, number_format($servicioFact->cantidad,0),  0, 0, 'C');//CA
                $this->pdf->Cell(23, 6, str_replace('STAR SHIP', '',$servicioFact->descripcion), 0, 0, 'L');//Producto
                $this->pdf->Cell(13, 6, '$' .number_format($servicioFact->kdx_vta_total,2), 0, 0, 'R');//P/U
                $this->pdf->Cell(8, 6,  '$' .number_format($servicioFact->kdx_vta_total,2), 0, 0, 'R');//Total P/U
                $this->pdf->Cell(4, 6, 'N', 0, 0, 'C');//Exento, No gravado, No sujeto, Cuentas ajenas
                $this->pdf->Ln(8);
                $TotalN = $TotalN + $servicioFact->kdx_vta_total;
             }
             if ($servicioFact->kdx_gravado != 0) {
                 $this->pdf->SetX(10);
                 $this->pdf->Cell(4, 6, number_format($servicioFact->cantidad,0),  0, 0, 'C');//CA
                $this->pdf->Cell(23, 6, str_replace('STAR SHIP','',$servicioFact->descripcion), 0, 0, 'L');//Producto
                $this->pdf->Cell(13, 6, '$' .number_format($servicioFact->kdx_vta_total,2), 0, 0, 'R');//P/U
                $this->pdf->Cell(8, 6,  '$' .number_format($servicioFact->kdx_vta_total,2), 0, 0, 'R');//Total P/U
                $this->pdf->Cell(4, 6, 'G', 0, 0, 'C');//Exento, No gravado, No sujeto, Cuentas ajenas
                $this->pdf->Ln(8);
                 $TotalG = $TotalG + $servicioFact->kdx_vta_total;
             }
             if ($servicioFact->kdx_cuenta_ajena != 0) {
                 $this->pdf->SetX(10);
                 $this->pdf->Cell(4, 6, number_format($servicioFact->cantidad,0),  0, 0, 'C');//CA
                $this->pdf->Cell(23, 6, str_replace('STAR SHIP','',$servicioFact->descripcion), 0, 0, 'L');//Producto
                $this->pdf->Cell(13, 6, '$' .number_format($servicioFact->kdx_vta_total,2), 0, 0, 'R');//P/U
                $this->pdf->Cell(8, 6,  '$' .number_format($servicioFact->kdx_vta_total,2), 0, 0, 'R');//Total P/U
                $this->pdf->Cell(4, 6, 'A', 0, 0, 'C');//Exento, No gravado, No sujeto, Cuentas ajenas
                $this->pdf->Ln(8);
                $TotalA = $TotalA + $servicioFact->kdx_vta_total;
             }
             if ($servicioFact->kdx_exento != 0) {
                 $this->pdf->SetX(10);
                 $this->pdf->Cell(4, 6, number_format($servicioFact->cantidad,0),  0, 0, 'C');//CA
                $this->pdf->Cell(23, 6, str_replace('STAR SHIP','',$servicioFact->descripcion), 0, 0, 'L');//Producto
                $this->pdf->Cell(13, 6, '$' .number_format($servicioFact->kdx_vta_total,2), 0, 0, 'R');//P/U
                $this->pdf->Cell(8, 6, '$' .number_format($servicioFact->kdx_vta_total,2), 0, 0, 'R');//Total P/U
                $this->pdf->Cell(4, 6, 'E', 0, 0, 'C');//Exento, No gravado, No sujeto, Cuentas ajenas
                $this->pdf->Ln(8);
                 $TotalE = $TotalE + $servicioFact->kdx_vta_total;
             }


               
            /* if ($servicioFact->id_catalogo_producto != '22' and  $servicioFact->id_catalogo_producto != '34') {
                 $this->pdf->Cell(30, 12, '', '0', 0, 'L', '0');
                 $this->pdf->Cell(140, 12, $servicioFact->descripcion, '0', 0, 'L', '0');
                 $this->pdf->setX($DatosCordenadas['xposition_vgra']);
                 $this->pdf->Cell(20, 12, $servicioFact->venta_neta, '0', 0, 'L', '0'); // se le agrega el  iva al producto
                 $this->pdf->setX(10);
                 $this->pdf->Ln(5);
             }*/
             $TotalF = $TotalE + $TotalG + $TotalA + $TotalN;

         }
  

       /* for ($x = 0; $x <= 6; $x++) {
            $Preciouni = 100;
            $Total = 110;

            if ($x == 0) {
                $Tot = 'N';
                $TotalN = $TotalN + $Total;
            }
            if ($x >= 1 && $x <= 4) {
                $Tot = 'G';
                $TotalG = $TotalG + $Total;
            }
            if ($x == 5) {
                $Tot = 'A';
                $TotalA = $TotalA + $Total;
            }
            if ($x > 5) {
                $Tot = 'E';
                $TotalE = $TotalE + $Total;
            }
            $TotalF = $TotalE + $TotalG + $TotalA + $TotalN;

            $this->pdf->SetX(10);
            $this->pdf->Cell(4, 6, $Cantidad . '1', 0, 0, 'C');//CA
            $this->pdf->Cell(23, 6, $Producto . 'Tramite Aduanal', 0, 0, 'C');//Producto
            $this->pdf->Cell(13, 6, '$' . $Preciouni, 0, 0, 'C');//P/U
            $this->pdf->Cell(8, 6, '$' . $Total, 0, 0, 'C');//Total P/U
            $this->pdf->Cell(4, 6, $Tot, 0, 0, 'C');//Exento, No gravado, No sujeto, Cuentas ajenas
            $this->pdf->Ln(8);
        
        }*/

        //  despues del  detalle de la venta 
        $this->pdf->SetFont('Arial', 'B', 6);
        $this->pdf->Cell(20, 6, "VENTA GRAVADA", 'T', 0, 'L');
        $this->pdf->Cell(21, 6, "", 'T', 0, 'L');
        $this->pdf->Cell(15, 6, '$' . number_format($TotalG,2), 'T', 0, 'R');//Total Ventas gravadas
        $this->pdf->Ln();

        $this->pdf->Cell(20, 6, "VENTA EXENTA", 0, 0, 'L');
        $this->pdf->Cell(21, 6, "", 0, 0, 'L');
        $this->pdf->Cell(15, 6, '$' . number_format($TotalE,2), 0, 0, 'R');//Total Exenta
        $this->pdf->Ln();

        $this->pdf->Cell(20, 6, "VENTA NO SUJETA", 0, 0, 'L');
        $this->pdf->Cell(21, 6, "", 0, 0, 'L');
        $this->pdf->Cell(15, 6, '$' . number_format($TotalN,2), 0, 0, 'R'); //Total no sujeta
        $this->pdf->Ln();

        $this->pdf->Cell(22, 6, "COBROS POR CTA. AJENA", 'B', 0, 'L');
        $this->pdf->Cell(19, 6, "", 'B', 0, 'L');
        $this->pdf->Cell(14, 6, '$' . number_format($TotalA,2), 'B', 0, 'R');//Total Cuenta ajena
        $this->pdf->Ln(6);

         $this->pdf->SetFont('Arial', 'B', 6);
        $this->pdf->Cell(20, 6, "TOTAL A PAGAR:", 0, 0, 'L');
        $this->pdf->Cell(21, 6, "", 0, 0, 'L');
        $this->pdf->Cell(14, 6, '$' . number_format($TotalF,2), 0, 0, 'R'); //Total final
        $this->pdf->Ln();

        
        $tipoPago   = 'EFECTIVO'; //Efectivo,Tarjeta
        $recibido   = $TotalF;
        $cambio     = 0;
        $cliente    = 0;

        if ($cambio==0) {
            $cambio= '0.00';
        }
        

        $this->pdf->SetFont('Arial', 'B', 6);
        $this->pdf->Cell(0, 6, "TIPO DE PAGO: " . $tipoPago, 0, 0, 'L');//EFECTIVO,TAREJTA
        $this->pdf->Ln();
        $this->pdf->Cell(29, 6, "RECIBIDO: ", 0, 0, 'R');//CANTIDAD RECIBIDA EN EFECTIVO
        $this->pdf->Cell(11, 6, "", 0, 0, 'L');
        $this->pdf->Cell(14, 6, '$'.$recibido, 0, 0, 'L');
        $this->pdf->Ln();
        $this->pdf->Cell(29, 6, "CAMBIO: ", 0, 0, 'R'); //CAMBIO POR RECIBIDO
        $this->pdf->Cell(11, 6, "", 0, 0, 'L');
        $this->pdf->Cell(14, 6, '$'.$cambio, 0, 0, 'L');
        $this->pdf->Ln(10);
        $this->pdf->Cell(54, 6, "E=EXENTO, G=GRAVADO, N=NO SUJETO, A=CTA.AJENA", 'B', 0, 'C');
        $this->pdf->Ln(10);
        $this->pdf->SetFont('Times', 'B', 6);
        if($datos_fac[0]->nombrecliente !=  null  || $datos_fac[0]->nombrecliente ='' ){
                // str_replace('SAL', '', $datos_fac[0]->codigo_cliente) .' '.
               
                  $this->pdf->Cell(54, 6, $datos_fac[0]->nombrecliente, 0, 0, 'C');//CLIENTE TICKET
        }else{
            $this->pdf->Cell(54, 6, str_replace('SAL', '', $datos_fac[0]->codigo_cliente) .' '. $datos_fac[0]->nombre_cliente, 0, 0, 'C');//CLIENTE TICKET


        }
        
        $this->pdf->Ln();
        $this->pdf->Cell(0, 10, "DOCUMENTO: ", 'B', 0, 'L');
        $this->pdf->Ln();
        $this->pdf->Cell(0, 10, "NIT O DUI: ", 'B', 0, 'L');
        $this->pdf->Ln();
        $this->pdf->Cell(0, 10, "FIRMA: ", 'B', 'B', 'L');
        $this->pdf->Ln();
        $this->pdf->SetFont('Arial', 'B', 6);
        $this->pdf->Cell(0, 4, utf8_decode('LA MANERA SMART'), 0, 0, 'C');
        $this->pdf->Ln();
        $this->pdf->Cell(0, 4, utf8_decode('PARA COMPRAR EN LINEA'), 0, 0, 'C');
        
        // $destino = getcwd() . "/" . "FILE.php";

        //$this->pdf->Output($archivo  . '.pdf', 'f');
 
         $this->Ventas_Model->setimpreso($id_enc_Comprobante);

       $nombrecaja = 'CAJA'.$datos->caja;
       
        // SEGMENTO PARA DETERMINAR  LA CARPETA PARA GENERAR LOS COMPROBANTES 
        $search         =  array('Suc.', 'Plaza Comercial las','Sucursal','Agencia Multicentro', 'C.C. Paseo Venecia',  'Agencia Express CC');
        $suc_name       =  $_SESSION["nombre_sucursal"] ;
        $sucursal1       =  trim(str_replace($search, '',$suc_name ));

        $search1        =  array('_', '',' ');
        $sucursal       =  trim(str_replace($search1, '', $sucursal1));
       
        if($impreso ==  1){
            $destino      = getcwd() . "/document/reimpresiones/";
            $desabsoluto  =  "document/reimpresiones/";

        }else{
            $destino      = getcwd() . "/document/tickets/".$sucursal.'/'. $nombrecaja."/";
            $desabsoluto  =  "document/tickets/". $sucursal.'/'.$nombrecaja."/";

        }       
        if (!is_dir($destino)) {
            mkdir($destino, 0777, true);
        }
        $nombre_archivo =  'Ticket'.date("Ymd",strtotime(date("Y-m-d"))).$Ntiquete.'.pdf';
        //echo  'el nombre generado es ' . $nombre_archivo ;
        $this->pdf->Output("F", $destino . $nombre_archivo , true);
        $this->pdf->close();
        $datosretorno  = array('destino'        =>$desabsoluto, 
                               'nombre_archivo' =>$nombre_archivo,
                               'caja'           =>strval($datos->caja), 
                               

        );
        //header('Content-type: appliation/json');
        //echo json_encode($datosretorno);
        
        //echo 'lanzando la creacion del DTE';
        $dato_tipoevento   = $this->Ventas_Model->retorna_tipo_evento_ventas($id_enc_Comprobante) ; // 0=> manual,  1 => importacion,   2=> Exportacion
        $id_tipo_evento    = $dato_tipoevento->id_tipo_evento;
        $cod_generacion    = $dato_tipoevento->cod_generacion;
        $resultadoERR      = '';
        //echo   'eñ  codigo  de  generacion  es ' .  $cod_generacion;
        if($cod_generacion ==   null || $cod_generacion ==   null  || $cod_generacion == '') {
            $proceso  = 1;
            $facturaelectronica  = new Facturaelectronica();
            $resulgeneracio      =   $facturaelectronica->generarfacturaelectronica($id_tipo_evento, $id_enc_Comprobante);
            $resultadoERR =   $facturaelectronica->CtrlError($resulgeneracio, $id_cliente, $proceso, $id_enc_Comprobante);

        }

        //var_dump($resultadoERR);

        /*if ($resultadoERR=='') {
            echo json_encode($datosretorno);

        } else {
                echo json_encode($resultadoERR);

        }*/
      //header('Content-type: appliation/json');
        echo json_encode($datosretorno);
        





   }



     

  }