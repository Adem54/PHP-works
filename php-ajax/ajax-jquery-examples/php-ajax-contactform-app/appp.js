$(function(){
    $("#submit-btn").on("click",function(event){
       //Burda form daki elemntleri aliyoruz
        event.preventDefault();
       let name_surname=$("#namesurname").val();
       let epost=$("#epost").val();
       let msg=$("#msg").val(); 

    let checkAllFields=Boolean(name_surname && epost && msg);
    //BU ARADA BIZ BURDA FORM-VALIDATIONI FRONT-END DE YAPTIK AMA BUNU HEM FRONT-END HEM DE BACKEND DE YAPMALIYIZ HER ZAMAN
    let form_data={name_surname,epost,msg};   
//jquery de serialize diye bir method var eger biz form elemtnine bir id verir ve o id uzerinden serialize methodunu burda cagirirsak bize form iceriisndeki tum input ve form elementlerinin value sine erisebiliyoruz
    let formData=$("#contact-form").serialize();
      console.log(formData);



    if(checkAllFields | true){//Bu check islemini backenddekini gorelim her seferinde ugrasmayalim diye || true koydum yoksa || true olmayacak
       $.post("ajax.php",formData+"&type=contact",(response)=>{
        //Eger responsumuza gelen json data si altinda error gelmis ise o zaman alert ile mesaj verelim yok success olarak gelmis ise o zaman da o success mesaji  i de index.php de html etiketi olusturruuz ve tabi ki bir id atariz ki burdan ona erisip onun icine success mesaji gosterebilelim..ve bu success mesajin gosterecek html etiketimiz normalde gizli olacak ne zaman ki success mesaji gelirse o zaman gosterecegiz
        // console.log(response.error);
            if(response.error){
                $("#success").hide();
              //  alert(response.error);
                $("#error").html(response.error).show();
                //Hangi alan ile ilgili error mesaji gelyor ise o alana focus yapilmasini sagliyoruz...BESTPRACTISE..
                $("#"+response.target).focus();

            }else{
                $("#error").hide();//hata inputunu gizleyecegiz eger bir kez bile hata oldu ise hata yi gosterdigmz inputin dipslayi block olmus olacagiz icin
                $("#success").html(response.success).show();
                //burda bu id icerisinde icerigimzi show ile goster demis oluyoruz, yani display i
                //form icindeki input ve text-area larin degerlerini de sileim simdi
                $("#contact-form input, #contact-form textarea").val("");//val("") yaparak eger success olmus ise o zaman form elemntlerinin icini temizlemis oluruz
                //BESTPRACITSE...BUNU DA COK KULLANAAGIZ
            }
       }, "json");
       //NOT:BIZ 4.PARAMETRE OALRAK JSON BELIRTMIS ISEK O ZAMAN DATAYI JSON OLARAK GONDERMEMIZ GEREKIR, YOK EGER BELIRTMEZ ISEK O ZAMAN JSON OLARAK GONDERMEYEBILIRIZ,
    }else{
        alert("You have to fill all fields");
    }
       
    })
})

//jquery de herseyi id ler uzerinden goturuyoruz ondan dolayi da bizim interaktiflik olacak html elemntlerine id vermemiz cok onemldir

/*
Front-enddeki mantigmiz
Kullanici bir form da data girdginde veya kullanicini yaptigi sectigi tikladigi her turlu islev de ilk olarak kullanici ne tur bir html elementine tiklamis veya interaktiflik yapmis ise ona ait bir evnthandling calisacaktir ve biz bu eventhandling i genellikle de bu direk html elementinde inline olarak da kullanabilyoruz
Bu eventhandling ler onclick,onchange seklinde direk html elemntlerimize inline olarak gelecektir ve biz bunlar araciligi ile ilk yapaagimzi islem bizim kendi tuttugumuz degiskenlere o event handlginler araciligi ile kullanicinn girdigi degeri aktarmakk ve bunu dinamik yaparak ordaki degisikligi anlik olarak degiskenimize aktaracak bir islem yapacaigz burda da ya this i kullaniriz ya event handling fonksyonlarina default oalrak gelen event objesini kullanrak dinamik birsekilde input alanlarina girilen datalari alabiliyroz...cook onemli bunu bilmek

*/