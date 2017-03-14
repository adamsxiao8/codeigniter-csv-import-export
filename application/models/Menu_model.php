<?php
  
class Menu_model extends SB_Model {

    public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();
            $this->table = 'menus';
            $this->pk = 'id';
    }
    
    public function get_menu($role)
    {
        $menu = array();
        
        $query = $this->db->get($this->table);
        foreach ($query->result_array() as $row)
        {
            $roles = unserialize($row['roles']);
            if (in_array($role, $roles))
            {
                if ($row['parent']==NULL)
                {
                    $menu[$row['id']] = $row;
                }
                else
                {
                    $menu[$row['parent']]['children'][$row['id']] = $row;
                }
            }
        }
        
        return $menu;
    }

}