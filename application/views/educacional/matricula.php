<script language="JavaScript" type="text/javascript">
    function mascara(t, mask) {
        var i = t.value.length;
        var saida = mask.substring(1, 0);
        var texto = mask.substring(i)
        if (texto.substring(0, 1) != saida) {
            t.value += texto.substring(0, 1);
        }
    }
</script>
<div class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
           
            <li  class="active">
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo 'novo_aluno(a)'; ?>
                </a></li>

        </ul>
        <!------CONTROL TABS END------->

    </div>
    <div class="box-content padded">
        <div class="tab-content">
           

            <!----CREATION FORM STARTS---->
            <div class="tab-pane active box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('educacional/matricula/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <div class="padded">
                        <table width="100%" class="responsive">
                            <tbody>
                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'Curso'; ?></label>
                                            <div class="controls">
                                                <select name="curso" id="curso" onchange="buscar_turma_matricula()" style="width: 350px;">
                                                    <option>Selecione o curso</option>
                                                    <?php
                                                    foreach ($cursos as $row):
                                                        ?>
                                                        <option value="<?php echo $row['cursos_id']; ?>"><?php echo $row['cur_tx_descricao']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?>                                                
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'Turma'; ?></label>
                                            <div class="controls">
                                                <div  id="load_turma_matricula">
                                                    <select name="turma" id="turma" style="width: 350px;">
                                                        <option>Selecione um Curso</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div  id="load_desperiozado_matricula_nova">

                                        </div>

                                    </td>
                                </tr>                               
                                <tr>
                                    <td>
                                        <div id="load_add_disciplina_desperiodizado_mn"></div>
                                    </td>
                                </tr>                             
                            <tr>      
                            </tr>
                            </tbody>
                        </table>
                        <div  id="load_disciplina_matricula_nova"></div>                       
                        <div id="load_desperiodizado_tabela_mn"></div>                                   
                        </br>
                        <b><font style="color: #0044cc">DADOS PESSOAIS</font></b>
                        <hr/>
                        <table width="100%" class="responsive">
                            <tbody>

                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'Nome'; ?></label>
                                            <div class="controls">
                                                <input type="text" class="validate[required]" minlength="8" onkeypress="this.value.toUpperCase();" name="nome"/>
                                            </div>
                                        </div>
                                    </td>


                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'data_nascimento'; ?></label>
                                            <div class="controls">
                                                <input type="text" class="validate[required]" minlength="10" onkeypress="mascara(this, '##/##/####')" maxlength="10" id="data_nascimento"  name="data_nascimento"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'pais_origem'; ?></label>

                                            <div class="controls">
                                                <select name="pais_origem">
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
                                                <select name="uf_nascimento" id="uf_nascimento" onchange="buscar_municipio()">
                                                    <option value="0">Selecione o UF</option>
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
                                                <div  id="load_muncipio_matricula_nova">
                                                    <select name="cidade_origem">
                                                        <option>Selecione a UF</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'sexo'; ?></label>

                                            <div class="controls">


                                                <select name="sexo">

                                                    <option>Selecione o Sexo</option>
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
                                                <select name="estado_civil">

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

                        </br>
                        <b><font style="color: #468847">DOCUMENTOS</font></b>
                        <hr/>
                        <table width="100%" class="responsive">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'cpf'; ?></label>
                                            <div class="controls">
                                                <input type="text" class="validate[required]" minlength="12" onkeypress="mascara(this, '#########-##')" maxlength="12" id="cpf" name="cpf"/>

                                            </div>
                                        </div>
                                    </td>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'RG'; ?></label>
                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="rg"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>


                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'RG_UF'; ?></label>

                                            <div class="controls" id="load_matriz">

                                                <select name="rg_uf" id="rg_uf" >
                                                    <option value="0">Selecione o UF</option>
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
                                                <input type="text" class="validate[required]" name="rg_orgao_expeditor"/>
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
                                                    <input type="text"  name="titulo"/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'uf_titulo'; ?></label>

                                            <div class="controls">
                                                <select name="uf_titulo" id="uf_titulo" >
                                                    <option value="0">Selecione o UF</option>
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
                                                <input type="text" name="documento_estrangeiro"/>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'certidão_reservista'; ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="text"  name="certidao_reservista"/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <TR>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'uf_certidão_reservista'; ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <select name="uf_certidao" id="uf_certidao" >
                                                        <option value="0">Selecione o UF</option>
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
                                </TR>
                            </tbody>
                        </table>

                        </br>
                        <b><font style="color: #F09900">INFORMAÇÕES SOCIOECONOMICO</font></b>
                        <hr/>

                        <table width="100%" class="responsive">
                            <tbody>
                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'Quantos_irmãos_você_tem? '; ?></label>
                                            <div class="controls">
                                                <div class="controls">
                                                    <SELECT required="true"  NAME="SE_txIrmaos">
                                                        <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
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
                                                        <SELECT required="true"  NAME="SE_txFilhos">
                                                            <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
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
                                                    <SELECT required="true"  NAME="SE_txReside">
                                                        <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
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
                                                    <SELECT required="true"  NAME="SE_txRenda">
                                                        <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
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
                                                    <SELECT required="true"  NAME="SE_txMembros">
                                                        <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
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
                                                    <SELECT required="true" NAME="SE_txTrabalho">
                                                        <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
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

                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'Você tem bolsa ou financiamento estudantil?'; ?></label>
                                            <div class="controls">
                                                <div class="controls">
                                                    <SELECT required="true"  NAME="SE_txBolsa">
                                                        <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
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

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'Se trabalha, qual a C.H. ?'; ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <SELECT required="true"  NAME="SE_txCH">
                                                        <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
                                                        <OPTION value="1" >N&atilde;o trabalho/ nunca exerci atividade remunerada.</OPTION>
                                                        <OPTION value="2">Trabalho/ trabalhei eventualmente</OPTION>
                                                        <OPTION value="3">Trabalho/ trabalhei at&eacute; 20 horas semanais</OPTION>
                                                        <OPTION value="4">Trabalho/ trabalhei mais de 20 horas semanais e menos de 40 horas semanais</OPTION>
                                                        <OPTION value="5">Trabalho/ trabalhei em tempo integral - 40 horas semanais ou mais</OPTION>
                                                    </SELECT>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                            </tbody>
                        </table>

                        </br>
                        <b><font style="color: #cb2027">ENDEREÇO</font></b>
                        <hr/>

                        <table width="100%" class="responsive">
                            <tbody>

                            <td>
                                <div class="control-group">
                                    <label class="control-label"><?php echo 'cep'; ?></label>
                                    <div class="controls">
                                        <input type="text" class="validate[required]" minlength="9" onkeypress="mascara(this, '#####-###')" maxlength="9" id="cep" name="cep"/>
                                    </div>
                                </div>
                            </td>
                            <td >
                                <div class="control-group">
                                    <label class="control-label"><?php echo 'endereco'; ?></label>

                                    <div class="controls">
                                        <input type="text" class="validate[required]" minlength="8" onkeypress="this.value.toUpperCase();" name="endereco"/>
                                    </div>

                                </div>
                            </td>

                            </tr>



                            <tr>


                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo 'bairro'; ?></label>

                                        <div class="controls">

                                            <input type="text" class="validate[required]" minlength="5" onkeypress="this.value.toUpperCase();" name="bairro"/>

                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo 'UF'; ?></label>

                                        <div class="controls">

                                            <div class="controls">
                                                <select name="uf" id="uf" onchange="buscar_cidade()">
                                                    <option value="0">Selecione o UF</option>
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
                                            <div  id="load_cidade">
                                                <select>
                                                    <option>Selecione a UF</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </td>
                                <td >
                                    <div class="control-group">
                                        <label class="control-label"><?php echo 'complemento'; ?></label>

                                        <div class="controls">
                                            <input type="text"  onkeypress="this.value.toUpperCase();" name="complemento"/>
                                        </div>

                                    </div>
                                </td>



                            </tr>

                            </tbody>
                        </table>


                        </br>
                        <b><font style="color: cadetblue">CONTATOS</font></b>
                        <hr/>

                        <table width="100%" class="responsive">
                            <tbody>

                                <tr>


                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'fone'; ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="text" onkeypress="mascara(this, '#####-####')" maxlength="10"  id="fone" name="fone"/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'celular'; ?></label>

                                            <div class="controls">
                                                <input type="text" onkeypress="mascara(this, '#####-####')" maxlength="10"  id="celular" name="celular"/>
                                            </div>

                                        </div>
                                    </td>

                                </tr>




                                <tr>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'email'; ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="email" minlength="10" name="email"/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>



                                </tr>

                            </tbody>
                        </table>


                        </br>
                        <b><font style="color: maroon">INFORMAÇÕES</font></b>
                        <hr />

                        <table width="100%" class="responsive">
                            <tbody>

                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'nacionalidade'; ?></label>

                                            <div class="controls">
                                                <select name="nacionalidade">

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
                                                    <select class="validate[required]" name="cor">
                                                        <option value="99">Selecione uma cor/raça</option>
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
                                                <input type="text" class="validate[required]" minlength="8" onkeypress="this.value.toUpperCase();" name="mae"/>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'pai'; ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="text"  onkeypress="this.value.toUpperCase();" name="pai"/>
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
                                                <input type="text"   style="text-transform:uppercase;" name="conjuge"/>
                                            </div>
                                        </div>
                                    </td>

                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'Tem Alguma Deficiência?'; ?></label>

                                            <div class="controls">
                                                <select name="deficiencia" id="deficiencia" onchange="buscar_deficiencia()">
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
                                                <select name="tipo_escola" id="tipo_escola" >
                                                    <option value="0">PRIVADO</option>
                                                    <option value="1">PUBLICO</option>
                                                    <option value="2">NÃO DISPÕE DA INFORMAÇÃO</option>
                                                </select>

                                            </div>

                                        </div>
                                    </td>

                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'Forma de Ingresso'; ?></label>

                                            <div class="controls">
                                                <select name="forma_ingresso" id="forma_ingresso" >
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

                                </tr>

                            </tbody>
                        </table>



                        <div  id="load_doencas">

                        </div>


                        </br>
                        <b><font style="color: teal">INFORMAÇÕES DO RESPONSÁVEL</font></b>
                        <hr/>



                        <table width="100%" class="responsive">
                            <tbody>


                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'responsavel'; ?></label>

                                            <div class="controls">
                                                <input type="text" name="responsavel"/>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'fone_responsavel'; ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="text" name="fone_responsavel"/>
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
                                                <input type="text" name="rg_responsavel"/>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'CPF_responsável'; ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="text" name="cpf_responsavel"/>
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
                                                <input type="text" name="celular_responsavel"/>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        </br>
                        <b><font style="color: darkgreen">OBSERVAÇÕES GERAIS</font></b>
                        <hr/>

                        <table width="100%" class="responsive">
                            <tbody>

                                <tr>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo 'OBSERVAÇÕES'; ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <textarea name="obs_documento" style="width: 62%; height: 120px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-gray"><?php echo 'Matricular'; ?></button>
                    </div>
                    </form>                
                </div>                
            </div>
            <!----CREATION FORM ENDS--->

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


    function buscar_municipio() {
        var uf = $('#uf_nascimento').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (uf) {
            var url = 'index.php?educacional/carrega_municipio_matricula_nova/' + uf;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_muncipio_matricula_nova').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

    function buscar_cidade() {
        var uf2 = $('#uf').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (uf2) {
            var url = 'index.php?educacional/carrega_cidade/' + uf2;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_cidade').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

    function buscar_deficiencia() {
        var deficiencia = $('#deficiencia').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (deficiencia) {
            var url = 'index.php?educacional/carrega_doencas/' + deficiencia;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_doencas').html(dataReturn);  //coloco na div o retorno da requisicao
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


    function buscar_turma_matricula() {
        var curso = $('#curso').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (curso) {
            var url = 'index.php?educacional/carrega_turma_matricula/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_turma_matricula').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }
    
    function buscar_disciplina_matricula_nova() {
        var curso = $('#curso').val();
        var turma = $('#turma').val();  //codigo do estado escolhido
        
        //se encontrou o estado
            var url = 'index.php?educacional/carrega_disciplina_matricula_nova/' + curso + '/' + turma ;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_disciplina_matricula_nova').html(dataReturn);  //coloco na div o retorno da requisicao
            });
    }
    
    function buscar_disciplina_desperiodizado_tabela_mn() {
      //  var matricula_aluno_id = $('#matricula_aluno_id').val(); //codigo do id da tabela matricula_aluno
        //se encontrou o estado
            var url = 'index.php?educacional/carrega_disciplina_desperiodizado_tabela_mn/';  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_desperiodizado_tabela_mn').html(dataReturn);  //coloco na div o retorno da requisicao
               
            });
     }
     
    function buscar_desperiorizado_matricula() {
             var url = 'index.php?educacional/carrega_div_desperiorizado/';  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_desperiozado_matricula_nova').html(dataReturn);  //coloco na div o retorno da requisicao
            });
            
             buscar_disciplina_desperiodizado_tabela_mn();
       
    }
    
    function adicionar_disciplina_desperiodizado_mn() {
       // var matricula_aluno_id = $('#matricula_aluno_id').val(); //codigo do id da tabela matricula_aluno
        var turma = $('#turma').val();  //codigo da turma selecionada
        var matriz_disciplina_id = $('#matriz_disciplina_id_mn').val();  //codigo do id da tabela matriz_disciplina, onde chega no id da disciplina
        
        //se encontrou o estado
            var url = 'index.php?educacional/insert_disciplina_desperiodizado_mn/' + turma + '/' + matriz_disciplina_id ;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_add_disciplina_desperiodizado_mn').html(dataReturn);  //coloco na div o retorno da requisicao
            });
             
        
        buscar_disciplina_desperiodizado_tabela_mn();
           // buscar_ficha_periodizado(matricula_aluno_id);
    }
    
    function apagar_disciplina_desperiodizado(disciplina_desperiodizado_id) {
            var id_disciplina_desperiodizado = disciplina_desperiodizado_id; //$('#disciplina_desperiodizado_id').val(); //codigo do id da tabela matricula_aluno
           // var matricula_aluno_id = $('#matricula_aluno_id').val();
        //se encontrou o estado
            var url = 'index.php?educacional/delete_disciplina_desperiodizado_mn/' + id_disciplina_desperiodizado ;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_desperiozado_matricula_nova').html(dataReturn);  //coloco na div o retorno da requisicao
            });            
             buscar_disciplina_desperiodizado_tabela_mn();       
             //buscar_ficha_periodizado_um();
    }
    
    function buscar_periodo_letivo() {
        var curso = $('#curso_busca').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (curso) {
            var url = 'index.php?educacional/carrega_periodo_letivo/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_periodo_letivo').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

    function buscar_turma() {
        var curso = $('#curso_busca').val();  //codigo do estado escolhido
        var periodo_letivo = $('#periodo_letivo_busca').val();
      
        //se encontrou o estado
        if (curso) {
            var url = 'index.php?educacional/carrega_turma/' + curso + '/' + periodo_letivo;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_turma').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

    function buscar_paginacao() {
        var aluno = $('#aluno_busca').val();  //codigo do estado escolhido
        var curso = $('#curso_busca').val();
        var turma = $('#turma_busca').val();
        //se encontrou o estado
        if ((aluno) || (curso != '0') || (turma != '0')) {
            var url = 'index.php?educacional/carrega_table_paginacao/' + curso + '/' + turma + '/' + aluno;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_paginacao').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }else{
            alert('Selecione um curso e turma');
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
