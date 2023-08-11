<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class esler extends Model
{
    use HasFactory;

    protected $table = 'Esler';
    protected $primaryKey = 'ID';

    //protected $fillable = ['detail', 'PERSONEL_İD'];

    /*
    public function personel()
    {
        return $this->belongsTo(personel::class, 'PERSONEL_ID','ID');
    }
    */
}
