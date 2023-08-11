<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class GonderIleti extends Controller
{
    
    /*
     ----.ENV Dosyasındaki Mail Gönderim Bilgileri İcin Açıklamalar ----

     MAIL_MAILER: E-posta sürücüsü. SMTP kullanacaksanız, "smtp" olarak ayarlanmalıdır.
     MAIL_HOST: E-posta sunucu adresi.
     MAIL_PORT: E-posta sunucu bağlantı portu.
     MAIL_USERNAME: E-posta hesabı kullanıcı adı.
     MAIL_PASSWORD: E-posta hesabı parolası.
     MAIL_ENCRYPTION: Güvenli bağlantı türü (tls veya ssl).
     MAIL_FROM_ADDRESS: Gönderici e-posta adresi.
     MAIL_FROM_NAME: Gönderici adı.
    */
    public function MsjGonder(){
        // PHPMailer nesnesi
        $mail = new PHPMailer(true);

      try{
            // SMTP bağlantı ayarları
            $mail->SMTPDebug = 0; // SMTP hata ayıklama seviyesi (0, 1, 2 veya 3)
            $mail->isSMTP();
            $mail->Host       = 'mail.proder.com.tr'; // E-posta sunucu adresi
            $mail->SMTPAuth   = true;
            $mail->Username   ='noreply@proder.com.tr'; // E-posta hesabı kullanıcı adı
            $mail->Password   ='GxfkRyTG8C'; // E-posta hesabı parolası
            $mail->SMTPSecure = 'tls'; // Güvenli bağlantı türü (tls veya ssl)
            $mail->Port       = 587; // E-posta sunucu bağlantı portu

            // Gönderici bilgileri
            $mail->setFrom('noreply@proder.com.tr','proder');
            
            // Alıcı bilgileri
            $mail->addAddress('samet@proder.com.tr', 'stemizer');

             // e-postaya dosya ekle
             $attachmentPath = 'C:\Users\Hp\Desktop\composer.png';
             $mail->addAttachment($attachmentPath);// yöntemi, e-postaya dosya eklemek için kullanılır. Bu yöntem, iki parametre alır:


             //$dosya_yolu = 'dosya_yolu/dosya_adı.pdf';
             /*
              PHP'nin masaüstündeki dosyalara erişimi doğrudan yoktur. web sunucu üzerinde çalışan bir PHP uygulamanız
              varsa, masaüstündeki dosyayı öncelikle web sunucusuna yüklenmeli.
             */
            // $dosya_adi = 'dosya_adı.pdf';
            // $mail->addAttachment($dosya_yolu, $dosya_adi);//Dosya eklerken addAttachment() yöntemine dosyanın yolu belirtilmeli.

            // E-posta içeriği
            $mail->isHTML(true);
            $mail->Subject = 'PHP & LARAVEL';
            $mail->Body    = 'MAİL işlemleri';
            $mail->AltBody = 'PRODER yazılım';

            $mail->send();
            return "E-posta başarıyla gönderildi!";
       }
      catch(Exception $e){
        return response()->json(['success' => false, 'Message' => $e->getMessage()], 500);
       }
    }
}
