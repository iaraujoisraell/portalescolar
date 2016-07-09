<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php
        foreach ($edit_data as $row):
            $opcao1 = $row['can_tx_op01'];
            $opcao2 = $row['can_tx_op02'];

            $mao = $row['can_tx_mao'];

            if ($mao == 1) {
                $txmao = 'Destro';
            } else if ($mao == 2) {
                $txmao = 'Canhoto';
            }

            if ($opcao1 == 1) {
                $txopcao1 = 'Bacharelado em Ci&ecirc;ncias Teol&oacute;gicas';
            } else if ($opcao1 == 2) {
                $txopcao1 = 'Licenciatura em Pedagogia';
            } else if ($opcao1 == 3) {
                $txopcao1 = 'Bacharelado em Administra&ccedil;&atilde;o';
            } else if ($opcao1 == 4) {
                $txopcao1 = 'Bacharelado Comunica&ccedil;&atilde;o Social com habilita&ccedil;&atilde;o em Jornalismo';
            } else if ($opcao1 == 5) {
                $txopcao1 = 'Bacharelado em Comunica&ccedil;&atilde;o Social com habilita&ccedil;&atilde;o em Publicidade e Propaganda';
            }


            if ($opcao2 == 1) {
                $txopcao2 = 'Bacharelado em Ci&ecirc;ncias Teol&oacute;gicas';
            } else if ($opcao2 == 2) {
                $txopcao2 = 'Licenciatura em Pedagogia';
            } else if ($opcao2 == 3) {
                $txopcao2 = 'Bacharelado em Administra&ccedil;&atilde;o';
            } else if ($opcao2 == 4) {
                $txopcao2 = 'Bacharelado Comunica&ccedil;&atilde;o Social com habilita&ccedil;&atilde;o em Jornalismo';
            } else if ($opcao2 == 5) {
                $txopcao2 = 'Bacharelado em Comunica&ccedil;&atilde;o Social com habilita&ccedil;&atilde;o em Publicidade e Propaganda';
            }
            ?>
            <?php echo form_open('educacional/cursos/do_update/' . $row['cursos_id'], array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Nome'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['nome']; ?>"  name="curso"/>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Telefone'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['can_tx_celular']; ?>"  name="abreviatura"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('E-mail'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['can_tx_email']; ?>" name="habilidade"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('CPF'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['can_tx_cpf']; ?>" name="estagio"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Como ficou sabendo do vestibular?'); ?></label>
                    <div class="controls">
                        <SELECT style="font-family:Arial;font-size:12pt;"  NAME="txinformacao">
                            <?php 
                                $referencia = $row['can_nb_referencia'];
                                
                                   if($referencia==1){
                                      $referencia_tx = 'Amigo'; 
                                   }else if($referencia==2){
                                       $referencia_tx = 'TV';
                                   }else if($referencia==3){
                                       $referencia_tx = 'Rádio';
                                   }else if($referencia==4){
                                       $referencia_tx = 'Jornal';
                                   }else if($referencia==5){
                                       $referencia_tx = 'Panfletos';
                                   }else if($referencia==6){
                                       $referencia_tx = 'Internet';
                                   }else if($referencia==7){
                                       $referencia_tx = 'Redes Sociais';
                                   }else if($referencia==8){
                                       $referencia_tx = 'Outro(s)';
                                   }else if($referencia==9){
                                       $referencia_tx = 'Convênio(s)';
                                   }
                                   
                                   
                            ?>
                            <OPTION value="<?php echo $referencia; ?>" ><?php echo $referencia_tx; ?></OPTION>
                            <OPTION value="1" >Amigo</OPTION>
                            <OPTION value="2" >TV</OPTION>
                            <OPTION value="3">Rádio</OPTION>
                            <OPTION value="4">Jornal</OPTION>
                            <OPTION value="5">Panfletos</OPTION>
                            <OPTION value="6">Internet</OPTION>
                            <OPTION value="7" >Redes Sociais(Facebook, Twitter e Instagram)</OPTION>
                            <OPTION value="9" >Convênio(s)</OPTION>
                            <OPTION value="8" >Outro(s)</OPTION>
                        </SELECT>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Vestibular Inscrito:'); ?></label>
                    <div class="controls">

                        <input type="text" value="<?php echo date('d/m/Y', strtotime($row['vest_dt_realizacao'])); ?>"  class="validate[required]" name="duracao"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('1a. Opção'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $txopcao1; ?>" name="coordenador"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('2a. Opção'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" placeholder="R$ 0.000,00" onKeyPress="return(MascaraMoeda1(this, '.', ',', event))" value="<?php echo $txopcao2; ?>" name="valor"/>
                        <input type="hidden" value="1"  name="instituicao"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Habilidade Manual'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]"   value="<?php echo $txmao; ?>" name="valor"/>
                        <input type="hidden" value="1"  name="instituicao"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Necessidades Especiais?'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]"   value="<?php echo $row['can_tx_necessidade'];
        ; ?>" name="valor"/>
                        <input type="hidden" value="1"  name="instituicao"/>
                    </div>
                </div>

            </div>


            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo get_phrase('editar_curso'); ?></button>
            </div>
            </form>
<?php endforeach; ?>
    </div>
</div>