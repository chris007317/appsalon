<?php 
	namespace Classes;
	use PHPMailer\PHPMailer\PHPMailer;

	class Email{

		public $email;
		public $nombre;
		public $token;

		public function __Construct($email, $nombre, $token){
			$this->email = $email;
			$this->nombre = $nombre;
			$this->token = $token;
		}

		public function enviarConfirmacion(){
			// Crear el objeto de Email
			$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->Host = 'sandbox.smtp.mailtrap.io';
			$mail->SMTPAuth = true;
			$mail->Port = 2525;
			$mail->Username = '437b1d027d8bb7';
			$mail->Password = 'ecc7d2a0aa4945';
			
			$mail->setFrom('admin@appsalon.com');
			$mail->addAddress('admin@bappsalon.com', 'AppSalon.com');
			$mail->Subject = 'Confirma tu cuenta';
			// Set HTML
			$mail->isHTML(true);
			$mail->CharSet = 'UTF-8';
			$contenido = "<html>";
			$contenido .= "<p><strong>Hola ".$this->nombre."</strong> has cerado tu cuenta en App Salon, solo debes confirmarla presionando sobre el siguiente enlace</p>";
			$contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar-cuenta?token=".$this->token."'>Confirmar cuenta</a></p>";
			$contenido .= "<p>Si tú no solicitaste está cuenta puedes ignorar este mensaje</p>";
			$contenido .= "</html>";
			$mail->Body = $contenido;
			// Enviar el email
			$mail->send();
		}

		public function enviarInstricuciones(){
		// Crear el objeto de Email
			$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->Host = 'sandbox.smtp.mailtrap.io';
			$mail->SMTPAuth = true;
			$mail->Port = 2525;
			$mail->Username = '437b1d027d8bb7';
			$mail->Password = 'ecc7d2a0aa4945';
			$mail->setFrom('admin@appsalon.com');
			$mail->addAddress('admin@bappsalon.com', 'AppSalon.com');
			$mail->Subject = 'Reestablece tu contraseña';
			// Set HTML
			$mail->isHTML(true);
			$mail->CharSet = 'UTF-8';
			$contenido = "<html>";
			$contenido .= "<p><strong>Hola ".$this->nombre."</strong> has solicitado reestablecer tu contraseña</p>";
			$contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/recuperar?token=".$this->token."'>Restablecer contraseña</a></p>";
			$contenido .= "<p>Si tú no solicitaste está cuenta puedes ignorar este mensaje</p>";
			$contenido .= "</html>";
			$mail->Body = $contenido;
			// Enviar el email
			$mail->send();	
		}
	}