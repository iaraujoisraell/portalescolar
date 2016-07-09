<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cadastro extends CI_Controller {

   function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    

    /*     * *default functin, redirects to login page if no admin logged in yet** */

    public function index() {


              $this->load->view('cadastro');
      
    }
    
    
   
    
    /*     * *validate login*** */

    function valida_email() {
       
        $query = $this->db->get_where("usuarios", array(
            'usu_tx_email' => $this->input->post('email')
        ));
        
        
        
       
        if ($query->num_rows() > 0) {
           
            $row = $query->row();
            $this->session->set_flashdata('flash_message', get_phrase('Este Email já está registrado. Faça o login!'));
            redirect(base_url() . 'index.php?/login', 'refresh');
       
 
        } else {
            $this->session->set_flashdata('flash_message', get_phrase('login_failed'));
            redirect(base_url() . 'index.php?/cadastro/cadastro_completo', 'refresh');
           
        }
    }

    function cadastro_completo() {
        $this->load->view('cadastro_completo');
    }

}
