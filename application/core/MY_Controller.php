<?php
/*
 * Main Controller Basis System 
 * 
 */
class MY_Controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
        $this->load->helper('url_helper');
        $this->load->library('form_validation');
	}
}