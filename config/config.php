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

$config = array();

$config['from_user_id'] = 1;	// id юзера от которого будут приходить сообщения
$config['page_name'] = 'about';	// имя страницы ссылка на которую будет подставляться в шаблон сообщения вместо %%url%%

if (!Config::Get('IP_SENDER')) {
    Config::Set('IP_SENDER', '255.255.255.255'); // подставляется в Talk, необходио так же для непоказа автору рассылки писем без ответов
}

return $config;