function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}
 /*funcion para cargar l formulario principal de la compra, selecciona, fecha, tipo comprobantye  y proveedor    */ 
 function addCompraProducto(){  
  
  var url = base_url('index.php/compraProducto_Controller/addCompraProducto/');

    $.get(url, function (data) {
        $("#principal").html(data);
    
        document.getElementById('btnSaveCompra').disabled = true;
    });


 }


   // funcion  para  cargar la modal de ingreso de producto en  factura de compra  
   function addDetCompra(){
    //console.log("Almacenando el detalle de la compra ");
        
        /*Determinamos si  los datos del  producto ya existen */
       // console.log("llegando a la funcion para mostrar los produtos que se ingresan a la compra##### ");       
       var url             = base_url('index.php/compraProducto_Controller/addDetCompra/');
       var writeInTable  = true;

       /*if($("#producto").val()==0){
          alertify.set("notifier", "position", "top-right");
          alertify.error("Tiene que seleccionar un producto");
          writeInTable  = false;
          return false; 
        }

        if($("#prodPresentacion").val()==0){
          alertify.set("notifier", "position", "top-right");
          alertify.error("Tiene que seleccionar una presenta de  producto");
          writeInTable  = false;
          return false;
        }

        if($("#cantidad").val()=0){
          alertify.set("notifier", "position", "top-right");
          alertify.error("Tiene ingresar una cantida mayor a cero");
          writeInTable  = false;
          return false;
        }

        if($("#preCosto").val()=0){
          alertify.set("notifier", "position", "top-right");
          alertify.error("Tiene ingresar un precio costo mayor  a cero");
          writeInTable  = false;
          return false;
        }*/

                           
        if(writeInTable  == true){
          $.ajax({
                        url: url ,
                        type: "POST",
                        data: $("#FormCompras").serialize(),
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


        }
   
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
    var idCompra       = 0;
    var productoID     = 0;
    var writeInTable   = true;   
    var formData;

       if($("#producto").val()==0){
          alertify.set("notifier", "position", "top-right");
          alertify.error("Tiene que seleccionar un producto");
          writeInTable  = false;
          return false; 
        }

        if($("#prodPresentacion").val()==0){
          alertify.set("notifier", "position", "top-right");
          alertify.error("Tiene que seleccionar una presenta de  producto");
          writeInTable  = false;
          return false;
        }

        if($("#cantidad").val()=0){
          alertify.set("notifier", "position", "top-right");
          alertify.error("Tiene ingresar una cantida mayor a cero");
          writeInTable  = false;
          return false;
        }

        if($("#preCosto").val()=0){
          alertify.set("notifier", "position", "top-right");
          alertify.error("Tiene ingresar un precio costo mayor  a cero");
          writeInTable  = false;
          return false;
        }

  
    console.log('almacenando el detalle de la compra');
    if(writeInTable   == true){
      url_destino = "index.php/CompraProducto_Controller/saveDetCompra/";
      //formData    = new FormData($(".formAddProducCompra")[0]);
      formData    =$("#formAddProducCompra");
      $.ajax({
            url: base_url(url_destino),
            type: "POST",
            data: formData.serialize(),
            // cache: false,
            //contentType: false,
            //processData: false,
            beforeSend: function () {
              // Show image container
             // $("#loader").css("display", "block");
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
            dataType:'json',
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
    // funcion que  obtiene la  informacion del proveedor 
    
   

