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
     function get_OrdenesPendientesCobro(mesaID){    
         
        var url = base_url('index.php/ventaProducto_Controller/get_OrdenesPendientesCobro/' + mesaID);   
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
   

  
