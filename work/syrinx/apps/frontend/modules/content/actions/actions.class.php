<?php

/**
 * content actions for Akademie Syrinx Webpage.
 *
 * @package    syrinx
 * @subpackage content
 * @author     Olivier Girard
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contentActions extends sfActions
{
 /**
  * Executes index action (welcome)
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    // nothing to do
  }

 /**
  * Executes courses action
  *
  * @param sfRequest $request A request object
  */
  public function executeCourses(sfWebRequest $request)
  {

  }

 /**
  * Executes panflutes action
  *
  * @param sfRequest $request A request object
  */
  public function executePanflutes(sfWebRequest $request)
  {

  }

 /**
  * Executes projects action
  *
  * @param sfRequest $request A request object
  */
  public function executeProjects(sfWebRequest $request)
  {
    $this->syrinx_projects = Doctrine::getTable('SyrinxProject')->createQuery('p')->where('p.is_published=1')->execute();
  }


 /**
  * Executes calendar action
  *
  * @param sfRequest $request A request object
  */
  public function executeCalendar(sfWebRequest $request)
  {
    $this->syrinx_calendar = Doctrine::getTable('SyrinxCalendar')->createQuery('c')->where('c.is_published=1')->orderBy('c.date DESC')->execute();
  }

 /**
  * Executes about us action
  *
  * @param sfRequest $request A request object
  */
  public function executeAboutus(sfWebRequest $request)
  {

  }

 /**
  * Executes contact action
  *
  * @param sfRequest $request A request object
  */
  public function executeContact(sfWebRequest $request)
  {

  }
}

