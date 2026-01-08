function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}

function LoadviewConteoFisico(){
  console.log('cargando la vista de conteo fisico');
  var url = base_url("index.php/ConteoFisico_Controller/capturaConteo/");
    $.get(url, function (data) {
        $("#principal").html(data);
    });


}
// funcion que almacena  la cabecera del conteo  
function guardarConteoFisico1(){    
    var  url  =     base_url("index.php/ConteoFisico_Controller/insertar_conteo/");
    if( $("#producto").val()==0){
         alertify.set("notifier", "position", "bottom-center");
         alertify.error("Tiene que seleccionar  un producto");
        return false;
    }
    if(parseInt($("#tcierreant").val())==0){
         alertify.set("notifier", "position", "bottom-center");
         alertify.error("El cierre anterior tiene que ser mayor a cero");
        return false;
    }
    if( ($("#existenciaF").val().length)==0){
          alertify.set("notifier", "position", "bottom-center");
         alertify.error("La exitencia fisica tiene que ser mayor o igual acero");
        return false;
    }
   
    var  conteoID  = $("#conteoID").val() ;

    var  detConteoID  = $("#detConteoID").val();
    console.log("conteo"  + conteoID  + "detConteo " + detConteoID
         
    );
    
   

    $.ajax({           
          url: url,
          type:"POST",
          data: $("#FormConteoFisico").serialize(),          
          datatype:"json",
          beforeSend: function(){

          },  
          success: function(data){             
             if(data["nError"]=="200"){                
                 alertify.set("notifier", "position", "bottom-center");
                 alertify.warning("Compra procesada correctamente");
                 get_listaDetConteo(data["conteoID"]) ;
                 $("#conteoID").val(data["conteoID"]); 
                 $("#detConteoID").val(data["detConteoID"]);

                 $("#producto").val(0);
                 $("#producto").change();
                 $("#tcierreant").val(null);
                 $("#existenciaF").val(null);
                 $("#aberia").val(null);
                 //$("#aberia").val(null);
                 $("#refil").val(null);
                 $("#stockf").val(null);
             }else {
                alertify.set("notifier", "position", "bottom-center");
                alertify.error("Surgio un error  al momento de almacenar los datos ");
                 
             }           
          }
    });
} 
function  get_listaDetConteo(conteoID){
        //  console.log("el id del conteo que se retornara datos  " + conteoID  );  

    var url = base_url('index.php/ConteoFisico_Controller/get_listaDetConteo/'+ conteoID);     
        $.get(url, function (data) {
          //  console.log(data) ;  

          $("#detConteo").html(data);               
        });


}
function getlistaConteo(){
    var FechIncio =  ($("#FechIncio").val().length>0 ) ? $("#FechIncio").val() : "";
        var FechFin   =  ($("#FechFin").val().length>0 )   ? $("#FechFin").val() : "";
        if(FechIncio.length== 0 ||  FechFin.length ==  0 ){
            console.log("Las fechas no pueden estar vacias");
            return   false;
        }
        var urlDest = "index.php/ConteoFisico_Controller/get_listaConteo/";
        var datJson ={FechIncio:FechIncio, FechFin:FechFin};
        $.ajax({
                 url: base_url(urlDest),
                 type: "POST" ,
                 data: datJson,
                 beforeSend: function(){},
                 success: function (data){                   
                 document.getElementById('tblConteo').innerHTML = '';     
                 $("#tblConteo").html(data);
                 $("#tblConteo").change();
                 },
                 complete:  function (){} 

         });

         //console.log("Buscar datos de  conteo fisico");               
        

}
// funcion para editar el  conteo fisico 
function getDetConteo(conteoID){
    console.log("seleccionadp  un nuevo tab ");
   // var myTab =document.querySelector("myTab");
        let tab = document.getElementById("one-tab");
         tab.click();
          var urlDestino = base_url('index.php/ConteoFisico_Controller/get_listaDetConteo/'+ conteoID); 

        // var urlDestino  =  "index.php/ConteoFisico_Controller/get_listaDetConteo/"+ conteoID  ;
         
          $.get(urlDestino, function (data) {
            console.log("Recargando el detalle del  conteo  ");
            console.log(data);
            document.getElementById('detalleConteo').innerHTML =""; 
          //  $("#detConteo").innerHTML =""; 
          $("#detalleConteo").html(data);   
         // $("#detConteo").html(data);                 
        });




    /* let tab = document.querySelector("one-tab");
        tab.addEventListener("click", function(){
            tab.click();
        });*/


       // myTab.removeClass("active");
        //myTab.addClass("active");
        //myTab.show();

      /* var FechIncio =  ($("#FechIncio").val().length>0 ) ? $("#FechIncio").val() : "";
        var FechFin   =  ($("#FechFin").val().length>0 )   ? $("#FechFin").val() : "";
        if(FechIncio.length== 0 ||  FechFin.length ==  0 ){
            console.log("Las fechas no pueden estar vacias");
            return   false;
        }*/
        /*var urlDest = "index.php/ConteoFisico_Controller/get_detConteo/";
        var datJson ={conteoID:conteoID};
        $.ajax({
                 url: base_url(urlDest),
                 type: "POST" ,
                 data: datJson,
                 beforeSend: function(){},
                 success: function (data){                   
                 document.getElementById('tblConteo').innerHTML = '';     
                 $("#tblConteo").html(data);
                 $("#tblConteo").change();
                 },
                 complete:  function (){} 

         });*/

         //console.log("Buscar datos de  conteo fisico");               
        

}
// funcion  que muestra los datos del detalle en los controles para que sean editados  
function cargarElementos(detConteoID){
    var urlDestino = "index.php/ConteoFisico_Controller/get_DetConteoID/";
    var obJson  =  {detConteoID:detConteoID}
    $.ajax({
        url: base_url(urlDestino),
        type:"post",
        data:obJson,  
        datatype:"json",
        beforeSend: function(){},
        success: function(data){
            console.log(data);

        },
        complete: function(){}
    });

}
// funcion elimina el detalle de conteo  
function  detDetalleConteoFisico(detConteoID){
    console.log("llegando a la funcion de conteo fisico");
     var  conteoID = 0;
     if(document.getElementById("conteoID")){ conteoID = $("#conteoID").val();}    
     var url = base_url('index.php/ConteoFisico_Controller/detDetalleConteoFisico/'+ detConteoID);     
        $.get(url, function (data) {  
          $("#detConteo").html(data);  
            get_listaDetConteo(conteoID);                    
        });
}

