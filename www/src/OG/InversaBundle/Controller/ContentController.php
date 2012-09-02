<?php
namespace OG\InversaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\SwiftmailerBundle;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\MinLength;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;

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
        $em = $this->getDoctrine()->getEntityManager();
        $archiveDate = mktime(0, 0, 0, date("m") - 1, date("d"), date("Y"));
        $query = $em->getRepository('OGInversaBundle:AgendaItem')->createQueryBuilder('a')->where('a.eventdate > :archivedate AND a.isactive = true')
                ->setParameter('archivedate', date('Y-m-d h:i:s', $archiveDate))->orderBy('a.eventdate', 'ASC')->getQuery();
        $entities = $query->getResult();
        $nextEntity = -1;
        $now = date_create("now");
        foreach ($entities as $i => $entity) {
            $daysInFuture = date_diff($entity->getEventDate(), $now)->d;
            if (($daysInFuture == 0 || $entity->getEventDate() > $now) && $nextEntity == -1) {
                $nextEntity = $i;
            }
        }

        $logger = $this->get('logger');
        $logger->info('$$MY: ' . $nextEntity);

        // move next agenda item in the future to first position
        if ($nextEntity >= 0) {
            $e = $entities[$nextEntity];
            unset($entities[$nextEntity]);
            array_unshift($entities, $e);
        }

        return $this->render('OGInversaBundle:Content:agendacurrent.html.twig', array('name' => 'agendacurrent', 'entities' => $entities));
    }

    /**
     *
     * @Route("/agenda/archive", name="_content_agenda_archive")
     */
    public function agendaarchiveAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $archiveDate = mktime(0, 0, 0, date("m") - 1, date("d"), date("Y"));
        $query = $em->getRepository('OGInversaBundle:AgendaItem')->createQueryBuilder('a')->where('a.eventdate <= :archivedate AND a.isactive = true')
                ->setParameter('archivedate', date('Y-m-d h:i:s', $archiveDate))->orderBy('a.eventdate', 'DESC')->getQuery();
        $entities = $query->getResult();

        return $this
                ->render('OGInversaBundle:Content:agendaarchive.html.twig', array('name' => 'agendaarchive', 'entities' => $entities));
    }

    /**
     *
     * @Route("/projects", name="_content_projects")
     */
    public function projectsAction()
    {
    	  $em = $this->getDoctrine()->getEntityManager();
    	  $query = $em->getRepository('OGInversaBundle:ProjectItem')->createQueryBuilder('p')->where('p.isactive = true')->orderBy('p.day', 'DESC')->getQuery();
    	  $entities = $query->getResult();
        return $this->render('OGInversaBundle:Content:projects.html.twig', array('name' => 'projects', 'entities' => $entities));
    }

    /**
     *
     * @Route("/media/samples", name="_content_media")
     */
    public function mediaAction()
    {
        return $this->render('OGInversaBundle:Content:audiosamples.html.twig', array('name' => 'examples'));
    }

    /**
     *
     * @Route("/media/videos", name="_content_media_videos")
     */
    public function mediaVideosAction()
    {
        return $this->render('OGInversaBundle:Content:videos.html.twig', array('name' => 'videos'));
    }

    /**
     *
     * @Route("/media/press", name="_content_media_press")
     */
    public function mediaPressAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$query = $em->getRepository('OGInversaBundle:PressItem')->createQueryBuilder('p')->where('p.isactive = true')->orderBy('p.published', 'DESC')->getQuery();
    	$entities = $query->getResult();    	
      return $this->render('OGInversaBundle:Content:press.html.twig', array('name' => 'press', 'entities' => $entities));
    }

    /**
     *
     * @Route("/media/downloads", name="_content_media_downloads")
     */
    public function mediaSamplesAction()
    {
        return $this->render('OGInversaBundle:Content:downloads.html.twig', array('name' => 'downloads'));
    }

    /**
     *
     * @Route("/gallery", name="_content_gallery")
     */
    public function galleryAction()
    {
        return $this->render('OGInversaBundle:Content:galleries.html.twig', array('name' => 'gallery'));
    }

    /**
     *
     * @Route("/cds", name="_content_cds")
     */
    public function cdsAction()
    {
        return $this->render('OGInversaBundle:Content:cds.html.twig', array('name' => 'cds'));
    }

    /**
     *
     * @Route("/contact", name="_content_contact")
     */
    public function contactAction()
    {
        $request = $this->getRequest();
        $mailDataValidation = new Collection(
                array(
                        'name' => array(new NotBlank(array('message' => 'Bitte geben Sie Ihren Namen ein')),
                                new MinLength(array('limit' => 3, 'message' => 'Bitte geben Sie Ihren Namen ein'))),
                        'email' => array(new NotBlank(array('message' => 'Bitte geben Sie Ihre E-Mail ein')),
                                new Email(array('message' => 'Bitte geben Sie eine gültige E-Mail ein'))),
                        'message' => new NotBlank(array('message' => 'Bitte geben Sie eine Nachricht ein'))));

        $mailData = array();
        $form = $this->createFormBuilder($mailData, array('validation_constraint' => $mailDataValidation))
                ->add('name', 'text', array('required' => false, 'label' => 'Name'))
                ->add('email', 'email', array('required' => false, 'label' => 'E-Mail'))
                ->add('message', 'textarea', array('required' => false, 'label' => 'Nachricht'))
                ->add('captcha', 'captcha', array('width' => '100', 'height' => '32', 'required' => false))->getForm();

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {

                // data is an array with "name", "email", and "message" keys
                $data = $form->getData();
                $message = \Swift_Message::newInstance()->setSubject('Kontakt www.ensemble-inversa.ch')->setFrom($data['email'])
                        ->setTo('info@ensemble-inversa.ch')
                        ->setBody($this->renderView('OGInversaBundle:Content:email.txt.twig', $data));

                $this->get('mailer')->send($message);
                return $this
                        ->render('OGInversaBundle:Content:mailconfirm.html.twig', array('name' => 'contact', 'email' => $data['email']));
            }
        }

        return $this
                ->render('OGInversaBundle:Content:contact.html.twig', array('name' => 'contact', 'form' => $form->createView()));
    }

    /**
     * Finds and displays a Location entity.
     *
     * @Route("/{name}/eventlocation/{id}/show", name="_content_location_show")
     */
    public function showAction($name, $id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OGInversaBundle:Location')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Location entity.');
        }

        return $this->render('OGInversaBundle:Content:location.html.twig', array('name' => $name, 'entity' => $entity));
    }
}
