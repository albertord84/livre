<?php

ini_set('xdebug.var_display_max_depth', 17);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 8024);

date_default_timezone_set('America/Sao_Paulo'); 

class Welcome extends CI_Controller {
          
    function __construct() {
        parent::__construct();
    }

    public function test_cr(){
        $this->load->model('class/Crypt');
        echo $this->Crypt->crypt('1');
    }
    
    public function test5(){
        //$this->load->model('class/transaction_model');
        //$this->transaction_model->save_generated_bill(1, '33333333444444444');
        //$hoje = strtotime("now");        
        //$d = getdate($hoje);
        //$da = date("Y-m-d");
        //$this->robot_conciliation();
        /*$trasactions = $this->topazio_conciliations("2018-09-20");
        foreach ($trasactions as $t) {
            var_dump($t);
        }*/
    }
   
    public function test3(){
        /*$_SESSION['logged_role']= 'ADMIN';
        $resp = $this->topazio_emprestimo(4); //1388,1542
        if($resp['success']){
            $this->transaction_model->save_in_db(
                    'transactions',
                    'id',4,
                    'ccb_number',$resp['ccb']);                
            $this->transaction_model->save_in_db(
                    'transactions',
                    'id',4,
                    'contract_id',$resp['contract_id']);                
            print_r("ok");
        }/**/
        //var_dump($resp);
    }    
        
    public function test_sig(){
        /*$id = 4;
        $uudid_doc = $this->upload_document_template_D4Sign($id);
        if($uudid_doc){
            //4. cadastrar un signatario para ese docuemnto y guardar token del signatario
            $token_signer = $this->signer_for_doc_D4Sign($id);
            if($token_signer){
                //5.  mandar a assinar
                $result_send = $this->send_for_sign_document_D4Sign($id);
                if($result_send){
                    //2. salvar el status para WAIT_SIGNATURE
                    $this->transaction_model->update_transaction_status(
                                        $_SESSION['pk'], 
                                        transactions_status::WAIT_SIGNATURE);
                }
            }
        }*/
    }
    
    public function update_acount_bank_by_user_id() {//para trabajar manual
        $this->load->model('class/Transaction_model');    
        $this->load->model('class/Crypt');  
        $datas['pk']=198;
        $datas['bank']=341;
        $datas['agency']=1412;
        $datas['account_type']='CC';
        $datas['account']=50021;
        $datas['dig']=5;  
        
        $datas1['client_id']=$datas['pk'];
        $datas1['bank']= $this->Crypt->crypt($datas['bank']);
        $datas1['agency']= $this->Crypt->crypt($datas['agency']);
        $datas1['account_type']= $this->Crypt->crypt($datas['account_type']);
        $datas1['account']= $this->Crypt->crypt($datas['account']);
        $datas1['dig']= $this->Crypt->crypt($datas['dig']); 
        
        var_dump($datas1);
    }
    
    public function conciliation_by_partnerId(){ 
        $partnerId = $_GET['partnerId'];
        $trasactions = $this->topazio_conciliations_by_partnerId($partnerId);
        var_dump($trasactions);
    }
    
    public function test_crontab(){
        echo "<br>\n<br>\n----------  INIT TEST CRONTAB AT ".date('Y-m-d H:i:s',time());
    }
    
    public function test_crontab2(){
        echo "<br>\n<br>\n----------  INIT TEST CRONTAB2 AT ".date('Y-m-d H:i:s',time());
    }
    
    //-------VIEWS FUNCTIONS--------------------------------    

    public function index() {         
        if($this->is_ip_hacker_response()){
            die('Sitio atualmente inacessível');
            return;
        }
        $this->set_session(); 
        $datas = $this->input->get();
        if(isset($datas['afiliado']))
            $_SESSION['affiliate_code'] = $datas['afiliado'];
        else
            $_SESSION['affiliate_code'] = '';
        if(isset($datas['utm_source']) && $datas['utm_source']!=NULL)
            $_SESSION['utm_source'] = $datas['utm_source'];
        else
            $_SESSION['utm_source'] = '';
        
        if(isset($datas['utm_campaign']) && $datas['utm_campaign']!=NULL)
            $_SESSION['utm_campaign'] = $datas['utm_campaign'];
        else
            $_SESSION['utm_campaign'] = '';
        
        if(isset($datas['utm_content']) && $datas['utm_content']!=NULL)
            $_SESSION['utm_content'] = $datas['utm_content'];
        else
            $_SESSION['utm_content'] = '';
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
        $params['key']=$_SESSION['key'];
        $this->load->view('index',$params);
        $this->load->view('inc/footer');
    }
    
    public function checkout() {
        $this->load->model('class/track_money_model');
        //die('This functionalities is under development :-)');
        if(session_id()=='')header('Location: '.base_url());
        if(!$_SESSION['transaction_values']['amount_months'])header('Location: '.base_url());
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
        $params['key']=$_SESSION['key'];
        $_SESSION['transaction_values']['frm_money_use_form']=$this->input->get()['frm_money_use_form'];
        $_SESSION['transaction_values']['utm_source']=$this->input->get()['utm_source'];
        $_SESSION['transaction_values']['utm_campaign']=$this->input->get()['utm_campaign'];
        $_SESSION['transaction_values']['utm_content']=$this->input->get()['utm_content'];
        
        $params['month_value']  = str_replace('.', ',',$_SESSION['transaction_values']['month_value']); 
        $params['solicited_value']  = str_replace('.', ',', $_SESSION['transaction_values']['solicited_value']); 
        $params['amount_months']  = $_SESSION['transaction_values']['amount_months']; 
        $params['tax']  = str_replace('.', ',', $_SESSION['transaction_values']['tax']); 
        $params['total_cust_value']  = str_replace('.', ',', $_SESSION['transaction_values']['total_cust_value']); 
        $params['IOF']  = str_replace('.', ',', $_SESSION['transaction_values']['IOF']); 
        $params['CET_PERC']  = str_replace('.', ',', $_SESSION['transaction_values']['CET_PERC']); 
        $params['CET_YEAR']  = str_replace('.', ',', $_SESSION['transaction_values']['CET_YEAR']); 
        //save value
        $data_track['solicited_value'] = $_SESSION['transaction_values']['solicited_value']*100;
        $data_track['ip']= $_SERVER['REMOTE_ADDR'];
        $data_track['track_date']=time();
        $id_row = $this->track_money_model->insert_required_money($data_track);
                
        $this->load->view('checkout',$params);
        $this->load->view('inc/footer');
    }
    
    public function suceso_compra(){
        if($_SESSION['buy'] == true){
            $this->load->model('class/system_config');
            $GLOBALS['sistem_config'] = $this->system_config->load();
            $params = $this->input->get();        
            $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
            session_destroy();
            $this->load->view('sucesso-compra',$params);
            $this->load->view('inc/footer');
        }
        else{
            session_destroy();
            header('Location: '.base_url());
        }
    }
    
    public function list_afiliados() {
        $this->load->model('class/affiliate_model');
        $this->load->model('class/Crypt');
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
        if($_SESSION['logged_role'] === 'ADMIN'){
            $_SESSION['affiliates'] = $this->affiliate_model->load_afiliates();
            $this->load->view('list_afiliados',$params);
        }
    }
    
    public function afhome() {
        $this->set_session();
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
        $params['key']=$_SESSION['key']; 
        $this->load->view('afiliados_home',$params);
    }
    
    public function painel(){
        if($_SESSION['logged_id']>0){
            if($_SESSION['logged_role'] === 'AFFIL'){
                header('Location: '.base_url().'index.php/welcome/afiliados');
            } elseif($_SESSION['logged_role'] === 'ADMIN'){
                header('Location: '.base_url().'index.php/welcome/transacoes');
            }
        }else
            header('Location: '.base_url().'index.php/welcome/afhome');
    }
    
    public function afiliados() {
        if($_SESSION['logged_role'] === 'AFFIL'){
            if(count($_POST))
                $datas=$_POST;
            else{
                $datas['num_page']=1;
                $datas['token']='';
            }
            $this->load->model('class/affiliate_model');
            $this->load->model('class/Crypt');
            $this->load->model('class/system_config');
            $GLOBALS['sistem_config'] = $this->system_config->load();
            $_SESSION['affiliate_logged_datas'] = $this->affiliate_model->load_afiliate_information($_SESSION['logged_id']);
            $_SESSION['affiliate_logged_transactions'] = $this->affiliate_model->load_transactions(
                    $_SESSION['affiliate_logged_datas']['code'],
                    $datas['num_page']-1,
                    $GLOBALS['sistem_config']->TRANSACTIONS_BY_PAGE,
                    $datas['token'],
                    NULL,
                    NULL,
                    $has_next_page);
            $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
            $params['num_page']=$datas['num_page'];
            $params['has_next_page']=$has_next_page;
            $_SESSION['affiliate_logged_datas']['bank_name'] =  $this->Crypt->get_bank_by_code($_SESSION['affiliate_logged_datas']['bank']);
            $_SESSION['affiliate_logged_datas']['amount_transactions']=count($_SESSION['affiliate_logged_transactions']);
            if($_SESSION['affiliate_logged_datas']['amount_transactions']){
                $_SESSION['affiliate_logged_datas']['total_value'] = 0;
                foreach($_SESSION['affiliate_logged_transactions'] as $transaction){
                    $_SESSION['affiliate_logged_datas']['total_value'] += $transaction['amount_solicited'];
                }
            }else{
                $_SESSION['affiliate_logged_datas']['total_value'] = '0.00';
            }
            $this->load->view('afiliados',$params);            
        } else{
            header('Location: '.base_url().'index.php/welcome/afhome');
        }
    }
    
    public function transacoes() {
        if($_SESSION['logged_role'] === 'ADMIN'){
            
            $this->load->model('class/affiliate_model');
            $this->load->model('class/Crypt');
            $this->load->model('class/system_config');
            $GLOBALS['sistem_config'] = $this->system_config->load();
            
            if(count($_POST))
                $datas=$_POST;
            else{
                $datas['num_page']=1;
                $datas['token']='';
                $datas['init_date']= date('Y-m-d', time()-$GLOBALS['sistem_config']->DAYS_AGO*24*60*60);
                $datas['end_date']='';
                $datas['status']=0;
            }
            $start_date = strtotime($datas['init_date']);
            if($start_date === false){
                $start_date = '';
            }
            $end_date = strtotime($datas['end_date']);
            if($end_date === false){
                $end_date = '';
            }
            else{
                $end_date += 23*60*60 + 59*60 + 59;
            }
            $status = $datas['status'];
            
            $_SESSION["filter_datas"]=$datas;
            $_SESSION['affiliate_logged_datas'] = $this->affiliate_model->load_afiliate_information($_SESSION['logged_id']);
            $_SESSION['affiliate_logged_transactions'] = $this->affiliate_model->load_transactions(
                    $_SESSION['affiliate_logged_datas']['code'],
                    $datas['num_page']-1,
                    $GLOBALS['sistem_config']->TRANSACTIONS_BY_PAGE,
                    $datas['token'],
                    $start_date,
                    $end_date,
                    $has_next_page,
                    $status);
            $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
            $params['num_page']=$datas['num_page'];
            $params['start_period']=$datas['init_date'];
            $params['end_period']=$datas['end_date'];
            $params['token']=$datas['token'];
            $params['status']=$datas['status'];
            $params['has_next_page']=$has_next_page;
            $params['view']='transacoes';
            $params['total_in_query']=$this->affiliate_model->num_in_load_transactions(
                    $_SESSION['affiliate_logged_datas']['code'],
                    $datas['num_page']-1,
                    $GLOBALS['sistem_config']->TRANSACTIONS_BY_PAGE,
                    $datas['token'],
                    $start_date,
                    $end_date,
                    $has_next_page,
                    $status);
            $params['last_page'] = ceil(1.0*$params['total_in_query']/$GLOBALS['sistem_config']->TRANSACTIONS_BY_PAGE);
            if($params['last_page'] == 0)
                $params['last_page'] = 1;
            $this->load->view('transacoes',$params);
        } else{
            header('Location: '.base_url().'index.php/welcome/afhome');
        }
    }
    
    public function resumo() {
        if($_SESSION['logged_role'] === 'ADMIN'){
            if(count($_POST))
                $datas=$_POST;
            else{
                $datas['abstract_init_date']='';
                $datas['abstract_end_date']='';
            }            
            $this->load->model('class/system_config');
            $this->load->model('class/affiliate_model');
            $GLOBALS['sistem_config'] = $this->system_config->load();
            $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
            $params['view'] = 'resumo';            
            $params['total_transactions'] = $this->affiliate_model->total_transactions($datas);
            $params['total_CET'] = number_format($this->affiliate_model->total_CET($datas)/100, 2, ',', '.');           
            $params['loan_value'] = number_format($this->affiliate_model->loan_value($datas)/100, 2, '.', '');
            $params['average_ticket'] = number_format($params['loan_value']/$params['total_transactions'], 2, ',', '.');
            $params['loan_value'] = number_format($this->affiliate_model->loan_value($datas)/100, 2, ',', '.');//currentformat
            $params['average_amount_months'] = number_format($this->affiliate_model->average_amount_months($datas)/$params['total_transactions'], 2, '.', '');            
            /*--- TAX e IOF -----*/
            $sum_tax = 0; $sum_iof = 0;
            $has_next_page = true; $amount_by_page = 1000; $page = 0;
            while($has_next_page){
                $result = $this->affiliate_model->iof_tax_value($datas, $page, $amount_by_page, $has_next_page);
                foreach($result as $transaction){
                    $financials = $this->calculating_enconomical_values($transaction["amount_solicited"]/100, $transaction["number_plots"], $transaction["tax"], $transaction["tac"]);
                    $sum_iof += $financials['IOF'];
                    $sum_tax += $financials['tax'];
                }                
                $page++;
            }
            $params['average_iof'] = number_format(($sum_iof), 2, ',', '.');
            $params['average_tax'] = number_format($sum_tax/$params['total_transactions'], 2, '.', '');
            /*--------------*/
            $init_date_track = $datas['abstract_init_date'];//1539640062;
            $end_date_track = $datas['abstract_end_date'];//1539640062;
            
            $result_500 = $this->affiliate_model->ave_track_money(9999, 49999, $init_date_track, $end_date_track);
            $params['ave_track_money_500'] = number_format($result_500['ave_money']/100, 2, '.', '');
            $params['count_track_money_500'] = $result_500['count_money'];
            
            $result_3000 = $this->affiliate_model->ave_track_money(49999, 300000, $init_date_track, $end_date_track);
            $params['ave_track_money_3000'] = number_format($result_3000['ave_money']/100, 2, '.', '');           
            $params['count_track_money_3000'] = $result_3000['count_money'];
            
            $result_100000 = $this->affiliate_model->ave_track_money(300000, 10000000, $init_date_track, $end_date_track);
            $params['ave_track_money_100000'] = number_format($result_100000['ave_money']/100, 2, '.', '');           
            $params['count_track_money_100000'] = $result_100000['count_money'];
            
            $params['count_track_money_100_100000'] = $params['count_track_money_500'] + $params['count_track_money_3000'] + $params['count_track_money_100000'];
            if($params['count_track_money_100_100000'] != 0)
                $params['ave_track_money_100_100000'] = number_format(($params['ave_track_money_500']*$params['count_track_money_500'] + $params['ave_track_money_3000']*$params['count_track_money_3000'] + $params['ave_track_money_100000']*$params['count_track_money_100000'])/$params['count_track_money_100_100000'], 2, ',', '.');           
            else
                $params['ave_track_money_100_100000'] = 0;
            
            $params['ave_track_money_500'] = number_format($result_500['ave_money']/100, 2, ',', '.');
            $params['ave_track_money_3000'] = number_format($result_3000['ave_money']/100, 2, ',', '.');
            $params['ave_track_money_100000'] = number_format($result_100000['ave_money']/100, 2, ',', '.');           
            
            $this->load->view('resumo', $params);
        }
    }
    
    public function filter_resume() {
        if($_SESSION['logged_role'] === 'ADMIN'){
            if(count($_POST)){
                $datas=$_POST;
                if($datas['abstract_end_date'] != '')
                    $datas['abstract_end_date'] = (string)($datas['abstract_end_date'] + 23*60*60+59*60);
            }
            else{
                $datas['abstract_init_date']='';
                $datas['abstract_end_date']='';
            }
            $this->load->model('class/affiliate_model');
            
            $params['total_transactions'] = $this->affiliate_model->total_transactions($datas);
            if($params['total_transactions']){
                $params['total_CET'] = number_format($this->affiliate_model->total_CET($datas)/100, 2, ',', '.');           
                $params['loan_value'] = number_format($this->affiliate_model->loan_value($datas)/100, 2, '.', '');
                $params['average_ticket'] = number_format($params['loan_value']/$params['total_transactions'], 2, ',', '.');//$this->affiliate_model->average_ticket($datas);
                $params['loan_value'] = number_format($this->affiliate_model->loan_value($datas)/100, 2, ',', '.');
                $params['average_amount_months'] = number_format($this->affiliate_model->average_amount_months($datas)/$params['total_transactions'], 2, '.', '');            
                /*--- TAX e IOF -----*/
            $sum_tax = 0; $sum_iof = 0;
            $has_next_page = true; $amount_by_page = 1000; $page = 0;
            while($has_next_page){
                $result = $this->affiliate_model->iof_tax_value($datas, $page, $amount_by_page, $has_next_page);
                foreach($result as $transaction){
                    $financials = $this->calculating_enconomical_values($transaction["amount_solicited"]/100, $transaction["number_plots"], $transaction["tax"], $transaction["tac"]);
                    $sum_iof += $financials['IOF'];
                    $sum_tax += $financials['tax'];
                }                
                $page++;
            }
            $params['average_iof'] = number_format(($sum_iof), 2, ',', '.');
            $params['average_tax'] = number_format($sum_tax/$params['total_transactions'], 2, '.', '');
            }
            else{
                $params['total_CET'] = "0,00";
                $params['loan_value'] = "0,00";
                $params['average_ticket'] = "0,00";
                $params['average_amount_months'] = '0';            
                $params['average_iof'] = "0,00";
                $params['average_tax'] = "0,00";
            }
            /*--------------*/
            $init_date_track = $datas['abstract_init_date'];//1539640062;
            $end_date_track = $datas['abstract_end_date'];//1539640062;
            
            $result_500 = $this->affiliate_model->ave_track_money(9999, 49999, $init_date_track, $end_date_track);
            $params['ave_track_money_500'] = number_format($result_500['ave_money']/100, 2, '.', '');           
            $params['count_track_money_500'] = $result_500['count_money'];
            
            $result_3000 = $this->affiliate_model->ave_track_money(49999, 300000, $init_date_track, $end_date_track);
            $params['ave_track_money_3000'] = number_format($result_3000['ave_money']/100, 2, '.', '');                       
            $params['count_track_money_3000'] = $result_3000['count_money'];
            
            $result_100000 = $this->affiliate_model->ave_track_money(300000, 10000000, $init_date_track, $end_date_track);
            $params['ave_track_money_100000'] = number_format($result_100000['ave_money']/100, 2, '.', '');                       
            $params['count_track_money_100000'] = $result_100000['count_money'];
            
            $params['count_track_money_100_100000'] = $params['count_track_money_500'] + $params['count_track_money_3000'] + $params['count_track_money_100000'];
            if($params['count_track_money_100_100000'] != 0)
                $params['ave_track_money_100_100000'] = number_format(($params['ave_track_money_500']*$params['count_track_money_500'] + $params['ave_track_money_3000']*$params['count_track_money_3000'] + $params['ave_track_money_100000']*$params['count_track_money_100000'])/$params['count_track_money_100_100000'], 2, ',', '.');           
            else
                $params['ave_track_money_100_100000'] = 0;
            
            $params['ave_track_money_500'] = number_format($result_500['ave_money']/100, 2, ',', '.');
            $params['ave_track_money_3000'] = number_format($result_3000['ave_money']/100, 2, ',', '.');
            $params['ave_track_money_100000'] = number_format($result_100000['ave_money']/100, 2, ',', '.');           
            
            echo json_encode($params);
        }
    }
    
    public function configuracoes() {
        if($_SESSION['logged_role'] === 'ADMIN'){
            $this->load->model('class/system_config');
            $GLOBALS['sistem_config'] = $this->system_config->load();
            $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
            $params['view']='configuracoes';
            $this->load->view('configuracoes');
        }
    }
        
    public function logout() {
        $this->load->model('class/watchdog');
        $this->load->model('class/watchdog_type');
            
        $register = ['user_id' => $_SESSION['logged_id'], 'type' => Watchdog_type::LOGOUT, 'date' => time(), 'ip' => $_SESSION['ip'], 'data' => $_SESSION['logged_id']];
        $this->watchdog->add_watchdog($register);
        
        session_unset();
        session_destroy();
        header('Location: '.base_url().'index.php/welcome/afhome');
    }
    
    //-------TRANSACTION FUNCTIONS--------------------------------    
    /*
    //varaiveis armazenadas na sessao para a solicitação de um empréstimo
    $_SESSION
    ['ip']
    ['pk']
    ['key']    
    ['front_credit_card']
    ['selfie_with_credit_card']
    ['open_identity']
    ['selfie_with_identity']
    ['transaction_values']['frm_money_use_form']
    ['transaction_values']['utm_source']
    ['transaction_values']['month_value'] 
    ['transaction_values']['total_cust_value']
    ['transaction_values']['solicited_value']
    ['transaction_values']['amount_months']
    ['transaction_values']['success']     
    ['client_datas']['random_sms_code']
    ['client_datas']['phone_ddd']
    ['client_datas']['sms_verificated']
    ['client_datas']['verified_phone']
    ['client_datas']['name']    
    ['client_datas']['email']

    //Dados do cartão para a BRASPAG
    ['b_card_name']
    ['b_card_number']
    ['b_card_cvv']
    ['b_card_exp_month']
    ['b_card_exp_year']
    ['brand']
    
    //Variaveis para subir novamente as fotos
    ['new_front_credit_card']
    ['new_selfie_with_credit_card']
    ['new_open_identity']
    ['new_selfie_with_identity']
    ['new_cpf_card']
    ['session_new_foto']
     
    //Variaveis retentativa
    ['captured'] : INT in [0,100]
    ['re_financials'] : ARRAY con index [month_value, amount_months, solicited_value, tax, total_cust_value, IOF, CET_PERC, CET_YEAR]    
    ['used_method'] : INT in [0,1,2..., MAX_NUM_PAYMENTS]
  
     */
    
    /* La funcion de pagamento debe devolver un arreglo con la siguiente estructura:
        
        [
            success
        ]
     
    */
    
    public function is_possible_steep_1_for_this_client($datas) {
        $this->load->model('class/transaction_model');
        $this->load->model('class/transactions_status');
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $_SESSION['is_possible_steep_1']=false;
        
        //1. Analisar se IP tem sido marcado como hacker
        $this->is_ip_hacker();        
        $data_hack = $this->is_data_hacker($datas);        
        if(!$data_hack['success']){
            $result = $data_hack;
            return $result;
        }
        $clients = $this->transaction_model->get_client('cpf',$datas['cpf']);
        //2. analisar CPF del pedido por los posibles status
        if($N=count($clients)){
            //3. un mismo CPF no puede ser usado em menos de 24 horas para pedir de nuevo se la transaccion en un estado diferente de beginner        
            $last_operation_time = $this->transaction_model->get_last_date_status($clients[$N-1]['id']);
            if(time()- $last_operation_time < 24*60*60){
                $result['message']='Não é permitido fazer mais de uma solicitação em menos de 24 hrs. ';
                $result['success']=false;
                
                //revisar esto de nuevo
                if($clients[$N-1]['status_id'] == transactions_status::REVERSE_MONEY){                
                    $result['message'] .= 'O seu anterior pedido foi negado. Entre em contato conosco através do atendimento, obrigado!';                    
                    return $result;
                }else
                if($clients[$N-1]['status_id'] == transactions_status::APPROVED){                
                    $result['message'] .= 'O seu anterior pedido foi aprovado e no momento está sendo gestionada a transferência para sua conta.';                    
                    return $result;
                }else                
                if($clients[$N-1]['status_id'] == transactions_status::WAIT_PHOTO){                
                    $result['message'] .= 'O seu anterior pedido está precisando de atualizar as fotos fornecidas.';                    
                    return $result;
                }else
                if($clients[$N-1]['status_id'] == transactions_status::WAIT_ACCOUNT){                
                    $result['message'] .= 'O seu anterior pedido está precisando de atualizar os dados bancários fornecidos.';                    
                    return $result;
                }else
                if($clients[$N-1]['status_id'] == transactions_status::WAIT_SIGNATURE){                
                    $result['message'] .= 'Se está analisando a sua assinatura no seu anterior pedido. Casso dúvidas, contate nosso atendimento.';                    
                    return $result;
                }else
                if($clients[$N-1]['status_id'] == transactions_status::PENDING){                
                    $result['message']='O seu anterior pedido está sendo analisado. Casso dúvidas, contate nosso atendimento.';                    
                    return $result;
                }else
                if($clients[$N-1]['status_id'] == transactions_status::TOPAZIO_APROVED){                
                    $result['message'] .= 'O seu anterior pedido foi aprovado e já foi solicitada a transferência para sua conta.';                    
                    return $result;
                }else
                if($clients[$N-1]['status_id'] == transactions_status::TOPAZIO_DENIED){                
                    $result['message']='O seu anterior pedido foi aprovado por nosso sistema, mas ocorreu um erro na transferência. Contate nosso atendimento.';                    
                    return $result;
                }else
                if($clients[$N-1]['status_id'] == transactions_status::TOPAZIO_IN_ANALISYS){                
                    $result['message']='O seu anterior pedido foi aprovado por nosso sistema e está sendo gestionada a transferência.';                    
                    return $result;
                }
            }
        }        
                
        //4. Analisar coerencia dos dados, exemplo:
        //4.1 mesmo cpf com nome diferentes        
        /*$nomes=array();
        $nomes[$datas['name']]=1;
        foreach ($clients as $client) {
            if(isset($nomes[$client['name']]))
                $nomes[$client['name']]+=1;
            else
                $nomes[$client['name']]=1;
        }
        if(count($nomes)>1){
        if($N > 0 && $clients[0]['name'] != $datas['name']){
            $result['message']="Este CPF foi usado anteriormente com um nome diferente, pode ter sido apenas uma variação, como um acento, por exemplo. Para mais informações entre em contato através de seja@livre.digital para resolvermos isso para você. ";
            $result['success']=false;
            return $result;
        }*/
        
        //4.2 mesmo telefone com nome diferentes
        /*$clients = $this->transaction_model->get_client('phone_number',$datas['phone_number']);
        $nomes=array();
        foreach ($clients as $client) {
            if(isset($nomes[$client['name']]))
                $nomes[$client['name']]+=1;
            else
                $nomes[$client['name']]=1;
        }
        if(count($nomes)>1){
        if(count($clients) > 0 && $clients[0]['name'] != $datas['name']){
            $result['message']="Este telefone foi usado anteriormente com um nome diferente, pode ter sido apenas uma variação, como um acento, por exemplo. Para mais informações entre em contato através de seja@livre.digital para resolvermos isso para você. ";
            $result['success']=false;
            $_SESSION['client_datas']['sms_verificated'] = false;
            return $result;
        }*/
        
        //4.3 mesmo telefone com diferentes cpf
        /*$cpfs=array();
        foreach($clients as $client) {
            if(isset($cpfs[$client['cpf']]))
                $cpfs[$client['cpf']]+=1;
            else
                $cpfs[$client['cpf']]=1;
        }
        if(count($cpfs)>1){
        if(count($clients) > 0 && $clients[0]['cpf'] != $datas['cpf']){
            $result['message']="Sua solicitação foi negada devido a que esse telefone tem sido usado com o cpf ".$clients[0]['cpf'].". Por favor, contate nosso atendimento";
            $result['success']=false;
            $_SESSION['client_datas']['sms_verificated'] = false;
            return $result;
        }*/
        
        //5. Analisar BEGINNER purchase_counter pelo cpf
        $clients = $this->transaction_model->get_client('cpf', $datas['cpf'], transactions_status::BEGINNER);
        if(count($clients)>1){ //caso imposivel, so por inconsistencia no sistema, po puede haber más de um beginner com o mesmo CPF
            $result['message']='Solicitação não permitida devido a inconsistência no sistema. Informe ao nossso atendimento';
            $result['success']=false;
            return $result;
        }
        //6. Verificar que no haya cambiado el nro de telefono
        if(isset($_SESSION['client_datas']['verified_phone']) && $_SESSION['client_datas']['verified_phone'] != $datas['phone_number']){
            $_SESSION['client_datas']['sms_verificated'] = false;
        }
        
        if(count($clients)==0){
            if($_SESSION['client_datas']['sms_verificated'] === true){
                $result['action']='insert_beginner';
                $result['success']=true;
                $_SESSION['is_possible_steep_1']=true;
                return $result;
            }
            else
            {
                $result['message']='Deve verificar novamente seu telefone';
                $result['success']=false;
                return $result;
            }
        }
        if(count($clients)==1){            
            if($clients[0]['purchase_counter']<=$GLOBALS['sistem_config']->MAX_PURCHASE_TENTATIVES){
                if($_SESSION['client_datas']['sms_verificated'] === true){
                    $result['id'] = $clients[0]['id'];
                    $result['success']=true;
                    $result['action']='update_beginner';
                    $_SESSION['is_possible_steep_1']=true;
                    return $result;
                }
                else
                {
                    $result['message']='Deve verificar novamente seu telefone';
                    $result['success']=false;
                    return $result;
                }
            }else{
                $result['message']='Não autorizado. Quantidade máxima de tentativas alcançadas. Contate nosso atendimento';
                $result['success']=false;
                session_destroy();
                return $result;
            }
        }
    }
    
