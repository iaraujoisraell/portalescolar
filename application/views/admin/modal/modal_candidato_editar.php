<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php
        foreach ($edit_data as $row):
            $opcao1 = $row['can_tx_op01'];
            $opcao2 = $row['can_tx_op02'];

            $turno1 = $row['can_tx_turno01'];
            if ($turno1 == 1) {
                $txturno1 = 'Matutino';
            } else if ($turno1 == 3) {
                $txturno1 = 'Noturno';
            }

            $turno2 = $row['can_tx_turno02'];
            if ($turno2 == 1) {
                $txturno2 = 'Matutino';
            } else if ($turno2 == 2) {
                $txturno2 = 'Noturno';
            }

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
            <?php echo form_open('admin/candidato/do_update/' . $row['candidato_id'], array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Nome'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['nome']; ?>"  name="nome"/>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Telefone'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['can_tx_celular']; ?>"  name="celular"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('E-mail'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['can_tx_email']; ?>" name="email"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('CPF'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['can_tx_cpf']; ?>" name="cpf"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Como ficou sabendo do vestibular?'); ?></label>
                    <div class="controls">
                        <SELECT style="font-family:Arial;font-size:12pt;"  NAME="referencia">
                            <?php
                            $referencia = $row['can_nb_referencia'];

                            if ($referencia == 1) {
                                $referencia_tx = 'Amigo';
                            } else if ($referencia == 2) {
                                $referencia_tx = 'TV';
                            } else if ($referencia == 3) {
                                $referencia_tx = 'Rádio';
                            } else if ($referencia == 4) {
                                $referencia_tx = 'Jornal';
                            } else if ($referencia == 5) {
                                $referencia_tx = 'Panfletos';
                            } else if ($referencia == 6) {
                                $referencia_tx = 'Internet';
                            } else if ($referencia == 7) {
                                $referencia_tx = 'Redes Sociais';
                            } else if ($referencia == 8) {
                                $referencia_tx = 'Outro(s)';
                            } else if ($referencia == 9) {
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

                        <SELECT style="font-family:Arial;" NAME="vestibular">
                             <OPTION value="<?php echo $row['vest_nb_codigo']; ?>" ><?php echo date('d/m/Y', strtotime($row['vest_dt_realizacao'])); ?></OPTION>
                            <?php
                            $count = 1;
                            foreach ($vestibular as $vestibular):
                                ?>
                                <OPTION value="<?php echo $vestibular['vestibular_id']; ?>"> <?php echo date('d/m/Y', strtotime($vestibular['vest_dt_realizacao'])); ?></OPTION>
                                <?php
                            endforeach;
                            ?>
                        </SELECT>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('1a. Opção'); ?></label>
                    <div class="controls">
                        <SELECT  class="input" style="font-family:Arial;"  NAME="txOp01">
                            <OPTION  value="<?php echo $opcao1; ?>" ><?php echo $txopcao1; ?></OPTION>
                            <OPTION value="1"  > Bacharelado em Ci&ecirc;ncias Teol&oacute;gicas</OPTION>
                            <OPTION value="2" >Licenciatura em Pedagogia</OPTION>
                            <OPTION value="3" >Bacharelado em Administra&ccedil;&atilde;o</OPTION>
                            <OPTION value="4" >Bacharelado Comunica&ccedil;&atilde;o Social com habilita&ccedil;&atilde;o em Jornalismo</OPTION>
                            <OPTION value="5" >Bacharelado em Comunica&ccedil;&atilde;o Social com habilita&ccedil;&atilde;o em Publicidade e Propaganda</OPTION>
                        </SELECT>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Turno'); ?></label>
                    <div class="controls">
                        <SELECT style="font-family:Arial;" NAME="txturOp01">
                            <OPTION value="<?php echo $turno1; ?>" ><?php echo $txturno1; ?></OPTION>
                            <OPTION value="1"> Matutino</OPTION>
                            <OPTION value="3">Noturno</OPTION>
                        </SELECT>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('2a. Opção'); ?></label>
                    <div class="controls">
                        <SELECT class="input" style="font-family:Arial;" NAME="txOp02">
                            <OPTION  value="<?php echo $opcao1; ?>" ><?php echo $txopcao2; ?></OPTION>
                            <OPTION value="1" > Bacharelado em Ci&ecirc;ncias Teol&oacute;gicas</OPTION>
                            <OPTION value="2" >Licenciatura em Pedagogia</OPTION>
                            <OPTION value="3" >Bacharelado em Administra&ccedil;&atilde;o</OPTION>
                            <OPTION value="4" >Bacharelado Comunica&ccedil;&atilde;o Social com habilita&ccedil;&atilde;o em Jornalismo</OPTION>
                            <OPTION value="5" >Bacharelado em Comunica&ccedil;&atilde;o Social com habilita&ccedil;&atilde;o em Publicidade e Propaganda</OPTION>
                        </SELECT>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Turno'); ?></label>
                    <div class="controls">
                        <SELECT style="font-family:Arial;"  NAME="txturOp02">
                            <OPTION value="<?php echo $turno2; ?>" ><?php echo $txturno2; ?></OPTION>
                            <OPTION value="1"> Matutino</OPTION>
                            <OPTION value="3">Noturno</OPTION>
                        </SELECT>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Habilidade Manual'); ?></label>
                    <div class="controls">
                        <SELECT class="input" style="font-family:Arial;" NAME="txMao">
                            <OPTION value="<?php echo $mao; ?>" ><?php echo $txmao; ?></OPTION>
                            <OPTION value="1">Destro</OPTION>
                            <OPTION value="2">Canhoto</OPTION>
                        </SELECT>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Necessidades Especiais?'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['can_tx_necessidade']; ?>" name="necessidade"/>
                        <input type="hidden" value="1"  name="instituicao"/>
                    </div>
                </div>

            </div>


            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo get_phrase('editar_candidato'); ?></button>
            </div>
            </form>
        <?php endforeach; ?>
    </div>
</div>