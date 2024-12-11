function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}
// funcion para  validar la existencia del  usuario en  la base  de datos 
function validaUser(){
    //  esto lo pasaremos por  Json para  evitar  mostrar  datos en  la  barra  direccione 
    console.log("Llegando a la funcion para  validar  al  usuarios"); 
    var user              = '';
    var pwd               = '';
    var  establecimID  ='';
    var url  = base_url('index.php/login_Controller/validaUser/');

    if(document.getElementById('user')){
        user =  $("#user").val();
    }
    if(document.getElementById('pwd')){
        pwd =  $("#pwd").val();
    }
    if(document.getElementById('establecimiento')){
        establecimID =  $("#establecimiento").val();
    }
    //console.log('EL esablecimiento seleccionado es ' + establecimiento  );   
    alert('EL esablecimiento seleccionado es ' + establecimID )  ; 
    var DJson = { user:user, pwd:pwd, establecimID:establecimID };
    alert('los  datos enviados por el  Json son ' + DJson)  ; 
    $.ajax({
        url:url,
        type:"POST",
        data:DJson, 

        beforeSend:function(

        ){},
        success:function(data){
            if(data ==  0 ){
                swal("Los datos del usuario no  fueron encontrados",{
                    icon: "error",
                  });
            }else{
              window.location.href = base_url("index.php/Welcome/principal");
               // window.onload()
                //acceso();
            }


        },
        complete:function(){

        }

    });


    
    //var url2 = base_url('index.php/login_Controller/principal/');
   // principal()

      
    
        //var url = base_url("index.php/BancosController/bancos");
       /* $.get(url, function (data) {
            if(data ==  0 ){
                swal("Los datos del usuario no  fueron encontrados",{
                    icon: "error",
                  });
            }else{
                window.location.href =base_url("index.php/Welcome/principal");
               // window.onload()
                //acceso();
            }
            //$("#addProductCompra").html(data);
            // document.getElementById('prodDescripcion').innerHTML=descripcion
            //$('#addProducCompra').modal('show');
           // $("#idCompratmp").val(idCompratmp)        
        });*/
}

function acceso(){
    //  esto lo pasaremos por  Json para  evitar  mostrar  datos en  la  barra  direccione 
    //console.log("Llegando a la funcion para  validar  al  usuarios"); 

   // var url = base_url('index.php/login_Controller/validaUser/');
    var url = base_url('index.php/Welcome/principal/');
   // principal()

      
    
        //var url = base_url("index.php/BancosController/bancos");
        $.get(url, function (data) {
                  
        });
}

//  funcion para  registrar al usuarios  
function registerUser(){
   console.log("lazando la ventana para  registrar el usuarios");

   window.location.href = base_url("index.php/Welcome/registerUser");
    //var url = base_url('index.php/Welcome/registerUser/');
   // principal()

      
    
        //var url = base_url("index.php/BancosController/bancos");
       // $.get(url, function (data) {
                  
        //});
}
// funcion para almacenar los  datos de los  nuevos usuarios 

function  saveUser(){
    console.log("Llegando a la funcion para  guardar los  datos de los  usuarios"); 
    var Fullname   =  "";
    var Email      =  "";
    var niveluser  =  "" ;
    var Password   =  "";

    var url  = base_url('index.php/login_Controller/saveUser/');

    if(document.getElementById('Fullname')){
        Fullname =  $("#Fullname").val();
    }
    if(document.getElementById('Email')){
        Email =  $("#Email").val();
    }

    if(document.getElementById('niveluser')){
        niveluser =  $("#niveluser").val();
    }

    if(document.getElementById('password')){
        Password =  $("#password").val();
    }
   


    var DJson = { Fullname: Fullname, Email:Email, niveluser:niveluser,  Password:Password };
    $.ajax({
        url:url,
        type:"POST",
        data:DJson, 

        beforeSend:function(

        ){},
        success:function(data){
          console.log("datos Almacenados  correctamente")

        },
        complete:function(){

        }

    });
}