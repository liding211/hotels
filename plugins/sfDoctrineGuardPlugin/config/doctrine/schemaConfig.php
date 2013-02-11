<?php
$config = array('group_table'            	=>  'sf_guard_group',
                'group_permission_table'  	=>  'sf_guard_group_permission',
                'permission_table'        	=>  'sf_guard_permission',
                'remember_key_table'      	=>  'sf_guard_remember_key',
                'user_table'              	=>  'sf_guard_user',
				'user_table_log'            =>  'sf_guard_user_log',
				'user_table_login'          =>  'sf_guard_user_login',
                'user_group_table'        	=>  'sf_guard_user_group',
                'user_permission_table'   	=>  'sf_guard_user_permission',
                'modules_table'   		  	=>  'sf_guard_modules',
				'modules_group_table'     	=>  'sf_guard_modules_group',
				'modules_permission_table'  =>  'sf_guard_modules_permission'
				);

if( is_readable($config_file = sfConfig::get('sf_config_dir').'/sfGuardDoctrinePlugin.yml') )
{
  $doctrine_comments_config = sfYaml::load($config_file);
  
  if(isset($doctrine_comments_config['schema']))
  {
    $config = array_merge($config, $doctrine_comments_config['schema']);
  }
}
