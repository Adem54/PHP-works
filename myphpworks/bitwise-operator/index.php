<?php 
/*
The Bitwise operators is used to perform bit-level operations on the operands. The operators are first converted to bit-level and then calculation is performed on the operands. The mathematical operations such as addition , subtraction , multiplication etc. can be performed at bit-level for faster processing. In PHP, the operators that works at bit level are:

& (Bitwise AND) : This is a binary operator i.e. it works on two operand. Bitwise AND operator in PHP takes two numbers as operands and does AND on every bit of two numbers. The result of AND is 1 only if both bits are 1.
Syntax:
$First & $Second

This will return another number whose bits are 
set if both the bit of first and second are set.
Input: $First = 5,  $Second = 3

Output: The bitwise & of both these value will be 1. 

Explanation:
Binary representation of 5 is 0101 and 3 is 0011. 
Therefore their bitwise & will be 0001 (i.e. set 
if both first and second have their bit set.)

Öncelikle bit nedir ne değildir?
C gibi Java gibi programlama dillerinde veri türü olarak bizim karşımıza çıkmaz genellikle bitler. Biz genellikle en küçük veri türü olarak byte kullanırız. Mesela C dilinde bir karakter (char) 1 byte yer tutar. Biz biliyoruz ki bir byte da 8 bitten oluşur. Bir bit de bir adet 1 veya 0’dan oluşur. Örnek vermek gerekirse küçük a harfini tutan karakter şu 8 bitten meydana gelir: 01100001

Bunu nasıl bulduğuma daha sonra geleceğiz.

Şimdi bytelar üzerinde bit bit işlemler yapabilmemiz için kullanabileceğimiz operatörlerden birkaç tanesine değineyim.
Sembol	Anlamı
&	bitwise AND
|	bitwise OR
<<	left shift
>>	right shift

Sağa Kaydırma (Right Shift)
Bir bit bloğu üzerinde sağa kaydırma işlemi uyguladığımız zaman o blok üzerindeki tüm bitler bir sağ pozisyona geçerler.
 En sağdaki bit kaybolur, en soldan bir adet 0 eklenir. Örneğin elimizde 4 bitlik 1011 bloğunun olduğunu düşünelim.
  Bunu bir defa sağa kaydırdığımız zaman elimizdeki blok 0101 olur.
*/

?>