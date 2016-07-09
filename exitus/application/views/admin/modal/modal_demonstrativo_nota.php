<div class="tab-pane box active" id="edit" style="padding: 5px; width: 100%">
    <div class="box-content" >
        <?php foreach ($edit_data as $row): 
            /*$disciplina = $row['disc_tx_descricao'];
            $n1 = $row['dan_fl_nota_1bim'];
            $n2 = $row['dan_fl_nota_2bim'];
            $n3 = $row['dan_fl_nota_3bim'];
            $pf = $row['dan_fl_nota_pf'];
            $md = $row['dan_fl_media_final'];
            
            $n1 = $row['dan_nb_falta_1bim'];
            $n2 = $row['dan_nb_falta_2bim'];
            $n3 = $row['dan_nb_falta_3bim'];
            $n3 = $row['dan_nb_total_falta'];
            
            $situacao = $row['dan_nb_situacao_final'];*/
            ?>
            <?php echo form_open('educacional/turma/do_update/' . $row['turma_id'], array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Descrição'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['tur_tx_descricao']; ?>" id="descricao" name="descricao"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Periodo_letivo'); ?></label>
                    <div class="controls">
                        <?php $periodo_turma = $this->crud_model->get_periodo_turma(); ?>
                        <select name="periodo_letivo" id="periodo_letivo">
                            <option value="<?php echo $row['periodo_letivo_id']; ?>"><?php echo $periodo_letivo; ?></option>
                            <?php foreach ($periodo_turma as $row):
                                ?>
                                <option value="<?php echo $row['periodo_letivo_id'] ?>"><?php echo $row['periodo_letivo']; ?> </option>
                                <?php
                            endforeach;
                            ?>
                        </select>  
                    </div>
                </div>

           
           
        <?php endforeach; ?>
<table  class="table table-normal">
        <tr>
            <td><b>Nº</b></td>
            <td><b>Disciplina</b></td>
            <td><b>N1</b></td>           
            <td><b>N2</b></td>                       
            <td><b>N3</b></td>
            <td><b>Média</b></td>
            <td><b>T.Falta</b></td>
            <td><b>Situação</b></td>
        </tr>

        <?php
       // $candidato = $this->crud_model->get_demonstrativo_nota($current_matricula_aluno_turma_id);
         $cont2 = 1;
        $sql_candidato = "SELECT d.disc_tx_descricao as disciplina, dan_fl_nota_1bim as 1bim, dan_fl_nota_2bim as 2bim,dan_fl_nota_3bim as 3bim, dan_fl_media_final as media,dan_nb_total_falta as falta, dan_nb_situacao_final as situacao FROM disciplina_aluno da
left join disciplina_aluno_nota dan on dan.disciplina_aluno_id = da.disciplina_aluno_id
inner join disciplina d on d.disciplina_id = da.disciplina_id
where matricula_aluno_turma_id = $current_matricula_aluno_turma_id

union

SELECT d.disc_tx_descricao as disciplina, dan_fl_nota_1bim as 1bim, dan_fl_nota_2bim as 2bim,dan_fl_nota_3bim as 3bim, dan_fl_media_final as media,dan_nb_total_falta as falta, dan_nb_situacao_final as situacao FROM disciplina_aluno da
left join disciplina_aluno_nota dan on dan.disciplina_aluno_id = da.disciplina_aluno_id
inner join matriz_disciplina md on md.matriz_disciplina_id = da.matriz_disciplina_id
inner join disciplina d on d.disciplina_id = md.disciplina_id
where matricula_aluno_turma_id = $current_matricula_aluno_turma_id ";
        $candidato = $this->db->query($sql_candidato)->result_array();
        foreach ($candidato as $row_candidato):
            $situacao = $row_candidato['situacao'];
        
             if( $situacao == '1'){
                 $situacao2 = 'AP';
            }else if( $situacao == '2'){
                 $situacao2 = 'RN';
            }else if( $situacao == '3'){
                 $situacao2 = 'RF';
            }else if( $situacao == '4'){
                 $situacao2 = 'RNF';
            }else if( $situacao == '0'){
                 $situacao2 = '';
            }
              ?>
            <tr>
                <td><?php echo $cont2++; ?></td>
                <td><?php echo $row_candidato['disciplina']; ?></td>
                <td><?php echo $row_candidato['1bim']; ?></td>               
                <td><?php echo $row_candidato['2bim']; ?></td>
                <td><?php echo $row_candidato['3bim']; ?></td>
                 <td><?php echo $row_candidato['media']; ?></td>
                  <td><?php echo $row_candidato['falta']; ?></td>
                  <td><?php echo $situacao2; ?></td>
            </tr>
                 <?php
        endforeach;
        ?>
      </table>
               

 



            </div>


         

    </div>
</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function () {
        readURL(this);
    });

    function buscar_matriz() {
        var curso = $('#curso').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (curso) {
            var url = 'index.php?educacional/carrega_matriz/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_matriz').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

</script>