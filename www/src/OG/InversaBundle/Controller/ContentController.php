<?php

namespace OG\InversaBundle\Controller;

use OG\InversaBundle\Entity\Document;
use OG\InversaBundle\Form\Type\DocumentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ContentController extends Controller
{
    public function testAction()
    {
        $request = $this->getRequest();
        $item = new Document();

        $form = $this->createForm(new DocumentType(), $item);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($item);
                $em->flush();
                return $this->render('OGInversaBundle:Content:index.html.twig', array('name' => 'Created document "'.$item->getName().'"'));
            }
        }

        return $this->render('OGInversaBundle:Content:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function homeAction()
    {
        return $this->render('OGInversaBundle:Content:index.html.twig', array('name' => 'home'));
    }

    public function agendaAction()
    {
        return $this->render('OGInversaBundle:Content:index.html.twig', array('name' => 'agenda'));
    }

    public function projectsAction()
    {
        return $this->render('OGInversaBundle:Content:index.html.twig', array('name' => 'projects'));
    }

    public function mediaAction()
    {
        return $this->render('OGInversaBundle:Content:index.html.twig', array('name' => 'media'));
    }

    public function pressAction()
    {
        return $this->render('OGInversaBundle:Content:index.html.twig', array('name' => 'press'));
    }

    public function galleryAction()
    {
        return $this->render('OGInversaBundle:Content:index.html.twig', array('name' => 'gallery'));
    }

    public function contactAction()
    {
        return $this->render('OGInversaBundle:Content:index.html.twig', array('name' => 'contact'));
    }
}
