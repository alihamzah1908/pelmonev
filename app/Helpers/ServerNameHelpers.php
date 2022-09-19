<?php 
if (! function_exists('serverName')) {
    function serverName(){
        $host = explode(':',request()->getHttpHost());
        $host = $host[0];

        return 'HMI';

        /*
        if($host == str_replace('http://','',env('APP_URL'))){
            return 'sistem1';
        }else{
            return 'sistem2';
        }
        */
    }
}