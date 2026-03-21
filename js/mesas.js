 function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}

 //   muestra las mesas q
 function listarMesas(){
    console.log("Listando las mesas  ");
    var url = base_url('index.php/mesa_Controller/listarMesas');
    //var url = base_url("index.php/BancosController/bancos");
    $.get(url, function (data) {
        $("#principal").html(data);
            
    });

}