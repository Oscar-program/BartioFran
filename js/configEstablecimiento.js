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
   

//#region LISTAR 
      function listarEmpresas(){
        console.log('llegando  a la funcion que muestra el   detalle de las marcas');
      var url = base_url('index.php/Empresa_Controller/listarEmpresas/');  
        $.get(url, function (data) {
            $("#detEmpresa").html(data);
        });
      }    
      function listarEstablecimientos(){
        console.log('Listando todos los establecimientos');
        var url = base_url('index.php/ConfEstablec_Controller/listaEstablecimientos/');  
          $.get(url, function (data) {
              $("#detEstablecimiento").html(data);
          });
      }
      function listAreasEstablecimientos(){
        console.log('Listando las  areas de los establecimientos');
        var url = base_url('index.php/AreasEstablecimiento_Controller/get_listAllAreas/');  
          $.get(url, function (data) {
              $("#detAreas").html(data);
          });
      }
     
      function listMesasPorAreas(){
        console.log('Listando mesas  por  area ');
        var url = base_url('index.php/mesa_Controller/listarMesasArea/');  
          $.get(url, function (data) {
              $("#detMesas").html(data);
          });
      }
//#endregion  

//#region GUARDAR 
      function  saveEmpresa(){
         var formData;
        if(document.getElementById('FormEmpresa')) {
          formData = new FormData($(".FormEmpresa")[0]);   
        }             
        url_destino = "index.php/Empresa_Controller/insertarEmpresa/";
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
                        $("#empresaID").val('') ; 
                        $("#empNombre").val('') ; 
                        $("#empGiro").val('' ) ; 
                        $("#empNit").val( '') ; 
                         $("#empTelefono").val( '') ; 

                      listarEmpresas();
                    },
                    complete: function () {
                    
                    }
                });

      }  
       
      function  saveEstablecimiento(){
        var formData;
        if(document.getElementById('FormEstablecimiento')) {
          formData = new FormData($(".FormEstablecimiento")[0]);   
        }             
        url_destino = "index.php/ConfEstablec_Controller/insertarEstablecimiento/";
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
                        $("#establecimientoID").val('') ; 
                        $("#estNombre").val('') ; 
                        $("#estDireccion").val('' ) ; 
                        $("#estTelefono").val( '') ; 
                        $("#SelectEmpresaOrigen").val(0); 
                        $("#SelectEmpresaOrigen").change(); 
                      listarEstablecimientos();
                    },
                    complete: function () {
                    
                    }
                });

      }

       function saveAreaEstab(){
            console.log("ALMACENANDO AREA DEL  ESTABLECIMIENTO ") ;
            var formData;
            if(document.getElementById('FormAreaEstb')) {
              formData = new FormData($(".FormAreaEstb")[0]);
            }             
            url_destino = "index.php/AreasEstablecimiento_Controller/insertarAreaEstablecimiento/";
            $.ajax({
                url: base_url(url_destino),
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {     
                  $("#loader").css("display", "block");
                },
                success: function (data) {   
                  alertify.set("notifier", "position", "top-right");
                  alertify.success("Registro guardo correctamente");
                   $("#Area").val('') ; 
                   $("#SEstab").val(0); 
                   $("#SEstab").change(); 

                  listAreasEstablecimientos();
                },
                complete: function () {    
                  $("#loader").css("display", "none");
                
                }
            });

       }
     
      function saveMesa(){ 
        var formData;
        if(document.getElementById('FormRegMesa')) {
          formData = new FormData($(".FormRegMesa")[0]);   
        }             
        url_destino = "index.php/mesa_Controller/registraNewMesa/";
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
                      $("#mesaID").val('') ; 
                      $("#SEstablecimiento").val(0); 
                      $("#SEstablecimiento").change(); 
                      $("#SArea").val(0); 
                      $("#SArea").change(); 
                      $("#txtmesa").val('');
                      $("#txtcapacidad").val('');
                      listMesasPorAreas();
                    },
                    complete: function () {
                    
                    }
                });
      }
     
// #endregion

