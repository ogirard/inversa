<?php

namespace OG\InversaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use OG\InversaBundle\Entity\GalleryItem;
use OG\InversaBundle\Form\GalleryItemType;

/**
 * GalleryItem controller.
 *
 * @Route("/admin/galleryitem")
 */
class GalleryItemController extends Controller
{
    /**
     * Lists all GalleryItem entities.
     *
     * @Route("/", name="admin_galleryitem")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('OGInversaBundle:GalleryItem')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a GalleryItem entity.
     *
     * @Route("/{id}/show", name="admin_galleryitem_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OGInversaBundle:GalleryItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GalleryItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array('entity' => $entity, 'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Displays a form to create a new GalleryItem entity.
     *
     * @Route("/new", name="admin_galleryitem_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new GalleryItem();
        $form = $this->createForm(new GalleryItemType(), $entity);

        return array('entity' => $entity, 'form' => $form->createView());
    }

    /**
     * Creates a new GalleryItem entity.
     *
     * @Route("/create", name="admin_galleryitem_create")
     * @Method("post")
     * @Template("OGInversaBundle:GalleryItem:new.html.twig")
     */
    public function createAction()
    {
        $entity = new GalleryItem();
        $request = $this->getRequest();
        $form = $this->createForm(new GalleryItemType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_galleryitem_show', array('id' => $entity->getId())));

        }

        return array('entity' => $entity, 'form' => $form->createView());
    }

    /**
     * Displays a form to edit an existing GalleryItem entity.
     *
     * @Route("/{id}/edit", name="admin_galleryitem_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OGInversaBundle:GalleryItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GalleryItem entity.');
        }

        $editForm = $this->createForm(new GalleryItemType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array('entity' => $entity, 'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Edits an existing GalleryItem entity.
     *
     * @Route("/{id}/update", name="admin_galleryitem_update")
     * @Method("post")
     * @Template("OGInversaBundle:GalleryItem:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OGInversaBundle:GalleryItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GalleryItem entity.');
        }

        $originalImages = Util::asArray($entity->getImages());

        $editForm = $this->createForm(new GalleryItemType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $editForm->bindRequest($this->getRequest());

            if ($editForm->isValid()) {
                $this->updateReferences($entity);

                Util::syncItems($em, $originalImages, $entity->getImages());

                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('admin_galleryitem_edit', array('id' => $id)));
            }
        }

        return array('entity' => $entity,
                     'edit_form' => $editForm->createView(),
                     'delete_form' => $deleteForm->createView());
    }

    /**
     * Update the references of the collections
     * 
     * @param \OG\InversaBundle\Entity\GalleryItem $entity
     */
    private function updateReferences(\OG\InversaBundle\Entity\GalleryItem $entity)
    {
        foreach ($entity->getImages() as $img) {
            $img->setGalleryitem($entity);
        }
    }

    /**
     * Deletes a GalleryItem entity.
     *
     * @Route("/{id}/delete", name="admin_galleryitem_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('OGInversaBundle:GalleryItem')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find GalleryItem entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_galleryitem'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))->add('id', 'hidden')->getForm();
    }
}
