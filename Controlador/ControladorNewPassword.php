<?php
class ControladorNewPassword {
    private $modelo;

    public function __construct() {
        require_once 'Modelo/ModeloUsuario.php';
        $this->modelo = new ModeloUsuario();
    }

    public function mostrarFormulario() {
        require_once 'Vista/VistaNewPassword.php';
    }

    public function procesarSolicitud() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message = [
                    'type' => 'error',
                    'text' => 'Por favor, ingresa un correo electrónico válido.'
                ];
                require_once 'Vista/VistaNewPassword.php';
                return;
            }

            // Verificar si el email existe en la base de datos
            if ($this->modelo->verificarEmail($email)) {
                // Generar token único
                $token = bin2hex(random_bytes(32));
                $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));
                
                // Guardar token en la base de datos
                if ($this->modelo->guardarTokenRecuperacion($email, $token, $expira)) {
                    // Enviar email con el enlace de recuperación
                    $this->enviarEmailRecuperacion($email, $token);
                    
                    $message = [
                        'type' => 'success',
                        'text' => 'Se ha enviado un enlace de recuperación a tu correo electrónico.'
                    ];
                } else {
                    $message = [
                        'type' => 'error',
                        'text' => 'Ha ocurrido un error al procesar tu solicitud.'
                    ];
                }
            } else {
                $message = [
                    'type' => 'error',
                    'text' => 'No existe una cuenta asociada a este correo electrónico.'
                ];
            }
            
            require_once 'Vista/VistaNewPassword.php';
        }
    }

    private function enviarEmailRecuperacion($email, $token) {
        $to = $email;
        $subject = "Recuperación de Contraseña";
        $resetLink = "http://" . $_SERVER['HTTP_HOST'] . "/ProjectaRapidgo/?action=resetPassword&token=" . $token;
        
        $message = "
        <html>
        <head>
            <title>Recuperación de Contraseña</title>
        </head>
        <body>
            <h2>Recuperación de Contraseña</h2>
            <p>Has solicitado recuperar tu contraseña. Haz clic en el siguiente enlace para restablecerla:</p>
            <p><a href='$resetLink'>Restablecer Contraseña</a></p>
            <p>Este enlace expirará en 1 hora.</p>
            <p>Si no solicitaste este cambio, por favor ignora este mensaje.</p>
        </body>
        </html>
        ";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: noreply@tuempresa.com' . "\r\n";

        mail($to, $subject, $message, $headers);
    }
}
?> 