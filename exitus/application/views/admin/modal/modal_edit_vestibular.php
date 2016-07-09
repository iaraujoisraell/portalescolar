<?php 
function exibirData($data) {
    $rData = explode("-", $data);
    $rData = $rData[2] . '/' . $rData[1] . '/' . $rData[0];
    return $rData;
}
?>
<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach ($edit_data as $row): ?>
            <?php echo form_open('admin/vestibular/do_update/' . $row['vestibular_id'], array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>


            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Ano'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" name="ano" value="<?php echo $row['vest_nb_ano']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Semestre'); ?></label>
                    <div class="controls">
                        <select name="semestre" class="uniform" style="width:100%;">
                            <option value="I" <?php if ($row['vest_tx_semestre'] == 'I') echo 'selected'; ?>><?php echo get_phrase('I Semestre'); ?></option>
                            <option value="II" <?php if ($row['vest_tx_semestre'] == 'II') echo 'selected'; ?>><?php echo get_phrase('II Semestre'); ?></option>
                        </select>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Tipo'); ?></label>
                    <div class="controls">
                        <select name="tipo" class="uniform" style="width:100%;">
                            <option value="1" <?php if ($row['vest_nb_tipo'] == '1') echo 'selected'; ?>><?php echo get_phrase('Macro'); ?></option>
                            <option value="2" <?php if ($row['vest_nb_tipo'] == '2') echo 'selected'; ?>><?php echo get_phrase('Agendado'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('data_vestibular'); ?></label>
                    <div class="controls">
                        <input type="text"  name="data_vestibular" value="<?php echo exibirData($row['vest_dt_realizacao']); ?>"/>
                    </div>
                </div>
                

                

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('data_inscrição'); ?></label>
                    <div class="controls">
                        <input type="text"  name="data_inscricao" value="<?php echo exibirData($row['vest_dt_inscricao']) ?>"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('data_encerramento'); ?></label>
                    <div class="controls">
                        <input type="text"  name="data_encerramento" value="<?php echo exibirData($row['vest_dt_encerramento']) ?>"/>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('data_resultado'); ?></label>
                    <div class="controls">
                        <input type="text"  name="data_resultado" value="<?php echo exibirData($row['vest_dt_resultado']) ?>"/>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('hora_inicio_prova'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="hora_inicio" value="<?php echo $row['vest_tx_inicio']; ?>"/>
                    </div>
                </div>
                
                 <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('hora_fim_prova'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="hora_fim" value="<?php echo $row['vest_tx_fim']; ?>"/>
                    </div>
                </div>
               
                
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo get_phrase('editar_vestibular'); ?></button>
            </div>
            </form>
        <?php endforeach; ?>
    </div>
</div>