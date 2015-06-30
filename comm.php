<?php

class Common{
    public static function getSmarty(){
        $rootDir = dirname(__FILE__);
        require_once($rootDir. "/smarty/Smarty.class.php");
        $smarty = new Smarty();
        $smarty->setTemplateDir($rootDir . "/smarty/templates");
        $smarty->setCacheDir($rootDir."/working_temp/cache");
        $smarty->setCompileDir($rootDir."/working_temp/templates_c");
        $smarty->setConfigDir($rootDir."/working_temp/configs");

        return $smarty;
    }
}