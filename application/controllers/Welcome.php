<?php

ini_set('xdebug.var_display_max_depth', 17);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 8024);

class Welcome extends CI_Controller {
            
    function __construct() {
        parent::__construct();              
    }    
    
    //-------VIEWS FUNCTIONS--------------------------------    
    public function index() {
        $this->set_session(); 
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
        $params['key']=$_SESSION['key'];
        $this->load->view('index',$params);
        $this->load->view('inc/footer');
    }
    
    public function checkout() {
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
        $params['key']=$_SESSION['key'];
        $_SESSION['transaction_values']['frm_money_use_form']=$this->input->get()['frm_money_use_form'];
        $_SESSION['transaction_values']['utm_source']=$this->input->get()['utm_source'];
        $params['total_cust_value']  = str_replace('.', ',', $_SESSION['transaction_values']['total_cust_value']); 
        $params['solicited_value']  = str_replace('.', ',', $_SESSION['transaction_values']['solicited_value']); 
        $params['amount_months']  = $_SESSION['transaction_values']['amount_months']; 
        $params['month_value']  = $_SESSION['transaction_values']['month_value']; 
        $this->load->view('checkout',$params);
        $this->load->view('inc/footer');
    }
    
    //-------AFFILIATES and ADMIN VIEWS FUNCTIONS--------------------------------    
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
                header('Location: '.base_url().'index.php/welcome/admin');
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
            if(count($_POST))
                $datas=$_POST;
            else{
                $datas['num_page']=1;
                $datas['token']='';
                $datas['start_period']='';
                $datas['end_period']='';
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
                    $datas['start_period'],
                    $datas['end_period'],
                    $has_next_page);
            $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
            $params['num_page']=$datas['num_page'];
            $params['has_next_page']=$has_next_page;
            $params['view']='transacoes';
            $this->load->view('transacoes',$params);            
        } else{
            header('Location: '.base_url().'index.php/welcome/afhome');
        }
    }
        
    public function admin() {
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
        $params['view']='resumo';
        $this->load->view('resumo');
    }
    
    public function resumo() {
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
        $params['view']='resumo';
        $this->load->view('resumo');
    }
    
    public function configuracoes() {
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
        $params['view']='configuracoes';
        $this->load->view('configuracoes');
    }
        
    public function logout() {
        session_unset();
        session_destroy();
        header('Location: '.base_url().'index.php/welcome/afhome');
    }
    
    
    //-------CLIENTS FUNCTIONS--------------------------------    
    /*
    //varaiveis armazenadas na sessao para a solicitação de um empréstimo
    $_SESSION
    ['ip']
    ['pk']
    ['key']
    ['time_start']
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
    */     
    public function is_possible_steep_1_for_this_client($datas) {
        $this->load->model('class/transaction_model');
        $this->load->model('class/transactions_status');
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $_SESSION['is_possible_steep_1']=false;
        
        //1. Analisar se IP tem sido marcado como hacker
        $this->is_ip_hacker();
        $clients = $this->transaction_model->get_client('cpf',$datas['cpf']);
        //2. analisar CPF del pedido por los posibles status
        if($N=count($clients)){
            if($clients[$N-1]['status_id'] == transactions_status::DENIED){                
                $result['message']='Você ja teve um pedido anteriomnete que foi negado. Por favor, contate nosso atendimento';
                $result['success']=false;
                return $result;
            }else
            if($clients[$N-1]['status_id'] == transactions_status::APPROVED){                
                $result['message']='Você tem um pedido que foi aprovado e no momento está sendo feita a transferência para sua conta';
                $result['success']=false;
                return $result;
            }else
            if($clients[$N-1]['status_id'] == transactions_status::PENDING){                
                $result['message']='Você fez um pedido recentemente, aguarde ser analisado. Casso dúvidas, contate nosso atendimento';
                $result['success']=false;
                return $result;
            }else
            if($clients[$N-1]['status_id'] == transactions_status::WRONG_TRANSFERRED){                
                $result['message']='Seu pedido foi aprovado, mas ocorreu um erro na transferência. Contate nosso atendimento';
                $result['success']=false;
                return $result;
            }
        }        
        //3. un mismo CPF no puede ser usado em menos de 24 horas para pedir de nuevo        
        if(time()- $clients[$N-1]['solicited_date'] < 24*60*60){
            $result['message']='Você não pode fazer mais de uma solicitação em menos de 24 horas';
            $result['success']=false;
            return $result;
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
        if(count($nomes)>1){*/
        if($clients[0]['name'] != $datas['name']){
            $result['message']='Sua solicitação foi negada devido a que seu CPF tem sido usado com outro nome. Por favor, contate nosso atendimento';
            $result['success']=false;
            return $result;
        }
            //4.2 mesmo telefone com nome diferentes
        $clients = $this->transaction_model->get_client('phone_number',$datas['phone_number']);
        /*$nomes=array();
        foreach ($clients as $client) {
            if(isset($nomes[$client['name']]))
                $nomes[$client['name']]+=1;
            else
                $nomes[$client['name']]=1;
        }
        if(count($nomes)>1){*/
        if(count($clients) > 0 && $clients[0]['name'] != $datas['name']){
            $result['message']='Sua solicitação foi negada devido a que seu telefone tem sido usado com outro nome. Por favor, contate nosso atendimento';
            $result['success']=false;
            $_SESSION['client_datas']['sms_verificated'] = false;
            return $result;
        }
            //4.3 mesmo telefone com diferentes cpf
        /*$cpfs=array();
        foreach($clients as $client) {
            if(isset($cpfs[$client['cpf']]))
                $cpfs[$client['cpf']]+=1;
            else
                $cpfs[$client['cpf']]=1;
        }
        if(count($cpfs)>1){*/
        if(count($clients) > 0 && $clients[0]['cpf'] != $datas['cpf']){
            $result['message']='Sua solicitação foi negada devido a que seu telefone tem sido usado com outro cpf. Por favor, contate nosso atendimento';
            $result['success']=false;
            $_SESSION['client_datas']['sms_verificated'] = false;
            return $result;
        }                
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
            if($client[0]['purchase_counter']<=$GLOBALS['sistem_config']->MAX_PURCHASE_TENTATIVES){
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
                $result['message']='Não autorizado. Quantidade máxima de tentativas alcanzadas. Contate nosso atendimento';
                $result['success']=false;
                return $result;
            }
        }
    }
    
    public function insert_datas_steep_1(){
        $datas = $this->input->post();
        if($datas['key']!==$_SESSION['key']){
            $result['message']='Autorização negada. Violação de acesso';
            $result['success']=false;
        }else{
            $this->load->model('class/transaction_model');            
            $datas['HTTP_SERVER_VARS'] = json_encode($_SERVER);        
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
                    $datas['way_to_spend'] = $_SESSION['transaction_values']['frm_money_use_form'];
                    
                    if($possible['action']==='insert_beginner'){
                        $datas['status_id']=  transactions_status::BEGINNER;
                        $id_row = $this->transaction_model->insert_db_steep_1($datas);
                    }
                    else{
                        $id_row = $this->transaction_model->update_db_steep_1($datas,$possible['id']);
                        if($id_row)
                            $id_row=$possible['id'];
                    }
                    if($id_row){
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
        if(in_array($datas['credit_card_number'],$card_bloqued)){
            $result['message']='O número do cartão informado não pode ser usado. Por favor, contate nosso atendimento';
            $result['success']=false;
            return $result;
        }
        if(in_array($datas['credit_card_name'],$name_bloqued)){
            $result['message']='O nome no cartão informado não pode ser usado. Por favor, contate nosso atendimento';
            $result['success']=false;
            return $result;
        }
               
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
        
        //4. Analisar se é para atualizar ou inserir nova linha
        $credit_cards = $this->transaction_model->get_credit_card('client_id', $datas['pk']);
        if(count($credit_cards)){
            $result['action']='update_credit_card';
            $result['id']=$credit_cards[0]['id'];
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
        $datas = $this->input->post();
        if(!$_SESSION['is_possible_steep_1'] || $datas['key']!==$_SESSION['key']){
            $result['message']='Autorização negada. Violação de acesso';
            $result['success']=false;
        }else{
            $this->load->model('class/transaction_model');            
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
                    
                    if($possible['action']==='insert_credit_card'){
                        $id_row = $this->transaction_model->insert_db_steep_2($datas);
                    }
                    else
                        $id_row = $this->transaction_model->update_db_steep_2($datas,$possible['id']);
                    if($id_row){
                        /*verificar cartao de credito haciendo la cobrança*/
                        //$response = $this->do_payment($id_row);
                        $response['success'] = TRUE; $response['message'] = "Cartão adicionado";
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
        //4. Analisar se é para atualizar ou inserir nova linha
        $account_bank = $this->transaction_model->get_account_bank_by_client_id($datas['pk']);
        if(count($account_bank)===1){
            $result['action']='update_account_bank';
            $result['id']=$account_bank[0]['id'];
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
                        $id_row = $this->transaction_model->update_db_steep_3($datas,$possible['id']);
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
    
    public function insert_datas_steep_4() {
        if(!($_SESSION['is_possible_steep_1'] && $_SESSION['is_possible_steep_2'] && $_SESSION['is_possible_steep_3'] || $datas['key']!==$_SESSION['key'])){
            $result['message']='Autorização negada. Violação de acesso';
            $result['success']=false;
        }else{
            $result['success'] = true;
            $_SESSION['is_possible_steep_4'] =true;
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
            $result['message'] = 'Falha evinvando mensagem. Tente depois.';
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
    
    //varaiveis armazenadas na sessao para cadastro de un afiliado
    $_SESSION
    ['logged_id']
    ['logged_role']
    ['affiliate_logged_datas']
    ['affiliate_logged_transactions']
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
                $cad = explode('-', str_replace('@', '-', $datas['email']));
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
                $account_bank = $this->transaction_model->get_account_bank_by_client_id($_SESSION['pk']);
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
        } else{
            $_SESSION['logged_id'] = -1;
            $result['message'] = 'Você deve se cadastrar primeiro';
            $result['resource'] = 'afiliados';
            $result['success'] = false;
        }
        echo json_encode($result);
    }
    
   

    //-------AUXILIAR FUNCTIONS----------------------------------
    
    public function set_session(){
        session_start();
        $_SESSION = array();
        $ip=$_SERVER['REMOTE_ADDR'];
        $key=md5($ip.time());
        $_SESSION['ip']=$ip;
        $_SESSION['key']=$key;
    }

    public function is_ip_hacker(){
        $IP_hackers= array(
            '191.176.169.242', '138.0.85.75', '138.0.85.95', '177.235.130.16', '191.176.171.14', '200.149.30.108', '177.235.130.212', '66.85.185.69',
            '177.235.131.104', '189.92.238.28', '168.228.88.10', '201.86.36.209', '177.37.205.210', '187.66.56.220', '201.34.223.8', '187.19.167.94',
            '138.0.21.188', '168.228.84.1', '138.36.2.18', '201.35.210.135', '189.71.42.124', '138.121.232.245', '151.64.57.146', '191.17.52.46', '189.59.112.125',
            '177.33.7.122', '189.5.107.81', '186.214.241.146', '177.207.99.29', '170.246.230.138', '201.33.40.202', '191.53.19.210', '179.212.90.46', '177.79.7.202',
            '189.111.72.193', '189.76.237.61', '177.189.149.249', '179.223.247.183', '177.35.49.40', '138.94.52.120', '177.104.118.22', '191.176.171.14', '189.40.89.248',
            '189.89.31.89', '177.13.225.38',  '186.213.69.159', '177.95.126.121', '189.26.218.161', '177.193.204.10', '186.194.46.21', '177.53.237.217', '138.219.200.136',
            '177.126.106.103', '179.199.73.251', '191.176.171.14', '179.187.103.14', '177.235.130.16', '177.235.130.16', '177.235.130.16', '177.47.27.207'
            );
        if(in_array($_SERVER['REMOTE_ADDR'],$IP_hackers)){            
            header('Location: '.base_url());
        }
    }

    public function verify_simulation($datas=NULL) {
        $flag=false;
        if(!$datas){
            $datas = $this->input->post();
            $flag=true;
        }
        $datas['amount_months']=(int)$datas['amount_months'];
        $datas['solicited_value']=(float)$datas['solicited_value'];
        if(($datas['amount_months']>=6 && $datas['amount_months']<=12)){
            if($datas['solicited_value']>=500 && $datas['solicited_value']<=3000){
                $taxas=array(6=>40.63, 7=>47.65, 8=>55.01, 9=>62.75, 10=>70.87, 11=>79.40, 12=>88.35);
                $result['total_cust_value'] = $datas['solicited_value'] + 
                        ($datas['solicited_value']* $taxas[$datas['amount_months']]/100);
                $result['month_value'] = $result['total_cust_value']/$datas['amount_months'];                
                $result['total_cust_value']=sprintf("%.2f", $result['total_cust_value']);
                $result['month_value']=sprintf("%.2f", $result['month_value']);                
                $result['solicited_value']=$datas['solicited_value'];  
                $result['amount_months']=$datas['amount_months'];                  
                $result['success'] = true;
                $_SESSION['transaction_values']=$result;
            } else{
                $result['success'] = false;
                $result['message'] = 'Só pode solicitar um valor entre R$500 e R$3000';
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
    
    public function codify($str){
        $this->load->model('class/crypt');
        return  $this->crypt->codify($str);
    }
    
    public function decodify($str){
        $this->load->model('class/crypt');
        return  $this->crypt->decodify($str);        
        return $str;
    }
    
    public function get_cep_datas(){
        $cep = $this->input->post()['cep'];
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
        if($datas['key']===$_SESSION['key']){
            $phone_country_code = '+55';            
            $phone_ddd = $datas['phone_ddd'];
            $phone_number = $datas['phone_number'];
            $random_code = rand(100000,999999); $random_code = 123;//eliminar $random_code = 123;            
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
    
    public function send_sms_kaio_api($phone_country_code, $phone_ddd, $phone_number, $message){        
        //com kaio_api
        $response['success'] = TRUE; /*eliminar estas*/
        return $response;            /* dos lineas  */
        
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
            "authenticationtoken: D8UvJQd-bb5sXzA-vnJWr13qmMBTQWomtj1oiysq",
            "username: seiva",
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
        
    public function iugu_simples_sale(){
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
    }
        
    public function upload_file(){
        $this->load->model('class/transaction_model');
        $datas = $this->input->post();
        if($_SESSION['is_possible_steep_1'] && $_SESSION['is_possible_steep_2'] && $_SESSION['is_possible_steep_3'] && $datas['key']===$_SESSION['key']){
            $client = $this->transaction_model->get_client('id', $_SESSION['pk']);                
            $cpf = $client[0]['cpf'];
            if(!$_SESSION['time_start'])
                $_SESSION['time_start'] = time();
            $now = $_SESSION['time_start'];
            $path_name = "assets/data_users/".$cpf."_".$now;             
            
            if(is_dir($path_name) || mkdir($path_name, 0755)){            
                $result = [];
                $result['success'] = false;
                $result['message'] = "";
                if($fileError == UPLOAD_ERR_OK){
                   //Processes your file here
                    $allowedExts = array("gif", "jpeg", "jpg", "png");
                    $temp = explode(".", $_FILES["file"]["name"]);
                    $extension = end($temp);
                    if ((($_FILES["file"]["type"] == "image/gif")
                    || ($_FILES["file"]["type"] == "image/jpeg")
                    || ($_FILES["file"]["type"] == "image/jpg")
                    || ($_FILES["file"]["type"] == "image/pjpeg")
                    || ($_FILES["file"]["type"] == "image/x-png")
                    || ($_FILES["file"]["type"] == "image/png"))
                    && ($_FILES["file"]["size"] < 5000000)
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
                            
                            $filename = $file_names[$id_file].".png";
                            
                            //$filename = $label.$_FILES["file"]["name"];                   
                            if (file_exists($path_name."/". $filename)) {
                                unlink($path_name."/". $filename);
                                //$result['message'] .= $filename . " já foi carregado. ";
                            } 
                            
                            move_uploaded_file($_FILES["file"]["tmp_name"],
                            $path_name."/". $filename);
                            $result['message'] = "Guardado " . $filename;
                            $result['success'] = true;
                            $_SESSION[$file_names[$id_file]] = true;
                        }
                    } else {
                        $result['message'] .= "Arquivo inválido";
                    }            
                }else{
                   switch($fileError){
                     case UPLOAD_ERR_INI_SIZE:   
                          $message = 'Error ao tentar subir um arquivo que excede o tamanho permitido.';
                          break;
                     case UPLOAD_ERR_FORM_SIZE:  
                          $message = 'Error ao tentar subir um arquivo que excede o tamanho permitido.';
                          break;
                     case UPLOAD_ERR_PARTIAL:    
                          $message = 'Error: não terminou a ação de subir o arquivo.';
                          break;
                     case UPLOAD_ERR_NO_FILE:    
                          $message = 'Error: nenhum arquivo foi subido.';
                          break;
                     case UPLOAD_ERR_NO_TMP_DIR: 
                          $message = 'Error: servidor não configurado para carga de arquivos.';
                          break;
                     case UPLOAD_ERR_CANT_WRITE: 
                          $message= 'Error: posible falha ao gravar o arquivo.';
                          break;
                     case  UPLOAD_ERR_EXTENSION: 
                          $message = 'Error: carga de arquivo não completada.';
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
            $result['message'] = "Sessão expirou";
        }    
        echo json_encode($result);
    }
        
    public function sign_contract() {
        $this->load->model('class/transaction_model');
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
                //hacer mas cosas
            }
            else{                
                $result['success'] = false;
                $result['message'] = "Deve subir todas as imagens solicitadas corretamente";                
            }
        }
        else{
            $result['success'] = false;
            $result['message'] = "Sessão expirou";
        }
        echo json_encode($result);
    }
    
    public function get_token_iugu($id){
        
        $this->load->model('class/transaction_model');
        $credit_card = $this->transaction_model->get__decrypt_credit_card('client_id',$id);
        
        $name = $credit_card['credit_card_name'];
        $names = explode(' ', $name);
        $lastname = $names[count($names) - 1];
        unset($names[count($names) - 1]);
        $firstname = join(' ', $names);

        $postData = array(
            'account_id' => '80BF7285A577436483EE04E0A80B63F4',
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
        
        $url = "https://api.iugu.com/v1/payment_token";
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
            return $parsed_response->id;
        }
        else {
            return 0;
        }
    }

    public function do_payment($id){
        $this->load->model('class/transaction_model');
        
        $API_TOKEN = 'cf674d3db2f0431fc326f633e5f8a152';
        $client = $this->transaction_model->get_client('id', $id)[0];
        
        $token = $this->get_token_iugu($id);
        
        $postData = array(
            'token' => $token,
            'email' => $client['email'],
            'months' => 1,//$client['number_plots'],
            'items' => array(
                            'description' => 'money',
                            'quantity' => 1,
                            'price_cents' => 1000//$client['total_effective_cost']
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
            $response['success'] = false;
            $response['message'] = $parsed_response->message;
        }
        
        return $response;
    }

    public function refund_bill($id){
        $this->load->model('class/transaction_model');
        
        $API_TOKEN = 'cf674d3db2f0431fc326f633e5f8a152';
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
    
    public function get_bill($id){        
            
        $this->load->model('class/transaction_model');
        
        $API_TOKEN = 'cf674d3db2f0431fc326f633e5f8a152';
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
    
    public function get_topazio_API_token() {
        $this->load->model('class/transaction_model');
        
        //Obteniendo code
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://api-topazio.sensedia.com/oauth/grant-code");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"client_id\":\"9b6103b5-ed33-36b8-9276-76663067c710\",\"redirect_uri\":\"http://localhost/\"}");
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return 0;
        }
        curl_close ($ch);
        
        $parsed_response = json_decode($result);        
        $code = substr($parsed_response->redirect_uri, 23);//obtiene code
        
        //Obteniendo access token
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://api-topazio.sensedia.com/oauth/access-token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=authorization_code&code=".$code);
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        $headers[] = "Authorization: Basic OWI2MTAzYjUtZWQzMy0zNmI4LTkyNzYtNzY2NjMwNjdjNzEwOjk2NjcyYjVkLWEyMmItM2RjMi04OWVmLTNlNTU0ZWNmYTk0NA==";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return 0;
        }
        curl_close ($ch);
        
        $parsed_response = json_decode($result);        
        $API_token = $parsed_response->access_token; //obtiene token*/
        
        return $API_token;
    }

    public function basicCustomerTopazio(){        
        
        $API_token = $this->get_topazio_API_token();
        
        $cpf = "12345678901";
        $name = "Julio Petro";
        $cep = "24040200";
        $street = "Miguel 42";
        $number = "25";
        $district = "Ponta Celeste";
        $city = "Mi ciudad";
        $state = "SP";
        $phone = "21212121212121";
        $email = "julio@julio.com.br";
        $cnpj_livre = "23456789012";
        
        $fields =   "{\n  \"document\": \"".$cpf
                    ."\",\n  \"nameOrCompanyName\": \"".$name
                    ."\",\n  \"billing\": 0,\n  \"score\": \"string\",\n  \"rating\": \"string\",\n  \"address\": {\n "
                    ."  \"postalCode\": ".$cep
                    .",\n    \"street\": \"".$street
                    ."\",\n    \"number\": \"".$number
                    ."\",\n    \"complement\": \"\",\n    \"district\": \"".$district
                    ."\",\n    \"city\": \"".$city
                    ."\",\n    \"state\": \"".$state
                    ."\"\n  },\n  \"contact\": {\n    \"phone\": \"".$phone
                    ."\",\n    \"email\": \"".$email
                    ."\"\n  },\n  \"partners\": [\n    {\n      \"document\": \"".$cnpj_livre
                    ."\",\n      \"nameOrCompanyName\": \"Livre\",\n      \"typeLink\": \"string\",\n      \"ownershipPercentage\": 0\n    }\n  ]\n}";
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://sandbox-topazio.sensedia.com/cli/v1/basic-customers");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"document\": \"12345678901\",\n  \"nameOrCompanyName\": \"Julio Petro\",\n  \"billing\": 0,\n  \"score\": \"string\",\n  \"rating\": \"string\",\n  \"address\": {\n    \"postalCode\": 24040200,\n    \"street\": \"Miguel 42\",\n    \"number\": \"25\",\n    \"complement\": \"\",\n    \"district\": \"Ponta Celeste\",\n    \"city\": \"Mi ciudad\",\n    \"state\": \"SP\"\n  },\n  \"contact\": {\n    \"phone\": \"21212121212121\",\n    \"email\": \"julio@julio.com.br\"\n  },\n  \"partners\": [\n    {\n      \"document\": \"23456789012\",\n      \"nameOrCompanyName\": \"Livre\",\n      \"typeLink\": \"string\",\n      \"ownershipPercentage\": 0\n    }\n  ]\n}");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = "Content-Type: application/json";
        $headers[] = "client_id: 9b6103b5-ed33-36b8-9276-76663067c710";
        $headers[] = "access_token: ".$API_token;
        $headers[] = "Accept: text/plain";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        
        $parsed_response = json_decode($result);        
    }
    
    public function topazio_emprestimo($id) {
        //$API_token = $this->get_topazio_API_token();
    }
    
    public function get_transaction_datas_by_id(){
        $datas = $this->input->post();
        $result['message'] = 'Transação não encontrada';
        $result['success']=false;
        foreach ($_SESSION['affiliate_logged_transactions'] as $transactions){
            if($transactions['id'] == $datas['id']){
                $result['message'] = $transactions;
                $result['success']=true;
                break;
            }
        }
        echo json_encode($result);
    }
   
}
