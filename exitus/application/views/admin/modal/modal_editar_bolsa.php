<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach ($edit_data as $row): 
            $tipo = $row['tipo'];
            if($tipo == 1){
                $tipo_tx = 'BOLSAS';
            }else if($tipo == 2){
                $tipo_tx = 'FINANCIAMENTO';
            }
            ?>
            <?php echo form_open('educacional/bolsas/do_update/' . $row['bolsas_id'], array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Bolsa'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['descricao']; ?>"  name="descricao"/>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Porcentagem Mínima'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['porcentagem_minima']; ?>"  name="porcentagem_minima"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Porcentagem Maxíma'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['porcentagem_maxima']; ?>" name="porcentagem_maxima"/>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Tipo'); ?></label>
                    <div class="controls">
                        
                        <select name="tipo" id='tipo'>
                            <option value="<?php echo $row['tipo']; ?>"><?php echo $tipo_tx; ?></option>
                            <option value="1">BOLSA</option>
                            <option value="2">FINANCIAMENTO</option>
                         </select>
                    </div>
                </div>
                
                


            </div>


            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo get_phrase('editar_bolsa'); ?></button>
            </div>
            </form>
        <?php endforeach; ?>
    </div>
</div>