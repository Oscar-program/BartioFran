function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}
 /*funcion para cargar l formulario principal de la compra   */ 
 function addCompraProducto(){  
  //  creamos una variable de valor  aleatorio para crear el id  de la venta  
  //var CompraId  =  new Date().getTime().toString();
  //var  result = CompraId.slice(-9);
  //console.log('el id  generico es '+result );
  var url = base_url('index.php/compraProducto_Controller/addCompraProducto/');

//var url = base_url("index.php/BancosController/bancos");
    $.get(url, function (data) {
        $("#principal").html(data);
       // $("#btnSaveCompra").css("display", "none");
        document.getElementById('btnSaveCompra').disabled = true;
        
       /* if(document.getElementById('idCompra')){
          $("#idCompra").val(result);
          $("#idCompra").change();
         // $("#txtfamProdID").val(datosFamilia[0].famProdID);
          console.log('Se hace el cambio de  valor  del control '+ result);
        }else {
          console.log('no se   encontro  el control  html ');
        }*/
    });


 }


   // funcion  para  cargar la modal de ingreso de producto en  factura de compra  
   function addDetCompra(){
        
        /*Determinamos si  los datos del  producto ya existen */
        console.log("llegando a la funcion para mostrar los produtos que se ingresan a la compra##### ");       
       var url             = base_url('index.php/compraProducto_Controller/addDetCompra/');
        var fecha           = (document.getElementById('fechaCompra'))? $("#fechaCompra").val():null;
        var tipocomprobante = (document.getElementById('tipocomprobante'))? $("#tipocomprobante").val():null;
        var numcomprobante  = (document.getElementById('numcomprobante'))? $("#numcomprobante").val():0;
        var proveedor       = (document.getElementById('proveedor'))? $("#proveedor").val():null;
        var jSON            = {fecha:fecha, tipocomprobante:tipocomprobante,  numcomprobante:numcomprobante, proveedor:proveedor };
        $.ajax({
               url: url ,
               type: "POST",
               data: jSON,
               //cache: false,
               //contentType: false,
               //processData: false,
               beforeSend: function(){},
               success:function(data){
               // console.log(data);
                $("#conteModalDetCompra").html(data);          
                $('#adddetProducCompra').modal('show');
               },
               complete:function(){}
        }) ; 
        /*//var idCompratmp =  $("#idCompra").val();  
        console.log("llegando a la funcion para mostrar los produtos que se ingresan a la compra##### ");
        //var url = base_url('index.php/productos_Controller/addProductoCompra/');
        //adddetCompraarr*/
        /*var url = base_url('index.php/compraProducto_Controller/addDetCompra/');
    
        //var url = base_url("index.php/BancosController/bancos");
        $.get(url, function (data) {
            //  comentado solo para  trabajar con el  array 
            $("#conteModalDetCompra").html(data);          
            $('#adddetProducCompra').modal('show');
           // $("#idCompratmp").val(idCompratmp)    *   
        });*/
   
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
   function iniciaArr(){
        
    /*Determinamos si  los datos del  producto ya existen */
    var valorid  = 0;  
    var productoID      =  null;  
    var idCompratmp =  $("#idCompra").val();  
    console.log("llegando a la funcion para mostrar los produtos que se ingresan a la compra ");
    //var url = base_url('index.php/productos_Controller/addProductoCompra/');
    //adddetCompraarr
    var url = base_url('index.php/compraProducto_Controller/createArray/');

    //var url = base_url("index.php/BancosController/bancos");
    $.get(url, function (data) {
        //  comentado solo para  trabajar con el  array 
        /*$("#addProductCompra").html(data);
      
        $('#addProducCompra').modal('show');
        $("#idCompratmp").val(idCompratmp)    */    
    });

}

   /*Funcion para almacena El  producto */
   function saveTmpCompra(){
    var $productoID =  0;
  
    console.log('almacenando el detalle de la compra');
      var formData;
      var idCompra = 0;
    
      url_destino = "index.php/CompraProducto_Controller/addtmpdetcompra/";
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
              console.log(data);
              var datosCompra =JSON.parse(data);
              $("#sumas").val(datosCompra['sumas']);
              $("#sumas").change();
              $("#compProdIva").val(datosCompra['impuestos']);
              $("#compProdIva").change();
              $("#compProdTotal").val(datosCompra['totalcompra']);
              $("#compProdTotal").change();
              idCompra =  datosCompra['compraProdID'];
              
              
              


            //$("#codigoCliente").prop( "disabled", true);
              //alertify.set("notifier", "position", "top-right");
              //alertify.success("El producto se guardo correctamente");
            },
            complete: function () {
              // Show image container
              $("#loader").css("display", "none");
              $("#cantidad").val(0);
              $("#preCosto").val(0);
              document.getElementById('btnSaveCompra').disabled = false;
           
              //recalculartotal();
              get_ListTmp(idCompra);
             // $("#btnSaveCompra").css("display", "block");
            }
          });
      
   }
     
    function get_ListTmp(compraProdID){
      
      /*Determinamos si  los datos del  producto ya existen */
      console.log("llegando a la funcion para mostrar los produtos que se ingresan a la compra ");
      //var idCompra =  $("#compraProdID").val();  
      console.log("el id de la compra es " + compraProdID  );    
      var url = base_url('index.php/CompraProducto_Controller/get_ListTmp/'+ compraProdID);
     
      //var url = base_url("index.php/BancosController/bancos");
        $.get(url, function (data) {
          $("#detCompra").html(data);
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
   

