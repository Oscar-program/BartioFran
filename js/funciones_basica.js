
function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}
function carga_principal(){
    console.log("cargand  funcion principal");
var  url  = base_url("index.php/Welcome/principal/");

//var  url  = 'http://127.0.0.1/index.php/BartioFran/Welcome/principal/';

$.ajax({
      url:url,
      type:"POST",
      data:'',
      success:function(data){
        //console.log(data);
      }
})

}
// funcion para cargar el  menu inteno Categoria de productos isponible  
function cargarmenu_interno(){
  console.log('intentando cargar el  menu interno');
  var url = base_url('index.php/Menu_internoController/index/');

//var url = base_url("index.php/BancosController/bancos");
	$.get(url, function (data) {
		$("#principal").html(data);
	});

  /*$.ajax({
       url:url, 
       type:"POST",
       data:'',
       success:function(data){

       }
  })*/
}
/*funcion  para leer el  value del   div */
function cargar_listaProductos(id){
 // $("#principal"+id).val();
  var valorid  = 0;
  //valorid = document.getElementById('familia'+id).dataset.value;
 // valorid = $('familia'+id).attr('data-value');
// valorid      = $("#familia").val();
 console.log("se ha hecho  click"+ valorid  + " capturado");
 var url = base_url('index.php/Menu_internoController/cargar_submenu/' + id);

 //var url = base_url("index.php/BancosController/bancos");
   $.get(url, function (data) {
     $("#principal").html(data);
   });

}

/*funcion para cargar la modal */
function addVentaProducto(famProdID, id, descripcion, preciocosto){
  // $("#principal"+id).val();
   var valorid  = 0;
  // console.log("cargando los  datos de producto para la vnta "+ famProdID + "## "+ id +"##"+   descripcion  )
   //valorid = document.getElementById('familia'+id).dataset.value;
   // valorid = $('familia'+id).attr('data-value');
  // valorid      = $("#familia").val();
   // console.log("se ha hecho  click"+ descripcion  + " capturado");
  var url = base_url('index.php/Menu_internoController/addVentaProducto/' + famProdID + "/"+  id);
 
  //var url = base_url("index.php/BancosController/bancos");
    $.get(url, function (data) {
      $("#addVenta").html(data);
     // console.log(data);
      //document.getElementById('prodDescripcion').innerHTML=descripcion;
      $('#addVentaProducto').modal('show');
      // ponemos el  precio  de  costo del producto 
      $("#precioregular").val(preciocosto.toFixed(2))
    
    });
 
 }
 // funcion para calcular el total de la venta  
 function calculartotalVenta(e){
  if(e.keyCode===13){


    var precioregular    = parseFloat($("#precioregular").val());
    var  precincremento  = parseFloat($("#precincremento").val());
    var  cantiadVenta    = $("#cantiadVenta").val();
    var total   = (precioregular + precincremento) *  cantiadVenta; 
   // console.log(precioregular + " "+ precincremento + " "+   cantiadVenta);

    //console.log("Se ha precionado enter sobr el control" + parseFloat(total));
    $("#totalVenta").val(parseFloat(total));
    e.preventDefault();

  }
 }
