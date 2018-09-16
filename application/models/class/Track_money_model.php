<?php
    
    class Track_money_model extends CI_Model {
                
        function __construct() {
            parent::__construct();            
        }

        public function insert_required_money($datas){            
            $this->db->insert('track_money',$datas);
            $id_row=$this->db->insert_id();
            return $id_row;
        }       
    }
?>
