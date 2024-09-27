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
	
	console.log("Almacenando el  traslado del producto  ##########" +cantidadtrasl +"$$");
  if(parseInt(cantidadtrasl)<= 0  || cantidadtrasl=='' ){
    alertify.set("notifier", "position", "top-right");
    alertify.error("El campo cantidad no  puede estar vacio");
  }else{
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
        $("#statusenvio" + identificador).val("Enviado")
        $("#statusenvio" + identificador).css({ "background-color": "green", "color": "white", "opacity":" 0.75", });
       
      },
      complete: function () {
         
      }
    });
  }
	
	


}

//  funcion para trasladar productos a  excel  
function exportTableToExcel1(tableID, filename = ''){
  var downloadLink;
  var dataType = 'application/vnd.ms-excel';
  console.log("el nombre de la  tabla es" +  tableID);
  
  var tableSelect = document.getElementById(tableID);

  var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

  console.log("LLegando  a la  funcion para  exportar a excel");
  
  // Specify file name
  filename = filename?filename+'.xls':'excel_data.xls';
  
  // Create download link element
  downloadLink = document.createElement("a");
  
  document.body.appendChild(downloadLink);
  
  if(navigator.msSaveOrOpenBlob){
      var blob = new Blob(['ufeff', tableHTML], {
          type: dataType
      });
      navigator.msSaveOrOpenBlob( blob, filename);
  }else{
      // Create a link to the file
      downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
  
      // Setting the file name
      downloadLink.download = filename;
      
      //triggering the function
      downloadLink.click();
  }
}

// Exporta una tabla HTML a excel
function exportTableToExcel(tableID, filename) {
  // Tipo de exportación
  if (!filename) filename = 'excel_data.xls';
  let dataType = 'application/vnd.ms-excel';

  // Origen de los datos
  let tableSelect = document.getElementById(tableID);
  let tableHTML = tableSelect.outerHTML;
   
  // Crea el archivo descargable
  let blob = new Blob([tableHTML], {type: dataType});
  
  // Crea un enlace de descarga en el navegador
  if (window.navigator && window.navigator.msSaveOrOpenBlob) { // Descargar para IExplorer
    window.navigator.msSaveOrOpenBlob(blob, filename);
  } else { // Descargar para Chrome, Firefox, etc.
    let a = document.createElement("a");
    document.body.appendChild(a);
    a.style = "display: none";
    let csvUrl = URL.createObjectURL(blob);
    a.href = csvUrl;
    a.download = filename;
    a.click();
    URL.revokeObjectURL(a.href)
    a.remove();
  }
}
// funcion para  mostrar lista en movil 
// funcion para listar los  traslados  realizados 
function  Listamovil(){
  var url = base_url('index.php/trasladoProducto_Controller/Listamovil/');

  //var url = base_url("index.php/BancosController/bancos");
      $.get(url, function (data) {
          $("#principal").html(data);
      });
  

}