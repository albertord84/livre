<?php
    
    class Crypt extends CI_Model {
            
        public  function __construct() {
            parent::__construct();            
        }
        
        public function crypt($str_plane){
            $seed = "mi chicho lindo";
            $key_number = md5($seed);
            $cipher = "aes-256-ctr";
            $tag = 'GCM';
            $ivlen = openssl_cipher_iv_length($cipher);
            $iv = openssl_random_pseudo_bytes($ivlen);
            $str = openssl_encrypt ($str_plane, $cipher, $key_number,$options=0, '1234567812345678');
            return base64_encode($str);
        }
         
        public function decrypt($str_encrypted){
            $seed = "mi chicho lindo";
            $key_number = md5($seed);
            $cipher = "aes-256-ctr";
            $tag = 'GCM';
            $ivlen = openssl_cipher_iv_length($cipher);
            $iv = openssl_random_pseudo_bytes($ivlen);
            $str_encrypted= base64_decode($str_encrypted);
            $str = openssl_decrypt ($str_encrypted, $cipher, $key_number,$options=0, '1234567812345678');
            return $str;
        }
        
        public function get_bank_by_code($code){        
            $banks=array(
                '117'=>'ADVANCED CC LTDA',
                '172'=>'ALBATROSS CCV S.A',
                '188'=>'ATIVA S.A. INVESTIMENTOS CCTVM',
                '280'=>'AVISTA S.A. CFI',
                '80'=>'B&T CC LTDA.',
                '63'=>'BANCO BRADESCARD',
                '208'=>'BANCO BTG PACTUAL S.A.',
                '233'=>'BANCO CIFRA',
                '94'=>'BANCO FINAXIS',
                '12'=>'BANCO INBURSA',
                '77'=>'BANCO INTER',
                '249'=>'BANCO INVESTCRED UNIBANCO S.A.',
                '29'=>'BANCO ITAÚ CONSIGNADO S.A.',
                '217'=>'BANCO JOHN DEERE S.A.',
                '212'=>'BANCO ORIGINAL',
                '623'=>'BANCO PAN',
                '743'=>'BANCO SEMEAR',
                '754'=>'BANCO SISTEMA',
                '82'=>'BANCO TOPÁZIO S.A.',
                '756'=>'BANCOOB',
                '268'=>'BARIGUI CH',
                '81'=>'BBN BCO BRASILEIRO DE NEGOCIOS S.A.',
                '654'=>'BCO A.J. RENNER S.A.',
                '246'=>'BCO ABC BRASIL S.A.',
                '75'=>'BCO ABN AMRO S.A.',
                '121'=>'BCO AGIBANK S.A.',
                '25'=>'BCO ALFA S.A.',
                '641'=>'BCO ALVORADA S.A.',
                '65'=>'BCO ANDBANK S.A.',
                '213'=>'BCO ARBI S.A.',
                '96'=>'BCO B3 S.A.',
                '24'=>'BCO BANDEPE S.A.',
                '21'=>'BCO BANESTES S.A.',
                '36'=>'BCO BBI S.A.',
                '318'=>'BCO BMG S.A.',
                '752'=>'BCO BNP PARIBAS BRASIL S A',
                '107'=>'BCO BOCOM BBM S.A.',
                '122'=>'BCO BRADESCO BERJ S.A.',
                '204'=>'BCO BRADESCO CARTOES S.A.',
                '394'=>'BCO BRADESCO FINANC. S.A.',
                '237'=>'BCO BRADESCO S.A.',
                '218'=>'BCO BS2 S.A.',
                '473'=>'BCO CAIXA GERAL BRASIL S.A.',
                '412'=>'BCO CAPITAL S.A.',
                '40'=>'BCO CARGILL S.A.',
                '320'=>'BCO CCB BRASIL S.A.',
                '266'=>'BCO CEDULA S.A.',
                '739'=>'BCO CETELEM S.A.',
                '745'=>'BCO CITIBANK S.A.',
                '241'=>'BCO CLASSICO S.A.',
                '95'=>'BCO CONFIDENCE DE CÂMBIO S.A.',
                '748'=>'BCO COOPERATIVO SICREDI S.A.',
                '222'=>'BCO CRÉDIT AGRICOLE BR S.A.',
                '505'=>'BCO CREDIT SUISSE (BRL) S.A.',
                '69'=>'BCO CREFISA S.A.',
                '3'=>'BCO DA AMAZONIA S.A.',
                '83'=>'BCO DA CHINA BRASIL S.A.',
                '707'=>'BCO DAYCOVAL S.A',
                '1'=>'BCO DO BRASIL S.A.',
                '47'=>'BCO DO EST. DE SE S.A.',
                '37'=>'BCO DO EST. DO PA S.A.',
                '41'=>'BCO DO ESTADO DO RS S.A.',
                '4'=>'BCO DO NORDESTE DO BRASIL S.A.',
                '265'=>'BCO FATOR S.A.',
                '224'=>'BCO FIBRA S.A.',
                '626'=>'BCO FICSA S.A.',
                '612'=>'BCO GUANABARA S.A.',
                '604'=>'BCO INDUSTRIAL DO BRASIL S.A.',
                '653'=>'BCO INDUSVAL S.A.',
                '630'=>'BCO INTERCAP S.A.',
                '184'=>'BCO ITAÚ BBA S.A.',
                '479'=>'BCO ITAUBANK S.A.',
                '376'=>'BCO J.P. MORGAN S.A.',
                '76'=>'BCO KDB BRASIL S.A.',
                '757'=>'BCO KEB HANA DO BRASIL S.A.',
                '300'=>'BCO LA NACION ARGENTINA',
                '495'=>'BCO LA PROVINCIA B AIRES BCE',
                '600'=>'BCO LUSO BRASILEIRO S.A.',
                '243'=>'BCO MÁXIMA S.A.',
                '389'=>'BCO MERCANTIL DO BRASIL S.A.',
                '370'=>'BCO MIZUHO S.A.',
                '746'=>'BCO MODAL S.A.',
                '66'=>'BCO MORGAN STANLEY S.A.',
                '456'=>'BCO MUFG BRASIL S.A.',
                '169'=>'BCO OLÉ BONSUCESSO CONSIGNADO S.A.',
                '79'=>'BCO ORIGINAL DO AGRO S/A',
                '712'=>'BCO OURINVEST S.A.',
                '611'=>'BCO PAULISTA S.A.',
                '643'=>'BCO PINE S.A.',
                '747'=>'BCO RABOBANK INTL BRASIL S.A.',
                '633'=>'BCO RENDIMENTO S.A.',
                '494'=>'BCO REP ORIENTAL URUGUAY BCE',
                '741'=>'BCO RIBEIRAO PRETO S.A.',
                '120'=>'BCO RODOBENS S.A.',
                '422'=>'BCO SAFRA S.A.',
                '33'=>'BCO SANTANDER (BRASIL) S.A.',
                '366'=>'BCO SOCIETE GENERALE BRASIL',
                '637'=>'BCO SOFISA S.A.',
                '464'=>'BCO SUMITOMO MITSUI BRASIL S.A.',
                '634'=>'BCO TRIANGULO S.A.',
                '18'=>'BCO TRICURY S.A.',
                '655'=>'BCO VOTORANTIM S.A.',
                '610'=>'BCO VR S.A.',
                '119'=>'BCO WESTERN UNION',
                '124'=>'BCO WOORI BANK DO BRASIL S.A.',
                '74'=>'BCO. J.SAFRA S.A.',
                '250'=>'BCV',
                '144'=>'BEXS BCO DE CAMBIO S.A.',
                '253'=>'BEXS CC S.A.',
                '134'=>'BGC LIQUIDEZ DTVM LTDA',
                '7'=>'BNDES',
                '17'=>'BNY MELLON BCO S.A.',
                '755'=>'BOFA MERRILL LYNCH BM S.A.',
                '126'=>'BR PARTNERS BI',
                '125'=>'BRASIL PLURAL S.A. BCO.',
                '70'=>'BRB - BCO DE BRASILIA S.A.',
                '92'=>'BRK S.A. CFI',
                '173'=>'BRL TRUST DTVM SA',
                '142'=>'BROKER BRASIL CC LTDA.',
                '11'=>'C.SUISSE HEDGING-GRIFFO CV S/A',
                '104'=>'CAIXA ECONOMICA FEDERAL',
                '288'=>'CAROL DTVM LTDA.',
                '130'=>'CARUANA SCFI',
                '159'=>'CASA CREDITO S.A. SCM',
                '97'=>'CCC NOROESTE BRASILEIRO LTDA.',
                '91'=>'CCCM UNICRED CENTRAL RS',
                '16'=>'CCM DESP TRÂNS SC E RS',
                '279'=>'CCR DE PRIMAVERA DO LESTE',
                '273'=>'CCR DE SÃO MIGUEL DO OESTE',
                '89'=>'CCR REG MOGIANA',
                '114'=>'CENTRAL COOPERATIVA DE CRÉDITO NO ESTADO DO ESPÍRITO SANTO',
                '477'=>'CITIBANK N.A.',
                '180'=>'CM CAPITAL MARKETS CCTVM LTDA',
                '127'=>'CODEPE CVC S.A.',
                '163'=>'COMMERZBANK BRASIL S.A. - BCO MÚLTIPLO',
                '136'=>'CONF NAC COOP CENTRAIS UNICRED',
                '60'=>'CONFIDENCE CC S.A.',
                '85'=>'COOP CENTRAL AILOS',
                '98'=>'CREDIALIANÇA CCR',
                '10'=>'CREDICOAMO',
                '133'=>'CRESOL CONFEDERAÇÃO',
                '182'=>'DACASA FINANCEIRA S/A - SCFI',
                '487'=>'DEUTSCHE BANK S.A.BCO ALEMAO',
                '140'=>'EASYNVEST - TÍTULO CV SA',
                '149'=>'FACTA S.A. CFI',
                '196'=>'FAIR CC S.A.',
                '278'=>'GENIAL INVESTIMENTOS CVM S.A.',
                '138'=>'GET MONEY CC LTDA',
                '64'=>'GOLDMAN SACHS DO BRASIL BM S.A',
                '177'=>'GUIDE',
                '146'=>'GUITTA CC LTDA',
                '78'=>'HAITONG BI DO BRASIL S.A.',
                '62'=>'HIPERCARD BM S.A.',
                '189'=>'HS FINANCEIRA',
                '269'=>'HSBC BANCO DE INVESTIMENTO',
                '271'=>'IB CCTVM LTDA',
                '157'=>'ICAP DO BRASIL CTVM LTDA.',
                '132'=>'ICBC DO BRASIL BM S.A.',
                '492'=>'ING BANK N.V.',
                '139'=>'INTESA SANPAOLO BRASIL S.A. BM',
                '341'=>'ITAÚ UNIBANCO BM S.A.',
                '652'=>'ITAÚ UNIBANCO HOLDING BM S.A.',
                '488'=>'JPMORGAN CHASE BANK',
                '399'=>'KIRTON BANK',
                '105'=>'LECCA CFI S.A.',
                '145'=>'LEVYCAM CCV LTDA',
                '113'=>'MAGLIANO S.A. CCVM',
                '128'=>'MS BANK S.A. BCO DE CÂMBIO',
                '137'=>'MULTIMONEY CC LTDA.',
                '14'=>'NATIXIS BRASIL S.A. BM',
                '191'=>'NOVA FUTURA CTVM LTDA.',
                '753'=>'NOVO BCO CONTINENTAL S.A. - BM',
                '260'=>'NU PAGAMENTOS S.A.',
                '111'=>'OLIVEIRA TRUST DTVM S.A.',
                '613'=>'OMNI BANCO S.A.',
                '254'=>'PARANA BCO S.A.',
                '194'=>'PARMETAL DTVM LTDA',
                '174'=>'PERNAMBUCANAS FINANC S.A. CFI',
                '100'=>'PLANNER CV S.A.',
                '93'=>'PÓLOCRED SCMEPP LTDA.',
                '108'=>'PORTOCRED S.A. - CFI',
                '283'=>'RB CAPITAL INVESTIMENTOS DTVM LTDA.',
                '101'=>'RENASCENCA DTVM LTDA',
                '751'=>'SCOTIABANK BRASIL',
                '276'=>'SENFF S.A. - CFI',
                '545'=>'SENSO CCVM S.A.',
                '190'=>'SERVICOOP',
                '183'=>'SOCRED S.A. SCM',
                '118'=>'STANDARD CHARTERED BI S.A.',
                '197'=>'STONE PAGAMENTOS S.A.',
                '143'=>'TREVISO CC S.A.',
                '131'=>'TULLETT PREBON BRASIL CVC LTDA',
                '129'=>'UBS BRASIL BI S.A.',
                '15'=>'UBS BRASIL CCTVM S.A.',
                '99'=>'UNIPRIME CENTRAL CCC LTDA.',
                '84'=>'UNIPRIME NORTE DO PARANÁ - CC',
                '102'=>'XP INVESTIMENTOS CCTVM S/A'
            );
            return $banks[$code];
        }
          
    }
?>
