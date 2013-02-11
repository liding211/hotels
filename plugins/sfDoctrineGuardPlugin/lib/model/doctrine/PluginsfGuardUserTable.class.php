<?php
/*
 * Plugin class
 *
 */
abstract class PluginsfGuardUserTable extends Doctrine_Table
{
  static public function retrieveByUsername( $username, $isActive = true )
  {
    return Doctrine_Query::create()->from('sfGuardUser u')->where( 'u.username = ? AND u.is_active = ?', array( $username, $isActive ) )->execute()->getFirst();
  }

  static public function retrieveByUsernameOrEmailAddress( $usernameOrEmail, $isActive = true )
  {
    return Doctrine_Query::create()->from('sfGuardUser u')->where( 'u.email_address = ? AND u.is_active = ?', array( $usernameOrEmail, $isActive ) )->execute()->getFirst();
  }
  
  static public function findByEmail( $Email )
  {
    return Doctrine_Query::create()->from('sfGuardUser u')->where( 'u.email_address = ?', array( $Email ) )->fetchOne();
  }
  
  public static function findByRole($value)
  {
  	sfLoader::loadHelpers(array('MyCache'));
  	$res = get_my_cache(md5($value), 'Backend_Roles', 86000, 'cache_back_tmp');
  	if($res){
  		return $res;
  	}
    $res = Doctrine_Query::create()->from('sfGuardUser m')->leftJoin('m.sfGuardUserPermission mr')->leftJoin('mr.permission r')->
            where('r.name=?', $value)->
            orderBy('m.first_name ASC, m.last_name ASC')->
            execute();
    return set_my_cache(md5($value), 'Backend_Roles', $res, 86000, 'cache_back_tmp');
  }
  
  public static function findContentPersons() {
    return self::findByRole('content');
  }

  public static function findWriterPersons() {
    return self::findByRole('writer');
  }

  public static function findFormatterPersons() {
    return self::findByRole('formatter');
  }

  public static function findImageSpecialistPersons() {
    return self::findByRole('image_specialist');
  }

  public static function findEditorPersons() {
    return self::findByRole('editor');
  }

  public static function findVrRep() {
    return self::findByRole('vr_rep');
  }

  public static function findDataEntryPersons() {
    return self::findByRole('contract_data_entry_person');
  }
  
  public static function findValidators() {
    return self::findByRole('contract_validator');
  }
}
