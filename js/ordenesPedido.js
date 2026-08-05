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
function cargar_addordenes(mesaID, mesNombre){   
    console.log("Listando las mesas "  + mesaID + "    "+ mesNombre);
    var url = base_url('index.php/Menu_internoController/cargar_addordenes/' + mesaID +'/'+ mesNombre );  
    $.get(url, function (data) {
        $("#principal").html(data);             
    });
  
  }

  // funcion para mostrar el total d ordenes por mesa 
  function mostrarPendientesDespacho(select){
    var mesaID  = select.value;
    console.log("El detalle de la mesa a mostrar es 100000 " + mesaID ) ;   
    var url = base_url('index.php/Ordenes_Controller/listaOrdenesPendienteDespacho/');
    obJson = { mesaID:mesaID};
    $.ajax({
           url: url, 
           type:"POST",
           data:obJson, 
           beforeSend: function(){
           }, success:function(data){  
            console.log(data)       ;  
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
            $("#ordenesPendientesCobrar").html(data);    
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
    let estado = 1;
    var detPedID = detPedID;
    const  objChk = document.getElementById('Despachar'+c);
    if (objChk ){
      /*if(objChk.checked){
        estado=1;
      }*/
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
    objChk.disabled = true;
    objChk.style.backgroundColor = '#999';
    objChk.style.cursor = 'not-allowed';
    objChk.style.opacity = '0.7';

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

  // funcion que muestra la modal para realizar el abono 

   function mostrarModalAbono(ordenPedidoID){
     $('#addAbonoPedido').modal('show');
     $("#ordenPedidoID").val(ordenPedidoID) ;
    // ordenPedidoID

   

  } 


  // funcion para abonar orden 
   function abonarOrden(){ 


         var ordPAbono  =  $("#ordPAbono").val(); //  10;
         var ordenPedidoID  = $("#ordenPedidoID").val(); //  10;
         const select =  document.getElementById('mesaCobrar') ;//  (document.getElementById('mesaCobrar')) ? document.getElementById('mesaCobrar').value : "" ; 
         
         console.log("LA ORDEN A ABONAR ES " + ordenPedidoID  ) ;

        var url = base_url('index.php/Ordenes_Controller/abonarOrden/' );         
         var  obJson = { ordPAbono:ordPAbono, ordenPedidoID:ordenPedidoID};
         $.ajax({
           url: url, 
           type:"POST",
           data:obJson, 
           beforeSend: function(){
           }, success:function(data){ 
             $("#addAbonoPedido.close").click();
              $(".modal-backdrop").remove(); 
              mostrarPendientesCobro(select);    
           }
       
       });
      }

      function procesarPedido(ordenPedidoID){ 
        console.log("la orden a procesar es " + ordenPedidoID )  ;  

        var url = base_url('index.php/Ordenes_Controller/procesarPedido/' + ordenPedidoID );         
         
         $.ajax({
           url: url, 
           type:"POST",
           beforeSend: function(){
           }, success:function(data){ 
            

           }
       
       });
      }

      // funcion para mostrar las ordenes pendientes de despacho  por el  id de la mesa  
      function mostrarPendientesDespachomesaID(mesaID){
    var mesaID  = mesaID  ; //select.value;
    console.log("El detalle de la mesa a mostrar es 100000 " + mesaID ) ;   
    var url = base_url('index.php/Ordenes_Controller/listaOrdenesPendienteDespacho/');
    obJson = { mesaID:mesaID};
    $.ajax({
           url: url, 
           type:"POST",
           data:obJson, 
           beforeSend: function(){
           }, success:function(data){  
            console.log(data)       ;  
            $("#ordenesPendientesDespacho").html(data);    
           }
    });
  
  }


  /*function  anularOrdenEnLista(){
    const  ordenID  =   document.getElementById('ordenID').value ;
    const mesaID   =   document.getElementById('ctrlmesaID').value ; 
    url  =  base_url('index.php/ventaProducto_Controller/anularOrden/');
    console.log("anulando la  orden de pedido la mesa es " +  mesaID + "la orden es  " + ordenID  );
    var obJSON = {ordenID : ordenID } ;
    $.ajax({
            url: url,
            type: "POST",
            data: obJSON,
            beforeSend: function (){

            }, 
            success: function(data){                
              //console.log("modificando orden" );
               cargar_addordenes(mesaID) ;
              // ver_ordenePedido(ordenID, mesaID) ;
               $("#totalVenta").val(parseFloat(0));
               document.getElementById('bannerMesaPedido').innerHTML = "";
               document.getElementById('bannerMesaPedido').innerHTML = "MESA W" + mesaID + "         ORDEN #" + "" ;
              //console.log("Datos  Modificados" );
                 

            }

    });

 }*/










