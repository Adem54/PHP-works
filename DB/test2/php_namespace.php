<?php 

//namespace nedir php de?
//Ayni isme sahip bir den fazla sinif olmasi durumunda karisikligi en aza indirmek icin kullanilan bir yapidir
//Tanimlamak icin namespace anahtar kelimesi kullanilir

namespace PrimarySchool;

class Student 
{

}
//Tanimlama yaparken dosyadaki ilk komut namespace olmalidir
//Aksi takdirde PHP Fatal Error verecektir.
//Bir dosya icinde birden fazla namespace olabilir
//Karışıklığı önlemek için namespace kapsama alanı süslü parantez ile belirtilebilir.

namespace HighSchool;
class Student{

}

//Bir dosya içinde genellikle tek namespace kullanılır.
//Tanımlama ters çizgi (\) ile gruplara ayrılabilir.

namespace Ogrenciler\IlkOkul;  // gruplara ayrılan namepsace

class Ogrenci {
  
}

namespace Ogrenciler\Lise;

//Tanımlanan namespace içindeki sınıflara ters çizgi (\) ile erişilir.

namespace Ogrenciler\IlkOkul;

class Ogrenci {
  
}

namespace Ogrenciler\Lise;

class Ogrenci extends \Ogrenciler\IlkOkul\Ogrenci {  // başka bir namespace erişim
  
}

$ben = new \Ogrenciler\IlkOkul\Ogrenci();

//Tanımlanan namespace’lerden birini seçmek için use anahtar kelimesi kullanılır.

//Benzer ada sahip namepsace’lere as anahtar kelimesiyle takma ad verilebilir.
//BURASI COOK ONEMLI...ALYAS VERILMIS...
include_once './namespace.php';

use Ogrenciler\IlkOkul\Ogrenci as YeniOgrenci;  // IlkOkul içindeki Ogrenci sınıfı artık YeniOgrenci oldu.
use Ogrenciler\Lise\Ogrenci;

$ben = new YeniOgrenci();

echo get_class($ben);
?>