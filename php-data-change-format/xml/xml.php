<?php
//Xml 
//Xml- extensible markap language-xml bir dildir json gibi basit birsey degil
//Genisletileibilir isaretleme dili-markup language-isaretleme dili
//Html de bir markup language yani isaretleme dili ama, xml verileri depolamak ve tasimak icin tasarlanmstir
//Xml verileri tasiyor ve veri tasimak ve depolamak icin tasarlanmis, ama html ise verileri goruntulemek icin tasarlanmistir
//Bu farktan dolayi da xml etiketleri html etiketleri gibi onceden tanimli etiketler degildir. 
//Istedigmiz xml etiketini olusturabiliyoruz xml de. Xml de istedgimiz sekilde xml olusturabiliyoruz
/*
1 tane mutlaka root elemani, ana kapsayici olacak onun altinda children etiketleri olacak sekilde bir yapi kurmamiz gerkiyor

boyle yaptgimiz zaman biz bu etiket icinde datalarimizi saklayip sonra da tasiyacagiz dolayisi ile bizim html deki gibi buraya alacagmiz datayi gostermeyecegiz sadece saklayip tasiyacagiz..Veri aktarimi yapacagiz..etiketlerini html e benzemesi bizi yanilstmasin tamamen farkli amaclar icin vardir xml ve html

1 tane root etiket olusturmamiz gerekir xml dosyasi nda
<adem>

</adem>

*/
// php ile xml kullanimi 
//simplexml_load_string
//simplexml_load_file:Bir xml dosyasini yukleyip sonucunda bize bir ojbe donduruyor

$xml=simplexml_load_file("index.xml");
print_r($xml);//Bize obje olarak bir cikti veriyor
//Bir xml dosyasinin icerigii php olarak almak istedgimz zaman bu sekilde alabilirz..Direk xml dosyasindan icerigi alacak isek bu sekilde alabiliriz

/*
name: "Adem",
surname: "Erbas",
city: "Skien ",
projects: {
project: {
0: {
@attributes: {
id: "1"
},
id: "1",
title: "happening"
},
1: {
@attributes: {
id: "2"
},
id: "2",
title: "github-user"
},
2: {
@attributes: {
id: "3"
},
id: "3",
title: "personal-portfolio"
}
}
}
*/

//Ama bir xml dosyasi icerigini bir string icersinde php dosyasi icerisinde, onu php ye cevirmek istersek yani asagidaki gibi

$my_xml='<?xml version="1.0" encoding="UTF-8" ?>
<adem>
    <name>Adem</name>
    <surname>Erbas</surname>
    <city>Skien </city>
    <projects>
            <project id="1">
                <id>1</id>
                <title>happening</title>
            </project>
             <project id="2">
                <id>2</id>
                <title>github-user</title>
            </project>    
             <project id="3">
                <id>3</id>
                <title>personal-portfolio</title>
            </project>
           
    </projects>

</adem>';

//Eger bu sekilde alacak isek....
$my_xml=simplexml_load_string($my_xml);

print_r($my_xml);

/*
{
name: "Adem",
surname: "Erbas",
city: "Skien ",
projects: {
project: {
0: {
@attributes: {
id: "1"
},
id: "1",
title: "happening"
},
1: {
@attributes: {
id: "2"
},
id: "2",
title: "github-user"
},
2: {
@attributes: {
id: "3"
},
id: "3",
title: "personal-portfolio"
}
}
}

*/
/*
2 sekilde bir xml dosyamizi php ye cevirip kullanabilyoruz
1-ister direk dosya olarak php ye ceviririz-$xml=simplexml_load_file("index.xml");
2-istersek de icerigi alip bir tek tirnak ile string bir degiskene atariz ve o degiskeni, yani o icerigi php ye ceviririz
$my_xml=simplexml_load_string($my_xml);
Ama bu 2 fonksiyon da da biz xml i php de objeye cevirebiliyoruz yani php de biz dizimizi xml e ceviremiyoruz bu fonksiyonlar ile..
*/




?>