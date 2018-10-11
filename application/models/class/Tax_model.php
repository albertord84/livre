<?php
    
    class Tax_model extends CI_Model {
                
        function __construct() {
            parent::__construct();            
        }
        
        
        public function get_tax_row($num_plots){
            $this->db->select('*');
            $this->db->from('juros'); 
            $this->db->where('parcelas', $num_plots);           
            return $this->db->get()->row_array();
        }
        
        public function get_tax_row_old($num_plots){
            $this->db->select('*');
            $this->db->from('juros_old'); 
            $this->db->where('parcelas', $num_plots);           
            return $this->db->get()->row_array();
        }
               
    }
?>
