<?php

class Affiliate_model extends CI_Model{

    function __construct() {
        parent::__construct();            
    }
        
    public function get_affiliates_by_credentials($username,$pass){
        try {    
            $this->db->select('*');
            $this->db->from('affiliates');
            $this->db->where('affiliates.username', $username);
            $this->db->where('affiliates.pass', $pass);
            return $this->db->get()->result_array();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }        
    }
    
    public function get_affiliates_by_email($email){
        try {    
            $this->db->select('*');
            $this->db->from('affiliates');
            $this->db->where('affiliates.email', $email);
            return $this->db->get()->result_array();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }        
    }
    
    public function update_afiliate($id,$datas){
        try {
            $datas_tmp=$datas;
            unset($datas_tmp['key']);
            $this->db->where('id',$id);
            $result = $this->db->update('affiliates',$datas_tmp);            
            return $result;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function insert_afiliate($datas){
        try {
            $datas_tmp=$datas;
            unset($datas_tmp['key']);
            $this->db->insert('affiliates',$datas_tmp);
            $id_row=$this->db->insert_id();
            return $id_row;            
        } catch (Exception $ex) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function insert_affiliate_data_bank($datas){
        try {
            $datas_tmp=$datas;
            unset($datas_tmp['key']);
            $this->db->insert('account_banks',$datas_tmp);
            $id_row=$this->db->insert_id();
            return $id_row;
        } catch (Exception $ex) {
            echo $exc->getTraceAsString();
        }
    }
        
    public function update_affiliate_data_bank($datas,$affiliate_id){
        try {
            $datas_tmp=$datas;
            unset($datas_tmp['key']);
            $this->db->where('id',$affiliate_id);
            if($this->db->update('account_banks',$datas_tmp))
                return true;
            return false;
        } catch (Exception $ex) {
            echo $exc->getTraceAsString();
        }
    }
    
    
    

}
