<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller{
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->login();
	}
	
	function login()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			if(isset($this->session->userdata['logged_in'])){
				redirect(site_url("agenda"));
			}
			else{
				$data['title'] = "Login";
				$this->loadviewlogin();
			}
		} else {
			$data = array('username' => $this->input->post('username'),'password' => $this->input->post('password'));
			$result = $this->user_model->check_user($data);
			if ($result == TRUE) {	
				$username = $this->input->post('username');
				$result = $this->user_model->get_user_by_username($username);
				var_dump($result);
				if ($result != false) {
					$session_data = array('username' => $result[0]["username"],'bagian' => $result[0]["bagian"]);
					// Add user data in session
					$this->session->set_userdata('logged_in', $session_data);
					redirect(site_url("agenda"));
				}
			} else {
				// $this->login();
			}
		}
	}
	 
	function logout(){
		$this->session->userdata = array();
        $this->session->sess_destroy();
		$this->login();
	}
	
	function access_denied(){
		$this->load->view('access_denied');
	}
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */