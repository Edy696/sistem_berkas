<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if ($this->is_logged_in())
        {
    		$data['title'] = "List User";
            $data['content'] = $this->load->view('user/index',null,true);
            $this->loadview($data);
        }
	}

	public function add(){
        if ($this->is_logged_in())
        {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            // $this->form_validation->set_rules('re-password', 'Retype-Password', 'required');
            $this->form_validation->set_rules('bagian', 'Bagian', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');

            if($this->form_validation->run()==false){
                $data['title'] = "Tambah Data";
                $param['user'] = null;
                $data['content'] = $this->load->view('user/add',$param,true);
                $this->loadview($data);
            }else{
                $data = array(
                            'username' => $this->input->get_post('username'),
                            'password' => $this->input->get_post('password'),
                            'bagian' => $this->input->get_post('bagian'),
                            'status' => $this->input->get_post('status'));
                if($this->user_model->add_user($data)>0)
                    echo "success";
                else
                    echo "failed";
            }   
        }
	}

	public function save($username){
        if ($this->is_logged_in())
        {
            // $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('bagian', 'Bagian', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');

        	if($this->form_validation->run()==false){
        		$data['title'] = "Rubah Agenda";
                $param['user'] = $this->user_model->get_user_by_username($username);
                $data['content'] = $this->load->view('user/add',$param,true);
                $this->loadview($data);
        	}else{
                $data = array(  
                            'username' => $username,
                            'bagian' => $this->input->get_post('bagian'),
                            'status' => $this->input->get_post('status'));
        		if($this->user_model->save($data)>0)
                    echo "success";
                else
                    echo "failed";
        	}
        }
	}

    public function remove($username){
        if ($this->is_logged_in())
        {
            if($this->user_model->delete($username))
                echo "success";
            else
                echo "failed";
        }
    }

    public function data(){
        if ($this->is_logged_in())
        {
            $result = $this->user_model->result();
            $total_rows = $this->user_model->total_rows();
        
            
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
