<?php
/**
 * Created by PhpStorm.
 * User: usr0
 * Date: 9/23/19
 * Time: 2:17 AM
 */

namespace App\Exceptions;

use Throwable;
/*
  -**--**- use Throwable; ifadesi, PHP'de hata yakalama mekanizmalarını yönetmek için kullanılan Throwable arayüzünün kullanılacağını
    belirtmek için kullanılan bir "use" ifadesidir.
    Throwable, PHP 7 ile tanıtılan ve tüm hata ve istisna türlerinin uygulamada yakalanabilmesini sağlayan bir arayüzdür. 
    Hata yakalama işlemlerinde try-catch bloklarını kullanarak istisnaların ve hataların yakalanması ve işlenmesini sağlar. 
    Throwable arayüzü, Exception sınıfı ve tüm istisna sınıfları için temel arayüzü oluşturur.
*/

/**
 * Class ApiException
 * @package App\Exceptions
 * 
 */
  //@package ifadesi, PHP docblock yorumlarında kullanılan bir etikettir ve bir sınıfın veya dosyanın ait olduğu paketi
  // belirtmek için kullanılır.
  
class ApiException extends \Exception
{
    protected $msg;
    protected $responseCode;
    

  /*
    @param int ifadesi, PHP'deki docblock yorumlarında kullanılan bir etikettir. Docblock yorumları, fonksiyonlar ve metodlar
      için belgelendirme amacıyla kullanılır ve IDE'ler ve belgelendirme araçları tarafından okunabilir.
    @param int ifadesi, bir fonksiyon veya metodun parametrelerini belgelemek için kullanılır ve belirtildiği
      parametrenin türünü açıklar. int, bir tamsayı (integer) türünden parametre olduğunu belirtir.  
    @return int ifadesiyle fonksiyonun geri dönüş değerinin de bir tamsayı olduğu belirtir.  

    ---Docblock yorumları, kodun anlaşılabilirliğini artırır ve fonksiyonların nasıl kullanılacağına dair rehberlik sağlar. 
       IDE'ler, bu yorumları okuyarak fonksiyonları çağırırken otomatik tamamlama ve belgeleme özellikleri sunabilir.
  */


    /**
     * ApiException constructor.
     * @param array $msg
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(array $msg = [], int $code = 200, Throwable $previous = null)
    {
        // parent::__construct($message, $code, $previous);
        $this->msg = $msg;
        $this->responseCode = $code;
    }

    /**
     * @return array
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @return int
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }
}