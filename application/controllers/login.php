<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

   function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index2() {

        if ($this->session->userdata('admin_login') != 1)
              $this->load->view('login');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?educacional/dashboard', 'refresh');
    }

    /*     * *default functin, redirects to login page if no admin logged in yet** */

    public function index() {


        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/educacional', 'refresh');
        if ($this->session->userdata('teacher_login') == 1)
            redirect(base_url() . 'index.php?teacher/dashboard', 'refresh');
        if ($this->session->userdata('student_login') == 1)
            redirect(base_url() . 'index.php?student/dashboard', 'refresh');
        if ($this->session->userdata('parent_login') == 1)
            redirect(base_url() . 'index.php?parents/dashboard', 'refresh');


        $config = array(
            array(
                'field' => 'email',
                'label' => 'Email'
            ),
            array(
                'field' => 'password',
                'label' => 'Password'
            )
        );

        $this->form_validation->set_rules($config);
        $this->form_validation->set_message('_validate_login', ucfirst($this->input->post('login_type')) . ' Login failed!');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">
								<button type="button" class="close" data-dismiss="alert">×</button>', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            
        }
    }

    /*     * *validate login*** */

    function valida_login() {
        $query = $this->db->get_where("usuarios", array(
            'usu_tx_login' => $this->input->post('email'),
            'usu_tx_senha' => $this->input->post('password')
        ));
        if ($query->num_rows() > 0) {

            $row = $query->row();
            $this->session->set_userdata('admin_login', '1');
            $this->session->set_userdata('login', $row->usuarios_id);
            $this->session->set_userdata('nome', $row->nome);   
            $this->session->set_userdata('perfis_id', $row->perfis_id);
            $this->session->set_userdata('login_type', 'admin');

           // redirect(base_url() . 'index.php?admin/educacional/', 'refresh');
        $page_data['page_name'] = 'aluno';
        $page_data['page_title'] = get_phrase('<a href="index.php?educacional/dashboard">Home</a> > <a href="index.php?admin/educacional">educacional </a><b>></b> <a href="">professor(a)</a>');
         redirect(base_url() . 'index.php?/educacional/dashboard', 'refresh');
        } else {
            $this->session->set_flashdata('flash_message', get_phrase('login_failed'));
            redirect(base_url() . 'index.php?/login', 'refresh');
           
        }
    }

    /*     * *DEFAULT NOR FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }

    /*     * *RESET AND SEND PASSWORD TO REQUESTED EMAIL*** */

    function reset_password() {
        $account_type = $this->input->post('account_type');
        if ($account_type == "") {
            redirect(base_url(), 'refresh');
        }
        $email = $this->input->post('email');
        $result = $this->email_model->password_reset_email($account_type, $email); //SEND EMAIL ACCOUNT OPENING EMAIL
        if ($result == true) {
            $this->session->set_flashdata('flash_message', get_phrase('password_sent'));
        } else if ($result == false) {
            $this->session->set_flashdata('flash_message', get_phrase('account_not_found'));
        }

        redirect(base_url(), 'refresh');
    }

    /*     * *****LOGOUT FUNCTION ****** */

    function logout() {
        $this->session->unset_userdata();
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url() . 'index.php?/login', 'refresh');
    }

}
