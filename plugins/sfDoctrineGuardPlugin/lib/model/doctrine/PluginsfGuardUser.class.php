<?php
/*
 * Plugin class
 *
 */
abstract class PluginsfGuardUser extends BasesfGuardUser
{
    protected
        $allPermissions  = null,
        $groupNames      = null;

    public function __toString()
    {
      return $this->get('username');
    }

    public function setPassword($password)
    {
      # FIXME: why is this necessary?
      if ( ! $password)
      {
        return $this->get('password');
      }

      if ( ! $salt = $this->get('salt'))
      {
        $salt = md5( rand( 100000, 999999 ) . $this->get('username') );
        $this->set('salt', $salt );
      }
      if (!$algorithm = $this->getAlgorithm())
      {
        $algorithm = sfConfig::get('app_sf_guard_plugin_algorithm_callable', 'sha1');
      }
      $algorithmAsStr = is_array($algorithm) ? $algorithm[0] . '::' . $algorithm[1] : $algorithm;

      if ( ! is_callable($algorithm))
      {
        throw new sfException( sprintf( 'The algorithm callable "%s" is not callable.', $algorithmAsStr ) );
      }

      $this->set('algorithm', $algorithmAsStr);

      $password = call_user_func_array( $algorithm, array( $password ));
      
      $this->rawSet('password', call_user_func_array( $algorithm, array($salt . $password )));
    }
    
	public function setImportPassword($password)
    {
      # FIXME: why is this necessary?
      if ( ! $password)
      {
        return $this->get('password');
      }

      if ( ! $salt = $this->get('salt'))
      {
        $salt = md5( rand( 100000, 999999 ) . $this->get('username') );
        $this->set('salt', $salt );
      }
      if (!$algorithm = $this->getAlgorithm())
      {
        $algorithm = sfConfig::get('app_sf_guard_plugin_algorithm_callable', 'sha1');
      }
      $algorithmAsStr = is_array($algorithm) ? $algorithm[0] . '::' . $algorithm[1] : $algorithm;

      if ( ! is_callable($algorithm))
      {
        throw new sfException( sprintf( 'The algorithm callable "%s" is not callable.', $algorithmAsStr ) );
      }

      $this->set('algorithm', $algorithmAsStr);

      $this->rawSet('password', call_user_func_array( $algorithm, array($salt . $password )));
    }

    public function checkPassword($password)
    {
      if ($callable = sfConfig::get('app_sf_guard_plugin_check_password_callable'))
      {
        return call_user_func_array($callable, array($this->get('username'), $password, $this));
      }
      else
      {
        $algorithm = $this->get('algorithm');
        if (false !== $pos = strpos( $algorithm, '::' ))
        {
            $algorithm = array( substr( $algorithm, 0, $pos ), substr( $algorithm, $pos + 2 ) );
        }

        if ( ! is_callable($algorithm))
        {
            throw new sfException(sprintf('The algorithm callable "%s" is not callable.', $algorithm));
        }

        $password = call_user_func_array($algorithm, array( $password ));
        
        return $this->get('password') == call_user_func_array($algorithm, array($this->get('salt') . $password ));
      }
    }

    public function addGroupByName( $name )
    {
      $group = Doctrine::getTable('sfGuardGroup')->retrieveByName($name);

      if (!($group instanceof sfGuardGroup && $group->exists()))
      {
        throw new Exception( sprintf('The group "%s" does not exist.', $name));
      }

      $this->get('groups')->add($group);
    }

    public function addPermissionByName($name)
    {
      $permission = Doctrine::getTable('sfGuardPermission')->retrieveByName($name);
      
      if (!($permission instanceof sfGuardPermission && $permission->exists()))
      {
        throw new Exception(sprintf('The permission "%s" does not exist.', $name));
      }
      
      $this->get('permissions')->add($permission);
    }

