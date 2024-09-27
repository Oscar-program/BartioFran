function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}
//  funcion para mostrar la vista  principal para iniciar el  ingreso de  gastos 
function  iniciarGastos(){
    console.log("iniciando la funcion de  de ingreso de  gastos");
    //  creamos una variable de valor  aleatorio para crear el id  de la venta  
    var gastosID  =  new Date().getTime().toString();
    var  gastosID = gastosID.slice(-9);
    console.log('el id  generico es '+gastosID );
    
    var url = base_url('index.php/gastos_Controller/iniciargastos/');
    
    //var url = base_url("index.php/BancosController/bancos");
    $.get(url, function (data) {
      $("#principal").html(data);
      if(document.getElementById('gastosID')){
        $("#gastosID").val(gastosID);
    
      }
    });
}

//  funcion para mostrar el  detalle de los  gastos 
function  detalleGastos(){
    console.log("iniciando la funcion de  traslado de  productos");
    //  creamos una variable de valor  aleatorio para crear el id  de la venta  
    var TrasladoId  =  new Date().getTime().toString();
    var  resultTrasID = TrasladoId.slice(-9);
    console.log('el id  generico es '+resultTrasID );
    
    var url = base_url('index.php/gastos_Controller/addDetgasto/');
    
    //var url = base_url("index.php/BancosController/bancos");
    $.get(url, function (data) {
      $("#principal").html(data);
      if(document.getElementById('trasladoID')){
        $("#trasladoID").val(resultTrasID);
    
      }
    });
}
