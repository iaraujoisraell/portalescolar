<div id="box" class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo 'Ficha_aluno'; ?>
                </a></li>
            <?php
            foreach ($turma as $row):
                $matricula = $row['matricula_aluno_id'];
            endforeach;
            ?>
            <li >
                <a  href="index.php?educacional/situacao_aluno/<?php echo $matricula; ?>" 	>
                    <i class="icon-angle-left"></i> <?php echo 'voltar_para_situação_aluno'; ?>
                </a>
            </li>
            <li >
                <a  href="#" onclick="ShowHideDIV('botao_submit', 1); alert('Ficha Habilitada para Editar')"   >
                    <i class="icon-wrench"></i> <?php echo 'editar_Ficha_do_aluno'; ?>
                </a>
            </li>
        </ul>
        <!------CONTROL TABS END------->

    </div>
    
    <script language="JavaScript" type="text/javascript">

            function ShowHideDIV(NomeDIV, Valor){

              if (Valor == "1") 
              {
                document.getElementById(NomeDIV).style.display = "block";
            
              }
              else
              {
                document.getElementById(NomeDIV).style.display = "none";
               }
            }
            
          
    </script>

    <?php
    $sql = "SELECT *
                FROM matricula_aluno ma
                inner join cadastro_aluno ca on ca.cadastro_aluno_id = ma.cadastro_aluno_id
                inner join cursos cur on cur.cursos_id = ma.curso_id
                left join dados_censo_aluno dca on dca.cadastro_aluno_id = ca.cadastro_aluno_id
                where  ma.matricula_aluno_id = $matricula  ";
    //echo $sql;
    $MatrizArray = $this->db->query($sql)->result_array();

    $count = 1;

    foreach ($MatrizArray as $row):
        $matricula_aluno_id = $row['matricula_aluno_id'];
        $curso = $row['cur_tx_descricao'];
        if ($row['uf_nascimento']) {
            $uf_nascimento = $row['uf_nascimento'];
        } else {
            $uf_nascimento = 0;
        }

        if ($row['municipio_nascimento']) {
            $cidade_nascimento = $row['municipio_nascimento'];
        } else {
            $cidade_nascimento = 0;
        }
        
        if ($row['pais_origem']) {
            $pais_origem = $row['pais_origem'];
        } else {
            $pais_origem = 0;
        }

        /*** pais origem ***/
        $sql_pais_origem = "SELECT * FROM pais where codigo = '$pais_origem' ";
        $sqlpais_origem = $this->db->query($sql_pais_origem)->result_array();

        foreach ($sqlpais_origem as $row_po):
            $po_codigo = $row_po['codigo'];
            $po_nome = $row_po['nome'];
        endforeach;

        /*         * * UF nascimento** */
        $sql_uf_nascimento = "SELECT * FROM uf where codigo = $uf_nascimento ";
        $uf_nasc = $this->db->query($sql_uf_nascimento)->result_array();

        foreach ($uf_nasc as $row_uf):
            $uf_codigo = $row_uf['codigo'];
            $uf_nome = $row_uf['nome'];
        endforeach;

        /*         * * UF RG** */
        if ($row['rg_uf']) {
            $uf_rg = $row['rg_uf'];
        } else {
            $uf_rg = 0;
        }
        $sql_uf_rg = "SELECT * FROM uf where codigo = $uf_rg ";
        $uf_rg2 = $this->db->query($sql_uf_rg)->result_array();

        foreach ($uf_rg2 as $row_rg):
            $uf_rg_nome = $row_rg['nome'];
        endforeach;

        /*         * * UF TÍTULO** */
        if ($row['uf_titulo']) {
            $uf_titulo = $row['uf_titulo'];
        } else {
            $uf_titulo = 0;
        }
        $sql_uf_titulo = "SELECT * FROM uf where codigo = $uf_nascimento ";
        $uf_tit = $this->db->query($sql_uf_titulo)->result_array();

        foreach ($uf_tit as $row_tit):
            $uf_tit_nome = $row_tit['nome'];
        endforeach;

        /*         * * UF CERTIDÃO DE RESERVISTA** */
        if ($row['uf_cert_reservista']) {
            $uf_cert_reservista = $row['uf_cert_reservista'];
        } else {
            $uf_cert_reservista = 0;
        }
        $sql_uf_reservista = "SELECT * FROM uf where codigo = $uf_cert_reservista ";
        $uf_reservista = $this->db->query($sql_uf_reservista)->result_array();

        foreach ($uf_reservista as $row_reservista):
            $uf_reservista_nome = $row_reservista['nome'];
        endforeach;


        /*         * * UF ENDEREÇO - MORADIA** */
        if ($row['uf']) {
            $uf_endereco = $row['uf'];
        } else {
            $uf_endereco = 0;
        }
        $sql_uf_endereco = "SELECT * FROM uf where codigo = $uf_endereco ";
        $uf_end = $this->db->query($sql_uf_endereco)->result_array();

        foreach ($uf_end as $row_endereco):
            $uf_endereco_nome = $row_endereco['nome'];
        endforeach;


        /* município nascimento* */

        $sql = "SELECT * FROM municipio where codigo = $cidade_nascimento  ";
        $mun = $this->db->query($sql)->result_array();
        foreach ($mun as $row_mun):
            $mun_codigo = $row_mun['codigo'];
            $mun_nome = $row_mun['nome'];
        endforeach;

        $sexo = $row['sexo'];
        if ($sexo == '0') {
            $sexo_descricao = 'Masculino';
            $sexo_valor = '0';
        } else if ($sexo == '1') {
            $sexo_descricao = 'Feminino';
            $sexo_valor = '1';
        } else {
            $sexo_descricao = 'Não Informado';
        }


        $ec = $row['estado_civil'];
        if ($ec == '1') {
            $ec_descricao = 'Solteiro(a)';
        } else if ($ec == '2') {
            $ec_descricao = 'Casado(a)';
        } else if ($ec == '3') {
            $ec_descricao = 'Separado(a)/Divorciado(a)';
        } else if ($ec == '4') {
            $ec_descricao = 'Viuvo(a)';
        } else if ($ec == '5') {
            $ec_descricao = 'Outro';
        } else {
            $ec_descricao = 'Não Informado';
        }

        $nacionalidade = $row['nacionalidade'];
        if ($nacionalidade == '1') {
            $nacionalidade_tx = 'Brasileiro(a)';
        } else if ($nacionalidade == '2') {
            $nacionalidade_tx = 'Brasileiro(a) nascido no exterior ou naturalizado';
        } else if ($nacionalidade == '3') {
            $nacionalidade_tx = 'Estrangeiro';
        } else {
            $nacionalidade_tx = 'Não Informado';
        }

        $cor = $row['cor'];
        if ($cor == '1') {
            $cor_tx = 'Branca';
        } else if ($cor == '2') {
            $cor_tx = 'Preta';
        } else if ($cor == '3') {
            $cor_tx = 'Parda';
        } else if ($cor == '4') {
            $cor_tx = 'Amarela';
        } else if ($cor == '5') {
            $cor_tx = 'Não quis declarar';
        } else {
            $cor_tx = 'Não Informado';
        }

        $deficiencia = $row['aluno_deficiencia'];
        if ($deficiencia == '0') {
            $deficiencia_tx = 'Não';
        } else if ($deficiencia == '1') {
            $deficiencia_tx = 'sim';
        } else if ($deficiencia == '2') {
            $deficiencia_tx = 'Não Informado';
        } else {
            $deficiencia_tx = 'Não Informado';
        }

        $tipo_escola = $row['tipo_escola'];
        if ($tipo_escola == '0') {
            $tipo_escola_tx = 'PRIVADA';
        } else if ($tipo_escola == '1') {
            $tipo_escola_tx = 'PÚBLICA';
        } else if ($tipo_escola == '2') {
            $tipo_escola_tx = 'NÃO INFORMADO';
        } else {
            $tipo_escola_tx = 'NÃO INFORMADO';
        }

        $forma_ingresso = $row['forma_ingresso'];
        if ($forma_ingresso == '1') {
            $forma_ingresso_tx = 'VESTIBULAR';
        } else if ($forma_ingresso == '2') {
            $forma_ingresso_tx = 'ENEM';
        } else if ($forma_ingresso == '3') {
            $forma_ingresso_tx = 'AVALIAÇÃO SERIADA';
        } else if ($forma_ingresso == '4') {
            $forma_ingresso_tx = 'SELEÇÃO SIMPLIFICADA';
        } else if ($forma_ingresso == '5') {
            $forma_ingresso_tx = 'TRANSFERÊNCIA';
        } else if ($forma_ingresso == '6') {
            $forma_ingresso_tx = 'DECISÃO JUDICIAL';
        } else if ($forma_ingresso == '7') {
            $forma_ingresso_tx = 'VAGAS REMANESCENTE';
        } else if ($forma_ingresso == '8') {
            $forma_ingresso_tx = 'PROGRAMAS ESPECIAIS';
        } else {
            $forma_ingresso_tx = 'NÃO INFORMADO';
        }
        /*
         *  
         * 
          if ($opcao1 == '1') {
          $opcao1_tx = 'CIÊNCIAS TEOLÓGICAS';
          $opcao1_valor = '0000001';
          } else if ($opcao1 == '2') {
          $opcao1_tx = 'PEDAGOGIA';
          $opcao1_valor = '0000004';
          } else if ($opcao1 == '3') {
          $opcao1_tx = 'ADMINISTRAÇÃO';
          $opcao1_valor = '0000003';
          } else if ($opcao1 == '4') {
          $opcao1_tx = 'COMUNICAÇÃO SOCIAL: JORNALISMO';
          $opcao1_valor = '0000002';
          } else if ($opcao1 == '5') {
          $opcao1_tx = 'PUBLICIDADE E PROPAGANDA';
          $opcao1_valor = '0000009';
          }


          if ($turno1 == '1') {
          $turno1_tx = 'MAT';
          } else if ($turno1 == '3') {
          $turno1_tx = 'NOT';
          }
         */

        $se1 = $row['SE_txIrmaos'];
        if ($se1 == '1') {
            $se1_descricao = 'Nenhum';
        } else if ($se1 == '2') {
            $se1_descricao = 'Um';
        } else if ($se1 == '3') {
            $se1_descricao = 'Dois';
        } else if ($se1 == '4') {
            $se1_descricao = 'Três';
        } else if ($se1 == '5') {
            $se1_descricao = 'Quatro ou Mais';
        }

        $se2 = $row['SE_txFilhos'];
        if ($se2 == '1') {
            $se2_descricao = 'Nenhum';
        } else if ($se2 == '2') {
            $se2_descricao = 'Um';
        } else if ($se2 == '3') {
            $se2_descricao = 'Dois';
        } else if ($se2 == '4') {
            $se2_descricao = 'Três';
        } else if ($se2 == '5') {
            $se2_descricao = 'Quatro ou Mais';
        }

        // $se3 = $row['can_tx_se_etnia'];
        $se4 = $row['SE_txReside'];
        if ($se4 == '1') {
            $se4_descricao = 'Com pais e(ou) parentes';
        } else if ($se4 == '2') {
            $se4_descricao = 'Esposo(a) e(ou) com os filho(s)';
        } else if ($se4 == '3') {
            $se4_descricao = 'Com amigos(compartilhando despesas ou de favor)';
        } else if ($se4 == '4') {
            $se4_descricao = 'Com colegas, em alojamento universit&aacute;rio';
        } else if ($se4 == '5') {
            $se4_descricao = 'Sozinho(a)';
        }

        $se5 = $row['SE_txRenda'];
        if ($se5 == '1') {
            $se5_descricao = 'At&eacute; 3 sal&aacute;rios m&iacute;nimos';
        } else if ($se5 == '2') {
            $se5_descricao = 'Mais de 3 At&eacute; 10 sal&aacute;rios m&iacute;nimos';
        } else if ($se5 == '3') {
            $se5_descricao = 'Mais de 10 At&eacute; 20 sal&aacute;rios m&iacute;nimos';
        } else if ($se5 == '4') {
            $se5_descricao = 'Mais de 20 At&eacute; 30 sal&aacute;rios m&iacute;nimos';
        } else if ($se5 == '5') {
            $se5_descricao = 'Mais de 30 sal&aacute;rios m&iacute;nimos';
        }



        $se6 = $row['SE_txMembros'];
        if ($se6 == '1') {
            $se6_descricao = 'Nenhum';
        } else if ($se6 == '2') {
            $se6_descricao = 'Um ou dois';
        } else if ($se6 == '3') {
            $se6_descricao = 'Tr&ecirc;s ou quatro';
        } else if ($se6 == '4') {
            $se6_descricao = 'Cinco ou seis';
        } else if ($se6 == '5') {
            $se6_descricao = 'Mais de seis';
        }

        $se7 = $row['SE_txTrabalho'];
        if ($se7 == '1') {
            $se7_descricao = 'N&atilde;o trabalho e meus gastos s&atilde;o financiados pela fam&iacute;lia';
        } else if ($se7 == '2') {
            $se7_descricao = 'Trabalho e recebo ajuda da fam&iacute;lia';
        } else if ($se7 == '3') {
            $se7_descricao = 'Trabalho e me sustento';
        } else if ($se7 == '4') {
            $se7_descricao = 'Trabalho e contribuo com o sustento da fam&iacute;lia';
        } else if ($se7 == '5') {
            $se7_descricao = 'Trabalho e sou o principal respons&aacute;vel pelo sustento da fam&iacute;lia';
        }

        $se8 = $row['SE_txBolsa'];
        if ($se8 == '1') {
            $se8_descricao = 'Financiamento Estudantil';
        } else if ($se8 == '2') {
            $se8_descricao = 'Prouni integral';
        } else if ($se8 == '3') {
            $se8_descricao = 'Prouni parcial';
        } else if ($se8 == '4') {
            $se8_descricao = 'Bolsa integral ou pacial oferecida pela propria institui&ccedil;&atilde;o';
        } else if ($se8 == '5') {
            $se8_descricao = 'Bolsa integral ou parcial oferecida porentidadesexternas';
        } else if ($se8 == '6') {
            $se8_descricao = 'Outro(s)';
        } else if ($se8 == '7') {
            $se8_descricao = 'Nenhum';
        }
        ?>


        <div class="tab-pane box" id="add" style="padding: 5px">


            <div class="box-content">


                <?php echo form_open('educacional/ficha_aluno/do_update/'.$matricula, array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                <div class="padded">
                    <div style="width: 400px; margin: auto;">

                        <b><font style="color: #000000; font-size: 24px;">FICHA DE CADASTRO DO ALUNO</font></b>
                        <hr/>
                    </div>

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
                    <input type="hidden" value="<?php echo $matricula; ?>" name="matricula_aluno_id">
                    <input type="hidden" value="<?php echo $cadastro_aluno; ?>" name="cadastro_aluno_id">
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
                        <?php
                    endforeach;
                    ?>
                    <ul style="background-color: threedhighlight; margin-top: 15px;" class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#dadospessoais"><font style="color: #0044cc">DADOS PESSOAIS</font></a></li>
                        <li><a data-toggle="tab" href="#menu1"><font style="color: #0044cc">DOCUMENTAÇÃO</font></a></li>
                        <li><a data-toggle="tab" href="#menu3"><font style="color: #0044cc">ENDEREÇO</font></a></li>
                        <li><a data-toggle="tab" href="#menu5"><font style="color: #0044cc">INFORMAÇÕES</font></a></li>
                        <li><a data-toggle="tab" href="#menu2"><font style="color: #0044cc">SOCIOECONOMICO</font></a></li>
                        <li><a data-toggle="tab" href="#menu6"><font style="color: #0044cc">RESPONSÁVEL</font></a></li>
                        <li><a data-toggle="tab" href="#menu7"><font style="color: #0044cc">OBSERVAÇÕES </font></a></li>
                    </ul>

                    <div  class="tab-content">
                        <div style="margin-left: 15px;" id="dadospessoais" class="tab-pane fade in active">
                                <table width="100%" >
                                <tbody>
                                    <tr>
                                        <td >
                                                <div class="control-group">
                                                    <label style="font-weight: bold " class="control-label"><?php echo 'Forma_ingresso'; ?></label>
                                                    <div class="controls">
                                                        <select  style="width: 180px;" name="forma_ingresso" id="forma_ingresso" >
                                                            <option value="<?php echo $forma_ingresso; ?>"><?php echo $forma_ingresso2; ?></option>
                                                            <option value="1">VESTIBULAR</option>
                                                            <option value="2">ENEM</option>
                                                            <option value="3">AVALIAÇÃO SERIADA</option>
                                                            <option value="4">SELEÇÃO SIMPLIFICADA</option>
                                                            <option value="5">TRANSFERÊNCIA</option>
                                                            <option value="6">DECISÃO JUDICIAL</option>
                                                            <option value="7">VAGAS REMANESCENTE</option>
                                                            <option value="8">PROGRAMAS ESPECIAIS</option>
                                                        </select>


                                                    </div>
                                                </div>
                                            </td>
                                            <td width="20%">
                                                    <div class="control-group">
                                                        <label style="font-weight: bold " class="control-label"><?php echo 'Bolsista?'; ?></label>
                                                        <div class="controls">

                                                            <select style="width: 80px; " name="bolsista" id="bolsista" >
                                                                <option value="<?php echo $bolsista; ?>"><?php echo $bolsista2; ?></option>
                                                                <option value="0">NÃO</option>
                                                                <option value="1">SIM</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                           
                                                </td>
                                                <td>
                                                    <div class="control-group">
                                                        <label style="font-weight: bold " class="control-label"><?php echo 'Desperiodizado?'; ?></label>
                                                        <div class="controls">

                                                            <select style="width: 80px; " name="desperiodizado" id="desperiodizado" >
                                                                <option value="<?php echo $desperiodizado; ?>"><?php echo $desperiodizado2; ?></option>
                                                                <option value="0">NÃO</option>
                                                                <option value="1">SIM</option>

                                                            </select>
                                                        </div>
                                                    </div>   
                                                </td>
                                    </tr>
                                    </tbody>
                            </table>
                            <table width="100%" >
                                <tbody>
                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'Nome'; ?></label>
                                                <div class="controls">
                                                    <input type="text"  class="validate[required]" minlength="8" onkeypress="this.value.toUpperCase();" value="<?php echo $row['nome']; ?>" id="nome" name="nome"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'data_nascimento'; ?></label>
                                                <div class="controls">
                                                    <input type="text"  class="validate[required]" minlength="10" onkeypress="mascara(this, '##/##/####')" value="<?php echo date($row['data_nascimento']); ?>" maxlength="10" id="data_nascimento"  name="data_nascimento"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'pais_origem'; ?></label>
                                                <div class="controls">
                                                    <select required name="pais_origem">
                                                    <option value="<?php echo $po_codigo; ?>"><?php echo $po_nome; ?> </option>
                                                    <option value="BRA">Brasil </option>
                                                    <?php
                                                    foreach ($pais as $row_pais):
                                                        ?>
                                                        <option value="<?php echo $row_pais['codigo']; ?>"><?php echo $row_pais['nome']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?> 
                                                </select>
                                                </div>

                                            </div>
                                        </td>

                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'UF_nascimento'; ?></label>
                                                <div class="controls">
                                                    <select required name="uf_nascimento" id="uf_nascimento" onchange="buscar_municipio()">
                                                    <option value="<?php echo $uf_codigo; ?>"><?php echo $uf_nome; ?></option>
                                                    <?php
                                                    foreach ($uf as $row_uf):
                                                        ?>
                                                        <option value="<?php echo $row_uf['codigo']; ?>"><?php echo $row_uf['nome']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?> 
                                                </select>
                                                    </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'cidade_origem'; ?></label>
                                                <div class="controls">
                                                    <div  id="load_muncipio_ficha_aluno">
                                                    <select required name="cidade_origem">
                                                        <option value="<?php echo $mun_codigo; ?>"><?php echo $mun_nome; ?></option>
                                                    </select>
                                                </div>
                                                 

                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'sexo'; ?></label>

                                                <div class="controls">
                                                    <select required name="sexo">
                                                        <option value="<?php echo $sexo; ?>"><?php echo $sexo_descricao; ?></option>
                                                    <option value="0">Masculino</option>
                                                    <option value="1">Feminino</option>

                                                </select>
                                                  </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'estado_civil'; ?></label>

                                                <div class="controls">
                                                    <select required name="estado_civil">
                                                        <option value="<?php echo $ec; ?>"><?php echo $ec_descricao; ?></option>
                                                    <option value="1">Solteiro(a)</option>
                                                    <option value="2">Casado(a)</option>
                                                    <option value="3">Divorciado(a)</option>
                                                    <option value="4">Viuvo(a)</option>
                                                    <option value="5">Outro</option>
                                                </select>
                                                </div>
                                            </div>
                                        </td>
                                </tbody>
                            </table>
                        </div>
                        <div style="margin-left: 15px;" id="menu1" class="tab-pane fade">
                            <table width="100%" >
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'cpf'; ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" minlength="12" onkeypress="mascara(this, '#########-##')" value="<?php echo $row['cpf']; ?>" maxlength="12" id="cpf" name="cpf"/>

                                                </div>
                                            </div>
                                        </td>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'RG'; ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" value="<?php echo $row['rg']; ?>" name="rg"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>


                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'RG_UF'; ?></label>
                                                <div class="controls" id="load_matriz">
                                                    <select required name="rg_uf" id="rg_uf" >
                                                        <option value="<?php echo $uf_rg; ?>"><?php echo $uf_rg_nome; ?></option>
                                                        <?php
                                                    foreach ($uf as $row_uf):
                                                        ?>
                                                        <option value="<?php echo $row_uf['codigo']; ?>"><?php echo $row_uf['nome']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?> 
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'RG_orgão_expeditor'; ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" value="<?php echo $row['rg_orgao_expeditor']; ?>" name="rg_orgao_expeditor"/>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'titulo'; ?></label>

                                                <div class="controls">

                                                    <div class="controls">
                                                        <input type="text" value="<?php echo $row['titulo']; ?>" name="titulo"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'uf_titulo'; ?></label>

                                                <div class="controls">
                                                    <select required name="uf_titulo" id="uf_titulo" >
                                                        <option value="<?php echo $uf_titulo; ?>"><?php echo $uf_tit_nome; ?></option>
                                                         <?php
                                                    foreach ($uf as $row_uf):
                                                        ?>
                                                        <option value="<?php echo $row_uf['codigo']; ?>"><?php echo $row_uf['nome']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?> 
                                                    </select>

                                                </div>

                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'documento_estrangeiro'; ?></label>

                                                <div class="controls">
                                                    <input type="text" value="<?php echo $row['documento_estrangeiro']; ?>" name="documento_estrangeiro"/>
                                                </div>

                                            </div>
                                        </td>

                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'certidão_reservista'; ?></label>

                                                <div class="controls">

                                                    <div class="controls">
                                                        <input type="text" value="<?php echo $row['cert_reservista']; ?>"  name="certidao_reservista"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'uf_certidão_reservista'; ?></label>

                                                <div class="controls">

                                                    <div class="controls">
                                                        <select name="uf_certidao" id="uf_certidao" >
                                                          <option value="<?php echo $uf_cert_reservista; ?>"><?php echo $uf_reservista_nome; ?></option>
                                                             <?php
                                                    foreach ($uf as $row_uf):
                                                        ?>
                                                        <option value="<?php echo $row_uf['codigo']; ?>"><?php echo $row_uf['nome']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?> 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>                       
                        <div style="margin-left: 15px;" id="menu3" class="tab-pane fade">
                            <table width="100%" class="responsive">
                                <tbody>
                                    <tr>
                                            <td>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo 'cep'; ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="validate[required]" minlength="9" onkeypress="mascara(this, '#####-###')" value="<?php echo $row['cep']; ?>" maxlength="9" id="cep" name="cep"/>
                                                    </div>
                                                </div>
                                            </td>
                                            <td >
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo 'endereco'; ?></label>

                                                    <div class="controls">
                                                        <input type="text"  class="validate[required]" value="<?php echo $row['endereco']; ?>" minlength="8" onkeypress="this.value.toUpperCase();" name="endereco"/>
                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                <tr>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'bairro'; ?></label>
                                            <div class="controls">
                                                <input type="text"  class="validate[required]" value="<?php echo $row['bairro']; ?>" minlength="5" onkeypress="this.value.toUpperCase();" name="bairro"/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'UF'; ?></label>
                                            <div class="controls">
                                                <div class="controls">
                                                    <select required name="uf" id="uf" onchange="buscar_municipio_endereco()">
                                                        <option value="<?php echo $uf_endereco; ?>"><?php echo $uf_endereco_nome; ?></option>
                                                         <?php
                                                    foreach ($uf as $row_uf):
                                                        ?>
                                                        <option value="<?php echo $row_uf['codigo']; ?>"><?php echo $row_uf['nome']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?> 
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'cidade'; ?></label>
                                                <div class="controls">
                                                <div  id="load_muncipio_ficha_aluno_endereco">
                                                            <select>
                                                                <option value="1302603">Manaus</option>
                                                            </select>
                                                    </div>
                                               </div>
                                        </div>
                                    </td>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'complemento'; ?></label>

                                            <div class="controls">
                                                <input type="text" onkeypress="this.value.toUpperCase();" value="<?php echo $row['compemento']; ?>" name="complemento"/>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="margin-left: 15px;" id="menu5" class="tab-pane fade">
                            <table width="100%" class="responsive">
                                <tbody>

                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'nacionalidade'; ?></label>

                                                <div class="controls">
                                                    <select required name="nacionalidade">

                                                        <option value="<?php echo $nacionalidade; ?>"><?php echo $nacionalidade_tx; ?></option>
                                                        <option value="1">Brasileiro(a)</option>
                                                    <option value="2">Brasileiro(a) nascido no exterior ou naturalizado</option>
                                                    <option value="3">Extrangeiro</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'cor/raça'; ?></label>

                                                <div class="controls">
                                                    <div class="controls">
                                                        <select required name="cor">
                                                            <option value="<?php echo $cor; ?>"><?php echo $cor_tx; ?></option>
                                                            <option value="1">Branca</option>
                                                        <option value="2">Preta</option>
                                                        <option value="3">Parda</option>
                                                        <option value="4">Amarela</option>
                                                        <option value="5">Indígena</option>
                                                        <option value="0">Não quis declarar</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>



                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'mae'; ?></label>

                                                <div class="controls">
                                                    <input type="text" class="validate[required]" minlength="8" value="<?php echo $row['mae']; ?>" onkeypress="this.value.toUpperCase();" name="mae"/>
                                                </div>

                                            </div>
                                        </td>

                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'pai'; ?></label>

                                                <div class="controls">

                                                    <div class="controls">
                                                        <input type="text" value="<?php echo $row['pai']; ?>"  onkeypress="this.value.toUpperCase();" name="pai"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'conjuge'; ?></label>
                                                <div class="controls">
                                                    <input type="text" value="<?php echo $row['conjuge']; ?>"  style="text-transform:uppercase;" name="conjuge"/>
                                                </div>
                                            </div>
                                        </td>

                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'Tem Alguma Deficiência?'; ?></label>

                                                <div class="controls">
                                                    <select required name="deficiencia" id="deficiencia" onchange="buscar_deficiencia_ficha_aluno()">
                                                        <option value="<?php echo $deficiencia; ?>"><?php echo $deficiencia_tx; ?></option>
                                                         <option value="0">NÃO</option>
                                                    <option value="1">SIM</option>
                                                    <option value="2">NÃO INFORMADO</option>
                                                    </select>

                                                </div>

                                            </div>
                                        </td>


                                    </tr>
                                    
                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'Tipo de escola que concluiu o Ens. Médio'; ?></label>

                                                <div class="controls">
                                                    <select required name="tipo_escola" id="tipo_escola" >
                                                        <option value="<?php echo $tipo_escola; ?>"><?php echo $tipo_escola_tx; ?></option>
                                                        <option value="0">PRIVADO</option>
                                                    <option value="1">PUBLICO</option>
                                                    <option value="2">NÃO DISPÕE DA INFORMAÇÃO</option>
                                                    </select>

                                                </div>

                                            </div>
                                        </td>

                                        <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'email'; ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="email" minlength="10" value="<?php echo $row['email']; ?>" name="email"/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    </tr>

                                </tbody>
                            </table>

                            <div  id="load_doencas_ficha_aluno">

                            </div>
                            <table width="100%" class="responsive">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'fone'; ?></label>
                                                <div class="controls">
                                                    <input type="text" value="<?php echo $row['fone']; ?>" onkeypress="mascara(this, '#####-####')" maxlength="10"  id="fone" name="fone"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'celular'; ?></label>
                                                <div class="controls">
                                                    <input type="text" value="<?php echo $row['celular']; ?>" onkeypress="mascara(this, '#####-####')" maxlength="10"  id="celular" name="celular"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                        <div style="margin-left: 15px;" id="menu2" class="tab-pane fade">
                            <table width="100%" class="responsive">
                                <tbody>
                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'Quantos_irmãos_você_tem? '; ?></label>
                                                <div class="controls">
                                                    <div class="controls">
                                                        <SELECT   NAME="SE_txIrmaos">
                                                            <OPTION value="<?php echo $se1; ?>" ><?php echo $se1_descricao; ?></OPTION>
                                                            <OPTION value="1" >Nenhum</OPTION>
                                                        <OPTION value="2">Um</OPTION>
                                                        <OPTION value="3">Dois</OPTION>
                                                        <OPTION value="4">Tr&ecirc;s</OPTION>
                                                        <OPTION value="5">Quatro ou Mais</OPTION>
                                                        </SELECT>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'Quantos filhos voc&ecirc; tem?'; ?></label>

                                                <div class="controls">
                                                    <div class="controls">
                                                        <div class="controls">
                                                            <SELECT   NAME="SE_txFilhos">
                                                                <OPTION value="<?php echo $se2; ?>" ><?php echo $se2_descricao; ?></OPTION>
                                                            <OPTION value="1" >Nenhum</OPTION>
                                                            <OPTION value="2">Um</OPTION>
                                                            <OPTION value="3">Dois</OPTION>
                                                            <OPTION value="4">Tr&ecirc;s</OPTION>
                                                            <OPTION value="5">Quatro ou Mais</OPTION>
                                                            </SELECT>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'voc&ecirc; mora com quem?'; ?></label>
                                                <div class="controls">
                                                    <div class="controls">
                                                        <SELECT   NAME="SE_txReside">
                                                            <OPTION value="<?php echo $se4; ?>" ><?php echo $se4_descricao; ?></OPTION>
                                                            <OPTION value="1" >Com pais e(ou) parentes</OPTION>
                                                        <OPTION value="2">Esposo(a) e(ou) com os filho(s)</OPTION>
                                                        <OPTION value="3">Com amigos(compartilhando despesas ou de favor)</OPTION>
                                                        <OPTION value="4">Com colegas, em alojamento universit&aacute;rio</OPTION>
                                                        <OPTION value="5">Sozinho(a)</OPTION>
                                                        </SELECT>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'Faixa de renda mensal? '; ?></label>
                                                <div class="controls">
                                                    <div class="controls">
                                                        <SELECT   NAME="SE_txRenda">
                                                        <OPTION value="<?php echo $se5; ?>" ><?php echo $se5_descricao; ?></OPTION>
                                                        <OPTION value="1" >At&eacute; 3 sal&aacute;rios m&iacute;nimos</OPTION>
                                                        <OPTION value="2">Mais de 3 At&eacute; 10 sal&aacute;rios m&iacute;nimos</OPTION>
                                                        <OPTION value="3">Mais de 10 At&eacute; 20 sal&aacute;rios m&iacute;nimos</OPTION>
                                                        <OPTION value="4">Mais de 20 At&eacute; 30 sal&aacute;rios m&iacute;nimos</OPTION>
                                                        <OPTION value="5">Mais de 30 sal&aacute;rios m&iacute;nimos</OPTION>
                                                        </SELECT>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'Quantas pessoas moram com voc&ecirc;?'; ?></label>
                                                <div class="controls">
                                                    <div class="controls">
                                                        <SELECT   NAME="SE_txMembros">
                                                            <OPTION value="<?php echo $se6; ?>" ><?php echo $se6_descricao; ?></OPTION>
                                                            <OPTION value="1" >Nenhuma</OPTION>
                                                        <OPTION value="2">Um ou dois</OPTION>
                                                        <OPTION value="3">Tr&ecirc;s ou quatro</OPTION>
                                                        <OPTION value="4">Cinco ou seis</OPTION>
                                                        <OPTION value="5">Mais de seis</OPTION>
                                                        </SELECT>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'Qual situa&ccedil;&atilde;o descreve seu caso?'; ?></label>

                                                <div class="controls">

                                                    <div class="controls">
                                                        <SELECT  NAME="SE_txTrabalho">
                                                            <OPTION value="<?php echo $se7; ?>" ><?php echo $se7_descricao; ?></OPTION>
                                                            <OPTION value="1" >N&atilde;o trabalho e meus gastos s&atilde;o financiados pela fam&iacute;lia</OPTION>
                                                        <OPTION value="2">Trabalho e recebo ajuda da fam&iacute;lia</OPTION>
                                                        <OPTION value="3">Trabalho e me sustento</OPTION>
                                                        <OPTION value="4">Trabalho e contribuo com o sustento da fam&iacute;lia</OPTION>
                                                        <OPTION value="5">Trabalho e sou o principal respons&aacute;vel pelo sustento da fam&iacute;lia</OPTION>
                                                        </SELECT>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                            </table>
                                <table width="100%" class="responsive">
                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'Você tem bolsa ou financiamento estudantil?'; ?></label>
                                            <div class="controls">
                                                <div class="controls">
                                                    <SELECT   NAME="SE_txBolsa">
                                                        <OPTION value="<?php echo $se8; ?>" ><?php echo $se8_descricao; ?></OPTION>
                                                        <OPTION value="1" >Financiamento Estudantil</OPTION>
                                                        <OPTION value="2">Prouni integral</OPTION>
                                                        <OPTION value="3">Prouni parcial</OPTION>
                                                        <OPTION value="4">Bolsa integral ou pacial oferecida pela propria institui&ccedil;&atilde;o</OPTION>
                                                        <OPTION value="5">Bolsa integral ou parcial oferecida porentidadesexternas</OPTION>
                                                        <OPTION value="6">Outro(s)</OPTION>
                                                        <OPTION value="7">Nenhum</OPTION>
                                                    </SELECT>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="margin-left: 15px;" id="menu6" class="tab-pane fade">
                            <table width="100%" class="responsive">
                                <tbody>


                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'responsavel'; ?></label>

                                                <div class="controls">
                                                    <input type="text" value="<?php echo $row['responsavel']; ?>" name="responsavel"/>
                                                </div>

                                            </div>
                                        </td>

                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'fone_responsavel'; ?></label>

                                                <div class="controls">

                                                    <div class="controls">
                                                        <input type="text"  value="<?php echo $row['fone_responsavel']; ?>" name="fone_responsavel"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'RG_responsavel'; ?></label>

                                                <div class="controls">
                                                    <input type="text"  value="<?php echo $row['rg_responsavel']; ?>" name="rg_responsavel"/>
                                                </div>

                                            </div>
                                        </td>

                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'CPF_responsável'; ?></label>

                                                <div class="controls">

                                                    <div class="controls">
                                                        <input type="text"  value="<?php echo $row['cpf_responsavel']; ?>" name="cpf_responsavel"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'celular_responsável'; ?></label>

                                                <div class="controls">
                                                    <input type="text" value="<?php echo $row['cel_responsavel']; ?>" name="celular_responsavel"/>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="margin-left: 15px;" id="menu7" class="tab-pane fade">
                            <table width="100%" class="responsive">
                                <tbody>

                                    <tr>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'OBSERVAÇÕES'; ?></label>

                                                <div class="controls">

                                                    <div class="controls">
                                                        <textarea name="obs_documento" style="width: 62%; height: 120px;"><?php echo $row['observacao']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="botao_submit" style="display: none">
                <div class="form-actions">
                  <button type="submit" class="btn btn-gray"><?php echo 'Editar Ficha do aluno'; ?></button>
                  </div>
                 </div> 
                 
                </form>                
            </div>                
        </div>


        <?php
    endforeach;
    ?>
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

  function buscar_municipio() {
        var uf = $('#uf_nascimento').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (uf) {
            var url = 'index.php?educacional/carrega_municipio_ficha_aluno/' + uf;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_muncipio_ficha_aluno').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }
        function buscar_deficiencia_ficha_aluno() {
        var deficiencia = $('#deficiencia').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (deficiencia) {
            var url = 'index.php?educacional/carrega_doencas/' + deficiencia;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_doencas_ficha_aluno').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }
    function buscar_municipio_endereco() {
        var uf = $('#uf').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (uf) {
            var url = 'index.php?educacional/carrega_municipio_ficha_aluno_endereco/' + uf;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_muncipio_ficha_aluno_endereco').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }
    
    function buscar_ficha_aluno(matricula) {
        var matricula_id = matricula;//$('#candidato_id').val(); 
        //se encontrou o estado
        if (matricula_id) {
            var url = 'index.php?educacional/carrega_ficha_aluno/' + matricula_id;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#box').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        } else {
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