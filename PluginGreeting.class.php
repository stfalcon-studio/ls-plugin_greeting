<?php

/* ---------------------------------------------------------------------------
 * @Plugin Name: Greeting
 * @Plugin Id: greeting
 * @Plugin URI:
 * @Description:
 * @Author: stfalcon-studio
 * @Author URI: http://stfalcon.com
 * @LiveStreet Version: 0.4.2
 * @License: GNU GPL v2, http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * ----------------------------------------------------------------------------
 */

/**
 * Запрещаем напрямую через браузер обращение к этому файлу.
 */
if (!class_exists('Plugin')) {
    die('Hacking attemp!!');
}

class PluginGreeting extends Plugin {


    /**
     * Активация плагина
     *
     * @return boolean
     */
    public function Activate() {
        $this->Cache_Clean();
        return true;
    }

    /**
     * Инициализация плагина
     *
     * @return void
     */
    public function Init() {
    }

    /**
     * Деактивация плагина
     *
     * @return boolean
     */
    public function Deactivate() {
        $this->Cache_Clean();
        return true;
    }

}
