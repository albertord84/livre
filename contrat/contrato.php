<?php

//echo 'sasdfddddd';
require_once('contrat/fpdf/fpdf.php');
//require_once $_SERVER['DOCUMENT_ROOT'] . '/dumbu/worker/libraries/PHPMailer-master/PHPMailerAutoload.php';

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        //$this->SetFillColor(145,145,145);
        //$this->Rect(0,0,150,20,'F');
        // Logo
       // $this->Image('assets/images/logo.png',60,8,0,0,'PNG','www.dumbu.pro');
        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 2 cm del final
        $this->SetY(-20);
        // Arial bold 10
        $this->SetFont('Arial','B',10);
        $this->SetTextColor(128,128,128);
        $this->Cell(0,10,'www.dumbu.pro',0,1,'C',false,'www.dumbu.pro');
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        $this->SetTextColor(0,0,0);
        // Número de página
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');        
    }
    
    function GenerateContrat($datas=NULL,$show=false,$save=false,$force_download=false){
        /*
        'cpf: 07367014196
        'name: JOSE RAMON GONZALEZ MONTERO
        'email: josergm86@gmail.com
        'phone_ddd: 21
        'phone_number: 965913089
        'cep: 24020206
        'street_address: SAO JOAO
        'number_address: 223
        'complement_number_address: 302
        'city_address: NITEROI
        'state_address: RJ

        'credit_card_name: JOSE RAMON GONZALEZ MONTERO
        'credit_card_number: 2147483647
        'credit_card_exp_month: 1
        'credit_card_exp_year: 2020
        'credit_card_cvv: 123
        'credit_card_status: 1

        'bank: 001
        'agency: 4459
        'account: 125490
        'account_type: CC
        'dig: 12
        'titular_name: JOSE RAMON GONZALEZ MONTERO
        'titular_cpf: 07367014196
        */
        
        $this->AliasNbPages();
        $this->AddPage();
        //$this->Image('assets/images/sim.png',65);
        // Arial bold 15
        $this->SetFont('Arial','B',16);
        $this->SetTextColor(0,128,0);
        // Título
        $this->Cell(0,20,'Pagamento aprovado!',0,1,'C');
        $this->SetFont('Times','',12);
        $this->SetTextColor(0,0,0);
        $this->Cell(0,10,'Seu pagamento para a conta @nome_do_usuario',0,1,'C');
        $this->Cell(0,0,'foi feito com sucesso. :)',0,1,'C');
        $this->Ln(10);
        $this->SetFont('Times','B',12);
        $this->Cell(0,10,utf8_decode('Dados da cobrança:'),0,1,'C');
        $this->SetFont('Times','',12);
        $this->Cell(0,10,utf8_decode('JOSE R OLIVEIRA - CARTÃO ****3598'),0,1,'C');
        $this->Cell(0,10,'fulano@gmail.com',0,1,'C');
        $this->Ln(10);
        $this->Cell(0,10,'25/11/2017 - R$ 79,90 - (Vel. Moderada) - Trans.#9632',1,1,'C');
        $this->Ln(30);
        $this->Cell(0,10,utf8_decode('Se tiver dúvidas ou precisar de ajuda é só nos escrever:'),0,1,'C');
        $this->Cell(0,0,'atendimento@dumbu.pro',0,1,'C');
        $this->Ln(10);
        if($show){
            $this->Output('I','invoice.pdf');
            $this->SetDisplayMode(75);        
        }
        if($save){
            $this->Output('F',$_SERVER['DOCUMENT_ROOT'] . '/livre/contrat/invoice.pdf');
        }
        if($force_download){
            $this->Output('D','invoice.pdf');
        }
        
    }
    
}



// Creación del objeto de la clase heredada
//$pdf = new PDF('P','mm','A4');
//$pdf->AliasNbPages();
//$pdf->AddPage();
////$pdf->Image('assets/images/sim.png',65);
//// Arial bold 15
//$pdf->SetFont('Arial','B',16);
//$pdf->SetTextColor(0,128,0);
//// Título
//$pdf->Cell(0,20,'Pagamento aprovado!',0,1,'C');
//$pdf->SetFont('Times','',12);
//$pdf->SetTextColor(0,0,0);
//$pdf->Cell(0,10,'Seu pagamento para a conta @nome_do_usuario',0,1,'C');
//$pdf->Cell(0,0,'foi feito com sucesso. :)',0,1,'C');
//$pdf->Ln(10);
//$pdf->SetFont('Times','B',12);
//$pdf->Cell(0,10,utf8_decode('Dados da cobrança:'),0,1,'C');
//$pdf->SetFont('Times','',12);
//$pdf->Cell(0,10,utf8_decode('JOSE R OLIVEIRA - CARTÃO ****3598'),0,1,'C');
//$pdf->Cell(0,10,'fulano@gmail.com',0,1,'C');
//$pdf->Ln(10);
//$pdf->Cell(0,10,'25/11/2017 - R$ 79,90 - (Vel. Moderada) - Trans.#9632',1,1,'C');
//$pdf->Ln(30);
//$pdf->Cell(0,10,utf8_decode('Se tiver dúvidas ou precisar de ajuda é só nos escrever:'),0,1,'C');
//$pdf->Cell(0,0,'atendimento@dumbu.pro',0,1,'C');
//$pdf->Ln(10);
//$pdf->Output('I','invoice.pdf');
//$pdf->SetDisplayMode(75);


?>

