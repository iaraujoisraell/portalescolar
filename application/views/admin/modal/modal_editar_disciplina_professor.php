<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php
        foreach ($edit_data as $row):
            $periodo = $row['periodo'];
            $turma_id = $row['turma_id'];
            $turma = $row['tur_tx_descricao'];



            if ($periodo == '1') {
                $periodo2 = 'I';
            } else if ($periodo == '2') {
                $periodo2 = 'II';
            } else if ($periodo == '3') {
                $periodo2 = 'III';
            } else if ($periodo == '4') {
                $periodo2 = 'IV';
            } else if ($periodo == '5') {
                $periodo2 = 'V';
            } else if ($periodo == '6') {
                $periodo2 = 'VI';
            } else if ($periodo == '7') {
                $periodo2 = 'VII';
            } else if ($periodo == '8') {
                $periodo2 = 'VIII';
            }
            ?>
            <?php echo form_open('educacional/professor_disciplina/do_update/' . $row['professor_turma_id'], array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
            <input type="hidden" class="validate[required]"  name="cod_professor" value="<?php echo $row['teacher_id']; ?>"/>
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo 'Curso'; ?></label>
                    <div class="controls">
                        <?php $curso_turma = $this->crud_model->get_curso_turma(); ?>
                        <select id="curso" name="curso" onchange="buscar_turma();">
                            <option value="<?php echo $row['cursos_id']; ?>"><?php echo $row['cur_tx_descricao']; ?></option>
                            <?php foreach ($curso_turma as $row1):
                                ?>
                                <option value="<?php echo $row1['cursos_id'] ?>"><?php echo $row1['cur_tx_descricao']; ?> </option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label"><?php echo 'Turma'; ?></label>
                    <div class="controls" id="load_turma">
                        <select id="turma" name="turma" onchange="buscar_disciplina();" >
                             <option value="<?php echo $turma_id . '/' . $row['periodo'] ?>"> <?php echo $row['tur_tx_descricao'] ?>/ <?php echo $periodo2 ?> - Período </option>
                           <?php
                            foreach ($edit_data1 as $row4):
                                $id_turma = $row4['turma_id'];
                                $turma = $row4['tur_tx_descricao'];

                                //$periodo2 = $row1['periodo_id'];
                                if ($row4['periodo_id'] == 1) {
                                    $periodo3 = 'I';
                                } else if ($row4['periodo_id'] == 2) {
                                    $periodo3 = 'II';
                                } else if ($row4['periodo_id'] == 3) {
                                    $periodo3 = 'III';
                                } else if ($row4['periodo_id'] == 4) {
                                    $periodo3 = 'IV';
                                } else if ($row4['periodo_id'] == 5) {
                                    $periodo3 = 'V';
                                } else if ($row4['periodo_id'] == 6) {
                                    $periodo3 = 'VI';
                                } else if ($row4['periodo_id'] == 7) {
                                    $periodo3 = 'VII';
                                } else if ($row4['periodo_id'] == 8) {
                                    $periodo3 = 'VIII';
                                } else if ($row4['periodo_id'] == 9) {
                                    $periodo3 = 'IX';
                                } else if ($row4['periodo_id'] == 10) {
                                    $periodo3 = 'X';
                                }
                                ?>
                                <option value="<?php echo $id_turma . '/' . $periodo3 ?>"> <?php echo $row4['tur_tx_descricao']; ?>/ <?php echo $periodo3 ?> - Período </option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Disciplina'); ?></label>
                    <div class="controls" id="load_disciplina">
                        <select name="disciplina" id="disciplina">
                            <option value="<?php echo $row['matriz_disciplina_id']; ?>"><?php echo $row['disc_tx_descricao']; ?></option>
                            <?php foreach ($edit_data2 as $row2):
                                ?>
                                <option value="<?php echo $row2['matriz_disciplina_id'] ?>"><?php echo $row2['disc_tx_descricao']; ?> </option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>







            </div>


            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo get_phrase('editar_disciplina_professor'); ?></button>
            </div>
            </form>
        <?php endforeach; ?>
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


    function buscar_turma() {
        var curso = $('#curso').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (curso) {
            var url = 'index.php?educacional/carrega_turma/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_turma').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

    function buscar_disciplina() {

        var turma = $('#turma').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (turma) {

            var url = 'index.php?educacional/carrega_disciplina/' + turma;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_disciplina').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

</script>