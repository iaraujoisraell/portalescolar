<div id="box" class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo 'Editar Professor'; ?>
                </a></li>
            
            <li >
                <a  href="index.php?educacional/professor/" 	>
                    <i class="icon-angle-left"></i> <?php echo 'Voltar para a lista de Professores'; ?>
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


    
        ?>


        <div class="tab-pane box" id="add" style="padding: 5px">


            <div class="box-content">
  <?php
                            foreach ($professor as $row):
                                $sexo = $row['sexo'];
                                if ($sexo == 'F') {
                                    $sexo_tx = 'FEMININO';
                                } else if ($sexo == 'M') {
                                    $sexo_tx = 'MASCULINO';
                                }


                                $situacao = $row['situacao'];
                                if ($situacao == 'A') {
                                    $situacao_tx = 'ATIVO';
                                } else if ($situacao == 'I') {
                                    $situacao_tx = 'INATIVO';
                                }
                                ?>

                  <?php echo form_open('educacional/professor/do_update/' . $row['professor_id'], array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
           <div class="padded">
                    <div style="width: 500px; margin: auto;">

                        <b><font style="color: #000000; font-size: 20px;">ALTERAR CADASTRO DO PROFESSOR</font></b>
                        <hr/>
                    </div>

                  
                    <div  class="tab-content">
                        
                             
                        <table width="100%" class="responsive">
                        <tbody>
                            <tr>
                                <td>
                                   <div class="control-group">
                                <label class="control-label"><?php echo 'Nome'; ?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" value="<?php echo $row['nome']; ?>"  name="nome"/>
                                </div>
                            </div> 
                                </td>           
                            </tr>
                         </tbody>    
                        </table>
                        
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo 'Data Nascimento'; ?></label>
                                <div class="controls">
                                    <input type="text" value="<?php echo date("d/m/Y", strtotime($row['nascimento'])); ?>"  name="nascimento"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo 'Sexo'; ?></label>
                                <div class="controls">
                                    <select name="sexo" class="input" style="height: 30px; width: 200px;">
                                        <option value="<?php echo $sexo; ?>"><?php echo $sexo_tx; ?></option>
                                        <option value="M"><?php echo 'Masculino'; ?></option>
                                        <option value="F"><?php echo 'feminino'; ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo 'Endereço'; ?></label>
                                <div class="controls">
                                    <input type="text" value="<?php echo $row['endereco']; ?>" name="endereco"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo 'Bairro'; ?></label>
                                <div class="controls">
                                    <input type="text" value="<?php echo $row['bairro']; ?>"  name="bairro"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo 'CEP'; ?></label>
                                <div class="controls">

                                    <input type="text" value="<?php echo $row['cep']; ?>"  class="validate[required]" name="cep"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo 'Cidade'; ?></label>
                                <div class="controls">
                                    <input type="text" value="<?php echo $row['cidade']; ?>" name="cidade"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo 'UF'; ?></label>
                                <div class="controls">
                                    <input type="text"  value="<?php echo $row['uf']; ?>" name="uf"/>

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo 'email'; ?></label>
                                <div class="controls">
                                    <input type="text"  value="<?php echo $row['email']; ?>" name="email"/>

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo 'Situação'; ?></label>
                                <div class="controls">

                                    <select name="situacao" required class="input" style="height: 30px; width: 200px;">
                                        <option value="<?php echo $situacao; ?>"><?php echo $situacao_tx; ?></option>
                                        <option value="A"><?php echo 'Ativo'; ?></option>
                                        <option value="I"><?php echo 'Inativo'; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo 'login'; ?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" value="<?php echo $row['login']; ?>" name="login"/>

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo 'Senha'; ?></label>
                                <div class="controls">
                                    <input type="password" class="validate[required]" value="<?php echo $row['senha']; ?>" name="senha"/>

                                </div>
                            </div>
                            
                        <?php endforeach; ?>     
                         
                   
                </div>
               
                <div class="form-actions">
                  <button type="submit" class="btn btn-gray"><?php echo 'Editar Professor '; ?></button>
                  </div>
                
                 
                </form>                
            </div>  
                
        </div>


        <?php
   
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