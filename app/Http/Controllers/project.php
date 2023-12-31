<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\projectsX;
use Illuminate\Database\QueryException;
use Exception;


class project extends Controller
{
    //
    public function getIssue($projeId)
    {
      try
    {
//        $proje = projectsX::find($ulkeId);
        $proje = projectsX::with('IssuesGet')->find($projeId);

        
        if (!$proje) {
            return response()->json(['Error' => 'proje_tablosu_bulunamadi'], 404);
        }

        $issues = $proje->issuesGet;

          // JSON cevabını döndürmeden önce "laravel_through_key" alanının çıkarılması.
        foreach ($issues as &$issue) {
            unset($issue['laravel_through_key']);
        }

        return response()->json(['PROJECT' => $proje]);
     }
     catch(Exception $e){
       return response()->json(['Success' => false, 'Message' => 'bir_hata_olustu'. $e->getMessage()], 500);
     }
    } 
    
}
