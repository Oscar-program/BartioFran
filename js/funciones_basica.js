
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
     $("#listaProductos").html(data);
   });

}


