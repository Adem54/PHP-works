<?php 


// ob_start neden kullaniriz?
// sayfalarda header işlemleri ob_start(); olmazsa yönlendirmeler çalışmıyor
// ob_start ile içeriğin görüntülenmeye hazır olana kadar sunucu tarafında arabellekte tutmasını sağlıyor
// ayrıca ifade ile çıkacak olan her şeyi hatırlamaya başla ve henüz bir şey yapma diyerek düşünebilirsin

// ob = output buffering = çıktı tamponlama diyebiliriz.

// Örneğin yorum gönderme işlemini ajax ile yaptığını düşünelim. Ve listelenen yorumlarıda bir php dosyasında tutuyorsun. Ve ajax ile yorum gönderdiğinde bu yorum sayfasını kullanmak istiyorsun.
// Fakat require ya da include kullanırsan direk çıktıyı bastıracaktır. Bu durumda ob kullanarak çıktıyı sonradan yazdırmak üzere saklayabilirsin

ob_start();
require 'view/comment.php';
$output = ob_get_clean();

echo $output;


/*
Ara bellekten temizlenmeden önce arabelleğin içeriği üzerinde işlem yapmak için bir geri arama işlevi iletilebilir. Bayraklar, arabelleğin yapabileceklerine izin vermek veya kısıtlamak için kullanılabilir.


ob_start(callback, chunk_size, flags);
callback:İsteğe bağlı. Tamponun içeriğini temizlenmeden önce işlemek için kullanılan bir geri arama.
Geri arama işlevi aşağıdaki parametrelere sahip olmalıdır:ParameterDescriptionbufferÇıktı arabelleği aşamasının içeriğiAşağıdaki bayraklardan herhangi bir sayıda olabilen bir bit maskesi:
PHP_OUTPUT_HANDLER_START – Çıktı arabelleği yeni oluşturulduysa
PHP_OUTPUT_HANDLER_FLUSH – Çıkış arabelleği şu anda temizleniyorsa
PHP_OUTPUT_HANDLER_FINAL – Bu işlemden hemen sonra çıktı arabelleği silinecekse
chunk_siz:İsteğe bağlı. Varsayılan 0'dır. Sıfırdan büyük bir değere ayarlandığında, içeriğin uzunluğu bu değeri aştığında arabellek otomatik olarak temizlenecektir.
flags:	İsteğe bağlı. Varsayılan değer PHP_OUTPUT_HANDLER_STDFLAGS'tır.

Tamponun yapmasına izin verilen işlemleri belirleyen bir bit maskesi. Aşağıdaki bayrakları içerebilir:

PHP_OUTPUT_HANDLER_CLEANABLE – ob_clean(), ob_end_clean() ve ob_get_clean() çağrılarına izin verilir.

PHP_OUTPUT_HANDLER_FLUSHABLE – ob_flush(), ob_end_flush() ve ob_get_flush() çağrılarına izin verilir.

PHP_OUTPUT_HANDLER_REMOVABLE – ob_end_clean(), ob_end_flush() ve ob_get_flush() çağrılarına izin verilir.

PHP_OUTPUT_HANDLER_STDFLAGS – Eşdeğeri

PHP_OUTPUT_HANDLER_CLEANABLE|
PHP_OUTPUT_HANDLER_FLUSHABLE|
PHP_OUTPUT_HANDLER_REMOVABLE

<?php
ob_start();
echo "This content will not be sent to the browser.";
ob_end_clean();

echo "This content will be sent to the browser.";
?>


outputbuffering:
ob_start'a gelince ...

PHP'in "output buffering" opsiyonunu aktif hale getirir. Bu da sayfalar içerisinde PHP'in algilayabilecegi 1'den fazla header kullanmaniza olanak tanir ... Özetle bu.

Aayfanın bellekte kalması ve end_flush'a gelinceye kadar sonucun gösterilmemesi anlamına da geliyor galiba. Sonuçta header, session_start fonksiyonlarının sayfa başında kullanılmadığı durumlarda hataları önlüyormuş. Ancak çok büyük bir projede buffera çok yüklenerek performans sorunu yaratabilirmiş.

Yani bunun gibi bir şey sanırım.

PHP varsayilan ayarlarda output_buffer'i performansi azaltmamak icin bloklar, ob_start blok olayini temp olarak devre disi birakir .. diyebiliriz ..
*/

