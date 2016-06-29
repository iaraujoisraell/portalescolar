<div class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">

            <li>
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo 'lista_aluno'; ?>
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
                            <img src="<?php echo base_url(); ?>template/images/icons_menu/vestibular.png" />
                            <span>Total <?php echo count($aluno); ?> Alunos</span>
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
                                <th><div><?php echo 'Nome'; ?></div></th>
                                <th><div><?php echo 'CPF'; ?></div></th>
                                <th><div><?php echo 'data_nascimento'; ?></div></th>
                                <th><div><?php echo 'sexo'; ?></div></th>
                                <th><div><?php echo 'RG'; ?></div></th>
                                <th><div><?php echo 'opções'; ?></div></th>

                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($aluno as $row):
                                        $periodo = $row['periodo_id'];
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $row['nome']; ?></td>
                                            <td><?php echo $row['cpf']; ?></td>
                                            <td><?php echo $row['data_nascimento']; ?></td>
                                            <td>

                                                <?php
                                                if ($row['sexo'] == 0) {

                                                    echo "Feminino";
                                                } else if ($row['sexo'] == 1) {

                                                    echo "Masculino";
                                                }
                                                ?>
                                            </td>                                          
                                            <td><?php echo $row['rg']; ?> </td>

                                            <td align="center">
                                                <a data-toggle="modal" href="#modal-form" onclick="modal('edit_vestibular',<?php echo $row['bolsas_id']; ?>)"	class="btn btn-gray btn-small">
                                                    <i class="icon-wrench"></i> <?php echo 'editar'; ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?educacional/bolsas/delete/<?php echo $row['bolsas_id']; ?>')"
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

                    <?php echo form_open('educacional/aluno_turma/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <div class="padded">

                        <b>DADOS</b>
                        <hr/>

                        <?php
                        $cont = 1;
                        foreach ($turma_aluno as $row_aluno):
                            ?>
                            <input type="hidden" name="matricula_id" value="<?php echo $row_aluno['matricula_aluno_id']; ?>"/>
                            <b style="font-size: 18px;"><?php echo "Nome: " . $row_aluno['nome']; ?></b></br>
                            <b style="font-size: 18px;"><?php echo "Matricula: " . $row_aluno['matricula_aluno_id']; ?></b></br>
                            <b style="font-size: 18px;"><?php echo "Curso: " . $row_aluno['cur_tx_descricao']; ?></b>


                            <?php
                        endforeach;
                        ?>
                        </br>
                        </br>

                        <b>CADASTRO DE TURMA</b>
                        <hr/>


                        <table width="100%" class="responsive">
                            <tbody>

                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'Turma'; ?></label>
                                            <div class="controls">

                                                <select name="turma">
                                                    <option>Selecione a turma</option>
                                                    <?php
                                                    foreach ($turma as $row1):
                                                        ?>
                                                        <option value="<?php echo $row1['turma_id']; ?>"><?php echo $row1['tur_tx_descricao']; ?></option>
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
                        <button type="submit" class="btn btn-gray"><?php echo 'avançar'; ?></button>
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