function getDetConteoPorID(detConteoID){
          var urlDestino = base_url('index.php/ConteoFisico_Controller/edit_DetConteoID/'+ detConteoID);          
          $.get(urlDestino, function (data) {
            var datos = JSON.parse(data);
            $("#tcierreant").val(datos["tcierreant"]);
            $("#existenciaF").val(datos["existenciaF"]);
            $("#aberia").val(datos["aberia"]);
            $("#refil").val(datos["refil"]);
            $("#stockf").val(datos["stockf"]);
            $("#producto").val(datos["productoID"]);
            $("#bodega").val(datos["bodegaProductoID"]);              
        });
}
// funcion que  actualiza la toma de  inventario
function  updateDetConteoFisico(){
    var  url  =     base_url("index.php/ConteoFisico_Controller/insertar_conteo/");
    if( $("#producto").val()==0){
         alertify.set("notifier", "position", "bottom-center");
         alertify.error("Tiene que seleccionar  un producto");
        return false;
    }
    if(parseInt($("#tcierreant").val())==0){
         alertify.set("notifier", "position", "bottom-center");
         alertify.error("El cierre anterior tiene que ser mayor a cero");
        return false;
    }
    if( ($("#existenciaF").val().length)==0){
          alertify.set("notifier", "position", "bottom-center");
         alertify.error("La exitencia fisica tiene que ser mayor o igual acero");
        return false;
    }
   
    var  conteoID  = $("#conteoID").val() ;

    var  detConteoID  = $("#detConteoID").val();
    console.log("conteo"  + conteoID  + "detConteo " + detConteoID
         
    );
    
   

    $.ajax({           
          url: url,
          type:"POST",
          data: $("#FormConteoFisico").serialize(),          
          datatype:"json",
          beforeSend: function(){

          },  
          success: function(data){             
             if(data["nError"]=="200"){                
                 alertify.set("notifier", "position", "bottom-center");
                 alertify.warning("Compra procesada correctamente");
                 get_listaDetConteo(data["conteoID"]) ;
                 $("#conteoID").val(data["conteoID"]); 
                 $("#detConteoID").val(data["detConteoID"]);

                 $("#producto").val(0);
                 $("#producto").change();
                 $("#tcierreant").val(null);
                 $("#existenciaF").val(null);
                 $("#aberia").val(null);
                 //$("#aberia").val(null);
                 $("#refil").val(null);
                 $("#stockf").val(null);
             }else {
                alertify.set("notifier", "position", "bottom-center");
                alertify.error("Surgio un error  al momento de almacenar los datos ");
                 
             }           
          }
    });
}




