function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}
   /*funcion carga pantalla principa*/
    function configurarEstablecimiento(){  
      console.log('llegando a la  configuracion del  producto');
      var url = base_url('index.php/ConfEstablec_Controller/setthingEstablecimineto/');
  
        $.get(url, function (data) {
            $("#principal").html(data);
        });
    }
    /*Funcion para listar las empresas  */ 
    function listarEmpresas(){
       console.log('llegando  a la funcion que muestra el   detalle de las marcas');
    var url = base_url('index.php/Empresa_Controller/listarEmpresas/');  
      $.get(url, function (data) {
          $("#detEmpresa").html(data);
      });
    }

    function saveEmpresa(){

    }

    // funcion para listar todos los establecimientos  
     function listarEstablecimientos(){
       console.log('Listando todos los establecimientos');
       var url = base_url('index.php/ConfEstablec_Controller/listaEstablecimientos/');  
        $.get(url, function (data) {
            $("#detEstablecimiento").html(data);
         });
    }

    // funcion para mostrar las diferentes  areas de los establecimientos 
       function listAreasEstablecimientos(){
       console.log('Listando las  areas de los establecimientos');
       var url = base_url('index.php/AreasEstablecimiento_Controller/get_listAllAreas/');  
        $.get(url, function (data) {
            $("#detAreas").html(data);
         });
    }
    // funcion para mostrar todas las mesas por  areas  de establecimiento  
      function listMesasPorAreas(){
       console.log('Listando las  areas de los establecimientos');
       var url = base_url('index.php/AreasEstablecimiento_Controller/get_listAllAreas/');  
        $.get(url, function (data) {
            $("#detAreas").html(data);
         });
    }





    function saveEmpresa(){

    }




/*Funcion carga la configuraciones de los paneles */
function verificarstadotabconf(id){
   
     console.log('el   id seleccionado es' + id );
     var formData;

     switch (id) {
        case 'one-tab':
          $("#empNombre").val('');
          $("#empGiro").val('');
          $("#empNit").val('');
          $("#empTelefono").val('');
          listarEmpresas();
          //console.log('Eligiendo el  form 111111');
          //formData    = new FormData($(".FormOne-tab")[0]);


          break;
        case 'two-tab':
            // Código a ejecutar si la expresión coincide con valor2
            console.log('Eligiendo el  form 2');
            formData    = new FormData($(".FormOne-tab")[0]);
            listarEstablecimientos();
        break;
        case 'three-tab':
            // Código a ejecutar si la expresión coincide con valor2
            formData    = new FormData($(".FormThree-tab")[0]);
            //mostrarDetalleMedProducto();
          listAreasEstablecimientos();
            console.log('Eligiendo el  form 3');
        break;
        case 'four-tab':
            console.log("ejecutando  funcion para   ver vista  ingreso DE MESAS ....") ;
                // Código a ejecutar si la expresión coincide con valor2
                formData    = new FormData($(".FormFour-tab")[0]);
                console.log('Eligiendo el  form 4');
                $("#txtfamProdID").val('');
                $("#txtfamilia").val('');
                //get_listFamiliaProducto();
        break;
        case 'five-tab':
            // Código a ejecutar si la expresión coincide con valor2
            formData    = new FormData($(".FormFivetab")[0]);
            console.log('Eligiendo el  form 5');
            
            $("#txtbodega").val('');
            get_listBodegaProducto();
            break;  

        case 'six-tab':
            // Código a ejecutar si la expresión coincide con valor2
            formData    = new FormData($(".FormSixtab")[0]);
            get_listPreciosEspProducto();
            
           // $("#txtprecioespecial").val(0);
            console.log('Eligiendo el  form 6');
            break;
        case 'seven-tab':
              // Código a ejecutar si la expresión coincide con valor2
              formData    = new FormData($(".FormSeventab")[0]);
              mostrarDetalleEquivalente();
              
             // $("#txtprecioespecial").val(0);
              console.log('Eligiendo el  form 7');
              break;    
        // Más casos...
        default:
          // Código a ejecutar si no coincide con ningún caso anterior
      }
    //  base_url('index.php/productos_Controller/listarProductos/');
      /*var  url_destino = "index.php/configuracioProd_Controller/mostrarDetalleconsiguracion/";
      	
        $.ajax({
          url: base_url(url_destino),
          type: "POST",
          data: formData,
         // cache: false,
        //  contentType: false,
          processData: false,
          beforeSend: function () {
            // Show image container
            $("#loader").css("display", "block");
          },
          success: function (data) {
          //$("#codigoCliente").prop( "disabled", true);
            //alertify.set("notifier", "position", "top-right");
            //alertify.success("El producto se guardo correctamente");
          },
          complete: function () {
            // Show image container
            $("#loader").css("display", "none");
          }
        });*/

 }
