function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}

 //   funcion ára  mostrar la  lista general  de  compras 
 function get_ListCompras(){
        
  /*Determinamos si  los datos del  producto ya existen */
  //var valorid         = 0;  
  //var productoID      =  null;  
  //var idCompratmp     =  $("#idCompra").val();  
  console.log("Listando copras   ingresadas ");
  var url = base_url('index.php/compraProducto_Controller/get_ListCompras');

  //var url = base_url("index.php/BancosController/bancos");
  $.get(url, function (data) {
      $("#principal").html(data);
           
  });

}

// funcion  para  cargar la modal de ingreso de producto en  factura de compra  
   function addProducCompra(){
        
        /*Determinamos si  los datos del  producto ya existen */
        var valorid  = 0;  
        var productoID      =  null;  
        var idCompratmp =  $("#idCompra").val();  
        console.log("llegando a la funcion para mostrar los produtos que se ingresan a la compra ");
        var url = base_url('index.php/productos_Controller/addProductoCompra/');
    
        //var url = base_url("index.php/BancosController/bancos");
        $.get(url, function (data) {
            $("#addProductCompra").html(data);
            // document.getElementById('prodDescripcion').innerHTML=descripcion
            $('#addProducCompra').modal('show');
            $("#idCompratmp").val(idCompratmp)        
        });
   
   }
   /*Funcion para almacena El  producto */
   function saveTmpCompra(){
    var $productoID =  0;
  
    console.log('llegando guardando la  ventaTemp');
      var formData;
    
      url_destino = "index.php/compraProducto_Controller/addtmpdetcompra/";
      formData    = new FormData($(".formAddProducCompra")[0]);
      $.ajax({
            url: base_url(url_destino),
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
              // Show image container
              $("#loader").css("display", "block");
            },
            success: function (data) {
            //$("#codigoCliente").prop( "disabled", true);
              //alertify.set("notifier", "position", "top-right");
              //alertify.success("El producto se guardo correctamente");
            },
            complete: function () {
              // Show image container
              $("#loader").css("display", "none");
              $("#cantidad").val(0);
              $("#preCosto").val(0);
           
              recalculartotal();
              get_ListTmp();
            }
          });
      
   }
     
    function get_ListTmp(){
      
      /*Determinamos si  los datos del  producto ya existen */
      var valorid  = 0;  
      var productoID      =  null;   
      var idCompra =  $("#idCompra").val();  
      console.log("llegando a la funcion para mostrar los produtos que se ingresan a la compra ");
      var url = base_url('index.php/compraProducto_Controller/get_ListTmp/'+idCompra);
     
      //var url = base_url("index.php/BancosController/bancos");
        $.get(url, function (data) {
          $("#detTmpCompra").html(data);
          //  document.getElementById('prodDescripcion').innerHTML=descripcion
          //$('#addProducCompra').modal('show');        
        });
     
    }
     // Funcion para  recalcular la  sumatoria del  comprobante  
        
    function recalculartotal(){    
      /*Determinamos si  los datos del  producto ya existen */
      var valorid  = 0;  
      var idCompra =  $("#idCompra").val(); 
  
        console.log("llegando a la funcion para recalcular  la compra ");
      var url = base_url('index.php/compraProducto_Controller/get_sumastotaltmp/'+ idCompra );
     
      //var url = base_url("index.php/BancosController/bancos");
        $.get(url, function (data) {
          //console.log(data);
          var DatosCompra  =  JSON.parse(data);
          $("#sumas").val(DatosCompra['sumas']);
          $("#impuesto").val(DatosCompra['impuestos']);
          $("#total").val(DatosCompra['totalcompra']);
         
        //  document.getElementById('prodDescripcion').innerHTML=descripcion
          //$('#addProducCompra').modal('show');
         
        
        });
     
    }
    function saveTransacCompraproducto(){
    //  funcion para  guardar la cabecesra de la   venta 
    var proveedor        =  0;
    var fecha            = '';
    var sumas            = 0;
    var impuesto         = 0;
    var total            = 0; 
    var tipocomprobante  = 0
    var numComprobante   = 0;
    var idCompratmp      = 0;

   console.log("GUARDANDO COMPRAS DE LOS  PRODUCTOS");
  if(document.getElementById('idCompratmp')){
      idCompratmp =  $("#idCompratmp").val();
  }


  if(document.getElementById('tipocomprobante')){
      tipocomprobante =  $("#tipocomprobante").val();
  }
  if(document.getElementById('numComprobante')){
    numComprobante =  $("#numComprobante").val();
  }

    if(document.getElementById('proveedor')){
        proveedor =  $("#proveedor").val();
    }
    if(document.getElementById('fechaing')){
        fecha =  $("#fechaing").val();
    }

    if(document.getElementById('sumas')){
        sumas =  $("#sumas").val();
    }
    if(document.getElementById('impuesto')){
        impuesto =  $("#impuesto").val();
    }
    if(document.getElementById('total')){
        total =  $("#total").val();
    }
      var json ={
                idCompratmp:idCompratmp,
                tipocomprobante:tipocomprobante, 
                numComprobante:numComprobante, 
                proveedor:proveedor, fecha:fecha, 
                sumas:sumas, impuesto:impuesto,
                total,total 
               };
    
    
      url_destino = "index.php/compraProducto_Controller/saveTransacCompraproducto/";
      //formData    = new FormData($(".formAddProducCompra")[0]);
      $.ajax({
            url: base_url(url_destino),
            type: "POST",
            data: json,
           // cache: false,
           // contentType: false,
           // processData: false,
            beforeSend: function () {
              // Show image container
              $("#loader").css("display", "block");
            },
            success: function (data) {
            //$("#codigoCliente").prop( "disabled", true);
              //alertify.set("notifier", "position", "top-right");
              //alertify.success("El producto se guardo correctamente");
            },
            complete: function () {
              // Show image container
              $("#loader").css("display", "none");
              $("#cantidad").val(0);
              $("#preCosto").val(0);
              get_ListCompras();
           
              //recalculartotal();
              // get_ListTmp();
            }
          });

    
   
   
   
   
   
    

    }
   

