<!DOCTYPE html>
<html>

<head>
  <!-- <meta charset="utf-8"> -->
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DWS - DIGITAL WAREHOUSE & SUPPLY CHAIN</title>
  <link rel="icon" href="<?php echo base_url(); ?>assets/image/logo_thumb.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <!--  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- owl.carousel CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/css/owl.carousel.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/css/owl.theme.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/css/owl.transitions.css">
  <!-- animate CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/css/animate.css">
  <!-- normalize CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/css/normalize.css">
  <!-- meanmenu icon CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/css/meanmenu.min.css">
  <!-- main CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/css/main.css">
  <!-- morrisjs CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/css/morrisjs/morris.css">
  <!-- mCustomScrollbar CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/css/scrollbar/jquery.mCustomScrollbar.min.css">
  <!-- metisMenu CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/css/metisMenu/metisMenu.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/css/metisMenu/metisMenu-vertical.css">
  <!-- calendar CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/css/calendar/fullcalendar.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/css/calendar/fullcalendar.print.min.css">
  <!-- style CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/style.css">
  <!-- responsive CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/css/responsive.css">
  <!-- modernizr JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/plugins/js/vendor/modernizr-2.8.3.min.js"></script>






  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <style>
    @font-face {
      font-family: dwsFont;
      font-style: normal;
      src: url("<?php echo base_url('assets/fonts/Poppins-Regular.otf') ?>") format("opentype");
    }

    @font-face {
      font-family: dwsFont;
      font-weight: bold;
      src: url("<?php echo base_url('assets/fonts/Poppins-Bold.otf') ?>") format("opentype");
    }

    @font-face {
      font-family: dwsFont;
      src: url("<?php echo base_url('assets/fonts/Poppins-LightItalic.otf') ?>") format('woff');
      font-weight: bold;
      font-style: italic;
    }

    body {
      font-family: dwsFont !important;
      background-color: #eaeff3;
    }

    @media only screen and (max-width: 1299px) {
      .main-content {
        padding: 0 1% 0 3%;
      }
    }

    @media only screen and (min-width: 1300px) {
      .main-content {
        padding: 0 1% 0 3%;
      }

      .sidebar {
        padding-top: 5% !important;
      }
    }

    @media only screen and (min-width: 1730px) {
      .main-content {
        padding: 0 1% 0 8%;
      }

      .sidebar {
        padding-top: 9% !important;
      }
    }

    /*.nav-item{*/
    /*    height: 3.2em;*/
    /*}*/
    .nav-treeview>.nav-item>.nav-link.active {
      background-color: transparent !important;
    }

    .nav-item.custom {
      background-color: transparent !important;
      background-image: url('<?php echo base_url(); ?>assets/image/menu_bar_active5.png');
      background-size: 100% 100%;
      background-repeat: no-repeat;
      /*font-size: 1.1em;*/
      padding: 5% 3% 3% 3%;
    }

    /*.nav-item.menu:hover {*/
    /*  /*transform: scale(1.1);*/*/
    /*  background-color: transparent !important;*/
    /*  border: none;*/
    /*  background-image: url('*/<?php //echo base_url(); ?>/*assets/image/menu_bar_active5.png');*/
    /*  background-size: 100% 100%;*/
    /*  background-repeat: no-repeat;*/
    /*  /*font-size: 1.1em;*/*/
    /*  padding: 5% 3% 3% 3%;*/
    /*  color: black;*/
    /*  margin-bottom: 15px;*/
    /*  -ms-transform: scaleX(1.1);*/
    /*  /* IE 9 */*/
    /*  transform: scaleX(1.1);*/
    /*}*/
    /**/
    /*.nav-link:hover {*/
    /*  border: none !important;*/
    /*  box-shadow: none !important;*/
    /*  background: transparent !important;*/
    /*}*/

    .nav-link.clt.custom-treeview {
      background-color: transparent !important;
      background-image: url('<?php echo base_url(); ?>assets/image/menu_bar_active5.png');
      background-size: 100% 100%;
      background-repeat: no-repeat;
      /*font-size: 1.1em;*/
      padding: 5% 3% 3% 3%;
      box-shadow: none;
    }

    .nav-item.menu a:hover {
      color: black !important;
    }

    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active {
      background-color: transparent !important;
      color: black !important;
    }

    .sidebar-dark-primary .nav-sidebar>.nav-item.custom>.nav-link.active {
      background-color: transparent !important;
      color: black !important;
    }

    .sidebar .sidebar-menu .active .treeview-menu {
      display: block;
    }

    .btn-dws-add {
      background-color: #01cab8 !important;
      border: none;
      line-height: 2.2;
      border-radius: 15px;
    }

    .module_name {
      color: #0565af;
    }

    /* .nav-link.clt.active {} */

    .nav-link.active {
      border: none !important;
      box-shadow: none !important;
    }
  </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="position: fixed; right: 0; left: 0; top: 0; z-index: 1030; border: none; height: 100px">
      <!-- Left navbar links -->
      <div class="col-md-7">
      </div>
      <div class="col-md-4" style="text-align: right">
        <div class="row">
          <div class="col-1" style="padding: 10px"></div>
          <div class="col-2" style="padding: 10px">
            <a class="badge  navbar-badge nav-link" data-toggle="dropdown" id="bell-notification" href="#" style="width: 100%; height: 100%">
              <img src="<?php echo base_url(); ?>assets/image/icon_bell_nonactive.png" alt="AdminLTE Logo" style="height: 35px">
              <span id="badge-notification"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="border: 1px solid;">
              <div id="div_list">

              </div>
              <a href="<?php echo base_url('Notification'); ?>" class="dropdown-item dropdown-footer">See All Notifications</a>
              <!-- <ul>
                            <li class="dropdown-item">Notif 1</li>
                            <li class="dropdown-item">Notif 2</li>
                            <li class="dropdown-item">Notif 3</li>
                        </ul> -->
            </div>
          </div>
          <div class="col-6" style="padding: 12px 0">
            <span class="text-primary" style=" color: black; fo !important;"><b><?php echo $this->session->userdata('name'); ?></b></span><br>
            <span class="text-primary" style=" color: black !important;"><?php echo $this->session->userdata('email'); ?></span>
          </div>
          <div class="col-3">
            <img src="<?php echo base_url(); ?>assets/image/icon_user_login.png" alt="AdminLTE Logo" height="65px" width="auto">
          </div>
        </div>
      </div>
      <div class="col-md-1">
        <a class="nav-link" data-toggle="dropdown" href="#" style="background-color: ; color: white !important; height: 100%; text-align: center; width: 80%">
          <img src="<?php echo base_url(); ?>assets/image/icon_panah_bawah.png" alt="AdminLTE Logo" height="30px" width="auto">
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="border: 1px solid;">
          <a href="<?php echo base_url('Login/logout'); ?>" class="dropdown-item">
            Signout
          </a>
        </div>
      </div>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #5a29b6;
                  resize: both;
                  border: none !important; box-shadow: none !important; width: 17%">
      <a href="<?php echo base_url(''); ?>" class="brand-link" style="height:100px; padding: 7% 15% !important; border: none !important; width: 100%; background-color: white; border-bottom-left-radius: 15px">
        <img src="<?php echo base_url(); ?>assets/image/logo.png" alt="AdminLTE Logo" Logo style="width: 120px; height: 70px; border: none !important;">
      </a>

      <!--      <br>-->
      <div class="sidebar" style="border: none;background-color: #5b449b; !important; padding-right: 0">
        <!-- Sidebar Menu -->

        <nav class="mt-2" style="border: none !important; padding-bottom: 60px; padding-top: 0 !important;">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php
            $role = $this->session->userdata('userid');
            $sql = "SELECT mm.module_name,mm.module_link,is_parent,mml.`order` FROM (
                    SELECT * FROM ms_user
                    WHERE id = ?) mu
                    JOIN ms_role mr
                    ON mu.role_id = mr.id
                    JOIN ms_module_link mml
                    ON mr.id=mml.role_id
                    AND mml.status = 1
                    JOIN ms_module mm
                    ON mml.module_id = mm.id
                    ORDER BY `order` ASC";
            $menu_list = $this->db->query($sql, [$role])->result();
            ?>
            <?php $in_main_menu = 0;
            foreach ($menu_list as $menu) {
              $module_key = 0;
              $module_name_arr = [];
              $module_length = strlen($menu->module_name);
              $module_name = $menu->module_name;
              if ($module_length > 20) {
                $arr_module_name = explode(' ', $menu->module_name);
                for ($al = 0; $al < sizeof($arr_module_name); $al++) {
                  if ($al != 0) {
                    if (((strlen($arr_module_name[$al]) + strlen($module_name_arr[$module_key])) + 1) <= 22) {
                      $module_name_arr[$module_key] = $module_name_arr[$module_key] . ' ' . $arr_module_name[$al];
                    } else {
                      $module_key += 1;
                      $module_name_arr[$module_key] = '<br>' . $arr_module_name[$al];
                    }
                  } else {
                    $module_name_arr[$module_key] = $arr_module_name[$al];
                  }
                }
                $module_name = implode(' ', $module_name_arr);
              }
              $is_active = $this->uri->segment(1) == $menu->module_link;
              if ($menu->is_parent == '1' && $menu->module_link != '') {

                if ($in_main_menu == 1) {
                  echo '</ul></li>';
                  $in_main_menu = 0;
                }
                if ($is_active) {
                  echo '<li class="nav-item custom">';
                } else {
                  echo '<li class="nav-item menu">';
                }
                echo '
                <a href="' . base_url() . $menu->module_link . '" class="nav-link ' . ($this->uri->segment(1) == $menu->module_link ? 'active' : '') . '">
                  <p style="font-size: 1.3em">' . $module_name . '</p>
                </a>
              </li>';
                //                  <i class="nav-icon fas fa-chart-pie"></i>
              } else if ($menu->is_parent == '0') {
                $in_main_menu = 1;
                if ($is_active) {
                  echo '<li class="nav-item custom">';
                } else {
                  echo '<li class="nav-item menu">';
                }
                echo '
                <a href="' . base_url() . $menu->module_link . '" class="nav-link ' . ($this->uri->segment(1) == $menu->module_link ? 'active' : '') . '">
                  <p>' . $module_name . '</p>
                </a>
              </li>';
                //<i class="far fa-circle nav-icon"></i>
              } else {
                if ($in_main_menu == 1) {
                  echo '</ul></li>';
                  $in_main_menu = 0;
                }
                echo '<li class="nav-item has-treeview">
                <a href="' . base_url() . $menu->module_link . '" class="nav-link ' . ($this->uri->segment(1) == $menu->module_link ? 'active ' : '') . 'clt">

                <div class="row">
                  <p class="col-8" style="font-size: 1.3em">' . $module_name . '</p>
                  <p class="col-4 text-right p-0"><i class="fas fa-sort-down stat" style="font-size: 1.3em"></i></p>
                </div>
                </a>
              <ul class="nav nav-treeview">';
              }
            } ?>
          </ul>
      </div>

      <!-- /.sidebar -->
  </div>

  <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper main-content" style="background-color: #eaeff3;">
    <div id="overlay" style="display:none;">
      <div class="loader">Loading...</div>
      <!-- <div class="spinner"></div> -->
      <br />
      Loading...
    </div>
    <div style="border: 0; height:100px;"></div>

    <section class="container-fluid" style="background-color: #eaeff3; padding: 10px 0px">
      <?php $this->load->view($content); ?>
    </section>
  </div>
  <!-- /.content-wrapper -->
  <!--  <footer class="main-footer">-->
  <!--    <strong>Copyright &copy; 2020 <a href="#">IBAST</a></strong>-->
  <!--    All rights reserved.-->
  <!--    <div class="float-right d-none d-sm-inline-block">-->
  <!--      <b>Version</b> 1.0.0-->
  <!--    </div>-->
  <!--  </footer>-->

  <!--  </div>-->
  <!-- ./wrapper -->

  <!-- jQuery -->
  <!-- <script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script> -->
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url(); ?>assets/testing/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url(); ?>assets/testing/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Sparkline -->
  <script src="<?php echo base_url(); ?>assets/testing/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?php echo base_url(); ?>assets/testing/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/testing/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery K<?php echo base_url(); ?>assets/testing/ob Chart -->
  <script src="<?php echo base_url(); ?>assets/testing/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?php echo base_url(); ?>assets/testing/plugins/moment/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/testing/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?php echo base_url(); ?>assets/testing/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?php echo base_url(); ?>assets/testing/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo base_url(); ?>assets/testing/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/testing/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/testing/plugins/moment/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/testing/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

  <!-- DASHBOARD -->
  <!-- Main JS-->
  <script src="<?php echo base_url(); ?>assets/plugins/js/main.js"></script>

  <!-- jquery
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/plugins/js/vendor/jquery-1.11.3.min.js"></script>
  <!-- bootstrap JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/plugins/js/bootstrap.min.js"></script>
  <!-- wow JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/plugins/js/wow.min.js"></script>
  <!-- price-slider JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/plugins/js/jquery-price-slider.js"></script>
  <!-- meanmenu JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/plugins/js/jquery.meanmenu.js"></script>
  <!-- owl.carousel JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/plugins/js/owl.carousel.min.js"></script>
  <!-- sticky JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/plugins/jquery.sticky.js"></script>
  <!-- scrollUp JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/plugins/js/jquery.scrollUp.min.js"></script>
  <!-- mCustomScrollbar JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/plugins/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/js/scrollbar/mCustomScrollbar-active.js"></script>
  <!-- metisMenu JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/plugins/js/metisMenu/metisMenu.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/js/metisMenu/metisMenu-active.js"></script>
  <!-- morrisjs JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/plugins/js/morrisjs/raphael-min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/js/morrisjs/morris.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/js/morrisjs/morris-active.js"></script>
  <!-- morrisjs JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/plugins/js/sparkline/jquery.sparkline.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/js/sparkline/jquery.charts-sparkline.js"></script>
  <!-- calendar JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/plugins/js/calendar/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/js/calendar/fullcalendar.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/js/calendar/fullcalendar-active.js"></script>
  <!-- plugins JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/plugins/js/plugins.js"></script>
  <!-- main JS
		============================================ -->
  <script src="<?php echo base_url(); ?>assets/plugins/js/main.js"></script>
  <!-- DASHBOARD END -->





  <script>
    $(document).ready(function() {
      $('a.nav-link.active').closest('li.has-treeview').addClass('menu-open');
      $('a.nav-link.active').closest('li.has-treeview').css('paddingBottom', '20px');
      $('a.nav-link.active').closest('a.nav-link').addClass('active');
      // $('a.nav-link.active').closest('a.clt').addClass('custom-treeview');
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      tampil_data_barang();

      function tampil_data_barang() {

        $.ajax({

          url: '<?php echo base_url() ?>Notification/getTotalNotif',
          type: 'get',
          success: function(data) {

            $('#badge-notification').text(data);


          }
        });

        setInterval(tampil_data_barang, 10800000);
      }


      $("#bell-notification").on('click', function() {
        $('#div_list').empty();

        $.ajax({

          url: '<?php echo base_url() ?>Notification/listWebNotif',
          type: "get",
          dataType: "json",
          success: function(response) {

            response.forEach(function(row) {


              $('#div_list').append('<div style="border-bottom: 1px solid #e9ecef;font-size:0.8rem;">location = ' + row.location_name + " Product = " +
                row.product_h_name + "<br> ket notif =" +
                row.ket + '</div>');

              //$('#code_bast').text(row.code_bast);
            });
          }
        });
      });
    });
  </script>

</body>

</html>