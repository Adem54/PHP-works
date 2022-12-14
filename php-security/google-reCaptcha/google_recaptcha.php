<?php 
//recaptcha register a new site diyerek google hesabimiz uzerinden yeni bir recapthca kaydi yapabilirz 
//localdev ismi ile kaydolduk
//websitesi ismine localhost diyerek recaptcha2 versiyonu checkbox ile olan versiyonunu seceriz ve gondeririz 
//Bize siteanahtari verilir bu sekilde  6LfaFi0jAAAAACszL99Xt3LxzWIzAyttuVuqM9I3 
//Sonra yapmamiz gerekenleri client-side ve server-side ile orda gosteriyor orayi takip edecek olursak 

//Client-side

//Bir de server side var onu da yine recapthca ya register oldugmuzda bize link veriyor o linkte de server side linkine tiklarsak orda da server side da google recaptcha yi nasil handle ederiz gorebiliriz 
//Burda da biz kaydoldugumuzda bize verilen secret key kullanacagiz ve de donen responsu gondereecgiz
//6LfaFi0jAAAAAD8bVWl-D9eeHCgA7nznyi3tTkBR 
/*
API Request
URL: https://www.google.com/recaptcha/api/siteverify METHOD: POST
POST Parameter	Description
secret	Required. The shared key between your site and reCAPTCHA.
response	Required. The user response token provided by the reCAPTCHA client-side integration on your site.
remoteip	Optional. The user's IP address.

API Response
The response is a JSON object:

{
  "success": true|false,
  "challenge_ts": timestamp,  // timestamp of the challenge load (ISO format yyyy-MM-dd'T'HH:mm:ssZZ)
  "hostname": string,         // the hostname of the site where the reCAPTCHA was solved
  "error-codes": [...]        // optional
}
*/
//https://developers.google.com/recaptcha/docs/display bu sayfaya gidersek orda reCAPTCHA v2 yi secerek checkbox dersek zaten biz kaydoldgumuz zaman bizim yonlendirildigmiz client-side kodlarini gorebiliyoruz, hem bize verilen hem de customize yapabilecgemiz kodlari orda gorebiliyourz

?>

<!-- Client side tarafinda asagidaki kodu recaptcah yi kaydettimizde client-side linkine tiklayinca bize verecek ve asagidaki html kodlari arasinda your-sitekey yerine bize verilen sitekey i yazaagiz
Asagidaki kismi yapistridgimzda google bizim icin recaptcha yi client-side tarafinda olusturmus oluyor

Ayrica bize saglaanan kendi basimiza ekstra ozellestirme yapabilmemiz icin verilen kodlar da var


-->

<script type="text/javascript">
    var secret1;
  var onloadCallback = function() {
    //grecaptcha ismindeki javascript, constructor function i kullanacagiz.. yani class tabanli dillerdeki hazir class lara karsilik geliyor javascriptte de hazir constructor fonksiyonlari geliyor... 
    //Bunlar direk, dokumanda var ordan incelyebiliriz
    //sitekey bize verilen sitekeydir
    //dokumani inceleyerek burda ekstra ozellikler ekleyebiliyoruz
   secret1= grecaptcha.render('security-1', {
          'sitekey' : '6LfaFi0jAAAAACszL99Xt3LxzWIzAyttuVuqM9I3',
          'theme':'dark'
        });
//istersek 2 tane recatpcha da olusturabilirz client-site tarafinda
    // grecaptcha.render('security-2', {
    //     'sitekey' : '6LfaFi0jAAAAACszL99Xt3LxzWIzAyttuVuqM9I3',
      
    // });
  };


</script>
<!-- language i istedigmiz bir dile cevirmek icin yine 3.bir paramtre hl yi ekleriz dil ayarlarindan dan norvecce icin no oldugunu gorebiliriz -->
  <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=no"
    async defer>
</script>
<html>
  <head>
    <title>reCAPTCHA demo: Simple page</title>
   

  </head>
  <body >
    <form action="form.php" method="POST">
        <input type="text" name="name" placeholder="Your name"><br><br>
    
      <div id="security-1" class="g-recaptcha" data-sitekey="6LfaFi0jAAAAACszL99Xt3LxzWIzAyttuVuqM9I3"></div>
      <br>
      <!--
        istersek 2. yi de olusturabiliriz
        eger bu div icin ustte sitekey gondeirliyor ise burda tekrardan data-sitekey olarak gondermemize gerek yok
         <div id="security-2" class="g-recaptcha" ></div>
         -->
      <br/>
      <button type="button" onclick="javascript:grecaptcha.reset(secret1);">Reset</button>
      <input type="submit" value="Submit">
    </form>
<!--
    client-site recaptcha miz bu kadardi, simdi de server-side recaptcha ya bakacagiz 
    client-site da formumuz form.php dosyzmia gidecegini varsayalim..

    recaptcha yi kullanmak cok onemlidir, bu sekilde nerdeyse tum botlardan sitemizi temizlemis oluruz
    ozellikle uyelik kayit islemlerinde bunu kullanmaliyiz, siteye giris yapabilmesi icin bunu isaretlemsi gereksin ki bu sekilde tum botlardan siteyi temizlemis oluruz
    CAPTCHA, hesab??n??za yaln??zca do??ru ??ifreye sahip bir ki??inin girmesini sa??layarak uzaktan dijital giri?? yap??lmas??n?? engeller. CAPTCHA'n??n i??e yaramas??n??n nedeni, bilgisayarlar??n deforme edilmi?? bir resim olu??turup yan??t?? i??leyebilmesi ancak testi bir insan??n ge??mesi i??in ????zmesi gereken ??ekilde ????zememesidir.
    Captcha kullan??m?? her ge??en g??n biraz daha yayg??nla????r. Web sitesi sahipleri ya da y??neticileri bu do??rulama sayesinde robot sald??r??lara kar???? tedbir alabilirler. 

    Captcha, ilgili web sitesine bot giri??ine engel olur.
Spam yorumlar??n yap??lmas??na engel olur. Bu sayede web sitesinin spam yorumlar nedeniyle arama motorlar??nda arka sayfalara d????mesi sorununun ??n??ne ge??ilir.
Captcha, ??yelik sistemi ile ??al????an web sitesindeki t??m ??yelerin ger??ek kullan??c??lar oldu??unu do??rular.
Web sitelerinde yer alan anketlerin otomatik doldurulmas??n?? engellemek ve olu??abilecek haks??zl??klar??n ??n??ne ge??mek ad??na Captcha do??rulama testi kullan??l??r.
ReCaptcha, web sitesine spam giri??ini engellemek amac??yla kullan??l??r. Ekranda flu olarak verilen yaz??n??n kullan??c?? taraf??ndan do??ru ??ekilde yaz??lmas?? istenir. Ekranda g??r??len yaz??, silik ve karma????k ifadelerden olu??ur. Bu yaz??lar?? robotlar??n alg??lamas?? m??mk??n de??ildir. Yaz??lar?? sadece insanlar yorumlayarak g??venlik ad??m??n?? ge??ebilir.
Sahte ??yelikleri ??nlemek amac??yla
Anket ve istatistiklerin g??venilirli??i i??in
Spam mail ve spam yorumlar?? ??nlemek i??in
G??venlik ama??lar??yla 

Bot yazilm, ile sitemize sizmaya calisanlar giris kismini defalarca denemeye calisacaklardirkk recaptcha da zaten, birkac kez hatali giristen sonra onun bot oldugunu algilayarak ona giris izn i vermez ayrica da forma giris yapmaya calisanlari d a engeller
-->

  </body>
</html>