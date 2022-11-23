<?php 

// print_r($_POST);
/*
eger g-recaptcha-response icinde bir deger ile geliyorsa checked olmustur demektir, bos gelirse demekki tiklanmadan gelmis demektir
{
g-recaptcha-response: "03AEkXODA5aX_egetChuiXV1p-Z_2b3jt6ujmoJt2YErNm-3U3HIHM-ipw6SGSrzckv-KdKtst3oCVdmecrBLjG6oDL97eW9AOVRKse2ZSqyIP68oV1qCTu7Tb2GNU6NjE0m4vHPY1KpQrKMZNw9bG-ljsTkPkUMMYEQjjm7IDmgatTq0pgJN04e_3mSIemm6HB0VXj2_nZkkmVMkH6AT4bP8XVEjREzDtCmhz-41-0mKMGP2OFUdgaiAn3nl_flBDk3rTA-UxalaVvJC7C8LTmMRphjCrFsSnlG28HbpbMMilCEOXD5Oo671hBNGY5gMw50zJj_pnDMPq_pTIRHRIiNxKE0c7wZlgzPP9i_61r17uhh3FbnwLDMyH49dVueXLv3Nem1QsD643DaZafGMagGwArJ_Cr_sUc_uveZUehK9V0lfFn72IeB49R2feCbpTUR62wCRPJktiPCSjdCIwPrq2U2ybDe5UGX6lEFL2GeW0WhgJTO2a2EmgzY51io7iA6DpxDy1FDITZZcVD_jMClMX-BResIEj3HSkvQx53uT_aslq02Ey7kmlo7CI3tvHg3f7fWZNIb6p"
},

Simdi recaptcha dan gelen bu degeri ve secret key i bizim recatpcha ya kaydoludgmuz zaman serverside tarafi ile ilgili verilen aciklamada post olarak asagidaki adrese gondermemmiz gerektigi aciklanmis..
API Request
URL: https://www.google.com/recaptcha/api/siteverify METHOD: POST
POST Parameter	Description
secret	Required. The shared key between your site and reCAPTCHA.
response	Required. The user response token provided by the reCAPTCHA client-side integration on your site.
remoteip	Optional. The user's IP address.

*/
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

$name=$_POST["name"];
$recaptcha=$_POST["g-recaptcha-response"];

if(!$name){
    echo "Enter your name!";
}elseif(!$recaptcha){
    echo "Click, I'm not a robot option";
}else {
    //Burdan sonra curl islemi yapacagiz dikkat edelim biz istek gonderme isini server dan yapiyoruz ve server tarafinda istek gonderme islemin curl ile yapacagiz... 

    //$curl=curl_init("https://www.google.com/recaptcha/api/siteverify");
    //https://www.google.com/recaptcha/api/siteverify   URL I BURDA DA BELIRLEYEBILIRDIK
    $curl=curl_init();
    
    curl_setopt_array($curl,[
        CURLOPT_URL=>'https://www.google.com/recaptcha/api/siteverify',
        CURLOPT_POST=>true,
        //curl de post ile data bu sekilde gonderiliyor aralara & isareti koyarak birden fazla data gonderilebilir
        CURLOPT_POSTFIELDS=>'secret=6LfaFi0jAAAAAD8bVWl-D9eeHCgA7nznyi3tTkBR&response='.$recaptcha,
        CURLOPT_RETURNTRANSFER=>true
    ]);

    $output=curl_exec($curl);
    curl_close($curl);
   // echo $output;
    /*
    {
    "success": true,
    "challenge_ts": "2022-11-23T23:09:49Z",
    "hostname": "localhost"
}
    */
    //Simdi bize gelen responsu jsondan php ye decode edelim ve o data uzerinden kontrol yapalim sucess durumunu
    $response=json_decode($output,true);
    if($response["success"]===false){
           echo "Click, I am not robot choice....."; 
    }else{
        echo "continue to your post operations from here...";
        //Kullanici ben robot degilim secenegini tiklayip o kismi basarili bir sekilde doldurdu demektir bu
    }

    /*
    Giris yapa , veya submit e tiklaninca ben robot degilm kismi yenileniyor, bunun sebebi de su ki bir kez degeri burda yaptgmiz gibi post ettimz zaman, secretkey, response u,  yani tiklaninca giris yap veya submit  e tiklaninca post edilmis oluyor ve bir kere tiklandktan sonra post etme islemi gerceklestigi icin, ondan sonra, kullanici nin on yuzde, tekrardan ben robot degilimi secmesinin anlami kalmiyor ondan dolayi da, bunu resetlememiz gerekiyor bunu yapabilmek icnde (reCAPTCHA v2 checkbox kisminda okuyabiliriz bunu ) client tarfinda bir tane reset butonu koyacagiz asagidaki gibi
     <button type="button" onclick="javascript:grecaptcha.reset(secret1);">Reset</button>
    */
}

?>