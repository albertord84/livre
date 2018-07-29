<?php
    
    class Transaction_model extends CI_Model {
                
        function __construct() {
            parent::__construct();            
        }

        public function insert_db_steep_1($datas){
            $datas_tmp=$datas;
            unset($datas_tmp['key']);
            $this->db->insert('transactions',$datas_tmp);
            $id_row=$this->db->insert_id();
            return $id_row;
        }  
        
        public function update_db_steep_1($datas,$id){
            $datas_tmp=$datas;
            unset($datas_tmp['key']);
            $this->db->where('id',$id);
            $result = $this->db->update('transactions',$datas_tmp);            
            return $result;
        }
        
        public function insert_db_steep_2($datas){
            $this->load->model('class/Crypt');
            $datas1['client_id']=$datas['pk'];
            $datas1['credit_card_name'] =  $this->Crypt->crypt($datas['credit_card_name']);
            $datas1['credit_card_number'] =  $this->Crypt->crypt($datas['credit_card_number']);
            $datas1['credit_card_exp_month'] =  $this->Crypt->crypt($datas['credit_card_exp_month']);
            $datas1['credit_card_exp_year'] =  $this->Crypt->crypt($datas['credit_card_exp_year']);
            $datas1['credit_card_cvv'] =  $this->Crypt->crypt($datas['credit_card_cvv']);
            
            $this->db->insert('credit_card',$datas1);
            $id_row=$this->db->insert_id();
            return $id_row;
        }
        
        public function update_db_steep_2($datas,$id){
            $this->load->model('class/Crypt');             
            $datas1['credit_card_name'] =   $this->Crypt->crypt($datas['credit_card_name']);
            $datas1['credit_card_number'] =  $this->Crypt->crypt($datas['credit_card_number']);
            $datas1['credit_card_exp_month'] =  $this->Crypt->crypt($datas['credit_card_exp_month']);
            $datas1['credit_card_exp_year'] =  $this->Crypt->crypt($datas['credit_card_exp_year']);
            $datas1['credit_card_cvv'] =  $this->Crypt->crypt($datas['credit_card_cvv']);                        
            $this->db->where('id',$id);
            $this->db->update('credit_card',$datas1);
            return $id;
        }
        
        public function save_generated_bill($id, $invoice_id){    
            $result = NULL;
            try{
                $this->db->where('id', $id);
                $this->db->update('transactions',['invoice_id' => $invoice_id]);
                $result =  $this->db->affected_rows();
            } catch (Exception $exception) {
               echo 'Error accediendo a la base de datos';
            } finally {
               return $result;
            }
        }
        
        public function save_cpf_card($id, $ucpf){    
            $result = NULL;
            try{
                $this->db->where('id', $id);
                $this->db->update('transactions',['ucpf' => $ucpf]);
                $result =  $this->db->affected_rows();
            } catch (Exception $exception) {
               echo 'Error accediendo a la base de datos';
            } finally {
               return $result;
            }
        }
        
        public function insert_db_steep_3($datas){
            $this->load->model('class/Crypt');             
            $datas1=array();
            $datas1['client_id']=$datas['pk'];
            $datas1['bank']= $this->Crypt->crypt($datas['bank']);
            $datas1['agency']= $this->Crypt->crypt($datas['agency']);
            $datas1['account_type']= $this->Crypt->crypt($datas['account_type']);
            $datas1['account']= $this->Crypt->crypt($datas['account']);
            $datas1['dig']= $this->Crypt->crypt($datas['dig']);            
            $datas1['titular_name']=$datas['titular_name'];
            $datas1['titular_cpf']=$datas['titular_cpf'];
            $this->db->insert('account_banks',$datas1);
            $id_row=$this->db->insert_id();
            return $id_row;
        }
        
        public function update_db_steep_3($datas,$id){
            $this->load->model('class/Crypt');             
            $datas1['client_id']=$datas['pk'];
            $datas1['bank']= $this->Crypt->crypt($datas['bank']);
            $datas1['agency']= $this->Crypt->crypt($datas['agency']);
            $datas1['account_type']= $this->Crypt->crypt($datas['account_type']);
            $datas1['account']= $this->Crypt->crypt($datas['account']);
            $datas1['dig']= $this->Crypt->crypt($datas['dig']);            
            $datas1['titular_name']=$datas['titular_name'];
            $datas1['titular_cpf']=$datas['titular_cpf'];            
            $this->db->where('id',$id);
            return $this->db->update('account_banks',$datas1);  
        }
        
        public function get_client($key, $value, $status=NULL){
            $this->db->select('*');
            $this->db->from('transactions'); 
            $this->db->where($key, $value);
            if($status)
                $this->db->where('status_id', $status);
            $this->db->order_by('transactions.id', 'asc');
            return $this->db->get()->result_array();
        }
         
        public function get_last_date_status($id){
            $this->load->model('class/transactions_status');
            $this->db->select('*');
            $this->db->from('transactions_dates'); 
            $this->db->where("transactions_id", $id);
            $this->db->where('status_id <>', transactions_status::BEGINNER);
            $this->db->order_by('transactions_dates.id', 'asc');
            $status_array = $this->db->get()->result_array();
            $N=count($status_array);
            if($N > 0)
                return $status_array[$N-1]['date'];
            else
                return 0;
        }
        
        public function get_all_client_datas_by_id($client_id){            
            try {    
                $this->db->select('*');
                $this->db->from('transactions');
                $this->db->join('credit_card', 'transactions.id = credit_card.client_id');
                $this->db->join('account_banks', 'transactions.id = account_banks.client_id');                
                $this->db->where('transactions.id', $client_id);
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
        
        public function get__decrypt_credit_card($key, $value){
            $this->load->model('class/Crypt');             
            $this->db->select('*');
            $this->db->from('credit_card'); 
            $this->db->where($key, $value);                        
            $datas =  $this->db->get()->row_array();
            $card['client_id'] = $datas['client_id'];
            $card['credit_card_name'] =  $this->Crypt->decrypt($datas['credit_card_name']);
            $card['credit_card_number'] =  $this->Crypt->decrypt($datas['credit_card_number']);
            $card['credit_card_exp_month'] =  $this->Crypt->decrypt($datas['credit_card_exp_month']);
            $card['credit_card_exp_year'] =  $this->Crypt->decrypt($datas['credit_card_exp_year']);
            $card['credit_card_cvv'] =  $this->Crypt->decrypt($datas['credit_card_cvv']);
            return $card;
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
            $this->load->model('class/Crypt'); 
            $this->db->select('*');
            $this->db->from('account_banks');
            $this->db->where('client_id', $client_id);
            $account_banks = $this->db->get()->result_array();
            
            foreach ($account_banks as $account_bank) {
                $dec_account_bank = $account_bank;
                $dec_account_bank['bank'] = $this->Crypt->decrypt($account_bank['bank']);
                $dec_account_bank['agency'] = $this->Crypt->decrypt($account_bank['agency']);
                $dec_account_bank['account_type'] = $this->Crypt->decrypt($account_bank['account_type']);
                $dec_account_bank['account'] = $this->Crypt->decrypt($account_bank['account']);
                $dec_account_bank['dig'] = $this->Crypt->decrypt($account_bank['dig']);
                
                $dec_account_banks [] = $dec_account_bank;
            }
            return $dec_account_banks;
        }
        
        public function save_in_db($table,$key,$key_value,$field,$field_value){
            try {
                $this->db->where($key, $key_value);
                $this->db->update($table, array($field => $field_value));                
                return true;
            } catch (Exception $exc) {
                //echo $exc->getTraceAsString();
                return false;
            }
        }
        
        public function insert_transaction_status_date($transaction_id, $status_id){
            try {
                $this->db->insert('transactions_dates',array('transaction_id'=>$transaction_id, 'status_id'=>$status_id, 'date'=>time()));
                return $this->db->insert_id();
            } catch (Exception $exc) {
                //echo $exc->getTraceAsString();
                return false;
            }
        }
        
        public function get_transaction_status($transaction_id){
            try {
                $this->db->select('*');
                $this->db->from('transactions_dates');
                $this->db->join('transactions_status', 'transactions_status.id = transactions_dates.status_id');
                $this->db->where('transactions_dates.transactions_id',$transaction_id);
                $this->db->order_by('date','DESC');
                $this->db->limit(1);
                $result = $this->db->get()->row_array();                       
                return $result;
            } catch (Exception $exc) {
                //echo $exc->getTraceAsString();
                return false;
            }
        }
        
        
        
    }
?>
