<?php 

//final kullandigimiz class in extend edilmesini engellemis oluyoruz
//C# da bunu sealed ile yapiyorduk
//Peki neden final kullaniriz
//Cok buyuk projelerde calisirken
//biz bazi class lar spesifik gorevleri olabilir ve turetilmesini 
//istemeyebiliriz, ki bunu neden isteriz biz buyuk bir projede calisiyor olabiliriz ve
//bizim le birlikte ayni projede calisan baskalari da gelip bizim o 
//class imizi turetmeye calisabilirler..iste buna izin vermek istemiyor isek
//o sinifimizin spesifik bir durumu var sadece o gorevde kullanilmasi gerekiyor
//ve de turetilmemesi gerekiyor ise o zaman final kullanabiliriz

//Ayni sekilde biz final i methodlara da kullanarak onlarin da 
//kullanilmasini engelleyebilirz
//Ama method icin durum biraz daha farklidir soyle ki

final class Marka {

}

class Model {}
// class Model extends Marka{

// } Burda hata verecektir bize eger final ile tanimlanmis bir class i extends etmeye calisirsam


class Seri extends Model {
    final function test(){
        return "seri";
    }
}

//Biz final ile belirledigmiz
class Product extends Seri {
    //Cannot override final method Seri::test() in

    // public function test(){ hata verir kullanamayz parent veya baseclass das final ile tanimlandigi icin
    //     return "product";
    // }
}

$product=new Product;

//METHODLARDA FINAL KULLANIMI
//subclass bir inherit ettigi extends ettigi class in icinde final ile tanimlanmis fonksiyonu kullanabilir calistirabilir, ama problem surda subclass base class in icindekiki final ile tanimlanmis methodlari override edemez ayni isimde methodu kendi icinde bir kez daha tanimlayamaz, ama baseclass icindeki final ile tanimlanmis methodu kendisi eriserek kullanabilir...BU FARKLI IYI ANLAYALIM KARISTIRMAYALIM....
echo $product->test();

?>