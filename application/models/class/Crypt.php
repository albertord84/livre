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
?>
