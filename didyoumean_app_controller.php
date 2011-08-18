<?php

class DidyoumeanAppController extends AppController {

    var $version = '1.0';
    var $layout = "admin";

    function beforeFilter() {
        Cache::config('didyoumean', array(
                    'engine' => 'File',
                    'duration' => '1 hour',
                    'path' => CACHE,
                    'prefix' => 'plugin_didyoumean_'
                ));

        Cache::config('didyoumean', array(
                    'engine' => 'File',
                    'duration' => '1 second',
                    'path' => CACHE,
                    'prefix' => 'plugin_didyoumean_'
                ));

        $this->set('version', $this->version);
        $this->set('checkVersion', $this->checkVersion());
    }

    function checkVersion() {
        /*
        $cache = Cache::read('Didyoumean_checkVersion');
        if ($cache !== false) {
            debug("cache");
            return $cache;
        }

        /*$time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        $start = $time;
        */
        //$server = @fopen('https://raw.github.com/vistik/Cakephp-DidYouMean/master/config/version', 'r');
        /*
        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        $finish = $time;
        $total_time = round(($finish - $start), 4);
        echo 'Page generated in ' . $total_time . ' seconds.' . "\n";
        */

        /*
        $version = fread($server, '100');
        if ($version != $this->version) {
            Cache::write('Didyoumean_checkVersion', $version);
            return 'new version available. Goto to www.github.com/didyoumean';
        } else {
            Cache::write('Didyoumean_checkVersion', $version);
            return 'OK';
        }
        return "OK";
        */
    }

}

?>