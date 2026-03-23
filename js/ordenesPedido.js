function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}



 function get_OrdenesPendientesCobro(){   
        var url = base_url('index.php/Ordenes_Controller/get_OrdenesPendientesCobro/' );         
          $.get(url, function (data) {
            $("#principal").html(data);         
          });
       
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
    console.log("El detalle de la mesa a mostrar es  " + mesaID ) ;   
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
  function  despacharOrden(c, ordenPedidoID){
    let anular = 0;
    var ordenID = ordenPedidoID;
    var  objChk = document.getElementById('Anular'+c);
    if (objChk ){
      if(objChk.checked){
        anular=1;
        var url = base_url('index.php/Ordenes_Controller/despacharOrden/' );
        obJson = { ordenID:ordenID};
         $.ajax({
           url: url, 
           type:"POST",
           data:obJson, 
           beforeSend: function(){

           }, success:function(data){
           
            
               

           }

    });
      }

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




