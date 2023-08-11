<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class firma extends Model
{
    use HasFactory;

    protected $table = 'Fırmalar';
    protected $primaryKey = 'ID';

    public function esler()
    {
        return $this->hasOneThrough(
            esler::class,
            personel::class,
            'FIRMA_ID', // Personeller tablosundaki firma_id sütunu
            'PERSONEL_ID', // Esler tablosundaki personel_id sütunu
            'ID', // Firmalar tablosundaki id sütunu
            'ID' // Personeller tablosundaki id sütunu
        );
    }
    
  /*
    public function personel()
    {
        return $this->hasOneThrough(
            personel::class,
            esler::class,
            'FIRMA_ID',   // Esler tablosundaki firma_id sütunu
            'ID',         // Personeller tablosundaki id sütunu
            'ID',         // Firmalar tablosundaki id sütunu
            'PERSONEL_ID' // Esler tablosundaki personel_id sütunu
        );
    }
  */
}
