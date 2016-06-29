
<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="sidebar-background">
    <div class="primary-sidebar-background">
    </div>
</div>
<div class="primary-sidebar">
    <!-- Main nav -->
    <br />

    <br />
    <ul class="nav nav-collapse collapse nav-collapse-primary">


        <!------dashboard----->

        <li class="<?php if ($page_name == 'dashboard') echo 'dark-nav active'; ?>">
            <span class="glow"></span>
            <a href="<?php echo base_url(); ?>index.php?educacional/dashboard" rel="tooltip" data-placement="right" 
               data-original-title="<?php echo 'HOME'; ?>">
                               <!--<i class="icon-desktop icon-1x"></i>-->
                <font style="color: #ffffff;"> <i  class="fa fa-home"></i></font>
                <span><font style="color:#ffffff;"><?php echo 'Home'; ?></font></span>
            </a>
        </li>

        <?php
        $usuarios_id = $this->session->userdata('login');

        $MmenusArray = $this->db->query("select * from modulo_menus
              WHERE modulos_id = '3' ORDER BY modulo_menus_id")->result_array();

        foreach ($MmenusArray as $row3):
            $Modulo_menus_id = $row3['modulo_menus_id'];
            ?>
            <li class="dark-nav <?php
            if ($page_name == $row3['nome'])
                echo 'active';
            ?>">

                <span class="glow"></span>

                <a class="accordion-toggle  " data-toggle="collapse"   href="#<?php echo $row3['nome']; ?>" rel="tooltip" data-placement="right" >
                    <font style="color: #ffffff;"> <i  class="fa <?php echo $row3['url_imagem']; ?>"></i></font>
                    <span><font style="color:#ffffff;"><?php echo $row3['nome']; ?></font><i class="icon-caret-down"></i></span>
                </a>
                
                <ul id="<?php echo $row3['nome']; ?>" class="collapse <?php
            if ($page_name == $row3['nome'])
                echo 'in';
            ?>">

                <?php
                $menusArray = $this->db->query("select menus.nome as nome, modulos.nome as modulo, men_tx_url, men_tx_url_image, men_tx_tabela, men_tx_img from usuarios
              INNER JOIN perfis  ON usuarios.perfis_id = perfis.perfis_id
              INNER JOIN acessos ON perfis.perfis_id = acessos.perfis_id
              INNER JOIN menus   ON acessos.menus_id = menus.menus_id
              INNER JOIN modulos ON menus.modulos_id = modulos.modulos_id
              WHERE usuarios_id = $usuarios_id AND modulos.modulos_id = '3' and modulo_menus_id = $Modulo_menus_id ORDER BY men_nb_posicao")->result_array();
                ?>

                <?php
                foreach ($menusArray as $row2):
                    ?>

                <li class="<?php if ($page_name == $row2['nome']) echo 'dark-nav active'; ?>">
                    <span class="glow"></span>
                    <a href="<?php echo base_url(); ?><?php echo $row2['men_tx_url'] ?>" rel="tooltip" data-placement="right" 
                       data-original-title="<?php echo $row2['nome']; ?>">
                                       <!--<i class="icon-lock icon-1x"></i>-->
                        <font style="color: #ffffff;"> <i  class="fa <?php echo $row2['men_tx_img']; ?>"></i></font>
                        <span><font style="color:#ffffff;"><?php echo $row2['nome']; ?></font></span>
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

        <!------manage own profile--->
    </ul>

</div>






