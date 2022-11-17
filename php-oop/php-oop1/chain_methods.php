<?php 

//Zincirleme methodlar

use Database as GlobalDatabase;

class Database {
    
    private $sql;

    public function from($tableName){
        $this->sql="SELECT * FROM ".$tableName;
        echo $tableName."<br>";
        return $this;
    }

    //select kisinda da hangi kolonlari sectirecegizi belirleyebilirz

    public function select($columns){
        $this->sql=str_replace("*",$columns,$this->sql);
        return $this;
    }

    public function get(){
       // echo "Get"."<br>";
        return $this->sql;
    }
}



$db=new Database();
//$db->from("members")->select()->get();
//HARIKA BESTPRACTISE....BUNU DAHA ONCE HIC GORMEMISTIM....BU MUKEMMEL BIR YONTEMMMISSSSS SUPERRRR.HARIKA....BIR YONTEM.....
//Burda sunu yapmak istiyoruz from methodumu kulllanyim sonra, select metodumuz kullanayim ordan
// da get methodumu kullanarak zincrileme olarak bu islemleri yaparak islemlerimiz tamamlamak istiyoruz
//Bunu ancak nasil kullanabilirz, bunu yapabilmek icin bizim 1.methodu calistirinca return olarak oyle birsey dondurmeliyiz ki o return ile dondurdugmuz degeri alip , onunla gidip select i de calistirabilelim...o nedir tabi ki this dir...HARIKA BESTPRACTISE....MUKEMMEL

$db=$db->from("members")->select("memberId,memberName")->get();//Uyeler tablosundan get methodunu calistir diyrouz..dikkat edelim..

echo "<br>".$db;
//GEt metodunda da geriye sadece sql sorgusunu dondurmek istiyoruz
//SELECT * FROM members
//SELECT memberId,memberName FROM members

//MUKEMMEL HARIKA BIR BESTPRACTISE....BUNU KULLANMAYA IHTIYACIMIZ OLABILIR....HARIKA BESTPRACTISE ISLEMLER YAPABILIYORUZ
?>