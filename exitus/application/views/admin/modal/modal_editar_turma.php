<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach ($edit_data as $row): 
            $curso_descricao = $row['cur_tx_descricao'];
            $curso = $row['cursos_id'];
            $matriz = $row['matriz_id'];
            $matriz_ano = $row['mat_tx_ano'];
            $status = $row['status'];
            if($status =='0'){
                $status_descricao = 'Fechada';
            }else if($status == '1'){
                $status_descricao = 'Aberta';
            }
            $turno = $row['turno_id'];
            $turno_descricao = $row['descricao'];
            $periodo_letivo = $row['periodo_letivo'];
            
            $periodo2 = $row['periodo_id'];
            ?>
            <?php echo form_open('educacional/turma/do_update/' . $row['turma_id'], array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Descrição'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['tur_tx_descricao']; ?>" id="descricao" name="descricao"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Periodo_letivo'); ?></label>
                    <div class="controls">
                        <?php $periodo_turma = $this->crud_model->get_periodo_turma(); ?>
                        <select name="periodo_letivo" id="periodo_letivo">
                            <option value="<?php echo $row['periodo_letivo_id']; ?>"><?php echo $periodo_letivo; ?></option>
                            <?php foreach ($periodo_turma as $row):
                                ?>
                                <option value="<?php echo $row['periodo_letivo_id'] ?>"><?php echo $row['periodo_letivo']; ?> </option>
                                <?php
                            endforeach;
                            ?>
                        </select>  
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo 'Curso'; ?></label>
                    <div class="controls">
                        <?php $curso_turma = $this->crud_model->get_curso_turma(); ?>
                        <select id="curso" name="curso" onchange="buscar_matriz()">
                            <option value="<?php echo $curso; ?>"> <?php echo $curso_descricao; ?> </option>
                            <?php foreach ($curso_turma as $row2):
                                ?>
                                <option value="<?php echo $row2['cursos_id'] ?>"><?php echo $row2['cur_tx_descricao']; ?> </option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Matriz'); ?></label>
                    <div class="controls">
                        <div id="load_matriz">
                        <select name="matriz" id="matriz">
                            <option value="<?php echo $matriz; ?>"><?php echo $matriz_ano; ?></option>
                        </select>
                            </div>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Status'); ?></label>
                    <div class="controls">
                        <select name="status">
                            <option value="<?php echo $status; ?>"><?php echo $status_descricao; ?></option>
                            <option value="0">Fechada</option>
                            <option value="1">Aberta</option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Turno'); ?></label>
                    <?php $turno_turma = $this->crud_model->get_turno_turma(); ?>
                    <div class="controls">
                        <select name="turno">
                            <option value="<?php echo $turno; ?>"><?php echo $turno_descricao; ?></option>
                            <?php foreach ($turno_turma as $row):
                                ?> 
                                <option value="<?php echo $row['turno_id']; ?>"><?php echo $row['descricao'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('periodo'); ?></label>
                    <?php $periodo = $this->crud_model->get_periodo(); ?>
                    <div class="controls">
                        <select name="periodo">
                            <option value="<?php echo $periodo2; ?>"><?php echo $periodo2; ?></option>
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

 



            </div>


            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo get_phrase('editar_turma'); ?></button>
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