    public function insert_datas_steep_1(){       
        //1. Analisar se IP tem sido marcado como hacker
        //$this->is_ip_hacker();
        if(!$_SESSION['transaction_values']['amount_months']){
            $result['message']='Sessão expirou';
            $result['success']=false;
            echo json_encode($result);
            return;
        }
        $this->load->model('class/transaction_model');
        $this->load->model('class/transactions_status');
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $datas = $this->input->post();
        if($datas['key']!==$_SESSION['key']){
            $result['message']='Autorização negada. Violação de acesso';
            $result['success']=false;
        }else{
            $this->load->model('class/transaction_model');            
            $datas['HTTP_SERVER_VARS'] = json_encode($_SERVER);        
            $datas['affiliate_code'] = $_SESSION['affiliate_code'];        
            $datas['utm_source'] = $_SESSION['utm_source'];        
            $datas['utm_campaign'] = $_SESSION['utm_campaign'];        
            $datas['utm_content'] = $_SESSION['utm_content'];        
            if(!$this->validate_all_general_user_datas($datas)){
                $result['success'] = false;
                $result['message'] = 'Erro nos dados fornecidos';
            } else{
                $possible = $this->is_possible_steep_1_for_this_client($datas);
                if(!$_SESSION['is_possible_steep_1']){
                    $result['message']= $possible['message'];
                    $result['success']=false;
                } else
                if($possible['success']){
                    $datas['number_plots'] = $_SESSION['transaction_values']['amount_months'];
                    $datas['amount_solicited'] = $_SESSION['transaction_values']['solicited_value']*100;
                    $datas['total_effective_cost'] = $_SESSION['transaction_values']['total_cust_value']*100;
                    $datas['tax'] = $_SESSION['transaction_values']['tax'];
                    $datas['tac'] = $_SESSION['transaction_values']['TAC_PERC'];
                    $datas['way_to_spend'] = $_SESSION['transaction_values']['frm_money_use_form'];
                    $new_beginner_date = false;
                    if($possible['action']==='insert_beginner'){
                        $datas['folder_in_server']=  $datas["cpf"]."_".time();
                        $id_row = $this->transaction_model->insert_db_steep_1($datas); 
                        $new_beginner_date = true;
                    }
                    else{
                        $id_row = $this->transaction_model->update_db_steep_1($datas,$possible['id']);
                        if($id_row){
                            $id_row=$possible['id'];}
                    }
                    if($id_row){
                        $this->transaction_model->update_transaction_status(
                            $id_row, 
                            transactions_status::BEGINNER,
                            $new_beginner_date    
                                );
                        $_SESSION['client_datas']['name'] = $datas['name'];
                        $_SESSION['client_datas']['email'] = $datas['email'];
                        $result['success'] = true;
                        $result['pk'] = $id_row;
                        $_SESSION['pk'] = $id_row;                        
                    }
                    else{
                        $result['success'] = false;
                        $result['message'] = 'Erro interno no banco de dados';
                        $_SESSION['is_possible_steep_1']=false;
                    }
                } else{
                    $result=$possible;
                }
            }
        }
        echo json_encode($result);
    }
    
    public function is_possible_steep_2_for_this_client($datas) { 
        $this->load->model('class/transaction_model');
        $_SESSION['is_possible_steep_2']=false;
        //1. Analisar se IP tem sido marcado como hacker
        $this->is_ip_hacker();
        //2. Analisar cartões bloqueados e nomes de hackers
        $card_bloqued = ["5178057308185854","5178057258138580","4500040041538532", "4984537159084527"];
        $name_bloqued = [ "JUNIOR SUMA", "JUNIOR LIMA", "JUNIOR SANTOS","JUNIOR S SILVA", "FERNANDO ALVES", "LUCAS BORSATTO22", "LUCAS BORSATTO", "GABRIEL CASTELLI", "ANA SURIA", "HENDRYO SOUZA", "JOAO ANAKIM", "JUNIOR FRANCO", "FENANDO SOUZA", "CARLOS SANTOS", "DANIEL SOUZA", "SKYLE JUNIOR", "EDEDMUEDEDMUNDOEDEDMUEDEDMUNDO", "EDEMUNDO LOPPES", "JUNIOR KARLOS", "ZULMIRA FERNANDES", 'JUNIOR FREITAS'];
        /** comentado por Moreno, no se van a usar estas comparaciones abajo
        if(in_array($datas['credit_card_number'],$card_bloqued)){
            $result['message']='O número do cartão informado não pode ser usado. Por favor, contate nosso atendimento';
            $result['success']=false;
            return $result;
        }
         */
        if(in_array($datas['credit_card_name'],$name_bloqued)){
            $result['message']='O nome no cartão informado não pode ser usado. Por favor, contate nosso atendimento';
            $result['success']=false;
            return $result;
        }
        /** comentado por Moreno, no se van a usar estas comparaciones abajo en la nueva version     
        //3. Ver incoerencias entre numero do cartão, cvv, e nome do cliente
            //3.1 Avaliando incoerencias entre credit_card_number e cpf
        $credit_cards = $this->transaction_model->get_credit_card('credit_card_number', $datas['credit_card_number']);
        $cpfs=array();
        $cpfs[$datas['cpf']]=1;
        foreach ($credit_cards as $credit_card) {
            if(isset($cpfs[$credit_card['cpf']]))
                $cpfs[$credit_card['cpf']]+=1;
            else
                $cpfs[$credit_card['cpf']]=1;
        }
        if(count($cpfs)>1){
            $result['message']='Sua solicitação foi negada.<BR> Foi detectada uma incoerencia entre o número do cartão e o CPF. Por favor, contate nosso atendimento';
            $result['success']=false;
            return $result;
        }
        //3.2 Avaliando incoerencias entre credit_card_number e name
        $names=array();
        $names[$datas['cpf']]=1;
        foreach ($credit_cards as $credit_card) {
            if(isset($names[$credit_card['credit_card_name']]))
                $names[$credit_card['credit_card_name']]+=1;
            else
                $names[$credit_card['credit_card_name']]=1;
        }
        if(count($names)>1){
            $result['message']='Sua solicitação foi negada.<BR> Foi detectada uma incoerencia entre o número e o nome do cartão. Por favor, contate nosso atendimento';
            $result['success']=false;
            return $result;
        }
        //3.3 Avaliando incoerencias entre credit_card_number e cvv
        $cvvs=array();
        $cvvs[$datas['cpf']]=1;
        foreach ($credit_cards as $credit_card) {
            if(isset($cvvs[$credit_card['credit_card_cvv']]))
                $cvvs[$credit_card['credit_card_cvv']]+=1;
            else
                $cvvs[$credit_card['credit_card_cvv']]=1;
        }
        if(count($cvvs)>1){
            $result['message']='Sua solicitação foi negada.<BR> Foi detectada uma incoerencia entre o número e o nome do cartão. Por favor, contate nosso atendimento';
            $result['success']=false;
            return $result;
        }
        Fin del comentario 
        */
        //4. Analisar se é para atualizar ou inserir nova linha
        $credit_cards = $this->transaction_model->get_credit_card('client_id', $datas['pk']);
        if(count($credit_cards)){
            $result['action']='update_credit_card';
            $result['client_id']=$credit_cards[0]['client_id'];
            $result['success']=true;
            $_SESSION['is_possible_steep_2']=true;
            return $result;            
        } else{
            $result['action']='insert_credit_card';
            $_SESSION['is_possible_steep_2']=true;
            $result['success']=true;
            return $result;
        }        
    }
    
    public function insert_datas_steep_2() {        
        if(!$_SESSION['transaction_values']['amount_months']){
            $result['message']='Sessão expirou';
            $result['success']=false;
            echo json_encode($result);
            return;
        }
        /*--------------analisis del nro de tentativas-------------------*/
        $this->load->model('class/system_config');
        $this->load->model('class/transaction_model');            
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $transaction = $this->transaction_model->get_client('id', $_SESSION['pk'])[0];
        if($transaction['purchase_counter']>$GLOBALS['sistem_config']->MAX_PURCHASE_TENTATIVES){
            $result['message']='Não autorizado. Quantidade máxima de tentativas alcançadas. Contate nosso atendimento';
            $result['success']=false;
            echo json_encode($result);
            session_destroy();
            return;
        }
        /*---------------------------------*/
        $datas = $this->input->post();
        if(!$_SESSION['is_possible_steep_1'] || $datas['key']!==$_SESSION['key']){
            $result['message']='Autorização negada. Violação de acesso';
            $result['success']=false;
        }else{            
            $datas['pk'] = $_SESSION['pk'];
            if(!$this->validate_all_credit_card_datas($datas)){
                $result['success'] = false;
                $result['message'] = 'Erro nos dados fornecidos';
            } else{
                $possible = $this->is_possible_steep_2_for_this_client($datas);
                if(!$_SESSION['is_possible_steep_2']){
                    $result['message']= $possible['message'];
                    $result['success']=false;
                } else
                if($possible['success']){                    
                    //fake fields for cohenrence
                    $datas['credit_card_exp_month'] = "XX";
                    $datas['credit_card_exp_year'] = "XXXX";
                    $datas['credit_card_cvv'] = "XXX";
                    $datas['credit_card_number'] = "XXXX".$datas['credit_card_number'];
                    
                    $_SESSION['b_card_name'] = $datas['b_card_name'];
                    $_SESSION['b_card_number'] = $datas['b_card_number'];
                    $_SESSION['b_card_cvv'] = $datas['b_card_cvv'];
                    $_SESSION['b_card_exp_month'] = $datas['b_card_exp_month'];
                    $_SESSION['b_card_exp_year'] = $datas['b_card_exp_year'];
                    $_SESSION['brand'] = $datas['brand'];
                    
                    if($possible['action']==='insert_credit_card'){
                        $id_row = $this->transaction_model->insert_db_steep_2($datas);
                    }
                    else
                        $id_row = $this->transaction_model->update_db_steep_2($datas,$possible['client_id']);
                    if($id_row){
                        $response['success'] = TRUE; 
                        $response['message'] = "Cartão adicionado";
                        $result['success'] = $response['success'];
                        $result['message'] = $response['message'];
                    }
                    else{
                        $result['success'] = false;
                        $result['message'] = 'Erro interno no banco de dados';
                        $_SESSION['is_possible_steep_2']=false;
                    }
                } else{
                    $result=$possible;
                }
            }
        }
        echo json_encode($result);
    }
    
    public function is_possible_steep_3_for_this_client($datas) {
        $_SESSION['is_possible_steep_3']=false;       
        $this->load->model('class/transaction_model');
        $this->load->model('class/transactions_status');
        //0. Conferindo CPFs do passo 1 e passo 3
        $client = $this->transaction_model->get_client('id', $datas['pk']);    
        $a=$datas['titular_cpf'];
        $b=$client[0]['cpf'];
        $c=$a!==$b;        
        if($datas['titular_cpf']!==$client[0]['cpf']){
            $result['message']='Operação não permitida. CPF informado não coincide com o do Passo 1';
            $result['success']=false;
            return $result;
        }        
        //1. Conferindo nome do passo 1 e passo 3
        if($datas['titular_name']!==$client[0]['name']){
            $result['message']='Operação não permitida. O nome informado não coincide com o do Passo 1';
            $result['success']=false;
            return $result;
        }        
        //2. Analisar incoerencias conta-nome e conta-cpf
            //2.1 Incoerencia conta-nome
        $all_accounts = $this->transaction_model->get_account_banks($datas['bank'],$datas['agency'],$datas['account']);
        $names=array();
        $names[$datas['titular_name']]=1;
        foreach($all_accounts as $acc){
            if(isset($names[$acc['titular_name']]))
                $names[$acc['titular_name']]+=1;
            else
                $names[$acc['titular_name']]=1;
        }
        if(count($names)>1){
            $result['message']='A conta informada já foi cadastrada em nosso sistema, entre em contato através do e-mail.';
            $result['success']=false;
            return $result;
        }
            //2.2 Incoerencia conta-cpf
        $names=array();
        $names[$datas['titular_cpf']]=1;
        foreach($all_accounts as $acc){
            if(isset($names[$acc['titular_cpf']]))
                $names[$acc['titular_cpf']]+=1;
            else
                $names[$acc['titular_cpf']]=1;
        }
        if(count($names)>1){
            $result['message']='A conta informada já foi cadastrada em nosso sistema, entre em contato através do e-mail.';
            $result['success']=false;
            return $result;
        }
        //4. Analisar se é para atualizar ou inserir nova conta bancária
        $account_bank = $this->transaction_model->get_account_bank_by_client_id($datas['pk'],0);
        if(count($account_bank)===1){
            $result['action']='update_account_bank';
            $result['client_id']=$account_bank[0]['client_id'];
            $result['success']=true;
            $_SESSION['is_possible_steep_3']=true;
            return $result;
        } else{
            $result['action']='insert_account_bank';
            $result['success']=true;
            $_SESSION['is_possible_steep_3']=true;
            return $result;
        }
    }
    
    public function insert_datas_steep_3() {
        if(!$_SESSION['transaction_values']['amount_months']){
            $result['message']='Sessão expirou';
            $result['success']=false;
            echo json_encode($result);
            return;
        }
        $datas = $this->input->post();
        if(!$_SESSION['is_possible_steep_1'] || !$_SESSION['is_possible_steep_2'] || $datas['key']!==$_SESSION['key']){
            $result['message']='Autorização negada. Violação de acesso';
            $result['success']=false;
        }else{
            $this->load->model('class/transaction_model');            
            $datas['solicited_value'] = $_SESSION['transaction_values']['solicited_value'];        
            $datas['amount_months' ] =  $_SESSION['transaction_values']['amount_months'];
            $datas['pk' ] =  $_SESSION['pk'];
            $verify_simulation = $this->verify_simulation($datas);
            if(!$this->validate_bank_datas($datas)){
                $result['success'] = false;
                $result['message'] = 'Erro nos dados bancários fornecidos';
            } else
            {
                $possible = $this->is_possible_steep_3_for_this_client($datas);
                if(!$_SESSION['is_possible_steep_3']){
                    $result['message']= $possible['message'];
                    $result['success']=false;
                } else
                if($possible['success'] && $verify_simulation['success']){
                    $datas['propietary_type'] = 0;
                    if($possible['action']==='insert_account_bank')
                        $id_row = $this->transaction_model->insert_db_steep_3($datas);                    
                    else
                        $id_row = $this->transaction_model->update_db_steep_3($datas,$possible['client_id']);
                    if($id_row){                        
                        $result['success'] = true;
                    }
                    else{
                        $result['success'] = false;
                        $_SESSION['is_possible_steep_3']=false;
                        $result['message'] = 'Erro interno no banco de dados';
                    }
                } else{
                    $result=$possible;
                }
            }
        }
        echo json_encode($result);
    }
    
    public function sign_contract_transactions() {
        if(!$_SESSION['transaction_values']['amount_months']){
            $result['message']='Sessão expirou';
            $result['success']=false;
            echo json_encode($result);
            return;
        }
        $this->load->model('class/system_config');
        $this->load->model('class/transaction_model');
        $this->load->model('class/transactions_status');        
        $this->load->model('class/payment_manager');
        
        require_once ($_SERVER['DOCUMENT_ROOT']."/livre/application/libraries/Gmail.php");
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $this->Gmail = new Gmail();
        $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
        
        /*------------analisar nro de tentativas----------------*/
        $transaction = $this->transaction_model->get_client('id', $_SESSION['pk'])[0];
        if($transaction['purchase_counter']>$GLOBALS['sistem_config']->MAX_PURCHASE_TENTATIVES){
            $result['message']='Não autorizado. Quantidade máxima de tentativas alcançadas. Contate nosso atendimento';
            $result['success']=false;
            echo json_encode($result);
            session_destroy();
            return;
        }
        $datas = $this->input->post();
        $cpf_upload = true;
        if($datas['ucpf'] == 'true' && !$_SESSION['cpf_card']){            
            $cpf_upload = false;
        }            
        if($_SESSION['is_possible_steep_1'] && $_SESSION['is_possible_steep_2'] && $_SESSION['is_possible_steep_3'] && $datas['key']===$_SESSION['key']){
            if($_SESSION['front_credit_card'] && $_SESSION['selfie_with_credit_card'] && $_SESSION['open_identity'] && $_SESSION['selfie_with_identity'] && $cpf_upload){                           
                $value_ucpf = 0;
                if($datas['ucpf'] == 'true')
                    $value_ucpf = 1;
                $this->transaction_model->save_cpf_card($_SESSION['pk'], $value_ucpf);
                
                $PAYMENT_ARRAY = [ payment_manager::IUGU => ['name' => payment_manager::NAME_IUGU, 'valid' => false],
                                   payment_manager::BRASPAG => ['name' => payment_manager::NAME_BRASPAG, 'valid' => true] 
                                 ];
                $result['success'] = false;
                $result['authorized'] = false;
                
                if(!$_SESSION['used_method']){ //pregunta si fue pre-autorizado
                    //ver si puede cobrar/pre-autorizar por algun método
                    foreach ($PAYMENT_ARRAY as $key => $value) {
                        if($PAYMENT_ARRAY[$key]['valid']){ // is an active valid method                        
                            $response = $this->do_payment($_SESSION['pk'], $key);
                            if($response['success']){
                                //salvar por ciento capturado
                                $_SESSION['captured'] = 100;
                                $result['success'] = true;
                                break;
                            }
                            else{                                
                                if($response['captured'] > 0){
                                    $_SESSION['used_method'] = $key;                                
                                    break;
                                }
                            }
                        }
                    }
                }
                else{
                    //actualizar variaveis do sistema
                    $_SESSION['transaction_values'] = $_SESSION['re_financials'];
                    //actualizar en BD
                    $this->transaction_model->update_financials($_SESSION['pk'], $_SESSION['re_financials']);
                    //realizar el cobro
                    $response = $this->do_payment($_SESSION['pk'], $_SESSION['used_method']);
                    if($response['success'])
                        $result['success'] = true;                                
                }
                
                /**** ANALISAR SE FOI OU NÂO COBRADO**/
                if($result['success']){                    
                    //generate and save contract
                    $string_param = "transactionId=".$_SESSION['pk']
                                    . "&transactionAffiliation=site"
                                    . "&transactionTotal=".$_SESSION['transaction_values']['total_cust_value']
                                    . "&solicited_value=".$_SESSION['transaction_values']['solicited_value']
                                    . "&amount_months=".$_SESSION['transaction_values']['amount_months']
                                    . "&name=".explode(' ',$_SESSION['client_datas']['name'])[0] ;                                           
                    //3. crear documento a partir de plantilla y guardar token del documento en la BD
                    $uudid_doc = $this->upload_document_template_D4Sign($_SESSION['pk']);
                    if($uudid_doc){
                        //4. cadastrar un signatario para ese docuemnto y guardar token del signatario
                        $token_signer = $this->signer_for_doc_D4Sign($_SESSION['pk']);
                        if($token_signer){
                            //5.  mandar a assinar
                            $result_send = $this->send_for_sign_document_D4Sign($_SESSION['pk']);
                            if($result_send){
                                //2. salvar el status para WAIT_SIGNATURE
                                $this->transaction_model->update_transaction_status(
                                                    $_SESSION['pk'], 
                                                    transactions_status::WAIT_SIGNATURE);                                                                   
                            }
                            else{
                                $this->transaction_model->update_transaction_status(
                                                    $_SESSION['pk'], 
                                                    transactions_status::PENDING);                        
                            }
                        }
                        else{
                            $this->transaction_model->update_transaction_status(
                                                    $_SESSION['pk'], 
                                                    transactions_status::PENDING);                        
                        }
                    }else{
                        $this->transaction_model->update_transaction_status(
                                                    $_SESSION['pk'], 
                                                    transactions_status::PENDING);                        
                    }
                    //sucesso de contrato se foi cobrado
                    $this->transaction_model->save_in_db(
                            'transactions',
                            'id',$_SESSION['pk'],
                            'captured', $_SESSION['captured']);
                    
                    $_SESSION['used_method'] = 0;
                    $_SESSION['re_financials'] = NULL;
                    $_SESSION['captured'] = 0;
                    $_SESSION['buy'] = true;                    
                    $result['success'] = true;
                    $result['params'] = $string_param;                                        
                }
                else{
                    if($response['captured'] == 0){                    
                        //process error 
                        //incrementar numero de tentativas para evitar teste de cartão                                        
                        $purchase_counter = $transaction['purchase_counter'] + 1;
                        $this->transaction_model->save_in_db(
                            'transactions',
                            'id',$_SESSION['pk'],
                            'purchase_counter', $purchase_counter);
                        /*-----------------------------------------*/
                        $name = explode(' ', $_SESSION['client_datas']['name']); $name = $name[0];
                        $useremail = $_SESSION['client_datas']['email'];                    
                        $this->Gmail->credit_card_recused($name,$useremail);

                        //Buscar ultimo metodo de pagamento valido para dar error relacionado
                        foreach ($PAYMENT_ARRAY as $key => $value) {
                            if($PAYMENT_ARRAY[$key]['valid']){ // is an active valid method                        
                                $payment_method = $key;
                            }
                        }

                        if($payment_method == payment_manager::IUGU){                        
                            //analisar erro da transação
                            if($response['LR'] && $response['LR'] != '00')
                            {
                                $report_iugu = $this->iugu_report(
                                                                $response['LR'], 
                                                                $_SESSION['transaction_values']['total_cust_value'],
                                                                $_SESSION['transaction_values']['amount_months']
                                                                );                    
                                if($report_iugu['known']){
                                    $result['message'] = $report_iugu['message'];                    
                                    //enviar email com passos
                                    $this->Gmail = new Gmail();
                                    $this->Gmail->email_iugu_report($name,$useremail,$report_iugu['subject'],$report_iugu['email']);                            
                                    if($report_iugu['destroy'])
                                        session_destroy();
                                }
                                else{
                                    $result['message'] = "Transação foi negada. Operação cancelada";                    
                                    session_destroy();
                                }
                            }       
                            else{
                                $result['message'] = $response['message'].' Operação cancelada';                    
                                session_destroy();
                            }

                            $result['success'] = false;                                        
                        }
                        else{
                            if(!$response['try_again'])
                                session_destroy();                            
                            $result['success'] = false;
                            $result['message'] = 'Sua transação foi negada. Aqui estão os erros mais prováveis: '.
                                                    '(1-) Você utilizou seu cartão de DÉBITO. '.
                                                    '(2-) Dados do cartão incorretos. '.
                                                    '(3-) Cartão utilizado não tem validade. '.
                                                    '(4-) Não há limite suficiente em seu cartão de crédito. '.                                                
                                                    'Recomendamos entrar em contato com o banco emissor do seu cartão de crédito e informar que deseja aprovação para a cobrança da empresa Livre.Digital, no valor de R$ '.$_SESSION['transaction_values']['total_cust_value'].', parcelado em '.$_SESSION['transaction_values']['amount_months'].' vezes.';
                        }
                    }
                    else{
                    
                        if($_SESSION['used_method'] == payment_manager::BRASPAG){
                            $_SESSION[payment_manager::NAME_BRASPAG]['payment_id'] = $response['payment_id'];                            
                        }
                        
                        $_SESSION['re_financials'] = $response['financials'];
                        $_SESSION['captured'] = $response['captured'];                    
                        
                        $result['success'] = false;                            
                        $result['authorized'] = true;                        
                        $result['financials'] = $response['financials'];                    
                        $result['captured'] = $response['captured'];                    
                    }
                }                
            }
            else{                
                $result['success'] = false;
                $result['message'] = "Deve subir todas as imagens solicitadas corretamente";                
            }
        }
        else{
            $result['success'] = false;
            //$result['message'] = "Sessão expirou";
            header('Location: '.base_url());
        }
        echo json_encode($result);
    }
    
    public function sign_contract() {
        session_destroy();
        $result['message']='Sessão expirou. Por favor, vá para a página inicial do site.';
        $result['success']=false;
        echo json_encode($result);
        return;
            
        if(!$_SESSION['transaction_values']['amount_months']){
            $result['message']='Sessão expirou';
            $result['success']=false;
            echo json_encode($result);
            return;
        }
        $this->load->model('class/system_config');
        $this->load->model('class/transaction_model');
        $this->load->model('class/transactions_status');        
        $this->load->model('class/payment_manager');
        
        require_once ($_SERVER['DOCUMENT_ROOT']."/livre/application/libraries/Gmail.php");
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $this->Gmail = new Gmail();
        $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
        
        /*------------analisar nro de tentativas----------------*/
        $transaction = $this->transaction_model->get_client('id', $_SESSION['pk'])[0];
        if($transaction['purchase_counter']>$GLOBALS['sistem_config']->MAX_PURCHASE_TENTATIVES){
            $result['message']='Não autorizado. Quantidade máxima de tentativas alcançadas. Contate nosso atendimento';
            $result['success']=false;
            echo json_encode($result);
            session_destroy();
            return;
        }
        $datas = $this->input->post();
        $cpf_upload = true;
        if($datas['ucpf'] == 'true' && !$_SESSION['cpf_card']){            
            $cpf_upload = false;
        }            
        if($_SESSION['is_possible_steep_1'] && $_SESSION['is_possible_steep_2'] && $_SESSION['is_possible_steep_3'] && $datas['key']===$_SESSION['key']){
            if($_SESSION['front_credit_card'] && $_SESSION['selfie_with_credit_card'] && $_SESSION['open_identity'] && $_SESSION['selfie_with_identity'] && $cpf_upload){           
                $result['success'] = TRUE;    
                $value_ucpf = 0;
                if($datas['ucpf'] == 'true')
                    $value_ucpf = 1;
                $this->transaction_model->save_cpf_card($_SESSION['pk'], $value_ucpf);
                //incrementar numero de tentativas para evitar teste de cartão                                        
                $purchase_counter = $transaction['purchase_counter'] + 1;
                $this->transaction_model->save_in_db(
                    'transactions',
                    'id',$_SESSION['pk'],
                    'purchase_counter', $purchase_counter);
                /*-----------------------------------------*/
                //1. pasar cartão de crédito na IUGU                
                //$response = $this->do_payment_iugu($_SESSION['pk']);   
                $num_temp_for_paym = 1;
                $payment_method = $GLOBALS['sistem_config']->PAYMENT_METHOD;
                do{
                    $response = $this->do_payment($_SESSION['pk'], $payment_method);                                
                    if($response['success']){
                        /*$this->transaction_model->save_in_db(
                            'transactions',
                            'id',$_SESSION['pk'],
                            'pay_date', time());                                
                        $this->transaction_model->save_in_db(
                            'transactions',
                            'id',$_SESSION['pk'],
                            'payment_source', payment_manager::IUGU);*/
                        $string_param = "transactionId=".$_SESSION['pk']
                                    . "&transactionAffiliation=site"
                                    . "&transactionTotal=".$_SESSION['transaction_values']['total_cust_value']
                                    . "&solicited_value=".$_SESSION['transaction_values']['solicited_value']
                                    . "&amount_months=".$_SESSION['transaction_values']['amount_months']
                                    . "&name=".explode(' ',$_SESSION['client_datas']['name'])[0] ;                                           
                        //3. crear documento a partir de plantilla y guardar token del documento en la BD
                        $uudid_doc = $this->upload_document_template_D4Sign($_SESSION['pk']);
                        if($uudid_doc){
                            //4. cadastrar un signatario para ese docuemnto y guardar token del signatario
                            $token_signer = $this->signer_for_doc_D4Sign($_SESSION['pk']);
                            if($token_signer){
                                //5.  mandar a assinar
                                $result_send = $this->send_for_sign_document_D4Sign($_SESSION['pk']);
                                if($result_send){
                                    //2. salvar el status para WAIT_SIGNATURE
                                    $this->transaction_model->update_transaction_status(
                                                        $_SESSION['pk'], 
                                                        transactions_status::WAIT_SIGNATURE);
                                    //6. matar session para evitar retroceder
                                    //session_destroy();
                                    //7. pagina de sucesso de compra con los tags de adwords y analitics
                                    /*Codigo antiguo no funcionava bien
                                    $params['transactionId']=$_SESSION['pk'];
                                    $params['transactionAffiliation']='site';
                                    $params['transactionTotal']=['transaction_values']['total_cust_value'];
                                    $params['solicited_value']=['transaction_values']['solicited_value'];
                                    $params['amount_months']=['transaction_values']['amount_months'] ;
                                    //$this->load->view('sucesso-compra',$params);
                                    //$this->load->view('inc/footer');
                                    $result['success'] = true;
                                    $result['params'] = $params;                                 
                                     */                                
                                }
                                else{
                                    $this->transaction_model->update_transaction_status(
                                                        $_SESSION['pk'], 
                                                        transactions_status::PENDING);                        
                                }
                            }
                            else{
                                $this->transaction_model->update_transaction_status(
                                                        $_SESSION['pk'], 
                                                        transactions_status::PENDING);                        
                            }
                        }else{
                            $this->transaction_model->update_transaction_status(
                                                        $_SESSION['pk'], 
                                                        transactions_status::PENDING);                        
                        }
                        //sucesso de contrato se foi cobrado
                        $_SESSION['buy'] = true;
                        $result['success'] = true;
                        $result['params'] = $string_param;                                
                        $num_temp_for_paym = 2;
                        //session_destroy(); se mata na no carga
                    }else{
                        $name = explode(' ', $_SESSION['client_datas']['name']); $name = $name[0];
                        $useremail = $_SESSION['client_datas']['email'];
                        if($num_temp_for_paym == 1)
                            $this->Gmail->credit_card_recused($name,$useremail);
                        if($payment_method == payment_manager::IUGU){                        
                            //analisar erro da transação
                            if($response['LR'] && $response['LR'] != '00')
                            {
                                $report_iugu = $this->iugu_report(
                                                                $response['LR'], 
                                                                $_SESSION['transaction_values']['total_cust_value'],
                                                                $_SESSION['transaction_values']['amount_months']
                                                                );                    
                                if($report_iugu['known']){
                                    $result['message'] = $report_iugu['message'];                    
                                    //enviar email com passos
                                    $this->Gmail = new Gmail();
                                    $this->Gmail->email_iugu_report($name,$useremail,$report_iugu['subject'],$report_iugu['email']);                            
                                    if($report_iugu['destroy'])
                                        session_destroy();
                                }
                                else{
                                    $result['message'] = "Transação foi negada. Operação cancelada";                    
                                    session_destroy();
                                }
                            }       
                            else{
                                $result['message'] = $response['message'].' Operação cancelada';                    
                                session_destroy();
                            }

                            $result['success'] = false;                                        
                        }
                        else{
                            if(!$response['try_again'])
                                session_destroy();
                            $result['success'] = false;
                            $result['message'] = 'Sua transação foi negada. Aqui estão os erros mais prováveis: '.
                                                    '(1-) Você utilizou seu cartão de DÉBITO. '.
                                                    '(2-) Dados do cartão incorretos. '.
                                                    '(3-) Cartão utilizado não tem validade. '.
                                                    '(4-) Não há limite suficiente em seu cartão de crédito. '.                                                
                                                    'Recomendamos entrar em contato com o banco emissor do seu cartão de crédito e informar que deseja aprovação para a cobrança da empresa Livre.Digital, no valor de R$ '.$_SESSION['transaction_values']['total_cust_value'].', parcelado em '.$_SESSION['transaction_values']['amount_months'].' vezes.';
                        }
                    }
                    //ver si hacer la otra tentativa
                    if($num_temp_for_paym < 2){
                        $payment_method = ($payment_method)%2 + 1;
                        $num_temp_for_paym++;
                    }
                }while ($num_temp_for_paym < 2);
            }
            else{                
                $result['success'] = false;
                $result['message'] = "Deve subir todas as imagens solicitadas corretamente";                
            }
        }
        else{
            $result['success'] = false;
            //$result['message'] = "Sessão expirou";
            header('Location: '.base_url());
        }
        echo json_encode($result);
    }
        
    public function message() {
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        require_once ($_SERVER['DOCUMENT_ROOT']."/livre/application/libraries/Gmail.php");
        $this->Gmail = new Gmail();        
        $datas = $this->input->post();
        $result = $this->Gmail->send_client_contact_form($datas['name'], $datas['email'], $datas['message']);
        if ($result['success'])
            $result['message'] = 'Mensagem enviada. Agradecemos seu contato!!';
        else             
            $result['message'] = 'Falha enviando mensagem. Tente depois.';
        echo json_encode($result);
    }
    
    //-------AFFILIATES FUNCTIONS----------------------------------
    /*
    //varaiveis armazenadas na sessao para cadastro de un afiliado
    $_SESSION
    ['pk']
    ['key']
    ['affiliates_steep_1']
    ['affiliate_datas']
    $_SESSION['affiliates_steep_2']
    
    //varaiveis armazenadas na sessao para login de un afiliado
    $_SESSION
    ['logged_id']
    ['logged_role']
    ['affiliate_logged_datas']
    ['affiliate_logged_transactions']
    
    //varaiveis armazenadas na sessao para administração    
    ['transaction_requested_id']
     * ['transaction_requested_datas']
    */
    
