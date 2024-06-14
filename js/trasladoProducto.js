function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}
// funcion para listar los  traslados  realizados 
function  ListarTraslados(){
  var url = base_url('index.php/trasladoProducto_Controller/ListarTraslados/');

  //var url = base_url("index.php/BancosController/bancos");
      $.get(url, function (data) {
          $("#principal").html(data);
      });
  

}
 /*funcion para generar los traslados  */ 
 function addTrasladosProducto(){  
  console.log("iniciando la funcion de  traslado de  productos");
      //  creamos una variable de valor  aleatorio para crear el id  de la venta  
      var TrasladoId  =  new Date().getTime().toString();
      var  resultTrasID = TrasladoId.slice(-9);
      console.log('el id  generico es '+resultTrasID );

  var url = base_url('index.php/trasladoProducto_Controller/addTrasladosProducto/');

//var url = base_url("index.php/BancosController/bancos");
    $.get(url, function (data) {
        $("#principal").html(data);
        if(document.getElementById('trasladoID')){
          $("#trasladoID").val(resultTrasID);

        }
    });


 }




function saveTraslado(productoID, bodegaProductoID, identificador , bodegaProductoIDDes) {



    var cantidadtrasl = $("#cantidadtrasl" + identificador).val();
    var bodegaDest    = bodegaProductoIDDes;// $("#bodegaDest"    +identificador).val();  
    var  idTransac   = 0; 
    if(document.getElementById('trasladoID')){
      idTransac = $("#trasladoID").val();

    }   
    var DJson         = {
                         productoID:productoID, bodegaProductoID:bodegaProductoID, 
                         cantidadtrasl:cantidadtrasl, bodegaDest:bodegaDest, idTransac:idTransac
                        };  
	url_destino       = "index.php/trasladoProducto_Controller/saveTraslado/";
	
	console.log("Almacenando el  traslado del producto  ##########");
	
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
            alertify.success("Traslado efectuado correctamente");
          },
          complete: function () {
             
          }
        });


}