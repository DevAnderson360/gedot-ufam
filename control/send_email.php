<?php 

	// Import PHPMailer classes into the global namespace
	// These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	// Load Composer's autoloader
	require 'vendor/autoload.php';

	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);
	
	try {	
		// Configurações do servidor
	    $mail->isSMTP();        //Define o uso de SMTP no envio
	    $mail->SMTPAuth = true; //Habilita a autenticação SMTP

	    $mail->Username   = 'nogueirasilverio@gmail.com'; //conta de email
    	$mail->Password   = 'gm637689';//senha

    	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged

    	// Criptografia do envio SSL também é aceito
    	$mail->SMTPSecure = 'tls';

    	$mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)

    	// Informações específicadas pelo Google
	    $mail->Host = 'smtp.gmail.com';
	    $mail->Port = 587;

	    // Define o remetente
    	$mail->setFrom('nogueirasilverio@gmail.com', 'Anderson Nogueira Silvério.');

    	// Define o destinatário
    	$mail->addAddress('anderson_nsilverio@hotmail.com', 'Destinatário');

    	$mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
	    $mail->Subject = 'Assunto'; //Assunto
	    $mail->Body    = $_POST['msg']; //corpo da mensagem
	    $mail->AltBody = 'Este é o corpo da mensagem para clientes de e-mail que não reconhecem HTML'; //

	    // Enviar
	    $mail->send();

		echo 'A mensagem foi enviada!';

	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";	
	}