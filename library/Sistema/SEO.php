<?php

class Sistema_SEO {

    static function gerarAlias($sString) {

        $sString = utf8_decode($sString);

        $string = htmlentities(strtolower($sString));

        $string = preg_replace("/&(.)(acute|cedil|circ|ring|tilde|uml);/", "$1", $string);

        $string = preg_replace("/([^a-z0-9]+)/", "-", html_entity_decode($string));

        $string = trim($string, "-");

        return $string;
    }

    static function gerarTags($string, $limit = 20, $blacklist = null, $includelist = null) {

        $string = utf8_decode($string);
        $string = htmlentities(strtolower($string));
        $string = preg_replace("/&(.)(acute|cedil|circ|ring|tilde|uml);/", "$1", $string);
        $string = preg_replace("/([^a-z0-9]+)/", " ", html_entity_decode($string));
        $string = trim($string, " ");

        $tags = explode(" ", $string);

        if (!isset($blacklist) || is_null($blacklist)) {
            $blacklist = array();
        }


        $result = array();
        if (is_array($includelist) && !empty($includelist)) {
            $prioridade = 999999;
            foreach ($includelist as $word) {
                $result[$word] = $prioridade;
                $prioridade--;
            }
        }

        foreach ($tags as $tag) {
            if (!in_array($tag, $blacklist)) {
                if (!is_numeric($tag)) {

                    if (isset($result[$tag])) {
                        $result[$tag]++;
                    } else {
                        $result[$tag] = 1;
                    }
                }
            }
        }
        arsort($result);
        //Zend_Debug::dump($result);

        $keywords = '';
        $i = 0;
        foreach ($result as $key => $value) {
            //echo $key.' numero'.$value.'<br/>';
            ++$i;
            if ($i == $limit) {
                $keywords .= $key;
                break;
            } else {
                $keywords .= $key . ', ';
            }
        }

        return $keywords;
    }

    static function gerarDescription($content, $size = 160) {
        $content = str_replace("\n", " ", $content);
        $content = str_replace("\r", " ", $content);
        $content = trim($content);
        return substr($content, 0, ($size - 3)) . '...';
    }

}
