<?php
class Agenda_model extends MY_Model {

    protected $table_name = 'agenda';
    private $primary_key = 'code';

    public function __construct()
    {
        $this->load->database();
    }

    public function get_agenda()
	{ 
        $query = $this->db->get($this->table_name);
        return $query->result_array();
	}

    public function get_agenda_by_id($id)
    { 
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->where($this->primary_key,$id);
        $query = $this->db->get();
        return $query->result_array();
    }

	public function add_agenda($agenda){
        $this->db->insert($this->table_name,$agenda);
        return $this->db->affected_rows();
	}

    public function save($agenda){
        $this->db->set('agenda',$agenda['agenda']);
        $this->db->set('price',$agenda['price']);
        $this->db->where($this->primary_key,$agenda['code']);
        $this->db->update($this->table_name);
        return $this->db->affected_rows();
    }

    public function delete($id){
        $this->db->where($this->primary_key,$id);       
        $query = $this->db->delete($this->table_name);;
        if ($this->db->affected_rows()>0) {
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