<?php
$vestibularChamada_info = $this->crud_model->get_vestibular_chamada_info($current_chamada_vestibular_id);
foreach ($vestibularChamada_info as $row):
    ?>
    <div class="box">
        <?php if ($this->session->flashdata('flash_message') != ""): ?>
            <script>
                $(document).ready(function () {
                    Growl.info({title: "<?php echo $this->session->flashdata('flash_message'); ?>", text: " "})
                });
            </script>
        <?php endif; ?>
        <div class="">
            <div class="title">
                <div style="float:left;width:370px;height:147px;text-align:left;position:relative; margin-bottom:20px;">
                    <div  style="position:absolute; bottom:10px;left:150px;">
                        <h3 style=" color:#666;font-weight:100;"><?php echo $row['name']; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <?php echo form_open('admin/Chamada/do_update/' . $row['vest_nb_codigo'], array('class' => 'form-vertical validatable', 'target' => '_top')); ?>
        <table  class="table table-normal">
            <?php echo "Tipo do Vestibular: " ?><?php
            if ($row['vest_nb_tipo']) {
                echo "Macro";
            } else {
                echo "Agendado";
            }
            ?>
            <br>
            <?php echo "Ano do Vestibular: " . $row['vest_nb_ano'] . "/" . $row['vest_tx_semestre'] ?><br>
            <?php echo "Data: " . date('d/m/Y', strtotime($row['vest_dt_realizacao'])); ?>
        <?php endforeach; ?>

        <tr>
            <td><b>Nº</b></td>
            <td><b>Candidato</b></td>
            <td><b>Presente</b></td>
            <td><b>Ausente</b></td>
        </tr>

        <?php
        $candidato = $this->crud_model->get_candidato_chamada_info($current_chamada_vestibular_id);
        $cont = 1;
        $cont2 = 1;
        $conta = 1;
        $contador = 1;
        $num = count($candidato);
        foreach ($candidato as $row_candidato):
            $candidatoChamada = $row_candidato['candidato_id'];
            ?>
            <tr>
                <td><?php echo $cont2++; ?></td>
                <td><?php echo $row_candidato['nome']; ?></td>

                <?php
                $respostaChamada = $this->crud_model->get_resultado_chamada_info($current_chamada_vestibular_id, $candidatoChamada);

                foreach ($respostaChamada as $row_resposta):

                    if ($row_resposta['cv_nb_resposta'] == '0') {
                        ?>
                        <td><input type="radio" checked="true" value="0" name="resposta<?php echo $cont++; ?>"/></td>
                        <td><input type="radio" value="1" name="resposta<?php echo $conta++; ?>"/></td>
                        <?php
                    } else if ($row_resposta['cv_nb_resposta'] == '1') {
                        ?>
                        <td><input type="radio"  value="0" name="resposta<?php echo $conta++; ?>"/></td>
                        <td><input type="radio" checked="true" value="1" name="resposta<?php echo $cont++; ?>"/></td>
                        <?php
                    } else {
                        ?>
                        <td><input type="radio" checked="true" value="0" name="resposta<?php echo $cont++; ?>"/></td>
                        <td><input type="radio" checked="true" value="1" name="resposta<?php echo $conta++; ?>"/></td>
                        <?php
                    }

                endforeach;
                ?>

            </tr>
            <input type="hidden" name="candidato<?php echo $contador++; ?>" value="<?php echo $candidatoChamada; ?>"/>
            <?php
        endforeach;
        ?>
        <input type="hidden" name="total" value="<?php echo $num; ?>"/>
        <input type="hidden" name="vestibular" value="<?php echo $current_chamada_vestibular_id; ?>"/>
    </table>

    <div class="form-actions">
        <button type="submit" class="btn btn-gray"><?php echo get_phrase('salvar_chamada'); ?></button>
    </div>
</form>
</div>
