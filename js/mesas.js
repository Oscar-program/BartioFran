 function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}

 //   muestra las mesas q
 function listarMesas(areasEstablecimientoID){
    console.log("Listando las mesas  ????????? MODIFICADO ");
    var url = base_url('index.php/mesa_Controller/listarMesas/' + areasEstablecimientoID);
    //var url = base_url("index.php/BancosController/bancos");
    $.get(url, function (data) {
        $("#principal").html(data);
            
    });

}

// funcion para crear una nueva mesa  
function insertarMesaEstablecimiento(){
  var mesaID                   = (document.getElementById('mesaID').Value.length>0)                 ? document.getElementById('mesaID').Value : "" ;
  var establecimientoID        = (document.getElementById('establecimientoID').Value.length>0)      ? document.getElementById('establecimientoID').Value : "" ; 
  var areasEstablecimientoID   = (document.getElementById('areasEstablecimientoID').Value.length>0) ? document.getElementById('areasEstablecimientoID').Value : "" ;  
  var mesNombre                = (document.getElementById('mesNombre').Value.length>0)              ? document.getElementById('mesNombre').Value : "" ; 
  var mescapacidad             = (document.getElementById('mescapacidad').Value.length>0)           ? document.getElementById('mescapacidad').Value : "" ; 
  var obJson = {mesaID:mesaID, establecimientoID:establecimientoID, areasEstablecimientoID:areasEstablecimientoID, mesNombre:mesNombre,  mescapacidad:mescapacidad };
 

   var $productoID =  0;
  console.log('llegando a la  funcion para almacenar el producto');
  var formData;  
	url_destino = "index.php/mesa_Controller/insertarMesaEstablecimiento/";
	//formData    = new FormData($(".formAddProducto")[0]);	
	$.ajax({
          url: base_url(url_destino),
          type: "POST",
          data: obJson,
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function () {
            // Show image container
           // $("#loader").css("display", "block");
          },
          success: function (data) {
          $("#codigoCliente").prop( "disabled", true);
            alertify.set("notifier", "position", "top-right");
            alertify.success("Dato almacenado correctamente");
          },
          complete: function () {
            // Show image container
            //$("#loader").css("display", "none");
            //  $('#addProducto').close('show');
            //$('#addProducto').modal('hide');
           // $("#addProducto.close").click();
			//$(".modal-backdrop").remove();

            //listarProductos();
          }
        });	

}
