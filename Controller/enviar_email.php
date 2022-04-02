<?php

	require "../bibliotecas/PHPMailer/Exception.php";
	require "../bibliotecas/PHPMailer/OAuth.php";
	require "../bibliotecas/PHPMailer/PHPMailer.php";
	require "../bibliotecas/PHPMailer/POP3.php";
	require "../bibliotecas/PHPMailer/SMTP.php";

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	//print_r($_POST);

	class Mensagem {
		private $para = null;
		private $assunto = null;
		private $mensagem = null;
		public $status = array( 'codigo_status' => null, 'descricao_status' => '' );

		public function __get($atributo) {
			return $this->$atributo;
		}

		public function __set($atributo, $valor) {
			$this->$atributo = $valor;
		}

        public function enviarEmail() {
            
            $mail = new PHPMailer(true);
            
            try {
                //Server settings
                $mail->SMTPDebug = false;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'recuperarEmailHelpDesk@gmail.com';                     //SMTP username
                $mail->Password   = '@UtLcE96S';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
                //Recipients
                $mail->setFrom('recuperarEmailHelpDesk@gmail.com', 'FaceLine');
                $mail->addAddress($this->__get('para'));     //Add a recipient
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');
    
                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = $this->__get('assunto');
                $mail->Body    = $this->__get('mensagem');
                $mail->AltBody = 'É necessario utilizar um client que suporte HTML para ter acesso total ao conteúdo dessa mensagem';
    
                $mail->send();
    
                $this->status['codigo_status'] = 1;
                $this->status['descricao_status'] = 'E-mail enviado com sucesso';
    
            } catch (Exception $e) {
                
                $this->status['codigo_status'] = 2;
                $this->status['descricao_status'] = 'Não foi possivel enviar este e-mail! Por favor tente novamente mais tarde. Detalhes do erro: ' . $mail->ErrorInfo;
            }
            
        }
	}
	
?>

