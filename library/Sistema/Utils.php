<?php
class Sistema_Utils
{

    public static function getTitlePage($url){

        //Abre arquivo para gravação do cookie
        $fp = fopen("cookie.txt", "w");
        fclose($fp);

        //Inicialização do cURL
        $ch = curl_init();

        //Seta configuração
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        //Inicializa os cookies
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");

        //Seta o agente
        $agent = "Mozilla/5.0 (Windows; U; Windows NT 6.1; pt-BR; rv:1.9.2.13) Gecko/20101203 Firefox/3.6.13 GTB7.1";
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);

        //Seta url de referencia
        curl_setopt($ch, CURLOPT_REFERER, '');

        //Executa as requisições e faz o login
        $resp = curl_exec($ch);


        if( preg_match("#<title>(.+)<\/title>#iU", $resp, $t))  {
		return trim($t[1]);
	} else {
		return false;
	}

        
    }
	
	function arrayToObject($array) {
        if (!is_array($array)) {
            return $array;
        }

        $object = new stdClass();
        if (is_array($array) && count($array) > 0) {
            foreach ($array as $name => $value) {
                $name = strtolower(trim($name));
                if (!empty($name)) {
                    $object->$name = $this->arrayToObject($value);
                }
            }
            return $object;
        } else {
            return FALSE;
        }
    }



}