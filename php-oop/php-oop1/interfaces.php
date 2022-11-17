<?php 
//Interfaces
//Abstract class lara benzer yanlari cok ama farklari da var

//Interface
//1-Interface tanimlarken sadece soyut methodlari ve const-sabitleri icerebiliyor
//2-Sadece public method tanimlanabiliyor
//3-Ayni sinifta birden fazla interface kullanilabilir....ISTE BU OZELLIK OZELLIKLE INTERFACE LERI FARKLI KILIYOR
//VE OZELLIKLE SURDURULEBLIR KODLAMA VE SISTEM KURABILME ADINDA HARIKA BESTRPACTISE ISLERI ORTAYA KOYABILMEMIZI SAGLIYOR
//4-Arayuzler kendi iclerinde yani bir interface diger bir interface i extedns edebiliyor  yani implement edebilyor veya iherit edebiliyor
//Bu da harika bir ozellikdir
//5-interface i implemente eden class larin, onun icerisinde tanimlanan metodlari mutlaka implemnt etmesi gerekir

//Abstract class
//1-abstract methods,const-sabitler, normal method ve ozellikleri icerir
//2-public, protected ve private olarak tanimlanabilir
//3-Bir class sadece 1 tane abstract class extends edebilir

interface CRUDBase{
    const DIR=__DIR__;
    public function create();
    public function read();
    public function update();
    public function detail();
}
//interface icerisine yazdgimz methodlar da abstract methodlardir ama baslarina abstract yazmiyoruz cunku interface ler de
//zaten abstract method disinda bir method yoktur ondan dolayi abstract diye belirtilmeye gerek  yoktur
//Aslinda bir nevi , bir design yapioruz interface ve abstract class lar ile ve o designe gore sistemimizi kurguluyoruz





abstract class CRUD  {
  abstract  public function create();
  abstract  public function read();
  abstract  public function update();
  abstract  public function detail();

 
}

//abstract class icerisindeki abstract methodlar onu extends eden class tarafindan kullanilmak zorundadir
class Mysql extends CRUD{

    public function create(){

    }


    public function read(){

    }

    public function update(){

    }

    public function detail(){

    }

}


//Extended interfaces
interface a{
    public function foo();
}
interface b {
    public function bar();
}

//interface ile interface i extends edebiliyoruz ama class lar interface leri implement ederler
interface c extends a,b{
    public function baz();
}

//interface i implement eden class lar o interface ler icerisindeki fonksiyonlari ki o fonksiyonlar zaten abstract olduklari icin onlari kullanmak zorundadir
class d implements c{
    public function foo(){

    }

    public function bar(){

    }

    public function baz(){

    }
}



//Real bir ornek-Gercek hayattan
interface CRUDD {
    public function create($tableName,$id);
    public function read($tableName,$id);
    public function update($tableName,$id);
    public function delete($tableName,$id);
}

class Test {

}


interface DB extends CRUDD {
    public function connection($host,$dbname,$user,$psw);
}
//Ornegin istersek DB yi Database in implements etmesi yerine DB ye de CRUDD u extends ettirerek
//direk CRUDD ve DB yerine sadece DB yi de kullanabilirz cunku DB de CRUDD u extends ettgi icn zaten DB
//Databas class i tarafindan implement edilince, hem DB nin kendi icindeki abstract class i hem de onun extends ettigi CRUDD interface ini
//kullanabilir

//Database i herhangi bir abstract class tan extends edip, sonra onunla beraber CRUDD interface ini de implement edebiliyoruz
//Yani bir class ayni anda bir abstract class veya herhangi bir class i extends edip , bir taraftanda bir interface i implement edebilir
//Bir class 1 den fazla interface implement edebilir
class Database extends Test implements CRUDD,DB {

        public function connection($host,$dbname,$user,$psw){

        }

        public function create($tableName,$id){

        }

        public function read($tableName,$id){

        }

        public function update($tableName,$id){

        }
        public function delete($tableName,$id){

        }
}


?>