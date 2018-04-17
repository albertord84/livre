<?php

    //This example shows settings to use when sending via Google's Gmail servers.
    //SMTP needs accurate times, and the PHP time zone MUST be set
    //This should be done in your php.ini, but this is how to do it if you don't have access to that
    date_default_timezone_set('Etc/UTC');
    require_once ($_SERVER['DOCUMENT_ROOT']."/livre/application/libraries/PHPMailer-master/PHPMailerAutoload.php");

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
            $this->mail->Username = 'josergm86';

            //Password to use for SMTP authentication
            $this->mail->Password = '78578122522624666';

            //Set who the message is to be sent from
            $this->mail->setFrom('josergm86@gmail.com', 'LivreDigital');
        }

       
        public function send_client_contact_form($username, $useremail, $usermsg) {
            $this->mail->clearAddresses();
            $this->mail->addCC('josergm86@gmail.com', 'josergm86@gmail.com');

            $this->mail->clearReplyTos();
            $this->mail->addReplyTo($useremail, $username);

            //Set the subject line
            $this->mail->Subject = "User Contact: $username";

            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            $username = urlencode($username);
            $usermsg  = urlencode($usermsg);
            $file = "http://".$_SERVER['SERVER_NAME'] . "/livre/resources/emails/contact_form.php?username=$username&useremail=$useremail&usermsg=$usermsg";
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
    }
