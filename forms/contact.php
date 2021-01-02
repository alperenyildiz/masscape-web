<?php

class fnc
{
  public function sendResult($success, $message = '', $records = null)
  {
    $result = array(
      'success' => $success,
      'message' => $message,
      'records' => $records
    );
    echo json_encode($result);
    die();
  }
}

$FNC = new fnc();

function filter($value)
{
  $One = trim($value);
  $Two = strip_tags($One);
  $Three = htmlspecialchars($Two, ENT_QUOTES);
  $result = $Three;
  return $result;
}


$kullanici_mail    = isset($_POST['email']) ? filter($_POST['email']) : null;
$kullanici_adsoyad = isset($_POST['name']) ? filter($_POST['name']) : null;
$konu              = isset($_POST['subject']) ? filter($_POST['subject']) : null;
$mesaj             = isset($_POST['message']) ? filter($_POST['message']) : null;

$to = 'sebati.dn@gmail.com';
$subject = $konu;
$message =  $mesaj;
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=utf-8';
$headers[] = 'From: ' . $kullanici_adsoyad . '<' . $kullanici_mail . '>';
$send = mail($to, $subject, $message, implode("\r\n", $headers));
if ($send) {
  $FNC->sendResult(true, 'Mailiniz iletildi. Ekibimiz en kısa sürede dönüş sağlayacaktır');
} else {
  $FNC->sendResult(false, 'Mail gönderme hata!');
}
