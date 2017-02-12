<?php
class User_model extends MY_Model {

    protected $table_name = 'user';
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

    public function get_user_by_username($username)
    { 
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->where($this->primary_key,$username);
        $query = $this->db->get();
        return $query->result_array();
    }

	public function add_user($user){
        $this->db->insert($this->table_name,$user);
        return $this->db->affected_rows();
	}

    public function save($user){
        $this->db->set('bagian',$user['bagian']);
        $this->db->set('status',$user['status']);
        $this->db->where($this->primary_key,$user['username']);
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

    public function check_user($data){
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->where($this->primary_key,$data["username"]);
        $this->db->where("password",$data["password"]);
        if($this->db->get()->num_rows()>0) 
            return true;
        else
            return false;
    }

    function result(){
        $pagenum = isset($_POST['page']) ? intval($_POST['page'])-1 : 0;
        $pagesize = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $start = $pagenum * $pagesize;
        return $this->get(FALSE, $pagesize, $start);
    }

    function total_rows(){
        return $this->get(true);
    }
}