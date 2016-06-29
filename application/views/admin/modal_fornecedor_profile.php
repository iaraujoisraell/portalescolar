<?php
$fornecedor_info = $this->crud_model->get_fornecedor_info($current_for_nb_codigo);
foreach ($fornecedor_info as $row):
    ?>
    <center>
        <div class="box">
            <div class="">
                <div class="title">
                    <div style="float:left;width:370px;height:147px;text-align:left;position:relative; margin-bottom:20px;">
                        <div class="avatar" style="position:absolute;bottom:0px;left:20px;">
                            <img src="<?php echo $this->crud_model->get_image_url('teacher', $row['teacher_id']); ?>" 
                                 class="avatar-big" style="max-height:130px;max-width:130px;" />
                        </div>
                        <div  style="position:absolute; bottom:10px;left:150px;">
                            <h3 style=" color:#666;font-weight:100;"><?php echo $row['name']; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <table class="table table-normal">

                <?php if ($row['for_tx_razao_social'] != ''): ?>
                    <tr>
                        <td width="150">Razão Social</td>
                        <td><b><?php echo $row['for_tx_razao_social']; ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['for_tx_fone'] != ''): ?>
                    <tr>
                        <td>Telefone</td>
                        <td><b><?php echo $row['for_tx_fone']; ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['for_tx_celular'] != ''): ?>
                    <tr>
                        <td>Celular</td>
                        <td><b><?php echo $row['for_tx_celular']; ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['for_tx_endereco'] != ''): ?>
                    <tr>
                        <td>Endereço</td>
                        <td><b><?php echo $row['for_tx_endereco']; ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['for_tx_bairro'] != ''): ?>
                    <tr>
                        <td>Bairro</td>
                        <td><b><?php echo $row['for_tx_bairro']; ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['for_tx_cidade'] != ''): ?>
                    <tr>
                        <td>Cidade</td>
                        <td><b><?php echo $row['for_tx_cidade']; ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['for_tx_cidade'] != ''): ?>
                    <tr>
                        <td>Cidade</td>
                        <td><b><?php echo $row['for_tx_cidade']; ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['for_tx_cidade'] != ''): ?>
                    <tr>
                        <td>Cidade</td>
                        <td><b><?php echo $row['for_tx_cidade']; ?></b></td>
                    </tr>
                <?php endif; ?>
            </table>
    </center>

<?php endforeach; ?>