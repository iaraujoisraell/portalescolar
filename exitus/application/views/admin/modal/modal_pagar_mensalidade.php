<script>
function exibirData($data) {
    $rData = explode("-", $data);
    $rData = $rData[2] . '/' . $rData[1] . '/' . $rData[0];
    return $rData;
}
</script>
<?php $hoje = date("Y-m-d"); ?>
<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach ($edit_data as $row): ?>
            <?php echo form_open('financeiro/mensalidades/salvar_pagamento/' . $row['mensalidades_id'], array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
            <div class="padded">
                


                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Data_Pagamento'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo date("d/m/Y", strtotime($hoje)); ?>"  name="data_pagamento"/>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('forma_pagamento'); ?></label>
                    <div class="controls">

                        <select name="forma_pagamento">
                            <option value="1">Á Vista</option>
                            <option value="2">C. Crédito</option>  
                            <option value="3">C. Débito</option>
                            <option value="4">Cheque</option>    
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('desconto'); ?></label>
                    <div class="controls">
                        <input type="text"  placeholder="R$ 0.000,00" onKeyPress="return(MascaraMoeda1(this, '.', ',', event))"  name="desconto"/>

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('juros'); ?></label>
                    <div class="controls">
                        <input type="text"  placeholder="R$ 0.000,00" onKeyPress="return(MascaraMoeda1(this, '.', ',', event))"  name="valor"/>
                        <input type="hidden" value="1"  name="instituicao"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('valor_pagamento'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo number_format($row['valor'], 2, ',', ''); ?>" placeholder="R$ 0.000,00" onKeyPress="return(MascaraMoeda1(this, '.', ',', event))"  name="valor_pagamento"/>

                    </div>
                </div>


            </div>


            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo get_phrase('confirmar_pagamento'); ?></button>
            </div>
            </form>
        <?php endforeach; ?>
    </div>
</div>