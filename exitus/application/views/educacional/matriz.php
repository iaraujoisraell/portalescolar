<div class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo 'lista_matrizes'; ?>
                </a>
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo 'nova matriz'; ?>
                </a>
            </li>
        </ul>
        <!------CONTROL TABS END------->

    </div>
    <div class="box-content padded">
        <div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  active" id="list">
                <div class="action-nav-normal">
                    <div class=" action-nav-button" style="width:300px;">
                        <a href="#" title="Users">
                            <i id="colorb" class="fa fa-sitemap"></i>
                            <!--<img src="<?php echo base_url(); ?>template/images/icons_menu/vestibular.png" />-->
                            <span>Total <?php echo count($matriz); ?> Matriz</span>
                        </a>
                    </div>
                </div>
                <div class="box">
                    <div class="box-content">
                        <div id="dataTables">
                            <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                                <thead>
                                    <tr>
                                        <th><div>ID</div></th>
                                <th><div><?php echo 'Curso'; ?></div></th>
                                <th><div><?php echo 'Ano'; ?></div></th>
                                <th><div><?php echo 'Semestre'; ?></div></th>
                                <th><div><?php echo 'opções'; ?></div></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($matriz as $row):
                                        $curso_codigo = $row['cursos_id'];
                                        $matriz_codigo = $row['matriz_id'];
                                        //echo $matriz_codigo;
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td ><?php echo $row['cur_tx_descricao']; ?></td>
                                            <td><?php echo $row['mat_tx_ano']; ?></td>
                                            <td><?php echo $row['mat_tx_semestre']; ?></td>

                                            <td align="center">
                                                <?php
                                                /*
                                                 * <a data-toggle="modal" href="#modal-form" onclick="modal('editar_matriz',<?php echo $row['matriz_id']; ?>)"	class="btn btn-gray btn-small">
                                                  <i class="icon-wrench"></i> <?php echo 'editar'; ?>
                                                  </a>
                                                 */
                                                ?>
                                                <a  href="index.php?educacional/matriz_pdf/carrega_matriz/<?php echo $row['matriz_id']; ?>" target="_new"	class="btn btn-black btn-small">
                                                    <i class="icon-print"></i> <?php echo 'imprimir'; ?>
                                                </a>
                                                <a  href="index.php?educacional/matriz_disciplina/carrega_matriz/<?php echo $row['matriz_id']; ?>" 	class="btn btn-gray btn-small">
                                                    <i class="icon-wrench"></i> <?php echo 'editar'; ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?educacional/matriz/delete/<?php echo $row['matriz_id']; ?>')"
                                                   class="btn btn-red btn-small">
                                                    <i class="icon-trash"></i> <?php echo 'deletar'; ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!----TABLE LISTING ENDS--->

            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('educacional/matriz/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <form method="post" action="<?php echo base_url(); ?>index.php?educacional/matriz/create/" class="form-horizontal validatable" enctype="multipart/form-data">
                        <div class="padded">
                            <table width="100%" border="0" class="responsive">
                                <tbody>
                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'Ano'; ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="ano"/>
                                                </div>
                                            </div>

                                        </td>


                                    </tr>

                                    <tr>

                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'Semestre'; ?></label>
                                                <div class="controls">
                                                    <select class="validate[required]" name="semestre">
                                                        <option value="I" >I SEMESTRE</option>
                                                        <option value="II" >II SEMESTRE</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>

                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'Curso'; ?></label>
                                                <div class="controls">
                                                    <select class="validate[required]" name="curso">
                                                        <?php foreach ($carrega_curso as $row): ?>
                                                            <option value="<?php echo $row['cursos_id']; ?>" >
                                                                <?php echo $row['cur_tx_descricao']; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>                                 

                                                </div>
                                            </div>
                                        </td>

                                    </tr>


                                </tbody>
                            </table>

                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo 'criar_matriz'; ?></button>
                        </div>
                    </form>                
                </div>                
            </div>
            <!----CREATION FORM ENDS--->

        </div>
    </div>
</div>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function () {
        readURL(this);
    });
</script>