//#region retonaModificar
  function get_EmpresaPorID(empresaID){
    console.log("area  seleccionada " + empresaID) ;
       var url = base_url('index.php/Empresa_Controller/get_EmpresaPorID/' + empresaID);
       $.get(url, function (data) {
           const  datos  =   JSON.parse(data); 
           


          
           console.log(datos) ;
           console.log("el dato del area es" +   datos[0].area  );
             $("#empresaID").val( datos[0].empresaID ) ; 
             $("#empNombre").val( datos[0].empNombre ) ; 
             $("#empGiro").val( datos[0].empGiro ) ; 
             $("#empNit").val( datos[0].empNit ) ;
             $("#empTelefono").val( datos[0].empTelefono ) ;

            
           
            

            
        });

  }
  function get_EstablecimientoPorID(establecimientoID){
       console.log("area  seleccionada " + establecimientoID) ;
       var url = base_url('index.php/ConfEstablec_Controller/get_EstablecimientoPorID/' + establecimientoID);
       $.get(url, function (data) {
           const  datos  =   JSON.parse(data); 
           


          
           console.log(datos) ;
           console.log("el dato del area es" +   datos[0].area  );
             $("#establecimientoID").val( datos[0].establecimientoID ) ; 
             $("#estNombre").val( datos[0].estNombre ) ; 
             $("#estDireccion").val( datos[0].estDireccion ) ; 
             $("#estTelefono").val( datos[0].estTelefono ) ; 
             $("#SelectEmpresaOrigen").val(datos[0].empresa_origen); 
             $("#SelectEmpresaOrigen").change(); 
           
            

            
        });

  } 
  function obtenerAreaporId(areaEstablecimientoID){
      console.log("area  seleccionada " + areaEstablecimientoID) ;
     var url = base_url('index.php/AreasEstablecimiento_Controller/get_AreaEstablecimientoPorID/' + areaEstablecimientoID);
      $.get(url, function (data) {
           const  datos  =   JSON.parse(data); 

          
           console.log(datos) ;
           console.log("el dato del area es" +   datos[0].area  );
             $("#Area").val( datos[0].area ) ; 
             $("#SEstab").val(datos[0].establecimientoID); 
             $("#SEstab").change(); 
             $("#areasEstablecimientoID").val(datos[0].areaEstablecimientoID);
            

            
        });

  }

  function get_MesaPorID(mesaID){
    console.log("MESA  seleccionada " + mesaID) ;
     var url = base_url('index.php/mesa_Controller/get_MesaPorID/' + mesaID);
      $.get(url, function (data) {
          console.log(data) ;

           const  datos  =   JSON.parse(data); 

          
           console.log(datos) ;
           console.log("el dato del area es" +   datos[0].area  );
             $("#mesaID").val( datos[0].mesaID ) ; 
             $("#SEstablecimiento").val(datos[0].establecimientoID); 
             $("#SEstablecimiento").change(); 
               $("#SArea").val(datos[0].areaEstablecimientoID); 
             $("#SArea").change(); 

             $("#txtmesa").val(datos[0].mesNombre);
             $("#txtcapacidad").val(datos[0].mescapacidad);

             

            

            
        });
    

  }


//#endregion




/*Funcion carga la configuraciones de los paneles */
function verificarstadotabconf(id){
   
     console.log('el   id seleccionado es' + id );
     var formData;

     switch (id) {
        case 'one-tab':         
          listarEmpresas();
          break;
        case 'two-tab':            
            listarEstablecimientos();
        break;
        case 'three-tab':         
          listAreasEstablecimientos();
            
        case 'four-tab':            
                listMesasPorAreas();
        break;
        
        case 'seven-tab':
             
              break;    
        // Más casos...
        default:
          // Código a ejecutar si no coincide con ningún caso anterior
      }
    

 }
/*funcion para almacenar la marca de los   productos */
function  saveMarca(){
  
  var formData;
  if(document.getElementById('FormOnetab')) {
    formData = new FormData($(".FormOnetab")[0]);
   
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