    public function insert_affiliate_steep1(){
        $this->is_ip_hacker();
        $datas = $this->input->post();
        $datas['pass']=md5($datas['pass']);
        $_SESSION['affiliates_steep_1']=false;
        if($datas['key']!==$_SESSION['key']){
            $result['message']='Autorização negada. Violação de acesso';
            $result['success']=false;
        }else{
            $this->load->model('class/affiliate_status');
            $this->load->model('class/affiliate_model');
            $afiliate = $this->affiliate_model->get_affiliates_by_email($datas['email']);
            $N = count($afiliate);
            if($N>0){
                if($afiliate[$N-1]['status_id'] == affiliate_status::ACTIVE){
                    $action = 'not_action';
                    $result['success']=false;
                    $result['message']='O email informado já tem associado uma conta ativa';
                }else
                if($afiliate[$N-1]['status_id'] == affiliate_status::BEGINNER){
                    $action ='update_afiliate';                
                }else
                if($afiliate[$N-1]['status_id'] == affiliate_status::DELETED){
                    $action ='insert_afiliate';                
                }
            }else{
                $action = 'insert_afiliate';
            }
            if($action != 'not_action'){
                $datas['status_id'] = affiliate_status::BEGINNER;
                $t = time();
                $datas['init_date'] = $t;
                $datas['status_date'] = $t;
                $cad = $datas['affiliate_phone_ddd']+$datas['affiliate_phone_number'];
                $datas['code'] = $cad[0];
                if($action =='update_afiliate'){
                    if($this->affiliate_model->update_afiliate($afiliate[$N-1]['id'],$datas))
                       $id = $afiliate[$N-1]['id'];
                }
                else
                    $id = $this->affiliate_model->insert_afiliate($datas);
                if($id){
                    $result['success']=true;
                    $_SESSION['affiliates_steep_1']=true;
                    $_SESSION['pk'] = $id;
                    $_SESSION['affiliate_datas']=$datas;
                } else{
                    $result['message']='Erro guardando no banco de dados. Reporte ao nosso atendimento';
                    $result['success']=false;
                }
            }
        }
        echo json_encode($result);
    }
    
    public function insert_affiliate_steep2() {
        $_SESSION['affiliates_steep_2']=false;
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $this->is_ip_hacker();
        $datas = $this->input->post();
        if(!$_SESSION['affiliates_steep_1'] || $datas['key']!==$_SESSION['key']){
            $result['message']='Autorização negada. Violação de acesso';
            $result['success']=false;
        }else{
            $this->load->model('class/affiliate_model');
            $this->load->model('class/transaction_model');
            if(!$this->validate_bank_datas($datas)){
                $result['success'] = false;
                $result['message'] = 'Erro nos dados bancários fornecidos';
            } else {
                $account_bank = $this->transaction_model->get_account_bank_by_client_id($_SESSION['pk'],1);
                if($N = count($account_bank)){
                   $id_row = 0;
                   if($this->affiliate_model->update_affiliate_data_bank($datas,$account_bank[$N-1]['client_id']))
                       $id_row = $account_bank[$N-1]['client_id'];
                }
                else{
                    $datas['client_id'] = $_SESSION['pk'];
                    $datas['propietary_type'] = 1;
                    $id_row = $this->affiliate_model->insert_affiliate_data_bank($datas);                     
                }
                if($id_row){
                    $_SESSION['affiliates_databank_signin_datas'] = $datas;
                    $_SESSION['affiliates_steep_2'] = true;
                    //enviar email de nuevo afiliado al atendimento
                    require_once ($_SERVER['DOCUMENT_ROOT']."/livre/application/libraries/Gmail.php");
                    $this->Gmail = new Gmail();
                    $result = $this->Gmail->send_mail(
                        $GLOBALS['sistem_config']->ATENDENT_EMAIL,
                        'Nova solicitação de afiliado',
                        'Nova solicitação de afiliado', 
                        'O afiliado '.['affiliate_datas']['email'].' tá pedindo autorizo de cadastro.'
                    );
                    $result['success'] = true;
                }
                else{
                    $result['success'] = false;
                    $result['message'] = 'Erro interno no banco de dados';
                }
            }
        }
        echo json_encode($result);
    }
    
    public function login_affiliate(){
        $this->load->model('class/affiliate_model');
        $this->load->model('class/affiliate_status');
        $this->is_ip_hacker();
        $datas = $this->input->post();
        $datas['pass']=md5($datas['pass']);
        $afiliate = $this->affiliate_model->get_affiliates_by_credentials($datas['email'],$datas['pass']);
        $N = count($afiliate);
        if($N>0 && $afiliate[$N-1]['status_id'] == affiliate_status::ACTIVE){
            $_SESSION['logged_id'] = $afiliate[$N-1]['id'];
            $_SESSION['logged_role'] = $afiliate[$N-1]['role'];            
            $result['resource'] = 'filiados';
            $result['success'] = true;
            //registrar login
            $ip = $this->getUserIP();
            $_SESSION['ip'] = $ip;
            $this->load->model('class/watchdog');
            $this->load->model('class/watchdog_type');
            
            $register = ['user_id' => $_SESSION['logged_id'], 'type' => Watchdog_type::LOGIN, 'date' => time(), 'ip' => $_SESSION['ip'], 'data' => $_SESSION['logged_id']];
            $this->watchdog->add_watchdog($register);
            
        } else{
            $_SESSION['logged_id'] = -1;
            $result['message'] = 'Você deve se cadastrar primeiro';
            $result['resource'] = 'afiliados';
            $result['success'] = false;
        }
        echo json_encode($result);
    }
        
    public function export_transactions() {
        $this->load->model('class/system_config');
        $this->load->model('class/transaction_model');
        
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $this->load->model('class/affiliate_model');          
        if($_SESSION['logged_role'] === 'ADMIN'){
            $page = $_SESSION["filter_datas"]["num_page"];
            $token = $_SESSION["filter_datas"]["token"];
            $start_period = $_SESSION["filter_datas"]["init_date"];
            $end_period = $_SESSION["filter_datas"]["end_date"];
            $status = $_SESSION["filter_datas"]["status"];
            $has_next_page = 0;
            
            $start_date = strtotime($start_period);
            if($start_date === false){
                $start_date = '';
            }
            $end_date = strtotime($end_period);
            if($end_date === false){
                $end_date = '';
            }
            else{
                $end_date += 23*60*60 + 59*60 + 59;
            }
            //TODO: Moreno
            //1. abrir archivo temporal em modo escritura
            $page = 1; //descargar todos los registros de la consulta
            $first_result = TRUE;
            do{
                //lee pagina de transacciones segun la configuracion de la consulta actual 
                //guardada en la variable de seccion
                $transactions = $this->affiliate_model->load_transactions(
                    NULL,
                    $page-1,
                    $GLOBALS['sistem_config']->TRANSACTIONS_BY_PAGE,
                    $token,
                    $start_date,                    
                    $end_date,
                    $has_next_page,    
                    $status
                );
                $page++;//descargar todas las páginas
                foreach ($transactions as $tr) {
                    //2. crear una linea en csv a partir de cada transacion de la pagina actual
                        //donde el contenido de la variable $tr es:
                    /*
                    'id' => string '4' (length=1)
                    'status_id' => string '1' (length=1)
                    'cpf' => string '07367014196' (length=11)
                    'name' => string 'JOSE RAMON GONZALEZ MONTERO' (length=27)
                    'email' => string 'josergm86@gmail.com' (length=19)
                    'phone_ddd' => string '21' (length=2)
                    'phone_number' => string '965913089' (length=9)
                    'cep' => string '24020206' (length=8)
                    'number_address' => string '223' (length=3)
                    'street_address' => string 'Rua Visconde de Sepetiba' (length=24)
                    'complement_number_address' => string '302' (length=3)
                    'city_address' => string 'Niterói' (length=8)
                    'state_address' => string 'RJ' (length=2)
                    'HTTP_SERVER_VARS' => string '{"UNIQUE_ID":"W22utH8AAQEAABMz8JEAAAAG","HTTP_HOST":"localhost","HTTP_USER_AGENT":"Mozilla\/5.0 (X11; Ubuntu; Linux x86_64; rv:61.0) Gecko\/20100101 Firefox\/61.0","HTTP_ACCEPT":"application\/json, text\/javascript, *\/*; q=0.01","HTTP_ACCEPT_LANGUAGE":"en-GB,en;q=0.5","HTTP_ACCEPT_ENCODING":"gzip, deflate","HTTP_REFERER":"http:\/\/localhost\/livre\/index.php\/welcome\/checkout?utm_source=NULL&frm_money_use_form=08","CONTENT_TYPE":"application\/x-www-form-urlencoded; charset=UTF-8","HTTP_X_REQUESTED_WITH":"XMLHttpRequest","CONTENT_LENGTH":"310","HTTP_COOKIE":"_ga=GA1.1.1275033201.1532962393; _gid=GA1.1.155893956.1533907490; ci_session=61759068776d9f237220805ca2c4995f22b4e200","HTTP_CONNECTION":"keep-alive","PATH":"\/usr\/local\/sbin:\/usr\/local\/bin:\/usr\/sbin:\/usr\/bin:\/sbin:\/bin:\/snap\/bin","LD_LIBRARY_PATH":"\/opt\/lampp\/lib:\/opt\/lampp\/lib","SERVER_SIGNATURE":"","SERVER_SOFTWARE":"Apache\/2.4.27 (Unix) OpenSSL\/1.0.2l PHP\/7.0.23 mod_perl\/2.0.8-dev Perl\/v5.16.3","SERVER_NAME":"localhost","SERVER_ADDR":"127.0.0.1","SERVER_PORT":"80","REMOTE_ADDR":"127.0.0.1","DOCUMENT_ROOT":"\/opt\/lampp\/htdocs","REQUEST_SCHEME":"http","CONTEXT_PREFIX":"","CONTEXT_DOCUMENT_ROOT":"\/opt\/lampp\/htdocs","SERVER_ADMIN":"you@example.com","SCRIPT_FILENAME":"\/opt\/lampp\/htdocs\/livre\/index.php","REMOTE_PORT":"39862","GATEWAY_INTERFACE":"CGI\/1.1","SERVER_PROTOCOL":"HTTP\/1.1","REQUEST_METHOD":"POST","QUERY_STRING":"","REQUEST_URI":"\/livre\/index.php\/welcome\/insert_datas_steep_1","SCRIPT_NAME":"\/livre\/index.php","PATH_INFO":"\/welcome\/insert_datas_steep_1","PATH_TRANSLATED":"\/opt\/lampp\/htdocs\/welcome\/insert_datas_steep_1","PHP_SELF":"\/livre\/index.php\/welcome\/insert_datas_steep_1","REQUEST_TIME_FLOAT":1533914804.66,"REQUEST_TIME":1533914804}' (length=1779)
                    'utm_source' => string '' (length=0)
                    'purchase_counter' => string '0' (length=1)
                    'amount_solicited' => string '111111' (length=6)
                    'number_plots' => string '12' (length=2)
                    'invoice_id' => null
                    'total_effective_cost' => string '229931' (length=6)
                    'way_to_spend' => string '08' (length=2)
                    'folder_in_server' => string '07367014196_1533914804' (length=22)
                    'contract_id' => null
                    'ucpf' => string '0' (length=1)
                    'affiliate_code' => string '' (length=0)
                    'ccb_number' => null
                    'new_photos_code' => null
                    'new_account_bank_code' => null
                    'new_sing_us_code' => null
                    'doc_d4sign' => null
                    'client_id' => string '2' (length=1)
                    'credit_card_name' => string 'JOSE R G MONTERO' (length=16)
                    'credit_card_number' => string '5293230325454401' (length=16)
                    'credit_card_cvv' => string '123' (length=3)
                    'credit_card_exp_month' => string 'JOSE R G MONTERO' (length=16)
                    'credit_card_exp_year' => string 'QmE2MWFBPT0=' (length=12)
                    'bank' => string '268' (length=3)
                    'agency' => string '44598' (length=5)
                    'account' => string '125490' (length=6)
                    'account_type' => string 'CC' (length=2)
                    'dig' => string '3' (length=1)
                    'titular_name' => string 'JOSE RAMON GONZALEZ MONTERO' (length=27)
                    'titular_cpf' => string '07367014196' (length=11)
                    'propietary_type' => string '0' (length=1)
                    'credit_card_final' => string '4401' (length=4)
                    'bank_name' => string 'BARIGUI CH' (length=10)
                    'dates' => 
                      array (size=1)
                        0 => 
                          array (size=4)
                            'id' => string '6' (length=1)
                            'transaction_id' => string '2' (length=1)
                            'status_id' => string '1' (length=1)
                            'date' => string '1533914804' (length=10)
                    'icon_by_status' => string '8 BEGGINER.png' (length=14)
                    'hint_by_status' => string 'BEGGINER' (length=8)
                    'solicited_date' => string '10-08-2018 / 12:26' (length=18)
                    */
                    
                    //ATENNCION: en el caso del campo dates, exportar la fecha en que fue creada
                    //la transaccion, que la de la posicion N-1 del array dates 
                    $way_to_spend = [
                        '00' => 'Selecione',
                        '01' => 'Compras',
                        '02' => 'Quitar dívida do cartão de crédito',
                        '03' => 'Quitar cheque especial',
                        '04' => 'Quitar outras dívidas',
                        '05' => 'Investir em negócio próprio',
                        '06' => 'Educação',
                        '07' => 'Viagem',
                        '08' => 'Saúde',
                        '09' => 'Outros ...'
                    ];
                    $tr_reduce['id_trans'] = $tr['client_id'];
                    $tr_reduce['status'] = $tr['hint_by_status'];
                    $tr_reduce['cpf'] = $tr['cpf'];
                    $tr_reduce['name'] = $tr['name'];
                    $tr_reduce['email'] = $tr['email'];
                    $tr_reduce['phone_number'] = $tr['phone_ddd'].$tr['phone_number'];
                    $tr_reduce['cep'] = $tr['cep'];
                    $tr_reduce['number_address'] = $tr['number_address'];
                    $tr_reduce['street'] = $tr['street_address'];
                    $tr_reduce['complement_number'] = $tr['complement_number_address'];
                    $tr_reduce['city'] = $tr['city_address'];
                    $tr_reduce['state'] = $tr['state_address'];
                    $tr_reduce['amount_solicited'] = $tr['amount_solicited']/100;
                    $tr_reduce['months'] = $tr['number_plots'];
                    $tr_reduce['way_to_spend'] = $way_to_spend[ $tr['way_to_spend'] ];                    
                    
                    //adicionar datos bancarios e do cartao
                    $account_bank = $this->transaction_model->get_account_bank_by_client_id($tr['tr_id'],0)[0];
                    $tr_reduce['bank_name'] = $this->Crypt->get_bank_by_code($account_bank["bank"]);
                    
                    $credit_card = $this->transaction_model->get__decrypt_credit_card('client_id', $tr['tr_id']);                    
                    $tr_reduce["credit_card_final"] = substr($credit_card["credit_card_number"],-4);
                    
//                    $tr_reduce['bank_name'] = $tr['bank_name'];
//                    $tr_reduce['credit_card_final'] = $tr['credit_card_final'];
                    
                    $tr_reduce['solicited_date'] = $tr['solicited_date'];
                    $tr_reduce['partnerId'] = $tr['contract_id'];                    
                    $tr_reduce['status_date'] = date("Y-m-d\TH:i:s\Z",$tr['dates'][0]['date']);
                    $tr_reduce['utm_source'] = $tr['utm_source'];
                    $tr_reduce['utm_campaign'] = $tr['utm_campaign'];
                    $tr_reduce['utm_content'] = $tr['utm_content'];                            
                    
                    if($first_result && $tr_reduce){
                        $first_result = FALSE;
                        $filename = 'transactions'.date('Ymd', time()).'.csv'; 
                        header("Content-Description: File Transfer"); 
                        header("Content-Disposition: attachment; filename=$filename"); 
                        header("Content-Type: application/csv; ");

                        // file creation 
                        $file = fopen('php://output', 'w');

                        fputcsv($file, array_keys($tr_reduce));                            
                    }

                    //foreach ($tr as $key=>$line){ 
                      fputcsv($file,$tr_reduce);                          
                    //}
                }                
            }while($has_next_page > 0);
            //3. cerrar fichero y dar la posibilidad de descargarlo, igual que en leads                
            if(!$first_result)
                fclose($file); 
            exit;                                    }
    }
    
    public function export_leads() {   
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $this->load->model('class/affiliate_model');       
        if($_SESSION['logged_role'] === 'ADMIN'){            
            $page = $_SESSION["filter_datas"]["num_page"];
            $token = $_SESSION["filter_datas"]["token"];
            $start_period = $_SESSION["filter_datas"]["init_date"];
            $end_period = $_SESSION["filter_datas"]["end_date"];
            $status = $_SESSION["filter_datas"]["status"];
            $has_next_page = 0;
            
            $start_date = strtotime($start_period);
            if($start_date === false){
                $start_date = '';
            }
            $end_date = strtotime($end_period);
            if($end_date === false){
                $end_date = '';
            }
            else{
                $end_date += 23*60*60 + 59*60 + 59;
            }
            //TODO: Moreno
            //1. abrir archivo temporal em modo escritura
            $page = 1; //descargar todos los registros de la consulta
            $first_result = TRUE;
            do{
                //lee pagina de transacciones segun la configuracion de la consulta actual 
                //guardada en la variable de seccion
                $transactions = $this->affiliate_model->load_leads(
                    NULL,
                    $page-1,
                    $GLOBALS['sistem_config']->TRANSACTIONS_BY_PAGE,
                    $token,
                    $start_date,                    
                    $end_date,
                    $has_next_page,    
                    $status
                );
                $page++;//descargar todas las páginas
                foreach ($transactions as $tr) {
                    //2. crear una linea en csv a partir de cada transacion de la pagina actual
                        //donde el contenido de la variable $tr es:
                    
                    //ATENNCION: en el caso del campo dates, exportar la fecha en que fue creada
                    //la transaccion, que la de la posicion N-1 del array dates 
                    $status_text = [
                        '1' => 'BEGGINER',
                        '2' => 'WAIT_SIGNATURE',
                        '3' => 'APPROVED',                        
                        '4' => 'WAIT_PHOTO',
                        '5' => 'WAIT_ACCOUNT',
                        '6' => 'TOPAZIO_APROVED',
                        '7' => 'TOPAZIO_IN_ANALISYS',
                        '8' => 'TOPAZIO_DENIED',
                        '9' => 'REVERSE_MONEY',
                        '22' => 'PENDING'
                    ];
                    
                    $way_to_spend = [
                        '00' => 'Selecione',
                        '01' => 'Compras',
                        '02' => 'Quitar dívida do cartão de crédito',
                        '03' => 'Quitar cheque especial',
                        '04' => 'Quitar outras dívidas',
                        '05' => 'Investir em negócio próprio',
                        '06' => 'Educação',
                        '07' => 'Viagem',
                        '08' => 'Saúde',
                        '09' => 'Outros ...'
                    ];
                    $tr_reduce['id_trans'] = $tr['id'];
                    $tr_reduce['status'] = $status_text[$tr['status_id']];
                    $tr_reduce['cpf'] = $tr['cpf'];
                    $tr_reduce['name'] = $tr['name'];
                    $tr_reduce['email'] = $tr['email'];
                    $tr_reduce['phone_number'] = $tr['phone_ddd'].$tr['phone_number'];
                    $tr_reduce['cep'] = $tr['cep'];
                    $tr_reduce['number_address'] = $tr['number_address'];
                    $tr_reduce['street'] = $tr['street_address'];
                    $tr_reduce['complement_number'] = $tr['complement_number_address'];
                    $tr_reduce['city'] = $tr['city_address'];
                    $tr_reduce['state'] = $tr['state_address'];
                    $tr_reduce['amount_solicited'] = $tr['amount_solicited']/100;
                    $tr_reduce['months'] = $tr['number_plots'];
                    $tr_reduce['way_to_spend'] = $way_to_spend[ $tr['way_to_spend'] ]; 
                    $tr_reduce['utm_source'] = $tr['utm_source'];
                    $tr_reduce['utm_campaign'] = $tr['utm_campaign'];
                    $tr_reduce['utm_content'] = $tr['utm_content'];
                    
                    if($first_result && $tr_reduce){
                        $first_result = FALSE;
                        $filename = 'leads'.date('Ymd', time()).'.csv'; 
                        header("Content-Description: File Transfer"); 
                        header("Content-Disposition: attachment; filename=$filename"); 
                        header("Content-Type: application/csv; ");

                        // file creation 
                        $file = fopen('php://output', 'w');

                        fputcsv($file, array_keys($tr_reduce));                            
                    }

                    //foreach ($tr as $key=>$line){ 
                      fputcsv($file,$tr_reduce);                          
                    //}
                }                
            }while($has_next_page > 0);
            //3. cerrar fichero y dar la posibilidad de descargarlo, igual que en leads                
            if(!$first_result)
                fclose($file); 
            exit;                                    }
    }
    
    public function update_old_tax() {
        die('Not page found');
        $this->load->model('class/transaction_model');        
        $this->load->model('class/system_config');
        $this->load->model('class/tax_model');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $this->load->model('class/affiliate_model');       
        if($_SESSION['logged_role'] === 'ADMIN'){            
            //TODO: Moreno
            //1. abrir archivo temporal em modo escritura
            $page = 1; //descargar todos los registros de la consulta
            $has_next_page = 0;
            $init_date = NULL;
            $cut_date = 1537228801; //18/09/2018
            do{
                //lee pagina de transacciones segun la configuracion de la consulta actual 
                //guardada en la variable de seccion
                $transactions = $this->affiliate_model->load_transaction_cutdate(                    
                    $page-1,
                    $GLOBALS['sistem_config']->TRANSACTIONS_BY_PAGE,                    
                    $has_next_page,
                    $init_date,
                    $cut_date
                );
                $page++;//descargar todas las páginas
                foreach ($transactions as $tr) {
                    $id = $tr['id'];
                    $valor_solicitado = $tr['amount_solicited']/100;
                    $num_parcelas = $tr['number_plots'];
                    $B11 = number_format($valor_solicitado, 2, '.', '');
                    $B16 = $num_parcelas;
                    $tax = $this->tax_model->get_tax_row_old($B16)[$this->get_field_old($B11)];
                    //$tax = $this->tax_model->get_tax_row($B16)[$this->get_field($B11)];
                    $this->transaction_model->save_in_db('transactions','id',$id,'tax',$tax);
                }                
            }while($has_next_page > 0);
        }
    }
    
    public function clean_begginer_images() {   
        //die('Access forbidden');
        $this->load->model('class/transaction_model'); 
        $this->load->model('class/transactions_status');
        $this->load->model('class/system_config');        
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $this->load->model('class/affiliate_model');       
        
        $dayofweek = date('w', time());
        $hour = date('H');
        
        if($dayofweek != 1 || $hour > 5 || $hour < 4){
            die('Access forbidden');
        }
        //if($_SESSION['logged_role'] === 'ADMIN'){            
            
            $page = 1; //descargar todos los registros de la consulta
            $has_next_page = 0;
            $init_date = NULL;
            $cut_date = time()-24*60*60; //ontem
            do{
                //lee pagina de transacciones segun la configuracion de la consulta actual 
                //guardada en la variable de seccion
                $transactions = $this->affiliate_model->load_transaction_cutdate(
                    $page-1,
                    $GLOBALS['sistem_config']->TRANSACTIONS_BY_PAGE,
                    $has_next_page,
                    $init_date,
                    $cut_date,
                    transactions_status::BEGINNER
                );
                //var_dump(count($transactions));
                //die('aas');
                $page++;//descargar todas las páginas
                foreach ($transactions as $tr) {
                    $id = $tr['id'];
                    var_dump($id);
                    $path_name = "/opt/lampp/htdocs/livre/assets/data_users/".$tr['folder_in_server'];

                    if($tr['folder_in_server']){
                        if(is_dir($path_name)){ 
                            $file_names = ["front_credit_card","selfie_with_credit_card","open_identity","selfie_with_identity","cpf_card"];

                            foreach ($file_names as $photo) {
                                if (file_exists($path_name."/". $photo)) {
                                    chmod($path_name."/".$photo, 0777);
                                    unlink($path_name."/".$photo);     
                                }
                            }
                        }
                    }
                }    
            }while($has_next_page > 0);
        //}
    }
    
    public function file_transactions(){        
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $this->load->model('class/affiliate_model');
        if($_SESSION['logged_role'] === 'ADMIN'){                
            $datas = $this->input->get();
            
            $init_date = $datas['init_date'];
            $end_date = $this->real_end_date($datas['end_date']);  

            if($init_date!=NULL && $end_date!=NULL && $init_date == $end_date){
                $end_date = $init_date + 24*3600-1;
            }

            while ($result_sql){
                $result_sql = $this->campaing_model->get_leads_limit( $this->session->userdata('id'),
                                                                $id_campaing,
                                                                $profile_row['id'],
                                                                $init_date,
                                                                $end_date,
                                                                $info_to_get,
                                                                $max_id
                                                                );                    
                $result_sql = $this->convert_from_latin1_to_utf8_recursively($result_sql);

                if($first_result && count($result_sql) > 0){
                    $first_result = FALSE;
                    $filename = 'leads_'.date('Ymd', $init_date).'_'.date('Ymd', $end_date).'.csv'; 
                    header("Content-Description: File Transfer"); 
                    header("Content-Disposition: attachment; filename=$filename"); 
                    header("Content-Type: application/csv; ");

                    // file creation 
                    $file = fopen('php://output', 'w');

                    fputcsv($file, array_keys(current($result_sql)));                            
                }

                foreach ($result_sql as $key=>$line){ 
                  fputcsv($file,$line);                          
                }
            }
            if(!$first_result)
                fclose($file); 
            exit;
            $result['success'] = true;
            $result['message'] = '';
            $result['resource'] = 'afhome';
        }
        else{
            $result['success'] = false;
            $result['message'] = $this->T("Não existe sessão ativa", array(), $GLOBALS['language']);
            $result['resource'] = 'afhome';
        } 
        $this->load->view('afhome');
    }

    //-------ADMIN TRANSACTION FUNCTIONS----------------------------------
    public function approve_transaction(){
        $this->load->model('class/affiliate_model');
        $this->load->model('class/transaction_model');
        $this->load->model('class/transactions_status');
        $this->load->model('class/system_config');
        $result['success'] = false;
        if($_SESSION['logged_role'] === 'ADMIN'){
            $tr_data = $this->transaction_model->get_client('id', $_SESSION['transaction_requested_id'])[0];
            if($tr_data['status_id'] == transactions_status::TOPAZIO_IN_ANALISYS ||
               $tr_data['status_id'] == transactions_status::TOPAZIO_APROVED ||
               $tr_data['status_id'] == transactions_status::REVERSE_MONEY){
                $result['message'] = "O estado atual da transação não permite que seja aprovada";    
                $result['success'] = false;    
                echo json_encode($result);
                return;
            }
            $resp = $this->topazio_emprestimo($_SESSION['transaction_requested_id']);                        
            if($resp['success']){
                $this->transaction_model->save_in_db(
                        'transactions',
                        'id',$_SESSION['transaction_requested_id'],
                        'ccb_number',$resp['ccb']);                                
                $this->transaction_model->update_transaction_status(
                        $_SESSION['transaction_requested_id'], 
                        transactions_status::TOPAZIO_IN_ANALISYS,
                        true,
                        $resp['ccb']);
                //registrar accion
                $this->load->model('class/watchdog');
                $this->load->model('class/watchdog_type');

                $register = ['user_id' => $_SESSION['logged_id'], 'type' => Watchdog_type::APPROVE, 'date' => time(), 'ip' => $_SESSION['ip'], 'data' => $_SESSION['transaction_requested_id']];
                $this->watchdog->add_watchdog($register);
                
                //email de bem sucedido
                $GLOBALS['sistem_config'] = $this->system_config->load();
                require_once ($_SERVER['DOCUMENT_ROOT']."/livre/application/libraries/Gmail.php");
                $this->Gmail = new Gmail();      
                $name = explode(' ', $_SESSION['transaction_requested_datas']['name']); $name = $name[0];
                $useremail = $_SESSION['transaction_requested_datas']['email'];
                $account = $_SESSION['transaction_requested_datas']['account']."-".$_SESSION['transaction_requested_datas']['dig'];
                $agency = $_SESSION['transaction_requested_datas']['agency'];
                $bank_name = $_SESSION['transaction_requested_datas']['bank_name'];
                $full_name = $_SESSION['transaction_requested_datas']['name'];
                
                $result = $this->Gmail->transaction_email_approved($name, $useremail, $account, $agency, $bank_name, $full_name);
                if ($result['success']){
                    $result['message'] = 'Transação aprovada e transferência agendada com sucesso!!';
                    $result['reload'] = 1;
                    $result['src_status'] = $this->affiliate_model->get_icon_by_status(transactions_status::TOPAZIO_IN_ANALISYS);                    
                }
                else             
                    $result['message'] = 'Falha enviando email de aprovação. Tente depois.';                
            } else{
                //tratamiento de diferentes problemas que me va am amndar Moreno
                switch ($resp['code_error']){
                    case 1001: //Erro solicitando token de topazio
                            break;
                    case 2001: //Cliente em lista negra de topazio
                            break;
                    case 2002: //Erro verificando lista negra de topazio
                            break;
                    case 2003: //Imposivel comunicar com topazio
                            break;
                    case 2004: //Erro criando basicCustomer dado por Topazio
                            break;
                    case 3001: //Erro calculando proximo dia util com topazio
                            break;
                    case 3002: //Erro com os dados bancarios para a trasferencia
                            break;
                    case 3003: //Erro com algum outro dado para a trasferencia
                            break;
                    default: ;                    
                }
                $result['message'] = "Error emprestimo: ".$resp['code_error'].". Motivo: ( ".$resp['message']." )";    
                $result['success'] = false;    
            }            
        }
        else{
            $_SESSION['logged_id'] = -1;
            $result['message'] = 'Você não possui permisos para fazer esta operação';            
            $result['success'] = false;            
        }
        echo json_encode($result);
    }
    
