<?php

ini_set('xdebug.var_display_max_depth', 17);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 8024);

class Welcome extends CI_Controller {
            
    function __construct() {
        parent::__construct();
    }

    public function test5(){
        //$hoje = strtotime("now");        
        //$d = getdate($hoje);
        //$da = date("Y-m-d");
        //$this->robot_conciliation();
        $trasactions = $this->topazio_conciliations("2018-08-20");
        foreach ($trasactions as $t) {
            var_dump($t);
        }
    }
   
    public function test3(){
        $resp = $this->topazio_emprestimo(4); 
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
        var_dump($resp);
    }
    //-------VIEWS FUNCTIONS--------------------------------    
    public function index() {
        //$this->test3();        
        $this->set_session(); 
        $datas = $this->input->get();
        if(isset($datas['afiliado']))
            $_SESSION['affiliate_code'] = $datas['afiliado'];
        else
            $_SESSION['affiliate_code'] = '';
        if(isset($datas['utm_source']))
            $_SESSION['utm_source'] = $datas['utm_source'];
        else
            $_SESSION['utm_source'] = '';
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
        $params['key']=$_SESSION['key'];
        $this->load->view('index',$params);
        $this->load->view('inc/footer');
    }
    
    public function checkout() {
        //die('This functionalities is under development :-)');
        if(session_id()=='')header('Location: '.base_url());
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
        $params['key']=$_SESSION['key'];
        $_SESSION['transaction_values']['frm_money_use_form']=$this->input->get()['frm_money_use_form'];
        $_SESSION['transaction_values']['utm_source']=$this->input->get()['utm_source'];
        
        $params['month_value']  = str_replace('.', ',',$_SESSION['transaction_values']['month_value']); 
        $params['solicited_value']  = str_replace('.', ',', $_SESSION['transaction_values']['solicited_value']); 
        $params['amount_months']  = $_SESSION['transaction_values']['amount_months']; 
        $params['tax']  = str_replace('.', ',', $_SESSION['transaction_values']['tax']); 
        $params['total_cust_value']  = str_replace('.', ',', $_SESSION['transaction_values']['total_cust_value']); 
        $params['IOF']  = str_replace('.', ',', $_SESSION['transaction_values']['IOF']); 
        $params['CET_PERC']  = str_replace('.', ',', $_SESSION['transaction_values']['CET_PERC']); 
        $params['CET_YEAR']  = str_replace('.', ',', $_SESSION['transaction_values']['CET_YEAR']); 
        $this->load->view('checkout',$params);
        $this->load->view('inc/footer');
    }
    
    public function suceso_compra(){
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $params = $this->input->get();        
        $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
        $this->load->view('sucesso-compra',$params);
        $this->load->view('inc/footer');
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
            
            $params['total_CET'] = $this->affiliate_model->total_CET($datas);
            $params['loan_value'] = $this->affiliate_model->loan_value($datas);
            $params['average_ticket'] = $this->affiliate_model->average_ticket($datas);
            $params['average_amount_months'] = $this->affiliate_model->average_amount_months($datas);
            
            $this->load->view('resumo');
        }
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

