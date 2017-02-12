<?php
class Agenda_model extends CI_Model {

    private $table_name = 'user';
    private $primary_key = 'username';

    public function __construct()
    {
        $this->load->database();
    }

    public function get_user()
	{ 
        $query = $this->db->get($this->table_name);
        return $query->result_array();
	}

    public function get_user_by_username($id)
    { 
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->where($this->primary_key,$id);
        $query = $this->db->get();
        return $query->result_array();
    }

	public function add_user($user){
        $this->db->insert($this->table_name,$user);
        return $this->db->affected_rows();
	}

    public function save($agenda){
        $this->db->set('password',$agenda['password']);
        $this->db->set('bagian',$agenda['bagian']);
        $this->db->where($this->primary_key,$agenda['username']);
        $this->db->update($this->table_name);
        return $this->db->affected_rows();
    }

    public function delete($id){
        $this->db->where($this->primary_key,$id);       
        $query = $this->db->delete($this->table_name);;
        if ($query) {
            return true;
        }else{
            return false;
        }
    }

     public function delete_by_status($id){
        $this->db->set('delete',1);
        $this->db->where($this->primary_key,$id);       
        return $this->db->affected_rows();
    }
}