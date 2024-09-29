function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}
//  funcion para mostrar la vista  principal para iniciar el  ingreso de  gastos 
function  iniciarGastos(){
    var url = base_url('index.php/gastos_Controller/iniciargastos/');
     $.get(url, function (data) {
      $("#principal").html(data);     
    });
}

//  funcion para mostrar el  detalle de los  gastos 
function  detalleGastos(gastoID){
    var url = base_url('index.php/gastos_Controller/addDetgasto/'); 
    $.get(url, function (data) {
      $("#principal").html(data);
      $("#IdGasto").val(gastoID);
    });
}
//  funcion para guardar la cabecera el inventario 
 function  guardarGastos(){
  console.log('llegando a la funcion para almacenar la cabecera de los  gatos')
  var formData;
    console.log('Guardando el encabezado de los gastos');
    if(document.getElementById('FormGastos')) {
      formData = new FormData($(".FormGastos")[0]);
      console.log('formulario Creado.......Encabezadeo de gastos');
    }else{
        console.log('no existe el formulario');
    }               
     url_destino = "index.php/gastos_Controller/guardarGastos/";
    // console.log('Despues  de la URL');
  
     $.ajax({
      url: base_url(url_destino),
      type: "POST",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function () {
        // Show image container
        $("#loader").css("display", "block");
      },
      success: function (data) {
        console.log('El retorno despues de guardar la cabecera es ' + data + ' es id');       
        alertify.set("notifier", "position", "top-right");
        alertify.success("Registro guardo correctamente");
        detalleGastos(data);
      },
      complete: function (data) {
        // Show image container
        $("#loader").css("display", "none");
      }
    });
 }

// funcion para guardar el detalle  de gastos 
function  guardarDetGastos(){
  var formData;
   // console.log('Guardando el detalle de los  gastos');
    if(document.getElementById('FormDetGastos')) {
      formData = new FormData($(".FormDetGastos")[0]);
    //  console.log('formulario Creado.......Encabezadeo de gastos');
    }else{
      //  console.log('no existe el formulario');
    }               
     url_destino = "index.php/gastos_Controller/saveDetGastos/";
     console.log('Despues  de la URL');
  
     $.ajax({
      url: base_url(url_destino),
      type: "POST",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function () {
        // Show image container
        $("#loader").css("display", "block");
      },
      success: function (data) {
        //$("#codigoCliente").prop( "disabled", true);
        alertify.set("notifier", "position", "top-right");
        alertify.success("Registro guardo correctamente");
      },
      complete: function () {
   
        $("#cantidadgasto").val(0);
        $("#preciogasto").val(0);
        $("#totalDet").val(0);
        $("#descripcionDetGast").val("");
      }
    });
 }
 // listar detalle de gastos 
 function  listarDetGastos(){
  var url = base_url('index.php/gastos_Controller/listarDetGastos/'); 
  $.get(url, function (data) {
    $("#principal").html(data);
    //$("#IdGasto").val(gastoID);
  });
}
