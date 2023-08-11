<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SehirModel extends Model
{
    use HasFactory;
    
    protected $table = 'city';

    /*
      Laravel'de Eloquent ORM ile ilişkisel veritabanı modellemesi yapmak için hasMany ilişki türü kullanılır. hasMany, bir
       modelin diğer bir modelle "birçok" ilişkisini ifade eder. Yani, bir modelin birden fazla başka modelle ilişkilendirildiği 
       durumlarda kullanılır.
      --hasMany ilişkisi tanımlandığında, Eloquent, veritabanında ilişkili tablodaki kayıtları ilişkili modelde toplar ve
        kullanımı kolay bir koleksiyon (Collection) olarak sunar.
    */
     // Kullanıcının birden fazla yazısı olabilir, bu ilişkiyi tanımlıyoruz
     /*
       "sehir_model" modeli içinde hasMany ilişkisi tanımlanmıştır. ilceler() metodu, sehir_model modelinin ilçeler modeliyle ilişkisini temsil eder. 
     */
  
     public function ilceler()
     {
         return $this->hasMany(IlceModel::class, 'il_id', 'id');//İlk parametre (IlceModel::class): İlişkili modelin sınıf adı veya tam yoludur. 
         // ilişkili (alt) tablodaki sütun adıdır.
         //Üçüncü parametre (id): Bu, birincil (ana) tablodaki anahtar sütununun adıdır
        }

   
}