    public function request_new_photos(){
        $this->load->model('class/affiliate_model');
        $this->load->model('class/system_config');
        $this->load->model('class/transactions_status');
        $this->load->model('class/transaction_model');
        $this->load->model('class/Crypt');
        $result['success'] = false;
        require_once ($_SERVER['DOCUMENT_ROOT']."/livre/application/libraries/Gmail.php");
        if($_SESSION['logged_role'] === 'ADMIN'){
            $tr_data = $this->transaction_model->get_client('id', $_SESSION['transaction_requested_id'])[0];
            if($tr_data['status_id'] == transactions_status::TOPAZIO_IN_ANALISYS ||
               $tr_data['status_id'] == transactions_status::TOPAZIO_APROVED ||
               $tr_data['status_id'] == transactions_status::REVERSE_MONEY){
                $result['message'] = "O estado atual da transação não permite que sejam solicitadas novas fotos";    
                $result['success'] = false;    
                echo json_encode($result);
                return;
            }
            $GLOBALS['sistem_config'] = $this->system_config->load();
            $this->Gmail = new Gmail();      
            $name = explode(' ', $_SESSION['transaction_requested_datas']['name']); $name = $name[0];
            $useremail = $_SESSION['transaction_requested_datas']['email'];                
            $unique_new_photos_code = md5(time()).'-'.md5($_SESSION['transaction_requested_id']);
            $transaction_encrypted_id = $this->Crypt->crypt($_SESSION['transaction_requested_id']);                
            $link = urlencode(base_url().'index.php/welcome/send_new_photos?trid='.$transaction_encrypted_id.'&upc='.$unique_new_photos_code);
            $this->transaction_model->save_in_db(
                    'transactions',
                    'id',$_SESSION['transaction_requested_id'],
                    'new_photos_code',$unique_new_photos_code);
            $this->transaction_model->update_transaction_status(
                        $_SESSION['transaction_requested_id'], 
                        transactions_status::WAIT_PHOTO);
            $result = $this->Gmail->transaction_request_new_photos($name,$useremail,$link);
            if ($result['success']){
                $result['message'] = 'Fotos novas solicitadas com sucesso!!';
                $result['reload'] = 1;
                $result['src_status'] = $this->affiliate_model->get_icon_by_status(transactions_status::WAIT_PHOTO);
            }
            //else             
            //    $result['message'] = 'Falha enviando email de solicitação de novas fotos. Tente depois.';                
            //registrar accion
            $this->load->model('class/watchdog');
            $this->load->model('class/watchdog_type');

            $register = ['user_id' => $_SESSION['logged_id'], 'type' => Watchdog_type::SOLICITED_PHOTO, 'date' => time(), 'ip' => $_SESSION['ip'], 'data' => $_SESSION['transaction_requested_id']];
            $this->watchdog->add_watchdog($register);
        }
        echo json_encode($result);
    }
    
    public function send_new_photos(){
        $this->load->model('class/Crypt');
        $this->load->model('class/affiliate_model');
        $this->load->model('class/transaction_model');
        $datas = $this->input->get();        
        //if($_SESSION['logged_role'] === 'ADMIN'){  //esto es para el usuario por tanto sobra aqui
            $transaction = $this->affiliate_model->load_transaction_datas_by_id($this->Crypt->decrypt($datas['trid']));           
            if($transaction){
               if($datas['upc'] == $transaction['new_photos_code']){
                $this->transaction_model->save_in_db(
                    'transactions',
                    'id',$transaction['client_id'],
                    'new_photos_code',$transaction['new_photos_code'].'--used');          
                $_SESSION['session_new_foto'] = true;   
                $this->load->model('class/system_config');
                $GLOBALS['sistem_config'] = $this->system_config->load();
                $params['transaction']=$transaction;
                $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
                $this->load->view('reenvio-documento',$params);
                $this->load->view('inc/footer',$params);
                } else{
                    print_r('Esse recurso só pode ser usado uma vez. Contate nosso atendimento para pedir um novo acesso.');
                }
            }else{
                print_r('Access violation. Wrong parameters!!');
            }
        //}
    }
    
    public function request_new_account(){
        $this->load->model('class/affiliate_model');
        $this->load->model('class/system_config');
        $this->load->model('class/transactions_status');
        $this->load->model('class/transaction_model');
        $this->load->model('class/Crypt');
        $result['success'] = false;
        require_once ($_SERVER['DOCUMENT_ROOT']."/livre/application/libraries/Gmail.php");        
        if($_SESSION['logged_role'] === 'ADMIN'){
            $tr_data = $this->transaction_model->get_client('id', $_SESSION['transaction_requested_id'])[0];
            if(($tr_data['status_id'] == transactions_status::TOPAZIO_IN_ANALISYS && $_SESSION['robot'] != true) ||
               $tr_data['status_id'] == transactions_status::TOPAZIO_APROVED ||
               $tr_data['status_id'] == transactions_status::REVERSE_MONEY){
                $result['message'] = "O estado atual da transação não permite que seja solicitada uma nova conta";    
                $result['success'] = false;    
                echo json_encode($result);
                return;
            }
            $GLOBALS['sistem_config'] = $this->system_config->load();
            $this->Gmail = new Gmail();
            $name = explode(' ', $_SESSION['transaction_requested_datas']['name']); $name = $name[0];
            $useremail = $_SESSION['transaction_requested_datas']['email'];
            $unique_new_account_bank_code = md5(time()).'-'.md5($_SESSION['transaction_requested_id']);            
            $transaction_encrypted_id = $this->Crypt->crypt($_SESSION['transaction_requested_id']);
            $link = urlencode(base_url().'index.php/welcome/send_new_account?trid='.$transaction_encrypted_id.'&uabc='.$unique_new_account_bank_code);
            $this->transaction_model->save_in_db(
                    'transactions',
                    'id',$_SESSION['transaction_requested_id'],
                    'new_account_bank_code',$unique_new_account_bank_code);
            $this->transaction_model->update_transaction_status(
                        $_SESSION['transaction_requested_id'], 
                        transactions_status::WAIT_ACCOUNT);
            $result = $this->Gmail->transaction_request_new_account_bank($name,$useremail,$link);
            if ($result['success']){
                $result['message'] = 'Nova conta solicitada com sucesso!!';
                $result['reload'] = 1;
                $result['src_status'] = $this->affiliate_model->get_icon_by_status(transactions_status::WAIT_ACCOUNT);
            }
            else             
                $result['message'] = 'Falha enviando email de solicitação de nova conta. Tente depois.';                
            //registrar accion
            $this->load->model('class/watchdog');
            $this->load->model('class/watchdog_type');

            $register = ['user_id' => $_SESSION['logged_id'], 'type' => Watchdog_type::SOLICITED_ACCOUNT, 'date' => time(), 'ip' => $_SESSION['ip'], 'data' => $_SESSION['transaction_requested_id']];
            $this->watchdog->add_watchdog($register);
        }
        echo json_encode($result);
    }
    
    public function send_new_account(){
        $this->load->model('class/Crypt');
        $this->load->model('class/affiliate_model');
        $this->load->model('class/transaction_model');
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $datas = $this->input->get();        
        //if($_SESSION['logged_role'] === 'ADMIN'){//lo quite tambien, sobra para el usuario
            $transaction = $this->affiliate_model->load_transaction_datas_by_id($this->Crypt->decrypt($datas['trid']));
            if($transaction){
               if($datas['uabc'] == $transaction['new_account_bank_code']){
                $this->transaction_model->save_in_db(
                    'transactions',
                    'id',$transaction['client_id'],
                    'new_account_bank_code',$transaction['new_account_bank_code'].'--used');
                $_SESSION['pk'] = $this->Crypt->decrypt($datas['trid']);
                $params['transaction']=$transaction;
                $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
                $this->load->view('reenvio-conta',$params);
                $this->load->view('inc/footer',$params);
                } else{
                    print_r('Esse recurso só pode ser usado uma vez. Contate nosso atendimento para pedir um novo acesso.');
                }
            }else{
                print_r('Access violation. Wrong prameters!!');
            }
        //}
    }
    
    public function recibe_new_account(){
        $this->load->model('class/system_config');
        $this->load->model('class/transactions_status');
        $this->load->model('class/transaction_model');
        $this->load->model('class/Crypt');
        $result['success'] = false;
        $datas = $this->input->post();
        $id_send = $this->Crypt->decrypt($datas['trid']);
        if(!$id_send){
            header('Location: '.base_url());
            return;
        }
        if($_SESSION['pk'] == $this->Crypt->decrypt($datas['trid'])){
            $datas['pk'] = $_SESSION['pk'];
            $account_bank = $this->transaction_model->get_account_bank_by_client_id($datas['pk'],0)[0];
            //if($this->transaction_model->update_db_steep_3($datas,$account_bank['id'])){    //errado, deve ser o id do cliente
            if($this->transaction_model->update_db_steep_3($datas, $_SESSION['pk'])){                
                //1. generar PDF del contrato nuevamente con los datos de la nueva cuenta
                $uudid_doc = $this->upload_document_template_D4Sign($_SESSION['pk']);
                if($uudid_doc){
                    //2. asignar signatario a documento                    
                    $token_signer = $this->signer_for_doc_D4Sign($_SESSION['pk']);
                    if($token_signer){
                        //3.  mandar a assinar
                        $result_send = $this->send_for_sign_document_D4Sign($_SESSION['pk']);
                        if($result_send){
                            //4. cambiar el status de la transaccion
                            $this->transaction_model->update_transaction_status(
                                    $_SESSION['pk'],
                                    transactions_status::WAIT_SIGNATURE);
                            $result['success']=true; //para mostrar el toggle2
                        }                    
                        else{
                                //session_destroy();
                                $result['success'] = false;
                                $result['message'] = "Não foi possivel enviar o documento para assinar! Contate aos nossos atendentes.";  
                            }
                    }
                    else{
                        //session_destroy();
                        $result['success'] = false;
                        $result['message'] = "Não foi possivel cadastrar assinantes no contrato! Contate aos nossos atendentes.";  
                    }
                }
                else{
                    //session_destroy();
                    $result['success'] = false;
                    $result['message'] = "Não foi possivel criar o contrato para a transacação! Contate aos nossos atendentes.";  
                }
            }else{
                $result['success']=false;
                $result['success']='Erro de atualização no banco de dados';
            }
        }else{
            $result['success']=false;
            $result['success']='Access violation';
        }
        echo json_encode($result);
    }
    
    public function request_new_sing_us(){
        $this->load->model('class/affiliate_model');
        $this->load->model('class/system_config');
        $this->load->model('class/transactions_status');
        $this->load->model('class/transaction_model');
        $this->load->model('class/Crypt');
        $result['success'] = false;
        require_once ($_SERVER['DOCUMENT_ROOT']."/livre/application/libraries/Gmail.php");
        if($_SESSION['logged_role'] === 'ADMIN'){
            $tr_data = $this->transaction_model->get_client('id', $_SESSION['transaction_requested_id'])[0];
            if($tr_data['status_id'] == transactions_status::TOPAZIO_IN_ANALISYS ||
               $tr_data['status_id'] == transactions_status::TOPAZIO_APROVED ||
               $tr_data['status_id'] == transactions_status::REVERSE_MONEY){
                $result['message'] = "O estado atual da transação não permite que seja solicitada nova assinatura";    
                $result['success'] = false;    
                echo json_encode($result);
                return;
            }
            $GLOBALS['sistem_config'] = $this->system_config->load();
            $this->Gmail = new Gmail();
            $name = explode(' ', $_SESSION['transaction_requested_datas']['name']); $name = $name[0];
            $useremail = $_SESSION['transaction_requested_datas']['email'];
            $unique_new_sing_us_code = md5(time()).'-'.md5($_SESSION['transaction_requested_id']);            
            $transaction_encrypted_id = $this->Crypt->crypt($_SESSION['transaction_requested_id']);
            $link = urlencode(base_url().'index.php/welcome/send_new_sing_us?trid='.$transaction_encrypted_id.'&uasu='.$unique_new_sing_us_code);
            $this->transaction_model->save_in_db(
                    'transactions',
                    'id',$_SESSION['transaction_requested_id'],
                    'new_sing_us_code',$unique_new_sing_us_code);
            //1. subir el mismo contrato                        
            $uudid_doc = $this->upload_document_template_D4Sign($_SESSION['transaction_requested_id']);
            if($uudid_doc){
                //2. asignar signatario a documento                    
                $token_signer = $this->signer_for_doc_D4Sign($_SESSION['transaction_requested_id']);
                if($token_signer){
                    //3.  mandar a assinar
                    $result_send = $this->send_for_sign_document_D4Sign($_SESSION['transaction_requested_id']);
                    if($result_send){
                        //4. cambiar el status de la transaccion
                        $this->transaction_model->update_transaction_status(
                                    $_SESSION['transaction_requested_id'], 
                                    transactions_status::WAIT_SIGNATURE);
                        $result = $this->Gmail->transaction_request_new_sing_us($name,$useremail,$link);
                        if ($result['success']){
                            $result['message'] = 'Nova assinatura solicitada com sucesso!!';
                            $result['reload'] = 1;
                            $result['src_status'] = $this->affiliate_model->get_icon_by_status(transactions_status::WAIT_SIGNATURE);
                        }
                        else             
                            $result['message'] = 'Falha enviando email de solicitação de nova assinatura. Tente depois.';                
                        //registrar accion
                        $this->load->model('class/watchdog');
                        $this->load->model('class/watchdog_type');

                        $register = ['user_id' => $_SESSION['logged_id'], 'type' => Watchdog_type::SOLICITED_SIGNATURE, 'date' => time(), 'ip' => $_SESSION['ip'], 'data' => $_SESSION['transaction_requested_id']];
                        $this->watchdog->add_watchdog($register);
                    }
                    else{
                                //session_destroy();
                                $result['success'] = false;
                                $result['message'] = "Não foi possivel enviar o documento para assinar! Contate aos nossos atendentes.";  
                            }
                }
                else{
                    //session_destroy();
                    $result['success'] = false;
                    $result['message'] = "Não foi possivel cadastrar assinantes no contrato! Contate aos nossos atendentes.";  
                }
            }
            else{
                //session_destroy();
                $result['success'] = false;
                $result['message'] = "Não foi possivel criar o contrato para a transacação! Contate aos nossos atendentes.";  
            }
        }
        echo json_encode($result);
    }
    
    public function request_recuse_and_reverse_money(){
        $this->load->model('class/affiliate_model');
        $this->load->model('class/system_config');
        $this->load->model('class/transactions_status');
        $this->load->model('class/transaction_model');
        $this->load->model('class/Crypt');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        require_once ($_SERVER['DOCUMENT_ROOT']."/livre/application/libraries/Gmail.php");
        $this->Gmail = new Gmail();
        $result['success'] = false;
        if($_SESSION['logged_role'] === 'ADMIN'){
            $tr_data = $this->transaction_model->get_client('id', $_SESSION['transaction_requested_id'])[0];
            if($tr_data['status_id'] == transactions_status::TOPAZIO_IN_ANALISYS ||
               $tr_data['status_id'] == transactions_status::TOPAZIO_APROVED ||
               $tr_data['status_id'] == transactions_status::REVERSE_MONEY){
                $result['message'] = "O estado atual da transação não permite que seja estornada";    
                $result['success'] = false;    
                echo json_encode($result);
                return;
            }
            //1. estornar dinero
            //$resp = $this->refund_bill_iugu($_SESSION['transaction_requested_id']);
            $resp = $this->refund_transactions($_SESSION['transaction_requested_id']);
            if($resp['success']){
                //2. mudar status de la transaccion
                $this->transaction_model->update_transaction_status(
                    $_SESSION['transaction_requested_id'], 
                    transactions_status::REVERSE_MONEY);
                
                //registrar accion
                $this->load->model('class/watchdog');
                $this->load->model('class/watchdog_type');

                $register = ['user_id' => $_SESSION['logged_id'], 'type' => Watchdog_type::REFUND, 'date' => time(), 'ip' => $_SESSION['ip'], 'data' => $_SESSION['transaction_requested_id']];
                $this->watchdog->add_watchdog($register);
                
                //3. enviar email de estorno
                $name = explode(' ', $_SESSION['transaction_requested_datas']['name']); $name = $name[0];
                $useremail = $_SESSION['transaction_requested_datas']['email'];
                $result = $this->Gmail->transaction_request_recused($name,$useremail);
                $result['reload'] = 1;
                $result['src_status'] = $this->affiliate_model->get_icon_by_status(transactions_status::REVERSE_MONEY);
            }else{
                $result['message'] = $resp['message'];
            }
        }
        echo json_encode($result);
    }
    
    public function get_url_contract(){
        $result['success']=false ;
        $result['message']='Access violation';
        if($_SESSION['logged_role'] === 'ADMIN'){
            $url = $this->download_document_D4Sign($_SESSION['transaction_requested_id']);            
            if($url['success']){
                $result['url_contract']= $url['message'];
                $result['success']=true;
            }else
                $result['message']=$url['message'];
        }
        echo json_encode($result);
    }
    
    public function get_url_image(){
        $this->load->model('class/transaction_model');
        $result['success']=false ;
        $result['message']='Access violation';
        
        $datas = $this->input->post();
        $foto = ['front_credit_card','selfie_with_credit_card','open_identity','selfie_with_identity', 'cpf_card'];
        if(!is_numeric($datas['id']) || $datas['id'] < 0 || $datas['id'] > 4)
            $datas['id'] = 0;
        
        if($_SESSION['logged_role'] === 'ADMIN'){
            $id = $_SESSION['transaction_requested_id'];
            $client = $this->transaction_model->get_client('id', $id)[0];
            
            if($client){
                $result['url_image']= 'assets/data_users/'.$client['folder_in_server'].'/'.$foto[$datas['id']];
                $result['success']=true;
            }else
                $result['message']=$url['message'];
        }
        echo json_encode($result);
    }
    
    public function update_transaction_datas_by_id() {
        $this->load->model('class/transaction_model');
        $this->load->model('class/transactions_status');
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $result['success'] = false;
        if($_SESSION['logged_role'] === 'ADMIN'){
            $id = $_SESSION['transaction_requested_id'];
            $datas =  $this->input->post();            
            $personal_datas=array();
            if(isset($datas['edit_trans_name'])) $personal_datas['name']=$datas['edit_trans_name'];
            if(isset($datas['edit_trans_email'])) $personal_datas['email']=$datas['edit_trans_email'];
            if(isset($datas['edit_trans_phone_ddd'])) $personal_datas['phone_ddd']=$datas['edit_trans_phone_ddd'];
            if(isset($datas['edit_trans_phone_number'])) $personal_datas['phone_number']=$datas['edit_trans_phone_number'];
            if(isset($datas['edit_trans_cep'])) $personal_datas['cep']=$datas['edit_trans_cep'];
            if(isset($datas['edit_trans_street_address'])) $personal_datas['street_address']=$datas['edit_trans_street_address'];
            if(isset($datas['edit_trans_number_address'])) $personal_datas['number_address']=$datas['edit_trans_number_address'];
            if(isset($datas['edit_trans_complement_address'])) $personal_datas['complement_number_address']=$datas['edit_trans_complement_address'];
            if(isset($datas['edit_trans_city_address'])) $personal_datas['city_address']=$datas['edit_trans_city_address'];
            if(isset($datas['edit_trans_state_address'])) $personal_datas['state_address']=$datas['edit_trans_state_address'];            
            $a = $this->transaction_model->update_db_steep_1($personal_datas,$id);
            
            if(isset($datas['edit_trans_credit_card_name'])) $credit_card_datas['credit_card_name']=$datas['edit_trans_credit_card_name'];
            $b = $this->transaction_model->update_db_steep_2($credit_card_datas,$id);
            
            if(isset($datas['edit_trans_bank_code'])) $bank_datas['bank']=$datas['edit_trans_bank_code'];
            if(isset($datas['edit_trans_agency'])) $bank_datas['agency']=$datas['edit_trans_agency'];
            if(isset($datas['edit_trans_account'])) $bank_datas['account']=$datas['edit_trans_account'];
            if(isset($datas['edit_trans_dig'])) $bank_datas['dig']=$datas['edit_trans_dig'];
            if(isset($datas['edit_account_type'])) $bank_datas['account_type']=$datas['edit_account_type'];
            $c = $this->transaction_model->update_db_steep_3($bank_datas,$id);
            
            $result['message']="";
            if(!$a)
                $result['message'].="Erro armazenando dados pessoais ---";
            else
                $result['message'].="Dados pessoais armazenandos corretamente---";
            if(!$b)
                $result['message'].="Erro armazenando dados do cartão ---";
            else
                $result['message'].="Dados do cartão armazenandos corretamente ---";
            if(!$c)
                $result['message'].="Erro armazenando dados da conta";
            else
                $result['message'].="Dados da conta armazenandos corretamente";
            $result['success']=true;
            //registrar accion
            $this->load->model('class/watchdog');
            $this->load->model('class/watchdog_type');

            $register = ['user_id' => $_SESSION['logged_id'], 'type' => Watchdog_type::UPDATE, 'date' => time(), 'ip' => $_SESSION['ip'], 'data' => $_SESSION['transaction_requested_id']];
            $this->watchdog->add_watchdog($register);
        }
        echo json_encode($result);
    }
    
    public function delete_transaction_datas_by_id() {
        $this->load->model('class/transaction_model');
        $this->load->model('class/transactions_status');
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        if($_SESSION['logged_role'] === 'ADMIN'){
            $datas = $this->input->post();
            $tr = $this->get_transaction_datas_by_id($datas);
            if($tr['success']){
                if($tr['message']['status_id']==transactions_status::BEGINNER){
                    $a=$this->transaction_model->delete_transaction_by_id_transaction($datas['id']);
                    $b=$this->transaction_model->delete_credit_card_by_id_transaction($datas['id']);
                    $c=$this->transaction_model->delete_account_bank_by_id_transaction($datas['id']);
                    $d=$this->transaction_model->delete_transactions_dates_by_id_transaction($datas['id']);
                    //$d=$this->transaction_model->delete_washdog_by_id_transaction($datas['id']);
                    $result['success'] = true;                    
                    
                    //registrar accion
                    $this->load->model('class/watchdog');
                    $this->load->model('class/watchdog_type');

                    $register = ['user_id' => $_SESSION['logged_id'], 'type' => Watchdog_type::DELETE, 'date' => time(), 'ip' => $_SESSION['ip'], 'data' => $datas['id']];
                    $this->watchdog->add_watchdog($register);

                } else{
                    $result['success'] = false;
                    $result['message'] = 'O status da transação não permite essa operação';
                }
            }else{
                $result['success'] = false;
                $result['message'] = 'Transação não encontrada';
            }
        }else{
            $result['success'] = false;
            $result['message'] = 'Operação não permitida para esse usuário';
        }
        echo json_encode($result);
    }
    
    //-------AUXILIAR FUNCTIONS------------------------------------    
    public function set_session(){
        session_start();
        $_SESSION = array();
        //$ip=$_SERVER['REMOTE_ADDR'];
        $ip = $this->getUserIP();
        $key=md5($ip.time());
        $_SESSION['ip']=$ip;
        $_SESSION['key']=$key;
    }

    public function is_ip_hacker(){                        
        if($this->is_ip_hacker_response()){            
            session_destroy();
            header('Location: '.base_url());
            exit();
        }
    }
    
    public function is_ip_hacker_response(){                
        $IP_hackers= array(
            '191.176.169.242', '138.0.85.75', '138.0.85.95', '177.235.130.16', '191.176.171.14', '200.149.30.108', '177.235.130.212', '66.85.185.69',
            '177.235.131.104', '189.92.238.28', '168.228.88.10', '201.86.36.209', '177.37.205.210', '187.66.56.220', '201.34.223.8', '187.19.167.94',
            '138.0.21.188', '168.228.84.1', '138.36.2.18', '201.35.210.135', '189.71.42.124', '138.121.232.245', '151.64.57.146', '191.17.52.46', '189.59.112.125',
            '177.33.7.122', '189.5.107.81', '186.214.241.146', '177.207.99.29', '170.246.230.138', '201.33.40.202', '191.53.19.210', '179.212.90.46', '177.79.7.202',
            '189.111.72.193', '189.76.237.61', '177.189.149.249', '179.223.247.183', '177.35.49.40', '138.94.52.120', '177.104.118.22', '191.176.171.14', '189.40.89.248',
            '189.89.31.89', '177.13.225.38',  '186.213.69.159', '177.95.126.121', '189.26.218.161', '177.193.204.10', '186.194.46.21', '177.53.237.217', '138.219.200.136',
            '177.126.106.103', '179.199.73.251', '191.176.171.14', '179.187.103.14', '177.235.130.16', '177.235.130.16', '177.235.130.16', '177.47.27.207',
            '177.95.148.2','189.40.95.207','177.42.228.212','189.40.93.235','138.97.87.6', '177.37.215.106'
            );
        $ip = $this->getUserIP();
        $this->load->model('class/hack');
        $result = $this->hack->is_ip_hacker($ip);
        if($result){//in_array($ip, $IP_hackers)){            
            return true;
        }
        return false;
    }
    
    public function is_nome_hacker(){
        $nome_hackers= array(
            'RENATA JUSTINIANO RIBEIRO'
            );
        if(in_array($_SERVER['REMOTE_ADDR'],$nome_hackers)){            
            header('Location: '.base_url());
        }
    }
    
    public function is_phone_hacker($datas){
        $phone = '000000000';
        if(array_key_exists("phone_ddd", $datas) && array_key_exists("phone_number", $datas))
            $phone = $datas['phone_ddd'].$datas['phone_number'];
        
        /*$phone_hackers= array(
            '000000000', '27997353520', '71991412687', '88988681079','85998401261','88988381515'
            );*/
        $this->load->model('class/hack');
        $result = $this->hack->is_data_hacker('phone',$phone);
        if($result){                       
            return ['success'=>false, 'message'=>'Problemas enviando o codigo de SMS'];
        }
        return ['success'=>true, 'message'=>'OK'];
    }
    
    public function is_data_hacker($datas){
        $this->load->model('class/hack');
        $email = 'a@a';
        if(array_key_exists("email", $datas))
            $email = $datas['email'];
        
        /*$email_hackers= array(
            'a@a', 'taciodsbarbosa@hotmail.com', 'joseluiznovaisdasilvaluiz@gmail.com',
            'paulogutembergamaral001@gmail.com','paulolindembergamaral@gmail.com',
            'silvaeliomarp129@gmail.com','nelvsj@gmail.com','edivandop129@gmail.com'
            );*/
        $result = $this->hack->is_data_hacker('email',$email);
        if($result){                       
            //header('Location: '.base_url());
            return ['success'=>false, 'message'=>'Não foi possível continuar com a solicitude'];
        }
        
        $cpf = '00000000000';
        if(array_key_exists("cpf", $datas))
            $cpf = $datas['cpf'];
        
        /*$cpf_hackers= array(
            '00000000000', '05748580594','05073125380','72556846372','31786862824','04446988336'
            );*/
        $result = $this->hack->is_data_hacker('cpf',$cpf);
        if($result){                       
            //header('Location: '.base_url());
            return ['success'=>false, 'message'=>'Não foi possível continuar com a solicitude'];
        }
        return ['success'=>true, 'message'=>'OK'];
    }
    
    public function getUserIP() {
        if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) {
                $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
                return trim($addr[0]);
            } else {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        }
        else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    public function track_init() {
        $this->load->model('class/track_money_model');        
        $datas = $this->input->post();                
        $data_track['solicited_value']=(float)$datas['solicited_value']*100;                
        $data_track['ip']= $_SERVER['REMOTE_ADDR'];
        $data_track['track_date']=time();
        $id_row = $this->track_money_model->insert_required_money($data_track);
        $result['success'] = false;
        $result['message'] = 'Só pode solicitar um valor entre R$300 e R$5000';
        echo json_encode($result);       
    }
    
    public function verify_simulation($datas=NULL) {        
        $flag=false;
        if(!$datas){
            $datas = $this->input->post();
            $flag=true;
        }
        $datas['amount_months']=(int)$datas['amount_months'];
        $datas['solicited_value']=(float)$datas['solicited_value'];
        if(($datas['amount_months']>=4 && $datas['amount_months']<=12)){
            if($datas['solicited_value']>=300 && $datas['solicited_value']<=5000){                
                $financials = $this->calculating_enconomical_values($datas["solicited_value"], $datas["amount_months"]);
                $result['solicited_value']=$financials['solicited_value'];  
                $result['amount_months']=$financials['amount_months'];
                $result['total_cust_value'] = $financials['total_cust_value'];                        
                $result['month_value'] =$financials['month_value'];
                $result['tax'] =$financials['tax'];
                $result['IOF'] =$financials['IOF']; //valor a cobrar por IOF
                $result['TAC'] =$financials['TAC'];
                $result['TAC_PERC'] =$financials['TAC_PERC'];
                $result['CET_PERC'] =$financials['CET_PERC'];
                $result['CET_YEAR'] =$financials['CET_YEAR'];
                $result['success'] = true;                
                $_SESSION['transaction_values']=$result;                
            } else{
                $result['success'] = false;
                $result['message'] = 'Só pode solicitar um valor entre R$300 e R$5000';
            }
        }else{
            $result['success'] = false;
            $result['message'] = 'Os dados enviados estão errados';
        }
        if($flag)
            echo json_encode($result);
        else
            return $result;
    }    
    
    public function generate_contract($client_id) {        
        $this->load->model('class/transaction_model');
        $this->load->model('class/transactions_status');        
        require_once $_SERVER['DOCUMENT_ROOT'] . '/livre/contrat/fpdf/fpdf.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/livre/contrat/contrato.php';
        $pdf = new PDF('P','mm','A4');
        $datas = $this->transaction_model->get_all_client_datas_by_id($client_id);
        $pdf->GenerateContrat($datas,false,true,false);
    }
    
    public function validate_month($str, $pattern) {
        //TODO: buscar função que avalie uma expressão regular em PHP
        if($str>0 && $str<13)
            return true;
        return false;
    }
    
    public function validate_year($str, $pattern) {
        //TODO: buscar função que avalie uma expressão regular em PHP
        if($str>2017 && $str<2033)
            return true;
        return false;    
    }
    
    public function validate_date($month, $year) {
        $now = time();
        $m_today = date("n", $now);
        $y_today = date("Y", $now);  
        if ($year < $y_today || ($year == $y_today && $month <= $m_today+1)){
            return false;
        }
        return true;
    }
    
    public function validate_element($str,$pattern) {
        //TODO: buscar função que avalie uma expressão regular em PHP
        //if(preg_match('/'.$pattern,$str))
            return true;
        //return false;
    }
    
