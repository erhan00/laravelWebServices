<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personel extends Model
{
    use HasFactory;

    protected $table = 'Personeller';
    protected $primaryKey = 'ID';
   // protected $fillable = ['name', 'FIRMA_ID'];

   /*
    public function firma()
    {
        return $this->belongsTo(firma::class, 'FIRMA_ID','ID');
    }

    public function esler()
    {
        return $this->hasOne(esler::class, 'PERSONEL_ID','ID');
    }
    */
}
