<?php

class Affiliate_model extends CI_Model{

    function __construct() {
        parent::__construct();            
    }
    
    public function load_afiliate_information($affiliate_id){
        try {
            $this->db->select('*');
            $this->db->from('affiliates');
            $this->db->join('account_banks', 'account_banks.client_id = affiliates.id','left outer');
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
    
    public function load_afiliates(){
        try {
            $this->db->select('*');
            $this->db->from('affiliates');
            $this->db->join('account_banks', 'account_banks.client_id = affiliates.id','left outer');
            $this->db->where('account_banks.propietary_type','1');
            $this->db->where('affiliates.role','AFFIL');
            $this->db->order_by("affiliates.id", "desc");
            $this->db->order_by("affiliates.status_id", "desc");
            $result= $this->db->get()->result_array();
            $i=0;
            foreach ($result as $afiliate) {
                $result[$i]['bank'] = $this->Crypt->decrypt($afiliate['bank']);
                $result[$i]['agency'] = $this->Crypt->decrypt($afiliate['agency']);
                $result[$i]['account_type'] = $this->Crypt->decrypt($afiliate['account_type']);
                $resul[$i]['account'] = $this->Crypt->decrypt($afiliate['account']);
                $result[$i++]['dig'] = $this->Crypt->decrypt($afiliate['dig']);
            }
            return $result;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
        
    public function load_transactions($affiliates_code, $page=0, $amount_by_page=20, $token=NULL, $start_period=NULL, $end_period=NULL, &$has_next_page, $status = 0){
        try {
            $this->load->model('class/Crypt');
            $this->load->model('class/transactions_status');
            $this->db->select('*,transactions.id as tr_id');
            $this->db->from('transactions');
            $this->db->join('transactions_status', 'transactions.status_id = transactions_status.id');
            //$this->db->join('credit_card', 'transactions.id = credit_card.client_id','left outer');
            //$this->db->join('account_banks', 'transactions.id = account_banks.client_id ','left outer');
            if($status==transactions_status::BEGINNER){
                $this->db->join('transactions_dates', 'transactions.id = transactions_dates.transaction_id');
                $this->db->where('transactions_dates.status_id', $status);
                if($start_period!=''){
                    $this->db->where('transactions_dates.date >=', $start_period);                                    
                }
                if( $end_period!=''){
                    $this->db->where('transactions_dates.date <=', $end_period);                                                
                }
            }
            else{
                if($start_period!='')
                    $this->db->where('transactions.pay_date >=', $start_period);                
                if( $end_period!='')
                    $this->db->where('transactions.pay_date <=', $end_period);                            
            }
            //$this->db->where('account_banks.propietary_type','0');
            if($affiliates_code)
                $this->db->where('affiliate_code',$affiliates_code);            
            if($status != 0)
                $this->db->where('transactions.status_id',$status);            
            else
                $this->db->where('transactions.status_id <>',transactions_status::BEGINNER);            
            if( $token!=''){
                if( strpos($token, 'cpf: ')!== false ){
                    $token = str_replace("cpf: ", '', $token);
                    $this->db->like('transactions.cpf', $token);                            
                }
                else{
                    if ( strpos($token, '@') !== false ||  strpos($token, '.') !== false ||  (strpos($token, '_') !== false && strpos($token, ':') === false) ||  strpos($token, 'email: ') !== false) {
                        $token = str_replace("email: ", '', $token);
                        $this->db->like('transactions.email', $token);
                    }else{
                        if (is_numeric($token) && strlen($token) === 11) {
                            //$token = str_replace("partnerId: ", '', $token);
                            $this->db->like('transactions.contract_id', $token);
                        }else{
                            if (is_numeric($token) && strlen($token) < 11) {
                                //$token = str_replace("ccbNumber: ", '', $token);
                                $this->db->like('transactions.ccb_number', $token);
                            }
                            else{
                                if ( strpos($token, 'utm_source: ') !== false) {
                                    $token = str_replace("utm_source: ", '', $token);
                                    $this->db->like('transactions.utm_source', $token);
                                }
                                else{
                                    if ( strpos($token, 'utm_campaign: ') !== false) {
                                        $token = str_replace("utm_campaign: ", '', $token);
                                        $this->db->like('transactions.utm_campaign', $token);
                                    }
                                    else{
                                        if ( strpos($token, 'utm_content: ') !== false) {
                                            $token = str_replace("utm_content: ", '', $token);
                                            $this->db->like('transactions.utm_content', $token);
                                        }
                                        else{
                                            if ( strpos($token, 'tel: ') !== false) {
                                                $token = str_replace("tel: ", '', $token);
                                                $this->db->like('transactions.phone_number', $token);
                                            }else{
                                                if ( strpos($token, 'uf: ') !== false) {
                                                    $token = str_replace("uf: ", '', $token);
                                                    $this->db->like('transactions.state_address', $token);
                                                }
                                                else{
                                                    $this->db->like('transactions.name', $token);                            
                                                }                                        
                                            }
                                        }
                                    }
                                }
                            }                            
                        }
                    }
                    
                }
            }
            $this->db->limit((int)$amount_by_page+1, $page*(int)$amount_by_page);
            $this->db->order_by("transactions_status.false_id", "desc");
            $this->db->order_by("transactions.id", "desc");
            $result = $this->db->get()->result_array();
            $i=0;
            foreach ($result as $transaction){
//                $result[$i]['credit_card_number'] = $this->Crypt->decrypt($transaction['credit_card_number']);
//                $result[$i]['credit_card_name'] = $this->Crypt->decrypt($transaction['credit_card_name']);
//                $N = strlen($result[$i]['credit_card_number']);
//                $result[$i]['credit_card_final'] = substr($result[$i]['credit_card_number'], $N-4, $N);
//                $result[$i]['credit_card_cvv'] = $this->Crypt->decrypt($transaction['credit_card_cvv']);
//                $result[$i]['credit_card_exp_month'] = $this->Crypt->decrypt($transaction['credit_card_name']);
//                $result[$i]['bank'] = $this->Crypt->decrypt($transaction['bank']);
//                $result[$i]['bank_name'] = $this->Crypt->get_bank_by_code($result[$i]['bank']);
//                $result[$i]['agency'] = $this->Crypt->decrypt($transaction['agency']);
//                $result[$i]['account_type'] = $this->Crypt->decrypt($transaction['account_type']);
//                $result[$i]['account'] = $this->Crypt->decrypt($transaction['account']);
//                $result[$i]['dig'] = $this->Crypt->decrypt($transaction['dig']);                
                $result[$i]['dates'] = $this->load_transaction_dates($transaction['tr_id']);//Moreno cambio. Estaba $transaction['id'] (id del banco)
                $img = $this->get_icon_by_status($transaction['status_id']);
                $result[$i]['icon_by_status'] = $img['icon_by_status'];
                $result[$i]['hint_by_status'] = $img['hint_by_status'];
                $result[$i]['solicited_date'] = date("d-m-y / H:i",$result[$i]['dates'][count($result[$i]['dates'])-1]['date']);
                $result[$i]['way_to_spend_name'] = $this->get_transaction_way_to_spend($result[$i]['way_to_spend']);
                $i++;
            }
            $has_next_page=false;
            if(count($result) > $amount_by_page){
                $has_next_page=true;
                unset($result[$i-1]);
            }
            return $result;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }    
    
    public function load_leads($affiliates_code, $page=0, $amount_by_page=20, $token=NULL, $start_period=NULL, $end_period=NULL, &$has_next_page, $status = 0){
        try {
            $this->load->model('class/Crypt');
            $this->load->model('class/transactions_status');
            $this->db->select('*');
            $this->db->from('transactions');            
            if($status != 0)
                $this->db->where('transactions.status_id',$status);   
            
            if( $token!=''){
                if( strpos($token, 'cpf: ')!== false ){
                    $token = str_replace("cpf: ", '', $token);
                    $this->db->like('transactions.cpf', $token);                            
                }
                else{
                    if ( strpos($token, '@') !== false ||  strpos($token, '.') !== false ||  (strpos($token, '_') !== false && strpos($token, ':') === false) ||  strpos($token, 'email: ') !== false) {
                        $token = str_replace("email: ", '', $token);
                        $this->db->like('transactions.email', $token);
                    }else{
                        if (is_numeric($token) && strlen($token) === 11) {
                            //$token = str_replace("partnerId: ", '', $token);
                            $this->db->like('transactions.contract_id', $token);
                        }else{
                            if (is_numeric($token) && strlen($token) < 11) {
                                //$token = str_replace("ccbNumber: ", '', $token);
                                $this->db->like('transactions.ccb_number', $token);
                            }
                            else{
                                if ( strpos($token, 'utm_source: ') !== false) {
                                    $token = str_replace("utm_source: ", '', $token);
                                    $this->db->like('transactions.utm_source', $token);
                                }
                                else{
                                    if ( strpos($token, 'utm_campaign: ') !== false) {
                                        $token = str_replace("utm_campaign: ", '', $token);
                                        $this->db->like('transactions.utm_campaign', $token);
                                    }
                                    else{
                                        if ( strpos($token, 'utm_content: ') !== false) {
                                            $token = str_replace("utm_content: ", '', $token);
                                            $this->db->like('transactions.utm_content', $token);
                                        }
                                        else{
                                            $this->db->like('transactions.name', $token);                            
                                        }
                                    }
                                }
                            }                            
                        }
                    }
                    
                }
            }            
            //$this->db->limit($page*(int)$amount_by_page, (int)$amount_by_page+1);
            $this->db->limit((int)$amount_by_page+1, $page*(int)$amount_by_page);
            $this->db->order_by("transactions.status_id", "desc");
            $this->db->order_by("transactions.id", "desc");
            //$this->db->group_by("transactions.email", "desc");
            
            $result = $this->db->get()->result_array();
            $N=count($result);            
            $has_next_page=false;
            if(count($result) > $amount_by_page){
                $has_next_page=true;
                unset($result[$N-1]);
            }
            return $result;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function num_in_load_transactions($affiliates_code, $page=0, $amount_by_page=20, $token=NULL, $start_period=NULL, $end_period=NULL, &$has_next_page, $status = 0){
        try {
            $this->load->model('class/Crypt');
            $this->load->model('class/transactions_status');
            $this->db->select('COUNT(cpf) as total_transactions');
            $this->db->from('transactions');
            
            //-------INICIO CODIGO DE JR---------------------------------------
            $this->db->join('transactions_status', 'transactions.status_id = transactions_status.id');
            //$this->db->join('credit_card', 'transactions.id = credit_card.client_id','left outer');
            //$this->db->join('account_banks', 'transactions.id = account_banks.client_id ','left outer');
            if($status==transactions_status::BEGINNER){
                $this->db->join('transactions_dates', 'transactions.id = transactions_dates.transaction_id');
                $this->db->where('transactions_dates.status_id', $status);
                if($start_period!=''){
                    $this->db->where('transactions_dates.date >=', $start_period);                                    
                }
                if( $end_period!=''){
                    $this->db->where('transactions_dates.date <=', $end_period);                                                
                }
            }
            else{
                if($start_period!='')
                    $this->db->where('transactions.pay_date >=', $start_period);                
                if( $end_period!='')
                    $this->db->where('transactions.pay_date <=', $end_period);                            
            }
            //$this->db->where('account_banks.propietary_type','0');
            if($affiliates_code)
                $this->db->where('affiliate_code',$affiliates_code);            
            if($status != 0)
                $this->db->where('transactions.status_id',$status);            
            else
                $this->db->where('transactions.status_id <>',transactions_status::BEGINNER);            
            if( $token!=''){
                if( strpos($token, 'cpf: ')!== false ){
                    $token = str_replace("cpf: ", '', $token);
                    $this->db->like('transactions.cpf', $token);                            
                }
                else{
                    if ( strpos($token, '@') !== false ||  strpos($token, '.') !== false ||  (strpos($token, '_') !== false && strpos($token, ':') === false) ||  strpos($token, 'email: ') !== false) {
                        $token = str_replace("email: ", '', $token);
                        $this->db->like('transactions.email', $token);
                    }else{
                        if (is_numeric($token) && strlen($token) === 11) {
                            //$token = str_replace("partnerId: ", '', $token);
                            $this->db->like('transactions.contract_id', $token);
                        }else{
                            if (is_numeric($token) && strlen($token) < 11) {
                                //$token = str_replace("ccbNumber: ", '', $token);
                                $this->db->like('transactions.ccb_number', $token);
                            }
                            else{
                                if ( strpos($token, 'utm_source: ') !== false) {
                                    $token = str_replace("utm_source: ", '', $token);
                                    $this->db->like('transactions.utm_source', $token);
                                }
                                else{
                                    if ( strpos($token, 'utm_campaign: ') !== false) {
                                        $token = str_replace("utm_campaign: ", '', $token);
                                        $this->db->like('transactions.utm_campaign', $token);
                                    }
                                    else{
                                        if ( strpos($token, 'utm_content: ') !== false) {
                                            $token = str_replace("utm_content: ", '', $token);
                                            $this->db->like('transactions.utm_content', $token);
                                        }
                                        else{
                                            if ( strpos($token, 'tel: ') !== false) {
                                                $token = str_replace("tel: ", '', $token);
                                                $this->db->like('transactions.phone_number', $token);
                                            }else{
                                                if ( strpos($token, 'uf: ') !== false) {
                                                    $token = str_replace("uf: ", '', $token);
                                                    $this->db->like('transactions.state_address', $token);
                                                }
                                                else{
                                                    $this->db->like('transactions.name', $token);                            
                                                }                                        
                                            }
                                        }
                                    }
                                }
                            }                            
                        }
                    }
                    
                }
            }
            //-------FIN CODIGO DE JR---------------------------------------
            //-------INICIO CODIGO DE MORENO---------------------------------------
            /*$this->db->join('credit_card', 'credit_card.client_id = transactions.id');
            $this->db->join('account_banks', 'account_banks.client_id = transactions.id');
            if($status==transactions_status::BEGINNER){
                $this->db->join('transactions_dates', 'transactions_dates.transaction_id = transactions.id');
                $this->db->where('transactions_dates.status_id', $status);
                if($start_period!=''){
                    $this->db->where('transactions_dates.date >=', $start_period);                                    
                }
                if( $end_period!=''){
                    $this->db->where('transactions_dates.date <=', $end_period);                                                
                }
            }
            else{
                if($start_period!='')
                    $this->db->where('transactions.pay_date >=', $start_period);                
                if( $end_period!='')
                    $this->db->where('transactions.pay_date <=', $end_period);                            
            }
            $this->db->where('account_banks.propietary_type','0');
            //$this->db->where('transactions.status_id<>',transactions_status::BEGINNER);            
            if($affiliates_code)
                $this->db->where('affiliate_code',$affiliates_code);            
            if($status != 0)
                $this->db->where('transactions.status_id',$status);            
            if( $token!=''){                
                if(is_numeric($token)){
                    $this->db->like('transactions.cpf', $token);                            
                }
                else{
                    if ( strpos($token, '@') !== false ) {
                        $this->db->like('transactions.email', $token);                            
                    }
                    else{
                        $this->db->like('transactions.name', $token);                            
                    }
                }
            }*/
            //-------FIN CODIGO DE MORENO---------------------------------------
            
            return $this->db->get()->row_array()['total_transactions'];                        
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
    
    public function load_transaction_cutdate($page=0, $amount_by_page=20, &$has_next_page, $init_date = NULL, $cut_date = NULL, $status = NULL){
        try {
            
            $this->db->select('*');
            $this->db->from('transactions');
            if($status)
                $this->db->where('transactions.status_id', $status);
            //$this->db->where('transactions.id <=', '18750');
            /*if($init_date)
                $this->db->where('transactions.pay_date >=', $init_date);                            
            if($cut_date)
                $this->db->where('transactions.pay_date <', $cut_date);                            */
            $this->db->limit((int)$amount_by_page+1, $page*(int)$amount_by_page);            
            $this->db->order_by("transactions.id", "desc");
            
            $result = $this->db->get()->result_array();
            $i=count($result);
            $has_next_page=false;
            if(count($result) > $amount_by_page){
                $has_next_page=true;
                unset($result[$i-1]);
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
            $datas_tmp['code']=$datas_tmp['phone_number'];
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
            $datas_tmp['code']=$datas_tmp['phone_number'];
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
    
    public function iof_tax_value($datas, $page = 0, $amount_by_page = 1000, &$has_next_page){
        try {                
            $this->load->model('class/transactions_status');                        
            
            $this->db->select('amount_solicited, number_plots, tax');
            $this->db->from('transactions');            
            $this->db->where('transactions.status_id <>',transactions_status::BEGINNER);
            $this->db->where('transactions.status_id <>',transactions_status::REVERSE_MONEY);
            if($datas['abstract_init_date']!='')
                $this->db->where('transactions.pay_date >=', $datas['abstract_init_date']);                
            if( $datas['abstract_end_date']!='')
                $this->db->where('transactions.pay_date <=', $datas['abstract_end_date']);                            
            $this->db->limit((int)$amount_by_page+1, $page*(int)$amount_by_page);
            $result = $this->db->get()->result_array();
            
            $has_next_page=false;
            $N = count($result);
            if($N > $amount_by_page){
                $has_next_page=true;
                unset($result[$N-1]);
            }
            
            return $result;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }  
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
    
    public function ave_track_money($lower, $upper, $init_date = NULL, $end_date = NULL){
        try{
            $this->db->select('COUNT(solicited_value) as count_money');
            $this->db->from('track_money');            
            $this->db->where('solicited_value >',$lower);
            $this->db->where('solicited_value <=',$upper);
            if($init_date)
                $this->db->where('track_date >=',$init_date);
            if($end_date)
                $this->db->where('track_date <=',$end_date);
            
            $result['count_money'] = $this->db->get()->row_array()['count_money']; 
            
            $this->db->select('SUM(solicited_value) as sum_money');
            $this->db->from('track_money');            
            $this->db->where('solicited_value >',$lower);
            $this->db->where('solicited_value <=',$upper);
            if($init_date)
                $this->db->where('track_date >=',$init_date);
            if($end_date)
                $this->db->where('track_date <=',$end_date);
            $result['ave_money'] = $this->db->get()->row_array()['sum_money'];
            if($result['count_money'])
                $result['ave_money'] = $result['ave_money']/$result['count_money']; 
            else
                $result['ave_money'] = 0;
            
            return $result;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
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
    
    public function get_client_num_transactions($cpf){
        $this->load->model('class/transactions_status');
        $this->db->select('COUNT(cpf) as transactions_payed');
        $this->db->from('transactions');
        $this->db->where('status_id <>', transactions_status::BEGINNER);        
        $this->db->where('cpf', $cpf);        
        return $this->db->get()->row_array()['transactions_payed'];
    }
    
    public function my_filter_like($token){
        $this->db->like('sender',$token);
        $this->db->or_like('msg',$token);
        
        //transaction
        /*id
        cpf
        name
        email
        phone_number
        cep
        ccb_number
        affiliate_code
        contract_id
        amount_solicited
        utm_source
        state_address
        city_address*/
        
        //account_banks
        /*titular_name
        titular_cpf*/
        
        //credit_card_name
        /*credit_card_name*/
    }
    

}