    //Variaveis para subir novamente as fotos
    ['new_front_credit_card']
    ['new_selfie_with_credit_card']
    ['new_open_identity']
    ['new_selfie_with_identity']
    ['new_cpf_card']
    ['session_new_foto']
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
                    $result['message'] .= 'O seu anterior pedido está precisando de ser assinado. Casso dúvidas, contate nosso atendimento.';                    
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
        if(count($nomes)>1){*/
        if($N > 0 && $clients[0]['name'] != $datas['name']){
            $result['message']='Este CPF foi usado anteriormente com outro nome. Para solicitar o crédito entre em contato com a nossa equipe de atendimento.';
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
            $result['message']='Este telefone foi usado anteriormente com outro nome. Para solicitar o crédito entre em contato com a nossa equipe de atendimento.';
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
    
    public function sign_contract() {
        $this->load->model('class/system_config');
        $this->load->model('class/transaction_model');
        $this->load->model('class/transactions_status');
        require_once ($_SERVER['DOCUMENT_ROOT']."/livre/application/libraries/Gmail.php");
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $this->Gmail = new Gmail();
        $params['SCRIPT_VERSION']=$GLOBALS['sistem_config']->SCRIPT_VERSION;
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
                //1. pasar cartão de crédito na IUGU                
                $response = $this->do_payment_iugu($_SESSION['pk']);
                if($response['success']){                    
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
                    $result['success'] = true;
                    $result['params'] = $string_param;                                
                    session_destroy();
                }else{
                    $name = explode(' ', $_SESSION['client_datas']['name']); $name = $name[0];
                    $useremail = $_SESSION['client_datas']['email'];
                    $this->Gmail->credit_card_recused($name,$useremail);
                    $result['success'] = false;
                    $result['message'] = $response['message'];  
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
        } else{
            $_SESSION['logged_id'] = -1;
            $result['message'] = 'Você deve se cadastrar primeiro';
            $result['resource'] = 'afiliados';
            $result['success'] = false;
        }
        echo json_encode($result);
    }
        
    //-------ADMIN TRANSACTION FUNCTIONS----------------------------------
    public function approve_transaction(){
        $this->load->model('class/transaction_model');
        $this->load->model('class/transactions_status');
        $this->load->model('class/system_config');
        $result['success'] = false;
        if($_SESSION['logged_role'] === 'ADMIN'){
            $resp = $this->topazio_emprestimo($_SESSION['transaction_requested_id']);
            if($resp['success']){
                $this->transaction_model->save_in_db(
                        'transactions',
                        'id',$_SESSION['transaction_requested_id'],
                        'ccb_number',$resp['ccb']);                                
                $this->transaction_model->update_transaction_status(
                        $_SESSION['transaction_requested_id'], 
                        transactions_status::TOPAZIO_IN_ANALISYS);
                //email de bem sucedido
                $GLOBALS['sistem_config'] = $this->system_config->load();
                require_once ($_SERVER['DOCUMENT_ROOT']."/livre/application/libraries/Gmail.php");
                $this->Gmail = new Gmail();      
                $name = explode(' ', $_SESSION['transaction_requested_datas']['name']); $name = $name[0];
                $useremail = $_SESSION['transaction_requested_datas']['email'];
                $result = $this->Gmail->transaction_email_approved($name,$useremail);
                if ($result['success'])
                    $result['message'] = 'Transação aprovada e transferência agendada com sucesso!!';
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
                $result['message'] = "Error emprestimo. Motivo: ( ".$resp['message']." )";    
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
        $this->load->model('class/system_config');
        $this->load->model('class/transactions_status');
        $this->load->model('class/transaction_model');
        $this->load->model('class/Crypt');
        $result['success'] = false;
        require_once ($_SERVER['DOCUMENT_ROOT']."/livre/application/libraries/Gmail.php");
        if($_SESSION['logged_role'] === 'ADMIN'){
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
            if ($result['success'])
                $result['message'] = 'Fotos novas solicitadas com sucesso!!';
            else             
                $result['message'] = 'Falha enviando email de solicitação de novas fotos. Tente depois.';                
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
        $this->load->model('class/system_config');
        $this->load->model('class/transactions_status');
        $this->load->model('class/transaction_model');
        $this->load->model('class/Crypt');
        $result['success'] = false;
        require_once ($_SERVER['DOCUMENT_ROOT']."/livre/application/libraries/Gmail.php");        
        if($_SESSION['logged_role'] === 'ADMIN'){
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
            if ($result['success'])
                $result['message'] = 'Nova conta solicitada com sucesso!!';
            else             
                $result['message'] = 'Falha enviando email de solicitação de nova conta. Tente depois.';                
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
        if($_SESSION['pk'] == $this->Crypt->decrypt($datas['trid'])){
            $datas['pk'] = $_SESSION['pk'];
            if($this->transaction_model->update_db_steep_3($datas,$_SESSION['pk'])){                
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
                                    $_SESSION['transaction_requested_id'],
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
        $this->load->model('class/system_config');
        $this->load->model('class/transactions_status');
        $this->load->model('class/transaction_model');
        $this->load->model('class/Crypt');
        $result['success'] = false;
        require_once ($_SERVER['DOCUMENT_ROOT']."/livre/application/libraries/Gmail.php");
        if($_SESSION['logged_role'] === 'ADMIN'){
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
                        if ($result['success'])
                            $result['message'] = 'Nova assinatura solicitada com sucesso!!';
                        else             
                            $result['message'] = 'Falha enviando email de solicitação de nova assinatura. Tente depois.';                
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
        $this->load->model('class/system_config');
        $this->load->model('class/transactions_status');
        $this->load->model('class/transaction_model');
        $this->load->model('class/Crypt');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        require_once ($_SERVER['DOCUMENT_ROOT']."/livre/application/libraries/Gmail.php");
        $this->Gmail = new Gmail();
        $result['success'] = false;
        if($_SESSION['logged_role'] === 'ADMIN'){
            //1. estornar dinero
            $resp = $this->refund_bill_iugu($_SESSION['transaction_requested_id']);
            if($resp['success']){
                //2. mudar status de la transaccion
                $this->transaction_model->update_transaction_status(
                    $_SESSION['transaction_requested_id'], 
                    transactions_status::REVERSE_MONEY);
                //3. enviar email de estorno
                $name = explode(' ', $_SESSION['transaction_requested_datas']['name']); $name = $name[0];
                $useremail = $_SESSION['transaction_requested_datas']['email'];
                $result = $this->Gmail->transaction_request_recused($name,$useremail);
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

        //-------AUXILIAR FUNCTIONS------------------------------------    
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
                $financials = $this->calculating_enconomical_values($datas["solicited_value"], $datas["amount_months"]);
                $result['solicited_value']=$financials['solicited_value'];  
                $result['amount_months']=$financials['amount_months'];
                $result['total_cust_value'] = $financials['total_cust_value'];                        
                $result['month_value'] =$financials['month_value'];
                $result['tax'] =$financials['tax'];
                $result['IOF'] =$financials['IOF']; //valor a cobrar por IOF
                $result['TAC'] =$financials['TAC'];
                $result['CET_PERC'] =$financials['CET_PERC'];
                $result['CET_YEAR'] =$financials['CET_YEAR'];
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
    
    //-------SMS KAIO API---------------------------------------
    public function send_sms_kaio_api($phone_country_code, $phone_ddd, $phone_number, $message){        
        //com kaio_api
        $response['success'] = TRUE; /*eliminar estas*/
        return $response;            /* dos lineas  */
        
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
    }

    public function do_payment_iugu($id){
        /*if($id !== $_SESSION['pk'])   //segurança
            return;*/
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
        
        $financials = $this->calculating_enconomical_values($client["amount_solicited"]/100, $client["number_plots"]);
        
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
            $response['success'] = false;
            $response['message'] = "Erro no pagamento, verifique os dados fornecidos de seu cartão de crédito";//$parsed_response->message;
        }
        return $response;
    }

    public function refund_bill_iugu($id){
        /*if($_SESSION['logged_role'] !== 'ADMIN'){ //segurança
            return;            
        }*/
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
        /*if($_SESSION['logged_role'] !== 'ADMIN'){ //segurança
            return;            
        }*/    
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
        /*if($_SESSION['logged_role'] !== 'ADMIN'){ //segurança
            return;            
        }*/
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
        $cep = $client["cep"];
        $street = $client["street_address"]." ".$client["number_address"];
        $number = $client["complement_number_address"];
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
                    ."\",\n    \"complement\": \"\",\n    \"district\": \"".$district
                    ."\",\n    \"city\": \"".$city
                    ."\",\n    \"state\": \"".$state
                    ."\"\n  },\n  \"contact\": {\n    \"phone\": \"".$phone
                    ."\",\n    \"email\": \"".$email
                    ."\"\n  },\n  \"partners\": [\n    {\n      \"document\": \"".$cnpj_livre
                    ."\",\n      \"nameOrCompanyName\": \"".$name_livre
                    ."\",\n      \"typeLink\": \"string\",\n      \"ownershipPercentage\": 0\n    }\n  ]\n}";
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://apihlg-topazio.sensedia.com/cli/v1/basic-customers");
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
                $result_query['message'] = $parsed_response->errors->values[0]->error[0];
                $result_query['code_error'] = 2004;
            }
        }
        
        return $result_query;
    }
    
    public function topazio_loans($id, $API_token){
        /*if($_SESSION['logged_role'] !== 'ADMIN'){ //segurança
            return;            
        }*/
        $this->load->model('class/system_config');
        $this->load->model('class/transaction_model');
        //$this->load->model('class/transactions_status');
        $this->load->model('class/tax_model');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $client_id = $GLOBALS['sistem_config']->CLIENT_ID_TOPAZIO;                        
        $transaction = $this->transaction_model->get_client('id', $id)[0];
        $date_contract = $this->transaction_model->get_last_date_signature($id);
        $financials = $this->calculating_enconomical_values($transaction["amount_solicited"]/100, $transaction["number_plots"]);
        
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
            return ['success' => false, 'code_error' => 3001,'message' => 'Impossivel calcular proximo dia util com API de Topazio'];
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
        //var_dump($fields); 
        //return;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://apihlg-topazio.sensedia.com/emd/v1/loans");
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
            //echo $response_loans['ccb']." ".$response_loans['contract_id']." ".$total_value;
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

    public function get_field($money_str){
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
    }

    public function topazio_emprestimo($id) {// recebe id da transacao        
        /*if($_SESSION['logged_role'] !== 'ADMIN'){
            return;            
        }*/
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
    
    public function get_transaction_datas_by_id(){
        $_SESSION['transaction_requested_id'] = -1;
        if($_SESSION['logged_role'] === 'ADMIN'){
            $datas = $this->input->post();
            $result['message'] = 'Transação não encontrada';
            $result['success']=false;
            foreach ($_SESSION['affiliate_logged_transactions'] as $transactions){
                if($transactions['client_id'] == $datas['id']){
                    $_SESSION['transaction_requested_id'] = $datas['id'];
                    $_SESSION['transaction_requested_datas'] = $transactions;
                    $result['message'] = $transactions;
                    $result['success']=true;
                    break;
                }
            }
        }
        echo json_encode($result);        
    }

    public function topazio_conciliations($date){
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $client_id = $GLOBALS['sistem_config']->CLIENT_ID_TOPAZIO;        
        $API_token = $this->get_topazio_API_token();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://apihlg-topazio.sensedia.com/emd/v1/conciliations/".$date);
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
        curl_setopt($ch, CURLOPT_URL, "http://apihlg-topazio.sensedia.com/wd/v1/workdays/".$date);
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
        curl_setopt($ch, CURLOPT_URL, "http://apihlg-topazio.sensedia.com/chk/v1/restrictions/".$document);
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
                return null;
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
        
        $financials = $this->calculating_enconomical_values($transaction["amount_solicited"]/100, $transaction["number_plots"]);
        
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
        $date = date("Y-m-d",time());
        print_r("<br><br>----------  INIT CONCILIATION AT ".date('Y-m-d H:i:s'),time());
        $transactions = $this->topazio_conciliations($date);
        if($transactions->success){
            foreach ($transactions->data as $transaction) {
                var_dump($transaction);
                if($transaction->ccbNumber){
                    $livre_tr = $this->affiliate_model->load_transaction_by_ccbNumber($transaction->ccbNumber);
                    switch ($transaction->statusCode) {
                        case 2000: //TOPAZIO - "EM PROCESSAMENTO"
                            /* não devemos fazer nada, porque esa transacción ya esta en el status de livre TOPAZIO_IN_ANALISYS*/
                            break;
                         case 2400: //TOPAZIO - "AGUARDANDO FUNDING"
                            /* não devemos fazer nada, até esperar que a transação mude para outro status*/
                            break;
                        case 2100: //TOPAZIO - "CANCELADA"
                            //1. enviar para PENDING
                            $this->load->model('class/transactions_status');
                            $this->load->model('class/transaction_model');
                            $this->transaction_model->update_transaction_status(
                                $livre_tr['client_id'],
                                transactions_status::PENDING);
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
                                if($this->request_new_account())
                                    print_r("<br><br>Nova conta pedida automaticamente com sucesso");
                            } else{
                                print_r("<br><br>NEW REASON CODE TO 2300 ERROR");
                            }
                            break;
                        case 2500: //TOPAZIO - "PAGA CONFIRMADA"
                            //TODO: email com dinheiro enviado
                            break;
                    }
                }
            }
        }else{
            /*$administrators_emails = array("josergm86@gmail.com","jorge85.mail@gmail.com","pedro@livre.digital");
            foreach ($administrators_emails as $useremail) {
                $this->Gmail->send_mail($useremail, $useremail, 'Impossivel fazer conciliação com Topazio', "Impossivel fazer conciliação com Topazio devido a que a requicisao de esta respondendo success = false");
            }*/
        }
        print_r("<br><br>----------  END CONCILIATION AT ".date('Y-m-d H:i:s'),time());
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
        $date = date("Y-m-d",time());
        print_r("<br><br>----------  INIT CHEKING CONTRACTS AT ".date('Y-m-d H:i:s'),time());
       
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
                    print_r("<br><br>Contrato assinado por ".$transaction[email]);
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
            sleep(15*60);
        }while(true);
        
        //print_r("<br><br>----------  END CHEKING CONTRACTS AT ".date('Y-m-d H:i:s'),time());
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
    
    public function calculating_enconomical_values($valor_solicitado, $num_parcelas){
        $this->load->model('class/tax_model');
        $B11 = number_format($valor_solicitado, 2, '.', '');
        $B16 = $num_parcelas;
        $B10 = ( $this->tax_model->get_tax_row($B16)[$this->get_field($B11)] )/100;
        $num_days = 30*($num_parcelas-1) + 10;
        $B20 = 0.1;
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
            'TAC_API' => number_format($total_cust - $B8 , 2, '.', '') 
            );
        return $result;
    }
    
}
