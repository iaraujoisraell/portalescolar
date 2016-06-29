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
<script language='JavaScript'>
function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  return false;
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

      
        ?>


        <div class="tab-pane box" id="add" style="padding: 5px">


            <div class="box-content">


                <?php echo form_open('educacional/ficha_aluno_bolsa/do_create/'.$matricula, array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                <div class="padded">
                    <div style="width: 500px; margin: auto;">

                        <b><font style="color: #000000; font-size: 20px;">BOLSA(S) E FINANCIAMENTO(S)</font></b>
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
                    <input type="hidden" value="<?php echo $matricula; ?>" name="matricula_aluno_id" id="matricula_aluno_id">
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
                        <li class="active"><a data-toggle="tab" href="#dadospessoais"><font style="color: #0044cc">Novo Cadastro</font></a></li>
                   
                    </ul>

                    <div  class="tab-content">
                        <div style="margin-left: 15px;" id="dadospessoais" class="tab-pane fade in active">
                                <table width="100%" >
                                <tbody>
                                    <tr>
                                        <td >
                                                <div class="control-group">
                                                   <label class="control-label"><?php echo 'periodo_letivo'; ?></label>
                                                <div class="controls">
                                                    <?php
                                                    $query_pl = "SELECT mat.matricula_aluno_turma_id as matricula_aluno_turma_id, t.turma_id, t.ano as ano, t.semestre as semestre,
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
                                                    where  m.matricula_aluno_id = '$matricula' and (mat.status != '11' or mat.status is null) and pl.atual = 1 order by matricula_aluno_turma_id desc";
                                                    $Matrizpl = $this->db->query($query_pl)->result_array();
                                                    
                                                    ?>
                                                    <select required style="width: 350px;" name="matricula_aluno_turma_id_bolsa" id="matricula_aluno_turma_id_bolsa" >
                                                            <?php
                                                            foreach ($Matrizpl as $row_curso):
                                                                $periodo_letivo = $row_curso['periodo_letivo'];
                                                        if ($periodo_letivo) {
                                                            $periodo_letivo = $row_curso['periodo_letivo'];
                                                        } else {
                                                            $periodo_letivo = $row_curso['ano'] . '/' . $row_curso['semestre'];
                                                        }
                                                        $periodo = $row_curso['periodo'];
                                                        if ($periodo) {
                                                            $periodo2 = $row_curso['periodo'];
                                                        } else {
                                                            $periodo = $row_curso['periodo_mat'];
                                                        }
                                                        $matricula_aluno_turma_id = $row_curso['matricula_aluno_turma_id'];
                                                        if($periodo2 == 1){
                                                            $periodo = 'I';
                                                        }else if($periodo2 == 2){
                                                            $periodo = 'II';
                                                        }else if($periodo2 == 3){
                                                            $periodo = 'III';
                                                        }else if($periodo2 == 4){
                                                            $periodo = 'IV';
                                                        }else if($periodo2 == 5){
                                                            $periodo = 'V';
                                                        }else if($periodo2 == 6){
                                                            $periodo = 'VI';
                                                        }else if($periodo2 == 7){
                                                            $periodo = 'VII';
                                                        }else if($periodo2 == 8){
                                                            $periodo = 'VIII';
                                                        }else if($periodo2 == 9){
                                                            $periodo = 'IX';
                                                        }else if($periodo2 == 10){
                                                            $periodo = 'X';
                                                        }
                                                                ?>
                                                                <option value="<?php echo $matricula_aluno_turma_id; ?>">Turma: <?php echo $row_curso['tur_tx_descricao']; ?> <?php echo ' ('; ?> <?php echo $periodo_letivo; ?><?php echo ')'; ?> <?php echo $periodo; ?> <?php echo ' - '; ?> <?php echo $row_curso['turno']; ?></option>
                                                                <?php
                                                            endforeach;
                                                            ?>                                                
                                                        </select>
                                                  </div>
                                                </div>
                                            </td>
                                            <td >
                                                    <div class="control-group">
                                                        <label class="control-label"><?php echo 'Bolsas'; ?></label>
                                                <div class="controls">
                                                    <?php
                                                    $query_pl = "SELECT * FROM bolsas b
                                                                inner join bolsa_periodo bp on bp.bolsas_id = b.bolsas_id
                                                                inner join periodo_letivo pl on pl.periodo_letivo_id = bp.periodo_letivo_id
                                                                where pl.atual = 1
                                                                order by descricao asc";
                                                    $Matrizpl = $this->db->query($query_pl)->result_array();
                                                    ?>
                                                        <select required style="width: 300px;" name="bolsas_periodo_vinculo" id="bolsas_periodo_vinculo" >
                                                            <?php
                                                            foreach ($Matrizpl as $row_curso):
                                                                $porcent_minimo = $row_curso['porcentagem_minima'];
                                                                $porcent_maximo = $row_curso['porcentagem_maximo'];
                                                                ?>
                                                                <option value="<?php echo $row_curso['bolsa_periodo_id']; ?>"><?php echo $row_curso['descricao']; ?> (<?php echo $row_curso['porcentagem_minima']; ?>% a <?php echo $row_curso['porcentagem_maxima']; ?>%)</option>
                                                                <?php
                                                            endforeach;
                                                            ?>                                                
                                                        </select>
                                                  </div>
                                                    </div>
                                                           
                                                </td>
                                                <td>
                                                    <div class="control-group">
                                                        <label class="control-label"><?php echo 'Porcentagem '; ?></label>
                                                <div class="controls">
                                                    <?php
                                                    //$query_pl = "SELECT * FROM bolsas order by descricao asc";
                                                    //$Matrizpl = $this->db->query($query_pl)->result_array();
                                                    ?>
                                                    <input style="width: 50px; height: 30px;" onkeypress="return SomenteNumero(event);" type="text" class="validate[required]" maxlength="3" minlength="1" name="porcentagem" id='porcentagem'><font style="margin-left: 5px; font-size: 18px;">%</font> 
                                                  </div>
                                                    </div>   
                                                </td>
                                    </tr>
                                    </tbody>
                            </table>
                         
                    </div>
                </div>
               
                <div class="form-actions">
                  <button type="submit" class="btn btn-gray"><?php echo 'Cadastrar bolsa '; ?></button>
                  </div>
                
                 
                </form>                
            </div>  
                <div style="margin-left: 15px;">
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
                                                    where m.matricula_aluno_id = $matricula
                                    order by bolsa_aluno_id desc";
        //ECHO  $query2;
        $MatrizArrayt2 = $this->db->query($query2)->result_array();
        foreach ($MatrizArrayt2 as $row_turma3):
          $bolsa2 = $row_turma3['bolsa'];
        endforeach;
        if($bolsa2){
        ?>
        

                            <b><font style="color: #0044cc; font-size: 18px;">Bolsa(s) vinculada(s)</font></b>

                            <table class="table table-hover" >
                                <thead>
                                    <tr>
                                        <td>Descrição da Bolsa </td>
                                        <td >Perído Letivo </td>
                                        <td >% da Bolsa </td>
                                        <td >Opções </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
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

                                        <tr>
                                            <td style="text-transform:uppercase;"><?php echo $bolsa; ?></td>
                                            <td style="text-transform:uppercase;">Turma: <?php echo $row_turma2['tur_tx_descricao']; ?> <?php echo ' ('; ?> <?php echo $periodo_letivo; ?><?php echo ')'; ?> <?php echo $periodo; ?> <?php echo ' - '; ?> 
                                                <?php echo $row_turma2['descricao']; ?></td>
                                            <td>
                                                <?php echo $row_turma2['porcentagem_bolsa']; ?>
                                            </td>
                                            <td>     <a  href="<?php echo base_url(); ?>index.php?educacional/ficha_aluno_bolsa/do_delete/<?php echo $row_turma2['bolsa_aluno_id']; ?>/<?php echo $matricula; ?>"  class="btn btn-red btn-small" >
                                                    <?php echo 'apagar'; ?>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                            <div id="bolsa_periodo_letivo">

                            </div>

                            <?php
                        } else {
                            ?>
<b><font style="color: #0044cc; font-size: 18px;">Não Existe Bolsa(s) vinculada(s) para este aluno</font></b>
                            <?php
                        }
                        ?>
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
    
     function apagar_vinculo_bolsa(bolsa_aluno_id) {   
       var bolsa_aluno_id = bolsa_aluno_id; //codigo do id da tabela matricula_aluno
       var matricula_aluno_id = $('#matricula_aluno_id').val();
       var matricula_aluno__turma_id = $('#matricula_aluno_turma_id').val();
        //se encontrou o estado
        
            var url = 'index.php?educacional/ficha_aluno_bolsa/do_delete/' + bolsa_aluno_id + '/' + matricula_aluno_id;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#bolsa_periodo_letivo').html(dataReturn);  //coloco na div o retorno da requisicao
               
            });
            bucar_vinculo_bolsa_aluno();
     }
     
     function bucar_vinculo_bolsa_aluno(var id) {   
         var matricula_aluno_id = id;
         window.location.href = 'index.php?educacional/ficha_aluno_bolsa/'+ matricula_aluno_id;
     }
</script>