    public function hasGroup( $name )
    {
      $group = Doctrine_Query::create()->from('sfGuardGroup')->where('sfGuardGroup.name = ? AND sfGuardGroup.users.id = ?', array($name, $this->get('id')))->execute()->getFirst();

      return ($group instanceof sfGuardGroup && $group->exists());
    }

    public function getGroupNames()
    {
      if( !$this->groupNames )
      {
        foreach($this->get('groups') AS $group)
        {
          $this->groupNames[$group->getName()] = $group->getName();
        }
      }

      return $this->groupNames;
    }

    public function hasPermission( $name )
    {
      $permission = Doctrine_Query::create()->from('sfGuardPermission')->where('sfGuardPermission.name = ? AND sfGuardPermission.users.id = ?', array($name, $this->get('id')))->execute()->getFirst();

      return ($permission instanceof sfGuardPermission && $permission->exists());
    }

    // merge of permission in a group + permissions
    public function getAllPermissions()
    {
      if ( !$this->allPermissions )
      {
        $this->allPermissions = array();

        foreach ( $this->get('groups') as $group )
        {
          foreach ( $group->get('permissions') as $permission )
          {
              $this->allPermissions[$permission->getName()] = $permission->getName();
          }
        }

        foreach( $this->get('permissions') as $permission )
        {
          $this->allPermissions[$permission->getName()] = $permission->getName();
        }
      }

      return $this->allPermissions;
    }

    public function getPermissionNames()
    {
      $names = Doctrine_Query::create()->select('p.name')->from('sfGuardPermission p')->where('p.users.id = ?', $this->get('id'))->execute();

      return $names;
    }

    public function getAllPermissionNames()
    {
      return array_keys( $this->getAllPermissions() );
    }

    public function reloadGroupsAndPermissions()
    {
      $this->allPermissions = null;
    }

    public function set($name, $value, $load = true)
    {
      // do nothing if trying to set the phony password_bis field
      if ($name == 'password_bis')
      {
        return;
      }

      return parent::set($name, $value, $load);
    }
    
    public static function getMembers($members = array()) {
    	$ids = implode(', ', $members);
    	if(strlen($ids)){
    		$q = Doctrine_Query::create()
    		->select('email_address AS email, first_name, last_name')
    		->from('sfGuardUser')
    		->whereIn('id', $ids);
    		return $q->fetchArray();
    	}
    }

    static public function hasEmailAddress()
    {
      try {
        $sfGuardUser = new sfGuardUser();
        $sfGuardUser->getEmailAddress();

        return true;
      } catch(Exception $e) {
        return false;
      }
    }

    private function _getPermissionIds() {
          $ids = Doctrine_Manager::connection()->fetchColumn("
                      SELECT up.permission_id
                      FROM sf_guard_user_permission up
                      WHERE up.user_id = ?", array($this->id));
          return $ids;
        }

    private function _getAllModulesAndActionsNames() {
        $ids = $this->_getPermissionIds();
        sfLoader::loadHelpers(array("MyCache"));
        if (!get_my_common_cache("all_modules_and_actions_for_user_".md5($this->id))) {
            set_my_common_cache("all_modules_and_actions_for_user_".md5($this->id),
                Doctrine_Manager::connection()->fetchAll("
                    SELECT m.module_name, m.action_name
                    FROM sf_guard_modules m
                    INNER JOIN sf_guard_modules_permission mp ON m.id = mp.module_id
                    WHERE mp.permission_id IN (?)", array(implode(",",$ids))
                )
            );
        }
        return get_my_common_cache("all_modules_and_actions_for_user_".md5($this->id));
    }

    public function getModuleList() {
        $output = array();
        $modules = $this->_getAllModulesAndActionsNames();
        foreach ($modules as $module) {
            $output[] = $module["module_name"].".".$module["action_name"];
        }
        return implode(", ", $output);
    }

    public function confirm()
    {

    }

    public function register($userInfo)
    {

    }
    
    public function getFullName()
    {
    	return $this->first_name.' '.$this->last_name;
    }
    
	public function getEmail()
    {
    	return $this->email_address;
    }
}