<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\firma;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Exception;
class firmalar extends Controller
{
  //"Laravel hasOneThrough" ilişkisi, bir tablo üzerinden aracı bir tabloya ve nihayetinde hedef tabloya ulaşmanıza izin veren bir ilişki türüdür    
 
  public function showEsler($firmaId)
  {
    try{
      $firma = firma::with(['esler'])->find($firmaId);

      if (!$firma) {
          return response()->json(['error' => 'firma_bulunamadı'], 404);
      }

      return response()->json(['Firma_bilgileri_personel_tablosu_ile_iliskili_esler_tablosu_verileri : ' => $firma]);
      }
      catch(Exception $e){
        return response()->json(['success' => false, 'Message' => 'bir_hata_olustu'. $e->getMessage()], 500); 
      }
    }


  /*
    public function showEsler($ID)
    {
     try{
        $firma = firma::find($ID);
        // return response()->json(['error' => 'Firma bulundu',$firma], 200);

        if (!$firma) {
            return response()->json(['error' => 'Firma bulunamadı'], 404);
        }

        $esler = $firma->personel->flatMap(function($personel){
            return $personel->esler;
        });

        return response()->json(['firma' => $firma, 'esler' => $esler]);
     }
     catch (QueryException $e) {
        return response()->json(['success' => false, 'Message' => 'Veritabanı hatası: ' . $e->getMessage()], 500);
    }
    catch (Exception $e) {
        return response()->json(['success' => false, 'Message' => 'Bir hata oluştu'. $e->getMessage()], 500);
    }
    }

   */ 
}
