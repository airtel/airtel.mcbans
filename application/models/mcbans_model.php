<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Mcbans_model extends CI_Model {
    
    
    /**
     * Vairables
     */
    public $bans_table = '';
    
    
    /**
     * Class constructor
     */
    public function __construct() 
    {
        parent::__construct();
        
        $this->bans_table = $this->config->item('bans_table');
    }
    
    
    /**
     * Function gets all bans from database
     */
    public function get_bans()
    {
        $q = $this->db->get($this->bans_table);
        
        if($q->num_rows() > 0)
        {
            return $q->result();
        }
    }
    
    
    /**
     * Deletes ban from database
     * @param type $name
     */
    public function del_ban($name)
    {
        $this->db->where('name', $name)
                 ->delete($this->bans_table);
    }
    
    
}