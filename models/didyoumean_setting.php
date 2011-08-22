<?php

class DidyoumeanSetting extends DidyoumeanAppModel {

    var $name = 'DidyoumeanSetting';
    var $validate = array(
        'value' => array(
            'typeValidation'
        )
    );

    function typeValidation($check) {
        $type = $this->data['DidyoumeanSetting']['type'];
        $value = $this->data['DidyoumeanSetting']['value'];

        if ($type == 'boolean') {
            if (($value == '1' or $value == '0') AND strlen($value) == 1) {
                return true;
            } else {
                return false;
            }
        } elseif ($type == 'int') {
            if (is_int($value)) {
                return true;
            } else {
                return false;
            }
        }
        return true;
    }

    function get($name) {
        $value = $this->findByName($name);
        return $value['DidyoumeanSetting']['value'];
    }

    function getText() {
        if ($this->isCroogoInstalled()) {
            $setting = ClassRegistry::init('Setting');
            $language = $setting->findByKey('Site.locale');
            $language = $language['Setting']['value'];
        } else {
            $language = $this->get('language');
        }
        $text = $this->findByName('text_' . $language);
        return $text['DidyoumeanSetting']['value'];
    }

}

?>