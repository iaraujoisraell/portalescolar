<?php
$vestibularPontuacao_info = $this->crud_model->get_vestibular_chamada_info($current_pontuacao_vestibular_id);

foreach ($vestibularPontuacao_info as $row):
    ?>
    <div class="box" >
        <div class="">
            <div class="title">
                <div style="float:left; width:360px;height:157px;text-align:left;position:relative; margin-bottom:0px;">
                    <div  style="position:absolute; bottom:10px;left:10px;">
                        <h3 style=" color:#666;font-weight:100;"><?php echo $row['name']; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <br />

        <?php echo form_open('admin/Pontuacao/' . $row['vestibular_id'], array('class' => 'form-vertical validatable', 'target' => '_top')); ?>
        <input type="hidden"  value="<?php echo $row['vestibular_id']; ?>" name="vestibular"/>
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

        <table width="50%"  class="table table-normal responsive">
            <tr width="50%">
                <td width="5%">Candidato</td>
                <td width="5%"><b>Prova</b>/<b>Redação</b></td>     
                <td width="5%"><b>Aprovado</b></td>
                <td width="5%"><b>Reprovado</b></td>
            </tr>


            <?php
            $cont2 = 1;
            $cont = 1;
            $candidato = $this->crud_model->get_candidato_pontuacao_info($current_pontuacao_vestibular_id);
            $num = count($candidato);

            foreach ($candidato as $row_candidato):
                $aprovado = $row_candidato['cv_nb_aprovado'];
                $candidatoChamada = $row_candidato['candidato_id'];
                $prova = $row_candidato['cv_tx_ponto_prova'];
                  
                  ?>

                <input type="hidden" name="candidato<?php echo $cont2; ?>" value="<?php echo $candidatoChamada; ?>"/>
                <tr width="20%" >

                    <td ><?php echo $row_candidato['nome']; ?></td>
                    <td>
                        <input style="width: 30px;"  type="text" value="<?php echo $prova; ?>" name="prova<?php echo $cont2; ?>"/>
                        <input style="width: 30px;"  type="text" name="redacao<?php echo $cont2; ?>"/></td>

                    <?php
                $respostaChamada = $this->crud_model->get_resultado_aprovado_info($current_pontuacao_vestibular_id, $candidatoChamada);

                foreach ($respostaChamada as $row_resposta):

                    if ($row_resposta['cv_nb_aprovado'] == '0') {
                        ?>
                        <td><input type="radio" checked="true" value="0" name="resposta<?php echo $cont2; ?>"/></td>
                        <td><input type="radio" value="1" name="resposta<?php echo $cont2; ?>"/></td>
                        <?php
                    } else if ($row_resposta['cv_nb_aprovado'] == '1') {
                        ?>
                        <td><input type="radio"  value="0" name="resposta<?php echo $cont2; ?>"/></td>
                        <td><input type="radio" checked="true" value="1" name="resposta<?php echo $cont2; ?>"/></td>
                        <?php
                    } else {
                        ?>
                        <td><input type="radio" checked="true" value="0" name="resposta<?php echo $cont2; ?>"/></td>
                        <td><input type="radio" checked="true" value="1" name="resposta<?php echo $cont2; ?>"/></td>
                        <?php
                    }

                endforeach;
                ?>

                   
                </tr>
                <input type="hidden" name="total" value="<?php echo $num; ?>"/>
                 <input type="hidden" name="vestibular" value="<?php echo $current_pontuacao_vestibular_id; ?>"/>
                 
                <?php
                 $cont++;
                    $cont2++;
            endforeach;
            ?>
        </table>


        <div class="form-actions">
            <button type="submit" class="btn btn-gray"><?php echo get_phrase('salvar_pontuacao'); ?></button>
        </div>
        </form>
</div>
