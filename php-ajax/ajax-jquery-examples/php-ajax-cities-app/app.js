
//Sayfam hazir oldugunda bende hazirim, hemen calistir, sayfa hazir olunca demek icin bu sekilde kullaniyoruz
//Yani dom yuklendiginde bende islem yapmak icin hazirim demektir




    //Yapilan islem sudur...kullanici select optiondan bir option seciyor
    //Ve biz bu secilen option i kullanicinin sectigi option u bir degiskene atayip 
    //onu ajax post ile php dosyasina gonderiyoruz yani server tarafina ki o kullanicinin girdigi degere gore
    //sorgu yapabilsin diye
    $(function(){
        //id si flyke olan selectbox i sececegiz
        //sonra bunun degeri degisirse ,change olursa bir callback fonksiyonu calistir ve bunu yakala demis oluyoruz
        //Yani biz, select optionda kullanicinin sectigi option i burda alabilecegiz
       // $(document.body).on('change','#flyke',function(){
        $('#flyke').on('change',function(){
            //Bu select box degistiginde secilen degeri bize verecektir
        let flykeNo=$(this).val();
            if(flykeNo){//Eger bir flyke secilmis ise asagidaki islemleri yapacak secilmemis ise de
              
               //Burasi bos degil ise yani kullanici bunu girmis ise benim bu degeri alip php ye gondermem gerekiyor ki onunla dinamik isler yapabilelim...dikkat edelim girilen degeri biz php vermeliyiz ki o onu alsin ve onun ile veritabaninda bir sorgu yapsin ve onu tekrar gondersin...O zaman bunu biz ajax ile gonderebiliriz 
               $.post('ajax.php',{'flykeNo':flykeNo},function(response){
                    console.log(response);
                    //Biz burda gonderilen responsu alabildgimize gore burda o zaman islemimizi yapacagiz
                    //biz id ler uzerinden burda select optionlarimiza jquery araciligi ile erisebiliyoruz
                    $('#kommune').html(response).removeAttr('disabled');//html formatinda gelen degeri kommune id li select icine yazdir         
                    
            });
            
           
        
        }else {//flyke kodu secilmemis ise o zaman da buray i calistir demis olduk

            $('#kommune').html('<option>--Velg et kommune--</option>').attr('disabled','disabled');
        
        }
        
        });
      
        
        });
        

 //Burda json i kullanip kullanmamaya gore daatayi alamayabiliyoruz bazen dikkat li kullanmak gerekiyhor
            //PHP-AJAX DAKI TEMEL MANTIGI IYI KAVRAYALIM...BU ISLEMI TAMAMEN REACT ILE YAPINCA NASIL YAPIYORDUK BUNU DUSUNELIM VE FARKINI IYI ANLAYALIM KI HANGI PROBLEME NASIL YAKLASMALIYIZ BUNUN UZERINE ISABETLI YORUMLAR YAPMAK COK ONEMLIDR
        //Burda kullanici option secimini yaptiginda hemen o secimi aliyoruz ve o yapilan secimi ajax ile, jquery ile php sayfasina gonderiyoruz hemen..Simdi burda bir dusunelim..biz sadece front-end de bir dinamiklik yaparken ne yapiyorduk normalde biz front-end de kullanici bir interaktiflik yaptiginda aynen select option dan bir option secmek gibi bir interaktiflik yaptigi zaman biz onu once kendi tuttugmuz degiskenlere alirdik kendi kontrolumuze alirdik bunu react ta controlled form ile state lerimize alarak yapardik useState ile 
        //Ve bu degiskeni aldgimizda da alir almaz useState virtualdom ile realldom u karsilastirir ve usestate icindeki callback useState bittigi anda sayfayi render ederdi ve biz de bu sayede kullanicinin yapmis oldugu degskligi degiskenlerimize stat lerimize atayarak bunu kullaniciya tekrardan yansitabiliyorduk....Ana mantik bu idi
        //Ama burda biz php kullanarak sayfayi hic yenilenmesine gerek kalmadan o dinamiklik ve interaktifligi kullaniciya yansitacagiz
        //Ama yine mantigi anlayalim...burda kullanicinin girmis oldugu, veya secmis oldugu optioan i biz once dogal olarak front-end de aliyoruz
        //jquery ile veya javascript ile aliriz ardindan aldgimiz kullanicinin girmis oldugu datayi server tarafina yani php tarafina jquery-javascritp araciligi ile ajax-php gondeririz yani post ya da get request yapariz, gondergimiz datayi php tarafinda alip hemen orda veritabanindan o data yi kullanarak sorgumuzu yaparak donen datayi da tekrardan front-end e gondererek kullancinin yapmis oldugu degisikligi, yani kullanciini secmis oldugu optiona in interaktif, dinamik resultunu kullaniciya yansitmis olacagiz
        //Bize jquery-vya javascript-php isbirliginde kazandigmiz avantaj, jscript ile dinamik olarak kullanici tarafindan degisitriilen data alinir alinmaz php ye gonderilir ise php tarafinda server tarafinda bu datayi tutuyoruz ve tekrardan bu datayi kullanicya yansitabiliyoruz
        //Nasil tabi  ki ajax ile hangi php sayfasina gonderiyorsak o sayfadan dondurulen her turlu sonuc, yine o ajax icindeki callback fonksiyonuna response olarak gelecektir dolayisi ile biz cok hizli birsekilde sayfa yenilemeden gelen datayi server tarafina gonderip ordan gelen neticeyi de alabiliyoruz bu harika birsey server tarafinda her turlu filtrelemeyi dogrudan veritabnindan yaparak istedigmiz datayi tekrardan front-ende gondeririz ve hicbir sayfa  yenileme islemi olmadan biz kullanicya dinamikligi yansitmis oluruz
        /*
        Kullanici bir option sectiginde biz onun secimini alip ajax.php ye jquery araciligi ile post-request gondermis oluyorz bunu da index.php yi inspect yapar ve network e gidersek orda ajax.php ye tiklarsak headers da 
        Request URL: http://localhost/test/php-ajax/ajax-jquery/php-ajax-cities-app/ajax.php
        Request Method: POST
        Status Code: 200 OK
        
        */