/*
Php 'de çıktı tamponu (output buffer) kullanımı

Normalde herhangi bir php kodu çalıştırdığınızda oluşan çıktı işlem anında tarayıcıya gönderilir ve bu şekilde kodun çalışmasının bitmesi beklenmeden çıktı verilmeye başlanmış olur. Ama bazı durumlarda çıtının hemen gönderilmesini istemeyiz. Örneğin, içeriği oluşturduğumuz kodun sonunda yaptığımız bir kontrol ile o ana kadar üretilen çıktının ne biçimde kullanılacağı, yada gösterilip gösterilmeyeceği gibi durumlara karar vermek isteyebiliriz. Yada sayfanın bir yerinde oluşturduğumuz çıktıyı başka bir yerde kullanmak isteyebiliriz. Bu örneklere bütün sayfa içeriğinin en başta oluşturulup daha sonra istediğimiz bir biçimde (sayfa şablonu kullanımı vb durumlar için ) kullanıcıya aktarılmasını da ekleyebiliriz. Bu gibi durumlarda çıktı tamponlama kullanabiliriz. Php 'de bunu gerçekleştirmek için çıktı tamponlaması yapılır.


Çıktı tamponu oluşturmak için öncelikle çıktının başladığı noktayı belirtmemiz gerekir. Bunun için ob_start işlevi kullanılır. Çoğunlukla bu işlevin parametreleri kullanılmaz. Çıktıyı sonlandırmak için ise kullanılabilecek çeşitli işlevler vardır. Çıktıyla ne yapmak istediğimize göre bunlardan birini kullanırız. Örneğin çıktıyı herhangi bir işlemden geçirmeden olduğu gibi aktarmak için ob_flush yada ob_end_flush işlevlerini kullanabilirsiniz. ob_end_flush işlevi çıktıyı istemciye gönderip çıktı tamponunu sonlandırır. ob_flush ise aynı işlevi çıktı tamponunu sonlandırmadan gerçekleştirir. (Ayrıca php kodunun çalışması bittiğinde çıktı sonlanmış olur ve çıktı istemciye verilir yani herhangi bir hata durumunda veya işlem bittiğinde eğer çıktı tamponunda çıktı kalmışsa istemciye gönderilir.)

Çıktıyı istemciye vermek yerine içeriğini alıp istediğimiz gibi kullanabiliriz. Bunun için ob_get_contents yada ob_get_clean işlevlerini kullanabilirsiniz. ob_get_contents işlevi çıktı tamponunun içeriğini döner. ob_get_clean ise bununla birlikte çıktı tamponunu sonlandırır. ob_get_clean işlevini çağırmak, ob_get_contents kullanıp ardından ob_clean işlevini kullanmakla aynı işlevi görür.

Çıktı tamponlaması yaparken kullanabileceğiniz bazı yardımcı işlevler de bulunmaktadır. Örneğin ob_get_length işlevi çıktı tamponundaki verinin uzunluğunu döner. ob_get_level işlevi ise mevcut tamponun derinlik seviyesini döner (İçiçe çıktı tamponları başlatabilirsiniz). ob_get_status işlevi de çıktı tamponunun durumu hakkında bilgiler içeren bir dizi döner.


Çıktı tamponu sisteminin çok kullandığı bir durum da kodun herhangi bir yerinde url yönlendirmesi yapılan kodlardır. Yönlendirme yapmak için header işlevi kulanılır ve bu işlev ile çıktının başlık bilgileri düzenlenir. Ancak bu düzenlemeyi yapabilmek için önceden istemciye herhangi bir çıktının verilmemiş olması gerekir. Eğer yönlendirme yapılan çağrıya kadar herhangi bir çıktı verilmişse başlık bilgisinin zaten gönderilmiş olduğunu belirten bir hata mesajı alırsınız. Eğer kodunuzun başında çıktı tamponu başlatırsanız ve yönlendirme yapılan çağrıya kadar herhangi bir çıktı vermezseniz böyle bir hatayla karşılaşmazsınız ve yönlendirme gerçekleşir.

ob_start() ile tampon oluşturmanın genelde amacı bir yerde oluşturulan içeriğin başka yerde kullanılması şeklindedir. Yada bazen çıktıyı doğrudan vermeyip gerekirse arada yönlendirme işlemi yapabilmek için de kullanılıyor. Dediğiniz gibi büyük projelerde belki bir miktar yük getirebilir sonuçta çalışma esnasında kısa süreli de olsa ramde veri tutması gibi bir kaynak kullanımı vardır sanıyorum. Dediğim gibi sadece gerekliyse kullanılır gereksiz durumlarda bir manası yok zaten. Tampon çıktıyı herhangi bir komutla sonlandırmasanız bile dosya sonunda sistem kendisi otomatik sonlandıracaktır zaten ama arada bir yerde sonlandırıp çıktıyı başka yere taşımak gibi amaçlarla faydalı olabiliyor ob işlevleri.
*/

?>


<?php 
   //Örneğin bir sayfanın içerisindeki bütün ANKARA kelimelerinin tamamını İSTANBUL yapacaksın. ob_start ile sayfanın tüm kodlarını hafızaya atıyorsun. Hafıza içerisinde kelime değişikliklerini yapıyorsun. Mesela şöyle:
   function degistir($tampon)  { 
     return str_replace("ANKARA", "İSTANBUL", $tampon); 
   } 
    
   ob_start("degistir"); 
    
   ?> 
   <html> 
   <body> 
      <p>ANKARA türkiye'in başkentidir.</p> 
      <p>ANKARA bir orta anadolu şehridir.</p> 
      <p>ANKARA türkiye'nin 2. büyük ilidir.</p> 
   </body> 
   </html> 
   <?php ob_end_flush(); ?>  