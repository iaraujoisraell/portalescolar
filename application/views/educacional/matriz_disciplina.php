<div class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <?php
            $codigo_curso = '';
            $count = 1;
            foreach ($matriz as $row1):
                $codigo_curso = $row1['cursos_id'];
                ?>


                <li class="active">
                    <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                        <?php echo 'Matriz :' . $row1['cur_tx_abreviatura'] . '-' . $row1['mat_tx_ano'] . '/' . $row1['mat_tx_semestre']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
            <li>
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo 'nova_disciplina'; ?>
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
                        <a href="#" title="Users">
                            <?php
                            $count = 1;
                            $codigo_matriz = '';
                            foreach ($matriz as $row1):
                                $codigo_matriz = $row1['matriz_id'];
                                ?>
                                <h3><?php echo $row1['cur_tx_descricao']; ?> - <?php echo $row1['mat_tx_ano']; ?>/<?php echo $row1['mat_tx_semestre']; ?></h3>
                            <?php endforeach; ?>
                            <?php foreach ($disciplina as $row): ?>
                            <?php endforeach; ?>
                            <span>Total <?php echo count($disciplina); ?> Disciplina(s)</span>
                            
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
                                <th><div><?php echo 'Cód.Disc.'; ?></div></th>
                                <th><div><?php echo 'Disciplina'; ?></div></th>
                                <th><div><?php echo 'C.H.'; ?></div></th>
                                <th><div><?php echo 'CR'; ?></div></th>
                                <th><div><?php echo 'Período'; ?></div></th>
                                <th><div><?php echo 'opções'; ?></div></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($disciplina as $row):
                                        $periodo = $row['periodo'];
                                   
                                        if($periodo == '1'){
                                            $periodo2 = 'I';
                                        }else if($periodo == '2'){
                                            $periodo2 = 'II';
                                        }else if($periodo == '3'){
                                            $periodo2 = 'III';
                                        }else if($periodo == '4'){
                                            $periodo2 = 'IV';
                                        }else if($periodo == '5'){
                                            $periodo2 = 'V';
                                        }else if($periodo == '6'){
                                            $periodo2 = 'VI';
                                        }else if($periodo == '7'){
                                            $periodo2 = 'VII';
                                        }else if($periodo == '8'){
                                            $periodo2 = 'VIII';
                                        }
                                    
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td ><?php echo $row['disc_tx_abrev']; ?></td>
                                            <td><?php echo $row['disc_tx_descricao']; ?></td>
                                            <td><?php echo $row['carga_horaria']; ?></td>
                                            <td><?php echo $row['credito']; ?></td>
                                            <td><?php echo $periodo2; ?></td>
                                            <td align="center">
                                                <a data-toggle="modal" href="#modal-form" onclick="modal('editar_disciplina',<?php echo $row['matriz_disciplina_id']; ?>)"	class="btn btn-gray btn-small">
                                                    <i class="icon-wrench"></i> <?php echo 'editar'; ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?educacional/matriz_disciplina/delete/<?php echo $row['matriz_disciplina_id']; ?>/<?php echo $row['disciplina_id']; ?>/<?php echo $row['matriz_id']; ?>')"
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
                    <?php echo form_open('educacional/matriz_disciplina/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <form method="post" action="<?php echo base_url(); ?>index.php?educacional/matriz_disciplina/create/" class="form-horizontal validatable" enctype="multipart/form-data">
                        <input type="hidden" class="validate[required]"  name="cod_matriz" value="<?php echo $codigo_matriz; ?>"/>
                        <input type="hidden" class="validate[required]"  name="cod_curso" value="<?php echo $codigo_curso; ?>"/>
                    
                        <div class="padded">
                            <table width="100%" border="0" class="responsive">
                                <tbody>                                    
                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'Cód. Disciplina'; ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]"  name="abreviatura"/>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'Disciplina'; ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]"  name="disciplina"/>
                                                </div>
                                            </div>

                                        </td>


                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'Carga_Horária'; ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" onKeyPress="mascara(this,soNumeros)" name="carga_horaria"/>
                                                </div>
                                            </div>

                                        </td>


                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'Crédito'; ?></label>
                                                <div class="controls">
                                                    <input  type="text" name="credito"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo 'Período'; ?></label>
                                                <div class="controls">
                                                    <select class="validate[required]" style="text-transform: uppercase;border-radius:5px;" name="periodo">
                                                        <option value="1">I Período</option>
                                                        <option value="2">II Período</option>
                                                        <option value="3">III Período</option>
                                                        <option value="4">IV Período</option>
                                                        <option value="5">V Período</option>
                                                        <option value="6">VI Período</option>
                                                        <option value="7">VII Período</option>
                                                        <option value="8">VIII Período</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>



                                </tbody>
                            </table>

                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo 'criar_disciplina'; ?></button>
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
</script>