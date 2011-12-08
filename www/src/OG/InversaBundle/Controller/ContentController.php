<?php

namespace OG\InversaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ContentController extends Controller
{
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
