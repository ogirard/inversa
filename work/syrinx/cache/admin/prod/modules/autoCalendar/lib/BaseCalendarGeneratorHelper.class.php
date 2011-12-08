<?php

/**
 * calendar module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage calendar
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCalendarGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'syrinx_calendar' : 'syrinx_calendar_'.$action;
  }
}
