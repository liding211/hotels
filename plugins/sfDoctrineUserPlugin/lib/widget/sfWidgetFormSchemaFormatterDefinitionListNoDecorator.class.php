<?php

/**
 *
 *
 * @package    symfony
 * @subpackage widget
 * @author     Stephen Ostrow <sostrow@sowebdesigns.com>
 * @version    SVN: $Id$
 */
class sfWidgetFormSchemaFormatterDefinitionListNoDecorator extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "\n<dt>%label%</dt>\n<dd>%error%%field%%help%%hidden_fields%</dd>\n",
    $errorRowFormat  = "<li>\n%errors%</li>\n",
    $helpFormat      = '<span class="help">%help%</span>',
    $decoratorFormat = "\n%content%";
}
