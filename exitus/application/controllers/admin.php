 <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
    }

    /*     * *ADMIN DASHBOARD** */

    function dashboard() {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['acesso'] = $this->db->get('acessos')->result_array();
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('painel_administrativo');
        $this->carregaModulos();
        $this->load->view('index', $page_data);
    }

/* * ********MANAGING CLASS ROUTINE***************** */

function class_routine($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['class_id'] = $this->input->post('class_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['time_start'] = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
        $data['time_end'] = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
        $data['day'] = $this->input->post('day');
        $this->db->insert('class_routine', $data);
        redirect(base_url() . 'index.php?admin/class_routine/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['class_id'] = $this->input->post('class_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['time_start'] = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
        $data['time_end'] = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
        $data['day'] = $this->input->post('day');

        $this->db->where('class_routine_id', $param2);
        $this->db->update('class_routine', $data);
        redirect(base_url() . 'index.php?admin/class_routine/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('class_routine', array(
                    'class_routine_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('class_routine_id', $param2);
        $this->db->delete('class_routine');
        redirect(base_url() . 'index.php?admin/class_routine/', 'refresh');
    }
    $page_data['page_name'] = 'class_routine';
    $page_data['page_title'] = get_phrase('manage_class_routine');
    $this->load->view('index', $page_data);
}

/* * ****MANAGE BILLING / INVOICES WITH STATUS**** */

function invoice($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if ($param1 == 'create') {
        $data['student_id'] = $this->input->post('student_id');
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['amount'] = $this->input->post('amount');
        $data['status'] = $this->input->post('status');
        $data['creation_timestamp'] = strtotime($this->input->post('date'));

        $this->db->insert('invoice', $data);
        redirect(base_url() . 'index.php?admin/invoice', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['student_id'] = $this->input->post('student_id');
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['amount'] = $this->input->post('amount');
        $data['status'] = $this->input->post('status');
        $data['creation_timestamp'] = strtotime($this->input->post('date'));

        $this->db->where('invoice_id', $param2);
        $this->db->update('invoice', $data);
        redirect(base_url() . 'index.php?admin/invoice', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('invoice', array(
                    'invoice_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('invoice_id', $param2);
        $this->db->delete('invoice');
        redirect(base_url() . 'index.php?admin/invoice', 'refresh');
    }
    $page_data['page_name'] = 'invoice';
    $page_data['page_title'] = get_phrase('manage_invoice/payment');
    $this->db->order_by('creation_timestamp', 'desc');
    $page_data['invoices'] = $this->db->get('invoice')->result_array();
    $this->load->view('index', $page_data);
}

/* * ********MANAGE LIBRARY / BOOKS******************* */

function book($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['description'] = $this->input->post('description');
        $data['price'] = $this->input->post('price');
        $data['author'] = $this->input->post('author');
        $data['class_id'] = $this->input->post('class_id');
        $data['status'] = $this->input->post('status');
        $this->db->insert('book', $data);
        redirect(base_url() . 'index.php?admin/book', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] = $this->input->post('name');
        $data['description'] = $this->input->post('description');
        $data['price'] = $this->input->post('price');
        $data['author'] = $this->input->post('author');
        $data['class_id'] = $this->input->post('class_id');
        $data['status'] = $this->input->post('status');

        $this->db->where('book_id', $param2);
        $this->db->update('book', $data);
        redirect(base_url() . 'index.php?admin/book', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('book', array(
                    'book_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('book_id', $param2);
        $this->db->delete('book');
        redirect(base_url() . 'index.php?admin/book', 'refresh');
    }
    $page_data['books'] = $this->db->get('book')->result_array();
    $page_data['page_name'] = 'book';
    $page_data['page_title'] = get_phrase('manage_library_books');
    $this->load->view('index', $page_data);
}

/* * ********MANAGE TRANSPORT / VEHICLES / ROUTES******************* */

function transport($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['route_name'] = $this->input->post('route_name');
        $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
        $data['description'] = $this->input->post('description');
        $data['route_fare'] = $this->input->post('route_fare');
        $this->db->insert('transport', $data);
        redirect(base_url() . 'index.php?admin/transport', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['route_name'] = $this->input->post('route_name');
        $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
        $data['description'] = $this->input->post('description');
        $data['route_fare'] = $this->input->post('route_fare');

        $this->db->where('transport_id', $param2);
        $this->db->update('transport', $data);
        redirect(base_url() . 'index.php?admin/transport', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('transport', array(
                    'transport_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('transport_id', $param2);
        $this->db->delete('transport');
        redirect(base_url() . 'index.php?admin/transport', 'refresh');
    }
    $page_data['transports'] = $this->db->get('transport')->result_array();
    $page_data['page_name'] = 'transport';
    $page_data['page_title'] = get_phrase('manage_transport');
    $this->load->view('index', $page_data);
}

/* * ********MANAGE DORMITORY / HOSTELS / ROOMS ******************* */

function dormitory($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['number_of_room'] = $this->input->post('number_of_room');
        $data['description'] = $this->input->post('description');
        $this->db->insert('dormitory', $data);
        redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['name'] = $this->input->post('name');
        $data['number_of_room'] = $this->input->post('number_of_room');
        $data['description'] = $this->input->post('description');

        $this->db->where('dormitory_id', $param2);
        $this->db->update('dormitory', $data);
        redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('dormitory', array(
                    'dormitory_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('dormitory_id', $param2);
        $this->db->delete('dormitory');
        redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
    }
    $page_data['dormitories'] = $this->db->get('dormitory')->result_array();
    $page_data['page_name'] = 'dormitory';
    $page_data['page_title'] = get_phrase('manage_dormitory');
    $this->load->view('index', $page_data);
}

/* * *MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD* */

function noticeboard($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if ($param1 == 'create') {
        $data['notice_title'] = $this->input->post('notice_title');
        $data['notice'] = $this->input->post('notice');
        $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
        $this->db->insert('noticeboard', $data);
        redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['notice_title'] = $this->input->post('notice_title');
        $data['notice'] = $this->input->post('notice');
        $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
        $this->db->where('notice_id', $param2);
        $this->db->update('noticeboard', $data);
        $this->session->set_flashdata('flash_message', get_phrase('notice_updated'));
        redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                    'notice_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('notice_id', $param2);
        $this->db->delete('noticeboard');
        redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
    }
    $page_data['page_name'] = 'noticeboard';
    $page_data['page_title'] = get_phrase('manage_noticeboard');
    $page_data['notices'] = $this->db->get('noticeboard')->result_array();
    $this->load->view('index', $page_data);
}

/* * ***SITE/SYSTEM SETTINGS******** */

function system_settings($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url() . 'index.php?login', 'refresh');

    if ($param2 == 'do_update') {
        $this->db->where('type', $param1);
        $this->db->update('settings', array(
            'description' => $this->input->post('description')
        ));
        $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
        redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
    }
    if ($param1 == 'upload_logo') {
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
        $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
        redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
    }
    $page_data['page_name'] = 'system_settings';
    $page_data['page_title'] = get_phrase('system_settings');
    $page_data['settings'] = $this->db->get('settings')->result_array();
    $this->load->view('index', $page_data);
}

/* * ***LANGUAGE SETTINGS******** */

function manage_language($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url() . 'index.php?login', 'refresh');

    if ($param1 == 'edit_phrase') {
        $page_data['edit_profile'] = $param2;
    }
    if ($param1 == 'update_phrase') {
        $language = $param2;
        $total_phrase = $this->input->post('total_phrase');
        for ($i = 1; $i < $total_phrase; $i++) {
//$data[$language]	=	$this->input->post('phrase').$i;
            $this->db->where('phrase_id', $i);
            $this->db->update('language', array($language => $this->input->post('phrase' . $i)));
        }
        redirect(base_url() . 'index.php?admin/manage_language/edit_phrase/' . $language, 'refresh');
    }
    if ($param1 == 'do_update') {
        $language = $this->input->post('language');
        $data[$language] = $this->input->post('phrase');
        $this->db->where('phrase_id', $param2);
        $this->db->update('language', $data);
        $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
        redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
    }
    if ($param1 == 'add_phrase') {
        $data['phrase'] = $this->input->post('phrase');
        $this->db->insert('language', $data);
        $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
        redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
    }
    if ($param1 == 'add_language') {
        $language = $this->input->post('language');
        $this->load->dbforge();
        $fields = array(
            $language => array(
                'type' => 'LONGTEXT'
            )
        );
        $this->dbforge->add_column('language', $fields);

        $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
        redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
    }
    if ($param1 == 'delete_language') {
        $language = $param2;
        $this->load->dbforge();
        $this->dbforge->drop_column('language', $language);
        $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));

        redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
    }
    $page_data['page_name'] = 'manage_language';
    $page_data['page_title'] = get_phrase('manage_language');
//$page_data['language_phrases'] = $this->db->get('language')->result_array();
    $this->load->view('index', $page_data);
}

/* * ***BACKUP / RESTORE / DELETE DATA PAGE********* */

function backup_restore($operation = '', $type = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    if ($operation == 'create') {
        $this->crud_model->create_backup($type);
    }
    if ($operation == 'restore') {
        $this->crud_model->restore_backup();
        $this->session->set_flashdata('backup_message', 'Backup Restored');
        redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
    }
    if ($operation == 'delete') {
        $this->crud_model->truncate($type);
        $this->session->set_flashdata('backup_message', 'Data removed');
        redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
    }

    $page_data['page_info'] = 'Create backup / restore from backup';
    $page_data['page_name'] = 'backup_restore';
    $page_data['page_title'] = get_phrase('manage_backup_restore');
    $this->load->view('index', $page_data);
}

/* * ****MANAGE OWN PROFILE AND CHANGE PASSWORD** */

function manage_profile($param1 = '', $param2 = '', $param3 = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url() . 'index.php?login', 'refresh');
    if ($param1 == 'update_profile_info') {
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');

        $this->db->where('admin_id', $this->session->userdata('admin_id'));
        $this->db->update('admin', $data);
        $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
        redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
    }
    if ($param1 == 'change_password') {
        $data['password'] = $this->input->post('password');
        $data['new_password'] = $this->input->post('new_password');
        $data['confirm_new_password'] = $this->input->post('confirm_new_password');

        $current_password = $this->db->get_where('admin', array(
                    'admin_id' => $this->session->userdata('admin_id')
                ))->row()->password;
        if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
            $this->db->where('admin_id', $this->session->userdata('admin_id'));
            $this->db->update('admin', array(
                'password' => $data['new_password']
            ));
            $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
        } else {
            $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
        }
        redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
    }
    $page_data['page_name'] = 'manage_profile';
    $page_data['page_title'] = get_phrase('manage_profile');
    $page_data['edit_data'] = $this->db->get_where('admin', array(
                'admin_id' => $this->session->userdata('admin_id')
            ))->result_array();
    $this->load->view('index', $page_data);
}

function carregaModulos() {
//pegando id do usuario por sessao.
    $usuarios_id = $this->session->userdata('login');
    $page_data['modulos'] = $this->db->query("select modulos.nome as nome, modulos.modulos_id as id, mod_tx_url_imagem, mod_tx_url, mod_tx_img from usuarios
                                        INNER JOIN perfis  ON usuarios.perfis_id = perfis.perfis_id
                                        INNER JOIN acessos ON perfis.perfis_id = acessos.perfis_id
                                        INNER JOIN menus   ON acessos.menus_id = menus.menus_id
                                        INNER JOIN modulos ON menus.modulos_id = modulos.modulos_id
                                        WHERE usuarios_id = $usuarios_id group by nome")->result_array();
    $this->load->vars($page_data);
}

function financeiro() {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $page_data['acesso'] = $this->db->get('acessos')->result_array();
    $page_data['page_name'] = 'dashboard';
    $page_data['page_title'] = get_phrase('painel_financeiro');
    $this->carregaModulos();
    $this->load->view('financeiro/index', $page_data);
}

function processo() {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $page_data['acesso'] = $this->db->get('acessos')->result_array();
    $page_data['page_name'] = 'dashboard';
    $page_data['nome_modulo'] = 'Processo Seletivo';
    $page_data['page_title'] = get_phrase('painel_processo_seletivo');
    $this->carregaModulos();
    $this->load->view('vestibular/index', $page_data);
}

function educacional() {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $page_data['acesso'] = $this->db->get('acessos')->result_array();
    $page_data['page_name'] = 'dashboard';
    $page_data['nome_modulo'] = 'Educacional';
    $page_data['page_title'] = get_phrase('painel_educacional');
    $this->carregaModulos();
    $this->load->view('educacional/index', $page_data);
}

function biblioteca() {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

    $page_data['acesso'] = $this->db->get('acessos')->result_array();
    $page_data['page_name'] = 'dashboard';
    $page_data['nome_modulo'] = 'Biblioteca';
    $page_data['page_title'] = get_phrase('painel_educacional');
    $this->carregaModulos();
    $this->load->view('biblioteca/index', $page_data);
}

function vestibular($param1 = '', $param2 = '', $param3 = '') {

    function converte_data($data) {

        return implode(!strstr($data, '/') ? "/" : "-", array_reverse(explode(!strstr($data, '/') ? "-" : "/", $data)));
    }

    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['vest_nb_ano'] = $this->input->post('ano');
        $data['vest_dt_realizacao'] = converte_data($this->input->post('data_vestibular'));
        $data['vest_tx_semestre'] = $this->input->post('semestre');
        $data['vest_nb_tipo'] = $this->input->post('tipo');
        $data['vest_dt_inscricao'] = converte_data($this->input->post('data_inscricao'));
        $data['vest_dt_encerramento'] = converte_data($this->input->post('data_encerramento'));
        $data['vest_dt_resultado'] = converte_data($this->input->post('data_resultado'));
        $data['vest_tx_inicio'] = $this->input->post('hora_inicio');
        $data['vest_tx_fim'] = $this->input->post('hora_fim');

        $this->db->insert('vestibular', $data);
        $teacher_id = mysql_insert_id();
        redirect(base_url() . 'index.php?admin/vestibular/', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['vest_nb_ano'] = $this->input->post('ano');
        $data['vest_dt_realizacao'] = converte_data($this->input->post('data_vestibular'));
        $data['vest_tx_semestre'] = $this->input->post('semestre');
        $data['vest_nb_tipo'] = $this->input->post('tipo');
        $data['vest_dt_inscricao'] = converte_data($this->input->post('data_inscricao'));
        $data['vest_dt_encerramento'] = converte_data($this->input->post('data_encerramento'));
        $data['vest_dt_resultado'] = converte_data($this->input->post('data_resultado'));
        $data['vest_tx_inicio'] = $this->input->post('hora_inicio');
        $data['vest_tx_fim'] = $this->input->post('hora_fim');

        $this->db->where('vestibular_id', $param2);
        $this->db->update('vestibular', $data);
      
        redirect(base_url() . 'index.php?admin/vestibular/', 'refresh');
    } else if ($param1 == 'personal_profile') {
        $page_data['personal_profile'] = true;
        $page_data['current_vestibular_id'] = $param2;
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('vestibular', array(
                    'vestibular_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('vestibular_id', $param2);
        $this->db->delete('vestibular');
        redirect(base_url() . 'index.php?admin/vestibular/', 'refresh');
    }
//$page_data['vestibular'] =  $this->db->where('vest_dt_realizacao >= ', date('Y-m-d'));
    $page_data['vestibular'] = $this->db->get('vestibular')->result_array();
    $page_data['page_name'] = 'vestibular';
    $page_data['page_title'] = get_phrase('manage_teacher');
    $this->load->view('vestibular/index', $page_data);
}

function candidato($param1 = '', $param2 = '', $param3 = '') {

    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
 
    if ($param1 == 'do_update') {
        $data['nome'] = $this->input->post('nome');
        $data['can_tx_celular'] = $this->input->post('celular');
        $data['can_tx_email'] = $this->input->post('email');
        $data['can_tx_cpf'] = $this->input->post('cpf');
        $data['can_nb_referencia'] = $this->input->post('referencia');
        $data['can_tx_op01'] = $this->input->post('txOp01');
        $data['can_tx_op02'] = $this->input->post('txOp02');
         $data['can_tx_turno01'] = $this->input->post('txturOp01');
        $data['can_tx_turno02'] = $this->input->post('txturOp02');
        $data['can_tx_mao'] = $this->input->post('txMao');
        $data['can_tx_necessidade'] = $this->input->post('necessidade');
        $data['vest_nb_codigo'] = $this->input->post('vestibular');
        
        $this->db->where('candidato_id', $param2);
        $this->db->update('candidato', $data);
       
        redirect(base_url() . 'index.php?admin/candidato/', 'refresh');
    } else if ($param1 == 'candidato_profile') {
        $page_data['candidato_profile'] = true;
        $page_data['current_candidato_id'] = $param2;
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('candidato', array(
                    'candidato_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('candidato_id', $param2);
        $this->db->delete('candidato');
        redirect(base_url() . 'index.php?admin/candidato/', 'refresh');
    }
$page_data['candidato'] = $this->db->query('SELECT * FROM candidato c
inner join vestibular v on v.vestibular_id = c.vest_nb_codigo
left join chamada_vestibular cv on cv.vest_nb_codigo = vestibular_id and cv.can_nb_codigo = c.candidato_id')->result_array();

    //$page_data['candidato_total'] = $this->db->get('candidato')->result_array();
    $page_data['page_name'] = 'candidato';
    $page_data['page_title'] = get_phrase('gerenciar_candidato');
    $this->load->view('vestibular/index', $page_data);
}

function Chamada($param1 = '', $param2 = '', $param3 = '') {

    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['name'] = $this->input->post('name');
        $data['birthday'] = $this->input->post('birthday');
        $data['sex'] = $this->input->post('sex');
        $data['address'] = $this->input->post('address');
        $data['phone'] = $this->input->post('phone');
        $data['email'] = $this->input->post('email');
        $data['password'] = $this->input->post('password');
        $this->db->insert('teacher', $data);
        $teacher_id = mysql_insert_id();
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');
        $this->email_model->account_opening_email('teacher', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
        redirect(base_url() . 'index.php?admin/Chamada/', 'refresh');
    }

    if ($param1 == 'do_update') {

        $total = $this->input->post('total');

        for ($i = 1; $i <= $total; $i++) {

            $data['can_nb_codigo'] = $this->input->post('candidato' . $i);
            $candidato = $data['can_nb_codigo'];

            $this->db->from('chamada_vestibular');
            $this->db->where('can_nb_codigo', $candidato);
            $numrows = $this->db->count_all_results();

            if ($numrows >= 1) {

                $data['cv_nb_resposta'] = $this->input->post('resposta' . $i);
                $this->db->where('vest_nb_codigo', $param2);
                $this->db->where('can_nb_codigo', $candidato);
                $this->db->update('chamada_vestibular', $data);
            } else {
                $data['cv_nb_resposta'] = $this->input->post('resposta' . $i);
                $data['vest_nb_codigo'] = $this->input->post('vestibular');
                $this->db->insert('chamada_vestibular', $data);
            }
        }
      //  $this->session->set_flashdata('flash_message', get_phrase('chamada_cadastrada_com_sucesso'));
       redirect(base_url() . 'index.php?admin/Chamada/', 'refresh');
    }else if ($param1 == 'do_update_pontuacao') {

        $total = $this->input->post('total');

        for ($i = 1; $i <= $total; $i++) {

            $candidato = $this->input->post('candidato' . $i);
         //   echo 'candidato :'.$candidato;
           // $candidato = $data['can_nb_codigo'];

                $data['cv_tx_ponto_prova'] = $this->input->post('prova'.$i);
                $data['cv_tx_ponto_redacao'] = $this->input->post('redacao'.$i);
                $data['cv_nb_aprovado'] = $this->input->post('resposta' . $i);
                $this->db->where('vest_nb_codigo', $param2);
                $this->db->where('can_nb_codigo', $candidato);
                $this->db->update('chamada_vestibular', $data);
          
        }
     //   $this->session->set_flashdata('flash_message', get_phrase('chamada_cadastrada_com_sucesso'));
     //   redirect(base_url() . 'index.php?admin/Chamada/', 'refresh');
    }        else if ($param1 == 'chamada_vestibular') {
        $page_data['chamada_vestibular'] = true;
        $page_data['current_chamada_vestibular_id'] = $param2;
    } else if ($param1 == 'pontuacao_vestibular') {
        $page_data['pontuacao_vestibular'] = true;
        $page_data['current_pontuacao_vestibular_id'] = $param2;
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('vestibular', array(
                    'vestibular_id' => $param2
                ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('vestibular_id', $param2);
        $this->db->delete('vestibular');
        redirect(base_url() . 'index.php?admin/Chamada/', 'refresh');
    }
//$page_data['vestibular'] =  $this->db->where('vest_dt_realizacao >= ', date('Y-m-d'));
    $page_data['chamadaVest'] = $this->db->query('SELECT concat(vest_nb_ano, "-", vest_tx_semestre) as anoS, vest_dt_realizacao,vestibular_id,
                                                CASE vest_nb_tipo
                                                WHEN 1 THEN "Macro"
                                                WHEN 2 THEN "Agendado"
                                                END tipo_vestibular
                                                FROM vestibular INNER JOIN candidato ON vestibular.vestibular_id = candidato.vest_nb_codigo
                                                GROUP by vestibular_id ORDER BY vest_dt_realizacao DESC, anoS DESC')->result_array();

    $page_data['page_name'] = 'Chamada';
    $page_data['page_title'] = get_phrase('gerenciar_vetibular');
    $this->load->view('vestibular/index', $page_data);
}


function Pontuacao($param1 = '', $param2 = '', $param3 = '') {
     if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
     
      $total = $this->input->post('total');
        echo 'total :'.$total;
       // echo 'vestibular :'.$this->input->post('vestibular');
        $cont = 1;
        for ($i = 1; $i <= $total; $i++) {
            //$data['can_nb_codigo']
            $candidato = $this->input->post('candidato' . $i);
            //$candidato = $data['can_nb_codigo'];
           // echo 'candidato :'.$this->input->post('candidato'.$i);
            echo 'prova'.$i.':'.$this->input->post('prova'.$i);
            
            $this->db->from('chamada_vestibular');
            $this->db->where('can_nb_codigo', $candidato);
            $numrows = $this->db->count_all_results();
         
            if ($numrows >= 1) {
                echo 'AKIII'.$i;
                $data['cv_tx_ponto_prova'] = $this->input->post('prova'.$i);
                $data['cv_tx_ponto_redacao'] = $this->input->post('redacao'.$i);
                $data['cv_nb_aprovado'] = $this->input->post('resposta' . $i);
                $this->db->where('vest_nb_codigo', $param1);
                $this->db->where('can_nb_codigo', $candidato);
                $this->db->update('chamada_vestibular', $data);
            } else {
                $data['cv_tx_ponto_prova'] = $this->input->post('resposta' . $i);
                $data['cv_tx_ponto_redacao'] = $this->input->post('resposta' . $i);
                $data['cv_nb_aprovado'] = $this->input->post('aprovado' . $i);
                $data['vest_nb_codigo'] = $this->input->post('vestibular');
                $this->db->insert('chamada_vestibular', $data);
            }
             $cont++;
        }
       //  $this->session->set_flashdata('flash_message', get_phrase('chamada_cadastrada_com_sucesso'));
       // redirect(base_url() . 'index.php?admin/Chamada/', 'refresh');
    
}
}