/*funcion para almacenar la marca de los   productos */
function  saveMarca(){
  console.log('formulario Creado....... mARCS');
  var formData;
  if(document.getElementById('FormOnetab')) {
    formData = new FormData($(".FormOnetab")[0]);
    console.log('formulario Creado....... mARCS');
  }else{
      console.log('no existe el formulario');
  }
             
   url_destino = "index.php/configuracioProd_Controller/saveMarca/";
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
      // Show image container
      $("#loader").css("display", "none");
      mostrarDetalles();
      $("#marcProdID").val('');
      $("#txtmarca").val('');
    }
  });

}
/*mostrar el  detalle de las marcas  */
function mostrarDetalles(){
  console.log('llegando  a la funcion que muestra el   detalle de las marcas');
    var url = base_url('index.php/configuracioProd_Controller/mostrarDetalleMarcas/');
  
  //var url = base_url("index.php/BancosController/bancos");
      $.get(url, function (data) {
          $("#detMArcas").html(data);
      });
  
}
/*funcion para  retornar la  marca seleccionada*/
function  get_marcaxId(id){
  console.log('obtener la marca seleccionada');
  var url = base_url('index.php/configuracioProd_Controller/get_marcaxId/' +id);

//var url = base_url("index.php/BancosController/bancos");
    $.get(url, function (data) {
        // console.log(data);
         var datosMarca  =  JSON.parse(data);
         console.log(datosMarca);
         console.log(datosMarca[0].marcProdID);
        $("#marcProdID").val(datosMarca[0].marcProdID);
        $("#txtmarca").val(datosMarca[0].marcProdDescripcion);
       
    });

}

/*Funcion para eliminar  un detallle de la  marca */
function  DeleteMarcar(marcProdID){
  swal({
    title: "Estas seguro de elimnar el  registro ?",
    text: "Este proceso eliminara el  registro de base  de  datos",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((Delete) => {
    if (Delete) {
                var url = base_url(
                  "index.php/configuracioProd_Controller/delete_MarcaProductoID/" + marcProdID
                );
                $.get(url, function (data) {
                  if (data == 0) {
                        swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Surgio un error al  eliminar el  registro',														
                        });
                  } else if (data == 1) {
                    swal("Registro eliminado corectamente", {
                      icon: "success",
                    });
                    mostrarDetalles();
                  }

                });				
    } else {
      swal("Operacion  cancelada",{
        icon: "success",
      });
    }
  });
}
/*funcion   registra   nueva mesa del estableciemiento   */
function saveMesa(){
  console.log("ALMACENANDO EL REGISTRO DE LA MESA ") ;
  console.log('formulario Creado....... mARCS');
  var formData;
  if(document.getElementById('FormRegMesa')) {
    formData = new FormData($(".FormRegMesa")[0]);
    console.log('formulario Creado....... mARCS');
  }else{
      console.log('no existe el formulario');
  }
             
   url_destino = "index.php/ConfEstablec_Controller/registraNewMesa/";
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
      // Show image container
      $("#loader").css("display", "none");
      mostrarDetalles();
      $("#marcProdID").val('');
      $("#txtmarca").val('');
    }
  });

}

function saveAreaEstab(){
  console.log("ALMACENANDO EL REGISTRO DE LA MESA ") ;
  console.log('formulario Creado....... mARCS');
  var formData;
  if(document.getElementById('FormAreaEstb')) {
    formData = new FormData($(".FormAreaEstb")[0]);
    console.log('formulario Creado....... mARCS');
  }else{
      console.log('no existe el formulario');
  }
             
   url_destino = "index.php/ConfEstablec_Controller/registraNewMesa/";
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
      // Show image container
      $("#loader").css("display", "none");
      mostrarDetalles();
      $("#marcProdID").val('');
      $("#txtmarca").val('');
    }
  });

}