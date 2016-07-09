<div class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo 'lista_periodo_letivo'; ?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo 'novo_periodo_letivo'; ?>
                </a></li>

            <li>
                <a href="#add_bolsa" data-toggle="tab">
                    <i class="icon-briefcase"></i> <?php echo 'vincular_bolsa(s)'; ?>
                </a></li>


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
                            <span>Total <?php echo count($periodo); ?> Periodo Letivo</span>
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
                                <th><div><?php echo 'peridodo_letivo.'; ?></div></th>
                                <th><div><?php echo 'dias_letivo'; ?></div></th>
                                <th><div><?php echo 'data_início'; ?></div></th>
                                <th><div><?php echo 'ano'; ?></div></th>
                                <th><div><?php echo 'semestre'; ?></div></th>
                                <th><div><?php echo 'Bolsa(s)'; ?></div></th>
                                <th><div><?php echo 'situação' ?></div></th>
                                <th><div><?php echo 'opções'; ?></div></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($periodo as $row):
                                        $periodo_letivo_id =$row['periodo_letivo_id'];
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo ucfirst($row['periodo_letivo']); ?></font></td>
                                            <td><?php echo $row['dias_letivos']; ?></font></td>
                                            <td><?php echo date("d/m/Y", strtotime($row['data_inicio'])); ?></font></td>
                                            <td><?php echo $row['ano']; ?></font></td>
                                            <td><?php echo $row['semestre'] . "- Semestre" ?></font></td>
                                            <td>
                                                <?php
                                                    $query2 = "SELECT * FROM bolsa_periodo bp
                                    inner join bolsas b on b.bolsas_id = bp.bolsas_id
                                    inner join periodo_letivo pl on pl.periodo_letivo_id = bp.periodo_letivo_id
                                    where bp.periodo_letivo_id = $periodo_letivo_id
                                    order by bolsa_periodo_id desc";
                                                    // ECHO  $query2;
                                                    $MatrizArrayt2 = $this->db->query($query2)->result_array();
                                                    ?>
                                                <table class="table table-hover" >
                                             
                                            <tbody>
                                                <?php
                                                foreach ($MatrizArrayt2 as $row_turma2):
                                                    $bolsa = $row_turma2['descricao'];
                                                    $periodo_letivo = $row_turma2['periodo_letivo'];
                                                    
                                                    $bolsa_periodo_id = $row_turma2['bolsa_periodo_id'];    
                                                    ?>
                                                    
                                                    <tr>
                                                        <td><?php echo $bolsa; ?></td>
                                                     </tr>
                                                    <?php
                                                endforeach;
                                                ?>
                                                </tbody>
                                        </table>
                                            </td>
                                            
                                            <td><?php if ($row['periodo_encerrado'] == "0") {
                                            ?><div class="btn btn-sea btn-small">Período Encerrado</div> 
                                                    <?php
                                                } else if ($row['periodo_encerrado'] == "1") {
                                                    ?><div class="btn btn-green btn-small">Período Aberto</div> <?php }
                                                ?></td>
                                            
                                            <td align="center">
                                                <a data-toggle="modal" href="#modal-form" onclick="#"class="btn btn-black  btn-small">
                                                    <i class="icon-minus-sign"></i> <?php echo 'Encerrar'; ?>
                                                </a>

                                                <a data-toggle="modal" href="#modal-form" onclick="modal('editar_periodo',<?php echo $row['periodo_letivo_id']; ?>)"class="btn btn-gray btn-small">
                                                    <i class="icon-wrench"></i> <?php echo 'editar'; ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?educacional/periodo_letivo/delete/<?php echo $row['periodo_letivo_id']; ?>')"
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
                    <?php echo form_open('educacional/periodo_letivo/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <form method="post" action="<?php echo base_url(); ?>index.php?educacional/periodo_letivo/create/" class="form-horizontal validatable" enctype="multipart/form-data">
                        <div class="padded">
                            <table width="100%" class="responsive">
                                <tbody>
                                    <tr>
                                        <td width="35%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'periodo_letivo'; ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="periodo_letivo"/>
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'descrição'; ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="descricao"/>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>

                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'dias_letivo'; ?></label>
                                                <div class="controls">
                                                    <input type="text" name="dias_letivos"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'data_inicio'; ?></label>
                                                <div class="controls">
                                                    <input type="text" class="datepicker fill-up validate[required]" name="data_inicio"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'data_previsão_termino'; ?></label>
                                                <div class="controls">
                                                    <input type="text" class="datepicker fill-up" name="data_prev_terminio"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'data_término'; ?></label>
                                                <div class="controls">
                                                    <input type="text" class="datepicker fill-up" name="data_termino"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'situação_período'; ?></label>
                                                <div class="controls">                                                  
                                                    <select name="situacao">
                                                        <option value="0">Período Encerrado</option>
                                                        <option value="1">Período Aberto</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'ano'; ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="ano"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'semestre'; ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="semestre"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo 'criar_período_letivo'; ?></button>
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