<?php 
$this->load->view('header'); //let's assume that we already have 'header' view file
?>
Hello, this just a simple <strong>HTML</strong> template.
I'm a variable passed from the controller, my content is<?php echo $the_content; ?>
<?php 
$this->load->view('footer'); //let's assume that we already have 'footer' view file
?>