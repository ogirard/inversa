<?php

namespace OG\InversaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use OG\InversaBundle\Entity\AgendaItem;
use OG\InversaBundle\Form\AgendaItemType;

/**
 * AgendaItem controller.
 *
 * @Route("/admin/agendaitem")
 */
class AgendaItemController extends Controller
{
    /**
     * Lists all AgendaItem entities.
     *
     * @Route("/", name="admin_agendaitem")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('OGInversaBundle:AgendaItem')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a AgendaItem entity.
     *
     * @Route("/{id}/show", name="admin_agendaitem_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OGInversaBundle:AgendaItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AgendaItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array('entity' => $entity, 'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Displays a form to create a new AgendaItem entity.
     *
     * @Route("/new", name="admin_agendaitem_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new AgendaItem();
        $form = $this->createForm(new AgendaItemType(), $entity);

        return array('entity' => $entity, 'form' => $form->createView());
    }

    /**
     * Creates a new AgendaItem entity.
     *
     * @Route("/create", name="admin_agendaitem_create")
     * @Method("post")
     * @Template("OGInversaBundle:AgendaItem:new.html.twig")
     */
    public function createAction()
    {
        $entity = new AgendaItem();
        
        $originalDocs = Util::asArray($entity->getDocuments());
        $originalLinks = Util::asArray($entity->getLinks());
        $originalImages = Util::asArray($entity->getImages());
        
        $request = $this->getRequest();
        $form = $this->createForm(new AgendaItemType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
        	  $em = $this->getDoctrine()->getEntityManager();
        	  $this->updateReferences($entity);
        	  
        	  Util::syncItems($em, $originalDocs, $entity->getDocuments());
        	  Util::syncItems($em, $originalLinks, $entity->getLinks());
        	  Util::syncItems($em, $originalImages, $entity->getImages());        	  
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_agendaitem_show', array('id' => $entity->getId())));

        }

        return array('entity' => $entity, 'form' => $form->createView());
    }

    /**
     * Displays a form to edit an existing AgendaItem entity.
     *
     * @Route("/{id}/edit", name="admin_agendaitem_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OGInversaBundle:AgendaItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AgendaItem entity.');
        }

        $editForm = $this->createForm(new AgendaItemType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array('entity' => $entity, 'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Edits an existing AgendaItem entity.
     *
     * @Route("/{id}/update", name="admin_agendaitem_update")
     * @Method("post")
     * @Template("OGInversaBundle:AgendaItem:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OGInversaBundle:AgendaItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AgendaItem entity.');
        }

        $originalDocs = Util::asArray($entity->getDocuments());
        $originalLinks = Util::asArray($entity->getLinks());
        $originalImages = Util::asArray($entity->getImages());

        $editForm = $this->createForm(new AgendaItemType(), $entity);
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

                return $this->redirect($this->generateUrl('admin_agendaitem_edit', array('id' => $id)));
            }
        }

        return array('entity' => $entity,
                     'edit_form' => $editForm->createView(),
                     'delete_form' => $deleteForm->createView());
    }

    /**
     * Update the references of the collections
     *
     * @param \OG\InversaBundle\Entity\AgendaItem $entity
     */
    private function updateReferences(\OG\InversaBundle\Entity\AgendaItem $entity)
    {
        foreach ($entity->getDocuments() as $doc) {
            $doc->setAgendaitem($entity);
        }

        foreach ($entity->getImages() as $img) {
            $img->setAgendaitem($entity);
        }

        foreach ($entity->getLinks() as $link) {
            $link->setAgendaitem($entity);
        }
    }

    /**
     * Deletes a AgendaItem entity.
     *
     * @Route("/{id}/delete", name="admin_agendaitem_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('OGInversaBundle:AgendaItem')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AgendaItem entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_agendaitem'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))->add('id', 'hidden')->getForm();
    }
}
