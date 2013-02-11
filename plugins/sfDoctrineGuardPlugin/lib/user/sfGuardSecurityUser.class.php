<?php

/*
 * This file is part of the symfony package.
 * ( c ) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package        symfony
 * @subpackage plugin
 * @author         Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version        SVN: $Id: sfGuardSecurityUser.class.php 3187 2007-01-08 10:51:03Z fabien $
 */
class sfGuardSecurityUser extends sfBasicSecurityUser
{
    protected $user = null;
    protected $_allPermissions = null;
    protected $_Modules = null;
    protected $_Key = null;
    protected $_MyAcc = false;

    public function hasCredential($credential, $useAnd = true)
    {
        if ( empty($credential) )
        {
            return true;
        }
        
        if($this->_MyAcc){
        	return true;
        }

        if ( !$this->getGuardUser() )
        {
            return false;
        }

        if ( $this->getGuardUser()->getIsSuperAdmin() )
        {
            return true;
        }
        
        return parent::hasCredential( $credential, false );
    }
    
    public function checkEditMyAcc($module_name, $action_name, $requesParameter){
    	if($module_name == 'sfguarduser' && in_array($action_name, array('edit', 'save'))){
    		if($this->getGuardUser()->getIsSuperAdmin()){
    			return $this->_MyAcc = true;
    		} else if ($requesParameter['id'] == $this->user->id){
    			return $this->_MyAcc = true;
    		}
    	}
    	return false;
    }
    
    public function setModulesKey($module_name, $action_name){
    	$this->_Key = md5($module_name.'_'.$action_name);
    }
    
    public function getModulesCredentialByNameAndAction($module_name, $action_name){
    	self::setModules($module_name, $action_name);
    	return self::getModulesCredential();
    }
    
    public function setModules($module_name, $action_name){
    	sfLoader::loadHelpers(array('MyCache'));
    	$this->setModulesKey($module_name, $action_name);
    	$this->_Modules[$this->_Key] = get_my_cache($this->_Key, 'Backend_Modules', 86000, 'cache_back_tmp');
    	$this->_ModulesNo[$this->_Key] = get_my_cache($this->_Key, 'Backend_Modules_No', 86000, 'cache_back_tmp');
    	if(empty($this->_Modules[$this->_Key]) && !$this->_ModulesNo[$this->_Key]){
    		$this->_Modules[$this->_Key] = Doctrine_Query::create()->from('sfGuardModules m')->where('m.module_name = ?', $module_name)->addWhere('m.action_name = ?', $action_name)->addWhere('m.is_secure = 1')->fetchOne();
    		if(!$this->_Modules[$this->_Key]){
    			$this->_Modules[$this->_Key] = Doctrine_Query::create()->from('sfGuardModules m')->where('m.module_name = ?', $module_name)->addWhere('m.action_name = ?', 'all')->addWhere('m.is_secure = 1')->fetchOne();
    		}
    		set_my_cache($this->_Key, 'Backend_Modules', $this->_Modules[$this->_Key], 86000, 'cache_back_tmp');	
    		if(!$this->_Modules[$this->_Key]){
    			set_my_cache($this->_Key, 'Backend_Modules_No', 'no', 86000, 'cache_back_tmp');
    		}	
    	}
    }
    
    public function setCacheAllModules(){
    	sfLoader::loadHelpers(array('MyCache'));
    	if(!get_my_cache(1, 'Backend_Modules_All', 86000, 'cache_back_tmp')){
    		$modules = Doctrine_Query::create()->from('sfGuardModules m')->execute();
    		foreach ($modules AS $module){
    			if(!get_my_cache($this->_Key, 'Backend_Modules', 86000, 'cache_back_tmp')){
    				$this->setModulesKey($module->module_name, $module->action_name);
    				$this->_Modules[$this->_Key] = $module;
    				set_my_cache($this->_Key, 'Backend_Modules', $module, 86000, 'cache_back_tmp');
    				$this->getModulesCredential();
    			}
    		}
    		set_my_cache(1, 'Backend_Modules_All', true, 86000, 'cache_back_tmp');
    	}
    }
    
