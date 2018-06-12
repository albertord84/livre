<?php

class Affiliate_model {

    function __construct() {
        parent::__construct();            
    }
        
    public function get_affiliates_by_credentials($affiliate_complete_name,$affiliate_pass){
        try {    
            $this->db->select('*');
            $this->db->from('affiliates');
            $this->db->where('affiliates.complete_name', $affiliate_complete_name);
            $this->db->where('affiliates.pass', $affiliate_pass);
            return $this->db->get()->result_array();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }        
    }
    
    public function update_afiliate($id,$datas){
        try {
            $this->db->where('id',$id);
            $result = $this->db->update('affiliates',$datas);            
            return $result;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function insert_afiliate($datas){
        try {
            $this->db->insert('affiliates',$datas);
            $id_row=$this->db->insert_id();
            return $id_row;            
        } catch (Exception $ex) {
            echo $exc->getTraceAsString();
        }
    }
    
    
    

}
