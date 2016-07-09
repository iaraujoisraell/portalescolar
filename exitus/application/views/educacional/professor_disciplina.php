<div class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">



            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo 'Professor/Disciplina'; ?>
                </a>
            </li>

            <li>
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo 'vicular_disciplina'; ?>
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
                    <div class=" action-nav-button" style="width:500px;">
                        <a  title="Users">
                            <?php
                            $count = 1;
                            $professor_id = '';
                            foreach ($professor as $row1):
                                $professor_id = $row1['professor_id'];
                            //echo 'akiii'.$professor_id;
                                ?>
                                <h3><?php echo $row1['nome']; ?> </h3>
                            <?php endforeach; ?>
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
                                <th><div><?php echo 'Periodo_letivo'; ?></div></th>
                                <th><div><?php echo 'Curso'; ?></div></th>   
                                <th><div><?php echo 'Turma'; ?></div></th>
                  
                                <th><div><?php echo 'Período.'; ?></div></th>
                                <th><div><?php echo 'Disciplina'; ?></div></th>

                                <th><div><?php echo 'opções'; ?></div></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    $sql = "SELECT `professor_id`, `nome`, `disc_tx_descricao`, `tur_tx_descricao`, `turma`.`ano` as ano,
                                            `turma`.`semestre` as semestre, `turno`.`descricao`, `cur_tx_abreviatura`, `periodo`, `mat_tx_ano`, `periodo_letivo`,
                                            `mat_tx_semestre`,`professor_curso`.`pc_nb_codigo` as prof_curso,`professor_disciplina_turma`.`pdt_nb_codigo` as pdt_id
                                            FROM (`professor`)
                                            JOIN `professor_curso` ON `professor_curso`.`prof_nb_codigo` = `professor`.`professor_id`
                                            JOIN `professor_disciplina_turma` ON `professor_disciplina_turma`.`pc_nb_codigo` = `professor_curso`.`pc_nb_codigo`
                                            JOIN `disciplina` ON `disciplina`.`disciplina_id` = `professor_disciplina_turma`.`disc_nb_codigo`
                                            JOIN `turma` ON `turma`.`turma_id` = `professor_disciplina_turma`.`tur_nb_codigo`
                                            JOIN `turno` ON `turno`.`turno_id` = `turma`.`turno_id`
                                            left JOIN `periodo_letivo` ON `periodo_letivo`.`periodo_letivo_id` = `turma`.`periodo_letivo_id`
                                            JOIN `cursos` ON `cursos`.`cursos_id` = `turma`.`curso_id`
                                            JOIN `matriz` ON `matriz`.`matriz_id` = `turma`.`matriz_id`
                                            JOIN `matriz_disciplina` ON `matriz_disciplina`.`disciplina_id` = `disciplina`.`disciplina_id`
                                            WHERE `professor`.`professor_id` = '$professor_id' order by periodo_letivo desc, ano desc ";
                                                   // echo  $sql;
                                                    $MatrizArray = $this->db->query($sql)->result_array();
                                                    $count = 1;
                                                    foreach ($MatrizArray as $row):
                                        $periodo = $row['periodo'];
                                        $professor_id2 = $row['professor_id'];
                                        $periodo_letivo = $row['periodo_letivo'];
                                        if ($periodo_letivo) {
                                            $periodo_letivo = $row['periodo_letivo'];
                                        } else {
                                            $periodo_letivo = $row['ano'] . '/' . $row['semestre'];
                                        }
                                        $pc_id = $row['prof_curso'];
                                        $pdt_id = $row['pdt_id'];
                                        
                                        if ($periodo == '1') {
                                            $periodo2 = 'I';
                                        } else if ($periodo == '2') {
                                            $periodo2 = 'II';
                                        } else if ($periodo == '3') {
                                            $periodo2 = 'III';
                                        } else if ($periodo == '4') {
                                            $periodo2 = 'IV';
                                        } else if ($periodo == '5') {
                                            $periodo2 = 'V';
                                        } else if ($periodo == '6') {
                                            $periodo2 = 'VI';
                                        } else if ($periodo == '7') {
                                            $periodo2 = 'VII';
                                        } else if ($periodo == '8') {
                                            $periodo2 = 'VIII';
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td ><?php echo $periodo_letivo; ?></td>
                                            <td><?php echo $row['cur_tx_abreviatura']; ?></td>
                                            <td><?php echo $row['tur_tx_descricao']; ?> - <?php echo $row['descricao']; ?></td> 
                                            
                                            <td><?php echo $periodo2; ?></td>
                                            <td><?php echo $row['disc_tx_descricao']; ?></td>
                                            <td align="center">
                                                <a data-toggle="modal" href="#modal-form" onclick="modal('editar_disciplina',<?php echo $row['matriz_disciplina_id']; ?>)"	class="btn btn-green btn-small">
                                                    <i class="icon-print"></i> <?php echo 'p._ensino'; ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-form" onclick="modal('editar_disciplina',<?php echo $row['matriz_disciplina_id']; ?>)"	class="btn btn-green btn-small">
                                                    <i class="icon-print"></i> <?php echo 'p._aula'; ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-form" onclick="modal('editar_disciplina',<?php echo $row['matriz_disciplina_id']; ?>)"	class="btn btn-info btn-small">
                                                    <i class="icon-print"></i> <?php echo 'mapa_nota'; ?>
                                                </a>
                                                
                                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?educacional/professor_disciplina/delete/<?php echo $professor_id2; ?>/<?php echo $pc_id; ?>/<?php echo $pdt_id; ?>')"
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
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('educacional/professor_disciplina/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <form method="post" action="<?php echo base_url(); ?>index.php?educacional/professor_disciplina/create/" class="form-horizontal validatable" enctype="multipart/form-data">
                        <input type="hidden" class="validate[required]"  name="cod_professor" value="<?php echo $professor_id; ?>"/>

                        <div class="padded">
                            <table width="100%" border="0" class="responsive">
                                <tbody>                                    
                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'Curso'; ?></label>
                                                <div class="controls">
                                                    <?php $curso_turma = $this->crud_model->get_curso_turma(); ?>
                                                    <select id="curso" style='width: 350px;' name="curso" onchange="buscar_periodo_letivo();">
                                                        <option value="0">Selecione um curso</option>
                                                        <?php foreach ($curso_turma as $row):
                                                            ?>
                                                            <option value="<?php echo $row['cursos_id'] ?>"><?php echo $row['cur_tx_descricao']; ?> </option>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'Período Letivo'; ?></label>
                                                <div class="controls">
                                                    <div  id="load_periodo_letivo_pd">
                                                        <select name="periodo_letivo" style='width: 350px;' id="periodo_letivo">
                                                            <option value="0">Selecione um Curso</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'Turma'; ?></label>

                                                <div class="controls" id="load_turma_pd">
                                                    <select style='width: 350px;' name="turma" id="turma" >
                                                        <option value="">Selecione a turma</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>




                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'disciplina'; ?></label>
                                                <div class="controls" id="load_disciplina_pd">
                                                    <select style='width: 350px;' name="disciplina" id="disciplina" >
                                                        <option value="">Selecione a disciplina</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>


                                    </tr>



                                </tbody>
                            </table>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo 'cadastrar_disciplina_para_o_professor'; ?></button>
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

    $("#imgInp").change(function () {
        readURL(this);
    });


    function buscar_turma() {
        var curso = $('#curso').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (curso) {
            var url = 'index.php?educacional/carrega_turma_professor_disciplina/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_turma_pd').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }
    
        function buscar_periodo_letivo() {
        var curso = $('#curso').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (curso) {
            var url = 'index.php?educacional/carrega_periodo_letivo_pd/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_periodo_letivo_pd').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

    function buscar_disciplina_pd() {
        var curso = $('#curso').val();
        var turma = $('#turma').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (turma) {

            var url = 'index.php?educacional/carrega_disciplina_pd/' + turma  + '/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_disciplina_pd').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

</script>