<?php

/**
 * sfUserAdvancedUserForm
 * This is a form containing every instance each object for an sfUser
 *
 * @package sfDoctrineUserPlugin
 * @author Stephen Ostrow <sostrow@sowebdesigns.com>
 * @copyright 2009 Stephen Ostrow
 * @license See LICENSE that came packaged with this software
 * @version SVN: $Id$
 *
 * @todo Add in rank moving of objects via two new actions (up/down)
 *
 */
class sfUserAdvancedUserForm extends sfUserUserForm
{

  /**
   * configure
   * Configures the form to add all the one-to-many embedded forms in this form
   *
   */
  public function configure()
  {
    parent:: configure();
    sfProjectConfiguration::getActive()->loadHelpers('Asset');

    # Setup sfGuardUser
    $sf_guard_user = new sfUserGuardUserForm($this->getObject()->getGuardUser());
    $sf_guard_user->validatorSchema['password']->setOption('required', false);
    $sf_guard_user->validatorSchema['password_confirmation']->setOption('required', false);
    unset($this['sf_guard_user_id']);
    $this->embedForm('sf_guard_user', $sf_guard_user);

    $this->oneToManyEmbeddedForm('Address');
    $this->oneToManyEmbeddedForm('Phone');
    $this->oneToManyEmbeddedForm('ImAccount');
    $this->oneToManyEmbeddedForm('EmailAddress');
    $this->oneToManyEmbeddedForm('Note');

  }

  /**
   * updateDefaultsFromObject
   * Updates the lists of permissions and groups from what the user has.
   *
   */
  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['sf_guard_user']['groups_list']))
    {
      $this->setDefault('groups_list', $this->object->getGuardUser()->groups->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['sf_guard_user']['permissions_list']))
    {
      $this->widgetSchema['sf_guard_user']->setDefault('permissions_list', $this->object->getGuardUser()->permissions->getPrimaryKeys());
    }

  }

  /**
   * updateObject
   * Intercepts the updateObject call to see if an action is set on the Object.
   *
   * @param unknown_type $values
   */
  public function updateObject($values = null)
  {
    if (is_null($values))
    {
      $values = $this->values;
    }

    $this->processOneToManyEmbeddedForm($values, 'Address');
    $this->processOneToManyEmbeddedForm($values, 'Phone');
    $this->processOneToManyEmbeddedForm($values, 'ImAccount');
    $this->processOneToManyEmbeddedForm($values, 'EmailAddress');
    $this->processOneToManyEmbeddedForm($values, 'Note');

    parent::updateObject($values);
  }

  /**
   * onetoManyEmbeddedForm
   * Adds in an embedded form of many object for the particular passed object
   *
   * @param string $object_name
   */
  protected function oneToManyEmbeddedForm($object_name)
  {
    $pluralizer = substr($object_name, -1) != 's' ? 's' : 'es';
    $object_prefix = sprintf('sf_user_%s_', strtolower($object_name));
    $container_form_name = sprintf('sf_user_%s%s', strtolower($object_name), $pluralizer);
    $object_relationship = sprintf('%s%s', $object_name, $pluralizer);
    $container_label = sprintf('%s%s', $object_name, $pluralizer);
    $object_class = sprintf('sfUser%s', $object_name);
    $object_form_class = sprintf('sfUser%sForm', $object_name);

    $objects_form = new sfForm();
    $objects = $this->object[$object_relationship];
    if ( count($objects) ) {
      foreach ( $objects as $i => $object ) {
        $object_form = new $object_form_class($object);
        unset($object_form['user_id']);
        $object_form->validatorSchema['action'] = new sfValidatorPass();
        $objects_form->embedForm($object_prefix.$object['id'], $object_form);
        $label = '<input type="submit" style="display: none;" />'; # This is so enter submits the form and does not delete the first record
        $label .= '<input type="image" alt="Delete" title="Delete" src="'.image_path('/sf/sf_admin/images/delete.png').'" name="sf_user_user['.$container_form_name.']['.$object_prefix.$object['id'].'][action]" value="delete" />';
        if (count($this->object[$object_relationship]) -1 == $i) {
          $label.= '<input type="image" alt="Add New" title="Add New" src="'.image_path('/sf/sf_admin/images/add.png').'" name="sf_user_user['.$container_form_name.']['.$object_prefix.$object['id'].'][action]" value="insert" />';
        }
        $label.= sprintf('%s %s', $object_name, ($i+1));
        $objects_form->getWidget($object_prefix.$object['id'])->setLabel($label);
      }
    } else {
      $new_object = $this->object[$object_relationship][] = new $object_class();
      $object_form = new $object_form_class($new_object);
      unset($object_form['user_id']);
      $objects_form->embedForm($object_prefix.'new', $object_form);
      $label= 'New '.$object_name;
      $objects_form->getWidget($object_prefix.'new')->setLabel($label);
    }
    $this->embedForm($container_form_name, $objects_form);
    $this->getWidget($container_form_name)->setLabel($container_label);
  }

  /**
   * processOneToManyEmbeddedForm
   * Processes the one-to-many embedded forms to see if that object should be deleted or another one added
   *
   * @param array $values
   * @param string $object_name
   */
  protected function processOneToManyEmbeddedForm($values, $object_name)
  {
    $pluralizer = substr($object_name, -1) != 's' ? 's' : 'es';
    $object_prefix = sprintf('sf_user_%s_', strtolower($object_name));
    $container_form_name = sprintf('sf_user_%s%s', strtolower($object_name), $pluralizer);
    $object_relationship = sprintf('%s%s', $object_name, $pluralizer);
    $container_label = sprintf('%s%s', $object_name, $pluralizer);
    $object_class = sprintf('sfUser%s', $object_name);
    $object_form_class = sprintf('sfUser%sForm', $object_name);

    foreach ( $values[$container_form_name] as $object ) {
      if ( isset($object['action']) ) {
        if ( $object['action'] == 'delete' ) {
          Doctrine::getTable($object_class)->find($object['id'])->delete();
        } else {
          $address = Doctrine::getTable($object_class)->find($object['id']);
          $address['User'][$object_relationship][] = new $object_class();
        }
      }
    }
  }

}
