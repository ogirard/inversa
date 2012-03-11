<?php

namespace OG\InversaBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/content")
 */
class ContentController extends Controller
{
    /**
     *
     * @Route("/", name="_content_home")
     */
    public function homeAction()
    {
        return $this->render('OGInversaBundle:Content:index.html.twig', array('name' => 'home'));
    }

    /**
     *
     * @Route("/inversa", name="_content_inversa")
     */
    public function inversaAction()
    {
        return $this->render('OGInversaBundle:Content:inversa.html.twig', array('name' => 'inversa'));
    }

    /**
     *
     * @Route("/inversa/panflute", name="_content_inversa_panflute")
     */
    public function panfluteAction()
    {
        return $this->render('OGInversaBundle:Content:panflute.html.twig', array('name' => 'panflute'));
    }

    /**
     *
     * @Route("/inversa/violin", name="_content_inversa_violin")
     */
    public function violinAction()
    {
        return $this->render('OGInversaBundle:Content:violin.html.twig', array('name' => 'violin'));
    }

    /**
     *
     * @Route("/inversa/flute", name="_content_inversa_flute")
     */
    public function fluteAction()
    {
        return $this->render('OGInversaBundle:Content:flute.html.twig', array('name' => 'flute'));
    }

    /**
     *
     * @Route("/inversa/organ", name="_content_inversa_organ")
     */
    public function organAction()
    {
        return $this->render('OGInversaBundle:Content:organ.html.twig', array('name' => 'organ'));
    }

    /**
     *
     * @Route("/agenda", name="_content_agenda")
     */
    public function agendaAction()
    {
        return $this->render('OGInversaBundle:Content:underconstruction.html.twig', array('name' => 'agendacurrent'));
    }

    /**
     *
     * @Route("/agenda/archive", name="_content_agenda_archive")
     */
    public function agendaarchiveAction()
    {
        return $this->render('OGInversaBundle:Content:underconstruction.html.twig', array('name' => 'agendaarchive'));
    }

    /**
     *
     * @Route("/projects", name="_content_projects")
     */
    public function projectsAction()
    {
        return $this->render('OGInversaBundle:Content:underconstruction.html.twig', array('name' => 'projects'));
    }

    /**
     *
     * @Route("/media", name="_content_media")
     */
    public function mediaAction()
    {
        return $this->render('OGInversaBundle:Content:underconstruction.html.twig', array('name' => 'examples'));
    }

    /**
     *
     * @Route("/media/videos", name="_content_media_videos")
     */
    public function mediaVideosAction()
    {
        return $this->render('OGInversaBundle:Content:underconstruction.html.twig', array('name' => 'videos'));
    }

    /**
     *
     * @Route("/media/press", name="_content_media_press")
     */
    public function mediaPressAction()
    {
        return $this->render('OGInversaBundle:Content:underconstruction.html.twig', array('name' => 'press'));
    }

    /**
     *
     * @Route("/media/downloads", name="_content_media_downloads")
     */
    public function mediaSamplesAction()
    {
        return $this->render('OGInversaBundle:Content:underconstruction.html.twig', array('name' => 'downloads'));
    }

    /**
     *
     * @Route("/gallery", name="_content_gallery")
     */
    public function galleryAction()
    {
        return $this->render('OGInversaBundle:Content:underconstruction.html.twig', array('name' => 'gallery'));
    }

    /**
     *
     * @Route("/cds", name="_content_cds")
     */
    public function cdsAction()
    {
        return $this->render('OGInversaBundle:Content:underconstruction.html.twig', array('name' => 'cds'));
    }

    /**
     *
     * @Route("/contact", name="_content_contact")
     */
    public function contactAction()
    {
        return $this->render('OGInversaBundle:Content:underconstruction.html.twig', array('name' => 'contact'));
    }
}
