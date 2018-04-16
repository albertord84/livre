<?php

class Welcome extends CI_Controller {
    
    //-------SHOW VIEWS FUNCTIONS--------------------------------
    public function test() {
       echo md5('Marcos*01+');
    }
    
    public function md() {
        echo md5('Marcos*01+');
    }
    
    public function index() {
        $this->load->view('index');
    }
    
    public function checkout() {
        $datas = $this->input->get();
        if($this->verify_simulation($datas)['success'])
            $this->load->view('checkout');
        else
            $this->load->view('index');
    }
        
    public function configuracoes() {
        $this->load->view('configuracoes');
    }
    
    public function resumo() {
        $this->load->view('resumo');
    }
    
    public function transacoes() {
        $this->load->view('transacoes');
    }
    
    
    //-------PRINCIPALS FUNCTIONS--------------------------------
    public function is_possible_steep_1_for_this_client($datas) {
        $this->load->model('class/client_model');
        $this->load->model('class/client_status');
        //1. Analisar se IP tem sido marcado como hacker ou se nome, cpf, email e telefone aparecem desde mais de três IPs
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
            $result['message']='Error IP: Sua solicitação foi negada. Por favor, contate nosso atendimento';
            $result['success']=false;
            return $result;
        }
        //2. Analisar coerencia dos dados, exemplo:
            //2.1 mesmo cpf com nome diferentes
        $clients = $this->client_model->get_client('cpf',$datas['cpf']);
        $nomes=array();
        $nomes[$datas['name']]=1;
        foreach ($clients as $client) {
            if(isset($nomes[$client['name']]))
                $nomes[$client['name']]+=1;
            else
                $nomes[$client['name']]=1;
        }
        if(count($nomes)>1){
            $result['message']='Sua solicitação foi negada devido a que seu CPF tem sido usado com outro nome. Por favor, contate nosso atendimento';
            $result['success']=false;
            return $result;
        }
            //2.2 mesmo telefone com nome diferentes
        $clients = $this->client_model->get_client('phone_number',$datas['phone_number']);
        $nomes=array();
        foreach ($clients as $client) {
            if(isset($nomes[$client['name']]))
                $nomes[$client['name']]+=1;
            else
                $nomes[$client['name']]=1;
        }
        if(count($nomes)>1){
            $result['message']='Sua solicitação foi negada devido a que seu telefone tem sido usado com outros nomes. Por favor, contate nosso atendimento';
            $result['success']=false;
            return $result;
        }
            //2.3 mesmo telefone com diferentes cpf
        $cpfs=array();
        foreach($clients as $client) {
            if(isset($cpfs[$client['cpf']]))
                $cpfs[$client['cpf']]+=1;
            else
                $cpfs[$client['cpf']]=1;
        }
        if(count($cpfs)>1){
            $result['message']='Sua solicitação foi negada devido a que seu telefone tem sido usado com outros nomes. Por favor, contate nosso atendimento';
            $result['success']=false;
            return $result;
        }
        
        //3. Analisar pedidos em aberto (OPEN) pelo nome, cpf, email e telefone e nao permitir nemhum em aberto
        /*$clients = $this->client_model->get_client('cpf', $datas['cpf'], client_status::OPEN);
        if(count($clients)>0){
            $result['message']='Solicitação não permitida devido que o CPF informado tem outro pedido ativo';
            $result['success']=false;
            return $result;
        }
        $clients = $this->client_model->get_client('name', $datas['name'], client_status::OPEN);
        if(count($clients)>0){
            $result['message']='Solicitação não permitida devido que o nome informado tem outro pedido ativo';
            $result['success']=false;
            return $result;
        }
        $clients = $this->client_model->get_client('email', $datas['email'], client_status::OPEN);
        if(count($clients)>0){
            $result['message']='Solicitação não permitida devido que o email informado tem outro pedido ativo';
            $result['success']=false;
            return $result;
        }
        $clients = $this->client_model->get_client('phone_number', $datas['phone_number'], client_status::OPEN);
        if(count($clients)>0){
            $result['message']='Solicitação não permitida devido que o telefone informado tem outro pedido ativo';
            $result['success']=false;
            return $result;
        }
        
        //4. Analisar pedidos em (PENDING) pelo nome, cpf, email e telefone e nao permitir nemhum em aberto
        $clients = $this->client_model->get_client('cpf', $datas['cpf'], client_status::PENDING);
        if(count($clients)>0){
            $result['message']='Solicitação não permitida devido que o CPF informado tem outro pedido pendente';
            $result['success']=false;
            return $result;
        }
        $clients = $this->client_model->get_client('name', $datas['name'], client_status::PENDING);
        if(count($clients)>0){
            $result['message']='Solicitação não permitida devido que o nome informado tem outro pedido pendente';
            $result['success']=false;
            return $result;
        }
        $clients = $this->client_model->get_client('email', $datas['email'], client_status::PENDING);
        if(count($clients)>0){
            $result['message']='Solicitação não permitida devido que o email informado tem outro pedido pendente';
            $result['success']=false;
            return $result;
        }
        $clients = $this->client_model->get_client('phone_number', $datas['phone_number'], client_status::PENDING);
        if(count($clients)>0){
            $result['message']='Solicitação não permitida devido que o telefone informado tem outro pedido pendente';
            $result['success']=false;
            return $result;
        }*/
                
