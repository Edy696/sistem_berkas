<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = "List Agenda";
        $data['list_agenda'] = $this->agenda_model->get_agenda();
        $this->load->view('templates/header', $data);
        $this->load->view('agenda/index', $data);
        $this->load->view('templates/footer');
	}
    
	public function add(){
		$this->form_validation->set_rules('code', 'Code', 'required');
    	$this->form_validation->set_rules('agenda', 'Agenda', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required');

    	if($this->form_validation->run()==false){
            $data['agenda'] = null;
    		$data['title'] = "Tambah Data";
			$this->load->view('templates/header',$data);
			$this->load->view('agenda/add',$data);
			$this->load->view('templates/footer',$data);
    	}else{
    		$data = array(	
    					'code' => $this->input->get_post('code'),
    					'agenda' => $this->input->get_post('agenda'),
    					'price' => $this->input->get_post('price'));
    		if($this->agenda_model->add_agenda($data)>0)
                echo "success";
            else
                echo "failed";
    	}
	}

	public function save($id){
		// $this->form_validation->set_rules('code', 'Code', 'required');
        $this->form_validation->set_rules('agenda', 'Agenda', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');

    	if($this->form_validation->run()==false){
    		$data['title'] = "Rubah Agenda";
            $data['agenda'] = $this->agenda_model->get_agenda_by_id($id);
	        $this->load->view('templates/header', $data);
        	$this->load->view('agenda/add', $data);
        	$this->load->view('templates/footer');
    	}else{
            $data = array(  
                        'code' => $id,
                        'agenda' => $this->input->get_post('agenda'),
                        'price' => $this->input->get_post('price'));
    		if($this->agenda_model->save($data)>=1)
                redirect('/agenda/');
    	}
	}

    public function remove($id){
        if($this->agenda_model->delete($id))
            echo "success";
        else
            echo "failed";
    }

    public function data(){
        $result = $this->agenda_model->result();
        $total_rows = $this->agenda_model->total_rows();
    
        
        $final = array();
        $rows = array();
        foreach ($result as $row) {
            array_push($rows, $row);
        }
        $final["total"] = $total_rows;
        $final["rows"] = $rows;

        echo json_encode($final);  
    }
}
