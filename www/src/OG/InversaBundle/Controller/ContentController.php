<?php

namespace OG\InversaBundle\Controller;
use OG\InversaBundle\Entity\Document;
use OG\InversaBundle\Entity\InversaUser;
use OG\InversaBundle\Form\Type\DocumentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ContentController extends Controller
{
    /**
     * 
     * @Route("/test", name="_content_test")
     */
    public function testAction()
    {
        $request = $this->getRequest();
        $item = new Document();

        $form = $this->createForm(new DocumentType("OG\InversaBundle\Entity\Document"), $item);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($item);
                $em->flush();
                return $this
                        ->render('OGInversaBundle:Content:index.html.twig',
                                array('name' => 'Created document "' . $item->getName() . '"'));
            }
        }

        return $this->render('OGInversaBundle:Content:new.html.twig', array('form' => $form->createView(),));
    }

    /**
     *
     * @Route("/adduser", name="_content_user")
     */
    public function adduserAction()
    {
        $request = $this->getRequest();
        $item = new InversaUser();
        $item->setUsername("admin");
        $item->setPassword("1234");
        $item->setName("Muster");
        $item->setFirstname("Hans");
        $item->setEmail("test@me.com");
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($item);
        $em->flush();

        return $this->render('OGInversaBundle:Content:index.html.twig', array('name' => 'done add user'));
    }

    /**
     *
     * @Route("/home", name="_content_home")
     */
    public function homeAction()
    {
        return $this->render('OGInversaBundle:Content:index.html.twig', array('name' => 'home'));
    }

    /**
     *
     * @Route("/agenda", name="_content_agenda")
     */
    public function agendaAction()
    {
        return $this->render('OGInversaBundle:Content:index.html.twig', array('name' => 'agenda'));
    }

    /**
     *
     * @Route("/projects", name="_content_projects")
     */
    public function projectsAction()
    {
        return $this->render('OGInversaBundle:Content:index.html.twig', array('name' => 'projects'));
    }

    /**
     *
     * @Route("/media", name="_content_media")
     */
    public function mediaAction()
    {
        return $this->render('OGInversaBundle:Content:index.html.twig', array('name' => 'media'));
    }

    /**
     *
     * @Route("/press", name="_content_press")
     */
    public function pressAction()
    {
        return $this->render('OGInversaBundle:Content:index.html.twig', array('name' => 'press'));
    }

    /**
     *
     * @Route("/gallery", name="_content_gallery")
     */
    public function galleryAction()
    {
        return $this->render('OGInversaBundle:Content:index.html.twig', array('name' => 'gallery'));
    }

    /**
     *
     * @Route("/contact", name="_content_contact")
     */
    public function contactAction()
    {
        return $this->render('OGInversaBundle:Content:index.html.twig', array('name' => 'contact'));
    }
}
