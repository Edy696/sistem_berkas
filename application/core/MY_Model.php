<?php
/**
*  Class Main of Model
*
*/
class MY_Model extends CI_Model
{
	
	protected $table_name = '';

	function __construct()
	{
		parent::__construct();
	}

	public function get($nums_rows = false, $limit = false,$offset = false){
		if($nums_rows == TRUE){
			$method = 'num_rows';
		}else{
			$method = 'result';
		}
		if($limit !== FALSE && $offset !== FALSE){
            $this->db->limit($limit, $offset);
        }
        return $this->db->get($this->table_name)->$method();
	}
}