<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SB_Model extends CI_Model
{
    var $table;
    var $pk;
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_row($pk)
    {
        $this->db->where($this->pk, $pk);
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0)
        {
            $row = $query->row_array(); 
        }
        
        return $row;
    }
    
    public function get_rows($vars=array())
    {
        $result = array();
        
        foreach ($vars as $key=>$val)
        {
            $this->db->where($key, $val);
        }
        
        $query = $this->db->get($this->table);
        
        foreach ($query->result_array() as $row)
        {
            $result[] = $row;
        }
        
        return $result;
    }
    
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }
    
    public function update($data)
    {
        $this->db->where($this->pk, $data[$this->pk]);
        $this->db->update($this->table, $data);
    }
    
    public function delete($id)
    {
        $this->db->where($this->pk, $id);
        $this->db->delete($this->table);
    }
    
    public function get_all_fields()
    {
        $fields = $this->db->list_fields($this->table);
        
        return $fields;
    }
    
    public function truncate()
    {
        $this->db->from($this->table); 
        $this->db->truncate(); 
    }
    
    public function insert_batch($data)
    {
        $this->db->insert_batch($this->table, $data);
    }
        
}
