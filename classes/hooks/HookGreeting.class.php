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

class PluginGreeting_HookGreeting extends Hook
{

    /**
     * Регистрируем хуки
     * 
     * @return void
     */
    public function RegisterHook()
    {
	// цепляем хук на добавление нового пользователя
        $this->AddHook('module_user_add_after', 'GreetUser', __CLASS__);
    }

    /**
     * Отправляем приветствие новому пользователю
     * 
     * @param array $aVars
     * @return void
     */
    
    
    public function GreetUser($aVars)
    {
        $oUserTo = &$aVars['result'];
        if (!$oUserTo) {
	    // если пользователь не задан
            return;
        }

        if ($oUserFrom = $this->User_GetUserById(Config::Get('plugin.greeting.from_user_id'))) {
	    // пользователь указал язык при регистрации
	    if (in_array('l10n', $this->Plugin_GetActivePlugins())) {
		$sUserLang = getRequest('l10n_user_lang');
		
		if ($this->PluginL10n_L10n_IsAllowedLang($sUserLang)) {
		    $this->Lang_SetLang($sUserLang);
		}
	    }
	    
	    // формируем заголовок и текст сообщения
	    $sLogin = $oUserTo->getLogin();
	    $sUrl = Router::GetPath('page') . Config::Get('plugin.greeting.page_name');
            $sTitle = $this->Lang_Get('plugin.greeting.greeting_title');
            $sText = $this->Lang_Get('plugin.greeting.greeting_text', array('name' => $sLogin, 'url' => $sUrl,));
	    // создаем разговор
            $this->SendTalk($sTitle, $sText, $oUserFrom, $oUserTo);
        }
    }

    /**
     * Создаем разговор
     * 
     * @param string $sTitle
     * @param string $sText
     * @param ModuleUser_EntityUser $oUserFrom
     * @param ModuleUser_EntityUser $oUserTo 
     */
    protected function SendTalk($sTitle, $sText, ModuleUser_EntityUser $oUserFrom, ModuleUser_EntityUser $oUserTo)
    {
	// формируем массив пользователей, который будут участвовать в разговоре
        $aUserIdTo = array();
        $aUserIdTo[] = $oUserFrom->getId();
        $aUserIdTo[] = $oUserTo->getId();
	
	// создаем новый разговор
        $oTalk = Engine::GetEntity('Talk');
        $oTalk->setUserId($oUserFrom->getId());
        $oTalk->setTitle($sTitle);
        $oTalk->setText($sText);
        $oTalk->setDate(date("Y-m-d H:i:s"));
        $oTalk->setDateLast(date("Y-m-d H:i:s"));
    	// устанавливаем параметр UserIdLast 
        $oTalk->setTalkUserIdLast($oUserFrom->getId());
	// для того, чтобы пользователь от которого отправялются сообщения не видел их в списке своих сообщений
	// до тогов момента пока кто-то не напишет комментарий к сообщению
        $oTalk->setUserIp(Config::Get('IP_SENDER'));
	
	// добавляем пользователей к разговору
        if ($oTalk = $this->Talk_AddTalk($oTalk)) {
            foreach ($aUserIdTo as $iUserId) {
                $oTalkUser = Engine::GetEntity('Talk_TalkUser');
                $oTalkUser->setTalkId($oTalk->getId());
                $oTalkUser->setUserId($iUserId);
                if ($iUserId == $oUserFrom->getId()) {
                    $oTalkUser->setDateLast(date("Y-m-d H:i:s"));
                } else {
                    $oTalkUser->setDateLast(null);
                }

                $this->Talk_AddTalkUser($oTalkUser);
            }
        }
    }

}

