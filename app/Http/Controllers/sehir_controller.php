<?php

namespace App\Http\Controllers;
use App\Models\SehirModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class sehir_controller extends Controller
{
    public function index()
    {

        $sehir = SehirModel::find(1);//"SehirModel" sınıfını temsil eden veritabanı tablosunda "id" sütununu (birincil anahtar sütunu)
          // kullanarak veritabanında bir kayıt arar. Bu sorguda, find() yöntemi "1" değeriyle çağrıldığından, veritabanında "id" değeri 1 olan bir kayıt aranacaktır.
         //return response()->json('sehırr',$sehir);
          $ilceler = $sehir->county; // İlgili ilin ilişkili ilçeleri

        $sehirler = SehirModel::all();

        // Her şehir için ilgili ilçeleri alın
        $sehirlerIlceler = [];
        foreach ($sehirler as $sehir) {
            $sehirIlceler = $sehir->ilceler()->get();
            $sehirlerIlceler[] = [
              'Şehir' => $sehir,
              'İlceler' => $sehirIlceler,
            ];
        }
        return response()->json([$sehirlerIlceler],200);
    }   

    

    public function show($id){
         // Belirli bir şehri bul
         $sehir = SehirModel::with('ilceler')->find($id);
         if ($sehir) {
          return response()->json(['Şehir' => $sehir],200);
         }
          return response()->json(['success'=>false,'message' => 'Şehir bulunamadı'], 404);
    }
    
}
