<?php

namespace OG\InversaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use OG\InversaBundle\Entity\Location;
use OG\InversaBundle\Form\LocationType;

/**
 * Location controller.
 *
 * @Route("/admin/location")
 */
class LocationController extends Controller
{
  /**
   * Lists all Location entities.
   *
   * @Route("/", name="admin_location")
   * @Template()
   */
  public function indexAction()
  {
    $em = $this->getDoctrine()->getEntityManager();

    $entities = $em->getRepository('OGInversaBundle:Location')->findAll();

    return array('entities' => $entities);
  }

  /**
   * Finds and displays a Location entity.
   *
   * @Route("/{id}/show", name="admin_location_show")
   * @Template()
   */
  public function showAction($id)
  {
    $em = $this->getDoctrine()->getEntityManager();

    $entity = $em->getRepository('OGInversaBundle:Location')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find Location entity.');
    }

    $deleteForm = $this->createDeleteForm($id);

    return array('entity' => $entity, 'delete_form' => $deleteForm->createView(),);
  }

  /**
   * Displays a form to create a new Location entity.
   *
   * @Route("/new", name="admin_location_new")
   * @Template()
   */
  public function newAction()
  {
    $entity = new Location();
    $form = $this->createForm(new LocationType(), $entity);

    return array('entity' => $entity, 'form' => $form->createView());
  }

  /**
   * Creates a new Location entity.
   *
   * @Route("/create", name="admin_location_create")
   * @Method("post")
   * @Template("OGInversaBundle:Location:new.html.twig")
   */
  public function createAction()
  {
    $entity = new Location();
    $request = $this->getRequest();
    $form = $this->createForm(new LocationType(), $entity);
    $form->bindRequest($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getEntityManager();
      $em->persist($entity);
      $em->flush();

      return $this->redirect($this->generateUrl('admin_location_show', array('id' => $entity->getId())));

    }

    return array('entity' => $entity, 'form' => $form->createView());
  }

  /**
   * Displays a form to edit an existing Location entity.
   *
   * @Route("/{id}/edit", name="admin_location_edit")
   * @Template()
   */
  public function editAction($id)
  {
    $em = $this->getDoctrine()->getEntityManager();

    $entity = $em->getRepository('OGInversaBundle:Location')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find Location entity.');
    }

    $editForm = $this->createForm(new LocationType(), $entity);
    $deleteForm = $this->createDeleteForm($id);

    return array('entity' => $entity, 'edit_form' => $editForm->createView(), 'delete_form' => $deleteForm->createView(),
        'allowdelete' => !$this->hasDependencies($id));
  }

  /**
   * Edits an existing Location entity.
   *
   * @Route("/{id}/update", name="admin_location_update")
   * @Method("post")
   * @Template("OGInversaBundle:Location:edit.html.twig")
   */
  public function updateAction($id)
  {
    $em = $this->getDoctrine()->getEntityManager();

    $entity = $em->getRepository('OGInversaBundle:Location')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find Location entity.');
    }

    $editForm = $this->createForm(new LocationType(), $entity);
    $deleteForm = $this->createDeleteForm($id);

    $request = $this->getRequest();

    $editForm->bindRequest($request);

    if ($editForm->isValid()) {
      $em->persist($entity);
      $em->flush();

      return $this->redirect($this->generateUrl('admin_location_edit', array('id' => $id)));
    }

    return array('entity' => $entity, 'edit_form' => $editForm->createView(), 'delete_form' => $deleteForm->createView(),);
  }

  function hasDependencies($id)
  {
    $em = $this->getDoctrine()->getEntityManager();
    $entity = $em->getRepository('OGInversaBundle:Location')->find($id);

    $dependencies = 0;
    $queryAgenda = $em->getRepository('OGInversaBundle:AgendaItem')->createQueryBuilder('e')->where('e.location = :location_id')
        ->setParameter('location_id', $entity->getId())->getQuery();
    $dependencies += count($queryAgenda->getResult());
    $queryProject = $em->getRepository('OGInversaBundle:ProjectItem')->createQueryBuilder('e')->where('e.location = :location_id')
        ->setParameter('location_id', $entity->getId())->getQuery();
    $dependencies += count($queryProject->getResult());
    return $dependencies != 0;
  }

  /**
   * Deletes a Location entity.
   *
   * @Route("/{id}/delete", name="admin_location_delete")
   * @Method("post")
   */
  public function deleteAction($id)
  {
    if ($this->hasDependencies($id)) {
      return $this->redirect($this->generateUrl('admin_location_edit', array('id' => $id)));
    }

    $form = $this->createDeleteForm($id);
    $request = $this->getRequest();

    $form->bindRequest($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getEntityManager();
      $entity = $em->getRepository('OGInversaBundle:Location')->find($id);

      if (!$entity) {
        throw $this->createNotFoundException('Unable to find Location entity.');
      }

      $em->remove($entity);
      $em->flush();
    }

    return $this->redirect($this->generateUrl('admin_location'));
  }

  private function createDeleteForm($id)
  {
    return $this->createFormBuilder(array('id' => $id))->add('id', 'hidden')->getForm();
  }
}
