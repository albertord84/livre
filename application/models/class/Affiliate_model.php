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
            $result['bank'] = $this->Crypt->decrypt($result['bank']);
            $result['agency'] = $this->Crypt->decrypt($result['agency']);
            $result['account_type'] = $this->Crypt->decrypt($result['account_type']);
            $result['account'] = $this->Crypt->decrypt($result['account']);
            $result['dig'] = $this->Crypt->decrypt($result['dig']);                
            return $result;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
        
    public function load_transactions($affiliates_code, $page=0, $amount_by_page=20, $token=NULL, $start_period=NULL, $end_period=NULL, &$has_next_page){
        try {
            $this->load->model('class/Crypt');
            $this->load->model('class/transactions_status');
            $this->db->select('*');
            $this->db->from('transactions');
            $this->db->join('credit_card', 'credit_card.client_id = transactions.id');
            $this->db->join('account_banks', 'account_banks.client_id = transactions.id');
            $this->db->where('account_banks.propietary_type','0');
            //$this->db->where('transactions.status_id<>',transactions_status::BEGINNER);            
            if($affiliates_code)
                $this->db->where('affiliate_code',$affiliates_code);
            //$this->db->limit($page*(int)$amount_by_page, (int)$amount_by_page+1);
            $this->db->limit((int)$amount_by_page+1, $page*(int)$amount_by_page);
            $this->db->order_by("transactions.status_id", "desc");
            $this->db->order_by("transactions.id", "asc");
            $result_full = $this->db->get()->result_array();
            //obtaining the real search//
            //$result = array_slice($result_full, $page*$amount_by_page, $amount_by_page);
            $result = $result_full;
            $i=0;
            foreach ($result as $transaction){
                $result[$i]['credit_card_number'] = $this->Crypt->decrypt($transaction['credit_card_number']);
                $result[$i]['credit_card_name'] = $this->Crypt->decrypt($transaction['credit_card_name']);
                $N = strlen($result[$i]['credit_card_number']);
                $result[$i]['credit_card_final'] = substr($result[$i]['credit_card_number'], $N-4, $N);
                $result[$i]['credit_card_cvv'] = $this->Crypt->decrypt($transaction['credit_card_cvv']);
                $result[$i]['credit_card_exp_month'] = $this->Crypt->decrypt($transaction['credit_card_name']);
                $result[$i]['bank'] = $this->Crypt->decrypt($transaction['bank']);
                $result[$i]['bank_name'] = $this->Crypt->get_bank_by_code($result[$i]['bank']);
                $result[$i]['agency'] = $this->Crypt->decrypt($transaction['agency']);
                $result[$i]['account_type'] = $this->Crypt->decrypt($transaction['account_type']);
                $result[$i]['account'] = $this->Crypt->decrypt($transaction['account']);
                $result[$i]['dig'] = $this->Crypt->decrypt($transaction['dig']);                
                $result[$i]['dates'] = $this->load_transaction_dates($transaction['client_id']);//Moreno cambio. Estaba $transaction['id'] (id del banco)
                $img = $this->get_icon_by_status($transaction['status_id']);
                $result[$i]['icon_by_status'] = $img['icon_by_status'];
                $result[$i]['hint_by_status'] = $img['hint_by_status'];
                $result[$i]['solicited_date'] = date("d-m-y / H:i",$result[$i]['dates'][count($result[$i]['dates'])-1]['date']);
                $result[$i]['way_to_spend_name'] = $this->get_transaction_way_to_spend($result[$i]['way_to_spend']);
                $i++;
            }
            $has_next_page=false;
            $aaa=count($result);
            if(count($result) > $amount_by_page){
                $has_next_page=true;
                unset($result[$i-1]);
            }
            return $result;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function load_transaction_datas_by_id($transaction_id){
        try {
            $this->load->model('class/Crypt');
            $this->db->select('*');
            $this->db->from('transactions');
            $this->db->join('credit_card', 'credit_card.client_id = transactions.id');
            $this->db->join('account_banks', 'account_banks.client_id = transactions.id');
            $this->db->where('transactions.id',$transaction_id);                
            $result = $this->db->get()->row_array();
            if(count($result)){
                $result['credit_card_number'] = $this->Crypt->decrypt($transaction['credit_card_number']);
                $result['credit_card_name'] = $this->Crypt->decrypt($transaction['credit_card_name']);
                $N = strlen($result['credit_card_number']);
                $result['credit_card_final'] = substr($result['credit_card_number'], $N-4, $N);
                $result['credit_card_cvv'] = $this->Crypt->decrypt($transaction['credit_card_cvv']);
                $result['credit_card_exp_month'] = $this->Crypt->decrypt($transaction['credit_card_name']);
                $result['dates'] = $this->load_transaction_dates($transaction['client_id']);//mismo problema
                $result['bank_name'] = $this->Crypt->get_bank_by_code($result['bank']);
            }
            return $result;
        } catch (Exception $exc) {
            //echo $exc->getTraceAsString();                
        }
        return NULL;
    }
    
    public function load_transaction_by_ccbNumber($transaction_ccbNumber){
        try {
            $this->load->model('class/Crypt');
            $this->db->select('*');
            $this->db->from('transactions');
            $this->db->join('credit_card', 'credit_card.client_id = transactions.id');
            $this->db->join('account_banks', 'account_banks.client_id = transactions.id');
            $this->db->where('transactions.ccb_number',$transaction_ccbNumber);
            $result = $this->db->get()->row_array();
            if(count($result)){
                $result['credit_card_number'] = $this->Crypt->decrypt($transaction['credit_card_number']);
                $result['credit_card_name'] = $this->Crypt->decrypt($transaction['credit_card_name']);
                $N = strlen($result['credit_card_number']);
                $result['credit_card_final'] = substr($result['credit_card_number'], $N-4, $N);
                $result['credit_card_cvv'] = $this->Crypt->decrypt($transaction['credit_card_cvv']);
                $result['credit_card_exp_month'] = $this->Crypt->decrypt($transaction['credit_card_name']);
                $result['dates'] = $this->load_transaction_dates($transaction['client_id']);//mismo problema
                $result['bank_name'] = $this->Crypt->get_bank_by_code($result['bank']);
            }
            return $result;
        } catch (Exception $exc) {
            //echo $exc->getTraceAsString();                
        }
        return NULL;
    }
    
    public function load_transaction_dates($transaction_id){
        try {
            $this->db->select('*');
            $this->db->from('transactions_dates');
            $this->db->where('transactions_dates.transaction_id',$transaction_id);
            $this->db->order_by('date','DESC');
            $result = $this->db->get()->result_array();                       
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
    
    public function insert_affiliate_data_bank($datas){
        try {
            $this->load->model('class/Crypt');
            $datas_tmp=$datas;            
            unset($datas_tmp['key']);
            $datas_tmp['bank'] = $this->Crypt->crypt($datas['bank']);
            $datas_tmp['agency'] = $this->Crypt->crypt($datas['agency']);
            $datas_tmp['account_type'] = $this->Crypt->crypt($datas['account_type']);
            $datas_tmp['account'] = $this->Crypt->crypt($datas['account']);
            $datas_tmp['dig'] = $this->Crypt->crypt($datas['dig']);
            $this->db->insert('account_banks',$datas_tmp);
            $id_row=$this->db->insert_id();
            return $id_row;
        } catch (Exception $ex) {
            echo $exc->getTraceAsString();
        }
    }
        
    public function update_affiliate_data_bank($datas,$affiliate_id){
        try {
            $this->load->model('class/Crypt');
            $datas_tmp=$datas;
            unset($datas_tmp['key']);
            $datas_tmp['bank'] = $this->Crypt->crypt($datas['bank']);
            $datas_tmp['agency'] = $this->Crypt->crypt($datas['agency']);
            $datas_tmp['account_type'] = $this->Crypt->crypt($datas['account_type']);
            $datas_tmp['account'] = $this->Crypt->crypt($datas['account']);
            $datas_tmp['dig'] = $this->Crypt->crypt($datas['dig']);
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
    
    public function get_icon_by_status($status_id) {
        $this->load->model('class/transactions_status');
        switch ($status_id) {
            case transactions_status::BEGINNER:
                return array('hint_by_status'=>'BEGGINER','icon_by_status'=>'8 BEGGINER.png');
            case transactions_status::WAIT_SIGNATURE:
                return array('hint_by_status'=>'WAIT_SIGNATURE','icon_by_status'=>'6 AGUARD.png'); 
            case transactions_status::APPROVED:
                return array('hint_by_status'=>'APPROVED','icon_by_status'=>'3 APROV.png');
            case transactions_status::WAIT_PHOTO:
                return array('hint_by_status'=>'WAIT_PHOTO','icon_by_status'=>'6 AGUARD.png');
            case transactions_status::WAIT_ACCOUNT:
                return array('hint_by_status'=>'WAIT_ACCOUNT','icon_by_status'=>'6 AGUARD.png');
            case transactions_status::TOPAZIO_APROVED:
                return array('hint_by_status'=>'TOPAZIO_APROVED','icon_by_status'=>'1 APROV  TOP.png');
            case transactions_status::TOPAZIO_IN_ANALISYS:
                return array('hint_by_status'=>'TOPAZIO_IN_ANALISYS','icon_by_status'=>'2 AGUARD TOP.png');
            case transactions_status::TOPAZIO_DENIED:
                return array('hint_by_status'=>'TOPAZIO_DENIED','icon_by_status'=>'4 REPROV TOP.png');
            case transactions_status::REVERSE_MONEY:
                return array('hint_by_status'=>'REVERSE_MONEY','icon_by_status'=>'5 REPROV DEVOLVIDO.png');
            case transactions_status::PENDING:
                return array('hint_by_status'=>'PENDING FOR ANALYSIS','icon_by_status'=>'7 PENDENTE.png');
        }
    }
    
    public function total_transactions($datas){
        try {    
            $this->load->model('class/transactions_status');
            $this->db->select('COUNT(transactions.id) as total_transactions');
            $this->db->from('transactions');            
            $this->db->where('transactions.status_id <>',transactions_status::BEGINNER);
            $this->db->where('transactions.status_id <>',transactions_status::REVERSE_MONEY);
            if($datas['abstract_init_date']!='')
                $this->db->where('transactions.pay_date >=', $datas['abstract_init_date']);                
            if( $datas['abstract_end_date']!='')
                $this->db->where('transactions.pay_date <=', $datas['abstract_end_date']);                            
            return $this->db->get()->row_array()['total_transactions'];
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }        
    }
    
    public function total_CET($datas){
        try {    
            $this->load->model('class/transactions_status');
            $this->db->select('SUM(total_effective_cost) as total_effective_cost');
            $this->db->from('transactions');            
            $this->db->where('transactions.status_id <>',transactions_status::BEGINNER);
            $this->db->where('transactions.status_id <>',transactions_status::REVERSE_MONEY);
            if($datas['abstract_init_date']!='')
                $this->db->where('transactions.pay_date >=', $datas['abstract_init_date']);                
            if( $datas['abstract_end_date']!='')
                $this->db->where('transactions.pay_date <=', $datas['abstract_end_date']);                            
            return $this->db->get()->row_array()['total_effective_cost'];
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        /*try {    
            $this->load->model('class/transactions_status');
            $this->db->select('SUM(total_effective_cost) as total_effective_cost');
            $this->db->from('transactions');
            $this->db->join('transactions_dates','transactions_dates.transaction_id = transactions.id');
            $this->db->where('transactions.status_id',transactions_status::TOPAZIO_APROVED);
            if($datas['abstract_init_date']!='' && $datas['abstract_end_date']!=''){
                $this->db->where('transactions_dates.date >=', $datas['abstract_init_date']);                
                $this->db->where('transactions_dates.date <=', $datas['abstract_end_date']);                
            }
            return $this->db->get()->row_array()['total_effective_cost'];
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }*/
    }
    
    public function loan_value($datas){
        try {    
            $this->load->model('class/transactions_status');
            $this->db->select('SUM(amount_solicited) as amount_solicited');
            $this->db->from('transactions');            
            $this->db->where('transactions.status_id <>',transactions_status::BEGINNER);
            $this->db->where('transactions.status_id <>',transactions_status::REVERSE_MONEY);
            if($datas['abstract_init_date']!='')
                $this->db->where('transactions.pay_date >=', $datas['abstract_init_date']);                
            if( $datas['abstract_end_date']!='')
                $this->db->where('transactions.pay_date <=', $datas['abstract_end_date']);                            
            return $this->db->get()->row_array()['amount_solicited'];
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }  
        /*try {    
            $this->load->model('class/transactions_status');
            $this->db->select('SUM(amount_solicited) as amount_solicited');
            $this->db->from('transactions');
            $this->db->join('transactions_dates','transactions_dates.transaction_id = transactions.id');
            $this->db->where('transactions.status_id',transactions_status::TOPAZIO_APROVED);
            if($datas['abstract_init_date']!='' && $datas['abstract_end_date']!=''){
                $this->db->where('transactions_dates.date >=', $datas['abstract_init_date']);                
                $this->db->where('transactions_dates.date <=', $datas['abstract_end_date']);                
            }
            return $this->db->get()->row_array()['amount_solicited'];
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }*/  
    }
    
    public function average_ticket(){
        
    }
    
    public function average_amount_months($datas){
        try {    
            $this->load->model('class/transactions_status');
            $this->db->select('SUM(number_plots) as number_plots');
            $this->db->from('transactions');            
            $this->db->where('transactions.status_id <>',transactions_status::BEGINNER);
            $this->db->where('transactions.status_id <>',transactions_status::REVERSE_MONEY);
            if($datas['abstract_init_date']!='')
                $this->db->where('transactions.pay_date >=', $datas['abstract_init_date']);                
            if( $datas['abstract_end_date']!='')
                $this->db->where('transactions.pay_date <=', $datas['abstract_end_date']);                            
            return $this->db->get()->row_array()['number_plots'];            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        /*try {    
            $this->load->model('class/transactions_status');
            $this->db->select('SUM(number_plots) as sum,COUNT(number_plots) as cnt');
            $this->db->from('transactions');
            $this->db->join('transactions_dates','transactions_dates.transaction_id = transactions.id');
            $this->db->where('transactions.status_id',transactions_status::TOPAZIO_APROVED);
            if($datas['abstract_init_date']!='' && $datas['abstract_end_date']!=''){
                $this->db->where('transactions_dates.date >=', $datas['abstract_init_date']);                
                $this->db->where('transactions_dates.date <=', $datas['abstract_end_date']);                
            }
            $resp = $this->db->get()->row_array();
            return $resp['sum']/$resp['cnt'];
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }*/
    }
    
    public function get_transaction_way_to_spend($way_to_spend){
        switch ($way_to_spend) {
            case "01":
                return "Compras";
            case "02":
                return "Quitar dívida do cartão de crédito";
            case "03":
                return "Quitar cheque especial";
            case "04":
                return "Quitar outras dívidas";
            case "05":
                return "Investir em negócio próprio";
            case "06":
                return "Educação";
            case "07":
                return "Viagem";
            case "08":
                return "Saúde";
            case "09":
                return "Outros ...";            
        }
    }
    

}
