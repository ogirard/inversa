<?php

namespace OG\InversaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use OG\InversaBundle\Entity\InversaUser;
use OG\InversaBundle\Form\InversaUserType;

/**
 * InversaUser controller.
 *
 * @Route("/admin/user")
 */
class InversaUserController extends Controller
{
    /**
     * Lists all InversaUser entities.
     *
     * @Route("/", name="admin_user")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('OGInversaBundle:InversaUser')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a InversaUser entity.
     *
     * @Route("/{id}/show", name="admin_user_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OGInversaBundle:InversaUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InversaUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new InversaUser entity.
     *
     * @Route("/new", name="admin_user_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new InversaUser();
        $form   = $this->createForm(new InversaUserType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new InversaUser entity.
     *
     * @Route("/create", name="admin_user_create")
     * @Method("post")
     * @Template("OGInversaBundle:InversaUser:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new InversaUser();
        $request = $this->getRequest();
        $form    = $this->createForm(new InversaUserType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_user_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing InversaUser entity.
     *
     * @Route("/{id}/edit", name="admin_user_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OGInversaBundle:InversaUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InversaUser entity.');
        }

        $editForm = $this->createForm(new InversaUserType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing InversaUser entity.
     *
     * @Route("/{id}/update", name="admin_user_update")
     * @Method("post")
     * @Template("OGInversaBundle:InversaUser:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OGInversaBundle:InversaUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InversaUser entity.');
        }

        $editForm   = $this->createForm(new InversaUserType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_user_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a InversaUser entity.
     *
     * @Route("/{id}/delete", name="admin_user_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('OGInversaBundle:InversaUser')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find InversaUser entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_user'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
