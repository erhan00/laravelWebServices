<?php

namespace App\Http\Controllers\Antrenman;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deneme;
//valıdasyon kullnamak ıcın sınıf
use Illuminate\Support\Facades\Validator;
//findOrFail metodu ile istısnaları yakamak ıcın sınıf, bu sınıf verı tabanı sorgusunda belırlı bır modelın bulunamaması durumunda,ıstısna olusturur
use Illuminate\Database\Eloquent\ModelNotFoundException;
// laravel Debugbar ?
use App\Exceptions\ApiException;
//use RakutenTech\RequestDocs\LaravelRequestDocs;

class DenemeController extends Controller
{
    
    public function index(Request $request)
    {
      try 
       {
         //Tüm kayıtları çekmek için all()
         //$kayitlar = Deneme::all();

         $limit = $request->input('limit',10);//belirtılen sayıda kyt,buradada belırtılebılır: ---- 'limit',10 ---- seklınde,offset içinde gecerli
         $offset = $request->input('offset',0);
        
         $VarsayılanLimit = 500;
          //kulanıcıdan alınan limit degerı int ve 200 den kucukse $limit'i degerini al,yoksa $VarsayılanLimit degerını al.
         if($limit = is_numeric($limit) && $limit <= 500 ? $limit : $VarsayılanLimit){
            $uyari = "500'den_buyuk_limit_degeri_girilmesi_durumunda_default_olarak_500_kayıt_dondurulur.";
         }
         

         $kayitlar = DB::table('DENEME')
         ->skip($offset) // Offset değeri
         ->take($limit) // Limit değerin
         ->get();
        
         $ÇekilenVeri = $kayitlar->count();
         $ToplamVeri = DB::table('DENEME')->count();


          return response()->json(['success' => true, 'data' => $kayitlar, 'cekilen_veri_sayisi'=>$ÇekilenVeri,'toplam_veri_sayisi'=>$ToplamVeri,'limit_uyarisi'=>$uyari], 200);
        }   //catch (ModelNotFoundException $e) { ****limit ofset kullanımı için tablo adını dırek belırttıgımız ıcın boyle bır istısna yakalamaya gerek kalmadı.
            //return response()->json(['success' => false, 'Message' => 'Kayıtlar bulunamadı'], 404);// sunucu tarafı ıstenılen kaynak bulunamadı,burada ModelNotFoundException bu ıfade ile sunucu tarafında istenılen modelı aradıgından 404 ile kullanıcıya bıldırılmelı  
      catch (\Exception $e) {
        return response()->json(['success' => false, 'Message' => 'bir_hata_olustu'], 500);// sunucu tarafı genel hatalar
        }
    }


    /*
     @request-docs-path:Bu etiket, belgelenen API endpoint'in yolunu belirtir

     @request-docs-method:Bu etiket, belgelenen API endpoint'in HTTP metodu (GET, POST, PUT, DELETE, vb.)'nu belirtir. 

     @request-docs-desc:Bu etiket, belgelenen API endpoint'in kısa bir açıklamasını belirtir. 

     ve @request-docs-params:Bu etiket, belgelenen API endpoint'in alabileceği parametreleri ve bu parametrelerin tipini,
      zorunlu olup olmadığını ve açıklamalarını belirtir. JSON formatında verilir ve name, type,
       description ve required alanları içerir. gibi kodlar,

      rakutentech/laravel-request-docs paketini kullanarak Laravel projelerinde API endpoint'leri belgelemek için eklenen 
      özel belgeleme etiketleridir. Bu etiketler, FormRequest sınıfları ve kontroller içinde kullanılarak, 
      belirli endpoint'lerin dökümantasyonunu oluşturmak için kullanılır.
    */


