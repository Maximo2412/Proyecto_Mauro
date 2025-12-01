<?php
$OWNER_EMAIL = "tu_correo@dominio.com";
$SITE_NAME   = "Mi Sitio Web";

function txt($v){ return trim(filter_var($v, FILTER_SANITIZE_SPECIAL_CHARS)); }
function mail_sanitize($v){ return trim(filter_var($v, FILTER_SANITIZE_EMAIL)); }

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: contacto.html?err='.urlencode('Método no permitido'));
  exit;
}

if (!empty($_POST['website'])) { // honeypot
  header('Location: contacto.html?ok=1');
  exit;
}

$nombre  = txt($_POST['nombre'] ?? '');
$email   = mail_sanitize($_POST['email'] ?? '');
$mensaje = txt($_POST['mensaje'] ?? '');

if (!$nombre || !$email || !$mensaje || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
  header('Location: contacto.html?err='.urlencode('Completá todos los campos con datos válidos'));
  exit;
}

$subject = "Nuevo mensaje desde $SITE_NAME";
$body = "Nombre: $nombre\nEmail: $email\n\nMensaje:\n$mensaje\n\nEnviado: ".date('Y-m-d H:i:s');

$headers = [];
$headers[] = "From: $SITE_NAME <no-reply@".$_SERVER['SERVER_NAME'].">";
$headers[] = "Reply-To: $nombre <$email>";
$headers[] = "X-Mailer: PHP/".phpversion();

if (@mail($OWNER_EMAIL, $subject, $body, implode("\r\n", $headers))) {
  header('Location: contacto.html?ok=1');
  exit;
}

/* === SMTP con PHPMailer (recomendado) ===
require __DIR__ . '/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

try {
  $mail = new PHPMailer(true);
  $mail->isSMTP();
  $mail->Host       = 'smtp.gmail.com';
  $mail->SMTPAuth   = true;
  $mail->Username   = 'tu_usuario@gmail.com';
  $mail->Password   = 'TU_APP_PASSWORD';
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port       = 587;

  $mail->setFrom('no-reply@tudominio.com', $SITE_NAME);
  $mail->addAddress($OWNER_EMAIL);
  $mail->addReplyTo($email, $nombre);

  $mail->Subject = $subject;
  $mail->Body    = $body;

  $mail->send();
  header('Location: contacto.html?ok=1');
  exit;

} catch (Exception $e) {
  header('Location: contacto.html?err='.urlencode('Error SMTP: '.$mail->ErrorInfo));
  exit;
}
*/

header('Location: contacto.html?err='.urlencode('No se pudo enviar. Configurá SMTP (recomendado).'));
