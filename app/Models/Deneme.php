<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deneme extends Model
{
    use HasFactory;
   // protected $fillable = [];

    protected $table = 'DENEME';
    protected $primaryKey = 'ID';
    /*
      -**- protected $primaryKey = 'ID'; model sınıfında $primaryKey özelliğini ID olarak ayarladık. Böylece Laravel, save() metodunu 
           kullanırken ID sütununu anahtar sütun olarak kabul edecek ve bu değeri güncelleme veya diğer işlemler için kullanacaktır.
    */
   // protected $guarded = ['id'];
    //protected $fillable = ['id'];
    //protected $primaryKey = 'id';
   /*
     Eğer $guarded özelliğinde ID sütununu belirtirseniz, bu durumda destroy() metodu ID değerini kullanarak veritabanında 
     kaydı silemeyecektir. Bunun nedeni, ID sütununun $guarded özelliği ile korunuyor olmasıdır.
  
   Bu durumu düzeltmek için $guarded özelliğinde ID sütununu çıkarabilir veya ID sütununu $fillable özelliğine ekleyebilirsiniz.
    $fillable özelliğine eklediğiniz alanlar, ekleme veya güncelleme işlemleri için güvenli alanlar olarak kabul edilir ve bu alanlara 
    doğrudan erişim sağlanır.
   */

}


/*
php artisan make:model Flight -f: Bu komut da aynı şekilde Flight adında bir Eloquent modeli oluştururken aynı zamanda buna ait bir fabrika sınıfı da oluşturur. "-f" kısaltması, "--factory" uzun komutunun kısa bir şeklidir.

Örneğin, bu komutları çalıştırdığınızda, "Flight.php" adında bir model dosyası ve "FlightFactory.php" adında bir fabrika sınıfı oluşturulacaktır. Model dosyası, app/Models klasöründe, fabrika sınıfı ise database/factories klasöründe yer alacaktır.

Model dosyası, Eloquent ORM tarafından kullanılacak olan veritabanı tablosunu temsil ederken, fabrika sınıfı, test verilerini oluşturmak için kullanılacak örnek verilerin tanımlandığı yerdir. Böylece testlerinizde model örneklerini kolayca oluşturabilir ve kullanabilirsiniz.

*/