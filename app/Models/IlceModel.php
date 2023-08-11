<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IlceModel extends Model
{
  protected $table = 'county'; // 

  public function il()
  {
      return $this->belongsTo(SehirModel::class, 'il_id', 'id');
  }
  /*
   IlceModel sınıfında ise belongsTo ilişkisini sehir() methodunda tanımlanır. Bu method, "SehirModel" ile ilişki kurar ve 
    "sehir_id" sütununu dış anahtar olarak kullanır. Bu method, "IlceModel" ile "SehirModel" arasındaki "bir" ilişkisini temsil
     eder ve ilçenin hangi şehire ait olduğunu belirtir.



    Bu kod parçası "public function sehir()" acıklama, "IlceModel" sınıfında "SehirModel" ile ilişki kurmak için kullanılan bir Eloquent ilişki methodunu temsil eder.
     Bu method, "IlceModel" sınıfının "sehir_id" sütununu kullanarak "SehirModel" sınıfı ile ilişkilendirir. Bu şekilde, "IlceModel"
      sınıfındaki her bir ilçe kaydı, bir şehre ait olduğunu belirtecek olan "SehirModel" sınıfı ile bağlantı kurar. 
    public function sehir() ***İsimlendirme, isteğe bağlı olarak seçilebilir, ancak genellikle "belongsTo" ilişkilerinde ilişkilendirilecek modelin tekil ismi kullanılır.
    {
        return $this->belongsTo(SehirModel::class, 'sehir_id', 'id');
    } 
  */
}
