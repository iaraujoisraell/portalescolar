<div class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo 'lista_cursos'; ?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo 'novo curso'; ?>
                </a></li>
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
                            <i id="colorb" class="fa fa-th"></i>
                            <!--<img src="<?php echo base_url(); ?>template/images/icons_menu/vestibular.png" />-->
                            <span>Total <?php echo count($cursos); ?> Cursos</span>
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
                                <th width="80"><div><?php echo 'Abrev.'; ?></div></th>
                                <th><div><?php echo 'Curso'; ?></div></th>
                                <th><div><?php echo 'Duração'; ?></div></th>
                                <th><div><?php echo 'Coordenador'; ?></div></th>
                                <th><div><?php echo 'Valor'; ?></div></th>
                                <th><div><?php echo 'opções'; ?></div></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($cursos as $row):  
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo ucfirst($row['cur_tx_abreviatura']); ?></font></td>
                                            <td><?php echo ucfirst($row['cur_tx_descricao']); ?></font></td>
                                            <td><?php echo ucfirst($row['cur_tx_duracao']); ?></font></td>
                                            <td><?php echo ucfirst($row['cur_tx_coordenador']); ?></font></td>
                                            <td><?php echo 'R$ '.number_format($row['cur_fl_valor'], 2, ',', ''); ?></td>
                                            
                                            <td align="center">
                                                
                                                <a data-toggle="modal" href="#modal-form" onclick="modal('editar_curso',<?php echo $row['cursos_id']; ?>)"	class="btn btn-gray btn-small">
                                                    <i class="icon-wrench"></i> <?php echo 'editar'; ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?educacional/cursos/delete/<?php echo $row['cursos_id']; ?>')"
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
                    <?php echo form_open('educacional/cursos/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <form method="post" action="<?php echo base_url(); ?>index.php?educacional/cursos/create/" class="form-horizontal validatable" enctype="multipart/form-data">
                        <div class="padded">
                            <table width="100%" border="0" class="responsive">
                                <tbody>
                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'Nome do Curso'; ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" style="text-transform: uppercase;border-radius:5px;" name="curso"/>
                                                </div>
                                            </div>
                                            
                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'Nome Abrev. do Curso'; ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" style="text-transform: uppercase;border-radius:5px;" name="abreviatura"/>
                                                </div>
                                            </div>
                                        </td>
                                        
                                    </tr>

                                    <tr>
                                        
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'habilitacao_do_curso'; ?></label>
                                                <div class="controls">
                                                    <input type="text" style="text-transform: uppercase;border-radius:5px;" name="habilidade"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'horas_de_estagio_obrigatorio'; ?></label>
                                                <div class="controls">
                                                    <input type="text" style="text-transform: uppercase;border-radius:5px;" name="estagio"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'horas_de_atividade_complementares_obrigatorio'; ?></label>
                                                <div class="controls">
                                                    <input type="text" style="text-transform: uppercase;border-radius:5px;" name="atividades_complementares"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'duracao_do_curso_(semestre(s))'; ?></label>
                                                <div class="controls">                                                  
                                                  <input type="text" style="text-transform: uppercase;border-radius:5px;" class="validate[required]" name="duracao"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'coordenador(a)'; ?></label>
                                                <div class="controls">
                                                    <input type="text" style="text-transform: uppercase;border-radius:5px;" class="validate[required]" name="coordenador"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'valor_do_curso'; ?></label>
                                                <div class="controls">
                                                    <input type="text" placeholder="R$ 0.000,00" style="text-transform: uppercase;border-radius:5px;" onKeyPress="return(MascaraMoeda1(this, '.', ',', event))" class="validate[required]" name="valor"/>
                                                    <input type="hidden" value="1"  name="instituicao"/>
                                                </div>
                                            </div>

                                        </td>
                                       
                                    </tr>


                                    
                                </tbody>
                            </table>

                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo 'criar_curso'; ?></button>
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