    public function validate_cpf($cpf = null) {
        if(empty($cpf)) 
            return false; 
        $cpf = preg_replace('[^0-9]', '', $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
        if (strlen($cpf) != 11)
            return false;    
        else if ($cpf == '00000000000' || 
            $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || 
            $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || 
            $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
            return false;
         } else {   
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d) {
                    return false;
                }
            }
            return true;
        }
    }
    
    public function validate_all_general_user_datas($datas){
        $name  = $this->validate_element($datas['name'], '^[A-Z ]{6,150}$');
        $email = $this->validate_element($datas['email'], '^[a-zA-Z0-9\._-]+@([a-zA-Z0-9-]{2,}[.])*[a-zA-Z]{2,4}$');
        $phone_ddd = $this->validate_element($datas['phone_ddd'], '^[0-9]{2,3}$');
        $phone_number = $this->validate_element($datas['phone_number'], '^[0-9]{7,10}$');
        $cpf = $this->validate_cpf($datas['cpf'], '^[0-9]{11}$');
        $cep = $this->validate_element($datas['cep'], '^[0-9]{6,10}$');
        $street_address = $this->validate_element($datas['street_address'], '^[a-zA-Z ]{5,}$');
        $number_address = $this->validate_element($datas['number_address'], '^[0-9]{1,7}$');
        $complement = $this->validate_element($datas['complement_number_address'], '^[0-9]{1,7}$');
        $city = $this->validate_element($datas['city_address'], '^[a-zA-Z ]{1,50}$');                
        if(!name || !email || !phone_ddd || !phone_number || 
           !cpf || !cep || !street_address || !number_address || !complement || !city)
            return false;
        return true;
    }
    
    public function validate_all_credit_card_datas($datas){        
        /* Solo validar el nombre, token y ultimos 4 digitos*/        
        $number = $this->validate_element($datas['credit_card_number'], "^[0-9]{4,4}$");        
        $name = $this->validate_element($datas['credit_card_name'], "^[A-Z ]{4,50}$");
        $token = $this->validate_element($datas['token'], "^[0-9A-Z-]{4,50}$");
        if(!$number || !$name || !$token)
            return false;
        return true;
        /*
        $number = $this->validate_element($datas['credit_card_number'], "^[0-9]{10,20}$");        
        // Visa card: starting with 4, length 13 or 16 digits.
        if ($number) {
            $number = $this->validate_element($datas['credit_card_number'], "^(?:4[0-9]{12}(?:[0-9]{3})?)$");
        // MasterCard: starting with 51 through 55, length 16 digits.
        if (!$number)  {
            $number = $this->validate_element($datas['credit_card_number'], "^(?:5[1-5][0-9]{14})$");
        // American Express: starting with 34 or 37, length 15 digits.
        if (!$number) {
            $number = $this->validate_element($datas['credit_card_number'], "^(?:3[47][0-9]{13})$");
        // Discover card: starting with 6011, length 16 digits or starting with 5, length 15 digits.
        if (!$number){
            $number = $this->validate_element($datas['credit_card_number'], "^(?:6(?:011|5[0-9][0-9])[0-9]{12})$");
        // Diners Club card: starting with 300 through 305, 36, or 38, length 14 digits.
        if (!$number){
            $number = $this->validate_element($datas['credit_card_number'], "^(?:3(?:0[0-5]|[68][0-9])[0-9]{11})$");
        // Elo credit card
        if (!$number){
            $number = $this->validate_element($datas['credit_card_number'], "^(?:((((636368)|(438935)|(504175)|(451416)|(636297))[0-9]{0,10})|((5067)|(4576)|(4011))[0-9]{0,12}))$");
        // Validating a Hypercard
        if (!$number) {            
            $number = $this->validate_element($datas['credit_card_number'], "^(?:(606282[0-9]{10}([0-9]{3})?)|(3841[0-9]{15}))$");
        }}}}}}}
            
        $name = $this->validate_element($datas['credit_card_name'], "^[A-Z ]{4,50}$");
        $cvv = $this->validate_element($datas['credit_card_cvv'], "^[0-9]{3,4}$");
        $month = $this->validate_month($datas['credit_card_exp_month'], "^[0-10-9]{2,2}$");
        $year = $this->validate_year($datas['credit_card_exp_year'], "^[2-20-01-20-9]{4,4}$");            
        $date = $this->validate_date($datas['credit_card_exp_month'],$datas['credit_card_exp_year']);            
        if(!$number || !$name || !$cvv || !$month || !$year || !$date)
            return false;
        return true;    
        */
    }
    
    public function validate_bank_datas($datas){        
        $bank = $this->validate_element($datas['bank'], "^[0-9]{4,4}$");        
        $agency = $this->validate_element($datas['agency'], "^[0-9]{4,12}$");
        $account_type = $this->validate_element($datas['account_type'], "^[A-Z]{2,2}$");        
        $account = $this->validate_element($datas['account'], "^[0-9]{4,12}$");
        $dig = $this->validate_element($datas['dig'], "^[0-9]{1,12}$");            
        $titular_name = $this->validate_element($datas['titular_name'],'^[A-Z ]{6,150}$');            
        $titular_cpf = $this->validate_cpf($datas['cpf'], '^[0-9]{11}$');
        if ($bank && $agency && $account_type && $account && $dig && $titular_name && $titular_cpf)
            return false;
        return true;
    }
    
    public function get_cep_datas(){
        $cep = $this->input->post()['cep'];
        $cep = str_replace(".","",$cep);
        $cep = str_replace("-","",$cep);
        $datas = file_get_contents('https://viacep.com.br/ws/'.$cep.'/json/');
        if(strpos($datas,'erro')>0){
            $response['success']=false;
        } else{
            $response['success']=true;
        }
        $response['datas'] = json_decode($datas);
        echo json_encode($response);
    }
    
    public function request_sms_code(){
        $datas = $this->input->post();
        $hack_result = $this->is_phone_hacker($datas);
        if($hack_result['success']){
            if($datas['key']===$_SESSION['key']){
                $phone_country_code = '+55';            
                $phone_ddd = $datas['phone_ddd'];
                $phone_number = $datas['phone_number'];
                $random_code = rand(100000,999999); //$random_code = 123;
                $message = $random_code;
                $response = $this->send_sms_kaio_api($phone_country_code, $phone_ddd, $phone_number, $message);
                if($response['success']){
                    $_SESSION['client_datas']['phone_ddd'] = $phone_ddd;
                    $_SESSION['client_datas']['sms_verificated'] = $phone_number;
                    $_SESSION['client_datas']['random_sms_code'] = $random_code;
                    $result['success']=true;
                }else{
                    $result['success']=false;
                    $result['message']=$response['message'];
                }
            }else{
                $result['success']=false;
                $result['message']='Access violation';
            }
        }else{
            $result = $hack_result;
        }
        
        echo json_encode($result);
    }
    
    public function verify_sms_code(){
        $a=$this->input->post()['input_sms_code_confirmation'];
        $b=$_SESSION['client_datas']['random_sms_code'];
        if($this->input->post()['key']===$_SESSION['key']){
            if($this->input->post()['input_sms_code_confirmation']==$_SESSION['client_datas']['random_sms_code']){
                $_SESSION['client_datas']['verified_phone'] = $_SESSION['client_datas']['sms_verificated'];
                $_SESSION['client_datas']['sms_verificated'] = true;                
                $result['success']=true;                
            }else{
                $result['success']=false;
                $result['message']='Código incorreto';
            }
        }else{
            $result['success']=false;
            $result['message']='Access violation';
        }
        echo json_encode($result);
    }
    
    public function to_csv($values){
	// We can use one implode for the headers =D
	//$csv = implode(",", array_keys(reset($values))) . PHP_EOL;
	$csv = "";
	foreach ($values as $row) {
            foreach ($row as $elem){
                    $csv .= $elem.",";	    
            }
	    $csv .= PHP_EOL;
	}
	return $csv;
    }
    
    function str_putcsv2($data) {
        # Generate CSV data from array
        $fh = fopen('php://temp', 'rw'); # don't create a file, attempt
                                         # to use memory instead

        # write out the headers
        fputcsv($fh, array_keys(current($data)),PHP_EOL);

        # write out the data
        foreach ( $data as $row ) {
                fputcsv($fh, $row, PHP_EOL);
        }
        rewind($fh);
        $csv = stream_get_contents($fh);
        fclose($fh);

        return $csv;
    }
    
    //-------SMS KAIO API---------------------------------------
    public function send_sms_kaio_api($phone_country_code, $phone_ddd, $phone_number, $message){        
        //com kaio_api
        //$response['success'] = TRUE;    //remover essas dos lineas
        //return $response;
        
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $authenticationtoken = $GLOBALS['sistem_config']->AUTENTICATION_TOKEN_SMS;
        $username = $GLOBALS['sistem_config']->USER_NAME_SMS;
        
        $full_number = $phone_country_code.$phone_ddd.$phone_number;
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api-messaging.movile.com/v1/send-sms",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          //CURLOPT_POSTFIELDS => "{\"destination\": \"".$full_number."\" ,  \"messageText\": \"Code number\\n".$message."\"}",
          CURLOPT_POSTFIELDS => '{"destination": "'.$full_number.'" ,  "messageText": "Para validar seu telefone na livre.digital use o codigo '.$message.'"}',
          CURLOPT_HTTPHEADER => array(
            "authenticationtoken: ".$authenticationtoken,
            "username: ".$username,
            "content-type: application/json"
          ),
        ));

        $response_curl = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        
        $response = [];
        if ($err) {
          //echo "cURL Error #:" . $err;
            $response['success'] = FALSE;
            $response['message'] = $err;
        } else {
            $response['success'] = TRUE;
        }        
        return $response;
    }
            
    //-------UPLOADING PHOTO---------------------------------------
    public function upload_file(){
        $this->load->model('class/transaction_model');
        $datas = $this->input->post();
        if($_SESSION['is_possible_steep_1'] && $_SESSION['is_possible_steep_2'] && $_SESSION['is_possible_steep_3'] && $datas['key']===$_SESSION['key']){
            $client = $this->transaction_model->get_client('id', $_SESSION['pk']);                            
            $path_name = "assets/data_users/".$client[0]['folder_in_server'];             
            
            if(is_dir($path_name) || mkdir($path_name, 0755)){            
                $result = [];
                $result['success'] = false;
                $result['message'] = "";
                if($fileError == UPLOAD_ERR_OK){
                   //Processes your file here
                    $allowedExts = array("gif", "jpeg", "jpg", "png", "pdf", "pjpeg", "x-png");
                    $temp = explode(".", $_FILES["file"]["name"]);
                    $extension = strtolower( end($temp) );
                    if ((($_FILES["file"]["type"] == "image/gif")
                    || ($_FILES["file"]["type"] == "image/jpeg")
                    || ($_FILES["file"]["type"] == "application/pdf")
                    || ($_FILES["file"]["type"] == "image/jpg")
                    || ($_FILES["file"]["type"] == "image/pjpeg")
                    || ($_FILES["file"]["type"] == "image/x-png")
                    || ($_FILES["file"]["type"] == "image/png"))
                    && ($_FILES["file"]["size"] < 10485761)
                    && in_array($extension, $allowedExts)) {
                        if ($_FILES["file"]["error"] > 0) {
                            $result['message'] .= "Return Code: " . $_FILES["file"]["error"];
                        } else {
                            $file_names = ["front_credit_card","selfie_with_credit_card","open_identity","selfie_with_identity","cpf_card"];
                            $id_file = $datas['id'];
                            if(!is_numeric($id_file))
                                $id_file = 0;
                            if($id_file < 0 || $id_file > 4)
                                $id_file = 0;
                            
                            $filename = $file_names[$id_file];
                                           
                            if (file_exists($path_name."/". $file_names[$id_file])) {
                                unlink($path_name."/".$file_names[$id_file]);                            
                            } 
                            
                            move_uploaded_file($_FILES["file"]["tmp_name"],
                            $path_name."/". $filename);
                            
                            //$result['message'] = "Salvado " . $filename;
                            $result['success'] = true;
                            $_SESSION[$file_names[$id_file]] = true;
                        }
                    } else {
                        if($_FILES["file"]["size"] >= 10485761){
                            $result['message'] .= "O tamanho do arquivo excede os 10 mb!";
                        }
                        else{
                            $result['message'] .= "Extensão da imagem inválida ou a imagem está corrompida";
                        }
                    }            
                }else{
                   switch($fileError){
                     case UPLOAD_ERR_INI_SIZE:   
                          $message = 'Erro ao tentar subir um arquivo que excede o tamanho permitido.';
                          break;
                     case UPLOAD_ERR_FORM_SIZE:  
                          $message = 'Erro ao tentar subir um arquivo que excede o tamanho permitido.';
                          break;
                     case UPLOAD_ERR_PARTIAL:    
                          $message = 'Erro: não terminou a ação de subir o arquivo.';
                          break;
                     case UPLOAD_ERR_NO_FILE:    
                          $message = 'Erro: nenhum arquivo foi subido.';
                          break;
                     case UPLOAD_ERR_NO_TMP_DIR: 
                          $message = 'Erro: servidor não configurado para carga de arquivos.';
                          break;
                     case UPLOAD_ERR_CANT_WRITE: 
                          $message= 'Erro: posivel falha ao gravar o arquivo.';
                          break;
                     case  UPLOAD_ERR_EXTENSION: 
                          $message = 'Erro: carga de arquivo não completada.';
                          break;
                     default: $message = 'Erro: carga de arquivo não completada.';
                              break;
                    }
                    $result['success'] = false;
                    $result['message'] .= $message;
                }
            }
            else{
                $result['success'] = false;
                $result['message'] = "Impossivel criar pasta dos arquivos";
            }
        }
        else{
            $result['success'] = false;
            //$result['message'] = "Sessão expirou";
            header('Location: '.base_url());
        }    
        echo json_encode($result);
    }
    
    public function upload_file_affiliate(){    
        $datas = $this->input->post();
        if($_SESSION['logged_id'] && $_SESSION['logged_role'] = "AFFIL"){
            $path_name = "assets/data_affiliates/affiliate_".$_SESSION['logged_id'];             
            
            if(is_dir($path_name) || mkdir($path_name, 0755)){            
                $result = [];
                $result['success'] = false;
                $result['message'] = "";
                if($fileError == UPLOAD_ERR_OK){
                   //Processes your file here
                    $allowedExts = array("gif", "jpeg", "jpg", "png", "pdf", "pjpeg", "x-png");
                    $temp = explode(".", $_FILES["file"]["name"]);
                    $extension = strtolower( end($temp) );
                    if ((($_FILES["file"]["type"] == "image/gif")
                    || ($_FILES["file"]["type"] == "image/jpeg")
                    || ($_FILES["file"]["type"] == "application/pdf")
                    || ($_FILES["file"]["type"] == "image/jpg")
                    || ($_FILES["file"]["type"] == "image/pjpeg")
                    || ($_FILES["file"]["type"] == "image/x-png")
                    || ($_FILES["file"]["type"] == "image/png"))
                    && ($_FILES["file"]["size"] < 10485761)
                    && in_array($extension, $allowedExts)) {
                        if ($_FILES["file"]["error"] > 0) {
                            $result['message'] .= "Return Code: " . $_FILES["file"]["error"];
                        } else {
                            $file_names = ["photo_profile"];
                            $id_file = 0;
                            
                            $filename = $file_names[$id_file];
                                           
                            if (file_exists($path_name."/". $file_names[$id_file])) {
                                unlink($path_name."/".$file_names[$id_file]);                            
                            } 
                            
                            move_uploaded_file($_FILES["file"]["tmp_name"],
                            $path_name."/". $filename);
                            
                            $result['message'] = base_url().'assets/data_affiliates/affiliate_'.$_SESSION['logged_id'].'/photo_profile?'.time();
                            $result['success'] = true;
                            $_SESSION[$file_names[$id_file]] = true;
                        }
                    } else {
                        if($_FILES["file"]["size"] >= 10485761){
                            $result['message'] .= "O tamanho do arquivo excede os 10 mb!";
                        }
                        else{
                            $result['message'] .= "Extensão da imagem inválida ou a imagem está corrompida";
                        }
                    }            
                }else{
                   switch($fileError){
                     case UPLOAD_ERR_INI_SIZE:   
                          $message = 'Erro ao tentar subir um arquivo que excede o tamanho permitido.';
                          break;
                     case UPLOAD_ERR_FORM_SIZE:  
                          $message = 'Erro ao tentar subir um arquivo que excede o tamanho permitido.';
                          break;
                     case UPLOAD_ERR_PARTIAL:    
                          $message = 'Erro: não terminou a ação de subir o arquivo.';
                          break;
                     case UPLOAD_ERR_NO_FILE:    
                          $message = 'Erro: nenhum arquivo foi subido.';
                          break;
                     case UPLOAD_ERR_NO_TMP_DIR: 
                          $message = 'Erro: servidor não configurado para carga de arquivos.';
                          break;
                     case UPLOAD_ERR_CANT_WRITE: 
                          $message= 'Erro: posivel falha ao gravar o arquivo.';
                          break;
                     case  UPLOAD_ERR_EXTENSION: 
                          $message = 'Erro: carga de arquivo não completada.';
                          break;
                     default: $message = 'Error: carga de arquivo não completada.';
                              break;
                    }
                    $result['success'] = false;
                    $result['message'] .= $message;
                }
            }
            else{
                $result['success'] = false;
                $result['message'] = "Impossivel criar pasta dos arquivos";
            }
        }
        else{
            $result['success'] = false;
            //$result['message'] = "Sessão expirou";
            header('Location: '.base_url());
        }    
        echo json_encode($result);
    }
    
    public function new_upload_file(){
        $this->load->model('class/transaction_model');
        $this->load->model('class/Crypt');
        $datas = $this->input->post();
        if($_SESSION['session_new_foto']){                        
            $client = $this->transaction_model->get_client('id', $this->Crypt->decrypt($datas['trid']));                            
            $path_name = "assets/data_users/".$client[0]['folder_in_server'];             
            if(is_dir($path_name) && count($client) == 1){            
                $result = [];
                $result['success'] = false;
                $result['message'] = "";
                if($fileError == UPLOAD_ERR_OK){
                   //Processes your file here
                    $allowedExts = array("gif", "jpeg", "jpg", "png", "pdf", "pjpeg", "x-png");
                    $temp = explode(".", $_FILES["file"]["name"]);
                    $extension = strtolower( end($temp) );
                    if ((($_FILES["file"]["type"] == "image/gif")
                    || ($_FILES["file"]["type"] == "image/jpeg")
                    || ($_FILES["file"]["type"] == "image/jpg")
                    || ($_FILES["file"]["type"] == "image/pjpeg")
                    || ($_FILES["file"]["type"] == "image/x-png")
                    || ($_FILES["file"]["type"] == "image/png"))
                    && ($_FILES["file"]["size"] < 10485761)
                    && in_array($extension, $allowedExts)) {
                        if ($_FILES["file"]["error"] > 0) {
                            $result['message'] .= "Return Code: " . $_FILES["file"]["error"];
                        } else {
                            $file_names = ["front_credit_card","selfie_with_credit_card","open_identity","selfie_with_identity","cpf_card"];
                            $id_file = $datas['id'];
                            if(!is_numeric($id_file))
                                $id_file = 0;
                            if($id_file < 0 || $id_file > 4)
                                $id_file = 0;
                            
                            $filename = $file_names[$id_file];
                                           
                            if (file_exists($path_name."/". $file_names[$id_file])) {
                                unlink($path_name."/".$file_names[$id_file]);                            
                            } 
                            
                            move_uploaded_file($_FILES["file"]["tmp_name"],
                            $path_name."/". $filename);
                            
                            //$result['message'] = "Salvado " . $filename;
                            $result['success'] = true;
                            $_SESSION["new_".$file_names[$id_file]] = true;
                        }
                    } else {
                        if($_FILES["file"]["size"] >= 10485761){
                            $result['message'] .= "O tamanho do arquivo excede os 10 mb!";
                        }
                        else{
                            $result['message'] .= "Extensão da imagem inválida ou a imagem está corrompida";
                        }
                    }            
                }else{
                   switch($fileError){
                     case UPLOAD_ERR_INI_SIZE:   
                          $message = 'Erro ao tentar subir um arquivo que excede o tamanho permitido.';
                          break;
                     case UPLOAD_ERR_FORM_SIZE:  
                          $message = 'Erro ao tentar subir um arquivo que excede o tamanho permitido.';
                          break;
                     case UPLOAD_ERR_PARTIAL:    
                          $message = 'Erro: não terminou a ação de subir o arquivo.';
                          break;
                     case UPLOAD_ERR_NO_FILE:    
                          $message = 'Erro: nenhum arquivo foi subido.';
                          break;
                     case UPLOAD_ERR_NO_TMP_DIR: 
                          $message = 'Erro: servidor não configurado para carga de arquivos.';
                          break;
                     case UPLOAD_ERR_CANT_WRITE: 
                          $message= 'Erro: posivel falha ao gravar o arquivo.';
                          break;
                     case  UPLOAD_ERR_EXTENSION: 
                          $message = 'Erro: carga de arquivo não completada.';
                          break;
                     default: $message = 'Erro: carga de arquivo não completada.';
                              break;
                    }
                    $result['success'] = false;
                    $result['message'] .= $message;
                }
            }
            else{
                $result['success'] = false;
                $result['message'] = "Impossivel subir os arquivos neste momento! Consulte aos nossos atendentes.";
            }
        }
        else{
            $result['success'] = false;
            //$result['message'] = "Sessão expirou";
            header('Location: '.base_url());
        }    
        echo json_encode($result);
    }
    
    public function new_finished_upload() {
        $this->load->model('class/transaction_model');
        $this->load->model('class/transactions_status');
        $this->load->model('class/Crypt');
        $datas = $this->input->post();
        $cpf_upload = true;
        if($datas['new_ucpf'] == 'true' && !$_SESSION['new_cpf_card']){            
            $cpf_upload = false;
        }
        if($_SESSION['session_new_foto']){
            if($_SESSION['new_front_credit_card'] && $_SESSION['new_selfie_with_credit_card'] && $_SESSION['new_open_identity'] && $_SESSION['new_selfie_with_identity'] && $cpf_upload){           
                $result['success'] = TRUE;
                $result['message'] = "Fotos subidas corretamente. Sua transferencia está sendo analisada.";                
                $value_ucpf = 0;
                if($datas['new_ucpf'] == 'true')
                    $value_ucpf = 1;
                $this->transaction_model->save_cpf_card($this->Crypt->decrypt($datas['trid']), $value_ucpf);
                $this->transaction_model->update_transaction_status($this->Crypt->decrypt($datas['trid']), transactions_status::PENDING);
                session_destroy();
            }
            else{                
                $result['success'] = false;
                $result['message'] = "Deve subir todas as imagens solicitadas corretamente";                
            }
        }
        else{
            $result['success'] = false;
            $result['message'] = "As fotos foran enviadas! Link de um uso único";
            //header('Location: '.base_url());
        }
        echo json_encode($result);
    }
    
    //-------IUGU API-----------------------------------------------
    /*public function iugu_simples_sale(){
        require_once($_SERVER['DOCUMENT_ROOT']."/livre/application/libraries/iugu-php-master/lib/Iugu.php");
        Iugu::setApiKey("c73d49f9-6490-46ee-ba36-dcf69f6334fd"); // Ache sua chave API no Painel
        Iugu_Charge::create(
            [
                "token"=> "TOKEN QUE VEIO DO IUGU.JS OU CRIADO VIA BIBLIOTECA",
                "email"=>"your@email.test",
                "items" => [
                    [
                        "description"=>"Item Teste",
                        "quantity"=>"1",
                        "price_cents"=>"1000"
                    ]
                ]
            ]
        );
    }*/
    
    public function get_client_token_iugu($id){        
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $account_id = $GLOBALS['sistem_config']->ACCOUNT_ID_IUGU;        
        $API_TOKEN = $GLOBALS['sistem_config']->API_TOKEN_IUGU;        
        
        $this->load->model('class/transaction_model');
        $credit_card = $this->transaction_model->get__decrypt_credit_card('client_id',$id);
        
        if($credit_card['token'])
            return array('success' => true, 'token' => $credit_card['token']);
        return array('success' => false, 'message' => "Cartão não foi tokenizado");
        
        /*
        $name = $credit_card['credit_card_name'];
        $names = explode(' ', $name);
        $lastname = $names[count($names) - 1];
        unset($names[count($names) - 1]);
        $firstname = join(' ', $names);

        $postData = array(
            'account_id' => $account_id,
            'method' => 'credit_card',
            'test' => 'true',
            'data' => array(
                'number' => $credit_card['credit_card_number'],
                'verification_value' => $credit_card['credit_card_cvv'],
                'first_name' => $firstname,
                'last_name' => "$lastname",
                'month' => $credit_card['credit_card_exp_month'],
                'year' => $credit_card['credit_card_exp_year']
            )            
        );        
        
        $postFields = http_build_query($postData);
        
        $url = "https://api.iugu.com/v1/payment_token?api_token=".$API_TOKEN;
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);  
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postFields);  
        $response = curl_exec($handler);        
        $parsed_response = json_decode($response);        
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        
        if(is_object($parsed_response) && $parsed_response->id){
            return array('success' => true, 'token' => $parsed_response->id);
        }
        else {
            return array('success' => false, 'message' => $parsed_response->errors->number[0]);
        }        
        */
    }
    
    public function do_payment_iugu($id){
        if($id !== $_SESSION['pk'])   //segurança
            return;
        //Solicita na Iugu a cobrança no cartão do cliente
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $API_TOKEN = $GLOBALS['sistem_config']->API_TOKEN_IUGU;        
        $this->load->model('class/transaction_model');
        
        $client = $this->transaction_model->get_client('id', $id)[0];
        $response_client = $this->get_client_token_iugu($id);
        if(!$response_client['success']){
            $response['success'] = false;
            if($response_client['message'])
                $response['message'] = $response_client['message'];
            else
                $response['message'] = "Erro tentando validar seu cartão. Espere uns segundos e tente novamente";
            return $response;
        }
        
        $financials = $this->calculating_enconomical_values($client["amount_solicited"]/100, $client["number_plots"], $client["tax"], $client["tac"]);
        
        $token = $response_client['token'];
        $postData = array(
            'token' => $token,
            'email' => $client['email'],
            'months' => $financials['amount_months'],
            'items' => array(
                    'description' => 'Valor da parcela',
                    'quantity' => 1,
                    'price_cents' => $financials['total_cust_value']*100
                )            
        );        
        $postFields = http_build_query($postData);
        $url = "https://api.iugu.com/v1/charge?api_token=".$API_TOKEN;
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);  
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postFields);  
        $response = curl_exec($handler);        
        $parsed_response = json_decode($response);        
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        $response = [];
        if(is_object($parsed_response) && $parsed_response->success){
            $this->transaction_model->save_generated_bill($id, $parsed_response->invoice_id);
            $response['success'] = true;
            $response['message'] = $parsed_response->message;
        }
        else {
            $error = "";
            if($parsed_response->message){
                $error = $parsed_response->message;
                if($parsed_response->LR){
                    $response['LR'] = $parsed_response->LR;
                }
            }
            else{
                if(is_object($parsed_response->errors)){
                    $array_error = (array)($parsed_response->errors);                    
                    $error_keys = array_keys($array_error);
                    $error = $error_keys[0].": ".$array_error[$error_keys[0]][0];
                }
                else
                    $error = $parsed_response->errors;
            }            
            $response['success'] = false;
            $response['message'] = "Erro no pagamento, verifique os dados fornecidos de seu cartão de crédito. Motivo: (".$error.")";
        }
        return $response;
    }

    public function refund_bill_iugu($id){
        if($_SESSION['logged_role'] !== 'ADMIN'){ //segurança
            return;            
        }
        //Para estorno do cartao
        $this->load->model('class/transaction_model');
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $API_TOKEN = $GLOBALS['sistem_config']->API_TOKEN_IUGU;
        
        $client = $this->transaction_model->get_client('id', $id)[0];
        
        $id_bill = $client['invoice_id'];
        
        $url = 'https://api.iugu.com/v1/invoices/'.$id_bill.'/refund?api_token='.$API_TOKEN;
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_POST,true);  
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        //curl_setopt($handler, CURLOPT_POSTFIELDS, $postFields);  
        $response = curl_exec($handler);        
        $parsed_response = json_decode($response);        
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        
        $response = [];
                
        if(is_object($parsed_response) && $parsed_response->status = "refunded"){            
            $response['success'] = true;
            $response['message'] = $parsed_response->status;
        }
        else {
            $response['success'] = false;
            $response['message'] = $parsed_response->errors;
        }
        
        return $response;
    }
    
    public function get_bill_iugu($id){        
        if($_SESSION['logged_role'] !== 'ADMIN'){ //segurança
            return;            
        }    
        $this->load->model('class/transaction_model');
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $API_TOKEN = $GLOBALS['sistem_config']->API_TOKEN_IUGU;
        
        $client = $this->transaction_model->get_client('id', $id)[0];
        
        $id_bill = $client['invoice_id'];
        
        $url = 'https://api.iugu.com/v1/invoices/'.$id_bill.'?api_token='.$API_TOKEN;
        
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);  
        curl_setopt($handler, CURLOPT_RETURNTRANSFER,true);  
        $response = curl_exec($handler);        
        $parsed_response = json_decode($response);        
        $info = curl_getinfo($handler);
        $string = curl_error($handler);
        curl_close($handler);
        
        $response = [];
                
        if(is_object($parsed_response) && !$parsed_response->errors){            
            $response['success'] = true;            
            $response['bill'] = $parsed_response;
        }
        else {
            $response['success'] = false;
            $response['message'] = $parsed_response->errors;
        }
        
        return $response;
    }
    
    //-------TOPAZIO API-----------------------------------------------
    public function get_topazio_API_token() {        
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $client_id = $GLOBALS['sistem_config']->CLIENT_ID_TOPAZIO;
        $client_id_and_secret_64 = $GLOBALS['sistem_config']->CLIENT_AND_SECRET_TOPAZIO_64;
        
        //Obteniendo code
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://api-topazio.sensedia.com/oauth/grant-code");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"client_id\":\"".$client_id."\",\"redirect_uri\":\"http://localhost/\"}");
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return NULL;
        }
        curl_close ($ch);
        
        $parsed_response = json_decode($result);        
        if(is_object($parsed_response) && $parsed_response->redirect_uri){
            $pos = strpos($parsed_response->redirect_uri, "code=");            
            $code = substr($parsed_response->redirect_uri, $pos+5);//obtiene code
        }
        else{
            return NULL;
        }
        
        //Obteniendo access token
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://api-topazio.sensedia.com/oauth/access-token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=authorization_code&code=".$code);
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        $headers[] = "Authorization: Basic ".$client_id_and_secret_64;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return NULL;
        }
        curl_close ($ch);
        
        $parsed_response = json_decode($result);
        $API_token = NULL;
        if(is_object($parsed_response) && $parsed_response->access_token){
            $API_token = $parsed_response->access_token; //obtiene token*/
        }
        return $API_token;
    }

    public function basicCustomerTopazio($id, $API_token){        
        if($_SESSION['logged_role'] !== 'ADMIN'){ //segurança
            return;            
        }
        $this->load->model('class/system_config');
        $this->load->model('class/transaction_model');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $client_id = $GLOBALS['sistem_config']->CLIENT_ID_TOPAZIO;
        
        $client = $this->transaction_model->get_client('id', $id)[0];
        $restricted_response = $this->topazio_is_restricted($client['cpf'], $API_token);
        if($restricted_response['success']){
            if($restricted_response['restriction']){
                $response['success'] = false;
                $response['message'] = "Cliente em lista de restrições de Topazio";
                $response['code_error'] = 2001;
                return $response;
            }               
        }
        else{
            $response['success'] = false;
            $response['message'] = $restricted_response['message'];
            $response['code_error'] = 2002;
            return $response;
        }
        
        $cpf = $client["cpf"];
        $name = $client["name"];
        $cep = (int)$client["cep"];
        $street = $client["street_address"]." ".$client["number_address"];
        $number = substr($client["complement_number_address"],0,10);
        $district = "_"; //"";
        $city = $client["city_address"];
        $state = $client["state_address"];
        $phone = $client["phone_ddd"].$client["phone_number"];
        $email = $client["email"];
        $cnpj_livre = $GLOBALS['sistem_config']->CNPJ_LIVRE;
        $name_livre = $GLOBALS['sistem_config']->NAME_LIVRE;
        
        $fields =   "{\n  \"document\": \"".$cpf
                    ."\",\n  \"nameOrCompanyName\": \"".$name
                    ."\",\n  \"billing\": \"2\",\n  \"score\": \"2\",\n  \"rating\": \"2\",\n  \"address\": {\n "
                    ."  \"postalCode\": ".$cep
                    .",\n    \"street\": \"".$street
                    ."\",\n    \"number\": \"".$number
                    ."\",\n    \"complement\": \"_\",\n    \"district\": \"".$district
                    ."\",\n    \"city\": \"".$city
                    ."\",\n    \"state\": \"".$state
                    ."\"\n  },\n  \"contact\": {\n    \"phone\": \"".$phone
                    ."\",\n    \"email\": \"".$email
                    ."\"\n  },\n  \"partners\": [\n    {\n      \"document\": \"".$cnpj_livre
                    ."\",\n      \"nameOrCompanyName\": \"".$name_livre
                    ."\",\n      \"typeLink\": \"string\",\n      \"ownershipPercentage\": 0\n    }\n  ]\n}";
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://api-topazio.sensedia.com/cli/v1/basic-customers");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = "Content-Type: application/json";
        $headers[] = "client_id: ".$client_id;
        $headers[] = "access_token: ".$API_token;
        $headers[] = "Accept: text/plain";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $num_tentativas = 0;
        while($num_tentativas < 10){
            
            $result = curl_exec($ch);
            $num_tentativas++;
            if($result != "Bad Gateway" && $result != "Gateway Timeout"){
                $num_tentativas = 10;
            }
        }
        
        curl_close ($ch);
        
        $parsed_response = json_decode($result);
        
        $result_query['success'] = false;
        if(is_object($parsed_response) && $parsed_response->success == TRUE){
            $result_query['success'] = true;
        }
        else{
            if($result == "Bad Gateway" || $result == "Gateway Timeout"){
                $result_query['message'] = "Impossivel comunicar com API de Topazio";
                $result_query['code_error'] = 2003;
            }
            else{                
                $result_query['message'] = (string)($result);//$parsed_response->errors->values[0]->error[0];
                $result_query['code_error'] = 2004;
            }
        }
        
        return $result_query;
    }
    
    public function topazio_loans($id, $API_token){
        if($_SESSION['logged_role'] !== 'ADMIN'){ //segurança
            return;
        }
        
        $this->load->model('class/system_config');
        $this->load->model('class/transaction_model');
        //$this->load->model('class/transactions_status');
        $this->load->model('class/tax_model');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $client_id = $GLOBALS['sistem_config']->CLIENT_ID_TOPAZIO;                        
        $transaction = $this->transaction_model->get_client('id', $id)[0];
        $date_contract = $this->transaction_model->get_last_date_signature($id);
        if(!$date_contract)
        {
            return ['success' => false, 'code_error' => 3001,'message' => 'Contrato ainda não passou pelo estado de esperar assinatura'];
        }
        $financials = $this->calculating_enconomical_values($transaction["amount_solicited"]/100, $transaction["number_plots"], $transaction["tax"], $transaction["tac"]);
        
        //********************************
        $num_plots = $financials["amount_months"];
        $amount_pay = $financials["solicited_value"];        
        $iof = $financials['IOF'];
        $tax = $financials['tax'];
        $tac = $financials['TAC'];
        $total_value = $financials['funded_value'];//$financials['total_cust_value'];
        $plot_value = $financials['month_value'];        
        //*********
        $cpf = $transaction["cpf"];
        $name = $transaction["name"];
        $document_id = $transaction["contract_id"];
        $tomorrow = $this->topazio_util_day($this->next_available_day($date_contract), $API_token);
        if(!$tomorrow)
        {
            return ['success' => false, 'code_error' => 3003,'message' => 'Impossivel calcular proximo dia util com API de Topazio'];
        }
        $release_date = $tomorrow["year"]."-".$tomorrow["mon"]."-".$tomorrow["mday"];
        $product_code = $GLOBALS['sistem_config']->PRODUCT_CODE_TOPAZIO;
        $cnpj_livre = $GLOBALS['sistem_config']->CNPJ_LIVRE;
        $account_type_string = ["CC" => "CC", "PP" => "CP"];
        $account_bank = $this->transaction_model->get_account_bank_by_client_id($id,0)[0];
        $bank_code = $account_bank["bank"];
        $agency = substr($account_bank["agency"], 0, 4);
        $account = $account_bank["account"].$account_bank["dig"];
        $account_type = $account_type_string[ $account_bank["account_type"] ];
        $fields = "{\n  \"client\":"
                        ." {\n    \"document\": \"".$cpf
                        ."\",\n    \"nameOrCompanyName\": \"".$name."\",\n    \"score\": 2,\n    \"rating\": \"2\",\n    \"billing\": 2\n  },\n  "
                    ."\"loans\": {\n    "
                        ."\"partnerId\": ".$document_id
                        .",\n    \"releaseDate\": \"".$release_date
                        ."\",\n    \"totalValue\": \"".$total_value
                        ."\",\n    \"amountPay\": \"".$amount_pay
                        ."\",\n    \"rate\": \"".$tax."\",\n    \"indexer\": \"\",\n    \"indexerPercentage\": 0.02"
                        .",\n    \"quotaAmount\": ".$num_plots
                        .",\n    \"iofValue\": \"".$iof."\",\n    \"wayPaymentLoan\": \"DBC\""
                        .",\n    \"productCode\": ".$product_code
                        .",\n    \"repurchaseDocument\": \"".$cnpj_livre."\",\n    \"guaranteeDescription\": \"\"".
                        ",\n    \"TAC\": \"".$tac."\",\n    "
                    ."\"payment\": {\n   "
                        ."   \"formSettlement\": \"ONL\""
                        .",\n      \"bankCode\": \"".$bank_code
                        ."\",\n      \"branch\": \"".$agency
                        ."\",\n      \"accountNumber\": \"".$account
                        ."\",\n      \"accountType\": \"".$account_type."\"\n    }"
                    .",\n    \"planQuota\": [\n      ";
                    
                    $plot_date = $this->init_date_to_pay($release_date);
                    $plot_number = 1;
                    
                    while ($plot_number <= $num_plots){                    
                        $fields .= "{\n        \"quotaValue\": \"".$plot_value."\",\n        \"quotaDueDate\": \"".$plot_date."\",\n        \"quotaNumber\": ".$plot_number."\n      }";
                        if($plot_number < $num_plots)
                            $fields .= ",\n      ";
                        else
                            $fields .= "\n    ";
                        $plot_number ++;
                        $plot_date = $this->next_month_to_pay($plot_date, $plot_number);
                    }
                    $fields .= "]\n  }\n}";

        //return;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://api-topazio.sensedia.com/emd/v1/loans");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"client\": {\n    \"document\": \"06335968762\",\n    \"nameOrCompanyName\": \"Julio Petro\",\n    \"score\": 2,\n    \"rating\": \"2\",\n    \"billing\": 2\n  },\n  \"loans\": {\n    \"partnerId\": 1000001,\n    \"releaseDate\": \"2018-08-01\",\n    \"totalValue\": \"1113.31\",\n    \"amountPay\": \"1000.00\",\n    \"rate\": \"0.0299\",\n    \"indexer\": \"\",\n    \"indexerPercentage\": 0.02,\n    \"quotaAmount\": 2,\n    \"iofValue\": \"8.80\",\n    \"wayPaymentLoan\": \"DBC\",\n    \"productCode\": 211,\n    \"repurchaseDocument\": \"30.472.737/0001-78\",\n    \"guaranteeDescription\": \"\",\n    \"TAC\": \"104.51\",\n    \"payment\": {\n      \"formSettlement\": \"ONL\",\n      \"bankCode\": \"001\",\n      \"branch\": \"4459\",\n      \"accountNumber\": \"12570-9\",\n      \"accountType\": \"CC\"\n    },\n    \"planQuota\": [\n      {\n        \"quotaValue\": \"579.64\",\n        \"quotaDueDate\": \"2018-08-02\",\n        \"quotaNumber\": 1\n      },\n      {\n        \"quotaValue\": \"579.64\",\n        \"quotaDueDate\": \"2018-09-02\",\n        \"quotaNumber\": 2\n      }\n    ]\n  }\n}");
        curl_setopt($ch, CURLOPT_POSTFIELDS,$fields);
        curl_setopt($ch, CURLOPT_POST, 1);
        $headers = array();
        $headers[] = "Content-Type: application/json";
        $headers[] = "client_id: ".$client_id;
        $headers[] = "access_token: ".$API_token;
        $headers[] = "Accept: text/plain";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);         
        //var_dump($fields); die(); //para imprimir el json de los datos sin que se ejecute el pedido al banco desde el test3
        $num_tentativas = 0;
        while($num_tentativas < 10){
            
            $result = curl_exec($ch);
            $num_tentativas++;
            if($result != "Bad Gateway" && $result != "Gateway Timeout"){
                $num_tentativas = 10;
            }
        }
        
        curl_close ($ch);
        $parsed_response = json_decode($result);
        $response_loans['success'] = false;
        if(is_object($parsed_response) && $parsed_response->success == TRUE){
            $response_loans['success'] = true;
            $response_loans['ccb'] = $parsed_response->data->CCB;
            $response_loans['contract_id'] = $document_id;
            ///echo $response_loans['ccb']." ".$response_loans['contract_id']." ".$total_value;
        }
        else{
            if($result == "Bad Gateway" || $result == "Gateway Timeout"){
                $result_query['message'] = "Impossivel comunicar com API de Topazio";
                $result_query['code_error'] = 2003;
            }
            else{
                $response_loans['message'] = $parsed_response->errors->values[0]->error[0];
                if( $response_loans['message'] == "'bankCode' is invalid." ||
                    $response_loans['message'] == "'branch' is invalid." ||                    
                    $response_loans['message'] == "'accountNumber' is invalid." ||
                    $response_loans['message'] == "'accountNumber' has invalid digit."
                    ){
                    $response_loans['code_error'] = 3002;
                }
                else{
                    $response_loans['code_error'] = 3003;
                    $response_loans['message'] = $result_query['message'] = (string)($result);
                }
            }
        }
        return $response_loans;
    }
    
    public function next_available_day($hoje = NULL){
        if(!$hoje)
            $hoje = strtotime("now");        
        $d = getdate($hoje);

        $next_day = "+1 day";    
        if($d['wday'] == 5){
            $next_day = "+3 day";
        }
        if($d['wday'] == 6){
            $next_day = "+2 day";
        }
        $amanha = strtotime($next_day, $hoje);
        $tomorrow = getdate($amanha);
        if($tomorrow["mon"] < 10)
            $tomorrow["mon"] = "0".$tomorrow["mon"];
        if($tomorrow["mday"] < 10)
            $tomorrow["mday"] = "0".$tomorrow["mday"];
        
        return $tomorrow["year"]."-".$tomorrow["mon"]."-".$tomorrow["mday"];
        //return $tomorrow;
    }
    
    public function next_month_to_pay($date, $i){
        $next_date = new DateTime($date); // Y-m-d
        if($i%2 == 0)
            $next_date->add(new DateInterval('P31D'));
        else
            $next_date->add(new DateInterval('P30D'));
        return $next_date->format('Y-m-d');
    }
    
    public function init_date_to_pay($date){
        $next_date = new DateTime($date); // Y-m-d
        $next_date->add(new DateInterval('P31D'));
        return $next_date->format('Y-m-d');
    }

    public function get_field_old($money_str){
        $money = (float)($money_str);
        if($money == 500)
            return "500";
        if($money > 500 && $money <= 1000)
            return "501_1000";
        if($money > 1000 && $money <= 1500)
            return "1001_1500";
        if($money > 1500 && $money <= 2000)
            return "1501_2000";
        if($money > 2000 && $money <= 2500)
            return "2001_2500";
        if($money > 2500 && $money <= 3000)
            return "2501_3000";
        return "2501_3000";
    }
    
    public function get_field_2($money_str){
        $money = (float)($money_str);        
        if($money >=100 && $money <= 500)
            return "100_500";        
        if($money > 500 && $money <= 1000)
            return "501_1000";        
        if($money > 1000 && $money <= 1500)
            return "1001_1500";        
        if($money > 1500 && $money <= 2000)
            return "1501_2000";        
        if($money > 2000 && $money <= 2500)
            return "2001_2500";        
        if($money > 2500 && $money <= 3000)
            return "2501_3000";        
        return "2501_3000";
    }
    
    public function get_field($money_str){
        $money = (float)($money_str);        
        if($money >=100 && $money <= 500)
            return "100_500";        
        if($money > 500 && $money <= 1000)
            return "501_1000";        
        if($money > 1000 && $money <= 2000)
            return "1001_2000";        
        if($money > 2000 && $money <= 3000)
            return "2001_3000";        
        if($money > 3000 && $money <= 4000)
            return "3001_4000";        
        if($money > 4000 && $money <= 5000)
            return "4001_5000";        
        return "4001_5000";
    }

    public function topazio_emprestimo($id) {// recebe id da transacao           
        if($_SESSION['logged_role'] !== 'ADMIN'){
            return;            
        }
        $API_token = $this->get_topazio_API_token();
        if($API_token){
            $result_basic = $this->basicCustomerTopazio($id, $API_token);            
            if($result_basic['success']){
                $response = $this->topazio_loans($id, $API_token);                
                if($response['success']){
                    $result['message'] = "Emprestimo aprovado!";
                    $result['success'] = true;            
                    $result['ccb'] = $response['ccb'];            
                    $result['contract_id'] = $response['contract_id'];            
                }
                else{
                    $result['message'] = $response['message'];
                    $result['success'] = false;            
                    $result['code_error'] = $response['code_error'];
                }
            }
            else{
                $result['message'] = $result_basic['message'];
                $result['success'] = false;            
                $result['code_error'] = $result_basic['code_error'];
            }            
        }
        else{
            $result['message'] = "Erro solicitando token de topazio";
            $result['success'] = false;
            $result['code_error'] = 1001;
        }
        
        $message = $result['message'];
        $message = implode(" ",explode("'",$message));
        $result['message'] = $message;
        return $result;
    }
    
    public function get_transaction_datas_by_id($datas=NULL){
        $this->load->model('class/affiliate_model');
        $this->load->model('class/payment_manager');
        $this->load->model('class/transaction_model');
        $this->load->model('class/Crypt');
        $_SESSION['transaction_requested_id'] = -1;
        if($_SESSION['logged_role'] === 'ADMIN'){
            $datas_by_post=false;
            if(!$datas){
                $datas = $this->input->post();
                $datas_by_post=true;
            }
            $result['message'] = 'Transação não encontrada';
            $result['success']=false;
            foreach ($_SESSION['affiliate_logged_transactions'] as $transactions){
                $aaaa=$transactions['tr_id'];
                $bbbb=$datas['id'];
                if($transactions['tr_id'] == $datas['id']){
                    //adicionar datos bancarios e do cartao
                    $account_bank = $this->transaction_model->get_account_bank_by_client_id($transactions['tr_id'],0)[0];
                    $transactions["bank"] = $account_bank["bank"];
                    $transactions["bank_name"] = $this->Crypt->get_bank_by_code($account_bank["bank"]);
                    $transactions["agency"] = $account_bank["agency"];
                    $transactions["account"] = $account_bank["account"];
                    $transactions["dig"] = $account_bank["dig"];
                    $transactions["account_type"] = $account_bank["account_type"];
                    
                    $credit_card = $this->transaction_model->get__decrypt_credit_card('client_id', $transactions['tr_id']);
                    $transactions["credit_card_name"] = $credit_card["credit_card_name"];
                    $transactions["credit_card_final"] = substr($credit_card["credit_card_number"],-4);
                    
                    //adicionar datos da transacao                    
                    $financials = $this->calculating_enconomical_values($transactions["amount_solicited"]/100, $transactions["number_plots"], $transactions["tax"], $transactions["tac"]);
                    $transactions['total_cust_value'] = $financials['total_cust_value'];                        
                    $transactions['month_value'] =$financials['month_value'];
                    $transactions['tax'] =$financials['tax'];
                    $transactions['IOF'] =$financials['IOF']; //valor a cobrar por IOF                    
                    $transactions['CET_PERC'] =$financials['CET_PERC'];
                    $transactions['CET_YEAR'] =$financials['CET_YEAR'];
                    $transactions['payment_source_str'] = "---";
                    
                    //numero de compras
                    $transactions['numb_transactions'] = $this->affiliate_model->get_client_num_transactions($transactions['cpf']);
                    if($transactions['payment_source'] == payment_manager::IUGU)
                        $transactions['payment_source_str'] = "IUGU";
                    if($transactions['payment_source'] == payment_manager::BRASPAG)
                        $transactions['payment_source_str'] = "BRASPAG";
                    //////
                    $_SESSION['transaction_requested_id'] = $transactions['tr_id'];
                    $aaa = $_SESSION['transaction_requested_id'] ;
                    $_SESSION['transaction_requested_datas'] = $transactions;
                    $result['message'] = $transactions;
                    $result['success']=true;
                    //para refrescar icono
                    $src_status = $this->affiliate_model->get_icon_by_status($transactions['status_id']);
                    $result['src_status'] = $src_status;
                    break;
                }
            }
        }
        if($datas_by_post)
            echo json_encode($result);
        else
            return $result;
    }

    public function topazio_conciliations($date=NULL){
        if($_SESSION['logged_role'] !== 'ADMIN')
        {
            echo 'Forbbiden access';
            return;
        }
        $method=NULL;
        if(!$date){
            $date =$_GET['date'];
            $method='GET';
        }
        if(!$date)
            return;
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $client_id = $GLOBALS['sistem_config']->CLIENT_ID_TOPAZIO;        
        $API_token = $this->get_topazio_API_token();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://api-topazio.sensedia.com/emd/v1/conciliations/".$date);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $headers = array();
        $headers[] = "Accept: text/plain";
        $headers[] = "client_id: ".$client_id;
        $headers[] = "access_token: ".$API_token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        /*if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }*/
        curl_close ($ch);
        $parsed_response = json_decode($result);
        if($method==='GET')
            var_dump ($parsed_response);
        else
            return $parsed_response;
    }
    
    public function topazio_conciliations_by_partnerId($partnerId){ //11537381919
        if($_SESSION['logged_role'] !== 'ADMIN')
        {
            echo 'Forbbiden access';
            return;
        }
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $client_id = $GLOBALS['sistem_config']->CLIENT_ID_TOPAZIO;        
        $API_token = $this->get_topazio_API_token();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://api-topazio.sensedia.com/emd/v1/loans/".$partnerId);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $headers = array();
        $headers[] = "Accept: text/plain";
        $headers[] = "client_id: ".$client_id;
        $headers[] = "access_token: ".$API_token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        /*if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }*/
        curl_close ($ch);
        $parsed_response = json_decode($result);
        return $parsed_response;
    }
    
    public function topazio_util_day($date, $token = NULL){
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $client_id = $GLOBALS['sistem_config']->CLIENT_ID_TOPAZIO;        
        if($token)
            $API_token = $token;
        else
            $API_token = $this->get_topazio_API_token();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://api-topazio.sensedia.com/wd/v1/workdays/".$date);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $headers = array();
        $headers[] = "Accept: text/plain";
        $headers[] = "client_id: ".$client_id;
        $headers[] = "access_token: ".$API_token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $num_tentativas = 0;
        while($num_tentativas < 10){
            
            $result = curl_exec($ch);
            $num_tentativas++;
            if($result != "Bad Gateway" && $result != "Gateway Timeout"){
                $num_tentativas = 10;
            }
        }
        /*if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }*/
        curl_close ($ch);
        $parsed_response = json_decode($result);
        
        if($parsed_response->success){
            $next_day = $parsed_response->nextWorkday;
            $temp = explode("-", $next_day);
            $tomorrow = array('year' => $temp[0],'mon' => $temp[1],'mday' => $temp[2]);
            return $tomorrow;
        }
        return NULL;
    }
    
    public function topazio_is_restricted($document, $token = NULL){
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $client_id = $GLOBALS['sistem_config']->CLIENT_ID_TOPAZIO;        
        if($token)
            $API_token = $token;
        else
            $API_token = $this->get_topazio_API_token();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://api-topazio.sensedia.com/chk/v1/restrictions/".$document);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $headers = array();
        $headers[] = "Accept: text/plain";
        $headers[] = "client_id: ".$client_id;
        $headers[] = "access_token: ".$API_token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $num_tentativas = 0;
        while($num_tentativas < 10){
            
            $result = curl_exec($ch);
            $num_tentativas++;
            if($result != "Bad Gateway" && $result != "Gateway Timeout"){
                $num_tentativas = 10;
            }
        }
        /*if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }*/
        curl_close ($ch);
        $parsed_response = json_decode($result);
        
        $result_api['success'] = false;
        if($parsed_response->success){
            $result_api['success'] = true;
            $result_api['restriction'] = $parsed_response->restriction;            
            return $result_api;
        }
        else{
            if($parsed_response)
                $result_api['message'] = $parsed_response->error->errors[0];
            else
                $result_api['message'] = $result;
        }
        return $result_api;
    }
    
    //-------API D4Sign-----------------------------------------------
    public function get_safes_D4Sign(){
        //obtener lista de cofres
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $token_4sign = $GLOBALS['sistem_config']->TOKEN_API_D4SIGN;        
        $crypt_4sign = $GLOBALS['sistem_config']->CRYPT_D4SIGN;        
        
        require_once($_SERVER['DOCUMENT_ROOT'] . '/livre/application/libraries/d4sign-php-master/sdk/vendor/autoload.php');
        
        try{
                $client = new D4sign\Client();
                $client->setAccessToken($token_4sign);
                $client->setCryptKey($crypt_4sign);

                $safes = $client->safes->find();
                
        } catch (Exception $e) {
                //echo $e->getMessage();
                return $null;
        } 
        return $safes;
    }
    
    public function get_documents_D4Sign(){
        //obtener lista de documentos
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $token_4sign = $GLOBALS['sistem_config']->TOKEN_API_D4SIGN;        
        $crypt_4sign = $GLOBALS['sistem_config']->CRYPT_D4SIGN;                
        
        require_once($_SERVER['DOCUMENT_ROOT'] . '/livre/application/libraries/d4sign-php-master/sdk/vendor/autoload.php');
        
        try{
                $client = new D4sign\Client();
                $client->setAccessToken($token_4sign);
                $client->setCryptKey($crypt_4sign);

                $docs = $client->documents->find();

        } catch (Exception $e) {
                //echo $e->getMessage();
                return null;
        } 
        return $docs;
    }
    
    public function get_document_D4Sign($id){
        //obtener um documento em particular
        $this->load->model('class/system_config');
        $this->load->model('class/transaction_model');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $token_4sign = $GLOBALS['sistem_config']->TOKEN_API_D4SIGN;        
        $crypt_4sign = $GLOBALS['sistem_config']->CRYPT_D4SIGN;        
        
        $transaction = $this->transaction_model->get_client('id', $id)[0];
        
        require_once($_SERVER['DOCUMENT_ROOT'] . '/livre/application/libraries/d4sign-php-master/sdk/vendor/autoload.php');
        
        try{
                $client = new D4sign\Client();
                $client->setAccessToken($token_4sign);
                $client->setCryptKey($crypt_4sign);

                $docs = $client->documents->find($transaction['doc_d4sign']);

        } catch (Exception $e) {
                //echo $e->getMessage();
                return $e->getMessage();;
        } 
        return $docs;
    }
    
    public function upload_document_D4Sign($id){
        //subir um documento (no la vamos usar)
        $this->load->model('class/system_config');
        $this->load->model('class/transaction_model');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $token_4sign = $GLOBALS['sistem_config']->TOKEN_API_D4SIGN;        
        $crypt_4sign = $GLOBALS['sistem_config']->CRYPT_D4SIGN;        
        $safe_livre_4sign = $GLOBALS['sistem_config']->SAFE_LIVRE_D4SIGN;                
        
        require_once($_SERVER['DOCUMENT_ROOT'] . '/livre/application/libraries/d4sign-php-master/sdk/vendor/autoload.php');
        
        $transaction = $this->transaction_model->get_client('id', $id)[0];
        
        try{
                $client = new D4sign\Client();
                $client->setAccessToken($token_4sign);
                $client->setCryptKey($crypt_4sign);

                $path_file = $_SERVER['DOCUMENT_ROOT'].'/livre/assets/data_users/'.$transaction['folder_in_server'].'/cpf_card.png';//contract.pdf
                $id_doc = $client->documents->upload($safe_livre_4sign, $path_file);
                if(is_object($id_doc) && $id_doc->message == "success")                    
                    $this->transaction_model->save_in_db(
                            'transactions',
                            'id',$id,
                            'doc_d4sign',$id_doc->uuid);
        } catch (Exception $e) {
                //echo $e->getMessage();
                return null;
        } 
    }
    
    public function signer_for_doc_D4Sign($id, $act = '1', $foreign = 0, $certificadoicpbr = 0, $assinatura_presencial = 0, $embed_methodauth = 'email'){
        //asignar um signatario a um documento
        $this->load->model('class/system_config');
        $this->load->model('class/transaction_model');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $token_4sign = $GLOBALS['sistem_config']->TOKEN_API_D4SIGN;        
        $crypt_4sign = $GLOBALS['sistem_config']->CRYPT_D4SIGN;        
        
        $transaction = $this->transaction_model->get_client('id', $id)[0];
        
        require_once($_SERVER['DOCUMENT_ROOT'] . '/livre/application/libraries/d4sign-php-master/sdk/vendor/autoload.php');
        
        try{
                $client = new D4sign\Client();
                $client->setAccessToken($token_4sign);
                $client->setCryptKey($crypt_4sign);

                $signers = array(
                    array(  "email" => $transaction['email'],
                            "act" => $act,
                            "foreign" => $foreign,
                            "certificadoicpbr" => $certificadoicpbr,
                            "assinatura_presencial" => $assinatura_presencial,
                            "embed_methodauth" => $embed_methodauth,
                            "embed_smsnumber" => '',
                            "docauth" => '0'
                        )
                );
                $result = $client->documents->createList($transaction['doc_d4sign'], $signers);
                
                $id_signer = 0;
                if(is_object($result) && $result->message[0]->success)                    
                {   $this->transaction_model->save_in_db(
                            'transactions',
                            'id',$id,
                            'key_signer',$result->message[0]->key_signer);
                    $id_signer = $result->message[0]->key_signer;
                    /*$email = $transaction['email'];
                    $display_name = $transaction['name'];
                    $documentation = $transaction['cpf'];
                    $birthday = '01/01/1970';
                    $key_signer = $result->message[0]->key_signer;

                    $add = $client->documents->addinfo($transaction['doc_d4sign'], $email, $display_name, $documentation, $birthday, $key_signer);                
                     */                    
                }
        } catch (Exception $e) {
                //echo $e->getMessage();
                return null;
        } 
        return $id_signer;
    }
    
    public function send_for_sign_document_D4Sign($id){
        //enviar para assinar um documento
        $this->load->model('class/system_config');
        $this->load->model('class/transaction_model');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $token_4sign = $GLOBALS['sistem_config']->TOKEN_API_D4SIGN;        
        $crypt_4sign = $GLOBALS['sistem_config']->CRYPT_D4SIGN;        
        
        $transaction = $this->transaction_model->get_client('id', $id)[0];
        
        require_once($_SERVER['DOCUMENT_ROOT'] . '/livre/application/libraries/d4sign-php-master/sdk/vendor/autoload.php');
        
        try{
                $client = new D4sign\Client();
                $client->setAccessToken($token_4sign);
                $client->setCryptKey($crypt_4sign);
                
                $message = 'Prezado '.$transaction['name'].', segue o contrato eletrônico para assinatura.';
                $workflow = 0 ; //Todos podem assinar ao mesmo tempo
                $skip_email = 0; //Não disparar email com link de assinatura (usando EMBED)
                
                $docs = $client->documents->sendToSigner($transaction['doc_d4sign'], $message, $workflow, $skip_email);

        } catch (Exception $e) {
                //echo $e->getMessage();
                return null;
        } 
        return $docs;
    }
    
    public function resend_for_sign_document_D4Sign($id){
        //re-enviar para assinar um documento
        $this->load->model('class/system_config');
        $this->load->model('class/transaction_model');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $token_4sign = $GLOBALS['sistem_config']->TOKEN_API_D4SIGN;        
        $crypt_4sign = $GLOBALS['sistem_config']->CRYPT_D4SIGN;        
        
        $transaction = $this->transaction_model->get_client('id', $id)[0];
        
        require_once($_SERVER['DOCUMENT_ROOT'] . '/livre/application/libraries/d4sign-php-master/sdk/vendor/autoload.php');
        
        try{
                $client = new D4sign\Client();
                $client->setAccessToken($token_4sign);
                $client->setCryptKey($crypt_4sign);
                
                $email = $transaction['email'];
                $key_signer = $transaction['key_signer'];
                
                $docs = $client->documents->resend($transaction['doc_d4sign'], $email, $key_signer);
	
        } catch (Exception $e) {
                //echo $e->getMessage();
                return null;
        } 
        return $docs;
    }
    
    public function cancel_document_D4Sign($id){
        //cancelar um documento (não cancela documentos finalizado)
        $this->load->model('class/system_config');
        $this->load->model('class/transaction_model');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $token_4sign = $GLOBALS['sistem_config']->TOKEN_API_D4SIGN;        
        $crypt_4sign = $GLOBALS['sistem_config']->CRYPT_D4SIGN;        
        
        $transaction = $this->transaction_model->get_client('id', $id)[0];
        
        require_once($_SERVER['DOCUMENT_ROOT'] . '/livre/application/libraries/d4sign-php-master/sdk/vendor/autoload.php');
        
        try{
                $client = new D4sign\Client();
                $client->setAccessToken($token_4sign);
                $client->setCryptKey($crypt_4sign);
                
                $docs = $client->documents->cancel($transaction['doc_d4sign']);
	
        } catch (Exception $e) {
                //echo $e->getMessage();
                return null;
        } 
        return $docs;
    }
    
    public function upload_document_template_D4Sign($id){
        //crear e subir um documento a partir do template da Livre
        $this->load->model('class/system_config');
        $this->load->model('class/transaction_model');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $token_4sign = $GLOBALS['sistem_config']->TOKEN_API_D4SIGN;        
        $crypt_4sign = $GLOBALS['sistem_config']->CRYPT_D4SIGN;        
        
        $document_id = 10000000000 + time();
        $this->transaction_model->save_in_db(
                        'transactions',
                        'id',$id,
                        'contract_id',$document_id);                
        
        $transaction = $this->transaction_model->get_client('id', $id)[0];
        
        $financials = $this->calculating_enconomical_values($transaction["amount_solicited"]/100, $transaction["number_plots"], $transaction["tax"], $transaction["tac"]);
        
        $address = $transaction['street_address']." ".$transaction['number_address'].", ".$transaction['city_address'].", ".$transaction['state_address'];
        $tomorrow = $this->topazio_util_day($this->next_available_day());
        if(!$tomorrow)
        {
            return null;//['success' => false, 'message' => 'Impossivel gerar o documento neste momento devido a problemas de comunicação com o banco'];
        }
        $mes = ['Janeiro', 'Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];        
        
        $plot_resume = [[" "," "," "], [" "," "," "], [" "," "," "], [" "," "," "], [" "," "," "], [" "," "," "], [" "," "," "], [" "," "," "], [" "," "," "], [" "," "," "], [" "," "," "], [" "," "," "]];
        $num_plots = $transaction['number_plots'];
        
        $plot_date = $this->init_date_to_pay( $tomorrow["year"]."-".$tomorrow["mon"]."-".$tomorrow["mday"] );
        $plot_date2 = date("d/m/Y", strtotime($plot_date));
        $plot_number = 1;

        while ($plot_number <= $num_plots){                    
            $plot_resume[$plot_number - 1] = [$plot_number, $plot_date2, $financials['month_value']];           
            $plot_number ++;            
            $plot_date = $this->next_month_to_pay($plot_date, $plot_number);
            $plot_date2 = date("d/m/Y", strtotime($plot_date));
        }
        
        require_once($_SERVER['DOCUMENT_ROOT'] . '/livre/application/libraries/d4sign-php-master/sdk/vendor/autoload.php');
        
        try{
                $client = new D4sign\Client();
                $client->setAccessToken($token_4sign);
                $client->setCryptKey($crypt_4sign);
                
                $id_template = $GLOBALS['sistem_config']->TEMPLATE_D4SIGN;                
                $templates = array(
			$id_template => array(
					'ccb_loans' => $transaction['contract_id'],
					'name' => $transaction['name'],
					'cpf' => $transaction['cpf'],
					'address' => $address,
					'release_date' => $tomorrow["mday"]."/".$tomorrow["mon"]."/".$tomorrow["year"],
					'main_value' => $financials['funded_value'],
                                        'solicited_value' => $financials['solicited_value'],
                                        'tax' => $financials['tax'],
                                        'CET_YEAR' => $financials['CET_YEAR'],
                                        'tax_value' => $financials['tax_value'],
                                        'period' => "mensal",
                                        'TAC' => $financials['TAC'],
                                        'IOF' => $financials['IOF'],
                                        'total_cust_value' => $financials['funded_value'],//$financials['total_cust_value'],
                                        'CET_PERC' => $financials['CET_PERC'],
                                        'release_day' => $tomorrow["mday"],
                                        'release_string_month' => $mes[ $tomorrow["mon"]-1 ],
                                        'release_year' => $tomorrow["year"],
					//'full_name' => $transaction['name'],
					'ccb_loans2' => $transaction['contract_id'],
					'name2' => $transaction['name'],
					'cpf2' => $transaction['cpf'],
                                        'address2' => $address,
                                        'plot_1' => $plot_resume[0][0],
                                        'date_1' => $plot_resume[0][1],
                                        'month_value_1' => $plot_resume[0][2],
                                        'plot_2' => $plot_resume[1][0],
                                        'date_2' => $plot_resume[1][1],
                                        'month_value_2' => $plot_resume[1][2],
                                        'plot_3' => $plot_resume[2][0],
                                        'date_3' => $plot_resume[2][1],
                                        'month_value_3' => $plot_resume[2][2],
                                        'plot_4' => $plot_resume[3][0],
                                        'date_4' => $plot_resume[3][1],
                                        'month_value_4' => $plot_resume[3][2],
                                        'plot_5' => $plot_resume[4][0],
                                        'date_5' => $plot_resume[4][1],
                                        'month_value_5' => $plot_resume[4][2],
                                        'plot_6' => $plot_resume[5][0],
                                        'date_6' => $plot_resume[5][1],
                                        'month_value_6' => $plot_resume[5][2],
                                        'plot_7' => $plot_resume[6][0],
                                        'date_7' => $plot_resume[6][1],
                                        'month_value_7' => $plot_resume[6][2],
                                        'plot_8' => $plot_resume[7][0],
                                        'date_8' => $plot_resume[7][1],
                                        'month_value_8' => $plot_resume[7][2],
                                        'plot_9' => $plot_resume[8][0],
                                        'date_9' => $plot_resume[8][1],
                                        'month_value_9' => $plot_resume[8][2],
                                        'plot_10' => $plot_resume[9][0],
                                        'date_10' => $plot_resume[9][1],
                                        'month_value_10' => $plot_resume[9][2],
                                        'plot_11' => $plot_resume[10][0],
                                        'date_11' => $plot_resume[10][1],
                                        'month_value_11' => $plot_resume[10][2],
                                        'plot_12' => $plot_resume[11][0],
                                        'date_12' => $plot_resume[11][1],
                                        'month_value_12' => $plot_resume[11][2],
                                        'sum_month_value' => $financials['total_cust_value'],
                                        'release_day2' => $tomorrow["mday"],
                                        'release_string_month2' => $mes[ $tomorrow["mon"]-1 ],
                                        'release_year2' => $tomorrow["year"]//,
					//'full_name2' => $transaction['name']
					)
			);							
	
                $name_document = "Contrato_".time();
                $uuid_cofre = $GLOBALS['sistem_config']->SAFE_LIVRE_D4SIGN;                

                $return = $client->documents->makedocumentbytemplate($uuid_cofre, $name_document, $templates);
                
                $uuid_doc = 0;
                if(is_object($return) && $return->uuid != ""){
                    $this->transaction_model->save_in_db(
                            'transactions',
                            'id',$id,
                            'doc_d4sign',$return->uuid);
                
                    $uuid_doc = $return->uuid;
                }
	
        } catch (Exception $e) {
                //echo $e->getMessage();
                return null;
        }
        return $uuid_doc;
    }
    
    public function download_document_D4Sign($id){
        //devolver url do documento para descarregar depois
        if($_SESSION['logged_role'] !== 'ADMIN')
            return NULL;
        $this->load->model('class/system_config');
        $this->load->model('class/transaction_model');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $token_4sign = $GLOBALS['sistem_config']->TOKEN_API_D4SIGN;        
        $crypt_4sign = $GLOBALS['sistem_config']->CRYPT_D4SIGN;        
        $transaction = $this->transaction_model->get_client('id', $id)[0];
        require_once($_SERVER['DOCUMENT_ROOT'] . '/livre/application/libraries/d4sign-php-master/sdk/vendor/autoload.php');
        $result['success'] = false;
        try{
            $client = new D4sign\Client();
            $client->setAccessToken($token_4sign);
            $client->setCryptKey($crypt_4sign);
            $url_doc = $client->documents->getfileurl($transaction['doc_d4sign'],'pdf');
            if($url_doc){
                $result['message'] = $url_doc->url;
                $result['success'] = true;
            } else {
                $result['message'] = "Documento não existe";
            }
        } catch (Exception $e) {
            $result['message'] = $e->getMessage();            
        } 
        return $result;
    }
    //-------End API D4Sign-----------------------------------------------

    /*-------Calculating economical values-----------------------------------------------
     * Usando excel proporcionado por Pedro 
     * B1: valor solicitado por cliente
     * B2: numero de parcelas
     * B3: taxa de juros
     * B7: valor financiado pelo cliente
     * C1: IOF
     * C5: TAC
     * F10: CET
     * F9: valor da parcela  
     * J10: CET%  
     * J11: CET anual
     * F16: JUROS 
    */

    public function calculating_enconomical_values2($valor_solicitado, $num_parcelas) {
        $this->load->model('class/tax_model');
        $B1 = number_format($valor_solicitado, 2, '.', '');
        $B2 = $num_parcelas;
        $B3 = ( $this->tax_model->get_tax_row($B2)[$this->get_field($B1)] )/100;
        $num_days = 30*($num_parcelas-1) + 10;
        $C4 = number_format( ((0.000082 * $num_days)+0.0038) * $B1, 2, '.', '');
        $C5 = number_format(0.1*($B1+$C4), 2, '.', '');
        $B7 = number_format($B1 + $C4 +$C5, 2, '.', ''); 
        $F9 = number_format($B7 * pow(1+$B3, $B2)*$B3/(pow(1+$B3, $B2)-1), 2, '.', '');
        $F10 = number_format($F9*$B2, 2, '.', '');
        $F16 = number_format($F10-$B7, 2, '.', '');
        $J10 = number_format( 100*($F10-$B1)/$B1, 2, '.', ''); 
        $J11 = number_format( (12*$J10)/$B2, 2, '.', ''); 
        
        $B3 = number_format( $B3*100, 2, '.', ''); 
                
        $result = array(
            'solicited_value' => $B1,                                
            'amount_months' => $B2,
            'tax' => $B3, //juros
            'month_value' => $F9,
            'total_cust_value' => $F10,
            'funded_value' => $B7,
            'IOF' => $C4,
            'TAC' => $C5,
            'CET_PERC' => $J10,
            'CET_YEAR' => $J11,                            
            'tax_value' => $F16,
            'TAC_API' => number_format($F16 + $C5 , 2, '.', '') 
            );
        return $result;
    }
    
    public function robot_conciliation() {
        $this->load->model('class/affiliate_model');
        $this->load->model('class/system_config');
        $this->load->model('class/transactions_status');
        require_once ($_SERVER['DOCUMENT_ROOT']."/livre/application/libraries/Gmail.php");
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $this->Gmail = new Gmail();
        $_SESSION['logged_role'] = 'ADMIN';
        $_SESSION['robot'] = true;
//        $_SESSION['ip'] = $this->getUserIP();
//        $_SESSION['logged_id'] = -1;
        
        $date = date("Y-m-d",time());
        echo "<br>\n<br>\n----------  INIT CONCILIATION AT ".date('Y-m-d H:i:s',time());
        $transactions = $this->topazio_conciliations($date);
        echo "<br>\n Number of loans: ".count($transactions->data);
        echo "<br>\n----------------------------------------------<br>\n";
        if($transactions->success){
            foreach ($transactions->data as $transaction) {
                if($transaction->ccbNumber){
                    $livre_tr = $this->affiliate_model->load_transaction_by_ccbNumber($transaction->ccbNumber);
                    if($livre_tr['status_id'] == transactions_status::TOPAZIO_IN_ANALISYS){
                        switch ($transaction->statusCode) {
                            case 2000: //TOPAZIO - "EM PROCESSAMENTO"
                                /* não devemos fazer nada, porque esa transacción ya esta en el status de livre TOPAZIO_IN_ANALISYS*/
                                echo "<br>\nID: ".$livre_tr['client_id'];
                                echo "<br>\nCLIENTE: ".$livre_tr['name'];
                                echo "<br>\nEMAIL: ".$livre_tr['email'];
                                echo "<br>\n<br>\nEM PROCESSAMENTO: ccb - ".$transaction->ccbNumber;
                                break;
                             case 2400: //TOPAZIO - "AGUARDANDO FUNDING"
                                /* não devemos fazer nada, até esperar que a transação mude para outro status*/
                                echo "<br>\nID: ".$livre_tr['client_id'];
                                echo "<br>\nCLIENTE: ".$livre_tr['name'];
                                echo "<br>\nEMAIL: ".$livre_tr['email'];
                                echo "<br>\n<br>\nAGUARDANDO FUNDING: ccb - ".$transaction->ccbNumber;
                                break;
                            case 2100: //TOPAZIO - "CANCELADA"
                                //1. enviar para PENDING
                                $this->load->model('class/transactions_status');
                                $this->load->model('class/transaction_model');
                                $this->transaction_model->update_transaction_status(
                                    $livre_tr['client_id'],
                                    transactions_status::PENDING);
                                
                                /*registrar accion
                                $this->load->model('class/watchdog');
                                $this->load->model('class/watchdog_type');

                                $register = ['user_id' => $_SESSION['logged_id'], 'type' => Watchdog_type::SET_PENDING, 'date' => time(), 'ip' => $_SESSION['ip'], 'data' => $livre_tr['client_id']];
                                $this->watchdog->add_watchdog($register);*/
                                
                                echo "<br>\nID: ".$livre_tr['client_id'];
                                echo "<br>\nCLIENTE: ".$livre_tr['name'];
                                echo "<br>\nEMAIL: ".$livre_tr['email'];
                                echo "<br>\n<br>\nCANCELADA 2100: ccb - ".$transaction->ccbNumber;
                                echo "<br>\n<br>\nREASON: ".$transaction->reason;
                                break;
                            case 2300: //TOPAZIO - "CANCELADA / DEVOLUCAO DE PAGAMENTO"
                                //1. pedir nova conta                                
                                $account_bank_reasonCodes = array(
                                    1 /*Conta Destinatária do Crédito Encerrada*/,
                                    2 /*Agência ou Conta Destinatária do Crédito Inválida*/,
                                    3 /*Ausência ou Divergência na Indicação do CPF/CNPJ*/,
                                    5 /*Divergência na Titularidade*/
                                );
                                if(in_array($transaction->reasonCode,$account_bank_reasonCodes)){
                                    $_SESSION['transaction_requested_datas']['name']=$livre_tr['name'];
                                    $_SESSION['transaction_requested_datas']['email']=$livre_tr['email'];
                                    $_SESSION['transaction_requested_id']=$livre_tr['client_id'];
                                    if($this->request_new_account()){
                                        echo "<br>\nID: ".$livre_tr['client_id'];
                                        echo "<br>\nCLIENTE: ".$livre_tr['name'];
                                        echo "<br>\nEMAIL: ".$livre_tr['email'];
                                        echo "<br>\n<br>\nCANCELADA 2300: ccb - ".$transaction->ccbNumber;
                                        echo "<br>\n<br>\nREASON: ".$transaction->reason;
                                        echo "<br>\n<br>\nNova conta pedida automaticamente com sucesso";
                                    }
                                } else{
                                    echo "<br>\nID: ".$livre_tr['client_id'];
                                    echo "<br>\nCLIENTE: ".$livre_tr['name'];
                                    echo "<br>\nEMAIL: ".$livre_tr['email'];
                                    echo "<br>\n<br>\nCANCELADA 2300: ccb - ".$transaction->ccbNumber;
                                    echo "<br>\n<br>\nNEW REASON CODE TO 2300 ERROR";
                                }
                                break;
                            case 2500: //TOPAZIO - "PAGA CONFIRMADA"
                                //TODO: email com dinheiro enviado
                                echo "<br>\nID: ".$livre_tr['client_id'];
                                echo "<br>\nCLIENTE: ".$livre_tr['name'];
                                echo "<br>\nEMAIL: ".$livre_tr['email'];
                                echo "<br>\n<br>\nPAGA CONFIRMADA: ccb - ".$transaction->ccbNumber;
                                break;
                        }
                    }
                }
            }
        }else{
            /*$administrators_emails = array("josergm86@gmail.com","jorge85.mail@gmail.com","pedro@livre.digital");
            foreach ($administrators_emails as $useremail) {
                $this->Gmail->send_mail($useremail, $useremail, 'Impossivel fazer conciliação com Topazio', "Impossivel fazer conciliação com Topazio devido a que a requicisao de esta respondendo success = false");
            }*/
        }
        echo "<br>\n<br>\n----------  END CONCILIATION AT ".date('Y-m-d H:i:s',time());
    }
    
    /*Vamos resolver con dos funciones separadas*/
    public function robot_conciliation2() {
        $this->load->model('class/affiliate_model');
        $this->load->model('class/system_config');
        $this->load->model('class/transactions_status');
        require_once ($_SERVER['DOCUMENT_ROOT']."/livre/application/libraries/Gmail.php");
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $this->Gmail = new Gmail();
        $_SESSION['logged_role'] = 'ADMIN';
        $_SESSION['robot'] = true;
//        $_SESSION['ip'] = $this->getUserIP();
//        $_SESSION['logged_id'] = -1;
        
        $date = date("Y-m-d",time());
        echo "<br>\n<br>\n----------  INIT CONCILIATION AT ".date('Y-m-d H:i:s',time());
        $transactions = $this->topazio_conciliations($date);
        echo "<br>\n Number of loans: ".count($transactions->data);
        echo "<br>\n----------------------------------------------<br>\n";
        if($transactions->success){
            foreach ($transactions->data as $transaction) {
                if($transaction->ccbNumber){
                    $livre_tr = $this->affiliate_model->load_transaction_by_ccbNumber($transaction->ccbNumber);
                    if($livre_tr['status_id'] == transactions_status::TOPAZIO_IN_ANALISYS){
                        switch ($transaction->statusCode) {
                            case 2000: //TOPAZIO - "EM PROCESSAMENTO"
                                /* não devemos fazer nada, porque esa transacción ya esta en el status de livre TOPAZIO_IN_ANALISYS*/
                                echo "<br>\nID: ".$livre_tr['client_id'];
                                echo "<br>\nCLIENTE: ".$livre_tr['name'];
                                echo "<br>\nEMAIL: ".$livre_tr['email'];
                                echo "<br>\n<br>\nEM PROCESSAMENTO: ccb - ".$transaction->ccbNumber;
                                echo "<br>\n----------------------------------------------<br>\n";
                                break;
                             case 2400: //TOPAZIO - "AGUARDANDO FUNDING"
                                /* não devemos fazer nada, até esperar que a transação mude para outro status*/
                                echo "<br>\nID: ".$livre_tr['client_id'];
                                echo "<br>\nCLIENTE: ".$livre_tr['name'];
                                echo "<br>\nEMAIL: ".$livre_tr['email'];
                                echo "<br>\n<br>\nAGUARDANDO FUNDING: ccb - ".$transaction->ccbNumber;
                                echo "<br>\n----------------------------------------------<br>\n";
                                break;
                            case 2100: //TOPAZIO - "CANCELADA"
                                //1. enviar para PENDING
                                $this->load->model('class/transactions_status');
                                $this->load->model('class/transaction_model');
                                $this->transaction_model->update_transaction_status(
                                    $livre_tr['client_id'],
                                    transactions_status::PENDING);
                                
                                /*registrar accion
                                $this->load->model('class/watchdog');
                                $this->load->model('class/watchdog_type');

                                $register = ['user_id' => $_SESSION['logged_id'], 'type' => Watchdog_type::SET_PENDING, 'date' => time(), 'ip' => $_SESSION['ip'], 'data' => $livre_tr['client_id']];
                                $this->watchdog->add_watchdog($register);*/
                                
                                echo "<br>\nID: ".$livre_tr['client_id'];
                                echo "<br>\nCLIENTE: ".$livre_tr['name'];
                                echo "<br>\nEMAIL: ".$livre_tr['email'];
                                echo "<br>\nCANCELADA 2100: ccb - ".$transaction->ccbNumber;
                                echo "<br>\nREASON: ".$transaction->reason;
                                echo "<br>\n----------------------------------------------<br>\n";
                                break;
                            case 2300: //TOPAZIO - "CANCELADA / DEVOLUCAO DE PAGAMENTO"
                                //1. pedir nova conta                                
                                $account_bank_reasonCodes = array(
                                    1 /*Conta Destinatária do Crédito Encerrada*/,
                                    2 /*Agência ou Conta Destinatária do Crédito Inválida*/,
                                    3 /*Ausência ou Divergência na Indicação do CPF/CNPJ*/,
                                    5 /*Divergência na Titularidade*/
                                );
                                if(in_array($transaction->reasonCode,$account_bank_reasonCodes)){
                                    $_SESSION['transaction_requested_datas']['name']=$livre_tr['name'];
                                    $_SESSION['transaction_requested_datas']['email']=$livre_tr['email'];
                                    $_SESSION['transaction_requested_id']=$livre_tr['client_id'];
                                    if($this->request_new_account()){
                                        echo "<br>\nID: ".$livre_tr['client_id'];
                                        echo "<br>\nCLIENTE: ".$livre_tr['name'];
                                        echo "<br>\nEMAIL: ".$livre_tr['email'];
                                        echo "<br>\nCANCELADA 2300: ccb - ".$transaction->ccbNumber;
                                        echo "<br>\nREASON: ".$transaction->reason;
                                        echo "<br>\nNova conta pedida automaticamente com sucesso";
                                        echo "<br>\n----------------------------------------------<br>\n";
                                    }
                                } else{
                                    echo "<br>\nID: ".$livre_tr['client_id'];
                                    echo "<br>\nCLIENTE: ".$livre_tr['name'];
                                    echo "<br>\nEMAIL: ".$livre_tr['email'];
                                    echo "<br>\nCANCELADA 2300: ccb - ".$transaction->ccbNumber;
                                    echo "<br>\nNEW REASON CODE TO 2300 ERROR";
                                    echo "<br>\n----------------------------------------------<br>\n";
                                }
                                break;
                            case 2500: //TOPAZIO - "PAGA CONFIRMADA"
                                //TODO: email com dinheiro enviado
                                //1. enviar para TOPAZIO_APROVED
                                $this->load->model('class/transactions_status');
                                $this->load->model('class/transaction_model');
                                $this->transaction_model->update_transaction_status(
                                    $livre_tr['client_id'],
                                    transactions_status::TOPAZIO_APROVED);
                                
                                /*registrar accion
                                $this->load->model('class/watchdog');
                                $this->load->model('class/watchdog_type');

                                $register = ['user_id' => $_SESSION['logged_id'], 'type' => Watchdog_type::ENDING, 'date' => time(), 'ip' => $_SESSION['ip'], 'data' => $livre_tr['client_id']];
                                $this->watchdog->add_watchdog($register);*/
                                
                                $name = explode(' ', $livre_tr['name']); $name = $name[0];                
                                $this->Gmail = new Gmail();
                                $this->Gmail->credor_ccb($name, $livre_tr['email'], $livre_tr['ccb_number']);
                                echo "<br>\nID: ".$livre_tr['client_id'];
                                echo "<br>\nCLIENTE: ".$livre_tr['name'];
                                echo "<br>\nEMAIL: ".$livre_tr['email'];
                                echo "<br>\nPAGA CONFIRMADA: ccb - ".$transaction->ccbNumber;
                                echo "<br>\n----------------------------------------------<br>\n";
                                break;
                        }
                    }
                }
            }
        }else{
            /*$administrators_emails = array("josergm86@gmail.com","jorge85.mail@gmail.com","pedro@livre.digital");
            foreach ($administrators_emails as $useremail) {
                $this->Gmail->send_mail($useremail, $useremail, 'Impossivel fazer conciliação com Topazio', "Impossivel fazer conciliação com Topazio devido a que a requicisao de esta respondendo success = false");
            }*/
        }
        echo "<br>\n<br>\n----------  END CONCILIATION AT ".date('Y-m-d H:i:s',time());
    }
    /* 
        Status dos documentos na D4Sign
        ID 1 - Processando
        ID 2 - Aguardando Signatários
        ID 3 - Aguardando Assinaturas
        ID 4 - Finalizado
        ID 5 - Arquivado
        ID 6 - Cancelado
     */
    public function robot_checking_contracts() {
        $this->load->model('class/affiliate_model');
        $this->load->model('class/transaction_model');
        $this->load->model('class/transactions_status');
        $this->load->model('class/system_config');        
        require_once ($_SERVER['DOCUMENT_ROOT']."/livre/application/libraries/Gmail.php");
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $this->Gmail = new Gmail();
        $_SESSION['logged_role'] = 'ADMIN';
//        $_SESSION['ip'] = $this->getUserIP();
//        $_SESSION['logged_id'] = -1;
        
        $date = date("Y-m-d",time());
        echo "<br>\n<br>\n----------  INIT CHEKING CONTRACTS AT ".date('Y-m-d H:i:s',time());
       
        do{
            //transactions waiting signature
            $transactions = $this->transaction_model->get_client('status_id', transactions_status::WAIT_SIGNATURE);

            foreach ($transactions as $transaction) {
                $signature_status = $this->get_document_D4Sign($transaction['id']);    
                if($signature_status[0]->statusId == 4){
                   //documento assinado                
                    $this->transaction_model->update_transaction_status(
                        $transaction['id'],
                        transactions_status::PENDING);
                    echo "<br>\n<br>\nContrato assinado por ".$transaction['email']." às ".date('Y-m-d H:i:s',time());
                    //send e-mail for atendente?
                    /*$atendente_emails = array("pedro@livre.digital");
                    foreach ($administrators_emails as $useremail) {
                        $this->Gmail->send_mail($useremail, $useremail, 'Novo contrato assinado','Novo contrato assinado para o cliente: '.$transaction['email']);
                    }*/
                }
                else{
                    if($signature_status[0]->statusId == 6){
                        //fazer o que neste caso?    
                    }
                }
            }
            sleep(5*60);
        }while(true);
        
        //print_r("<br>\n<br>\n----------  END CHEKING CONTRACTS AT ".date('Y-m-d H:i:s'),time());
    }
    
    public function new_robot_checking_contracts() {
        $this->load->model('class/affiliate_model');
        $this->load->model('class/transaction_model');
        $this->load->model('class/transactions_status');
        $this->load->model('class/system_config');        
        
        $GLOBALS['sistem_config'] = $this->system_config->load();
        
        $_SESSION['logged_role'] = 'ADMIN';
        $date = date("Y-m-d",time());
        
        $file = fopen("log/robot_signature_".$date.".txt","a");
        $content = "<br>\n<br>\n----------  INIT CHEKING CONTRACTS AT ".date('Y-m-d H:i:s',time())." <br>\n";
        fwrite($file, $content);
        //transactions waiting signature
        $transactions = $this->transaction_model->get_client('status_id', transactions_status::WAIT_SIGNATURE);
        $content = "<br>\n<br>\n Numero de transações esperando assinatura: ".count($transactions)." <br>\n";        
        fwrite($file, $content);
        
        foreach ($transactions as $transaction) {
            $signature_status = $this->get_document_D4Sign($transaction['id']);    
            if($signature_status[0]->statusId == 4){
               //documento assinado                
                $this->transaction_model->update_transaction_status(
                    $transaction['id'],
                    transactions_status::PENDING);
                $content = "<br>\n<br>\nContrato assinado por ".$transaction['email']." às ".date('Y-m-d H:i:s',time());
                fwrite($file, $content);
                //send e-mail for atendente?
                /*$atendente_emails = array("pedro@livre.digital");
                foreach ($administrators_emails as $useremail) {
                    $this->Gmail->send_mail($useremail, $useremail, 'Novo contrato assinado','Novo contrato assinado para o cliente: '.$transaction['email']);
                }*/
            }
            else{
                $content = "<br>\n".var_export($signature_status, true)."<br>\n";
                //$content = "<br>\n<br>\nStatus do contrato de ".$transaction['email']." : ".$signature_status[0]->statusId;
                fwrite($file, $content);
                if($signature_status[0]->statusId == 6){
                    //fazer o que neste caso?    
                }
            }
        }
        $content = "<br>\n<br>\n----------  END CHEKING CONTRACTS AT ".date('Y-m-d H:i:s',time())." <br>\n";        
        fwrite($file, $content);
        //print_r("<br>\n<br>\n----------  END CHEKING CONTRACTS AT ".date('Y-m-d H:i:s'),time());
        fclose($file);
    }
    
    public function ARRED ($value){
        return number_format($value, 2, '.', '');
    }
    
    public function PGTO ($rate, $periods, $pV){
        return number_format($pV * pow(1+$rate, $periods)*$rate/(pow(1+$rate, $periods)-1), 2, '.', '');
    }
    
    public function PGTOPRINC ($rate, $periods, $pV, $start, $end, $type){
        //adjust the start and end periods based on the type
        //if it's 1 then payments are at the beginning of the period
        //which is the same as the end of the previous period
        if ($type == 1)
        {
            $start -= 1;
            $end -= 1;
        }

        //calculate the monthlyPayment
        $monthlyPayment = (($rate * $pV * pow((1 + $rate), $periods)) / (pow((1 + $rate), $periods) - 1));

        $remainingBalanceAtStart = ((pow((1 + $rate), $start - 1) * $pV) - (((pow((1 + $rate), $start - 1) - 1) / $rate) * $monthlyPayment));

        $remainingBalanceAtEnd = ((pow((1 + $rate), $end) * $pV) - (((pow((1 + $rate), $end) - 1) / $rate) * $monthlyPayment));

        return number_format(-1*($remainingBalanceAtEnd - $remainingBalanceAtStart), 2, '.', '');
    }
    
    public function calculating_enconomical_values($valor_solicitado, $num_parcelas, $tax = NULL, $tac_transaction = NULL){
        $this->load->model('class/tax_model');
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        
        $B11 = number_format($valor_solicitado, 2, '.', '');
        $B16 = $num_parcelas;
        if(!$tax)
            $B10 = ( $this->tax_model->get_tax_row($B16)[$this->get_field($B11)] )/100;
        else
            $B10 = $tax/100;
        $num_days = 30*($num_parcelas-1) + 10;
        //$B20 = 0.1;
        if(!$tac_transaction)
            $B20 = $GLOBALS['sistem_config']->TAC/100; //20%
        else
            $B20 = $tac_transaction;
        $B21 = number_format($B20*$B11, 2, '.', ''); //TAC
        $IOF_YEAR = 0.0038; 
        $IOF_DAY = 0.000082;
        $IOF_LIM = 0.03;        
        /************  simulando oper ***************/
        $B9 = $B11 + $B21;
        $IOF_ADD_oper = $IOF_YEAR * $B9;
        $oper_parcela = $this->PGTO($B10, $B16, $B9);
        $operB13 = number_format(pow(pow((1+$B10),12),(1.0/365))-1, 2, '.', '');
        $acumulado = 0;
        $IOF_PRAZO_oper = 0;
        $oper_table = [];        
        $oper_table['saldo_dev'][0] = $B9;
        for($i = 1; $i <= $num_parcelas; $i++){
            $oper_table['parcela'][$i] = $i;
            //esta estrategia sera definida posteriormente
            if($i <= 2){
                $acumulado += 31;            
            }
            else {
                $acumulado += 30 + ($i+1)%2;            
            }
            /*$extra_day = ($i <= ($num_parcelas+2)/2 + 1)?1:0;
            $acumulado += 30 + $extra_day;*/
            $oper_table['dias_juros'][$i] = $acumulado;
            $oper_table['parcela'][$i] = $oper_parcela;
            $oper_table['pgto_princ'][$i] = $this->PGTOPRINC($B10, $B16, $B9, $i, $i, 0);
            $oper_table['saldo_dev'][$i] = number_format($oper_table['saldo_dev'][$i-1] - $oper_table['pgto_princ'][$i], 2, '.', '');
            $oper_table['pgto_juros'][$i] = number_format($oper_table['saldo_dev'][$i-1]*( pow(1+$operB13, $oper_table['dias_juros'][$i]) ) - $oper_table['saldo_dev'][$i-1], 2, '.', '');            
            $oper_table['limite_iof'][$i] = number_format($oper_table['pgto_princ'][$i]*$IOF_LIM, 2, '.', '');
            $oper_table['prazo_iof'][$i] = min([$oper_table['pgto_princ'][$i]*$IOF_DAY*$oper_table['dias_juros'][$i], $oper_table['limite_iof'][$i]]);
            $IOF_PRAZO_oper += number_format($oper_table['prazo_iof'][$i], 2, '.', '');
        }
        $IOF_PRAZO_oper = number_format($IOF_PRAZO_oper, 2, '.', '');
        /************  OPER ***************/
        $IOF_FINAC = number_format($B9*($IOF_PRAZO_oper + $IOF_ADD_oper)/ ($B9-($IOF_PRAZO_oper + $IOF_ADD_oper)), 2, '.', '');
        $B8 = $B9 + $IOF_FINAC; //valor principal
        $IOF_ADD = $IOF_ADD_oper;
        $OP_parcela = $this->PGTO($B10, $B16, $B8);
        $acumulado = 0;
        
        $OP_table = [];        
        $OP_table['saldo_dev'][0] = $B8;
        for($i = 1; $i <= $num_parcelas; $i++){
            $OP_table['parcela'][$i] = $i;
            //esta estrategia sera definida posteriormente
            if($i <= 2){
                $acumulado += 31;            
            }
            else {
                $acumulado += 30 + ($i+1)%2;            
            }
            /*$extra_day = ($i <= ($num_parcelas+2)/2 + 1)?1:0;
            $acumulado += 30 + $extra_day;*/
            $OP_table['dias_juros'][$i] = $acumulado;
            $OP_table['parcela'][$i] = $OP_parcela;
            $OP_table['pgto_princ'][$i] = $this->PGTOPRINC($B10, $B16, $B8, $i, $i, 0);
            $OP_table['saldo_dev'][$i] = number_format($OP_table['saldo_dev'][$i-1] - $OP_table['pgto_princ'][$i], 2, '.', '');
            $OP_table['pgto_juros'][$i] = number_format($OP_table['saldo_dev'][$i-1]*( pow(1+$OPB13, $OP_table['dias_juros'][$i]) ) - $OP_table['saldo_dev'][$i-1], 2, '.', '');            
            $OP_table['limite_iof'][$i] = number_format($OP_table['pgto_princ'][$i]*$IOF_LIM, 2, '.', '');
            $OP_table['prazo_iof'][$i] = min([$OP_table['pgto_princ'][$i]*$IOF_DAY*$OP_table['dias_juros'][$i], $OP_table['limite_iof'][$i]]);
            $IOF_PRAZO_OP += number_format($OP_table['prazo_iof'][$i], 2, '.', '');
        }
        $IOF_PRAZO_OP = number_format($IOF_PRAZO_OP, 2, '.', '');
        /************* retornando valores *************/
        $B10 = number_format( $B10*100, 2, '.', ''); 
        $total_cust = number_format($B16 * $OP_parcela , 2, '.', '');        
        $cet_month = number_format( 100.0*($total_cust - $B11)/$B11 , 2, '.', '');        
        $cet_year = number_format( ($cet_month*12)/$B16 , 2, '.', '');        
        $result = array(
            'solicited_value' => $B11,                                
            'amount_months' => $B16,
            'tax' => $B10, //juros
            'month_value' => $OP_parcela,
            'total_cust_value' => $total_cust,
            'funded_value' => $B8,
            'IOF' => $IOF_FINAC,
            'TAC' => $B21,
            'CET_PERC' => $cet_month,
            'CET_YEAR' => $cet_year,                            
            'tax_value' => number_format($total_cust - $B8 , 2, '.', '') ,
            'TAC_API' => number_format($total_cust - $B8 , 2, '.', '') ,
            'TAC_PERC' => number_format($B20 , 2, '.', '') 
            );
        return $result;
    }
    
    public function iugu_report($LR, $CET, $parcelas) {
        $report = [
                    [
                        'LR' => ['01','02','04','05','07','15','39','57','24','60','62','63','65','75','88','92','BL','BM','CF','FC','GD'],
                        'message' => 'Seu banco não autorizou a transação. Entre em contato com o banco emissor do seu cartão agora mesmo e informe que você permite a cobrança no estabelecimento IUGU*Livredigital ou no Livre.Digital, no valor de R$ '.$CET.', parcelado em '.$parcelas.' vezes. Feito isso, basta solicitar novamente em nosso site, que seu empréstimo será aprovado com sucesso!',
                        'email' => 'O valor solicitado com o Livre.digital não foi liberado pelo banco emissor do seu cartão de crédito, pois você não está habituado a utilizar seu cartão em nossa plataforma. <br><br> 
                         <b>PARA LIBERAR O DINHEIRO:</b><br> Você só precisa solicitar a aprovação, ligue para seu banco e informe que deseja aprovação para a cobrança da empresa IUGU*Livredigital ou Livre.Digital, no valor de R$ '.$CET.', parcelado em '.$parcelas.' vezes. <br><br> 
                        <b>Depois disso, basta solicitar novamente em nosso site que ele será aprovado!</b>',
                        'subject' => 'Falta pouco! - Livre.digital',
                        'destroy' => true
                        
                    ],
                    [
                        'LR' => ['51','70'],
                        'message' => 'Não há limite suficiente em seu cartão de crédito. Que tal escolher um valor menor? Solicite metade do valor agora e o restante em 24h, assim a aprovação será mais fácil.',
                        'email' => 'Recebemos a resposta do banco sobre o dinheiro solicitado. Não havia saldo suficiente para aprovar o valor escolhido por você, que tal um valor menor?<br><br>
                                    Experimente solicitar metade do valor primeiro e amanhã solicitar o restante. 
                                    Lembre que o <b>valor total</b> do crédito <b>(CET)</b> deve ser menor que o limite que você tem. 
                                    Por exemplo, se você tem <b>R$ 3.000,00</b> de limite, você deve solicitar ao Livre um valor que seja menor que o <b>Custo Total (CET)</b> e que caiba nesse limite.',
                        'subject' => 'Saldo insuficiente - Livre.digital',
                        'destroy' => true
                    ],
                    [
                        'LR' => ['91','AA','AE','19'],
                        'message' => 'Não foi possível aprovar sua solicitação devido a falta de comunicação com o banco emissor do cartão de crédito. Espere alguns minutos, depois volte a tela com os dados de seu cartão para serem novamente validados e tente novamente.',
                        'email' => 'O valor solicitado não foi aprovado pois não conseguimos contato com o banco. Mas não se preocupe, você só precisa aguardar alguns minutos e tentar de novo.  Lembre validar novamente os dados de seu cartão!<br><br> Antes, pedimos que faça contato com seu banco previamente para informa-lo que irá utilizar o cartão para a transação no valor R$ '.$CET.' para a empresa iugu*livre.digital ou Livre.Digital.',
                        'subject' => 'Tente novamente - Livre.digital',
                        'destroy' => false
                    ],
                    [
                        'LR' => ['BV'],
                        'message' => 'Utilize outro cartão de crédito, o cartão utilizado não tem validade.',
                        'email' => 'Identificamos que seu cartão está vencido e por isso o valor solicitado não pode ser aprovado. Mas não tem problema, você pode utilizar outro cartão de crédito para solicitar um novo valor. Ele só precisa ser da mesma titularidade da conta bancária.',
                        'subject' => 'Cartão vencido - Livre.digital',
                        'destroy' => false
                    ],
                    [
                        'LR' => ['KA','KE','12'],
                        'message' => 'O valor não pode ser aprovado devido aos dados do cartão de crédito não estarem corretos.
                                      Volte e atualize seus dados do cartão com atenção. Não utilize espaço ou caracteres especiais.',
                        'email' => 'O banco não autorizou a transação pois os dados do cartão estão incorretos, você só precisa refazer o pedido e preencher os dados corretamente. Atente-se para não adicionar espaços ou caracteres em locais que não são permitidos como no número do cartão, no seu nome e no CVV (Código de verificação de 3 dígitos que fica atrás do seu cartão)',
                        'subject' => 'Dados incorretos - Livre.digital',
                        'destroy' => false
                    ],
                    [
                        'LR' => ['N7'],
                        'message' => 'Volte e corrija seu o CVV (Código de verificação - Número de 3 dígitos na parte de trás do cartão, ou se for American Express, 4 digitos localizados na frente do cartão). Lembre-se de não utilizar espaços ou caracteres especiais.',
                        'email' => 'O valor solicitado não pode ser aprovado pois o Código de Verificação do seu cartão foi preenchido incorretamente. Você precisa utilizar o CVV código de verificação que fica atrás do cartão. Esse código tem 3 dígitos (ou 4, se for American Express). Se precisar de ajuda é só nos comunicar!',
                        'subject' => 'Seu CVV está incorreto - Livre.digital',
                        'destroy' => false
                    ],
                    [
                        'LR' => ['AC'],
                        'message' => 'Você utilizou seu cartão de DÉBITO. Para que seu pedido seja aprovado, volte e atualize os dados com seu cartão de CRÉDITO.',
                        'email' => 'Você utilizou seu cartão de <b>Débito</b>. Para que o pedido seja aprovado, é necessário utilizar seu cartão de <b>Crédito</b>. É importante lembrar que o valor final (Custo Total - CET) deve caber no seu limite de crédito, ou seja, ele deve ser menor que o limite do seu cartão de crédito.',
                        'subject' => 'Utilize seu cartão de CRÉDITO - Livre.digital',
                        'destroy' => false
                    ]
                ];
        
        $result = [];
        $result['known'] = false;
        foreach ($report as $type) {
            if(in_array($LR, $type['LR'])){
                $result = $type;
                $result['known'] = true;
                break;
            }
        }
        
        $email91 = 'O valor solicitado não pode ser aprovado pois não conseguimos a resposta do banco emissor do cartão de crédito.
                      Mas não se preocupe, é só você tentar novamente em alguns minutos. Lembre validar novamente os dados de seu cartão!<br>\n<br>\n 
                      Aproveite e faça contato com seu banco para informar que você aprova a transação feita pela iugu*livre.digital ou pela Livre.Digital, assim o empréstimo será liberado com muito mais facilidade!';
        if($LR == '91')
            $result['email'] = $email91;
        return $result;
    }   
    
    
    
    //------------BRASPAG---COBRANÇA PARCELADA NO CARTÃO DE CRÉDITO-------------------------
                    
    public function BRASPAG_Authorize($param) { /*É quando uma transação é autorizada e capturada no mesmo momento, isentando do lojista enviar uma confirmação posterior.*/
        $this->load->model('class/system_config');                
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $merchant_id = $GLOBALS['sistem_config']->MERCHANT_ID_BRASPAG;        
        $merchant_key = $GLOBALS['sistem_config']->MERCHANT_KEY_BRASPAG;        
        
        $ch = curl_init();
        $post_fields = "{\n   \"MerchantOrderId\":\"".$param['order_id']."\",\n ".
                        "  \"Customer\":{\n   ".
                        "   \"Name\":\"".$param['name']."\"\n   },\n ".
                        "  \"Payment\":{\n   ".
                        "  \"Provider\":\"".$param['provider']."\",\n  ".
                        "   \"Type\":\"CreditCard\",\n   ".
                        "  \"Amount\":".$param['amount'].",\n   ".
                        "  \"Capture\":false,\n  ".
                        "   \"Installments\":".$param['plots'].",\n  ".
                        "   \"CreditCard\":{\n     ".
                        "    \"CardNumber\":\"".$param['card_number']."\",\n    ".
                        "     \"Holder\":\"".$param['card_name']."\",\n   ".
                        "      \"ExpirationDate\":\"".$param['card_month']."/".$param['card_year']."\",\n   ".
                        "      \"SecurityCode\":\"".$param['card_cvc']."\",\n    ".
                        "     \"Brand\":\"".$param['card_brand']."\"\n     }\n   }\n}";

        //curl_setopt($ch, CURLOPT_URL, "https://apisandbox.braspag.com.br/v2/sales/");
        curl_setopt($ch, CURLOPT_URL, "https://api.braspag.com.br/v2/sales/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = "Content-Type: application/json";
        //$headers[] = "Merchantid: dabe7f53-fd8b-4e70-975b-9b3fcc9da8b7";
        //$headers[] = "Merchantkey: NMQCBOXFCCRZJQBXMWTWAEYPHNZFFDZFOROFZELT";
        $headers[] = "Merchantid: ".$merchant_id;
        $headers[] = "Merchantkey: ".$merchant_key;
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result_curl = curl_exec($ch);
        $parsed_response = json_decode($result_curl);
        
        curl_close ($ch);

        if(is_array($parsed_response)){
            $result['success'] = false;
            $result['code'] = $parsed_response[0]->Code;
            $result['message'] = $parsed_response[0]->Message;
        }
        else{
            if(is_object($parsed_response)){
                $result['success'] = false;                
                $result['try_again'] = false;                
                $result['status'] = $parsed_response->Payment->Status;
                $result['provider_message'] = $parsed_response->Payment->ProviderReturnMessage;
                $result['reason_code'] = $parsed_response->Payment->ReasonCode;
                $result['provider_code'] = $parsed_response->Payment->ProviderReturnCode;
                $result['transaction_id'] = $parsed_response->Payment->AcquirerTransactionId;
                $result['payment_id'] = $parsed_response->Payment->PaymentId;
                if($result['reason_code'] == 0 && $result['status'] == 1){
                    $result['success'] = true;    //operacao com sucesso e paga autorizada            
                }
                if($result['provider_code'] == 99){
                    $result['try_again'] = true;    //pode tentar de novo
                }
            }
        }

        return $result;
    }
    
    public function BRASPAG_Authorize_with_Issuer_DATA($param) { /*É quando uma transação é autorizada e capturada no mesmo momento, isentando do lojista enviar uma confirmação posterior.*/
        $this->load->model('class/system_config');                
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $merchant_id = $GLOBALS['sistem_config']->MERCHANT_ID_BRASPAG;        
        $merchant_key = $GLOBALS['sistem_config']->MERCHANT_KEY_BRASPAG;        
        
        $ch = curl_init();
        $post_fields = "{\n   \"MerchantOrderId\":\"".$param['order_id']."\",\n ".
                        "  \"Customer\":{\n   ".
                        "   \"Name\":\"".$param['name']."\",\n ".
                        "   \"Identity\":\"".$param['cpf']."\",\n ".
                        "   \"IdentityType\":\"CPF\",\n ".
                        "   \"Email\":\"".$param['email']."\",\n ".
                        "   \"Address\":{\n     ".
                        "    \"Street\":\"".$param['street_address']."\",\n    ".
                        "     \"Number\":\"".$param['number_address']."\",\n   ".
                        "     \"Complement\":\"".$param['complement_number_address']."\",\n   ".
                        "     \"ZipCode\":\"".$param['cep']."\",\n    ".
                        "     \"City\":\"".$param['city_address']."\",\n    ".
                        "     \"State\":\"".$param['state_address']."\",\n    ".
                        "     \"Country\":\"BRA\",\n    ".
                        "     \"District\":\"Bairro\"\n     }\n   },\n".                        
                        "  \"Payment\":{\n   ".
                        "  \"Provider\":\"".$param['provider']."\",\n  ".
                        "  \"Type\":\"CreditCard\",\n   ".                        
                        "  \"Amount\":".$param['amount'].",\n   ".
                        "  \"ServiceTaxAmount\":0,\n   ".                        
                        "  \"Installments\":".$param['plots'].",\n  ".
                        "  \"Interest\":\"ByMerchant\",\n   ".                                
                        "  \"Capture\":false,\n  ".
                        "   \"CreditCard\":{\n     ".
                        "     \"CardNumber\":\"".$param['card_number']."\",\n    ".
                        "     \"Holder\":\"".$param['card_name']."\",\n   ".
                        "     \"ExpirationDate\":\"".$param['card_month']."/".$param['card_year']."\",\n   ".
                        "     \"SecurityCode\":\"".$param['card_cvc']."\",\n    ".
                        "     \"Brand\":\"".$param['card_brand']."\"\n     }\n   }\n}";

        //curl_setopt($ch, CURLOPT_URL, "https://apisandbox.braspag.com.br/v2/sales/");
        curl_setopt($ch, CURLOPT_URL, "https://api.braspag.com.br/v2/sales/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = "Content-Type: application/json";
        //$headers[] = "Merchantid: dabe7f53-fd8b-4e70-975b-9b3fcc9da8b7";
        //$headers[] = "Merchantkey: NMQCBOXFCCRZJQBXMWTWAEYPHNZFFDZFOROFZELT";
        $headers[] = "Merchantid: ".$merchant_id;
        $headers[] = "Merchantkey: ".$merchant_key;
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result_curl = curl_exec($ch);
        $parsed_response = json_decode($result_curl);
        
        curl_close ($ch);

        if(is_array($parsed_response)){
            $result['success'] = false;
            $result['code'] = $parsed_response[0]->Code;
            $result['message'] = $parsed_response[0]->Message;
        }
        else{
            if(is_object($parsed_response)){
                $result['success'] = false;                
                $result['try_again'] = false;                
                $result['status'] = $parsed_response->Payment->Status;
                $result['provider_message'] = $parsed_response->Payment->ProviderReturnMessage;
                $result['reason_code'] = $parsed_response->Payment->ReasonCode;
                $result['provider_code'] = $parsed_response->Payment->ProviderReturnCode;
                $result['transaction_id'] = $parsed_response->Payment->AcquirerTransactionId;
                $result['payment_id'] = $parsed_response->Payment->PaymentId;
                if($result['reason_code'] == 0 && $result['status'] == 1){
                    $result['success'] = true;    //operacao com sucesso e paga autorizada            
                }
                if($result['provider_code'] == 99){
                    $result['try_again'] = true;    //pode tentar de novo
                }
            }
        }

        return $result;
    }
    
    public function BRASPAG_Authorize_with_Issuer_DATA_and_Search($param) {        
        $result = $this->BRASPAG_Authorize_with_Issuer_DATA($param);
        if($result['success']){
            $result['captured'] = 100;
            return $result;
        }
        
        $result['captured'] = 0;
        //return $result;     //apagar para fazer retentativa
        
        //salir si provider_code diferente de 51 y de 5
        if( $param['solicited'] < 43000 || ($result['provider_code'] != 51 && $result['provider_code'] != 5) )
            return $result;
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();        
        
        $PERC = $GLOBALS['sistem_config']->PERC_TO_TRY;
        $new_amount = number_format(($param['solicited']/100.0) * ($PERC/100.0), 2, '.', ''); ;
        //recalcular para $PERC% do valor
        $financials = $this->calculating_enconomical_values($new_amount, $param["plots"]);
        $param['amount'] = $financials['total_cust_value']*100;
        $result = $this->BRASPAG_Authorize_with_Issuer_DATA($param);
        
        if($result['success']){
            $result['success'] = false;            
            $result['captured'] = $PERC;            
            $result['financials'] = $financials;            
        }
        
        return $result;        
    }
    
    public function BRASPAG_Authorize_with_Issuer_DATA_and_AVS($param) { /*É quando uma transação é autorizada e capturada no mesmo momento, isentando do lojista enviar uma confirmação posterior.*/
        $this->load->model('class/system_config');                
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $merchant_id = $GLOBALS['sistem_config']->MERCHANT_ID_BRASPAG;        
        $merchant_key = $GLOBALS['sistem_config']->MERCHANT_KEY_BRASPAG;        
        
        $ch = curl_init();
        $post_fields = "{\n   \"MerchantOrderId\":\"".$param['order_id']."\",\n ".
                        "  \"Customer\":{\n   ".
                        "   \"Name\":\"".$param['name']."\",\n ".
                        "   \"Identity\":\"".$param['cpf']."\",\n ".
                        "   \"IdentityType\":\"CPF\",\n ".
                        "   \"Email\":\"".$param['email']."\",\n ".
                        "   \"Address\":{\n     ".
                        "    \"Street\":\"".$param['street_address']."\",\n    ".
                        "     \"Number\":\"".$param['number_address']."\",\n   ".
                        "     \"Complement\":\"".$param['complement_number_address']."\",\n   ".
                        "     \"ZipCode\":\"".$param['cep']."\",\n    ".
                        "     \"City\":\"".$param['city_address']."\",\n    ".
                        "     \"State\":\"".$param['state_address']."\",\n    ".
                        "     \"Country\":\"BRA\",\n    ".
                        "     \"District\":\"".$param['district']."\"\n     }\n   },\n".                        
                        "  \"Payment\":{\n   ".
                        "  \"Provider\":\"".$param['provider']."\",\n  ".
                        "  \"Type\":\"CreditCard\",\n   ".                        
                        "  \"Amount\":".$param['amount'].",\n   ".
                        "  \"ServiceTaxAmount\":0,\n   ".                        
                        "  \"Installments\":".$param['plots'].",\n  ".
                        "  \"Interest\":\"ByMerchant\",\n   ".                                
                        "  \"Capture\":false,\n  ".
                        "   \"Avs\":{\n     ".
                        "     \"Cpf\":\"".$param['cpf']."\",\n    ".
                        "     \"ZipCode\":\"".$param['cep']."\",\n   ".
                        "     \"Street\":\"".$param['street_address']."\",\n   ".
                        "     \"Number\":\"".$param['number_address']."\",\n    ".
                        "     \"Complement\":\"".$param['complement_number_address']."\",\n    ".
                        "     \"District\":\"".$param['district']."\"\n     },\n ".
                        "   \"CreditCard\":{\n     ".
                        "     \"CardNumber\":\"".$param['card_number']."\",\n    ".
                        "     \"Holder\":\"".$param['card_name']."\",\n   ".
                        "     \"ExpirationDate\":\"".$param['card_month']."/".$param['card_year']."\",\n   ".
                        "     \"SecurityCode\":\"".$param['card_cvc']."\",\n    ".
                        "     \"Brand\":\"".$param['card_brand']."\"\n     }\n   }\n}";

        //curl_setopt($ch, CURLOPT_URL, "https://apisandbox.braspag.com.br/v2/sales/");
        curl_setopt($ch, CURLOPT_URL, "https://api.braspag.com.br/v2/sales/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = "Content-Type: application/json";
//        $headers[] = "Merchantid: dabe7f53-fd8b-4e70-975b-9b3fcc9da8b7";
//        $headers[] = "Merchantkey: NMQCBOXFCCRZJQBXMWTWAEYPHNZFFDZFOROFZELT";
        $headers[] = "Merchantid: ".$merchant_id;
        $headers[] = "Merchantkey: ".$merchant_key;
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result_curl = curl_exec($ch);
        $parsed_response = json_decode($result_curl);
        
        curl_close ($ch);

        if(is_array($parsed_response)){
            $result['success'] = false;
            $result['code'] = $parsed_response[0]->Code;
            $result['message'] = $parsed_response[0]->Message;
        }
        else{
            if(is_object($parsed_response)){
                $result['success'] = false;                
                $result['try_again'] = false;                
                $result['status'] = $parsed_response->Payment->Status;
                $result['provider_message'] = $parsed_response->Payment->ProviderReturnMessage;
                $result['reason_code'] = $parsed_response->Payment->ReasonCode;
                $result['provider_code'] = $parsed_response->Payment->ProviderReturnCode;
                $result['transaction_id'] = $parsed_response->Payment->AcquirerTransactionId;
                $result['payment_id'] = $parsed_response->Payment->PaymentId;
                $result['avs_status'] = $parsed_response->Payment->AVS->Status;
                if($result['reason_code'] == 0 && $result['status'] == 1){
                    $result['success'] = true;    //operacao com sucesso e paga autorizada            
                }
                if($result['provider_code'] == 99){
                    $result['try_again'] = true;    //pode tentar de novo
                }
            }
        }

        return $result;
    }
    
    public function BRASPAG_Capture($payment_id, $amount) { /*Captura uma transacao previamente autorizada*/
        $this->load->model('class/system_config');                
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $merchant_id = $GLOBALS['sistem_config']->MERCHANT_ID_BRASPAG;        
        $merchant_key = $GLOBALS['sistem_config']->MERCHANT_KEY_BRASPAG;        
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: 0'));
        //curl_setopt($ch, CURLOPT_URL, "https://apisandbox.braspag.com.br/v2/sales/".$payment_id."/capture?amount=".$amount);
        curl_setopt($ch, CURLOPT_URL, "https://api.braspag.com.br/v2/sales/".$payment_id."/capture?amount=".$amount);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array()));

        $headers = array();
        $headers[] = "Content-Type: application/json";
//        $headers[] = "Merchantid: dabe7f53-fd8b-4e70-975b-9b3fcc9da8b7";
//        $headers[] = "Merchantkey: NMQCBOXFCCRZJQBXMWTWAEYPHNZFFDZFOROFZELT";
        $headers[] = "Merchantid: ".$merchant_id;
        $headers[] = "Merchantkey: ".$merchant_key;
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result_curl = curl_exec($ch);
        $parsed_response = json_decode($result_curl);
        
        curl_close ($ch);

        if(is_array($parsed_response)){
            $result['success'] = false;
            $result['code'] = $parsed_response[0]->Code;
            $result['message'] = $parsed_response[0]->Message;
        }
        else{
            if(is_object($parsed_response)){
                $result['success'] = false;                
                $result['status'] = $parsed_response->Status;
                $result['provider_message'] = $parsed_response->ProviderReturnMessage;
                $result['reason_code'] = $parsed_response->ReasonCode;
                $result['provider_code'] = $parsed_response->ProviderReturnCode;
                
                if($result['reason_code'] == 0 && $result['status'] == 2){
                    $result['success'] = true;    //operacao com sucesso e paga autorizada            
                }
            }
        }
        return $result;
    }
    
    public function BRASPAG_Devolution($payment_id, $amount) { /*O estorno é aplicável quando uma transação criada no dia anterior ou antes já estiver capturada. Neste caso, a transação será submetida no processo de ‘chargeback’ pela adquirente.*/
        $this->load->model('class/system_config');                
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $merchant_id = $GLOBALS['sistem_config']->MERCHANT_ID_BRASPAG;        
        $merchant_key = $GLOBALS['sistem_config']->MERCHANT_KEY_BRASPAG;        
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: 0'));
        //curl_setopt($ch, CURLOPT_URL, "https://apisandbox.braspag.com.br/v2/sales/".$payment_id."/void?amount=".$amount);
        curl_setopt($ch, CURLOPT_URL, "https://api.braspag.com.br/v2/sales/".$payment_id."/void?amount=".$amount);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array()));

        $headers = array();
        $headers[] = "Content-Type: application/json";
        //$headers[] = "Merchantid: dabe7f53-fd8b-4e70-975b-9b3fcc9da8b7";
        //$headers[] = "Merchantkey: NMQCBOXFCCRZJQBXMWTWAEYPHNZFFDZFOROFZELT";
        $headers[] = "Merchantid: ".$merchant_id;
        $headers[] = "Merchantkey: ".$merchant_key;
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result_curl = curl_exec($ch);
        $parsed_response = json_decode($result_curl);
        
        curl_close ($ch);
        
        $result['success'] = false;
        if($parsed_response->ReasonCode == 0 && ($parsed_response->Status == 10 || $parsed_response->Status == 11) )
            $result['success'] = true;        
        $result['message'] = $parsed_response->ProviderReturnMessage;
        
        return $result;
    }
    
    public function do_braspag_payment($id){
        if($id !== $_SESSION['pk'])   //segurança
            return;
        $this->load->model('class/system_config');
        $this->load->model('class/transaction_model');        
        $GLOBALS['sistem_config'] = $this->system_config->load();
        
        $transaction = $this->transaction_model->get_client('id', $id)[0];

        $param = [
            'order_id' => time(),
            'name' => $_SESSION['b_card_name'],
            'amount' => $transaction['total_effective_cost'],
            'plots' => $transaction['number_plots'],
            'cpf' => $transaction['cpf'],
            'cep' => $transaction['cep'],
            'email' => $transaction['email'],
            'street_address' => $transaction['street_address'],
            'number_address' => $transaction['number_address'],
            'complement_number_address' => $transaction['complement_number_address'],
            'city_address' => $transaction['city_address'],
            'state_address' => $transaction['state_address'],
            'district' => $transaction['district'],
            'card_name' => $_SESSION['b_card_name'],
            'card_number' => $_SESSION['b_card_number'],
            'card_cvc' => $_SESSION['b_card_cvv'],
            'card_month' => $_SESSION['b_card_exp_month'],
            'card_year' => $_SESSION['b_card_exp_year'],
            'card_brand' => $_SESSION['brand'],
            'provider' => 'Cielo30',
            'solicited' => $transaction['amount_solicited']
        ];
        
        //$result = $this->BRASPAG_Authorize_with_Issuer_DATA($param);
        if(!$_SESSION['used_method'])
            $result = $this->BRASPAG_Authorize_with_Issuer_DATA_and_Search($param);
        else
        {
            //establece que foi pre-autorizado
            $result = [
                        'success' => true,
                        'payment_id' => $_SESSION[payment_manager::NAME_BRASPAG]['payment_id']                        
                        ];
        }
        
        if($result['success'] && $result['payment_id']){            
            $result_capture = $this->BRASPAG_Capture($result['payment_id'], $param['amount']);            
            if($result_capture['success'])
                $this->transaction_model->save_generated_bill_BRASPAG($id, $result['payment_id']);
            else
                $result = $result_capture; // aqui capture = 0 obligatoriamente pues el metodo no devuelve dito valor
        }
        return $result;
    }
    
    public function re_cancel_contract(){
        if(!$_SESSION['transaction_values']['amount_months']){
            $result['message']='Sessão expirou';
            $result['success']=false;
            echo json_encode($result);
            return;
        }
        if(!$_SESSION['captured']){
            $result['message']='Accesso negado';
            $result['success']=false;
            echo json_encode($result);
            return;
        }
        //registrar accion
        $this->load->model('class/watchdog');
        $this->load->model('class/watchdog_type');

        $register = ['user_id' => $_SESSION['pk'], 'type' => Watchdog_type::REFUND_USER, 'date' => time(), 'ip' => $_SESSION['ip'], 'data' => $_SESSION['pk']];
        $this->watchdog->add_watchdog($register);
        
        $this->load->model('class/system_config');
        $this->load->model('class/transaction_model');
        $this->load->model('class/transactions_status');        
        $this->load->model('class/payment_manager');
        
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $transaction = $this->transaction_model->get_client('id', $_SESSION['pk'])[0];
             
        if($transaction['status_id'] != transactions_status::BEGINNER){
            $result['message']='Accesso negado';
            $result['success']=false;
            echo json_encode($result);
            return;
        }
        
        if($_SESSION['used_method'] == payment_manager::BRASPAG){
            $result = $this->BRASPAG_Devolution($_SESSION[payment_manager::NAME_BRASPAG]['payment_id'], $_SESSION['re_financials']['total_cust_value']*100);    
        }
        
        $_SESSION['used_method'] = 0;
        $_SESSION['re_financials'] = NULL;
        $_SESSION['captured'] = 0;
        return $result;
    }
    
    public function do_braspag_devolution($id){
        if($_SESSION['logged_role'] !== 'ADMIN'){ //segurança
            return ['success' => false, 'message'=>'access denied bras'];            
        }
        $this->load->model('class/system_config');
        $this->load->model('class/transaction_model');        
        $GLOBALS['sistem_config'] = $this->system_config->load();
        
        $transaction = $this->transaction_model->get_client('id', $id)[0];
        //$amount = 10500;
        $amount = $transaction['total_effective_cost'];
        
        $result = $this->BRASPAG_Devolution($transaction['braspag_id'], $amount);
        
        return $result;
    }
    
    public function refund_transactions($id){
        $this->load->model('class/transaction_model');
        $this->load->model('class/payment_manager');
        if($_SESSION['logged_role'] !== 'ADMIN'){ //segurança
            return ['success' => false, 'message'=>'access denied refund'];            
        }
        $result = ['success' => false, 'message' => 'Transação não pode ser estornada'];
        $transaction = $this->transaction_model->get_client('id', $id)[0];
        if($transaction['payment_source'] == payment_manager::IUGU)
            $result = $this->refund_bill_iugu($id);
        else{
            if($transaction['payment_source'] == payment_manager::BRASPAG)
                $result = $this->do_braspag_devolution($id);            
            }
        return $result;
    }
    
    public function do_payment($id, $payment_method){        
        $this->load->model('class/payment_manager');
        $result = ['success' => false, 'message' => 'Erro tentando passar o cartão'];

        if($payment_method == payment_manager::IUGU)
            $result = $this->do_payment_iugu($id);
        else
            if($payment_method == payment_manager::BRASPAG)
                $result = $this->do_braspag_payment($id);            
        
        return $result;
    }

}
