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
<div id="box" class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
           <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo 'lista_aluno(s)'; ?>
                </a></li>
                 <font style="color: #ffffff; font-size: 16px; margin-top: 45px; margin-left: 20px;"> <?php echo 'MATRÍCULA VIA VESTIBULAR'; ?></font>
            
        </ul>
        <!------CONTROL TABS END------->

    </div>
    <div class="box-content padded">
        <div class="tab-content">
            <div class="tab-pane  active" id="list">
                <table>
                    <tr>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo 'Vestibular'; ?></label>
                                <div class="controls">
                                    <select name="curso_busca" id="curso_busca" >
                                        <option value="0">Selecione o vestibular</option>
                                        <?php
                                        foreach ($vestibular as $row):
                                            ?>
                                            <option value="<?php echo $row['vestibular_id']; ?>"><?php echo date('d/m/Y', strtotime($row['vest_dt_realizacao'])); ?></option>
                                            <?php
                                        endforeach;
                                        ?>                                                
                                    </select>
                                </div>
                            </div>
                        </td>
                        
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo 'Nome'; ?></label>
                                <div class="controls">
                                    <input type="text"  name="aluno_busca"  id="aluno_busca"     />

                                </div>
                            </div>
                        </td>
                     </tr>
                   
                </table>

        



                <table>
                    <tr>
                        <td>
                            <input type="button" value="PESQUISAR" class="btn btn-blue btn-small" onclick="buscar_paginacao();">
                        </td>
  <?php  /*
                        <td>
                            <a  href="index.php?educacional/teste_impressao" 	class="btn btn-gray btn-small">
                                <i class="icon-dashboard"></i> <?php echo 'Impressão'); ?>
                            </a>

                        </td>
   * 
   */
?>                        
                    </tr>
                </table>
                <br>

                <div id="load_paginacao">
                </div>

            </div>

            <!----CREATION FORM STARTS---->
            
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
    function buscar_municipio_matricula_vestibular() {
        var uf = $('#uf_nascimento').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (uf) {
            var url = 'index.php?educacional/carrega_municipio/' + uf;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_muncipio_matricula_vestibular').html(dataReturn);  //coloco na div o retorno da requisicao
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
    function buscar_turma_matricula_vestibular() {
        var curso = $('#curso').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (curso) {
            var url = 'index.php?educacional/carrega_turma_matricula/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_turma_matricula_vestibular').html(dataReturn);  //coloco na div o retorno da requisicao
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
        //se encontrou o estado
        if ((aluno) || (curso != '0') ) {
            var url = 'index.php?educacional/carrega_table_candidatos/' + curso + '/' + aluno;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_paginacao').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }else{
            alert('Selecione um VESTIBULAR ou informe o nome do CANDIDATO');
        }
    }
    function buscar_candidato(candidato_id) {
         var candidato = candidato_id;//$('#candidato_id').val(); 
         //se encontrou o estado
        if (candidato) {
            var url = 'index.php?educacional/carrega_candidatos/' + candidato ;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#box').html(dataReturn);  //coloco na div o retorno da requisicao
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
