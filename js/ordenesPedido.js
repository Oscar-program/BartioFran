function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}


// muestra la lista de la mesas para seleccionar la ordenes procesadas
 function get_OrdenesPendientesDespachar(){ 
         console.log("mostrando mesas con ordenes pendientes Despacho /cobro") ; 
        var url = base_url('index.php/Ordenes_Controller/get_OrdenesPendientesDespachar/' );         
          $.get(url, function (data) {
            $("#principal").html(data);         
          });
       
       }
  // funcion para mosytrar la  lista de  ordenes pendientes de cobro 
  function get_OrdenesPendientesCobro(){   
     console.log("lista mesas pendientes de cobro") ;
        var url = base_url('index.php/Ordenes_Controller/get_OrdenesPendientesCobro/' );         
          $.get(url, function (data) {
            $("#principal").html(data);         
          });
        //  ocultarMenu();
       
       }       


// funcion para cargar la  venta principal de ordenes 
function cargar_addordenes(mesaID){   
    console.log("Listando las mesas  ");
    var url = base_url('index.php/Menu_internoController/cargar_addordenes/' + mesaID);  
    $.get(url, function (data) {
        $("#principal").html(data);             
    });
  
  }

  // funcion para mostrar el total d ordenes por mesa 
  function mostrarPendientesDespacho(mesaID){
    console.log("El detalle de la mesa a mostrar es 100000 " + mesaID ) ;   
    var url = base_url('index.php/Ordenes_Controller/listaOrdenesPendienteDespacho/');
    obJson = { mesaID:mesaID};
    $.ajax({
           url: url, 
           type:"POST",
           data:obJson, 
           beforeSend: function(){
           }, success:function(data){          
            $("#ordenesPendientesDespacho").html(data);    
           }
    });
  
  }
    // funcion para mostrar el total d ordenes por mesa 
  function mostrarPendientesCobro(select){ 
    var mesaID  = select.value;   
    var url = base_url('index.php/Ordenes_Controller/listaOrdenesPendienteCobro/');
    obJson = { mesaID:mesaID};
    $.ajax({
           url: url, 
           type:"POST",
           data:obJson, 
           beforeSend: function(){
           }, success:function(data){          
            $("#ordenesPendientesDespacho").html(data);    
           }
    });
  
  }



 

  // funcion para  mostrar el detalle de la orden pendiente a despachar  
  function mostrarDetalleORden(ordenPedidoIDCab){
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
  function  despacharOrden(c, detPedID){
    console.log("DESPACHAR ORDER ") ;
    let estado = 0;
    var detPedID = detPedID;
    var  objChk = document.getElementById('Despachar'+c);
    if (objChk ){
      if(objChk.checked){
        estado=1;
      }
        var url = base_url('index.php/Ordenes_Controller/despacharOrden/' );
        obJson = { detPedID:detPedID , estado:estado};
         $.ajax({
           url: url, 
           type:"POST",
           data:obJson, 
           beforeSend: function(){

           }, success:function(data){
           
            
               

           }

    });
      }

    
    console.log("Estado de anulado " + anular );
  }

  // funcion para escribir la cantidad de  productos  
  function escribeCantidad(ValBoton){    
    const objTexCantidadVenta  =   document.getElementById('cantidadVenta');
    if(objTexCantidadVenta.value =="0"){
       objTexCantidadVenta.value ="";
    }
    objTexCantidadVenta.select();
    objTexCantidadVenta.value =  objTexCantidadVenta.value +  ValBoton.value ;
  }
  // funcio para  limpiar la caja de texto  
  function limpiaCantidad(){
    const objTexCantidadVenta  =   document.getElementById('cantidadVenta');
    objTexCantidadVenta.value = "" ;
    objTexCantidadVenta.select();
  }

   // funcionm para mostrar el detalle de la mesa pendiente de  cobro 
  function mostrarPendientesCobro1(mesaID){
    console.log("El detalle de la mesa a mostrar es  " + mesaID ) ;   
    var url = base_url('index.php/Ordenes_Controller/listaOrdenesPendienteCobro/');
    obJson = { mesaID:mesaID};
    $.ajax({
           url: url, 
           type:"POST",
           data:obJson, 
           beforeSend: function(){
           }, success:function(data){          
            $("#ordenesPendientesDespacho").html(data);    
           }
    });
  
  }
  // funcion para poner marca de cobro a un producto // todos los productos ya  cobrados yano se podran marcar de  nuevo // poner bandera de finalizado a tosdos aquellos ya marcados  
  function  cobrarOrden(c, detPedID, ordenPedidoID){
    var ordenPedidoID = ordenPedidoID ;
    console.log("llenago al proceso de cobrar la orden ") ;
    let estado = 0;
    var detPedID = detPedID;
    var  objChk = document.getElementById('Cobrar'+c);
    if (objChk ){
      if(objChk.checked){
        estado=1;
      }
        var url = base_url('index.php/Ordenes_Controller/cobrarOrden/' );
         obJson = { detPedID:detPedID, estado:estado, ordenPedidoID:ordenPedidoID};
         $.ajax({
           url: url, 
           type:"POST",
           data:obJson, 
           beforeSend: function(){
           }, success:function(data){ 
              console.log("la orden es" + ordenPedidoID )  ;         
             document.getElementById('total' + ordenPedidoID).textContent ="TOTAL A CANCELAR $"  + data  ;
             console.log("la suma A OBRAR ES es  " + data);
           }
    });
     // }

    }
   // console.log("Estado de anulado " + anular );
  }






       
    //get_OrdenesPendientesDespachar
    //get_OrdenesPendientesCobro







