<?php  
?>
<!DOCTYPE html>
   <html lang="en">
   <head>
    <script>
        // Recarga la página cada 60,000 milisegundos (1 minuto)
        setInterval(function () {
           // get_OrdenesPendientesCobro();
            //location.reload();
            console.log("Recargando  la pagina") ;
        }, 60000);
    </script>

    <style>   
            .chk {
        font-size: 30px;
        cursor: pointer;
        text-align:right;
        margin-left:25px;
        }
        .chk input {
        margin-right: 2px;
        width: 25px;
        height:25px;
        }

          table {
    width: 60%;
    border-collapse: collapse;
    margin: 20px auto;
    font-family: Arial, sans-serif;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  }

  thead {
    background-color: #2c3e50;
    color: #ffffff;
  }

  th, td {
    padding: 12px 15px;
    text-align: left;
  }

  th {
    text-transform: uppercase;
    font-size: 14px;
    letter-spacing: 0.05em;
  }

  tbody tr {
    border-bottom: 1px solid #dddddd;
  }

  tbody tr:nth-child(even) {
    background-color: #f4f6f8;
  }

  tbody tr:hover {
    background-color: #e1f0ff;
    cursor: pointer;
  }

 </style>
 	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"></script> 


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
   </head>
   <body>
    <div class ="container-fluid">
        <div class ="row" style= "background-color:green;">
            <?php  if(isset($listaMesasPendientesCobro)){
    if(!empty($listaMesasPendientesCobro)){
        foreach($listaMesasPendientesCobro as  $row){ 
           
        ?>
           <div class="col-lg-2 col-2 justify-content-center mt-1 ml-2  border border-info" style="float:left; text-align:justify; display: flex; align-items: center;height:75px; background-color:#21618C; background:linear-gradient(70deg,#1B2631 , #2196f3); box-shadow: 0px 0px 3px #21618C; " id  =" <?php echo   'mesa'.$row->mesaID ?>" 
              name  = 'familia' data-value=="<?php echo $row->mesaID;?>"  onclick="cargar_addordenes(<?php  echo   $row->mesaID ; ?>);" >
                    <!-- small box   background-color:#043B5F; class="inner"   <img class="animation__shake" src="/BartioFran/img/mesa5.png" alt="AdminLTELogo" height="100" radial-gradient(black, blue) (70deg,#1B2631 , #2196f3)
                    width="100" style="border-radius:5%;"> -->
                    <h4 class="text-center" style="color:lightskyblue;  font-family: 'Homer Simpson UI'"> <?php echo  ''. $row->mesNombre?> </h4>
                  
                    <div  >
                         
                       
                    </div>

                    
                    </div>

                    
    
                    <?php } ?>
<?php } ?>
<?php } ?>
           

        </div>
         <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Orden  #1              <label class="chk">  <input type="checkbox">  <span>Despachado</span> </label>
                    </button>
                
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Cantidad </th>
                            <th>Hora Encargo </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td>Fila 1 - Dato 1</td>
                            <td>Fila 1 - Dato 2</td>
                            <td>Fila 1 - Dato 3</td>
                            <td>Fila 1 - Dato 3</td>
                            </tr>
                            <tr>
                            <td>Fila 2 - Dato 1</td>
                            <td>Fila 2 - Dato 2</td>
                            <td>Fila 2 - Dato 3</td>
                            <td>Fila 2 - Dato 3</td>
                            </tr>
                        </tbody>
                        </table>

                        <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Accordion Item #2
                </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Accordion Item #3
                </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                </div>
                </div>
  </div>
</div>

    </div>
    
   </body>
   </html>  