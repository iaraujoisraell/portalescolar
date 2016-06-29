<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<?php include 'includes.php';?>
        <title><?php echo get_phrase('login');?> | <?php echo $system_title;?></title>
        
        <style>
           body{
                width: 100%;
                height: 100%;
                background-image:url(template/images/background_educacional.jpg); 
                background-repeat: no-repeat;
                background-size: 100% 100%;
            }
            
            top{
                height: 150px;
                width: 600px;
                background-color: #006dcc;
                margin: auto;
                z-index: 1;
                position: fixed;
                
            }
        </style>
    </head>
    <div style="height: 40px;
                width: 100%;
                background-color: #006dcc;
                margin: auto;
                z-index: 1;
                position: fixed;">
       
        <h3 style="margin-top: 0px; margin-left: 10px;">Bem vindo ao Portal Acadêmico da Faculdade Boas Novas!</h3>
            </div>
    
	<body>
            
            <div id="main_body">
            
            <?php if($this->session->flashdata('flash_message') != ""):?>
            <script>
                $(document).ready(function() {
                    Growl.info({title:"<?php echo $this->session->flashdata('flash_message');?>",text:" "})
                });
            </script>
            <?php endif;?>
            
            <br><br><br><br><br><br>
            <div class="container">
                <div class="span4 offset4">
                    <div class="padded">
                        <center>
                            <img src="<?php echo base_url();?>uploads/logo_login.png" style="max-height:100px;margin:20px 0px;" />
                        </center>
                        <div class="login box_login" style="margin-top: 10px;">
                            
                            <div class="box-content padded">
                            <script>
                                function check_account_type()
                                {
                                    var account_type	=	document.getElementById('account_selector').value;
                                    if (account_type == "") {
                                        Growl.info({title:"Please select an account type first",text:" "})
                                        
                                        return false;
                                    }
                                    else
                                        return true;
                                }
                            </script>
                                       <?php echo form_open('login/valida_login/' , array('class' => 'form-horizontal validatable', 'onsubmit', 'separate-sections', 'target' => '_top', 'enctype' => 'multipart/form-data'));?>
                             <form method="post" action="<?php echo base_url(); ?>index.php?login/valida_login/" class="form-horizontal validatable" enctype="multipart/form-data">
                             

                                    <style>
                                    .flip_in{
                                        opacity:0;
                                        -moz-transform:rotateY(-90deg);
                                        -webkit-transform:rotateY(-90deg);
                                        transform:rotateY(-90deg);
                                        transition:.2s;
                                    }
                                    .flip_out{
                                        opacity:1;
                                        -moz-transform:rotateY(0deg);
                                        -webkit-transform:rotateY(0deg);
                                        transform:rotateY(0deg);
                                        transition:.2s;
                                    }
                                    </style>
                                    
                                    <script>
                                        $(document).ready(function(){
                                          $("#account_selector").change(function(){
                                              
                                              //squeezee in
                                              function rotate_in()
                                              {
                                                    $('#avatar').toggleClass('flip_in');
                                              }
                                              setTimeout(rotate_in, 0);
                                              
                                              //change img src
                                              function set_img()
                                              {
                                                  var img = document.getElementById('account_selector').value;
                                                  if(img == "")
                                                        img	=	'account';
                                                  $("#account_img").attr("src", "<?php echo base_url();?>template/images/icons_big/"+img+".png");
                                              }
                                              setTimeout(set_img, 200);
                                              
                                              //expand out
                                              function rotate_out()
                                              {
                                                    $('#avatar').toggleClass('flip_out');
                                              }
                                              setTimeout(rotate_out, 200);
                                                
                                              //clear css
                                              function reset_class()
                                              {
                                                    $("#avatar").attr("class", "avatar");
                                              }
                                              setTimeout(reset_class, 500);
                                          });
                                        });
                                    </script>
                                    
                                    

                                    
                                    <div class="input-prepend">
                                        <span class="add-on" href="#">
                                        <i class="icon-envelope"></i>
                                        </span>
                                        <input name="email" type="text" placeholder="<?php echo get_phrase('login');?>" autocomplete="off">
                                    </div>
                                    <div class="input-prepend">
                                        <span class="add-on" href="#">
                                        <i class="icon-key"></i>
                                        </span>
                                        <input name="password" type="password" placeholder="<?php echo get_phrase('senha');?>" autocomplete="off">
                                    </div>
                                 <br><br>
                                    <div class="row-fluid">
                                        <div class="span6">
                                            <a  data-toggle="modal" href="#modal-simple"  class="btn btn-blue btn-block" >
                                                <?php echo get_phrase('esqueceu_sua_senha ?');?> 
                                            </a>
                                        </div>
                                        <div class="span6">
                                            <input type="submit" class="btn btn-gray btn-block "  value="<?php echo get_phrase('login');?>"/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr />
                        <div style="color:#006dcc;">
                        	
                        		<center>&copy; 2015, Amazonia Global - Faculdade Boas Novas
                        		</center>
                            
                        </div>
                            
                    </div>
                </div>
            </div>
        </div>
        <!-----------password reset form ------>
        <div id="modal-simple" class="modal hide fade" style="top:30%;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h6 id="modal-tablesLabel"><?php echo get_phrase('reset_password');?></h6>
          </div>
          <div class="modal-body" style="padding:20px;">
            <?php echo form_open('login/reset_password');?>
            	<select class="validate[required]" name="account_type"  style="margin-bottom: 0px !important;">
                    <option value=""><?php echo get_phrase('account_type');?></option>
                    <option value="admin"><?php echo get_phrase('admin');?></option>
                    <option value="teacher"><?php echo get_phrase('teacher');?></option>
                    <option value="student"><?php echo get_phrase('student');?></option>
                    <option value="parent"><?php echo get_phrase('parent');?></option>
                </select>
                <input type="email" name="email"  placeholder="<?php echo get_phrase('email');?>"  style="margin-bottom: 0px !important;"/>
                <input type="submit" value="<?php echo get_phrase('reset');?>"  class="btn btn-blue btn-medium"/>
            <?php echo form_close();?>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-----------password reset form ------>
        
        
	</body>
</html>