    /*
     * store için yeni kaynak.
     * 
     * @request-docs-path /endpoints/deneme
     * @request-docs-method POST
     * @request-docs-desc store metodu için rules ve mesaj kısımları belirlendi.
     * @request-docs-params
     * [
     *  {
     *  "name":"NAME",
     *  "type":"string",
     *  "description":"prmtr 01",
     *  "required":true
     *  },
     *  {
     *  "name":"GENDER",
     *  "type":"string",
     *  "description":"prmtr 02",
     *  "required":true
     *  },
     *  {
     *  "name":"STUDENTNUMBER",
     *  "type":"integer",
     *  "description":"prmtr 03",
     *  "required":true
     *  }
     * ]
    */
    public function store(Request $request)
      {
       try{
        $NAME = $request->input('NAME'); 
        $GENDER = $request->input('GENDER');
        $STUDENTNUMBER =$request->input('STUDENTNUMBER');
         //$MaxStudentNumber = Deneme::max('STUDENTNUMBER');// deneme modelıne ait STUDENTNUMBER sutunundakı en yuksek degerı db'den al
       
         //Doğrulama kurallarını
        $rules = [
           'NAME' => 'required|string|max:255',
           'GENDER' => 'required|regex:/^[A-Z][a-z]*$/|in:Male,Female',
           'STUDENTNUMBER' =>'required|unique:DENEME'
        ];

       $messages = [
        'required' => ':attribute alanı zorunludur.',
        'in' => ':attribute değeri geçerli değil',
        'unique'=>'Bu Öğrenci Sayısı Verıtanında Mevcut'
        ];
         //spesifik olarak bir header verilmeyecekse Laravel zaten response-json() metoduyla bu content-type'ı sağlar.
      
         //Validator oluştur
        $validator = Validator::make($request->all(), $rules,$messages); // Validator::make, metodu, veri doğrulama kurallarını ve gelen verileri alır, doğrulama işlemini yapar ve sonuç olarak bir Validator nesnesi döndürür. Bu Validator nesnesi, başarısız olan doğrulama kurallarını içeren hata mesajlarına ve doğrulama sonucuna erişim sağlar.
          //($request->all(),  HTTP isteğindeki tüm verileri içeren bir dizi döndürür. Yani, isteğin gövdesindeki tüm verileri alır ve bir dizi olarak temsil eder.
        if ($validator->fails()) { // Validator nesnesının dogrulama durumunu kontrol eder,eger basarısızsa dogrulama "true",basarılı ıse "false"
          return response()->json(['errors' => $validator->errors()], 422);
         }
        

           $DbKayit = new Deneme();
           $DbKayit->NAME =$NAME;
           $DbKayit->STUDENTNUMBER = $STUDENTNUMBER;
           $DbKayit->GENDER = $GENDER;

        if ($DbKayit->save()) {
          return response()->json(['success' => true,'Message' => 'kayit_basariyla_olusturuldu.'],200);
         } 
       }
        catch (ModelNotFoundException $e) {
          return response()->json(['success' => false, 'Message' => 'kaynak_bulunamadi.'], 404);
        }
         catch (\Exception $e) {
          return response()->json(['success' => false, 'Message' => 'sistemsel_bir_hata_olustu.'], 500);
        }
      }
  

    public function show(int $id)
    {
      try
       {
         //Belirtilen ID'ye sahip kullanıcı
         $kullanıcı = Deneme::findOrFail($id);
        return response()->json(['success' => true, 'Data' => $kullanıcı], 200);
       }  
      catch (ModelNotFoundException $e) 
        {
         return response()->json(['success' => false, 'Message' => 'kullanici_bulunamadi.'], 404);
        } 
      catch (\Exception $e) 
        {
         return response()->json(['success' => false, 'Message' => 'sistemsel_bir_hata_olustu.'], 500);
        }
    }


    public function update(Request $request, int $id)
    {
      try
       {
         $kullanıcı = Deneme::findOrFail($id);
          //Doğrulama kuralları
         $rules = [
             'NAME' => 'required|string|max:255',
             'GENDER' => 'required|in:Male,Female',
            ];
          $messages = [
              'required' => ':attribute alanı zorunludur.',
               'in' => ':attribute değeri geçerli değil.',
            ];
           //Validator oluşturuyoruz ve gelen verileri doğruluyoruz
          $validator = Validator::make($request->all(), $rules, $messages);

            if($validator->fails())
            {
              throw new ApiException($validator->errors()->toArray(),406);
            }
             //return response()->json(['success' => false, 'Message' => $validator->errors()],406);***neden laravel ? ***
           
            $kullanıcı->NAME = $request->input('NAME');
            $kullanıcı->GENDER = $request->input('GENDER');
             // Verileri güncelle
             // ****  DB::enableQueryLog();
            if(!$kullanıcı->save())
              {throw new ApiException($kullanıcı->errors()->toArray(),406);}
             // ****  $queries = DB::getQueryLog();
             // ****  return response()->json(['success' => false, 'Message' => $queries ], 500);
             // if (!$success) {
             // Güncelleme başarısız olursa veritabanı sorgularını görmek için query log
            
            // dd($queries); // Sorguları görmek için kullanabilir
            //return response()->json(['success' => false, 'Message' => $queries ], 500);
            //}
        return response()->json(['success' => true, 'Message' => 'kullanici_bilgileri_guncellendi.'], 200);
      }
      catch (ModelNotFoundException $e) {
        return response()->json(['success' => false, 'Message' => 'kullanici_bulunamadi.'], 404);
     }
      catch (\Exception $e) {
        return response()->json(['success' => false, 'Message' =>'sistem_hatasi.'], 500);
     }
     catch(ApiException $e){
      // getCode:Exception sınıfı veya ondan türetilen diğer istisna sınıfları, $code adında bir özellik (property) içerirler.
      // Bu özellik, istisna nesnesinin hatanın türüne özgü bir sayısal kod içerebilir.
      //getMeesage:hata mesajı
       return response()->json(['success' => false, 'Message' =>'sistem_hatasi'],500);// $e->getMsg()],$e->getResponseCode());
     }
    }

  
    public function destroy($id)
    {
       try
      {
        Deneme::where('ID', $id)->delete();
        return response()->json(['success' => true,'Message' => 'kullaniciyi_veritabanından_silme_islemi_gerceklesti.'],200);
      }
      catch (ModelNotFoundException $e) {
        return response()->json(['success' => false, 'Message' => 'kayit_bulunamad.'], 404);
      }
       catch (\Exception $e){
        return response()->json(['success' => false, 'Message' => 'kayit_silinirken_sistemsel_bir_hata_olustu.'], 500);
     }
  }
}
