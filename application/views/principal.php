<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nuevo Establo  | Dashboard</title>


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">



  <link rel="stylesheet" href="/BartioFran/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/BartioFran/plugins/fontawesome-free/css/all.min.css">
  
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="/BartioFran/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="/BartioFran/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/BartioFran/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/BartioFran/plugins/jqvmap/jqvmap.min.css">


  <link rel="stylesheet" href="/BartioFran/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="/BartioFran/dist/css/personalStyle.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/BartioFran/plugins/summernote/summernote-bs4.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/BartioFran/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/BartioFran/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/BartioFran/plugins/summernote/summernote-bs4.min.css">
  
  

</head>

<body class="hold-transition sidebar-mini layout-fixed" style =  "background-image: url(./img/club-dance1.jpg); background-repeat: no-repeat;background-size: cover;">
<!-- #region -->


  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="/BartioFran/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
        width="60">

    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Principal</a>
        </li>
        
      </ul>

     
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4" >
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="/BartioFran/img/nuevostablo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">Nuevo Establo</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="/BartioFran/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"> <?php echo $_SESSION["usuario"] . "numero".  $_SESSION["idDetCompra"] ?></a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas  fa-cart-arrow-down"></i>
                <p>
                 Caja
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="javaScript:listarMesas();" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Registra venta  <span class="right badge badge-danger">New</span> </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="javaScript:get_OrdenesPendientesCobro();" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pendientes de cobro</p>
                  </a>
                </li>
               
                <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Devoluciones </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Cuadre de caja </p>
                  </a>
                </li>


              </ul>
            </li>

            <li class="nav-item menu-open">
              <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Administracion
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a href="javaScript:configurarProduct();" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Configura Producto</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="javaScript:listarProductos()" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lista de productos</p>
                  </a>
                </li>

               
                
                <li class="nav-item">
                
                <!-- addTrasladosProducto-->
                  
                </li>
                
                

                <li class="nav-item">
                  <a href="javaScript:preciosProducto()" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Asignar Precios</p>
                  </a>
                </li>

              </ul>
            </li>

            <li class="nav-item menu-open">
              <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-industry"></i>
                <p>
                 Inventarios
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="javaScript:get_ListCompras()" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lista Compras</p>
                  </a>
                </li> <li class="nav-item">
                  <a href="javaScript:iniciarInventario()" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Toma fisica</p>
                  </a>
                </li>
                <li class="nav-item">
                 <a href="javaScript:ListarTraslados()" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Traslados</p>
                  </a>
                </li>

                <li class="nav-item">
                 <a href="javaScript:ingresarTraslados()" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Traslados indivi</p>
                  </a>
                </li>

                <li class="nav-item">
                 <a href="javaScript:Listamovil()" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lista movil</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="javaScript:indicadorExistenciaProd()" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Existencia Real</p>
                  </a>
                </li> 
								<li class="nav-item">
                  <a href="javaScript:LoadviewInvdiario();" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inventario Diario</p>
                  </a>
                </li>
								<li class="nav-item">
                  <a href="javaScript:LoadviewResInvdiario();" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Resumen Inv Diario</p>
                  </a>
                </li>
              </ul>
          </li>  

          <li class="nav-item menu-open">
              <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-credit-card"></i>
                <p>
                 Gastos
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="javaScript:iniciarGastos()" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ingresar Gastos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="javaScript:listarDetGastos()" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Listar gastos</p>
                  </a>
                </li>
                
              </ul>
          </li>



            
          </ul>
          
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content" style =  "background-image: url(./img/club-dance1.jpg); background-repeat: no-repeat;background-size: cover;">
        <div class="container-fluid" id="principal" >
          <?php  if($_SESSION["usrLogin"]=="admin" ){?>
                <?php    $this->load->view('mesas/listaMesas'); ?>
            <?php }else {?>
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>150</h3>

                  <p>Ordenes del  dia</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">Mas detalles <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>53<sup style="font-size: 20px">%</sup></h3>

                  <p>Reportes de Ventas</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">Mas detalles <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>44</h3>

                  <p>Configuraciones</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">Mas detalles <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>65</h3>

                  <p>Existencias</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">Mas detalles <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Ventas por Mes
                  </h3>
                  <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                      <li class="nav-item">
                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#sales-chart" data-toggle="tab">Circular</a>
                      </li>
                    </ul>
                  </div>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                    </div>
                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                      <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                    </div>
                  </div>
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->

              <!-- DIRECT CHAT -->
             
              <!--/.direct-chat -->

              <!-- TO DO List -->
              
              <!-- /.card -->
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">

              <!-- Map card -->
              <div class="card bg-gradient-primary" style="display:none;">
                
                <div class="card-body">
                  
                </div>
                <!-- /.card-body-->
                <div class="card-footer bg-transparent" style="display:none">
                  <div class="row">
                    <div class="col-4 text-center">
                      <div id="sparkline-1"></div>
                      <div class="text-white">Visitors</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <div id="sparkline-2"></div>
                      <div class="text-white">Online</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <div id="sparkline-3"></div>
                      <div class="text-white">Sales</div>
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- /.row -->
                </div>
              </div>
              <!-- /.card -->

              <!-- solid sales graph -->
              <div class="card bg-gradient-info">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    <i class="fas fa-th mr-1"></i>
                    Grafico de ventas
                  </h3>

                  <div class="card-tools">
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas class="chart" id="line-chart"
                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
                <div class="card-footer bg-transparent">
                  <div class="row">
                    <div class="col-4 text-center">
                      <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                        data-fgColor="#39CCCC">

                      <div class="text-white">Mail-Orders</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                        data-fgColor="#39CCCC">

                      <div class="text-white">Online</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                        data-fgColor="#39CCCC">

                      <div class="text-white">In-Store</div>
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->

              <!-- Calendar -->
             
              <!-- /.card -->
            </section>
            <!-- right col -->
          </div>
          <?php }?>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>PsTSystem &copy; 2014 <a href="https://adminlte.io">PsTSystem</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <!-- jQuery -->
  <script src="<?php echo  base_url();?>plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo  base_url();?>plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src=" <?php echo  base_url();?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src=" <?php echo  base_url();?>plugins/bootstrap/js/popper.min.js"></script>
 
  <!-- ChartJS -->
  <script src=" <?php echo  base_url();?>/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src=" <?php echo  base_url();?>/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src=" <?php echo  base_url();?>plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src=" <?php echo  base_url();?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src=" <?php echo  base_url();?>/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src=" <?php echo  base_url();?>/plugins/moment/moment.min.js"></script>
  <script src=" <?php echo  base_url();?>/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src=" <?php echo  base_url();?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src=" <?php echo  base_url();?>/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src=" <?php echo  base_url();?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src=" <?php echo  base_url();?>/dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src=" <?php echo  base_url();?>/dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo  base_url();?>dist/js/pages/dashboard.js"></script>

  <!--  para  tabla adaptable a  movil -->
 <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
  <script src=" <?php echo  base_url();?>stacktable/stacktable.js"></script>
  <link href="<?php echo  base_url();?>stacktable/stacktable.css" rel="stylesheet">
  <link href="<?php echo  base_url();?>stacktable/css/style.css" rel="stylesheet">
  <!--  para  tabla adaptable a  movil --> 
  <!-- <script src="/BartioFran/js/funciones_basica.js"></script> -->
  <script src=" <?php echo  base_url();?>js/funciones_basica.js"></script>
  <script src=" <?php echo  base_url();?>js/familiaProducto.js"></script>
  <script src=" <?php echo  base_url();?>js/producto.js"></script>
  <script src=" <?php echo  base_url();?>js/configuraciones.js"></script>
  <script src=" <?php echo  base_url();?>js/presentacionProducto.js"></script>
  <script src=" <?php echo  base_url();?>js/medidaProducto.js"></script>
  <script src=" <?php echo  base_url();?>js/precioespecialprod.js"></script>
  <script src=" <?php echo  base_url();?>js/bodegaProducto.js"></script>
  <script src=" <?php echo  base_url();?>js/comprasProductos.js"></script>
  <script src=" <?php echo  base_url();?>js/trasladoProducto.js"></script>
  <script src=" <?php echo  base_url();?>js/ventaProductos.js"></script>
  <script src=" <?php echo  base_url();?>js/ordenesPedido.js"></script>
  <script src=" <?php echo  base_url();?>js/invProductos.js"></script>
  <script src=" <?php echo  base_url();?>js/login.js"></script>
  <script src=" <?php echo  base_url();?>js/gastosOperativos.js"></script>
  <script src=" <?php echo  base_url();?>js/prodPresentacion.js"></script>
  <script src=" <?php echo  base_url();?>js/equivalentes.js"></script>
	<script src=" <?php echo  base_url();?>js/InvDiario.js"></script>
  

  



   <!-- stilos css para  combos  y  upload -->
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <script src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js "> </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <!-- bloque para alertify -->
     <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
     <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->

   <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/css/select2-bootstrap4.css">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/css/select2-bootstrap4.min.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/css/upload.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/css/titles.css"/>
   <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/css/allDevice.css"/>
	

 
      <!-- table -->
   
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/datatables/datatables.min.css" />
	    <script type="text/javascript" src="<?php echo base_url();?>public/datatables/datatables.min.js"></script>
  


</body>

</html>
