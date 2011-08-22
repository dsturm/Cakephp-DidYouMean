<?php

class DidyoumeanAppError extends ErrorHandler {

    function languageNotDefined() {
        $this->_outputMessage('Language is not set in the DB, please set it in the didyoumean_settings table using 3-letter language code');
    }

}

?>