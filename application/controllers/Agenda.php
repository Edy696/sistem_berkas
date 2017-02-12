<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
        if ($this->is_logged_in())
        {
    		$data['title'] = "List Agenda";
            $data['content'] = $this->load->view('agenda/index',null,true);
            $this->loadview($data);
        }
	}
    
	public function add(){
        if ($this->is_logged_in())
        {
            $this->form_validation->set_rules('code', 'Code', 'required');
            $this->form_validation->set_rules('agenda', 'Agenda', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required');

            if($this->form_validation->run()==false){
                var_dump("test1");
                $data['title'] = "Tambah Data";
                $param['agenda'] = null;
                $data['content'] = $this->load->view('agenda/add',$param,true);
                $this->loadview($data);
            }else{
                var_dump("test2");
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
	}

	public function save($id){
        if ($this->is_logged_in())
        {
            $this->form_validation->set_rules('agenda', 'Agenda', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required');

        	if($this->form_validation->run()==false){
        		$data['title'] = "Rubah Agenda";
                $param['agenda'] = $this->agenda_model->get_agenda_by_id($id);
                $data['content'] = $this->load->view('agenda/add',$param,true);
                $this->loadview($data);
        	}else{
                $data = array(  
                            'code' => $id,
                            'agenda' => $this->input->get_post('agenda'),
                            'price' => $this->input->get_post('price'));
        		if($this->agenda_model->save($data)>=1)
                    redirect('/agenda/');
        	}
        }
	}

    public function remove($id){
        if ($this->is_logged_in())
        {
            if($this->agenda_model->delete($id))
                echo "success";
            else
                echo "failed";
        }
    }

    public function data(){
        if ($this->is_logged_in())
        {
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

    public function history(){
        if ($this->is_logged_in())
        {
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
}
