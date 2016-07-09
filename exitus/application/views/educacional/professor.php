<script type="text/javascript">
/* Máscaras ER */
function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
function mcep(v){
    v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
    v=v.replace(/^(\d{5})(\d)/,"$1-$2")         //Esse é tão fácil que não merece explicações
    return v
}
function mdata(v){
    v=v.replace(/\D/g,"");                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{2})(\d)/,"$1/$2");       
    v=v.replace(/(\d{2})(\d)/,"$1/$2");       
                                             
    v=v.replace(/(\d{2})(\d{2})$/,"$1$2");
    return v;
}
function mrg(v){
	v=v.replace(/\D/g,'');
	v=v.replace(/^(\d{2})(\d)/g,"$1.$2");
	v=v.replace(/(\d{3})(\d)/g,"$1.$2");
	v=v.replace(/(\d{3})(\d)/g,"$1-$2");
	return v;
}
function mvalor(v){
    v=v.replace(/\D/g,"");//Remove tudo o que não é dígito
    v=v.replace(/(\d)(\d{8})$/,"$1.$2");//coloca o ponto dos milhões
    v=v.replace(/(\d)(\d{5})$/,"$1.$2");//coloca o ponto dos milhares
        
    v=v.replace(/(\d)(\d{2})$/,"$1,$2");//coloca a virgula antes dos 2 últimos dígitos
    return v;
}
function id( el ){
	return document.getElementById( el );
}
function next( el, next )
{
	if( el.value.length >= el.maxLength ) 
		id( next ).focus(); 
}
</script>
<div class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo 'lista_professores'; ?>
                </a>
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo 'novo_professor'; ?>
                </a>
            </li>
            
        </ul>
        <!------CONTROL TABS END------->

    </div>
    <div class="box-content padded">
        <div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  active" id="list">
                <div class="action-nav-normal">
                    <div class=" action-nav-button" style="width:300px;">
                        <a href="#" title="Users">
                            <i id="colorb" class="fa fa-list-alt"></i>
                            <!--<img src="<?php echo base_url(); ?>template/images/icons_menu/periodo_letivo.png" />-->
                            <span>Total <?php echo count($professor_cadastro); ?> Professor</span>
                        </a>
                    </div>
                </div>
                <div class="box">
                    <div class="box-content">
                        <div id="dataTables">
                            <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                                <thead>
                                    <tr>
                                <th><div>ID</div></th>
                                <th><div><?php echo 'Nome'; ?></div></th>
                                <th><div><?php echo 'Dt. Nascimento'; ?></div></th>
                                <th><div><?php echo 'Email'; ?></div></th>
                                <th><div><?php echo 'login'; ?></div></th>
                                <th><div><?php echo 'status'; ?></div></th>
                                <th><div><?php echo 'opções'; ?></div></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                     $ProfessorArray = $this->db->query("SELECT * FROM professor")->result_array();
                                    foreach ($ProfessorArray as $row):
                                        $professor_id = $row['professor_id'];
                                    
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                           
                                            <td><font style="text-transform: uppercase"><?php echo ucfirst($row['nome']); ?></font></td>
                                            <td><?php echo date("d/m/Y", strtotime($row['nascimento'])); ?></font></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['login'];  ?></td>
                                            <td><?php echo $row['situacao'];  ?></td>
                                            <td align="center">
                                                 <a href="<?php echo base_url(); ?>index.php?educacional/professor_disciplina/<?php echo $row['professor_id']; ?>" class="btn btn-blue btn-small">
                                             
                                                    <i class="icon-list-alt"></i> <?php echo 'disciplinas'; ?>
                                                </a>
                                                 <a href="<?php echo base_url(); ?>index.php?educacional/professor_editar/<?php echo $row['professor_id']; ?>" class="btn btn-blue btn-small">
                                                 <i class="icon-wrench"></i> <?php echo 'editar'; ?>
                                                </a>
                                                
                                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?educacional/professor/delete/<?php echo $row['professor_id']; ?>')"
                                                   class="btn btn-red btn-small">
                                                    <i class="icon-trash"></i> <?php echo 'deletar'; ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!----TABLE LISTING ENDS--->

            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add">
                <div class="box-content">
                    <?php echo form_open('educacional/professor/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <form method="post" action="<?php echo base_url(); ?>index.php?educacional/periodo_letivo/create/" class="form-horizontal validatable" enctype="multipart/form-data">
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo 'Nome'; ?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="nome" class="input" style="height: 30px; width: 350px;"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo 'data_nascimento'; ?></label>
                                <div class="controls">
                                    <input type="text" onkeypress="mascara(this, mdata);" maxlength="10" minlength="10" placeholder="99/99/9999" name="nascimento" id="nascimento" class="input" style="height: 30px; width: 200px;"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo 'sexo'; ?></label>
                                <div class="controls">
                                    <select name="sexo" class="input" class="uniform" style="height: 30px; width: 200px;">
                                        <option value="M"><?php echo 'Masculino'; ?></option>
                                        <option value="F"><?php echo 'feminino'; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo 'endereco'; ?></label>
                                <div class="controls">
                                    <input type="text" class="" name="endereco" class="input" style="height: 30px; width: 350px;"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo 'bairro'; ?></label>
                                <div class="controls">
                                    <input type="text" class="" name="bairro" class="input" style="height: 30px; width: 350px;"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo 'CEP'; ?></label>
                                <div class="controls">
                                    <input type="text" onkeypress="mascara(this, mcep);" name="cep" maxlength="9" class="input" style="height: 30px; width: 200px;"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo 'cidade'; ?></label>
                                <div class="controls">
                                    <input type="text" name="cidade" class="input" style="height: 30px; width: 200px;"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo 'UF'; ?></label>
                                <div class="controls">
                                    <input type="text" name="uf" maxlength="2" class="input" style="height: 30px; width: 200px;"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo 'email'; ?></label>
                                <div class="controls">
                                    <input type="text" class="input" style="height: 30px; width: 200px;" name="email"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo 'situação'; ?></label>
                                <div class="controls">
                                    <select name="situacao" class="input" style="height: 30px; width: 200px;">
                                        <option value="A"><?php echo 'Ativo'; ?></option>
                                        <option value="I"><?php echo 'Inativo'; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo 'login'; ?></label>
                                <div class="controls">
                                    <input type="text"  class="validate[required]" style="height: 30px; width: 200px;" name="login"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo 'senha'; ?></label>
                                <div class="controls">
                                    <input type="password" class="validate[required]" name="senha" class="input" style="height: 30px; width: 200px;" />
                                </div>
                            </div>
                            

                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo 'criar_professor'; ?></button>
                        </div>
                    </form>                
                </div>                
            </div>
            <!----CREATION FORM ENDS--->

            <div class="tab-pane box" id="add_bolsa">
                <div class="box-content">
                    <?php echo form_open('educacional/periodo_letivo/bolsa', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <form method="post" action="<?php echo base_url(); ?>index.php?educacional/periodo_letivo/bolsa/" class="form-horizontal validatable" enctype="multipart/form-data">
                        <div class="padded">
                            <table width="100%" class="responsive">
                                <tbody>
                                    <tr>
                                        <td width="35%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'Bolsas'; ?></label>
                                                <div class="controls">
                                                    <?php
                                                    $query_pl = "SELECT * FROM bolsas order by descricao asc";
                                                    $Matrizpl = $this->db->query($query_pl)->result_array();
                                                    ?>
                                                        <select style="width: 350px;" name="bolsas_vinculo" id="bolsas_vinculo" >
                                                            <?php
                                                            foreach ($Matrizpl as $row_curso):
                                                                ?>
                                                                <option value="<?php echo $row_curso['bolsas_id']; ?>"><?php echo $row_curso['descricao']; ?></option>
                                                                <?php
                                                            endforeach;
                                                            ?>                                                
                                                        </select>
                                                  </div>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'periodo_letivo'; ?></label>
                                                <div class="controls">
                                                    <?php
                                                    $query_pl2 = "SELECT * FROM periodo_letivo order by periodo_letivo_id desc";
                                                    $Matrizpl2 = $this->db->query($query_pl2)->result_array();
                                                    ?>
                                                        <select style="width: 350px;" name="periodo_letivo_vinculo" id="periodo_letivo_vinculo" >
                                                            <?php
                                                            foreach ($Matrizpl2 as $row_curso2):
                                                                ?>
                                                                <option value="<?php echo $row_curso2['periodo_letivo_id']; ?>"><?php echo $row_curso2['periodo_letivo']; ?></option>
                                                                <?php
                                                            endforeach;
                                                            ?>                                                
                                                        </select>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                </tbody>
                            </table>

                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo 'vincular_bolsa'; ?></button>
                        </div>
                    </form>        
                    
                    <div id="bolsa_periodo_letivo">
                        <script>
                            //onload(bucar_vinculo_bolsa());
                               var url = 'index.php?educacional/carrega_vinculo_bolsa/';  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#bolsa_periodo_letivo').html(dataReturn);  //coloco na div o retorno da requisicao
               
            });
                        </script>
                    </div>
                    
                </div>                
            </div>
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

    function buscar_ficha_bolsa(candidato_id) {
        var candidato = candidato_id;//$('#candidato_id').val(); 
        //se encontrou o estado
        if (candidato) {
            var url = 'index.php?educacional/carrega_ficha_dependencia/' + candidato;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#box_periodizado').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        } else {
            alert('Selecione um curso e turma');
        }

    }
    
     function apagar_vinculo_bolsa(periodo_letivo_id) {   
       var periodo_letivo_id = periodo_letivo_id; //codigo do id da tabela matricula_aluno
        //se encontrou o estado
        
            var url = 'index.php?educacional/carrega_apagar_vinculo_bolsa/' + periodo_letivo_id;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#bolsa_periodo_letivo').html(dataReturn);  //coloco na div o retorno da requisicao
               
            });
            bucar_vinculo_bolsa();
     }
     
     function bucar_vinculo_bolsa() {   
         window.location.href = 'index.php?educacional/periodo_letivo/';
     }
</script>