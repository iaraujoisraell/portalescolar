<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach ($professor as $row): 
            echo 'ID : '.$row['professor_id'];
            $sexo = $row['sexo'];
            if($sexo=='F'){
                $sexo_tx = 'FEMININO';
            }else if($sexo=='M'){
                $sexo_tx = 'MASCULINO';
            }
            
            
            $situacao = $row['situacao'];
            if($situacao =='A'){
                $situacao_tx = 'ATIVO';
            }else if($situacao == 'I'){
                $situacao_tx = 'INATIVO';
            }
            ?>
            <?php echo form_open('educacional/professor/do_update/' . $row['professor_id'], array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Nome'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['nome']; ?>"  name="nome"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Data Nascimento'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo date("d/m/Y", strtotime($row['nascimento'])); ?>"  name="nascimento"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Sexo'); ?></label>
                    <div class="controls">
                        <select name="sexo" class="input" style="height: 30px; width: 200px;">
                            <option value="<?php echo $sexo; ?>"><?php echo $sexo_tx; ?></option>
                            <option value="M"><?php echo get_phrase('Masculino'); ?></option>
                            <option value="F"><?php echo get_phrase('feminino'); ?></option>
                       </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Endereço'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['endereco']; ?>" name="endereco"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Bairro'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['bairro']; ?>"  name="bairro"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('CEP'); ?></label>
                    <div class="controls">

                        <input type="text" value="<?php echo $row['cep']; ?>"  class="validate[required]" name="cep"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Cidade'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['cidade']; ?>" name="cidade"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('UF'); ?></label>
                    <div class="controls">
                        <input type="text"  value="<?php echo $row['uf']; ?>" name="uf"/>
                      
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('email'); ?></label>
                    <div class="controls">
                        <input type="text"  value="<?php echo $row['email']; ?>" name="email"/>
                        
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Situação'); ?></label>
                    <div class="controls">
                      
                        <select name="situacao" required class="input" style="height: 30px; width: 200px;">
                         <option value="<?php echo $situacao; ?>"><?php echo $situacao_tx; ?></option>
                                        <option value="A"><?php echo get_phrase('Ativo'); ?></option>
                                        <option value="I"><?php echo get_phrase('Inativo'); ?></option>
                                    </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('login'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['login']; ?>" name="login"/>
                      
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Senha'); ?></label>
                    <div class="controls">
                        <input type="password" class="validate[required]" value="<?php echo $row['senha']; ?>" name="senha"/>
                     
                    </div>
                </div>

            </div>


            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo get_phrase('editar_Professor'); ?></button>
            </div>
            </form>
        <?php endforeach; ?>
    </div>
</div>