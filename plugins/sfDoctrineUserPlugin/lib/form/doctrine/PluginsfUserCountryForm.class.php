<?php

/**
 * PluginsfUserCountry form.
 *
 * @package    form
 * @subpackage sfUserCountry
 * @author Stephen Ostrow <sostrow@sowebdesigns.com>
 * @version    SVN: $Id$
 */
abstract class PluginsfUserCountryForm extends BasesfUserCountryForm
{

  public function configure()
  {
    unset($this['updated_at'], $this['updated_by_user_id'],
          $this['created_at'], $this['created_by_user_id']);
  }
}
