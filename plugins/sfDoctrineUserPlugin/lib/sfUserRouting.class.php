<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Stephen Ostrow <sostrow@sowebdesigns.com>
 * @version    SVN: $Id$
 */
class sfUserRouting
{

  static public function addRouteForAdminUser(sfEvent $event)
  {
    $event->getSubject()->prependRoute('sf_user_user', new sfDoctrineRouteCollection(array(
      'name'                => 'sf_user_user',
      'model'               => 'sfUserUser',
      'module'              => 'sfUserUser',
      'prefix_path'         => 'sf_user_user',
      'with_wildcard_routes' => true,
      'collection_actions'  => array('filter' => 'post', 'batch' => 'post'),
      'requirements'        => array(),
    )));
  }

  # Properties
  static public function addRouteForAdminAddress(sfEvent $event)
  {
    $event->getSubject()->prependRoute('sf_user_address', new sfDoctrineRouteCollection(array(
      'name'                => 'sf_user_address',
      'model'               => 'sfUserAddress',
      'module'              => 'sfUserAddress',
      'prefix_path'         => 'sf_user_address',
      'with_wildcard_routes' => true,
      'collection_actions'  => array('filter' => 'post', 'batch' => 'post'),
      'requirements'        => array(),
    )));
  }

  static public function addRouteForAdminBilling(sfEvent $event)
  {
    $event->getSubject()->prependRoute('sf_user_billing', new sfDoctrineRouteCollection(array(
      'name'                => 'sf_user_billing',
      'model'               => 'sfUserBilling',
      'module'              => 'sfUserBilling',
      'prefix_path'         => 'sf_user_billing',
      'with_wildcard_routes' => true,
      'collection_actions'  => array('filter' => 'post', 'batch' => 'post'),
      'requirements'        => array(),
    )));
  }

  static public function addRouteForAdminEmailAddress(sfEvent $event)
  {
    $event->getSubject()->prependRoute('sf_user_email_address', new sfDoctrineRouteCollection(array(
      'name'                => 'sf_user_email_address',
      'model'               => 'sfUserEmailAddress',
      'module'              => 'sfUserEmailAddress',
      'prefix_path'         => 'sf_user_email_address',
      'with_wildcard_routes' => true,
      'collection_actions'  => array('filter' => 'post', 'batch' => 'post'),
      'requirements'        => array(),
    )));
  }

  static public function addRouteForAdminPhone(sfEvent $event)
  {
    $event->getSubject()->prependRoute('sf_user_phone', new sfDoctrineRouteCollection(array(
      'name'                => 'sf_user_phone',
      'model'               => 'sfUserPhone',
      'module'              => 'sfUserPhone',
      'prefix_path'         => 'sf_user_phone',
      'with_wildcard_routes' => true,
      'collection_actions'  => array('filter' => 'post', 'batch' => 'post'),
      'requirements'        => array(),
    )));
  }

  static public function addRouteForAdminImAccount(sfEvent $event)
  {
    $event->getSubject()->prependRoute('sf_user_im_account', new sfDoctrineRouteCollection(array(
      'name'                => 'sf_user_im_account',
      'model'               => 'sfUserImAccount',
      'module'              => 'sfUserImAccount',
      'prefix_path'         => 'sf_user_im_account',
      'with_wildcard_routes' => true,
      'collection_actions'  => array('filter' => 'post', 'batch' => 'post'),
      'requirements'        => array(),
    )));
  }

  # Property Types
  static public function addRouteForAdminAddressType(sfEvent $event)
  {
    $event->getSubject()->prependRoute('sf_user_address_type', new sfDoctrineRouteCollection(array(
      'name'                => 'sf_user_address_type',
      'model'               => 'sfUserAddressType',
      'module'              => 'sfUserAddressType',
      'prefix_path'         => 'sf_user_address_type',
      'with_wildcard_routes' => true,
      'collection_actions'  => array('filter' => 'post', 'batch' => 'post'),
      'requirements'        => array(),
    )));
  }

