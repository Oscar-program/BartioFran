function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}
/*funcion para cargar la modal */
function addVentaProducto(famProdID, id, descripcion, preciocosto){    
    var valorid  = 0;   
    var url = base_url('index.php/ventaProducto_Controller/addVentaProducto/' + famProdID + "/"+  id);   
    //var url = base_url("index.php/BancosController/bancos");
      $.get(url, function (data) {
        $("#addVenta").html(data);
        //console.log(data);
        //document.getElementById('prodDescripcion').innerHTML=descripcion;
        $('#addVentaProducto').modal('show');
        // ponemos el  precio  de  costo del producto 
        $("#precioregular").val(preciocosto.toFixed(2));
        $("#productoID").val(id);
      });
   
   }
   // funcion para calcular el total de la venta  
   function calculartotalVenta(e){
    if(e.keyCode===13){
  
  
      var precioregular    = parseFloat($("#precioregular").val());
      var  precincremento  = parseFloat($("#precincremento").val());
      var  cantiadVenta    = $("#cantiadVenta").val();
      var total   = (precioregular + precincremento) *  cantiadVenta; 
     // console.log(precioregular + " "+ precincremento + " "+   cantiadVenta);
  
      //console.log("Se ha precionado enter sobr el control" + parseFloat(total));
      $("#totalVenta").val(parseFloat(total));
      e.preventDefault();
  
    }
   }
   // funion para  registrar la  venta saveVentaProducto
   function saveVentaProducto(){
   // console.log("Registrando la   venta del producto");
    var precioregular  = 0;
    var comanda        = 0; 
    var bodegaOrigen   = 0;
    var precincremento = 0;
    var cantiadVenta   = 0;
    var totalVenta     = 0;
    var ordenID        = 0; 
    var productoID     =  0;

    //$("#productoID").val(id);
    if(document.getElementById("productoID")){
        productoID = $("#productoID").val();
       // console.log("orden encontrado"+ ordenID);
    }


    if(document.getElementById("ordenID")){
        ordenID = $("#ordenID").val();
      //  console.log("orden encontrado"+ ordenID);
    }

    if(document.getElementById("precioregular")){
        precioregular= parseFloat($("#precioregular").val());
    }
    if(document.getElementById("comanda")){
        comanda= $("#comanda").val();
    }
    if(document.getElementById("bodsalida")){
        bodegaOrigen= $("#bodsalida").val();
    }
    if(document.getElementById("precincremento")){
        precincremento= parseFloat($("#precincremento").val());
    }
    if(document.getElementById("cantiadVenta")){
        cantiadVenta= $("#cantiadVenta").val();
    }
    if(document.getElementById("totalVenta")){
        totalVenta= parseFloat($("#totalVenta").val());
    }
    //ordenID:ordenID, 
    var DJson  = { ordenID:ordenID, 
                    productoID:productoID, 
                    precioregular:precioregular, 
                    comanda:comanda,
                    bodegaOrigen:bodegaOrigen,
                    precincremento:precincremento, 
                    cantiadVenta:cantiadVenta,
                    totalVenta:totalVenta, 
                    };  
        url_destino       = "index.php/ventaProducto_Controller/saveVentaProducto/";

        console.log("Almacenando Venta");
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
               
              $("#detOrdenesPedido").html(data);
              calculaTotalVenta(ordenID);
              $("#addVentaProducto.close").click();
              $(".modal-backdrop").remove();    
            },
            complete: function (data) {
               // console.log(data);
                   
               //  $("#detOrdenesPedido").html(data);
            }
          });
  
  
     } 
     // funcion  para  retornar la sumatoria del  detalle de la ord3en de cliente  
  function calculaTotalVenta(ordenID){
        //get_TotalDetOrden($ordenPedidoID)

       // var valorid  = 0;   
        var url = base_url('index.php/ventaProducto_Controller/get_TotalDetOrden/' + ordenID);   
        //var url = base_url("index.php/BancosController/bancos");
          $.get(url, function (data) {
           // $("#addVenta").html(data);
            console.log("El dato retornado es "+data);
            //document.getElementById('prodDescripcion').innerHTML=descripcion;
          //  $('#addVentaProducto').modal('show');
            // ponemos el  precio  de  costo del producto 
            $("#totalOrden").val(data);
            //$("#productoID").val(id);
          });



  }

     // funcion para mostrar las ordenes  pendientes de   cobro 
     function get_OrdenesPendientesCobro(){    
         
        var url = base_url('index.php/ventaProducto_Controller/get_OrdenesPendientesCobro/' );   
        //var url = base_url("index.php/BancosController/bancos");
          $.get(url, function (data) {
            $("#principal").html(data);
            //console.log(data);
            //document.getElementById('prodDescripcion').innerHTML=descripcion;
           // $('#addVentaProducto').modal('show');
            // ponemos el  precio  de  costo del producto 
            //$("#precioregular").val(preciocosto.toFixed(2));
            //$("#productoID").val(id);
          });
       
       }

       // funcion para  cargar la  orden seleccionada si esta  pendiente de cobro
       function ver_ordenePedido(ordenPedidoID){    
         
        var url = base_url('index.php/ventaProducto_Controller/ver_ordenePedido/' + ordenPedidoID);   
        //var url = base_url("index.php/BancosController/bancos");
          $.get(url, function (data) {
            $("#principal").html(data);
            //console.log(data);
            //document.getElementById('prodDescripcion').innerHTML=descripcion;
           // $('#addVentaProducto').modal('show');
            // ponemos el  precio  de  costo del producto 
            //$("#precioregular").val(preciocosto.toFixed(2));
            //$("#productoID").val(id);
          });
       
       }

       // funcion  para cerrar la  orden de pedido 
        /*Funcion para eliminar  un detallle de la  marca */
  function  delete_PresentacionProductoID(presProdID){
    // obtenemos  el id de la orden de pedido 
    var   ordenID = 0;
     if(document.getElementById('ordenID')){
       ordenID =  $("#ordenID").val()
     }
    swal({
      title: "Estas seguro de cerrar la venta y  realizar el  cobro ?",
      text: "Este proceso generar  un ticke con los  datos de la  compra",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((Delete) => {
      if (Delete) {
                  var url = base_url(
                    "index.php/presentacionProduct_Controller/delete_PresentacionProductoID/" + presProdID
                  );
                  $.get(url, function (data) {
                    if (data == 0) {
                          swal({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Surgio un error al  intentar cerrar la  venta',														
                          });
                    } else if (data == 1) {
                      swal("Ticket  realizado correctamente", {
                        icon: "success",
                      });
                      getDetalPresentacion();
                    }
  
                  });				
      } else {
        swal("Operacion  cancelada",{
          icon: "success",
        });
      }
    });
  }

  // funcion para  generar el   ticket de venta 
  //  funcion para lanzar el  pdf del  comprobante de tiket
function  crear_pdf_ticket(){	
	var ordenPedidoID 			= 0; 
  var ordPcomentario      = 'Sin Comentario';
  if(document.getElementById('ordenID')){
    ordenPedidoID =  $("#ordenID").val();
  }

  if(document.getElementById('txAcomentario')){
    
    ordPcomentario =  $("#txAcomentario").val();
  //   if($("#txAcomentario").val().leng){
    //  ordPcomentario =  $("#txAcomentario").val();
    // }
   
  }

    //  ordPcomentario =  $("#txAcomentario").val();
    // }


  //console.log("generando la   opcion de  i,presion de  ticket")

  swal({
    title: "Estas seguro de cerrar la ordern ?",
    text: "Este proceso cerrara la oden de pedido y no podra agregar mas  productos",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((Delete) => {
    if (Delete) {
      var url = base_url(
        "index.php/ventaProducto_Controller/pdfCrearTicket/"  + ordenPedidoID  + "/" + ordPcomentario
      );
      $.get(url, function (data) {	
         var datos = JSON.parse(data);
        // var caja             = datos["caja"];
         var repositorio      = datos["destino"];
         var comprobante      = datos["nombre_archivo"];
         var documentomostrar = repositorio + comprobante;		 
         //crear_cintaelectronic(caja);
         ver_ticketPDF(documentomostrar);
         listarMesas();
        
      });			
    } else {
      swal("Operacion  cancelada",{
        icon: "success",
      });
    }
  });

  
	//let idCliente 				= $("#idCliente").val();
	//let id_enc_Comprobante 		= $("#idVenta").val();
	/*var url = base_url(
		"index.php/ventaProducto_Controller/pdfCrearTicket/"  + ordenPedidoID  + "/" + ordPcomentario
	);
	$.get(url, function (data) {	
		 var datos = JSON.parse(data);
		// var caja             = datos["caja"];
		 var repositorio      = datos["destino"];
		 var comprobante      = datos["nombre_archivo"];
		 var documentomostrar = repositorio + comprobante;		 
		 //crear_cintaelectronic(caja);
		 ver_ticketPDF(documentomostrar);
		
	});*/
} 

function ver_ticketPDF(ruta) {
	var url = ruta;
	window.open(
		base_url(url),
		"ventana1",
		"width=600,height=600,scrollbars=no,toolbar=no, titlebar=no, menubar=no"
	);
}

//  funcion para determinar si en la bodega de la cual se quiere vender un  producto   tiene exixtencia 
function chekStockProduct(){

   var  productoID       = 0 ;
   var  bodegaProductoID = 0;
   if(document.getElementById('productoID')){
    productoID = $('#productoID').val();
   }

   if(document.getElementById('bodsalida')){
    bodegaProductoID = $('#bodsalida').val();
   }
  // chekStockProduct($productoID,$bodegaProductoID)

  console.log("funcion para determinar si  un  producto tiene existencia");
  var url = base_url(
		"index.php/ventaProducto_Controller/chekStockProduct/"  + productoID  + "/" + bodegaProductoID
	);
	$.get(url, function (data) {	
		  if(data<=0){
        swal("La bodega que ha seleccionado  no  tiene existencia, se sugiere  hacer un traslado de producnto",{
          icon: "warning",
        });

          // console.log("El producto no tiene existencia");
      }
		
	});

}





        /*$.ajax({
                    url: base_url(url_destino),
                    type: "POST",
                    data: DJson,
                    // cache: false,
                    //contentType: false,
                    //processData: false,
                    beforeSend: function () {
                        //$("#loader").css("display", "block");
                    },
                    success: function () {
                        alertify.set("notifier", "position", "top-right");
                        alertify.success("Traslado efectuado correctamente");
                    },
                    complete: function (){    
                        // $("#loader").css("display", "none");            
                        // $("#addVentaProducto.close").click();
                        // $(".modal-backdrop").remove();        
                        // $("#detOrdenesPedido").html(data);
                    }
                });*/
   

  
