<?php
    
    class Client_model extends CI_Model {
        private $key='d318f5b3f09f0399da510a141d091f8f'.'e7e9ec3723447a642f762b2b6a15cfd7';
                
        function __construct() {
            parent::__construct();            
        }
        
        private function encryp($str){
            return openssl_encrypt($str, "aes-256-ctr", $this->key);
        }
        
        private function dencryp($str){
            return openssl_decrypt($str , "aes-256-ctr", $this->key);
        }

        public function insert_db_steep_1($datas){  
            $this->db->insert('clients',$datas);
            $id_row=$this->db->insert_id();
            return $id_row;
        }  
        
        public function update_db_steep_1($datas,$id){
            $this->db->where('id',$id);
            $this->db->update('clients',$datas);            
            return $id;
        }
        
        public function insert_db_steep_2($datas){
            $datas1['client_id']=$datas['pk'];
            $datas1['credit_card_name'] = $this->encryp($datas['credit_card_name']);
            $datas1['credit_card_number'] = $this->encryp($datas['credit_card_number']);
            $datas1['credit_card_exp_month'] = $this->encryp($datas['credit_card_exp_month']);
            $datas1['credit_card_exp_year'] = $this->encryp($datas['credit_card_exp_year']);
            $datas1['credit_card_cvv'] = $this->encryp($datas['credit_card_cvv']);
            
            $this->db->insert('credit_card',$datas1);
            $id_row=$this->db->insert_id();
            return $id_row;
        }
        
        public function update_db_steep_2($datas,$id){
            $datas1['credit_card_name'] =  $this->encryp($datas['credit_card_name']);
            $datas1['credit_card_number'] = $this->encryp($datas['credit_card_number']);
            $datas1['credit_card_exp_month'] = $this->encryp($datas['credit_card_exp_month']);
            $datas1['credit_card_exp_year'] = $this->encryp($datas['credit_card_exp_year']);
            $datas1['credit_card_cvv'] = $this->encryp($datas['credit_card_cvv']);                        
            $this->db->where('id',$id);
            $this->db->update('credit_card',$datas1);
            return $id;
        }
        
        public function insert_db_steep_3($datas){
            $datas1=array();
            $datas1['client_id']=$datas['pk'];
            $datas1['bank']=$this->encryp($datas['bank']);
            $datas1['agency']=$this->encryp($datas['agency']);
            $datas1['account_type']=$this->encryp($datas['account_type']);
            $datas1['account']=$this->encryp($datas['account']);
            $datas1['dig']=$this->encryp($datas['dig']);            
            $datas1['titular_name']=$datas['titular_name'];
            $datas1['titular_cpf']=$datas['titular_cpf'];
            $this->db->insert('account_banks',$datas1);
            $id_row=$this->db->insert_id();
            return $id_row;
        }
        
        public function update_db_steep_3($datas,$id){
            $datas1['client_id']=$datas['pk'];
            $datas1['bank']=$this->encryp($datas['bank']);
            $datas1['agency']=$this->encryp($datas['agency']);
            $datas1['account_type']=$this->encryp($datas['account_type']);
            $datas1['account']=$this->encryp($datas['account']);
            $datas1['dig']=$this->encryp($datas['dig']);
            
            $datas1['titular_name']=$datas['titular_name'];
            $datas1['titular_cpf']=$datas['titular_cpf'];            
            $this->db->where('id',$id);
            $this->db->update('account_banks',$datas1);            
            return $id;
        }
        
        public function get_client($key, $value, $status=NULL){
            $this->db->select('*');
            $this->db->from('clients'); 
            $this->db->where($key, $value);
            if($status)
                $this->db->where('status_id', $status);
            $this->db->order_by('clients.id', 'asc');
            return $this->db->get()->result_array();
        }
                
        public function get_all_client_datas_by_id($client_id){            
            try {    
                $this->db->select('*');
                $this->db->from('clients');
                $this->db->join('credit_card', 'clients.id = credit_card.client_id');
                $this->db->join('account_banks', 'clients.id = account_banks.client_id');                
                $this->db->where('clients.id', $client_id);
                return $this->db->get()->result_array()[0];
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }        
        
        
        public function get_credit_card($key, $value){
            $this->db->select('*');
            $this->db->from('credit_card'); 
            $this->db->where($key, $value);            
            $this->db->order_by('credit_card.id', 'asc');
            return $this->db->get()->result_array();
        }
        
        public function get_account_banks($bank, $agency, $account){
            $this->db->select('*');
            $this->db->from('account_banks'); 
            $this->db->where('bank', $bank);
            $this->db->where('agency', $agency);
            $this->db->where('account', $account);
            $this->db->order_by('account_banks.id', 'asc');
            return $this->db->get()->result_array();
        }
        
         public function get_account_bank_by_client_id($client_id){
            $this->db->select('*');
            $this->db->from('account_banks');
            $this->db->where('client_id', $client_id);
            return $this->db->get()->result_array();
        }
        
               
    }
?>
