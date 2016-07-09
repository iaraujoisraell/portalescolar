<div class="tab-pane box active" id="edit">
    <div class="box-content">    
             <div class="padded">
                <?php echo form_open('educacional/periodo/do_update/' . $row['periodo_letivo_id'], array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
            <div class="control-group">
                <label class="control-label"><?php echo get_phrase('Bolsas'); ?></label>
                <div class="controls">

                    <select name="forma_pagamento">
                         <?php foreach ($bolsa as $row_bolsa): ?>
                        <option value="<?php echo $row_bolsa['bolsas_id']; ?>"><?php echo $row_bolsa['descricao']; ?></option>
                         <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo get_phrase('adicionar_bolsa'); ?></button>
            </div>
            </form>
            
            
    </div>
</div>