function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}

 //   funcion ára  mostrar la  lista general  de  compras 
 function indicadorExistenciaProd(){
        
  /*Determinamos si  los datos del  producto ya existen */
  //var valorid         = 0;  
  //var productoID      =  null;  
  //var idCompratmp     =  $("#idCompra").val();  
  console.log("Mostrando el  indicador de   inventarios");
  var url = base_url('index.php/invProducto_Controller/indicadorExistenciaProd');

  //var url = base_url("index.php/BancosController/bancos");
  $.get(url, function (data) {
      $("#principal").html(data);
           
  });

}