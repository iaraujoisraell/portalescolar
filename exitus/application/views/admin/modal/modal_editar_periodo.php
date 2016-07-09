<div class="tab-pane box active" id="edit">
    <div class="box-content">
        <?php foreach ($edit_data as $row): ?>
            <?php echo form_open('educacional/periodo_letivo/do_update/' . $row['periodo_letivo_id'], array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('periodo_letivo'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['periodo_letivo']; ?>" name="periodo_letivo"/>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('descrição'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['periodo_letivo_descricao']; ?>" name="descricao"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('dias_letivos'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['dias_letivos']; ?>"  name="dias_letivos"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('data_inicio'); ?></label>
                    <div class="controls">
                        <input type="text" class="datepicker fill-up" value="<?php echo date("d/m/Y", strtotime($row['data_inicio'])); ?>" name="data_inicio"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('data_previsão_termino'); ?></label>
                    <div class="controls">
                        <input type="text" class="datepicker fill-up" value="<?php echo date("d/m/Y", strtotime($row['data_prev_termino'])); ?>" name="data_prev_terminio"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('data_termino'); ?></label>
                    <div class="controls">
                        <input type="text" class="datepicker fill-up" value="<?php echo date("d/m/Y", strtotime($row['data_termino'])); ?>" class="validate[required]" name="data_termino"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('situação_periodo'); ?></label>
                    <div class="controls">


                        <select name="situacao">
                            <?php if ($row['periodo_encerrado'] == "0") {
                                ?> <option value="0">Período Encerrado</option>
                                <option value="1">Período Aberto</option>
                                <?php
                            } else {
                                ?><option value="1">Período Aberto</option>
                                <option value="0">Período Encerrado</option>
                                <?php
                            }
                            ?>



                        </select>

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('ano'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['ano']; ?>" class="validate[required]" name="ano"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('semestre'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['semestre']; ?>" class="validate[required]" name="semestre"/>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo get_phrase('editar_periodo_letivo'); ?></button>
            </div>
            </form>
        <?php endforeach; ?>
    </div>
</div>