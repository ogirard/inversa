<?php

namespace OG\InversaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use OG\InversaBundle\Entity\CdItem;
use OG\InversaBundle\Form\CdItemType;

/**
 * CdItem controller.
 *
 * @Route("/admin/cditem")
 */
class CdItemController extends Controller
{
  /**
   * Lists all CdItem entities.
   *
   * @Route("/", name="admin_cditem")
   * @Template()
   */
  public function indexAction()
  {
    $em = $this->getDoctrine()->getEntityManager();

    $entities = $em->getRepository('OGInversaBundle:CdItem')->findAll();

    return array('entities' => $entities);
  }

  /**
   * Finds and displays a CdItem entity.
   *
   * @Route("/{id}/show", name="admin_cditem_show")
   * @Template()
   */
  public function showAction($id)
  {
    $em = $this->getDoctrine()->getEntityManager();

    $entity = $em->getRepository('OGInversaBundle:CdItem')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find CdItem entity.');
    }

    $deleteForm = $this->createDeleteForm($id);

    return array('entity' => $entity, 'delete_form' => $deleteForm->createView(),);
  }

  /**
   * Displays a form to create a new CdItem entity.
   *
   * @Route("/new", name="admin_cditem_new")
   * @Template()
   */
  public function newAction()
  {
    $entity = new CdItem();
    $form = $this->createForm(new CdItemType(), $entity);

    return array('entity' => $entity, 'form' => $form->createView());
  }

  /**
   * Creates a new CdItem entity.
   *
   * @Route("/create", name="admin_cditem_create")
   * @Method("post")
   * @Template("OGInversaBundle:CdItem:new.html.twig")
   */
  public function createAction()
  {
    $entity = new CdItem();
    $request = $this->getRequest();
    $form = $this->createForm(new CdItemType(), $entity);
    $form->bindRequest($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getEntityManager();
      $em->persist($entity);
      $em->flush();

      return $this->redirect($this->generateUrl('admin_cditem_show', array('id' => $entity->getId())));

    }

    return array('entity' => $entity, 'form' => $form->createView());
  }

  /**
   * Displays a form to edit an existing CdItem entity.
   *
   * @Route("/{id}/edit", name="admin_cditem_edit")
   * @Template()
   */
  public function editAction($id)
  {
    $em = $this->getDoctrine()->getEntityManager();

    $entity = $em->getRepository('OGInversaBundle:CdItem')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find CdItem entity.');
    }

    $editForm = $this->createForm(new CdItemType(), $entity);
    $deleteForm = $this->createDeleteForm($id);

    return array('entity' => $entity, 'edit_form' => $editForm->createView(), 'delete_form' => $deleteForm->createView(),);
  }

  /**
   * Edits an existing CdItem entity.
   *
   * @Route("/{id}/update", name="admin_cditem_update")
   * @Method("post")
   * @Template("OGInversaBundle:CdItem:edit.html.twig")
   */
  public function updateAction($id)
  {
    $em = $this->getDoctrine()->getEntityManager();

    $entity = $em->getRepository('OGInversaBundle:CdItem')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find CdItem entity.');
    }

    $editForm = $this->createForm(new CdItemType(), $entity);
    $deleteForm = $this->createDeleteForm($id);

    $request = $this->getRequest();

    $editForm->bindRequest($request);

    if ($editForm->isValid()) {
      $em->persist($entity);
      $em->flush();

      return $this->redirect($this->generateUrl('admin_cditem_edit', array('id' => $id)));
    }

    return array('entity' => $entity, 'edit_form' => $editForm->createView(), 'delete_form' => $deleteForm->createView(),);
  }

  /**
   * Deletes a CdItem entity.
   *
   * @Route("/{id}/delete", name="admin_cditem_delete")
   * @Method("post")
   */
  public function deleteAction($id)
  {
    $form = $this->createDeleteForm($id);
    $request = $this->getRequest();

    $form->bindRequest($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getEntityManager();
      $entity = $em->getRepository('OGInversaBundle:CdItem')->find($id);

      if (!$entity) {
        throw $this->createNotFoundException('Unable to find CdItem entity.');
      }
      
      $em->remove($entity);
      $em->flush();
    }

    return $this->redirect($this->generateUrl('admin_cditem'));
  }

  private function createDeleteForm($id)
  {
    return $this->createFormBuilder(array('id' => $id))->add('id', 'hidden')->getForm();
  }
}
