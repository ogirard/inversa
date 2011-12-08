<?php

/**
 * project module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage project
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseProjectGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'syrinx_project' : 'syrinx_project_'.$action;
  }
}