	public function getModulesCredential()
    {
    	sfLoader::loadHelpers(array('MyCache'));
    	$this->_allPermissions[$this->_Key] = get_my_cache($this->_Key, 'Backend_Modules_Permissions', 86000, 'cache_back_tmp');
    	$this->_allNoPermissions[$this->_Key] = get_my_cache($this->_Key, 'Backend_Modules_No_Permissions', 86000, 'cache_back_tmp');
        if ( !$this->_allPermissions[$this->_Key] && $this->_Modules[$this->_Key] && !$this->_allNoPermissions[$this->_Key])
        {
        	$this->_allPermissions[$this->_Key] = array();
        	foreach ( $this->_Modules[$this->_Key]->get('groups') as $group )
        	{
          		foreach ( $group->get('permissions') as $permission )
          		{
          			$this->_allPermissions[$this->_Key][$permission->getName()] = $permission->getName();
          		}
        	}
        	foreach( $this->_Modules[$this->_Key]->get('permissions') as $permission )
        	{
          		$this->_allPermissions[$this->_Key][$permission->getName()] = $permission->getName();
        	}
        	set_my_cache($this->_Key, 'Backend_Modules_Permissions', $this->_allPermissions[$this->_Key], 86000, 'cache_back_tmp');
        	if(empty($this->_allPermissions[$this->_Key])){
        		set_my_cache($this->_Key, 'Backend_Modules_No_Permissions', 'no', 86000, 'cache_back_tmp');
        	}
        }
        return array_keys($this->_allPermissions[$this->_Key]);
    }
    
    public function getModulesIsSecure()
    {
    	return $this->_Modules[$this->_Key]->is_secure;
    }

    public function getUsername()
    {
        return $this->getAttribute('username', null, 'sfGuardSecurityUser');
    }

    public function isSuperAdmin()
    {
        return $this->getGuardUser() ? $this->getGuardUser()->getIsSuperAdmin() : false;
    }

    public function isAnonymous()
    {
        return $this->getAttribute( 'user_id', null, 'sfGuardSecurityUser' ) ? false : true;
    }
    
