<?php

    
    class livre_system_config_model extends CI_Model {
            
        public  function __construct() {
            parent::__construct();
        }
        
        public  function livre_system_config_vars(){
            $this->db->select('*');
            $this->db->from('livre_system_config'); 
            return $this->db->get()->result_array();
        }
    }
?>

