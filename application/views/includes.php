<link rel="stylesheet" href="<?php echo base_url(); ?>template/css/font-awesome.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>template/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>template/css/font.css">
<!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800">-->
<link href="<?php echo base_url(); ?>template/css/ekattor.css" media="screen" rel="stylesheet" type="text/css" />
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>template/js/html5shiv.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/js/excanvas.js" type="text/javascript"></script>
<![endif]-->

<script src="<?php echo base_url(); ?>template/js/ekattor.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/js/highcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/js/exporting.js" type="text/javascript"></script>

<?php
//////////LOADING SYSTEM SETTINGS FOR ALL PAGES AND ACCOUNTS/////////
$page_title = 'Educacional';
$system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
$system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