    private function getip() {
    	if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    	} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
    		$ip = $_SERVER['HTTP_CLIENT_IP'];
    	} else {
    		$ip = $_SERVER['REMOTE_ADDR'];
    	}
    	return $ip;
    }

    public function signIn( $user, $remember = false )
    {
        // signin
        $this->setAttribute( 'user_id', $user->get('id'), 'sfGuardSecurityUser' );
        $this->setAttribute( 'username', $user->get('username'), 'sfGuardSecurityUser' );
        $this->setAuthenticated( true );
        $this->clearCredentials();
        $this->addCredentials( $user->getAllPermissionNames() );

        // Get a new date formatter
        $dateFormat = new sfDateFormat();

        // save last login
        $current_time_value = $dateFormat->format( time(), 'I' );
        $user->set('last_login', $current_time_value );
        $user->set('last_ip', $this->getip());
        $user->save();
        
        $login = new sfGuardUserLogin();
        $login->user_id = $user->id;
        $login->ip = $this->getip();
        $login->save();

        // remember?
        if ( $remember )
        {
            // remove old keys and keys from this user
            $expiration_age = sfConfig::get( 'app_sf_guard_plugin_remember_key_expiration_age', 15 * 24 * 3600 );
            $expiration_time_value = $dateFormat->format( time() - $expiration_age, 'I' );
            Doctrine_Query::create()->delete()->from( 'sfGuardRememberKey r' )->where( 'r.created_at < ? OR r.user_id = ?', array( $expiration_time_value, $user->getId() ) )->execute();

            // generate new keys
            $key = $this->generateRandomKey();

            // save key
            $rk = new sfGuardRememberKey();
            $rk->set('remember_key', $key );
            $rk->set('user', $user);
            $rk->set('ip_address', $_SERVER[ 'REMOTE_ADDR' ] );
            $rk->save();

            // make key as a cookie
            $remember_cookie = sfConfig::get( 'app_sf_guard_plugin_remember_cookie_name', 'sfRemember' );
            sfContext::getInstance()->getResponse()->setCookie( $remember_cookie, $key, time() + $expiration_age );
        }
    }

    protected function generateRandomKey( $len = 20 )
    {
        $string = '';
        $pool = 'abcdefghijklmnopqrstuvwzyzABCDEFGHIJKLMNOPQRSTUVWZYZ0123456789';
        for ( $i = 1; $i <= $len; $i++ )
        {
            $string .= substr( $pool, rand( 0, 61 ), 1 );
        }

        return md5( $string );
    }

    public function signOut()
    {
        $this->getAttributeHolder()->removeNamespace('sfGuardSecurityUser');
        $this->user = null;
        $this->clearCredentials();
        $this->setAuthenticated(false);
        $expiration_age = sfConfig::get('app_sf_guard_plugin_remember_key_expiration_age', 15 * 24 * 3600);
        $remember_cookie = sfConfig::get('app_sf_guard_plugin_remember_cookie_name', 'sfRemember');
        sfContext::getInstance()->getResponse()->setCookie($remember_cookie, '', time() - $expiration_age);
    }

    public function getGuardUser()
    {
        if ( ! $this->user && $id = $this->getAttribute('user_id', null, 'sfGuardSecurityUser' ))
        {
            $this->user = Doctrine::getTable('sfGuardUser')->find($id);

            if ( ! $this->user)
            {
                // the user does not exist anymore in the database
                $this->signOut();

                throw new sfException('The user does not exist anymore in the database.');
            }
        }

        return $this->user;
    }
    
    public function getCurrentMemberId(){
    	return $this->getGuardUser()->id;
    }

    public function getCurrentMember(){
    	return $this->getGuardUser();
    }
    
    public function setLog($module_name, $action_name, $requesParameter){
    	$actions_log = sfConfig::get('app_sf_guard_plugin_log_action', true);
    	$actions_no = sfConfig::get('app_sf_guard_plugin_no_log_action', 'index, list, locked');
    	$actions_no = explode(',', $actions_no);
    	$actions_no_arr = array();
    	if(!empty($actions_no)){
    		foreach ($actions_no AS $id=>$val){
    			$val = trim($val);
    			$actions_no_arr[$val] = $val;
    		}
    	}
    	$actions_log_no = in_array($action_name, $actions_no_arr);
    	if($this->getGuardUser()->is_log && !$actions_log_no && $actions_log){
    		$log = new sfGuardUserLog();
    		$log->user_id = $this->user->id;
    		$log->email = $this->user->email_address;
    		$log->module_name = $module_name;
    		$log->action_name = $action_name;
    		$log->url = $_SERVER['REQUEST_URI'];
    		if(defined('SF_GUARD_USER_LOG_PATH') && SF_GUARD_USER_LOG_PATH){
				$log->save();
				
				//SOMETHING TROBLE WITH AUTO DOCTRINE FUNCTION
				//NOT AUTO FILLED ID of $log->id
				$id = (int) Doctrine_Manager::connection()->fetchOne('SELECT LAST_INSERT_ID()');
				$log->id = $id;
				$filepath = SF_GUARD_USER_LOG_PATH.date('/Y/m/d/h/i/');
				if(!@fopen($filepath)){
					mkdir($filepath, 0755, true);
				}
				
				$filename = $filepath.$id;
				file_put_contents($filename, serialize($requesParameter));
				//$log->parameter = $filename;
				
				Doctrine_Manager::connection()->execute("UPDATE sf_guard_user_log SET parameter = '{$filename}' WHERE id = {$id}");
			}else{
				$log->parameter = serialize($requesParameter);
				$log->save();
			}
    		
    	}
    }
}
