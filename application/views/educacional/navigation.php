<div class="sidebar-background">
    <div class="primary-sidebar-background">
    </div>
</div>
<div class="primary-sidebar">
    <!-- Main nav -->
    <br />
    <div style="text-align:center;">
        <a href="<?php echo base_url(); ?>">
            <img src="<?php echo base_url(); ?>uploads/logo.png"  style="max-height:100px; max-width:100px;"/>
        </a>
    </div>
    <br />
    <ul class="nav nav-collapse collapse nav-collapse-primary">


    
  <li  class="<?php if ($page_name == 'dashboard') echo 'dark-nav active'; ?>">
            <span class="glow"></span>
            <a href="<?php echo base_url(); ?>index.php?admin/dashboard" rel="tooltip" data-placement="right" 
               data-original-title="<?php echo 'dashboard_help'; ?>">
                               <!--<i class="icon-desktop icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/home.png" />
                <span><?php echo 'HOME'; ?></span>
            </a>
        </li>
        
        


        <?php
       

        foreach ($modulos as $row):

            $nome_modulo = $row['nome'];
        
        
        ?>
      
        <?php
            
         $usuarios_id = $this->session->userdata('login');
        $menusArray = $this->db->query("select menus.nome as nome, modulos.nome as modulo, men_tx_url, men_tx_url_image, men_tx_tabela, men_tx_img from usuarios
                                        INNER JOIN perfis  ON usuarios.perfis_id = perfis.perfis_id
                                        INNER JOIN acessos ON perfis.perfis_id = acessos.perfis_id
                                        INNER JOIN menus   ON acessos.menus_id = menus.menus_id
                                        INNER JOIN modulos ON menus.modulos_id = modulos.modulos_id
                                        WHERE usuarios_id = $usuarios_id AND modulos.nome = '$nome_modulo' ORDER BY nome")->result_array();
        
             foreach ($menusArray as $row2):                            
            ?>
            

        <li  class="<?php if ($page_name == $row2['nome']) echo 'dark-nav active'; ?>">
                <span class="glow"></span>
                <a href="<?php echo base_url(); ?><?php echo $row2['men_tx_url'] ?>" rel="tooltip" data-placement="right" >
                                   <!--<i class="icon-desktop icon-1x"></i>-->
                    <i id="colorb" class="fa <?php echo $row2['men_tx_img']; ?>"></i>
                    <span><?php echo $row2['nome']; ?></span>
                </a>
            </li>
            
            
            


    <?php
    endforeach;
endforeach;
?>      


    </ul>

</div>