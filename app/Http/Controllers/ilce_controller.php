<?php

namespace App\Http\Controllers;

use App\Models\IlceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class ilce_controller extends Controller
{
    public function show($id)
    {
        $ilce = IlceModel::find($id);
        if (!$ilce) {
            return response()->json(['Message' => 'Ilce_bulunamadi'], 404);
        }
        //else{
           // return response()->json(['ilceBilgisi'=>$ilce], 200);
        //}
        $il = $ilce->il;
        if (!$il) {
           return response()->json(['Message' => 'Ilcenin_ait_oldugu_sehir_bulunamadi'], 404);
        }
        return response()->json(['city_name' => $il->il_adi]);
    }
    
}
