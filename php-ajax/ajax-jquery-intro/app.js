//$() jquery de bunun icerisinde fonksiyonu kullanmak sayfam hazir oldugundan ben de hazirim demktir 
// $(function(){

//     //$.ajax methodu
//     //php de ajax tekngini biz jquery ile kullanacagiz javascripte gore daha kisa ve kolay oldugundan dolayi
//     $.ajax({
//         type:"POST",
//         url:"ajax-endpoint.php",//Buraya url olarak biz php de hangi dosyamizi verir isek ordan ekrana basacgimz deger burda response olarak gelecektir
//         data:{"name":"Adem","surname":"Erbas"},
//         success:function(response){//burda bize bir callback function donuyor
//             console.log(`response: ${response}`);//Bu deger ajax php den donen degerimizdir
//             //Yani biz ajax.php den ne donersek tarayicida o deger alinacaktir
//             console.log(response.name);//dataType i json olarak belirttikten sonra ancak biz response u bir javascript objesi gibi kullanabilecegiz
//         },
//         dataType:"json"//bunu vermemiz gerekiyor gelen dayai json olarak kullanabilmek icin
        //Biz dataype olarak json yazmaz isek o zaman bize direk html olarak cikti vermis oluyor

        //Ajax da post islemleri icin kullanabilecegimz daha kisa bir islem var onu da yapalim

//     })


// });

//Sayfa hazir oldugunda calissin demek icin 
//Bu method ise sadece post islemelri icin kullaniliyor
$(function(){
    $.post("ajax-endpoint.php",{"name":"Zehra","surname":"Erbas"},function(response){
            console.log(`myResponse: ${response}`);
            console.log(response.name);
    },"json");

    //Get islemi icin ise

//     $.get("ajax-endpoint.php",{"name":"Zeynep","surname":"Erbas"},function(response){
//         console.log(`myResponse: ${response}`);
//         console.log(response.name);
// },"json");

});

/*
Kisacasi burda yani jscript icerisinde yaptigimzi islem request islemidir yani bizim 
javasecriptte fetch ile veya axios ile yaptgimiz, gonderdgmiz get, post,update,put, delete 
request leri ne ise ayni islemi jquery ile yapiyoruz aslinda 

*/





