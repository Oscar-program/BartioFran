function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}

 //   funcion ára  mostrar la  lista general  de  compras 
 function listarMesas(){
        
  /*Determinamos si  los datos del  producto ya existen */
  //var valorid         = 0;  
  //var productoID      =  null;  
  //var idCompratmp     =  $("#idCompra").val();  
  console.log("Listando las mesas  ");
  var url = base_url('index.php/mesa_Controller/listarMesas');

  //var url = base_url("index.php/BancosController/bancos");
  $.get(url, function (data) {
      $("#principal").html(data);
           
  });

}
// funcion para cargar la  venta principal de ordenes 
function cargar_addordenes(mesaID){
        
    /*Determinamos si  los datos del  producto ya existen */
    //var valorid         = 0;  
    //var productoID      =  null;  
    //var idCompratmp     =  $("#idCompra").val();  
    console.log("Listando las mesas  ");
    var url = base_url('index.php/Menu_internoController/cargar_addordenes/' + mesaID);
  
    //var url = base_url("index.php/BancosController/bancos");
    $.get(url, function (data) {
        $("#principal").html(data);
             
    });
  
  }

