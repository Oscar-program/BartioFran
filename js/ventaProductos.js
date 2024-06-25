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
    console.log("Registrando la   venta del producto");
    var precioregular  = 0;
    var comanda        = 0; 
    var bodegaOrigen      = 0;
    var precincremento = 0;
    var cantiadVenta   = 0;
    var totalVenta     = 0;
    if(document.getElementById("precioregular")){
        precioregular= parseFloat(document.getElementById("precioregular"));
    }
    if(document.getElementById("comanda")){
        comanda= document.getElementById("comanda");
    }
    if(document.getElementById("bodsalida")){
        bodegaOrigen= document.getElementById("bodsalida");
    }
    if(document.getElementById("precincremento")){
        precincremento= parseFloat(document.getElementById("precincremento"));
    }
    if(document.getElementById("cantiadVenta")){
        cantiadVenta= document.getElementById("cantiadVenta");
    }
    if(document.getElementById("totalVenta")){
        totalVenta= parseFloat(document.getElementById("totalVenta"));
    }
    var DJson         = {
        productoID:productoID, precioregular:precioregular, 
        comanda:comanda, bodegaOrigen:bodegaOrigen, precincremento:precincremento, cantiadVenta:cantiadVenta,totalVenta:totalVenta 
       };  
        url_destino       = "index.php/ventaProducto_Controller/saveVentaProducto/";

        console.log("Almacenando el  traslado del producto  ##########");

        $.ajax({
        url: base_url(url_destino),
        type: "POST",
        data: DJson,
        // cache: false,
        //contentType: false,
        //processData: false,
        beforeSend: function () {

        $("#loader").css("display", "block");
        },
        success: function (data) {
        alertify.set("notifier", "position", "top-right");
        alertify.success("Traslado efectuado correctamente");
        },
        complete: function () {
            $("#loader").css("display", "none");            
            $("#addVentaProducto.close").click();
             $(".modal-backdrop").remove();

        }
        });

   }
