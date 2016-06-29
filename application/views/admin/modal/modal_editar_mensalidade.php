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
                    <label class="control-label"><?php echo get_phrase('parcela'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['parcela'] ?>"  onKeyPress="return(MascaraMoeda1(this, '.', ',', event))"  name="parcela"/>

                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Data_vencimento'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo date("d/m/Y", strtotime($row['data_vencimento'])); ?>"  name="data_vencimento"/>
                    </div>
                </div>


                

                
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('valor'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo number_format($row['valor'], 2, ',', ''); ?>" placeholder="R$ 0.000,00" onKeyPress="return(MascaraMoeda1(this, '.', ',', event))"  name="valor"/>

                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('mês'); ?></label>
                    <div class="controls">
                        <input type="text"  value="<?php echo $row['mes'] ?>" onKeyPress="return(MascaraMoeda1(this, '.', ',', event))"  name="mes"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('referente'); ?></label>
                    <div class="controls">
                        <input type="text"  value="<?php echo $row['referente'] ?>"  name="referente"/>
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