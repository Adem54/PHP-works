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