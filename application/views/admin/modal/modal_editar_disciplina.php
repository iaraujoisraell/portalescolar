<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php
        foreach ($edit_data as $row):
            $periodo = $row['periodo'];

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
    <?php echo form_open('educacional/matriz_disciplina/do_update/' . $row['matriz_disciplina_id'], array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
        <input type="hidden" name="disciplina_codigo" value="<?php echo $row['disciplina_id']; ?>" >
         <input type="hidden" name="matriz_codigo" value="<?php echo $row['matriz_id']; ?>" >
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('cód_disciplina'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['disc_tx_abrev']; ?>" style="text-transform: uppercase;border-radius:5px;" name="abreviatura"/>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Disciplina'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['disc_tx_descricao']; ?>" style="text-transform: uppercase;border-radius:5px;" name="disciplina"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('carga_horária'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['carga_horaria']; ?>" style="text-transform: uppercase;border-radius:5px;" name="carga_horaria"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Crédito'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['credito']; ?>" style="text-transform: uppercase;border-radius:5px;" name="credito"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Período'); ?></label>
                    <div class="controls">
                        <select class="validate[required]" style="text-transform: uppercase;border-radius:5px;" name="periodo">
                            <option value="<?php echo $row['periodo']; ?>"><?php echo $periodo2; ?> Período</option>
                            <option value="1">I Período</option>
                            <option value="2">II Período</option>
                            <option value="3">III Período</option>
                            <option value="4">IV Período</option>
                            <option value="5">V Período</option>
                            <option value="6">VI Período</option>
                            <option value="7">VII Período</option>
                            <option value="8">VIII Período</option>
                        </select>
                    </div>
                </div>





            </div>


            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo get_phrase('editar_disciplina'); ?></button>
            </div>
            </form>
<?php endforeach; ?>
    </div>
</div>