<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">


<!-- THEME STYLES - Include these on every page. -->
<link href="<?php echo base_url(); ?>template/dashboard/css/style.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>template/dashboard/css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">



<nav  class="navbar-side" role="navigation">
    <div class="navbar-collapse sidebar-collapse collapse">
        <ul id="side" class="nav navbar-nav side-nav">
            <!-- begin SIDE NAV USER PANEL -->
            <li class="side-user hidden-xs">
                <img src="<?php echo base_url(); ?>uploads/logo.png"  style="max-height:100px; max-width:100px;"/>
                <p class="welcome">
                    <i class="fa fa-key"></i> Logged in as
                </p>
                <p class="name tooltip-sidebar-logout">
                    John
                    <span class="last-name">Smith</span> <a style="color: inherit" class="logout_open" href="#logout" data-toggle="tooltip" data-placement="top" title="Logout"><i class="fa fa-sign-out"></i></a>
                </p>
                <div class="clearfix"></div>
            </li>
            <!-- end SIDE NAV USER PANEL -->
            <!-- begin SIDE NAV SEARCH -->

            <!-- end SIDE NAV SEARCH -->
            <!-- begin DASHBOARD LINK -->

            <?php
            

              foreach ($modulos as $row):
              $id_modulo = $row['id'];
              $nome_modulo = $row['nome'];
              ?>


              <li class="panel">
              <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#tables<?php echo $id_modulo; ?>">
              <i class="fa <?php echo $row['mod_tx_img']; ?>"></i> <?php echo get_phrase($row['nome']); ?> <i class="fa fa-caret-down"></i>
              </a>
              <?php
              $usuarios_id = $this->session->userdata('login');
              $menusArray = $this->db->query("select menus.nome as nome, modulos.nome as modulo, men_tx_url, men_tx_url_image, men_tx_tabela, men_tx_img from usuarios
              INNER JOIN perfis  ON usuarios.perfis_id = perfis.perfis_id
              INNER JOIN acessos ON perfis.perfis_id = acessos.perfis_id
              INNER JOIN menus   ON acessos.menus_id = menus.menus_id
              INNER JOIN modulos ON menus.modulos_id = modulos.modulos_id
              WHERE usuarios_id = $usuarios_id AND modulos.modulos_id = '$id_modulo' ORDER BY nome")->result_array();

              ?>

              <ul class="collapse nav" id="tables<?php echo $id_modulo; ?>">
              <?php

              foreach ($menusArray as $row2):
              ?>


              <li>
              <a href="<?php echo base_url(); ?><?php echo $row2['men_tx_url'] ?>">
              <i class="fa <?php echo $row2['men_tx_img']; ?>"></i> <?php echo get_phrase($row2['nome']); ?>
              </a>
              </li>

              <?php
              endforeach;
              ?>
              </ul>
              </li>
              <?php
              endforeach;
           
            ?>      

           

            <!-- end CHARTS DROPDOWN -->
            <!-- begin FORMS DROPDOWN -->




            <!-- end DASHBOARD LINK -->

        </ul>
        <!-- /.side-nav -->
    </div>
    <!-- /.navbar-collapse -->
</nav>
<!-- GLOBAL SCRIPTS -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>template/dashboard/js/plugins/bootstrap/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>template/dashboard/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>template/dashboard/js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
<script src="<?php echo base_url(); ?>template/dashboard/js/plugins/popupoverlay/defaults.js"></script>
<!-- /#logout -->
<!-- Logout Notification jQuery -->
<script src="<?php echo base_url(); ?>template/dashboard/js/plugins/popupoverlay/logout.js"></script>
<!-- HISRC Retina Images -->
<script src="<?php echo base_url(); ?>template/dashboard/js/plugins/hisrc/hisrc.js"></script>

<!-- PAGE LEVEL PLUGIN SCRIPTS -->
<!-- HubSpot Messenger -->
<script src="<?php echo base_url(); ?>template/dashboard/js/plugins/messenger/messenger.min.js"></script>
<script src="<?php echo base_url(); ?>template/dashboard/js/plugins/messenger/messenger-theme-flat.js"></script>
<!-- Date Range Picker -->
<script src="<?php echo base_url(); ?>template/dashboard/js/plugins/daterangepicker/moment.js"></script>
<script src="<?php echo base_url(); ?>template/dashboard/js/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Morris Charts -->
<script src="<?php echo base_url(); ?>template/dashboard/js/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="<?php echo base_url(); ?>template/dashboard/js/plugins/morris/morris.js"></script>
<!-- Flot Charts -->
<script src="<?php echo base_url(); ?>template/dashboard/js/plugins/flot/jquery.flot.js"></script>
<script src="<?php echo base_url(); ?>template/dashboard/js/plugins/flot/jquery.flot.resize.js"></script>
<!-- Sparkline Charts -->
<script src="<?php echo base_url(); ?>template/dashboard/js/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- Moment.js -->
<script src="<?php echo base_url(); ?>template/dashboard/js/plugins/moment/moment.min.js"></script>
<!-- jQuery Vector Map -->
<script src="<?php echo base_url(); ?>template/dashboard/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url(); ?>template/dashboard/js/plugins/jvectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo base_url(); ?>template/dashboard/js/demo/map-demo-data.js"></script>
<!-- Easy Pie Chart -->
<script src="<?php echo base_url(); ?>template/dashboard/js/plugins/easypiechart/jquery.easypiechart.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>template/dashboard/js/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>template/dashboard/js/plugins/datatables/datatables-bs3.js"></script>

<!-- THEME SCRIPTS -->
<script src="<?php echo base_url(); ?>template/dashboard/js/flex.js"></script>
<script src="<?php echo base_url(); ?>template/dashboard/js/demo/dashboard-demo.js"></script>