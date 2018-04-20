<?php
class IndexController extends Controller
{
    public $key = "be171e00ea1fb022c8f09daef28e6c70";
    public $secret = "f51ffbfeed89";
    public $nonce = 0;

    public $headers = [];
    public $params = [];

    public function actionIndex()
    {

        var_dump($this->saveId());
    }

    public function getactonid()
    {
        $url = "https://api.netease.im/nimserver/user/create.action";
        $params = "accid=cc&name=x2";

        return $this->curl($url, $params, 1, 1);
    }

    public function saveId()
    {
        $url = "https://api.netease.im/nimserver/user/update.action";
        $params = "accid=cc";

        return $this->curl($url, $params, 1, 1);
    }

    private function getCheckSum($time)
    {
        return sha1($this->secret . $this->nonce . $time);
    }

    private function getHeaders()
    {
        $time = time();

        return [
            "AppKey:" . $this->key,
            "Nonce:0",
            "CurTime:".$time,
            "CheckSum:".$this->getCheckSum($time),
            "Content-Type:application/x-www-form-urlencoded"
        ];
    }

    /**
    * @param $url 请求网址
    * @param bool $params 请求参数
    * @param int $ispost 请求方式
    * @param int $https https协议
    * @return bool|mixed
    */
   public function curl($url, $params = false, $ispost = 0, $https = 0)
   {
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaders());
        //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($https) {
           curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
           curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        }

        if ($ispost) {
           curl_setopt($ch, CURLOPT_POST, true);
           curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
           curl_setopt($ch, CURLOPT_URL, $url);
        } else {
           if ($params) {
               if (is_array($params)) {
                   $params = http_build_query($params);
               }
               curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
           } else {
               curl_setopt($ch, CURLOPT_URL, $url);
           }
        }

        $response = curl_exec($ch);

        if ($response === FALSE) {
           //echo "cURL Error: " . curl_error($ch);
           return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
   }
}