<?php 
/*
PHP mailer nedir?
PHP programlama dili ile hazırlanmış yazılımlarda kullanılabilen, bir email adresine mail göndermek için sizin belirlediğiniz bağlantı bilgileriyle mail sunucusu ile haberleşerek uygun ortamı hazırlayan bir PHP sınıfıdır.
PHP programlama dilinin standart mail gönderme fonksiyonu olan mail() fonksiyonu günümüzde tüm paylaşımlı hosting servislerinde -spam mail gönderimini önlemek amacıyla-  engelli durumdadır. 

Ancak, bu sunucu üzerinden mail gönderilemeyeceği anlamına gelmemektedir.
 Alternatif olarak, sunucu ile SMTP protokolü aracılığıyla haberleşen ve sunucu üzerinde kimlik doğrulama yapan bir mailer script kullanılabilir. PHPMailer, bu ihtiyacı en iyi şekilde karşılamaktadır.


PHP MAILER I NASIL KULLANIRIZ NE GEREKLIDIR KULLANMAK ICIN
1-Gercek bir email hesabinin olmasi gerekir
2-
*/

?>

<?php header("Content-type: text/html; charset=utf-8"); ?>
<form action="sendmail.php" method="post">
<label for="name">İsim:</label><br>
<input type="text" name="name" id="name"><br>
<label for="mail">Mail</label><br>
<input type="text" name="mail" id="mail"><br>
<label for="subject">Konu</label><br>
<input type="text" name="subject" id="subject"><br>
<label for="message">Mesajiniz</label><br>
<textarea name="message" cols="30" rows="10" id="message"></textarea><br><br>
<input type="submit" value="Gönder">
</form>
