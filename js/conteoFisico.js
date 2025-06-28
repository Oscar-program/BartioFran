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