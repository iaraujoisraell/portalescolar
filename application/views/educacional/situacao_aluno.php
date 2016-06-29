<div id="box" class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo 'situação_aluno'; ?>
                </a></li>
                <li >
            <a  href="index.php?educacional/aluno" 	>
                <i class="icon-backward"></i> <?php echo 'voltar_para_consulta_aluno'; ?>
            </a>
                    </li>
        </ul>
        <!------CONTROL TABS END------->

    </div>
    <div class="box-content padded">
        <div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <?php
            foreach ($turma as $row):
                 $matricula = $row['matricula_aluno_id'];
                        $cadastro_aluno = $row['cadastro_aluno_id'];
                        $matriz_id = $row['matriz_id'];
                        $periodo_atual = $row['periodo_atual'];
                        $desperiodizado = $row['desperiodizado'];
                        $bolsista = $row['bolsista'];
                        $forma_ingresso = $row['forma_ingresso'];

                        if ($periodo_atual) {
                            $periodo_atual2 = $periodo_atual;
                        } else {
                            $periodo_atual2 = 'Não Informado';
                        }

                        if ($desperiodizado == 1) {
                            $desperiodizado2 = 'SIM';
                            $periodo_atual2 = 'Desperiodizado';
                        } else {
                            $desperiodizado2 = 'NÃO';
                        }

                        if ($bolsista == 1) {
                            $bolsista2 = 'SIM';
                        } else {
                            $bolsista2 = 'NÃO';
                        }

                        if ($forma_ingresso == 1) {
                            $forma_ingresso2 = 'VESTIBULAR';
                        } else if ($forma_ingresso == 2) {
                            $forma_ingresso2 = 'ENEM';
                        } else if ($forma_ingresso == 3) {
                            $forma_ingresso2 = 'AVALIAÇÃO SERIADA';
                        } else if ($forma_ingresso == 4) {
                            $forma_ingresso2 = 'SELEÇÃO SIMPLIFICADA';
                        } else if ($forma_ingresso == 5) {
                            $forma_ingresso2 = 'TRANSFERÊNCIA';
                        } else if ($forma_ingresso == 6) {
                            $forma_ingresso2 = 'DECISÃO JUDICIAL';
                        } else if ($forma_ingresso == 7) {
                            $forma_ingresso2 = 'VAGAS REMANESCENTE';
                        } else if ($forma_ingresso == 8) {
                            $forma_ingresso2 = 'PROGRAMAS ESPECIAIS';
                        } else {
                            $forma_ingresso2 = 'NÃO INFORMADO';
                        }
                ?>
                 <div  style="background-color: threedhighlight; " class="tab-content">
                        <div style="margin-left: 15px;"  class="tab-pane fade in active">                            
                       <table width="100%" >
                            <tr>
                                <td width="15%">
                                    <div class="control-group">
                                        <label style="font-weight: bold " class="control-label"><?php echo 'reg. Acadêmico '; ?></label>
                                        <div class="controls">
                                            <?php echo $row['registro_academico']; ?>  
                                        </div>
                                    </div>
                                </td>
                                <td  width="30%">
                                    <div class="control-group">
                                        <label style="font-weight: bold " class="control-label"><?php echo 'Nome'; ?></label>
                                        <div class="controls">
                                            <?php echo $row['nome']; ?>

                                        </div>
                                    </div>
                                </td>


                                <td width="40%">
                                    <div class="control-group">
                                        <label style="font-weight: bold " class="control-label"><?php echo 'Curso'; ?></label>
                                        <div class="controls">
                                            <?php echo $row['cur_tx_descricao']; ?>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        </table>
                       <table width="100%" >
                            <?php
                            $sql_mt2 = "SELECT min(matricula_aluno_turma_id) as id, mat.ano as ano,mat.semestre as semestre, mat.periodo_letivo_id as periodo_letivo_id
                                    FROM matricula_aluno_turma mat
                                    left join periodo_letivo pl on pl.periodo_letivo_id = mat.periodo_letivo_id
                                    where matricula_aluno_id = $matricula ";
                            $uf_mt2 = $this->db->query($sql_mt2)->result_array();
                            foreach ($uf_mt2 as $row_mt2):
                                $ano = $row_mt2['ano'];
                                $semestre = $row_mt2['semestre'];
                                $periodo_letivo_id = $row_mt2['periodo_letivo_id'];

                                if ($periodo_letivo_id) {
                                    $sql_mt21 = "SELECT * FROM periodo_letivo where periodo_letivo_id =  $periodo_letivo_id ";
                                    $uf_mt21 = $this->db->query($sql_mt21)->result_array();
                                    foreach ($uf_mt21 as $row_mt22):
                                        $periodo_letivo = $row_mt22['periodo_letivo'];
                                    endforeach;
                                    $ano_igresso = $periodo_letivo;
                                }else {
                                    $ano_igresso = $ano . '/' . $semestre;
                                }
                            endforeach;
                            ?>
                            <tr>
                                <td width="15%" >
                                    <div class="control-group">
                                        <label style="font-weight: bold " class="control-label"><?php echo 'Ano de Ingresso'; ?></label>
                                        <div class="controls">
                                            <?php echo $ano_igresso; ?>

                                        </div>
                                    </div>
                                </td>
                                <?php
                                $sql_mt = "SELECT * FROM matriz where matriz_id = $matriz_id ";
                                $uf_mt = $this->db->query($sql_mt)->result_array();
                                foreach ($uf_mt as $row_mt):
                                    $mt_ano = $row_mt['mat_tx_ano'];
                                    $mt_semestre = $row_mt['mat_tx_semestre'];
                                endforeach;
                                ?>
                                <td width="20%">
                                    <div class="control-group">
                                        <label style="font-weight: bold " class="control-label"><?php echo 'Forma_ingresso'; ?></label>
                                        <div class="controls">
                                            <?php echo $forma_ingresso2; ?>
                                        </div>
                                    </div>
                                </td>
                                <td width="20%">
                                    <div class="control-group">
                                        <label style="font-weight: bold " class="control-label"><?php echo 'Matriz_atual'; ?></label>
                                        <div class="controls">
                                            <?php echo $mt_ano; ?>/<?php echo $mt_semestre; ?>

                                        </div>
                                    </div>
                                </td>
                                <td width="20%">
                                    <div class="control-group">
                                        <label style="font-weight: bold " class="control-label"><?php echo 'periodo_atual'; ?></label>
                                        <div class="controls">
                                            <?php echo $periodo_atual2; ?>

                                        </div>
                                    </div>
                                </td>
                                <td width="20%">
                                    <div class="control-group">
                                        <label style="font-weight: bold " class="control-label"><?php echo 'Desperiodizado?'; ?></label>
                                        <div class="controls">
                                          <?php echo $desperiodizado2; ?>
                                        </div>
                                    </div>
                                </td>
                                <td width="20%">
                                    <div class="control-group">
                                        <label style="font-weight: bold " class="control-label"><?php echo 'Bolsista?'; ?></label>
                                        <div class="controls">
                                           
                                            <?php echo $bolsista2; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>    
                        </div>
                    </div>

                <br>
                <table>
                    <tr>
                        <td align="center" >
                            <a  href="index.php?educacional/ficha_aluno/<?php echo $matricula; ?>"  class="btn btn-info btn-small" >
                                <i class="icon-wrench"></i> <?php echo 'Ficha_aluno'; ?>
                            </a>
                            <a  href="index.php?educacional/boletim_completo_print/<?php echo $matricula; ?>" target="_blank" class="btn btn-info btn-small" >
                                <i class="icon-align-justify"></i> <?php echo 'Boletim Completo'; ?>
                            </a>

                            <a  href="#" 	class="btn btn-info btn-small">
                                <i class="icon-money"></i> <?php echo 'situação_financeira'; ?>
                            </a>
                            <a  href="index.php?educacional/ficha_aluno_bolsa/<?php echo $matricula; ?>"  class="btn btn-info btn-small" >
                                <i class="icon-briefcase"></i> <?php echo 'bolsa_financiamento'; ?>
                            </a>
                        </td>
                    </tr>

                </table>

                <br>

                <div class="box-content padded">
                    <div class="tab-content">
                        <div class="tab-pane  active" id="list">
                            <div class="action-nav-normal">
                                <div class="box">
                                    <div class="box-content">
                                        <div id="dataTables">
                                            <table class="table table-hover" width="100%" style="border: 5px;" cellpadding="0" cellspacing="0" border="0" >
                                                <thead >
                                                    <tr>
                                                        <td><div>ID</div></td>
                                                        <td align="left"><div><?php echo 'Turma'; ?></div></td>
                                                        <td align="left"><div><?php echo 'Período_letivo'; ?></div></td>
                                                        <td align="left"><div><?php echo 'Período'; ?></div></td>
                                                        <td align="left"><div><?php echo 'turno'; ?></div></td>
                                                        <td align="left"><div><?php echo 'Bolsa(s)/Financiamento(s)'; ?></div></td>
                                                        <td align="left"><div><?php echo 'situação'; ?></div></td>
                                                        <td><div><?php echo 'opções'; ?></div></td>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT mat.matricula_aluno_turma_id as matricula_aluno_turma_id, t.turma_id, t.ano as ano, t.semestre as semestre,
                                                        mat.periodo as periodo_mat, t.periodo_letivo_id,tur_tx_descricao,tu.turno_id, mat.dependencia as dependencia,
                                                        tu.descricao as turno, p.periodo_id, p.periodo as periodo, 
                                                        pl.periodo_letivo as periodo_letivo,
                                                        mat.situacao_aluno_turma as situacao_aluno_turma
                                                        FROM matricula_aluno_turma mat
                                                    inner join matricula_aluno m on m.matricula_aluno_id = mat.matricula_aluno_id
                                                    inner join cadastro_aluno ca on ca.cadastro_aluno_id = m.cadastro_aluno_id
                                                    inner join turma t on t.turma_id = mat.turma_id
                                                    inner join cursos c on c.cursos_id = m.curso_id
                                                    inner join turno tu on tu.turno_id = t.turno_id
                                                    left join periodo p on p.periodo_id = t.periodo_id
                                                    left join periodo_letivo pl on pl.periodo_letivo_id = mat.periodo_letivo_id
                                                    where  m.matricula_aluno_id = '$matricula' and (mat.status != '11' or mat.status is null) order by matricula_aluno_turma_id desc ";
                                                    
                                                    $MatrizArray = $this->db->query($sql)->result_array();
                                                    $count = 1;
                                                    foreach ($MatrizArray as $row2):
                                                        $periodo_letivo = $row2['periodo_letivo'];
                                                        if ($periodo_letivo) {
                                                            $periodo_letivo = $row2['periodo_letivo'];
                                                        } else {
                                                            $periodo_letivo = $row2['ano'] . '/' . $row2['semestre'];
                                                        }
                                                        $periodo2 = $row2['periodo'];
                                                        if ($periodo2) {
                                                            $periodo_cursado = $row2['periodo'];
                                                        } else {
                                                            $periodo_cursado = $row2['periodo_mat'];
                                                        }
                                                        
                                                     
                                                        $matricula_aluno_turma_id = $row2['matricula_aluno_turma_id'];
                                                      
                                                        if($periodo2 == 1){
                                                            $periodo_cursado = 'I';
                                                        }else if($periodo2 == 2){
                                                            $periodo_cursado = 'II';
                                                        }else if($periodo2 == 3){
                                                            $periodo_cursado = 'III';
                                                        }else if($periodo2 == 4){
                                                            $periodo_cursado = 'IV';
                                                        }else if($periodo2 == 5){
                                                            $periodo_cursado = 'V';
                                                        }else if($periodo2 == 6){
                                                            $periodo_cursado = 'VI';
                                                        }else if($periodo2 == 7){
                                                            $periodo_cursado = 'VII';
                                                        }else if($periodo2 == 8){
                                                            $periodo_cursado = 'VIII';
                                                        }else if($periodo2 == 9){
                                                            $periodo_cursado = 'IX';
                                                        }else if($periodo2 == 10){
                                                            $periodo_cursado = 'X';
                                                        }
                                                        
                                                      
                                                        $situacao = $row2['situacao_aluno_turma'];
                                                        if ($situacao == '1') {
                                                            $situacao2 = 'Pré-Matriculado';
                                                        } else if ($situacao == '2') {
                                                            $situacao2 = 'Matriculado';
                                                        }else if ($situacao == '3') {
                                                            $situacao2 = 'Matricula Trancada';
                                                        }else if ($situacao == '4') {
                                                            $situacao2 = 'Desvinculado do curso';
                                                        }else if ($situacao == '5') {
                                                            $situacao2 = 'Transferido';
                                                        }else if ($situacao == '6') {
                                                            $situacao2 = 'Formado';
                                                        }else if ($situacao == '0') {
                                                            $situacao2 = 'período concluído';
                                                        }else if ($situacao == '7') {
                                                            $situacao2 = 'Falecido';
                                                        }
                                                        $dependencia = $row2['dependencia'];
                                                        if($dependencia == 1){
                                                            $dependencia_tx = '( Dependência )';
                                                        }else if(($dependencia == null)||($dependencia == "")){
                                                            $dependencia_tx = '';
                                                        }
                                                        //$sql.=" order by nome asc ";
                                                        ?>

                                                        <tr >
                                                            <td><?php echo $count++; ?></td>
                                                            <td align="left"><?php echo $row2['tur_tx_descricao']; ?></td>
                                                            <td align="left"><?php echo $periodo_letivo; ?></td>
                                                            <td align="left"><?php echo $periodo_cursado; ?></td>
                                                            <td align="left"><?php echo $row2['turno']; ?> </td>
                                                            <td align="left">
                                                                <?php
                                                                $query2 = "SELECT *, b.descricao as bolsa FROM bolsa_aluno ba
                                                                        inner join bolsa_periodo bp on bp.bolsa_periodo_id = ba.bolsa_periodo_id
                                                                        inner join bolsas b on b.bolsas_id = bp.bolsas_id
                                                                        inner join periodo_letivo pl on pl.periodo_letivo_id = bp.periodo_letivo_id
                                                                         inner join matricula_aluno_turma mat on mat.matricula_aluno_turma_id = ba.matricula_aluno_turma_id
                                                                                        inner join matricula_aluno m on m.matricula_aluno_id = mat.matricula_aluno_id
                                                                                        inner join cadastro_aluno ca on ca.cadastro_aluno_id = m.cadastro_aluno_id
                                                                                        inner join turma t on t.turma_id = mat.turma_id
                                                                                        inner join cursos c on c.cursos_id = m.curso_id
                                                                                        inner join turno tu on tu.turno_id = t.turno_id
                                                                                        left join periodo p on p.periodo_id = t.periodo_id
                                                                                        where ba.matricula_aluno_turma_id = $matricula_aluno_turma_id
                                                                        order by bolsa_aluno_id desc";
                                                                        // ECHO  $query2;
                                                                     $MatrizArrayt2 = $this->db->query($query2)->result_array();
                                                                      foreach ($MatrizArrayt2 as $row_turma2):
                                                                     $bolsa = $row_turma2['bolsa'];
                                                                     $periodo_letivo = $row_turma2['periodo_letivo'];
                                                                            $periodo_letivo_id = $row_turma2['periodo_letivo_id'];
                                                                            $bolsa_periodo_id = $row_turma2['bolsa_periodo_id'];
                                                                            $periodo = $row_turma2['periodo'];
                                                                            if ($periodo) {
                                                                                $periodo2 = $row_turma2['periodo'];
                                                                            } else {
                                                                                $periodo = $row_turma2['periodo_mat'];
                                                                            }

                                                                            if ($periodo2 == 1) {
                                                                                $periodo = 'I';
                                                                            } else if ($periodo2 == 2) {
                                                                                $periodo = 'II';
                                                                            } else if ($periodo2 == 3) {
                                                                                $periodo = 'III';
                                                                            } else if ($periodo2 == 4) {
                                                                                $periodo = 'IV';
                                                                            } else if ($periodo2 == 5) {
                                                                                $periodo = 'V';
                                                                            } else if ($periodo2 == 6) {
                                                                                $periodo = 'VI';
                                                                            } else if ($periodo2 == 7) {
                                                                                $periodo = 'VII';
                                                                            } else if ($periodo2 == 8) {
                                                                                $periodo = 'VIII';
                                                                            } else if ($periodo2 == 9) {
                                                                                $periodo = 'IX';
                                                                            } else if ($periodo2 == 10) {
                                                                                $periodo = 'X';
                                                                            }
                                                                            ?>
                                                                <table  >
                                                                    <tr>
                                                                    <td style="text-transform:uppercase;"><?php echo $bolsa; ?> <?php ' ' ?> <?php echo $row_turma2['porcentagem_bolsa']; ?>%</td>
                                                                    </tr>
                                                                </table>
                                                                
                                                                    <?php
                                                                    endforeach;
                                                                    ?>
                                                            </td>
                                                            <td align="left"><?php echo $situacao2; ?><font style="font-size: 9px; color: #DD1144;"><?php echo $dependencia_tx; ?></font></td>
                                                            <td align="center">
                                                            
                                                                <a  data-toggle="modal" href="#modal-form" onclick="modal('demonstrativo_nota', '<?php echo $row2['matricula_aluno_turma_id']; ?>')" 	class="btn btn-gray btn-small">
                                                                    <i class="icon-barcode"></i> <?php echo 'notas_faltas'; ?>
                                                                </a>
                                                                  <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?educacional/situacao_aluno/delete/<?php echo $matricula_aluno_turma_id; ?>/<?php echo $matricula; ?>')"
                                                                       class="btn btn-red btn-small">
                                                                        <i class="icon-trash"></i> <?php echo 'deletar'; ?>
                                                                  </a>
                                                               
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <?php
            endforeach;
            ?>    

            <!----TABLE LISTING ENDS--->



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
    
    function buscar_ficha_aluno(matricula) {
         var matricula_id = matricula;//$('#candidato_id').val(); 
         //se encontrou o estado
        if (matricula_id) {
            var url = 'index.php?educacional/carrega_ficha_aluno/' + matricula_id ;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#box').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }else{
            alert('Selecione um aluno');
        }
    }

    function buscar_turma() {
        var curso = $('#curso').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (curso) {
            var url = 'index.php?educacional/carrega_turma/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_turma').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

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

    function buscar_paginacao() {
        var aluno = $('#aluno').val();  //codigo do estado escolhido
        var curso = $('#curso').val();
        var turma = $('#turma').val();
        //se encontrou o estado
        if ((aluno) || (curso) || (turma)) {
            var url = 'index.php?educacional/carrega_table_paginacao/' + curso + '/' + turma + '/' + aluno;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_paginacao').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

    function buscar_deficiencia2() {
        var deficiencia2 = $('#deficiencia2').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (deficiencia2) {
            var url = 'index.php?educacional/carrega_doencas2/' + deficiencia2;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_doencas2').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }
</script>