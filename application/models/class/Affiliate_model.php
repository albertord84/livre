<?php

class Affiliate_model extends CI_Model{

    function __construct() {
        parent::__construct();            
    }
    
    public function load_afiliate_information($affiliate_id){
            try {
                $this->db->select('*');
                $this->db->from('affiliates');
                $this->db->join('account_banks', 'account_banks.client_id = affiliates.id');
                $this->db->where('affiliates.id',$affiliate_id);
                $this->db->where('account_banks.propietary_type','1');
                $result= $this->db->get()->row_array();
                return $result;
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }
        
    public function load_transactions($affiliates_code,$page=0,$amount_by_page=20,$token=NULL,$start_period=NULL,$end_period=NULL){
        try {
            require_once $_SERVER['DOCUMENT_ROOT']."/livre/application/models/class/Crypt.php";
            $cr = new Crypt();
            $this->db->select('*');
            $this->db->from('transactions');
            $this->db->join('credit_card', 'credit_card.client_id = transactions.id');
            $this->db->join('account_banks', 'account_banks.client_id = transactions.id');
            $this->db->where('account_banks.propietary_type','0');
            if($affiliates_code)
                $this->db->where('affiliate_code',$affiliates_code);
            $this->db->limit($page*$amount_by_page, $amount_by_page);
            $this->db->order_by("transactions.id", "desc");
            $result = $this->db->get()->result_array();
            $i=0;
            foreach ($result as $transaction){
                $result[$i]['credit_card_name'] = $cr->decrypt($transaction['credit_card_name']);
                $result[$i]['credit_card_number'] = $cr->decrypt($transaction['credit_card_number']);
                $result[$i]['credit_card_cvv'] = $cr->decrypt($transaction['credit_card_cvv']);
                $result[$i]['credit_card_exp_month'] = $cr->decrypt($transaction['credit_card_name']);                
                $result[$i]['dates'] = $this->load_transaction_dates($transaction['id']);
                $result[$i]['bank_name'] = $cr->get_bank_by_code($result[$i]['bank']);
                $i++;
            }
            return $result;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function load_transaction_dates($transaction_id){
        try {
            $this->db->select('*');
            $this->db->from('transactions_dates');
            $this->db->where('transactions_dates.transactions_id',$transaction_id);
            $this->db->order_by('date','DESC');
            $result = $this->db->get()->result_array();                       
            return $result;
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
    
    
    public function get_affiliates_by_credentials($email,$pass){
        try {    
            $this->db->select('*');
            $this->db->from('affiliates');
            $this->db->where('affiliates.email', $email);
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
    

}
