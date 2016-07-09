<div class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo 'lista_etapa'; ?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo 'nova_etapa'; ?>
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
                            <i id="colorb" class="fa fa-list-ol"></i>
                            <!--<img src="<?php echo base_url(); ?>template/images/icons_menu/periodo_letivo.png" />-->
                            <span>Total <?php echo count($periodo); ?> Periodo Letivo</span>
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
                                <th><div><?php echo 'peridodo_letivo.'; ?></div></th>
                                <th><div><?php echo 'dias_letivo'; ?></div></th>
                                <th><div><?php echo 'ano'; ?></div></th>
                                <th><div><?php echo 'semestre'; ?></div></th>
                                <th><div><?php echo 'opções'; ?></div></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($periodo as $row):
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo ucfirst($row['periodo_letivo']); ?></font></td>
                                            <td><?php echo $row['dias_letivos']; ?></font></td>
                                            <td><?php echo $row['ano']; ?></font></td>
                                            <td><?php echo $row['semestre'] . "- Semestre" ?></font></td>

                                            <td align="center">

                                                <a data-toggle="modal" href="#modal-form" onclick="modal('editar_curso',<?php echo $row['cursos_id']; ?>)"	class="btn btn-gray btn-small">
                                                    <i class="icon-wrench"></i> <?php echo 'editar'; ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?educacional/periodo/delete/<?php echo $row['periodo_letivo_id']; ?>')"
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
                                                <label class="control-label"><?php echo 'periodo_letivo'; ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="curso"/>
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'descrição'; ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="abreviatura"/>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>

                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'dias_letivo'; ?></label>
                                                <div class="controls">
                                                    <input type="text" name="habilidade"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'data_inicio'; ?></label>
                                                <div class="controls">
                                                    <input type="text" name="estagio"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'data_previsão_termino'; ?></label>
                                                <div class="controls">
                                                    <input type="text" name="atividades_complementares"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'situação_período'; ?></label>
                                                <div class="controls">                                                  
                                                    <select>
                                                        <option value="0">Período Encerrado</option>
                                                        <option value="1">Período Aberto</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'ano'; ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="coordenador"/>
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