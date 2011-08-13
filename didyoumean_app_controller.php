<?php

class DidyoumeanAppController extends AppController {

    var $version = '1.0';
    var $layout = "admin";
    
    function beforeFilter() {
        Cache::config('didyoumean', array(
            'engine' => 'File',
            'duration'=> '1 hour',
            'path' => CACHE,
            'prefix' => 'plugin_didyoumean_'
        ));

        Cache::config('didyoumean', array(
            'engine' => 'File',
            'duration'=> '1 second',
            'path' => CACHE,
            'prefix' => 'plugin_didyoumean_'
        ));

        $this->set('version',$this->version);
        $this->set('checkVersion',$this->checkVersion());

    }

    function checkVersion(){
        /*$cache = Cache::read('Didyoumean_checkVersion');
        if ($cache !== false){
            return $cache;
        }
        $server = @fopen('http://www.kloft.dk/getDidyoumeanVersion.php', 'r');
        $version = fread($server, '100');
        if ($version != $this->version){
            Cache::write();
            return 'new version available. Goto to www.github.com/didyoumean';
        }
        else{
            return 'OK';
        }
         *
         */
        return "OK";
    }
}

?>