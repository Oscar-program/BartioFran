
function base_url(url){
  return window.location.origin + "/BartioFran/"+ url;
}
// funcion para cargar el  menu inteno Categoria de productos isponible  

function listarProductos(){
    console.log('intentando cargar el  menu interno');
    var url = base_url('index.php/productos_Controller/listarProductos/');
  
  //var url = base_url("index.php/BancosController/bancos");
      $.get(url, function (data) {
          $("#principal").html(data);
      });
  
    /*$.ajax({
         url:url, 
         type:"POST",
         data:'',
         success:function(data){
  
         }
    })*/
  }

  /*funcion para cargar la modal para  registrar los productos */
function addProducto(productoID){
    
    /*Determinamos si  los datos del  producto ya existen */
    var valorid  = 0;  
    //var productoID      =  null;
 
    var famProdID       =  1;
    var presProdID      =  1;
    var tipProdID       =  1;
    var marcProdID      =  1;
    var medProdID       =  1;
    var proveedorID     =  1;
   /* if(productoID!=0){
      console.log("Cargando id de  composicion de  productos");
        if(document.getElementById('famProdID')){
          famProdID = $("#famProdID").val();
        }
        if(document.getElementById('presProdID')){
          presProdID = $("#presProdID").val();
        }
        if(document.getElementById('tipProdID')){
          tipProdID = $("#tipProdID").val();
        }
    
        if(document.getElementById('marcProdID')){
          marcProdID = $("#marcProdID").val();
        }
    
        if(document.getElementById('medProdID')){
          medProdID = $("#medProdID").val();
        }
    
        if(document.getElementById('proveedorID')){
          proveedorID = $("#proveedorID").val();
        }

    }*/

    

      console.log("se ha hecho  click"+ productoID  + " capturado");
    var url = base_url('index.php/productos_Controller/addProducto/' + productoID);
   
    //var url = base_url("index.php/BancosController/bancos");
      $.get(url, function (data) {
        $("#vmodaladdProducto").html(data);
      //  document.getElementById('prodDescripcion').innerHTML=descripcion      
        $('#addProducto').modal('show');

        if(document.getElementById('famProdID')){
          famProdID = $("#famProdID").val();
        }
        if(document.getElementById('presProdID')){
          presProdID = $("#presProdID").val();
        }
        if(document.getElementById('tipProdID')){
          tipProdID = $("#tipProdID").val();
        }
    
        if(document.getElementById('marcProdID')){
          marcProdID = $("#marcProdID").val();
        }
    
        if(document.getElementById('medProdID')){
          medProdID = $("#medProdID").val();
        }
    
        if(document.getElementById('proveedorID')){
          proveedorID = $("#proveedorID").val();
          console.log( 'los  datos del  proveedor id  son ' + proveedorID);
        }else{
          console.log( 'no se encontro el  control del  proveedor ');
        }
      
        
        $("#proveedor").val(proveedorID);
        $("#proveedor").change();
  
        $("#familia").val(famProdID);
        $("#familia").change();
  
     
        $("#tipProducto").val(tipProdID);
        $("#tipProducto").change();
  
        $("#marca").val(marcProdID);
        $("#marca").change();
  
        $("#presentacion").val();
        $("#presentacion").change();
  
        $("#medida").val(medProdID);
        $("#medida").change();
      
      });
   
   }
 /*Funcion para almacena El  producto */
 function saveProducto(){
  var $productoID =  0;

  console.log('llegando a la  funcion para almacenar el producto');
  var formData;
  
	url_destino = "index.php/productos_Controller/saveProducto/";
	formData    = new FormData($(".formAddProducto")[0]);
	
	
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
          //  $('#addProducto').close('show');
            //$('#addProducto').modal('hide');
            $("#addProducto.close").click();
					  $(".modal-backdrop").remove();

            listarProductos();
          }
        });
	
 } 
 /*funcion para cargar el  inventario manual de   productos  */ 
 function addInventManual(){
  console.log('cargando la vista card para  agregar datos del   inventario');
  var url = base_url('index.php/productos_Controller/addInventManual/');

//var url = base_url("index.php/BancosController/bancos");
    $.get(url, function (data) {
        $("#principal").html(data);
    });


 }

  /*funcion para cargar l formulario principal de la compra   */ 
  function addCompraProducto(){  
    //  creamos una variable de valor  aleatorio para crear el id  de la venta  
    var CompraId  =  new Date().getTime().toString();
    var  result = CompraId.slice(-9);
    console.log('el id  generico es '+result );
    var url = base_url('index.php/compraProducto_Controller/addCompraProducto/');
  
  //var url = base_url("index.php/BancosController/bancos");
      $.get(url, function (data) {
          $("#principal").html(data);
          if(document.getElementById('idCompra')){
            $("#idCompra").val(result);
            $("#idCompra").change();
           // $("#txtfamProdID").val(datosFamilia[0].famProdID);
            console.log('Se hace el cambio de  valor  del control '+ result);
          }else {
            console.log('no se   encontro  el control  html ');
          }
      });
  
  
   }
     /*funcion para ingresar la venta de nuevo productos  */ 
  /*function addVentaProducto(){  
    var url = base_url('index.php/productos_Controller/addVentaProducto/');
  
  //var url = base_url("index.php/BancosController/bancos");
      $.get(url, function (data) {
          $("#principal").html(data);
      });
  
  
   }*/

   /*Cargando la  vista  de  configuracion de productos */
   function configurarProduct(){  
    console.log('llegando a la  configuracion del  producto');
    var url = base_url('index.php/productos_Controller/setthingProduct/');
  
  //var url = base_url("index.php/BancosController/bancos");
      $.get(url, function (data) {
          $("#principal").html(data);
      });
  
  
   }
   // funcion para  asginar los precios a los productos  
   function  preciosProducto(){
    console.log("Asignacion  de precios a productos  ");
    var url = base_url('index.php/productos_Controller/preciosProducto/');
  
    //var url = base_url("index.php/BancosController/bancos");
        $.get(url, function (data) {
            $("#principal").html(data);
        });

   }
   //   funcion para actualizar el precio del los productos 
   function updatePrecProd(productoID, identificador){
    var preciocosto = 0;
    var precioventa = 0;
    if(document.getElementById("precioventa"+ identificador)){
      precioventa =  $("#precioventa" + identificador).val(); 
    }
    if(document.getElementById("preciocosto"+ identificador)){
      preciocosto =  $("#preciocosto" + identificador).val(); 
    }

    //var precio = $("#precio" + identificador).val();
    //var bodegaDest    = bodegaProductoIDDes;// $("#bodegaDest"    +identificador).val();  
    //var  idTransac   = 0; 
    //if(document.getElementById('trasladoID')){
     // idTransac = $("#trasladoID").val();

    //}   
    var DJson         = {
                         productoID:productoID, preciocosto:preciocosto,precioventa:precioventa 
                         
                        };  
	url_destino       = "index.php/productos_Controller/updatePrecProd/";
	
	console.log("Actualizando el precio  del los productos  ##########");
	
	$.ajax({
          url: base_url(url_destino),
          type: "POST",
          data: DJson,
          // cache: false,
          //contentType: false,
          //processData: false,
          beforeSend: function () {
            // Show image container
            $("#loader").css("display", "block");
          },
          success: function (data) {
          //$("#codigoCliente").prop( "disabled", true);
            alertify.set("notifier", "position", "top-right");
            alertify.success("Precio actualizado correctamente");
          },
          complete: function () {
             
          }
        });


   } 

   //   funcion para motrar los  items de la tabla temporal  
  





