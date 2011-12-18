<?php

namespace OG\InversaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use OG\InversaBundle\Entity\WebUrl;
use OG\InversaBundle\Form\WebUrlType;

/**
 * WebUrl controller.
 *
 * @Route("/admin/weburl")
 */
class WebUrlController extends Controller
{
    /**
     * Lists all WebUrl entities.
     *
     * @Route("/", name="admin_weburl")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('OGInversaBundle:WebUrl')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a WebUrl entity.
     *
     * @Route("/{id}/show", name="admin_weburl_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OGInversaBundle:WebUrl')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WebUrl entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new WebUrl entity.
     *
     * @Route("/new", name="admin_weburl_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new WebUrl();
        $form   = $this->createForm(new WebUrlType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new WebUrl entity.
     *
     * @Route("/create", name="admin_weburl_create")
     * @Method("post")
     * @Template("OGInversaBundle:WebUrl:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new WebUrl();
        $request = $this->getRequest();
        $form    = $this->createForm(new WebUrlType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_weburl_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing WebUrl entity.
     *
     * @Route("/{id}/edit", name="admin_weburl_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OGInversaBundle:WebUrl')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WebUrl entity.');
        }

        $editForm = $this->createForm(new WebUrlType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing WebUrl entity.
     *
     * @Route("/{id}/update", name="admin_weburl_update")
     * @Method("post")
     * @Template("OGInversaBundle:WebUrl:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OGInversaBundle:WebUrl')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WebUrl entity.');
        }

        $editForm   = $this->createForm(new WebUrlType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_weburl_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a WebUrl entity.
     *
     * @Route("/{id}/delete", name="admin_weburl_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('OGInversaBundle:WebUrl')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find WebUrl entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_weburl'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
