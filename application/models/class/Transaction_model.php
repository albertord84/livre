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
            require_once $_SERVER['DOCUMENT_ROOT']."/livre/application/models/class/Crypt.php";
            $cr = new Crypt();
            $datas1['client_id']=$datas['pk'];
            $datas1['credit_card_name'] = $cr->crypt($datas['credit_card_name']);
            $datas1['credit_card_number'] = $cr->crypt($datas['credit_card_number']);
            $datas1['credit_card_exp_month'] = $cr->crypt($datas['credit_card_exp_month']);
            $datas1['credit_card_exp_year'] = $cr->crypt($datas['credit_card_exp_year']);
            $datas1['credit_card_cvv'] = $cr->crypt($datas['credit_card_cvv']);
            
            $this->db->insert('credit_card',$datas1);
            $id_row=$this->db->insert_id();
            return $id_row;
        }
        
        public function update_db_steep_2($datas,$id){
            require_once $_SERVER['DOCUMENT_ROOT']."/livre/application/models/class/Crypt.php";
            $cr = new Crypt();
            $datas1['credit_card_name'] =  $cr->crypt($datas['credit_card_name']);
            $datas1['credit_card_number'] = $cr->crypt($datas['credit_card_number']);
            $datas1['credit_card_exp_month'] = $cr->crypt($datas['credit_card_exp_month']);
            $datas1['credit_card_exp_year'] = $cr->crypt($datas['credit_card_exp_year']);
            $datas1['credit_card_cvv'] = $cr->crypt($datas['credit_card_cvv']);                        
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
            require_once $_SERVER['DOCUMENT_ROOT']."/livre/application/models/class/Crypt.php";
            $cr = new Crypt();
            $datas1=array();
            $datas1['client_id']=$datas['pk'];
            $datas1['bank']=$cr->crypt($datas['bank']);
            $datas1['agency']=$cr->crypt($datas['agency']);
            $datas1['account_type']=$cr->crypt($datas['account_type']);
            $datas1['account']=$cr->crypt($datas['account']);
            $datas1['dig']=$cr->crypt($datas['dig']);            
            $datas1['titular_name']=$datas['titular_name'];
            $datas1['titular_cpf']=$datas['titular_cpf'];
            $this->db->insert('account_banks',$datas1);
            $id_row=$this->db->insert_id();
            return $id_row;
        }
        
        public function update_db_steep_3($datas,$id){
            require_once $_SERVER['DOCUMENT_ROOT']."/livre/application/models/class/Crypt.php";
            $cr = new Crypt();
            $datas1['client_id']=$datas['pk'];
            $datas1['bank']=$cr->crypt($datas['bank']);
            $datas1['agency']=$cr->crypt($datas['agency']);
            $datas1['account_type']=$cr->crypt($datas['account_type']);
            $datas1['account']=$cr->crypt($datas['account']);
            $datas1['dig']=$cr->crypt($datas['dig']);            
            $datas1['titular_name']=$datas['titular_name'];
            $datas1['titular_cpf']=$datas['titular_cpf'];            
            $this->db->where('id',$id);
            $this->db->update('account_banks',$datas1);            
            return $id;
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
            require_once $_SERVER['DOCUMENT_ROOT']."/livre/application/models/class/Crypt.php";
            $cr = new Crypt();
            $this->db->select('*');
            $this->db->from('credit_card'); 
            $this->db->where($key, $value);                        
            $datas =  $this->db->get()->row_array();
            $card['client_id'] = $datas['client_id'];
            $card['credit_card_name'] = $cr->decrypt($datas['credit_card_name']);
            $card['credit_card_number'] = $cr->decrypt($datas['credit_card_number']);
            $card['credit_card_exp_month'] = $cr->decrypt($datas['credit_card_exp_month']);
            $card['credit_card_exp_year'] = $cr->decrypt($datas['credit_card_exp_year']);
            $card['credit_card_cvv'] = $cr->decrypt($datas['credit_card_cvv']);
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
            $this->db->select('*');
            $this->db->from('account_banks');
            $this->db->where('client_id', $client_id);
            return $this->db->get()->result_array();
        }
        
               
    }
?>
