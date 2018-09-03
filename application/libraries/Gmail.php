<?php
    //This example shows settings to use when sending via Google's Gmail servers.
    //SMTP needs accurate times, and the PHP time zone MUST be set
    //This should be done in your php.ini, but this is how to do it if you don't have access to that
    date_default_timezone_set('Etc/UTC');
    require_once $_SERVER['DOCUMENT_ROOT'] . '/livre/application/libraries/PHPMailer-master/PHPMailerAutoload.php';
    class Gmail {
        protected $mail = NULL;
        
        public function __construct() {
            //Create a new PHPMailer instance
            $this->mail = new \PHPMailer;
            //Tell PHPMailer to use SMTP
            $this->mail->isSMTP();
            //Enable SMTP debugging
            // 0 = off (for production use)
            // 1 = client messages
            // 2 = client and server messages
            $this->mail->SMTPDebug = 0;
            //Ask for HTML-friendly debug output
            $this->mail->Debugoutput = 'html';
            //Set the hostname of the mail server
            $this->mail->Host = 'smtp.gmail.com'; // dumbu.system
            
            // use
            // $mail->Host = gethostbyname('smtp.gmail.com');
            // if your network does not support SMTP over IPv6
            //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
            $this->mail->Port = 587; // dumbu.system
            //Set the encryption system to use - ssl (deprecated) or tls
            $this->mail->SMTPSecure = 'tls'; // dumbu.system
            //Whether to use SMTP authentication
            $this->mail->SMTPAuth = true; // dumbu.system
            //Username to use for SMTP authentication - use full email address for gmail
            $this->mail->Username = $GLOBALS['sistem_config']->SYSTEM_USER_LOGIN;//'josergm86';
            //Password to use for SMTP authentication
            $this->mail->Password = $GLOBALS['sistem_config']->SYSTEM_USER_PASS;//'78578122522624666';
            //Set who the message is to be sent from
            //$this->mail->setFrom('josergm86@gmail.com', 'CreditSociety');
            $this->mail->setFrom($GLOBALS['sistem_config']->SYSTEM_EMAIL, 'Livre.digital');
        }
        
        public function send_mail($useremail, $username, $subject, $mail) {
            $this->mail->clearAddresses();
            $this->mail->addAddress($useremail, $username);
            $this->mail->clearCCs();
            $this->mail->Subject = $subject;
            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            $username = urlencode($username);
            //$instaname = urlencode($instaname);
            //$instapass = urlencode($instapass);
            //$this->mail->msgHTML(file_get_contents("http://localhost/follows/src/resources/emails/login_error.php?username=$username&instaname=$instaname&instapass=$instapass"), dirname(__FILE__));
            //echo "http://" . $_SERVER['SERVER_NAME'] . "<br><br>";
            $lang = $GLOBALS['sistem_config']->LANGUAGE;
            $this->mail->Body = $mail;
            //Attach an image file
            //$mail->addAttachment('images/phpmailer_mini.png');
            //send the message, check for errors
            if (!$this->mail->send()) {
                $result['success'] = false;
                $result['message'] = "Mailer Error: " . $this->mail->ErrorInfo;
            } else {
                $result['success'] = true;
                $result['message'] = "Message sent!" . $this->mail->ErrorInfo;
            }
            $this->mail->smtpClose();
            return $result;
        }
       
        public function send_client_contact_form($username, $useremail, $usermsg) {
            $this->mail->clearAddresses();
            $this->mail->addCC($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->clearReplyTos();
            $this->mail->addReplyTo($useremail, $username);
            //Set the subject line
            $this->mail->Subject = "User Contact: $username";
            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            $username = urlencode($username);
            $usermsg  = urlencode($usermsg);
            $file = "http://".$_SERVER['SERVER_NAME'] . "/livre/resources/emails/contact_form.php?username=$username&useremail=$useremail&userphone=$userphone&usermsg=$usermsg";
            //echo $file;
            $a=file_get_contents($file);
            $this->mail->msgHTML(file_get_contents($file), dirname(__FILE__));
            //Replace the plain text body with one created manually
            $this->mail->AltBody = "User Contact: $username";            
            if (!$this->mail->send()) {
                $result['success'] = false;
                $result['message'] = "Mailer Error: " . $this->mail->ErrorInfo;
            } else {
                $result['success'] = true;
                $result['message'] = "Message sent!" . $this->mail->ErrorInfo;
            }
            $this->mail->smtpClose();
            return $result;
        }
        
        public function transaction_email_approved($name, $useremail) {
            $this->mail->clearAddresses();
            $this->mail->addAddress($useremail, $name);
            $this->mail->clearCCs();
            $this->mail->addCC($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->addReplyTo($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->Subject = 'Aprovado! - Livre.digital';
            $this->mail->CharSet = 'UTF-8';
            $name = urlencode($name);           
            $lang = $GLOBALS['sistem_config']->LANGUAGE;
            $this->mail->msgHTML(@file_get_contents("http://" . $_SERVER['SERVER_NAME'] . "/livre/resources/emails/email-aprovado.php?name=$name"), dirname(__FILE__));
            if (!$this->mail->send()) {
                $result['success'] = false;
                $result['message'] = "Mailer Error: " . $this->mail->ErrorInfo;
            } else {
                $result['success'] = true;
                $result['message'] = "Message sent!" . $this->mail->ErrorInfo;
            }
            $this->mail->smtpClose();
            return $result;
        }
        
        public function transaction_request_new_photos($name, $useremail,$link) {
            $this->mail->clearAddresses();
            $this->mail->addAddress($useremail, $name);
            $this->mail->clearCCs();
            $this->mail->addCC($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->addReplyTo($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->Subject = 'Suas fotos não foram aprovadas - Livre.digital';            
            $this->mail->CharSet = 'UTF-8';
            $this->mail->SMTPSecure = 'ssl';
            $this->mail->SMTPAuth = true;
            $this->mail->Port = 465;
            $this->mail->Body = "Hello";
            $name = urlencode($name);
            $lang = $GLOBALS['sistem_config']->LANGUAGE;
            //$this->mail->msgHTML(@file_get_contents("https://" . $_SERVER['SERVER_NAME'] . "/livre/resources/emails/email-fotos-recusadas.php?name=$name&link=$link"), dirname(__FILE__));
            if (!$this->mail->send()) {
                $result['success'] = false;
                $result['message'] = "Mailer Error: " . $this->mail->ErrorInfo;
            } else {
                $result['success'] = true;
                $result['message'] = "Message sent!" . $this->mail->ErrorInfo;
            }
            $this->mail->smtpClose();
            return $result;
        }
        
        public function transaction_request_new_account_bank($name, $useremail,$link) {
            $this->mail->clearAddresses();
            $this->mail->addAddress($useremail, $name);
            $this->mail->clearCCs();
            $this->mail->addCC($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->addReplyTo($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->Subject = 'Atualize seus dados bancários - Livre.digital';
            $this->mail->CharSet = 'UTF-8';
            $name = urlencode($name);
            $lang = $GLOBALS['sistem_config']->LANGUAGE;
            $this->mail->msgHTML(@file_get_contents("http://" . $_SERVER['SERVER_NAME'] . "/livre/resources/emails/email-dados-bancarios.php?name=$name&link=$link"), dirname(__FILE__));
            if (!$this->mail->send()) {
                $result['success'] = false;
                $result['message'] = "Mailer Error: " . $this->mail->ErrorInfo;
            } else {
                $result['success'] = true;
                $result['message'] = "Message sent!" . $this->mail->ErrorInfo;
            }
            $this->mail->smtpClose();
            return $result;
        }
        
        public function transaction_request_new_sing_us($name, $useremail,$link) {
            $this->mail->clearAddresses();
            $this->mail->addAddress($useremail, $name);
            $this->mail->clearCCs();
            $this->mail->addCC($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->addReplyTo($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->Subject = 'Envie sua assinatura - Livre.digital';
            $this->mail->CharSet = 'UTF-8';
            $name = urlencode($name);
            $lang = $GLOBALS['sistem_config']->LANGUAGE;
            $this->mail->msgHTML(@file_get_contents("http://" . $_SERVER['SERVER_NAME'] . "/livre/resources/emails/email-nova-assinatura_easy.php?name=$name&link=$link"), dirname(__FILE__));
            if (!$this->mail->send()) {
                $result['success'] = false;
                $result['message'] = "Mailer Error: " . $this->mail->ErrorInfo;
            } else {
                $result['success'] = true;
                $result['message'] = "Message sent!" . $this->mail->ErrorInfo;
            }
            $this->mail->smtpClose();
            return $result;
        }
        
        public function transaction_request_recused($name,$useremail) {
            $this->mail->clearAddresses();
            $this->mail->addAddress($useremail, $name);
            $this->mail->clearCCs();
            $this->mail->addCC($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->addReplyTo($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->Subject = 'Solicitação cancelada - Livre.digital';
            $this->mail->CharSet = 'UTF-8';
            $name = urlencode($name);
            $lang = $GLOBALS['sistem_config']->LANGUAGE;
            $this->mail->msgHTML(@file_get_contents("http://" . $_SERVER['SERVER_NAME'] . "/livre/resources/emails/email-cancelada.php?name=$name"), dirname(__FILE__));
            if (!$this->mail->send()) {
                $result['success'] = false;
                $result['message'] = "Mailer Error: " . $this->mail->ErrorInfo;
            } else {
                $result['success'] = true;
                $result['message'] = "Message sent!" . $this->mail->ErrorInfo;
            }
            $this->mail->smtpClose();
            return $result;
        }
        
        public function credit_card_recused($name,$useremail) {
            $this->mail->clearAddresses();
            $this->mail->addAddress($useremail, $name);
            $this->mail->clearCCs();
            $this->mail->addCC($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->addReplyTo($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->Subject = 'Pedido negado - Livre.digital';
            $this->mail->CharSet = 'UTF-8';
            $name = urlencode($name);
            $lang = $GLOBALS['sistem_config']->LANGUAGE;
            $this->mail->msgHTML(@file_get_contents("http://" . $_SERVER['SERVER_NAME'] . "/livre/resources/emails/email-negado.php?name=$name"), dirname(__FILE__));
            if (!$this->mail->send()) {
                $result['success'] = false;
                $result['message'] = "Mailer Error: " . $this->mail->ErrorInfo;
            } else {
                $result['success'] = true;
                $result['message'] = "Message sent!" . $this->mail->ErrorInfo;
            }
            $this->mail->smtpClose();
            return $result;
        }
        
        public function transaction_email_almost($name, $useremail) {
            $this->mail->clearAddresses();
            $this->mail->addAddress($useremail, $name);
            $this->mail->clearCCs();
            $this->mail->addCC($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->addReplyTo($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->Subject = 'Dados enviados com sucesso! - Livre.digital';
            $this->mail->CharSet = 'UTF-8';
            $name = urlencode($name);           
            $lang = $GLOBALS['sistem_config']->LANGUAGE;
            $this->mail->msgHTML(@file_get_contents("http://" . $_SERVER['SERVER_NAME'] . "/livre/resources/emails/email-almost.php?name=$name"), dirname(__FILE__));
            if (!$this->mail->send()) {
                $result['success'] = false;
                $result['message'] = "Mailer Error: " . $this->mail->ErrorInfo;
            } else {
                $result['success'] = true;
                $result['message'] = "Message sent!" . $this->mail->ErrorInfo;
            }
            $this->mail->smtpClose();
            return $result;
        }
        
        public function transaction_email_trans_in_process($name, $useremail) {
            $this->mail->clearAddresses();
            $this->mail->addAddress($useremail, $name);
            $this->mail->clearCCs();
            $this->mail->addCC($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->addReplyTo($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->Subject = 'Falta pouco! Seus dados foram aprovados! - Livre.digital';
            $this->mail->CharSet = 'UTF-8';
            $name = urlencode($name);           
            $lang = $GLOBALS['sistem_config']->LANGUAGE;
            $this->mail->msgHTML(@file_get_contents("http://" . $_SERVER['SERVER_NAME'] . "/livre/resources/emails/email-in_process.php?name=$name"), dirname(__FILE__));
            if (!$this->mail->send()) {
                $result['success'] = false;
                $result['message'] = "Mailer Error: " . $this->mail->ErrorInfo;
            } else {
                $result['success'] = true;
                $result['message'] = "Message sent!" . $this->mail->ErrorInfo;
            }
            $this->mail->smtpClose();
            return $result;
        }
        
        public function transaction_email_conclua($name, $useremail) {
            $this->mail->clearAddresses();
            $this->mail->addAddress($useremail, $name);
            $this->mail->clearCCs();
            $this->mail->addCC($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->addReplyTo($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->Subject = 'Conclua seu cadastro - Livre.digital';
            $this->mail->CharSet = 'UTF-8';
            $name = urlencode($name);           
            $lang = $GLOBALS['sistem_config']->LANGUAGE;
            $this->mail->msgHTML(@file_get_contents("http://" . $_SERVER['SERVER_NAME'] . "/livre/resources/emails/email-conclua.php?name=$name"), dirname(__FILE__));
            if (!$this->mail->send()) {
                $result['success'] = false;
                $result['message'] = "Mailer Error: " . $this->mail->ErrorInfo;
            } else {
                $result['success'] = true;
                $result['message'] = "Message sent!" . $this->mail->ErrorInfo;
            }
            $this->mail->smtpClose();
            return $result;
        }
        
        public function transaction_email_ainda_precisa($name, $useremail) {
            $this->mail->clearAddresses();
            $this->mail->addAddress($useremail, $name);
            $this->mail->clearCCs();
            $this->mail->addCC($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->addReplyTo($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->Subject = 'Ainda precisa do crédito solicitado? - Livre.digital';
            $this->mail->CharSet = 'UTF-8';
            $name = urlencode($name);           
            $lang = $GLOBALS['sistem_config']->LANGUAGE;
            $this->mail->msgHTML(@file_get_contents("http://" . $_SERVER['SERVER_NAME'] . "/livre/resources/emails/email-ainda_precisa.php?name=$name"), dirname(__FILE__));
            if (!$this->mail->send()) {
                $result['success'] = false;
                $result['message'] = "Mailer Error: " . $this->mail->ErrorInfo;
            } else {
                $result['success'] = true;
                $result['message'] = "Message sent!" . $this->mail->ErrorInfo;
            }
            $this->mail->smtpClose();
            return $result;
        }
        
        public function credor_ccb($name, $useremail,$ccb) {
            $this->mail->clearAddresses();
            $this->mail->addAddress($useremail, $name);
            $this->mail->clearCCs();
            $this->mail->addCC($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->addReplyTo($GLOBALS['sistem_config']->ATENDENT_EMAIL, $GLOBALS['sistem_config']->ATENDENT_USER_LOGIN);
            $this->mail->Subject = 'Informação sobre sua transação - Livre.digital';            
            $this->mail->CharSet = 'UTF-8';
            $name = urlencode($name);
            $ccb = urlencode($ccb);
            $lang = $GLOBALS['sistem_config']->LANGUAGE;
            $this->mail->msgHTML(@file_get_contents("http://" . $_SERVER['SERVER_NAME'] . "/livre/resources/emails/credor-ccb.php?name=$name&ccb=$ccb"), dirname(__FILE__));
            if (!$this->mail->send()) {
                $result['success'] = false;
                $result['message'] = "Mailer Error: " . $this->mail->ErrorInfo;
            } else {
                $result['success'] = true;
                $result['message'] = "Message sent!" . $this->mail->ErrorInfo;
            }
            $this->mail->smtpClose();
            return $result;
        }
                
    }
