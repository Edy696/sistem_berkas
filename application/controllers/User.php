<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = "List User";
        $data['list_agenda'] = $this->agenda_model->get_agenda();
        $this->load->view('templates/header', $data);
        $this->load->view('agenda/index', $data);
        $this->load->view('templates/footer');
	}

}
