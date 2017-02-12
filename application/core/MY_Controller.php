<?php
/*
 * Main Controller Basis System 
 * 
 */
class MY_Controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('agenda_model');
        $this->load->model('user_model');
		$this->load->helper('form');
        $this->load->helper('url_helper');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function is_logged_in()
    {
        $user = $this->session->userdata('logged_in');
        if($user) return true;
        else redirect(site_url("login"));
    }

	public function loadview($data){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/content', $data);
        $this->load->view('templates/footer');
	}

	public function loadviewlogin(){
		$this->load->view('templates/header');
		$this->load->view('login/index');
        $this->load->view('templates/footer');
	}	
}