        //5. Analisar BEGINNER purchase_counter pelo cpf
        $clients = $this->client_model->get_client('cpf', $datas['cpf'], client_status::BEGINNER);
        if(count($clients)>1){ //caso imposivel, so por inconsistencia no sistema, po puede haber más de um beginner com o mesmo CPF
            $result['message']='Solicitação não permitida devido a inconsistência no sistema. Informe ao nossso atendimento';
            $result['success']=false;
            return $result;
        } 
        if(count($clients)==0){
            $result['action']='insert_beginner';
            $result['success']=true;
            return $result;
        }        
        if(count($clients)==1){
            if($client[0]['purchase_counter']<=$MAX_PURCHASE_TENTATIVES){
                $result['id'] = $clients[0]['id'];
                $result['success']=true;
                $result['action']='update_beginner';
                return $result;
            }else{
                $result['message']='Não autorizado. Quantidade máxima de tentativas alcanzadas. Contate nosso atendimento';
                $result['success']=false;
                return $result;
            }
        }
    }
            
    public function insert_datas_steep_1(){
        $this->load->model('class/client_model');
        $datas = $this->input->post();
        $datas['HTTP_SERVER_VARS'] = json_encode($_SERVER);        
        if(!$this->validate_all_general_user_datas($datas)){
            $result['success'] = false;
            $result['message'] = 'Erro nos dados fornecidos';
        } else{
            $possible = $this->is_possible_steep_1_for_this_client($datas);
            if($possible['success']){
                $datas['init_date']= time();
                if($possible['action']==='insert_beginner'){
                    $datas['status_id']=  client_status::BEGINNER;
                    $id_row = $this->client_model->insert_db_steep_1($datas);
                }
                else
                    $id_row = $this->client_model->update_db_steep_1($datas,$possible['id']);
                if($id_row){
                    $result['success'] = true;
                    $result['pk'] = $id_row;//$this->codify($id_row);
                }
                else{
                    $result['success'] = false;
                    $result['message'] = 'Erro interno no banco de dados';
                }
            } else{
                $result=$possible;
            }
        }
        echo json_encode($result);
    }
        
    public function is_possible_steep_2_for_this_client($datas) {
        $this->load->model('class/client_model');
        
        //0. Conferindo CPFs do passo 1 e passo 2
        $client = $this->client_model->get_client('id', $datas['pk']);
        if($datas['cpf']!==$client['cpf']){
            $result['message']='Operação não permitida. O CPF informado não coincide com o do Passo 1';
            $result['success']=false;
            return $result;
        }
        
        //1. Analisar cartões bloqueados e nomes de hackers
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
                
        //2. Analisar se número de cartão está sendo usado em uma operação em aberto (acho que não é preciso)
        //3. Ver incoerencias entre numero do cartão, cvv, e nome do cliente
            //3.1 Avaliando incoerencias entre credit_card_number e cpf
        $credit_cards = $this->client_model->get_credit_card('credit_card_number', $datas['credit_card_number']);
        $cpfs=array();
        $cpfs[$datas['cpf']]=1;
        foreach ($credit_cards as $credit_card) {
            if(isset($cpfs[$credit_card['cpf']]))
                $cpfs[$credit_card['cpf']]+=1;
            else
                $cpfs[$credit_card['cpf']]=1;
        }
        if(count($cpfs)>1){
            $result['message']='Sua solicitação foi negada.<BR> Foi detetada uma incoerencia entre o número do cartão e o CPF. Por favor, contate nosso atendimento';
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
            $result['message']='Sua solicitação foi negada.<BR> Foi detetada uma incoerencia entre o número e o nome do cartão. Por favor, contate nosso atendimento';
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
            $result['message']='Sua solicitação foi negada.<BR> Foi detetada uma incoerencia entre o número e o nome do cartão. Por favor, contate nosso atendimento';
            $result['success']=false;
            return $result;
        }
        
        //4. Analisar se é para atualizar ou inserir nova linha
        $credit_cards = $this->client_model->get_credit_card('client_id', $datas['pk']);
        if(count($credit_cards)){
            $result['action']='update_credit_card';
            $result['id']=$credit_cards[0]['id'];
            $result['success']=true;
            return $result;            
        } else{
            $result['action']='insert_credit_card';
            $result['success']=true;
            return $result;
        }
        
    }
    
    public function insert_datas_steep_2() {
        $this->load->model('class/client_model');
        $datas = $this->input->post();
        $datas['pk'] = $this->decodify($datas['pk']);
        if(!$this->validate_all_credit_card_datas($datas)){
            $result['success'] = false;
            $result['message'] = 'Erro nos dados fornecidos';
        } else{
            $possible = $this->is_possible_steep_2_for_this_client($datas);
            if($possible['success']){
                if($possible['action']==='insert_credit_card'){
                    $id_row = $this->client_model->insert_db_steep_2($datas);
                }
                else
                    $id_row = $this->client_model->update_db_steep_2($datas,$possible['id']);
                if($id_row){
                    $result['success'] = true;
                }
                else{
                    $result['success'] = false;
                    $result['message'] = 'Erro interno no banco de dados';
                }
            } else{
                $result=$possible;
            }
        }
        echo json_encode($result);
    }
    
    public function is_possible_steep_3_for_this_client($datas) {
        $this->load->model('class/client_model');
        $this->load->model('class/client_status');
        
        //0. Conferindo CPFs do passo 1 e passo 3
        $client = $this->client_model->get_client('id', $datas['pk']);
    
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
        $all_accounts = $this->client_model->get_account_banks($datas['bank'],$datas['agency'],$datas['account']);
        $names=array();
        $names[$datas['titular_name']]=1;
        foreach($all_accounts as $acc){
            if(isset($names[$acc['titular_name']]))
                $names[$acc['titular_name']]+=1;
            else
                $names[$acc['titular_name']]=1;
        }
        if(count($names)>1){
            $result['message']='Solicitação negada. A conta informada tem sido atrelada a outo cliente anteriormente';
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
            $result['message']='Solicitação negada. A conta informada tem sido atrelada a outo cpf anteriormente';
            $result['success']=false;
            return $result;
        }
        
        //3. Ver se a conta informada esta sendo usada em outra transação em ACTIVE
       /*$account_banks = $this->client_model->get_account_banks($datas['bank'], $datas['agency'], $datas['account']);        
        foreach ($account_banks as $acc) {
            $client = $this->client_model->get_client('id',$acc['client_id']);
            if($client[0]['status_id']===client_status::OPEN || $client[0]['status_id']===client_status::PENDING){
                $result['message']='Sua solicitação foi negada. A conta bancária informada está sendo usada em outro empréstimo anterior ';
                $result['success']=false;
                return $result;                
            }
        }*/
        
        //4. Analisar se é para atualizar ou inserir nova linha
        $account_bank = $this->client_model->get_account_bank_by_client_id($datas['pk']);
        if(count($account_bank)===1){
            $result['action']='update_account_bank';
            $result['id']=$account_bank[0]['id'];
            $result['success']=true;
            return $result;
        } else{
            $result['action']='insert_account_bank';
            $result['success']=true;
            return $result;
        }
    }
    
    public function insert_datas_steep_3() {
        $this->load->model('class/client_model');
        $datas = $this->input->post();
        $verify_simulation = $this->verify_simulation($datas);
        if(!$this->validate_bank_datas($datas)){
            $result['success'] = false;
            $result['message'] = 'Erro nos dados bancários fornecidos';
        } else
            {
                $possible = $this->is_possible_steep_3_for_this_client($datas);
                if($possible['success'] && $verify_simulation['success']){
                    if($possible['action']==='insert_account_bank')
                        $id_row = $this->client_model->insert_db_steep_3($datas);                    
                    else
                        $id_row = $this->client_model->update_db_steep_3($datas,$possible['id']);
                    if($id_row){
                        
                        
                        
                        $result['success'] = true;
                        $result['total_cust_value'] =(string) $verify_simulation['total_cust_value'];
                        $result['month_value'] =(string) $verify_simulation['month_value'];
                        $result['permited_value'] = (string)$verify_simulation['permited_value'];
                        $result['amount_months'] = (string)$datas['amount_months'];
                        $result['limit_value'] = (string)$datas['limit_value'];
                    }
                    else{
                        $result['success'] = false;
                        $result['message'] = 'Erro interno no banco de dados';
                    }
                } else{
                    $result=$possible;
                }
            }
        echo json_encode($result);
    }
    
    public function insert_datas_steep_4() {
        $result['success'] = true;
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
        if(($datas['amount_months']>=6 && $datas['amount_months']<=12)){
            if($datas['solicited_value']>=500 && $datas['solicited_value']<=3000){
                $taxas=array(6=>40.63, 7=>47.65, 8=>55.01, 9=>62.75, 10=>70.87, 11=>79.40, 12=>88.35);
                $result['total_cust_value'] = $datas['solicited_value'] + 
                        ($datas['solicited_value']* $taxas[$datas['amount_months']]/100);
                $result['month_value'] = $result['total_cust_value']/$datas['amount_months'];                
                $result['total_cust_value']=sprintf("%.2f", $result['total_cust_value']);
                $result['month_value']=sprintf("%.2f", $result['month_value']);                
                $result['success'] = true;                
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
    
    public function message() {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/creditsociety/application/libraries/Gmail.php';        
        $this->Gmail = new Gmail();        
        $datas = $this->input->post();
        $result = $this->Gmail->send_client_contact_form($datas['name'], $datas['email'], $datas['message']);
        if ($result['success'])
            $result['message'] = 'Mensagem enviada. Agradecemos seu contato!!';
        else             
            $result['message'] = 'Falha evinvando mensagem. Tente depois.';
        echo json_encode($result);
    }
    
    
    //-------AUXILIAR FUNCTIONS----------------------------------
    
    public function generate_contract($client_id) {        
        require_once $_SERVER['DOCUMENT_ROOT'] . '/livre/contrat/fpdf/fpdf.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/livre/contrat/contrato.php';
        $pdf = new PDF('P','mm','A4');
        $this->load->model('class/client_model');
        $this->load->model('class/client_status');        
        $datas = $this->client_model->get_all_client_datas_by_id($client_id);
        $pdf ->GenerateContrat($datas,false,true,false);
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
        /*
        $this->load->model('class/crypt');
        $a=$this->crypt->codify('Jose Ramon Glez 07367014196  (21)965913089');
        echo $a[0].'<br>';
        $b=$this->crypt->decodify($a);
        echo $b.'<br>';
        */
        return $str;
    }
    
    public function get_bank_by_code($code){        
        $banks=array(
            '001'=>'BANCO DO BRASIL',
            '104'=>'CAIXA ECONÔMICA FEDERAL',
            '033'=>'BCO SANTANDER (BRASIL) S.A.',
            '389'=>'BCO MERCANTIL DO BRASIL S.A.',
            '745'=>'CITIBANK S.A.',
            '477'=>'CITIBANK N.A.',
            '069'=>'BCO CREFISA S.A.',
            '318'=>'BCO BMG S.A.',
            '184'=>'BANCO ITAÚ BBA S.A.',
            '479'=>'BANCO ITAÚ BANK S.A.',
            '652'=>'ITAÚ UNIBANCO HOLDING S.A.',
            '341'=>'ITAÚ UNIBANCO BM S.A.',
            '237'=>'BCO BRADESCO S.A.',
            '036'=>'BANCO BRADESCO BBI S.A.',
            '204'=>'BANCO BRADESCO CARTÕES S.A.',
            '394'=>'BANCO BRADESCO FINANCIAMENTOS S.A',
            '122'=>'BANCO BRADESCO BERJ S.A.',
            '070'=>'BANCO DE BRASILIA S.A.',
            '735'=>'BANCO NEON S.A.',
            '077'=>'BANCO INTERMEDIUM S.A.',
            '741'=>'BCO RIBEIRAO PRETO S.A.',
            '739'=>'BANCO CETELEM S.A.',
            '743'=>'BANCO SEMEAR',
            '394'=>'BCO BRADESCO FINANC. S.A.',
            '747'=>'BCO RABOBANK INTL BRASIL S.A.',
            '748'=>'BCO COOPERATIVO SICREDI S.A.',
            '399'=>'KIRTON BANK',
            '757'=>'BCO KEB HANA DO BRASIL S.A.',
            '084'=>'UNIPRIME NORTE DO PARANÁ',
            '062'=>'HIPERCARD BM S.A.',
            '074'=>'BCO. J.SAFRA S.A.',
            '099'=>'UNIPRIME CENTRAL CCC LTDA.',
            '025'=>'BCO ALFA S.A.',
            '040'=>'BCO CARGILL S.A.',
            '063'=>'BANCO BRADESCARD',
            '003'=>'BCO DA AMAZONIA S.A.',
            '097'=>'CCC NOROESTE BRASILEIRO LTDA.',
            '037'=>'BCO DO EST. DO PA S.A.',
            '085'=>'CCC URBANO',
            '114'=>'CENTRAL CECM ESP. SANTO',
            '036'=>'BCO BBI S.A.',
            '004'=>'BCO DO NORDESTE DO BRASIL S.A.',
            '320'=>'BCO CCB BRASIL S.A.',
            '079'=>'BCO ORIGINAL DO AGRO S.A.',
            '133'=>'CONFEDERACAO NAC DAS CCC SOL',
            '121'=>'BCO AGIPLAN S.A.',
            '083'=>'BCO DA CHINA BRASIL S.A.',
            '094'=>'BANCO FINAXIS',
            '047'=>'BCO DO EST. DE SE S.A.',
            '254'=>'PARANA BCO S.A.',
            '107'=>'BCO BBM S.A.',
            '412'=>'BCO CAPITAL S.A.',
            '124'=>'BCO WOORI BANK DO BRASIL S.A.',
            '634'=>'BCO TRIANGULO S.A.',
            '132'=>'ICBC DO BRASIL BM S.A.',
            '163'=>'COMMERZBANK BRASIL S.A. BCO MÚLTIPLO',
            '021'=>'BCO BANESTES S.A.',
            '246'=>'BCO ABC BRASIL S.A.',
            '751'=>'SCOTIABANK BRASIL',
            '746'=>'BCO MODAL S.A.',
            '241'=>'BCO CLASSICO S.A.',
            '612'=>'BCO GUANABARA S.A.',
            '604'=>'BCO INDUSTRIAL DO BRASIL S.A.',
            '505'=>'BCO CREDIT SUISSE (BRL) S.A.',
            '300'=>'BCO LA NACION ARGENTINA',
            '266'=>'BCO CEDULA S.A.',
            '376'=>'BCO J.P. MORGAN S.A.',
            '263'=>'BCO CACIQUE S.A.',
            '473'=>'BCO CAIXA GERAL BRASIL S.A.',
            '120'=>'BCO RODOBENS S.A.',
            '248'=>'BCO BOAVISTA INTERATLANTICO S.A.',
            '265'=>'BCO FATOR S.A.',
            '719'=>'BANIF BRASIL BM S.A.',
            '243'=>'BCO MÁXIMA S.A.',
            '125'=>'BRASIL PLURAL S.A. BCO.',
            '065'=>'BANCO ANDBANK (BRASIL) S.A.',
            '250'=>'BCV – Banco de Crédito e Varejo',
            '494'=>'BCO REP ORIENTAL URUGUAY BCE',
            '018'=>'BCO TRICURY S.A.',
            '422'=>'BCO SAFRA S.A.',
            '224'=>'BCO FIBRA S.A.',
            '600'=>'BCO LUSO BRASILEIRO S.A.',
            '623'=>'BANCO PAN',
            '655'=>'BCO VOTORANTIM S.A.',
            '464'=>'BCO SUMITOMO MITSUI BRASIL S.A.',
            '237'=>'BCO BRADESCO S.A.',
            '613'=>'BCO PECUNIA S.A.',
            '637'=>'BCO SOFISA S.A.',
            '653'=>'BCO INDUSVAL S.A.',
            '249'=>'BANCO INVESTCRED UNIBANCO S.A.',
            '318'=>'BCO BMG S.A.',
            '626'=>'BCO FICSA S.A.',
            '366'=>'BCO SOCIETE GENERALE BRASIL',
            '611'=>'BCO PAULISTA S.A.',
            '755'=>'BOFA MERRILL LYNCH BM S.A.',
            '089'=>'CCR REG MOGIANA',
            '643'=>'BCO PINE S.A.',
            '707'=>'BCO DAYCOVAL S.A',
            '487'=>'DEUTSCHE BANK S.A. BCO ALEMAO',
            '233'=>'BANCO CIFRA',
            '633'=>'BCO RENDIMENTO S.A.',
            '218'=>'BANCO BONSUCESSO S.A.',
            '090'=>'CCCM SICOOB UNIMAIS',
            '753'=>'NOVO BCO CONTINENTAL S.A.',
            '222'=>'BCO CRÉDIT AGRICOLE BR S.A.',
            '098'=>'CREDIALIANÇA CCR',
            '610'=>'BCO VR S.A.',
            '010'=>'CREDICOAMO',
            '217'=>'BANCO JOHN DEERE S.A.',
            '041'=>'BCO DO ESTADO DO RS S.A.',
            '654'=>'BCO A.J. RENNER S.A.',
            '212'=>'BANCO ORIGINAL'
            );
        return $banks[$code];
    }
    
}
