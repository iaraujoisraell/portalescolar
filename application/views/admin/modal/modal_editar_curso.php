<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach ($edit_data as $row): ?>
            <?php echo form_open('educacional/cursos/do_update/' . $row['cursos_id'], array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Nome do Curso'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['cur_tx_descricao']; ?>"  name="curso"/>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Nome Abrev. do Curso'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['cur_tx_abreviatura']; ?>"  name="abreviatura"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('habilitacao_do_curso'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['cur_tx_habilitacao']; ?>" name="habilidade"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('horas_de_estagio_obrigatorio'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['cur_nb_estagio_obrigatoria']; ?>" name="estagio"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('horas_de_atividade_complementares_obrigatorio'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['cur_nb_ativ_comp_obrigatoria']; ?>"  name="atividades_complementares"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('duracao_do_curso_(semestre(s))'); ?></label>
                    <div class="controls">

                        <input type="text" value="<?php echo $row['cur_tx_duracao']; ?>"  class="validate[required]" name="duracao"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('coordenador(a)'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['cur_tx_coordenador']; ?>" name="coordenador"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('valor_do_curso'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" placeholder="R$ 0.000,00" onKeyPress="return(MascaraMoeda1(this, '.', ',', event))" value="<?php echo number_format($row['cur_fl_valor'], 2, ',', ''); ?>" name="valor"/>
                        <input type="hidden" value="1"  name="instituicao"/>
                    </div>
                </div>



            </div>


            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo get_phrase('editar_curso'); ?></button>
            </div>
            </form>
        <?php endforeach; ?>
    </div>
</div>