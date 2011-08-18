<?php

class DidyoumeanActivation {

    /**
     * onActivate will be called if this returns true
     *
     * @param  object $controller Controller
     * @return boolean
     */
    public function beforeActivation(&$controller) {
        return true;
    }

    /**
     * Called after activating the plugin in ExtensionsPluginsController::admin_toggle()
     *
     * @param object $controller Controller
     * @return void
     */
    public function onActivation(&$controller) {
        $db = ConnectionManager::getDataSource('default');

        $this->__executeSQLScript($db, APP . 'plugins' . DS . 'didyoumean' . DS . 'config' . DS . 'sql' . DS . 'install.sql');
    }

    /**
     * onDeactivate will be called if this returns true
     *
     * @param  object $controller Controller
     * @return boolean
     */
    public function beforeDeactivation(&$controller) {
        return true;
    }

    /**
     * Called after deactivating the plugin in ExtensionsPluginsController::admin_toggle()
     *
     * @param object $controller Controller
     * @return void
     */
    public function onDeactivation(&$controller) {

    }

    function __executeSQLScript($db, $fileName) {
        $statements = file_get_contents($fileName);
        $statements = explode(';', $statements);

        foreach ($statements as $statement) {
            if (trim($statement) != '') {
                $db->query($statement);
            }
        }
    }

}

?>