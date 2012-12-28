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
use Symfony\Component\Validator\Constraints\Min;
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
    $archiveDate = strtotime("-3 months");
    $nowDate = strtotime("-1 day");
    $query = $em->getRepository('OGInversaBundle:AgendaItem')->createQueryBuilder('a')->where('a.eventdate > :archivedate AND a.eventdate <= :nowdate AND a.isactive = true')
        ->setParameter('archivedate', date('Y-m-d h:i:s', $archiveDate))->setParameter('nowdate', date('Y-m-d h:i:s', $nowDate))->orderBy('a.eventdate', 'DESC')->getQuery();
    $entities = $query->getResult();
    $querynext = $em->getRepository('OGInversaBundle:AgendaItem')->createQueryBuilder('a')->where('a.eventdate >= :nowdate AND a.isactive = true')
        ->setParameter('nowdate', date('Y-m-d h:i:s', $nowDate))->orderBy('a.eventdate', 'ASC')->getQuery();
    $entitiesnext = $querynext->getResult();
    
    $logger = $this->get('logger');
    return $this->render('OGInversaBundle:Content:agendacurrent.html.twig', array('name' => 'agendacurrent', 'entities' => $entities, 'entitiesnext' => $entitiesnext));
  }

  /**
   *
   * @Route("/agenda/archive", name="_content_agenda_archive")
   */
  public function agendaarchiveAction()
  {
    $em = $this->getDoctrine()->getEntityManager();
    // $archiveDate = mktime(0, 0, 0, date("m") - 3, date("d"), date("Y"));
    $archiveDate = strtotime("-3 months");
    $query = $em->getRepository('OGInversaBundle:AgendaItem')->createQueryBuilder('a')->where('a.eventdate <= :archivedate AND a.isactive = true')
        ->setParameter('archivedate', date('Y-m-d h:i:s', $archiveDate))->orderBy('a.eventdate', 'DESC')->getQuery();
    $entities = $query->getResult();

    return $this->render('OGInversaBundle:Content:agendaarchive.html.twig', array('name' => 'agendaarchive', 'entities' => $entities));
  }

  /**
   *
   * @Route("/projects", name="_content_projects")
   */
  public function projectsAction()
  {
    $em = $this->getDoctrine()->getEntityManager();
    $query = $em->getRepository('OGInversaBundle:ProjectItem')->createQueryBuilder('p')->where('p.isactive = true')->orderBy('p.day', 'DESC')
        ->getQuery();
    $entities = $query->getResult();
    return $this->render('OGInversaBundle:Content:projects.html.twig', array('name' => 'projects', 'entities' => $entities));
  }

  /**
   *
   * @Route("/media/samples", name="_content_media")
   */
  public function mediaAction()
  {
    $em = $this->getDoctrine()->getEntityManager();
    $query = $em->getRepository('OGInversaBundle:MediaItem')->createQueryBuilder('a')->where('a.isactive = true')->getQuery();
    $entities = $query->getResult();
    $audioentities = array();
    foreach ($entities as $item) {
      if ($item->getMediaType() == 'Audio') {
        $audioentities[] = $item;
      }
    }

    return $this->render('OGInversaBundle:Content:audiosamples.html.twig', array('name' => 'examples', 'entities' => $audioentities));
  }

  /**
   *
   * @Route("/media/videos", name="_content_media_videos")
   */
  public function mediaVideosAction()
  {
    $em = $this->getDoctrine()->getEntityManager();
    $query = $em->getRepository('OGInversaBundle:MediaItem')->createQueryBuilder('a')->where('a.isactive = true')->getQuery();
    $entities = $query->getResult();
    $videoentities = array();
    foreach ($entities as $item) {
      if ($item->getMediaType() == 'Video') {
        $videoentities[] = $item;
      }
    }

    return $this->render('OGInversaBundle:Content:videos.html.twig', array('name' => 'videos', 'entities' => $videoentities));
  }

  /**
   *
   * @Route("/media/press", name="_content_media_press")
   */
  public function mediaPressAction()
  {
    $em = $this->getDoctrine()->getEntityManager();
    $query = $em->getRepository('OGInversaBundle:PressItem')->createQueryBuilder('p')->where('p.isactive = true')->orderBy('p.published', 'DESC')
        ->getQuery();
    $entities = $query->getResult();
    return $this->render('OGInversaBundle:Content:press.html.twig', array('name' => 'press', 'entities' => $entities));
  }

  /**
   *
   * @Route("/media/downloads", name="_content_media_downloads")
   */
  public function downloadsAction()
  {
    return $this->render('OGInversaBundle:Content:downloads.html.twig', array('name' => 'downloads'));
  }

  /**
   *
   * @Route("/gallery", name="_content_gallery")
   */
  public function galleryAction()
  {
    $em = $this->getDoctrine()->getEntityManager();
    $query = $em->getRepository('OGInversaBundle:GalleryItem')->createQueryBuilder('g')->where('g.isactive = true')->orderBy('g.published', 'DESC')
        ->getQuery();
    $entities = $query->getResult();
    return $this->render('OGInversaBundle:Content:galleries.html.twig', array('name' => 'gallery', 'entities' => $entities));
  }

  /**
   *
   * @Route("/cds", name="_content_cds")
   */
  public function cdsAction()
  {
    $em = $this->getDoctrine()->getEntityManager();
    $query = $em->getRepository('OGInversaBundle:CdItem')->createQueryBuilder('c')->where('c.isactive = true')->orderBy('c.published', 'DESC')
        ->getQuery();
    $entities = $query->getResult();
    return $this->render('OGInversaBundle:Content:cds.html.twig', array('name' => 'cds', 'entities' => $entities));
  }

  /**
   *
   * @Route("/cd/{id}/order", name="_content_cd_order")
   */
  public function ordercdAction($id)
  {
    $em = $this->getDoctrine()->getEntityManager();
    $cdItem = $em->getRepository('OGInversaBundle:CdItem')->find($id);

    $request = $this->getRequest();
    $mailDataValidation = new Collection(
        array(
            'name' => array(new NotBlank(array('message' => 'Bitte geben Sie Vornamen und Namen ein')),
                new MinLength(array('limit' => 3, 'message' => 'Bitte geben Sie Ihren Vornamen und Namen ein'))),
            'email' => array(new NotBlank(array('message' => 'Bitte geben Sie Ihre E-Mail ein')),
                new Email(array('message' => 'Bitte geben Sie eine gültige E-Mail ein'))),
            'address' => array(new NotBlank(array('message' => 'Bitte geben Sie Ihre Adresse ein')),
                new MinLength(array('limit' => 10, 'message' => 'Bitte geben Sie Ihre Adresse ein'))),
        		'zipcity' => array(new NotBlank(array('message' => 'Bitte geben Sie PLZ und Ort ein')),
        		    new MinLength(array('limit' => 5, 'message' => 'Bitte geben Sie PLZ und Ort ein'))),
        		'message' => array(),
            'count' => array(new NotBlank(array('message' => 'Bitte geben Sie an, wie viele CDs bestellt werden sollen')),
                new Min(
                    array('limit' => 1, 'message' => 'Mindestens eine CD muss bestellt werden',
                        'invalidMessage' => 'Bitte eine gültige Anzahl erwünschter CDs angeben')))));

    $mailData = array();
    $form = $this->createFormBuilder($mailData, array('validation_constraint' => $mailDataValidation))
        ->add('name', 'text', array('required' => false, 'label' => 'Vorname / Name'))
        ->add('email', 'email', array('required' => false, 'label' => 'E-Mail'))
        ->add('address', 'text', array('required' => false, 'label' => 'Adresse'))
        ->add('zipcity', 'text', array('required' => false, 'label' => 'PLZ / Ort'))
        ->add('count', 'text', array('required' => false, 'label' => 'Anzahl CDs', 'data' => '1'))
        ->add('message', 'textarea', array('required' => false, 'label' => 'Bemerkungen'))
        ->add('captcha', 'captcha', array('width' => '100', 'height' => '32', 'required' => false))->getForm();

    if ($request->getMethod() == 'POST') {
      $form->bindRequest($request);

      if ($form->isValid()) {

        // data is an array with "name", "email", and "message", "count", "address" and "zipcity" keys 
        $data = $form->getData();
        $data["cdname"] = $cdItem->getName();
        $data["price"] = $cdItem->getPrice();
        $message = \Swift_Message::newInstance()->setSubject('Bestellung auf www.ensemble-inversa.ch')->setFrom($data['email'])->setTo('info@ensemble-inversa.ch')
            ->setBody($this->renderView('OGInversaBundle:Content:ordercd.txt.twig', $data));
        
        $confirmMessage =  \Swift_Message::newInstance()->setSubject('Bestellung auf www.ensemble-inversa.ch')->setFrom('info@ensemble-inversa.ch')->setTo($data['email'])
            ->setBody($this->renderView('OGInversaBundle:Content:customerconfirm_ordercd.txt.twig', $data));

        $this->get('mailer')->send($message);
        $this->get('mailer')->send($confirmMessage);
        
        return $this
            ->render('OGInversaBundle:Content:orderconfirm.html.twig',
                array('name' => 'cds', 'email' => $data['email'], 'count' => $data['count'], 'price' => $cdItem->getPrice(),
                    'cdname' => $cdItem->getName()));
      }
    }

    return $this->render('OGInversaBundle:Content:ordercd.html.twig', array('name' => 'cds', 'form' => $form->createView(), 'cditem' => $cdItem));
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
        ->add('name', 'text', array('required' => false, 'label' => 'Name'))->add('email', 'email', array('required' => false, 'label' => 'E-Mail'))
        ->add('message', 'textarea', array('required' => false, 'label' => 'Nachricht'))
        ->add('captcha', 'captcha', array('width' => '100', 'height' => '32', 'required' => false))->getForm();

    if ($request->getMethod() == 'POST') {
      $form->bindRequest($request);

      if ($form->isValid()) {

        // data is an array with "name", "email", and "message" keys
        $data = $form->getData();
        $message = \Swift_Message::newInstance()->setSubject('Kontakt www.ensemble-inversa.ch')->setFrom($data['email'])
            ->setTo('info@ensemble-inversa.ch')->setBody($this->renderView('OGInversaBundle:Content:email.txt.twig', $data));

        $this->get('mailer')->send($message);
        return $this->render('OGInversaBundle:Content:mailconfirm.html.twig', array('name' => 'contact', 'email' => $data['email']));
      }
    }

    return $this->render('OGInversaBundle:Content:contact.html.twig', array('name' => 'contact', 'form' => $form->createView()));
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
