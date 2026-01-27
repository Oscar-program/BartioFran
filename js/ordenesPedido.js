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

  // funcion para mostrar el total d ordenes por mesa 
  function mostrarPendientesDespacho(mesaID){
    console.log("El detalle de la mesa a mostrar es  " + mesaID ) ;   
    var url = base_url('index.php/mesa_Controller/listaOrdenesPendienteDespacho/');
    obJson = { mesaID:mesaID};
    $.ajax({
           url: url, 
           type:"POST",
           data:obJson, 
           beforeSend: function(){

           }, success:function(data){
           // console.log(data) ; 
            $("#ordenesPendientesDespacho").html(data);
               

           }

    });

    
  
  }

  //   funcion muestra el detalle de las ordenes pendientes de despacho  
  /* function listaDetOrdenPendienteDespacho(ordenPedidoID){
    console.log("El detalle de la mesa a mostrar es  " + mesaID ) ;   
    var url = base_url('index.php/Ordenes_Controller/listaDetOrdenPendienteDespacho/ ' + ordenPedidoID);
    obJson = { mesaID:mesaID};
    $.ajax({
           url: url, 
           type:"POST",
           data:obJson, 
           beforeSend: function(){

           }, success:function(data){
           // console.log(data) ; 
            $("#ordenesPendientesDespacho").html(data);
               

           }

    });

    
  
  }*/

  // funcion para  mostrar el detalle de la orden pendiente a despachar  
  function mostrarDetalleORden(ordenPedidoIDCab){
  
     //'OrdenID'.  $row->ordenPedidoID?>
    //OrdenID = (document.getElementById('OrdenID' + ordenPedidoID )) ? $("#OrdenID" + ordenPedidoID).val() : "0" ;

      console.log("mostrando  el detalle de la orden " + ordenPedidoIDCab  ) ;
       // return  false  ;

    var url = base_url('index.php/Ordenes_Controller/listaDetOrdenPendienteDespacho/' );
    obJson = { ordenPedidoIDCab:ordenPedidoIDCab};
    $.ajax({
           url: url, 
           type:"POST",
           data:obJson, 
           beforeSend: function(){

           }, success:function(data){
           // console.log(data) ; 
            $("#detallePendienteDespacho").html(data);
            $('#DetallePendienteDespacho').modal('show');
            
               

           }

    });

  } 


