<?php

namespace OG\InversaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * @Route("/admin", defaults={"_controller" = "OGInversaBundle:Admin:home" })
 */
class AdminController extends Controller
{
  /**
   * @Route("/login", name="_admin_login")
   * @Template()
   */
  public function loginAction()
  {
    $request = $this->getRequest();
    $session = $request->getSession();

    if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
      $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
    } else {
      $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
      $session->remove(SecurityContext::AUTHENTICATION_ERROR);
    }

    $errorMessage = null;
    if ($error !== null && strpos($error->getMessage(), "The presented") === 0) {
      $errorMessage = "Password ungültig";
    } else if ($error !== null && strpos($error->getMessage(), "Bad credentials") === 0) {
      $errorMessage = "Login Daten ungültig";
    } else if ($error !== null) {
      $errorMessage = $error->getMessage();
    }

    return array('last_username' => $session->get(SecurityContext::LAST_USERNAME), 'errorMessage' => $errorMessage);
  }

  /**
   * @Route("/login_check", name="_security_check")
   */
  public function securityCheckAction()
  {
    // The security layer will intercept this request
  }

  /**
   * @Route("/logout", name="_admin_logout")
   */
  public function logoutAction()
  {
    // The security layer will intercept this request
  }

  /**
   * @Route("/", name="_admin_home")
   * @Template()
   */
  public function homeAction()
  {
    $request = $this->getRequest();
    $session = $request->getSession();

    return array('name' => $session->get(SecurityContext::LAST_USERNAME));
  }
}