  static public function addRouteForAdminEmailAddressType(sfEvent $event)
  {
    $event->getSubject()->prependRoute('sf_user_email_address_type', new sfDoctrineRouteCollection(array(
      'name'                => 'sf_user_email_address_type',
      'model'               => 'sfUserEmailAddressType',
      'module'              => 'sfUserEmailAddressType',
      'prefix_path'         => 'sf_user_email_address_type',
      'with_wildcard_routes' => true,
      'collection_actions'  => array('filter' => 'post', 'batch' => 'post'),
      'requirements'        => array(),
    )));
  }

  static public function addRouteForAdminPhoneType(sfEvent $event)
  {
    $event->getSubject()->prependRoute('sf_user_phone_type', new sfDoctrineRouteCollection(array(
      'name'                => 'sf_user_phone_type',
      'model'               => 'sfUserPhoneType',
      'module'              => 'sfUserPhoneType',
      'prefix_path'         => 'sf_user_phone_type',
      'with_wildcard_routes' => true,
      'collection_actions'  => array('filter' => 'post', 'batch' => 'post'),
      'requirements'        => array(),
    )));
  }

  static public function addRouteForAdminImAccountType(sfEvent $event)
  {
    $event->getSubject()->prependRoute('sf_user_im_account_type', new sfDoctrineRouteCollection(array(
      'name'                => 'sf_user_im_account_type',
      'model'               => 'sfUserImAccountType',
      'module'              => 'sfUserImAccountType',
      'prefix_path'         => 'sf_user_im_account_type',
      'with_wildcard_routes' => true,
      'collection_actions'  => array('filter' => 'post', 'batch' => 'post'),
      'requirements'        => array(),
    )));
  }

  # Configurations
  static public function addRouteForAdminCreditCardType(sfEvent $event)
  {
    $event->getSubject()->prependRoute('sf_user_credit_card_type', new sfDoctrineRouteCollection(array(
      'name'                => 'sf_user_credit_card_type',
      'model'               => 'sfUserCreditCardType',
      'module'              => 'sfUserCreditCardType',
      'prefix_path'         => 'sf_user_credit_card_type',
      'with_wildcard_routes' => true,
      'collection_actions'  => array('filter' => 'post', 'batch' => 'post'),
      'requirements'        => array(),
    )));
  }

  static public function addRouteForAdminState(sfEvent $event)
  {
    $event->getSubject()->prependRoute('sf_user_state', new sfDoctrineRouteCollection(array(
      'name'                => 'sf_user_state',
      'model'               => 'sfUserState',
      'module'              => 'sfUserState',
      'prefix_path'         => 'sf_user_state',
      'with_wildcard_routes' => true,
      'collection_actions'  => array('filter' => 'post', 'batch' => 'post'),
      'requirements'        => array(),
    )));
  }

  static public function addRouteForAdminCountry(sfEvent $event)
  {
    $event->getSubject()->prependRoute('sf_user_country', new sfDoctrineRouteCollection(array(
      'name'                => 'sf_user_country',
      'model'               => 'sfUserCountry',
      'module'              => 'sfUserCountry',
      'prefix_path'         => 'sf_user_country',
      'with_wildcard_routes' => true,
      'collection_actions'  => array('filter' => 'post', 'batch' => 'post'),
      'requirements'        => array(),
    )));
  }

  static public function addRouteForAdminAdvancedUser(sfEvent $event)
  {
    $event->getSubject()->prependRoute('sf_user_advanced_user', new sfDoctrineRouteCollection(array(
      'name'                => 'sf_user_advanced_user',
      'model'               => 'sfUserUser',
      'module'              => 'sfUserAdvancedUser',
      'prefix_path'         => 'sf_user_advanced_user',
      'with_wildcard_routes' => true,
      'collection_actions'  => array('filter' => 'post', 'batch' => 'post'),
      'requirements'        => array(),
    )));
  }

  static public function addRouteForAdminSimpleUser(sfEvent $event)
  {
    $event->getSubject()->prependRoute('sf_user_simple_user', new sfDoctrineRouteCollection(array(
      'name'                => 'sf_user_simple_user',
      'model'               => 'sfUserUser',
      'module'              => 'sfUserSimpleUser',
      'prefix_path'         => 'sf_user_simple_user',
      'with_wildcard_routes' => true,
      'collection_actions'  => array('filter' => 'post', 'batch' => 'post'),
      'requirements'        => array(),
    )));
  }

}
