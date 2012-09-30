<?php

namespace OG\InversaBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use OG\InversaBundle\Entity\ProjectItem;
use OG\InversaBundle\Form\ProjectItemType;

/**
 * ProjectItem controller.
 *
 * @Route("/admin/projectitem")
 */
class ProjectItemController extends Controller
{
  /**
   * Lists all ProjectItem entities.
   *
   * @Route("/", name="admin_projectitem")
   * @Template()
   */
  public function indexAction()
  {
    $em = $this->getDoctrine()->getEntityManager();

    $entities = $em->getRepository('OGInversaBundle:ProjectItem')->findAll();

    return array('entities' => $entities);
  }

  /**
   * Finds and displays a ProjectItem entity.
   *
   * @Route("/{id}/show", name="admin_projectitem_show")
   * @Template()
   */
  public function showAction($id)
  {
    $em = $this->getDoctrine()->getEntityManager();

    $entity = $em->getRepository('OGInversaBundle:ProjectItem')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find ProjectItem entity.');
    }

    $deleteForm = $this->createDeleteForm($id);

    return array('entity' => $entity, 'delete_form' => $deleteForm->createView(),);
  }

  /**
   * Displays a form to create a new ProjectItem entity.
   *
   * @Route("/new", name="admin_projectitem_new")
   * @Template()
   */
  public function newAction()
  {
    $entity = new ProjectItem();
    $form = $this->createForm(new ProjectItemType(), $entity);

    return array('entity' => $entity, 'form' => $form->createView());
  }

  /**
   * Creates a new ProjectItem entity.
   *
   * @Route("/create", name="admin_projectitem_create")
   * @Method("post")
   * @Template("OGInversaBundle:ProjectItem:new.html.twig")
   */
  public function createAction()
  {
    $entity = new ProjectItem();
    $originalDocs = Util::asArray($entity->getDocuments());
    $originalLinks = Util::asArray($entity->getLinks());
    $originalImages = Util::asArray($entity->getImages());

    $request = $this->getRequest();
    $form = $this->createForm(new ProjectItemType(), $entity);
    $form->bindRequest($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getEntityManager();
      $this->updateReferences($entity);

      Util::syncItems($em, $originalDocs, $entity->getDocuments());
      Util::syncItems($em, $originalLinks, $entity->getLinks());
      Util::syncItems($em, $originalImages, $entity->getImages());

      $em->persist($entity);
      $em->flush();

      return $this->redirect($this->generateUrl('admin_projectitem_show', array('id' => $entity->getId())));

    }

    return array('entity' => $entity, 'form' => $form->createView());
  }

  /**
   * Displays a form to edit an existing ProjectItem entity.
   *
   * @Route("/{id}/edit", name="admin_projectitem_edit")
   * @Template()
   */
  public function editAction($id)
  {
    $em = $this->getDoctrine()->getEntityManager();

    $entity = $em->getRepository('OGInversaBundle:ProjectItem')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find ProjectItem entity.');
    }

    $editForm = $this->createForm(new ProjectItemType(), $entity);
    $deleteForm = $this->createDeleteForm($id);

    return array('entity' => $entity, 'edit_form' => $editForm->createView(), 'delete_form' => $deleteForm->createView(),);
  }

  /**
   * Edits an existing ProjectItem entity.
   *
   * @Route("/{id}/update", name="admin_projectitem_update")
   * @Method("post")
   * @Template("OGInversaBundle:ProjectItem:edit.html.twig")
   */
  public function updateAction($id)
  {
    $em = $this->getDoctrine()->getEntityManager();

    // EXAMPLE FOR LOGGING
    $logger = $this->get('logger');
    $logger->info('$$MY: TEST for logging');

    $entity = $em->getRepository('OGInversaBundle:ProjectItem')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find ProjectItem entity.');
    }

    $originalDocs = Util::asArray($entity->getDocuments());
    $originalLinks = Util::asArray($entity->getLinks());
    $originalImages = Util::asArray($entity->getImages());

    $editForm = $this->createForm(new ProjectItemType(), $entity);
    $deleteForm = $this->createDeleteForm($id);

    $request = $this->getRequest();

    if ('POST' === $request->getMethod()) {
      $editForm->bindRequest($this->getRequest());

      if ($editForm->isValid()) {
        $this->updateReferences($entity);

        Util::syncItems($em, $originalDocs, $entity->getDocuments());
        Util::syncItems($em, $originalLinks, $entity->getLinks());
        Util::syncItems($em, $originalImages, $entity->getImages());

        $em->persist($entity);
        $em->flush();

        // redirect back to edit page
        return $this->redirect($this->generateUrl('admin_projectitem_edit', array('id' => $id)));
      }
    }

    return array('entity' => $entity, 'edit_form' => $editForm->createView(), 'delete_form' => $deleteForm->createView());
  }

  /**
   * Update the references of the collections
   * 
   * @param \OG\InversaBundle\Entity\ProjectItem $entity
   */
  private function updateReferences(\OG\InversaBundle\Entity\ProjectItem $entity)
  {
    foreach ($entity->getDocuments() as $doc) {
      $doc->setProjectitem($entity);
    }

    foreach ($entity->getImages() as $img) {
      $img->setProjectitem($entity);
    }

    foreach ($entity->getLinks() as $link) {
      $link->setProjectitem($entity);
    }
  }

  /**
   * Deletes a ProjectItem entity.
   *
   * @Route("/{id}/delete", name="admin_projectitem_delete")
   * @Method("post")
   */
  public function deleteAction($id)
  {
    $form = $this->createDeleteForm($id);
    $request = $this->getRequest();

    $form->bindRequest($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getEntityManager();
      $entity = $em->getRepository('OGInversaBundle:ProjectItem')->find($id);

      if (!$entity) {
        throw $this->createNotFoundException('Unable to find ProjectItem entity.');
      }

      $em->remove($entity);
      $em->flush();
    }

    return $this->redirect($this->generateUrl('admin_projectitem'));
  }

  private function createDeleteForm($id)
  {
    return $this->createFormBuilder(array('id' => $id))->add('id', 'hidden')->getForm();
  }
}
