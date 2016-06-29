<div class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo 'lista_turma'; ?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo 'nova_turma'; ?>
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
                            <i id="colorb" class="fa fa-users"></i>
                            <!--<img src="<?php echo base_url(); ?>template/images/icons_menu/vestibular.png" />-->
                            <span>Total <?php echo count($turma); ?> Turmas</span>
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
                                <th><div><?php echo 'descrição'; ?></div></th>
                                <th><div><?php echo 'periodo_letivo'; ?></div></th>

                                <th><div><?php echo 'matriz'; ?></div></th>
                                <th><div><?php echo 'periodo'; ?></div></th>
                                <th><div><?php echo 'options'; ?></div></th>

                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($turma as $row):
                                        $periodo = $row['periodo_id'];
                                        if ($periodo == 1) {
                                            $periodo = 'I';
                                        } else if ($periodo == 2) {
                                            $periodo = 'II';
                                        } else if ($periodo == 3) {
                                            $periodo = 'III';
                                        } else if ($periodo == 4) {
                                            $periodo = 'IV';
                                        } else if ($periodo == 5) {
                                            $periodo = 'V';
                                        } else if ($periodo == 6) {
                                            $periodo = 'VI';
                                        } else if ($periodo == 7) {
                                            $periodo = 'VII';
                                        } else if ($periodo == 8) {
                                            $periodo = 'VIII';
                                        } else if ($periodo == 9) {
                                            $periodo = 'IX';
                                        } else if ($periodo == 10) {
                                            $periodo = 'X';
                                        }

                                        $status = $row['status'];
                                        if ($status == '0') {
                                            $status_descricao = 'Fechada';
                                        } else if ($status == '1') {
                                            $status_descricao = 'Aberta';
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $row['cur_tx_descricao']; ?></td>
                                            <td><?php echo $row['tur_tx_descricao']; ?> - <?php echo $row['descricao']; ?> - <?php echo $status_descricao; ?></td>
                                            <td><?php echo $this->crud_model->get_type_periodo_by_id('periodo_letivo', $row['periodo_letivo_id']); ?></td>
                                            <td><?php echo $row['mat_tx_ano']; ?>/<?php echo $row['mat_tx_semestre']; ?></td>                                          
                                            <td><?php echo $periodo; ?> </td>
                                            <td align="center">
                                                <a data-toggle="modal" href="#modal-form" onclick="modal('editar_turma',<?php echo $row['turma_id']; ?>)"	class="btn btn-gray btn-small">
                                                    <i class="icon-wrench"></i> <?php echo 'editar'; ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?educacional/turma/delete/<?php echo $row['turma_id']; ?>')"
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
                    <?php echo form_open('educacional/turma/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <div class="padded">
                        <table width="100%" class="responsive">
                            <tbody>
                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'descrição'; ?></label>
                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="descricao"/>
                                            </div>
                                        </div>
                                    </td>


                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'periodo_letivo'; ?></label>
                                            <div class="controls">
                                                <?php $periodo_turma = $this->crud_model->get_periodo_turma(); ?>
                                                <select name="periodo_letivo">
                                                    <option value="">Selecione o Periodo Letivo</option>
                                                    <?php foreach ($periodo_turma as $row):
                                                        ?>
                                                        <option value="<?php echo $row['periodo_letivo_id'] ?>"><?php echo $row['periodo_letivo']; ?> </option>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'Curso'; ?></label>
                                            <div class="controls">
                                                <?php $curso_turma = $this->crud_model->get_curso_turma(); ?>
                                                <select id="curso" name="curso" onchange="buscar_matriz()">
                                                    <option value="0">Selecione um curso</option>
                                                    <?php foreach ($curso_turma as $row):
                                                        ?>
                                                        <option value="<?php echo $row['cursos_id'] ?>"><?php echo $row['cur_tx_descricao']; ?> </option>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'matriz'; ?></label>

                                            <div class="controls" id="load_matriz">
                                                <select name="matriz" id="matriz">
                                                    <option value="">Selecione a matriz</option>
                                                </select>
                                            </div>

                                        </div>
                                    </td>

                                </tr>

                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'status'; ?></label>
                                            <div class="controls">
                                                <select name="status">
                                                    <option value="">Selecione o Status</option>
                                                    <option value="0">Fechada</option>
                                                    <option value="1">Aberta</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'turno'; ?></label>
                                            <?php $turno_turma = $this->crud_model->get_turno_turma(); ?>
                                            <div class="controls">
                                                <select name="turno">
                                                    <option value="">Selecione o Turno</option>
                                                    <?php foreach ($turno_turma as $row):
                                                        ?> 
                                                        <option value="<?php echo $row['turno_id']; ?>"><?php echo $row['descricao'] ?></option>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>

                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'periodo'; ?></label>
                                            <?php $periodo = $this->crud_model->get_periodo(); ?>
                                            <div class="controls">
                                                <select name="periodo">
                                                    <option value="">Selecione o Periodo</option>
                                                    <?php
                                                    foreach ($periodo as $row):
                                                        ?>
                                                        <option value="<?php echo $row['periodo_id'] ?>"><?php echo $row['periodo']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>



                    <div class="form-actions">
                        <button type="submit" class="btn btn-gray"><?php echo 'criar_turma'; ?></button>
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

    function buscar_matriz() {
        var curso = $('#curso').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (curso) {
            var url = 'index.php?educacional/carrega_matriz/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_matriz').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

</script>