<?php
  
class Setting_model extends SB_Model {

    public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();
            $this->table = 'settings';
            $this->pk = 'id';
    }
    
    public function flush_update($records)
    {
        $data = array();
        
        $this->truncate();
        foreach ($records as $key=>$val)
        {
            foreach ($val as $record)
            {
                $data[] = array('id'=>'', 'type'=>$key, 'tid'=>$record['id'], 'value'=>$record['value']);
            }
        }
        
        $this->insert_batch($data);
    }
    
    public function get_settings_value($type)
    {
        $where = array('type'=>$type);
        return $this->get_rows($where);
    }

}