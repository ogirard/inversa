<?php

namespace OG\InversaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use OG\InversaBundle\Entity\PressItem;
use OG\InversaBundle\Form\PressItemType;

/**
 * PressItem controller.
 *
 * @Route("/admin/pressitem")
 */
class PressItemController extends Controller
{
    /**
     * Lists all PressItem entities.
     *
     * @Route("/", name="admin_pressitem")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('OGInversaBundle:PressItem')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a PressItem entity.
     *
     * @Route("/{id}/show", name="admin_pressitem_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OGInversaBundle:PressItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PressItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array('entity' => $entity, 'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Displays a form to create a new PressItem entity.
     *
     * @Route("/new", name="admin_pressitem_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PressItem();
        $form = $this->createForm(new PressItemType(), $entity);

        return array('entity' => $entity, 'form' => $form->createView());
    }

    /**
     * Creates a new PressItem entity.
     *
     * @Route("/create", name="admin_pressitem_create")
     * @Method("post")
     * @Template("OGInversaBundle:PressItem:new.html.twig")
     */
    public function createAction()
    {
        $entity = new PressItem();
        $request = $this->getRequest();
        $form = $this->createForm(new PressItemType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_pressitem_show', array('id' => $entity->getId())));

        }

        return array('entity' => $entity, 'form' => $form->createView());
    }

    /**
     * Displays a form to edit an existing PressItem entity.
     *
     * @Route("/{id}/edit", name="admin_pressitem_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OGInversaBundle:PressItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PressItem entity.');
        }

        $editForm = $this->createForm(new PressItemType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array('entity' => $entity, 'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Edits an existing PressItem entity.
     *
     * @Route("/{id}/update", name="admin_pressitem_update")
     * @Method("post")
     * @Template("OGInversaBundle:PressItem:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OGInversaBundle:PressItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PressItem entity.');
        }

        $originalDocs = Util::asArray($entity->getDocuments());
        $originalLinks = Util::asArray($entity->getLinks());
        $originalImages = Util::asArray($entity->getImages());

        $editForm = $this->createForm(new PressItemType(), $entity);
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

                return $this->redirect($this->generateUrl('admin_pressitem_edit', array('id' => $id)));
            }
        }

        return array('entity' => $entity, 
                     'edit_form' => $editForm->createView(),
                     'delete_form' => $deleteForm->createView());
    }

    /**
     * Update the references of the collections
     * 
     * @param \OG\InversaBundle\Entity\PressItem $entity
     */
    private function updateReferences(\OG\InversaBundle\Entity\PressItem $entity)
    {
        foreach ($entity->getDocuments() as $doc) {
            $doc->setPressItem($entity);
        }

        foreach ($entity->getImages() as $img) {
            $img->setPressItem($entity);
        }

        foreach ($entity->getLinks() as $link) {
            $link->setPressItem($entity);
        }
    }

    /**
     * Deletes a PressItem entity.
     *
     * @Route("/{id}/delete", name="admin_pressitem_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('OGInversaBundle:PressItem')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PressItem entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_pressitem'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))->add('id', 'hidden')->getForm();
    }
}
