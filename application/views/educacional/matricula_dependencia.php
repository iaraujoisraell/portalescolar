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
  
                    
                          
<div  id="box_periodizado" class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo 'MATRÍCULA DE DEPENDÊNCIA DE ALUNO'; ?>
                </a></li>
              

        </ul>
        <!------CONTROL TABS END------->

    </div>
    <div  class="box-content padded">
        <div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  active" id="list">
                <table width = "70%">
                    <tr>
                        <td width = "20%">
                            <div class="control-group">
                                <label class="control-label"><?php echo 'Curso'; ?></label>
                                <div class="controls">
                                    <select name="curso_busca" id="curso_busca" onchange="buscar_periodo_letivo()">
                                        <option value="0">Selecione o curso</option>
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
                        
                        <td width = "20%">
                            <div class="control-group">
                                <label class="control-label"><?php echo 'Período Letivo'; ?></label>
                                <div class="controls">
                                    <div  id="load_periodo_letivo">
                                        <select name="periodo_letivo_busca" id="periodo_letivo_busca">
                                            <option value="0">Selecione um Curso</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td width = "20%">
                            <div class="control-group">
                                <label class="control-label"><?php echo 'Turma'; ?></label>
                                <div class="controls">
                                    <div  id="load_turma">
                                        <select name="turma_busca" id="turma_busca">
                                            <option value="0">Selecione um Período Letívo</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                    <div  id="load_dados_turma">

                    </div>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo 'Nome'; ?></label>
                                <div class="controls">
                                    <input  type="text" onkeypress="this.value.toUpperCase();"  name="aluno_busca" id="aluno_busca"     />

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

                

            </div>
            <div id="load_paginacao_dependencia">
                </div>
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


    function buscar_municipio() {
        var uf = $('#uf_nascimento').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (uf) {
            var url = 'index.php?educacional/carrega_municipio/' + uf;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_muncipio').html(dataReturn);  //coloco na div o retorno da requisicao
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
    
    function buscar_turma_matricula_desperiodizado() {
        var curso = $('#curso_busca_periodizado').val();  //codigo do estado escolhido
        var periodo_letivo = $('#periodo_letivo_desperiodizado').val();
      
        //se encontrou o estado
        if (curso) {
            var url = 'index.php?educacional/carrega_turma_matricula_desperiodizado/' + curso + '/' + periodo_letivo;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_turma_desperiodizado').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

    function buscar_paginacao() {
        var aluno = $('#aluno_busca').val();  //codigo do estado escolhido
        var curso = $('#curso_busca').val();
        var turma = $('#turma_busca').val();
        //se encontrou o estado
        if ((aluno) || (curso != '0') || (turma != '0')) {
            var url = 'index.php?educacional/carrega_table_paginacao_dependencia/' + curso + '/' + turma + '/' + aluno;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_paginacao_dependencia').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }else{
            alert('Selecione um curso e turma');
        }
    }
    
   
    
    function buscar_ficha_dependencia(candidato_id) {
         var candidato = candidato_id;//$('#candidato_id').val(); 
         //se encontrou o estado
        if (candidato) {
            var url = 'index.php?educacional/carrega_ficha_dependencia/' + candidato ;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#box_periodizado').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }else{
            alert('Selecione um curso e turma');
        }
        
    }

    function buscar_disciplina_desperiodizado() {
        var curso = $('#curso_busca_periodizado').val();
        var turma = $('#turma_busca_periodizado').val();  //codigo do estado escolhido
        
        //se encontrou o estado
            var url = 'index.php?educacional/carrega_disciplina_desperiodizado/' + curso + '/' + turma ;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_disciplina_desperiodizado').html(dataReturn);  //coloco na div o retorno da requisicao
            });
    }
    
    function buscar_disciplina_desperiodizado_tabela() {
        var matricula_aluno_id = $('#matricula_aluno_id').val(); //codigo do id da tabela matricula_aluno
        //se encontrou o estado
            var url = 'index.php?educacional/carrega_disciplina_desperiodizado_tabela/' + matricula_aluno_id;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_dependencia_tabela').html(dataReturn);  //coloco na div o retorno da requisicao
               
            });
     }
   
    function adicionar_disciplina_desperiodizado() {
        var matricula_aluno_id = $('#matricula_aluno_id').val(); //codigo do id da tabela matricula_aluno
        var turma = $('#turma_busca_periodizado').val();  //codigo da turma selecionada
        var matriz_disciplina_id = $('#matriz_disciplina_id').val();  //codigo do id da tabela matriz_disciplina, onde chega no id da disciplina
        
        //se encontrou o estado
            var url = 'index.php?educacional/insert_disciplina_desperiodizado/' + matricula_aluno_id + '/' + turma + '/' + matriz_disciplina_id ;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_add_disciplina_dependencia').html(dataReturn);  //coloco na div o retorno da requisicao
            });
            // buscar_disciplina_desperiodizado_tabela();
            buscar_ficha_dependencia(matricula_aluno_id);
    }
    
    function apagar_disciplina_desperiodizado(disciplina_desperiodizado_id) {
            var id_disciplina_desperiodizado = disciplina_desperiodizado_id; //$('#disciplina_desperiodizado_id').val(); //codigo do id da tabela matricula_aluno
            var matricula_aluno_id = $('#matricula_aluno_id').val();
        //se encontrou o estado
            var url = 'index.php?educacional/delete_disciplina_desperiodizado/' + id_disciplina_desperiodizado + '/' + matricula_aluno_id ;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_desperiodizado_tabela').html(dataReturn);  //coloco na div o retorno da requisicao
            });            
             //buscar_disciplina_desperiodizado_tabela();       
             buscar_ficha_dependencia(matricula_aluno_id);
    }
    
    function buscar_botao_desperiodizado(matricula_aluno_id) {
        var matricula_aluno_id = matricula_aluno_id; //$('#matricula_aluno_id').val(); //codigo do id da tabela matricula_aluno
        //se encontrou o estado
            var url = 'index.php?educacional/carrega_botao_matricula_desperiodizado/' + matricula_aluno_id  ;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#botao_desperiodizado').html(dataReturn);  //coloco na div o retorno da requisicao
            });
    }
</script>
