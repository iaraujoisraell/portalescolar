<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of biblioteca
 *
 * @author Karol Oliveira
 */
class financeiro extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function pagamentos($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {

            $data['tur_tx_descricao'] = $this->input->post('descricao');
            $data['status'] = $this->input->post('status');
            $data['periodo_letivo_id'] = $this->input->post('periodo_letivo');
            $data['matriz_id'] = $this->input->post('matriz');
            $data['periodo_id'] = $this->input->post('periodo');
            $data['turno_id'] = $this->input->post('turno');

            $this->db->insert('turma', $data);
            $this->session->set_flashdata('flash_message', get_phrase('turma_cadastrada_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/turma/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            $data['birthday'] = $this->input->post('birthday');
            $data['sex'] = $this->input->post('sex');
            $data['address'] = $this->input->post('address');
            $data['phone'] = $this->input->post('phone');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');

            $this->db->where('teacher_id', $param2);
            $this->db->update('teacher', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg');
            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
        } else if ($param1 == 'personal_profile') {
            $page_data['personal_profile'] = true;
            $page_data['current_teacher_id'] = $param2;
        } else if ($param1 == 'pagamentos') {

            $page_data['edit_matriz'] = $this->db->select("* ");
            $page_data['edit_matriz'] = $this->db->join('cursos', 'cursos.cursos_id = matriz.cursos_id');

            $page_data['edit_matriz'] = $this->db->get_where('matriz', array('matriz_id' => $param2
                    ))->result_array();
            redirect(base_url() . 'index.php?financeiro/mensalidades/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('periodo_letivo_id', $param2);
            $this->db->delete('periodo_letivo');

            $this->session->set_flashdata('flash_message', get_phrase('turma_deletado_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/periodo/', 'refresh');
        }

        $page_data['turma'] = $this->db->select("*");
        $page_data['turma'] = $this->db->join('matricula_aluno', 'matricula_aluno.cadastro_aluno_id = cadastro_aluno.cadastro_aluno_id');
        $page_data['turma'] = $this->db->join('matricula_aluno_turma', 'matricula_aluno_turma.matricula_aluno_id = matricula_aluno.matricula_aluno_id');
        $page_data['turma'] = $this->db->join('turma', 'turma.turma_id = matricula_aluno_turma.turma_id');
        $page_data['turma'] = $this->db->join('periodo_letivo', 'periodo_letivo.periodo_letivo_id = turma.periodo_letivo_id');
        $page_data['turma'] = $this->db->join('cursos', 'cursos.cursos_id = matricula_aluno.curso_id');
        $page_data['turma'] = $this->db->join('turno', 'turno.turno_id = turma.turno_id');
        $page_data['turma'] = $this->db->get_where('cadastro_aluno')->result_array();


        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
        $page_data['page_name'] = 'pagamentos';
        $page_data['page_title'] = get_phrase('Educacional->');
        $this->load->view('../views/financeiro/index', $page_data);
    }

    function mensalidades($param1 = '', $param2 = '', $param3 = '', $param4 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            $data['birthday'] = $this->input->post('birthday');
            $data['sex'] = $this->input->post('sex');
            $data['address'] = $this->input->post('address');
            $data['phone'] = $this->input->post('phone');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');

            $this->db->where('teacher_id', $param2);
            $this->db->update('teacher', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg');
            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
            
        } else if ($param1 == 'salvar_pagamento') {
            
            $data['data_pagamento'] = $this->input->post('data_pagamento');
            $Valor_pagamento = str_replace(',', '.', str_replace('.', '', $this->input->post('valor_pagamento')));
            $data['forma_pagamento'] = $this->input->post('forma_pagamento');
            $desconto = str_replace(',', '.', str_replace('.', '', $this->input->post('desconto')));
            if($desconto==null){
                $desconto='0';
            }
            $data['desconto'] = $desconto;
            $juros = str_replace(',', '.', str_replace('.', '', $this->input->post('juros')));
            if($juros==null){
                $juros='0';
            }
            $data['juros'] = $juros;
           
            $data['status_mensalidades'] = '1';
            $this->db->where('mensalidades_id', $param2);
            $this->db->update('mensalidades', $data);
            
            redirect(base_url() . 'index.php?financeiro/mensalidades/carrega_mensalidades/1/00002', 'refresh');
            
        } else if ($param1 == 'editar_mensalidade') {
             $page_data['edit_data'] = $this->db->select("*");
            $page_data['edit_data'] = $this->db->join('matricula_aluno_turma', 'matricula_aluno_turma.matricula_aluno_turma_id = mensalidades.matricula_aluno_turma_id');
            $page_data['edit_data'] = $this->db->join('turma', 'turma.turma_id = matricula_aluno_turma.turma_id');
            $page_data['edit_data'] = $this->db->join('periodo_letivo', 'periodo_letivo.periodo_letivo_id = turma.periodo_letivo_id');
            $page_data['edit_data'] = $this->db->get_where('mensalidades', array('mensalidades_id' => $param2
                    ))->result_array();
            
        }else if ($param1 == 'pagar') {
             $page_data['edit_data'] = $this->db->select("*");
            $page_data['edit_data'] = $this->db->join('matricula_aluno_turma', 'matricula_aluno_turma.matricula_aluno_turma_id = mensalidades.matricula_aluno_turma_id');
            $page_data['edit_data'] = $this->db->join('turma', 'turma.turma_id = matricula_aluno_turma.turma_id');
            $page_data['edit_data'] = $this->db->join('periodo_letivo', 'periodo_letivo.periodo_letivo_id = turma.periodo_letivo_id');
            $page_data['edit_data'] = $this->db->get_where('mensalidades', array('mensalidades_id' => $param2
                    ))->result_array();  
        }else if ($param1 == 'cancelar_pagamento') {
             $page_data['edit_data'] = $this->db->select("*");
            $page_data['edit_data'] = $this->db->join('matricula_aluno_turma', 'matricula_aluno_turma.matricula_aluno_turma_id = mensalidades.matricula_aluno_turma_id');
            $page_data['edit_data'] = $this->db->join('turma', 'turma.turma_id = matricula_aluno_turma.turma_id');
            $page_data['edit_data'] = $this->db->join('periodo_letivo', 'periodo_letivo.periodo_letivo_id = turma.periodo_letivo_id');
            $page_data['edit_data'] = $this->db->get_where('mensalidades', array('mensalidades_id' => $param2
                    ))->result_array();  
        }else if ($param1 == 'cancela') {
            $data['desconto'] = '';  
            $data['juros'] = '';           
            $data['status_mensalidades'] = '0';
            $data['data_pagamento'] = '';  
            $data['forma_pagamento'] = ''; 
            $this->db->where('mensalidades_id', $param2);
             $this->db->update('mensalidades', $data);
            $this->session->set_flashdata('flash_message', get_phrase('mensalidade_cancelada_com_sucesso'));
             redirect(base_url() . 'index.php?financeiro/mensalidades/carrega_mensalidades/1/00002', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('mensalidades_id', $param2);
            $this->db->delete('mensalidades');
            $this->session->set_flashdata('flash_message', get_phrase('mensalidade_deletada_com_sucesso'));
          redirect(base_url() . 'index.php?financeiro/mensalidades/carrega_mensalidades/1/00002', 'refresh');
        }
        
        if ($param1 == 'carrega_mensalidades') {

            $page_data['aluno'] = $this->db->select("*");
            $page_data['aluno'] = $this->db->join('matricula_aluno', 'matricula_aluno.cadastro_aluno_id = cadastro_aluno.cadastro_aluno_id');
            $page_data['aluno'] = $this->db->join('cursos', 'cursos.cursos_id = matricula_aluno.curso_id');
            $page_data['aluno'] = $this->db->get_where('cadastro_aluno', array('cadastro_aluno.cadastro_aluno_id' => $param2
                    ))->result_array();


            $page_data['mensalidade'] = $this->db->select("*");
            $page_data['mensalidade'] = $this->db->join('matricula_aluno_turma', 'matricula_aluno_turma.matricula_aluno_turma_id = mensalidades.matricula_aluno_turma_id');
            $page_data['mensalidade'] = $this->db->join('turma', 'turma.turma_id = matricula_aluno_turma.turma_id');
            $page_data['mensalidade'] = $this->db->join('periodo_letivo', 'periodo_letivo.periodo_letivo_id = turma.periodo_letivo_id');
             $page_data['mensalidade'] = $this->db->get_where('mensalidades', array('matricula_aluno_turma.matricula_aluno_turma_id' => $param3
                    ))->result_array();
        }






        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
        $page_data['page_name'] = 'mensalidades';
        $page_data['page_title'] = get_phrase('<a href="index.php?admin/dashboard">Home</a> > <a href="index.php?admin/educacional">Educacional </a><b>></b> <a href="index.php?educacional/matriz">Gerenciar_matriz_curricular</a><b> > </b> <a href="">Disciplinas</a>');
        $this->load->view('../views/financeiro/index', $page_data);
    }

}
