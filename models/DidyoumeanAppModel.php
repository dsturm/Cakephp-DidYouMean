<?php

class DidyoumeanAppModel extends AppModel {

    function isCroogoInstalled() {
        //return is_file(CONFIGS . 'croogo_bootstrap.php');
        // TODO: Major HACK!!
        return false;
    }

}
»
?>