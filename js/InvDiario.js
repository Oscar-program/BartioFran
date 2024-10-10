function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}

// funcion para  mostrar la ventana  principal de los  traslados  
function SaveInvDiario(identificador ) {

	//  funcion para  guardar la cabecesra de la   venta 
	
	var Id            = '';
	var Refil         = 0;
	var Tipomov       = '';
	var Fecha         = '';
	var nProducto     = '';
	var IdProducto    =  0;
	var invinicial    = '';           
	var conteo        = '';
	var invfinal      = ''; 
	var vnormal       = '';
	var pnormal       = '';
	var vespecial     = '';
	var pespecial     = '';
	var totalv        = '';
	var totalamt      = '';

 console.log("GUARDANDO Row Inv Diario");

// if(document.getElementById('idp')){
//  	Id =  $("#idp").val();
//  }

 

if(document.getElementById('nProducto')){
	
	nProducto =  $("#nProducto option:selected").text();
    
	//nProducto = 'CERVEZA TEST 001';
	//nProducto = nProducto.replace(/\s/g, "");
	// Eliminar espacios antes de texto nProducto.replace(/^\s+/g, "");
	
	nProducto = nProducto.replace(/^\s+/g, "");
	
	console.log(nProducto);
}
if(document.getElementById('fechaingb')){
	Fecha =  $("#fechaingb").val();
	
}
if(document.getElementById('TipoMov')){
	Tipomov =  $("#TipoMov").val();
}

if(document.getElementById('nProducto')){
	IdProducto =  $("#nProducto").val();
}
else
{

	console.log("No se encontro el Objeto");
}
console.log("Id producto es: "+IdProducto);

if(document.getElementById('invinicial')){
	invinicial = $("#invinicial").val()
}

	if(document.getElementById('conteo')){
		conteo =  $("#conteo").val();
	}
	if(document.getElementById('invfinal')){
		invfinal =  $("#invfinal").val();
		console.log(invfinal);
	}

	if(document.getElementById('vnormal')){
		vnormal =  $("#vnormal").val();
	}
	if(document.getElementById('pnormal')){
		pnormal =  $("#pnormal").val();
	}
	if(document.getElementById('vespecial')){
		vespecial =  $("#vespecial").val();
	}

	if(document.getElementById('pespecial')){
		pespecial =  $("#pespecial").val();
	}
	if(document.getElementById('totalv')){
		totalv =  $("#totalv").val();
	}
	if(document.getElementById('totalamt')){
		totalamt =  $("#totalamt").val();
	}

	console.log(Fecha);

		var json ={

							Id:Id,
							Fecha:Fecha, 
							Tipomov:Tipomov,
							nProducto:nProducto,
							Refil:Refil, 
							IdProducto:IdProducto,
							invinicial:invinicial, 
							conteo:conteo, 
							invfinal:invfinal, 
							vnormal:vnormal, 
							pnormal:pnormal,
							vespecial:vespecial,
							pespecial:pespecial,
							totalv:totalv,
							totalamt:totalamt
						 };

	
						
	
	
 url_destino       = "index.php/InvDiario_Controller/SaveInventDiario/";
 console.log('Despues  de la URL');
 console.log(IdProducto);

		//formData    = new FormData($(".formAddProducCompra")[0]);
		$.ajax({
					url: base_url(url_destino),
					type: "POST",
					data: json,
				
				 beforeSend: function () {
					// Show image container
					//$("#loader").css("display", "block");
					alertify.set("notifier", "position", "top-right");
					alertify.success("Registro guardo correctamente");
				  },
				  success: function () {
				  //$("#codigoCliente").prop( "disabled", true);
					//alertify.set("notifier", "position", "top-right");
					//alertify.success("Registro guardo correctamente");
				  },
				  complete: function () {
					// Show image container
					//$("#loader").css("display", "none");
				 
						//recalculartotal();
						// get_ListTmp();
					}
				});

}

function LoadviewInvdiario(){
  console.log('cargando la vista Inventario Diario');
  var url = base_url("index.php/InvDiario_Controller/listarProductos/");
    $.get(url, function (data) {
        $("#principal").html(data);
    });


}

function BuscarInvDiario(){
	console.log('Busca Inventario Diario');


	var FechaBusq = '';
	var TipoMov = '';
	var Producto = '';

	if(document.getElementById('fechab')){
		FechaBusq =  $("#fechab").val();
	}
	if(document.getElementById('TipoMovb')){
		TipoMov =  $("#TipoMovb").val();
	}
	if(document.getElementById('Productob')){
		Producto =  $("#Productob").val();

		var json ={
			FechaB:FechaBusq,
			TipoMov:TipoMov,
			Producto:Producto
		 };


		url_destino       = "index.php/InvDiario_Controller/BuscarInvDiario/";
		console.log('Despues  de la URL');
		console.log(json);	

		//formData    = new FormData($(".formAddProducCompra")[0]);
		$.ajax({
					url: base_url(url_destino),
					type: "POST",
					data: json,
				
				 beforeSend: function () {
					// Show image container
					//$("#loader").css("display", "block");
					//alertify.set("notifier", "position", "top-right");
					//alertify.success("Cargando Registros");
				  },
				  success: function (data) {

					console.log(data);
					if(data==0)
					{
                      //alertify.error("Sin Registros!!");
					  console.log("sin Registros");
					}
					else
					{
						$("#detalle").html(data);
					}
					
					//$('#invinicialb').val('pruebA');
				    //$("#codigoCliente").prop( "disabled", true);
					//alertify.set("notifier", "position", "top-right");
					//alertify.success("Registro guardo correctamente");
				  },
				  complete: function () {
					// Show image container
					//$("#loader").css("display", "none");
				 
						//recalculartotal();
						// get_ListTmp();
					}
				});

}

}



