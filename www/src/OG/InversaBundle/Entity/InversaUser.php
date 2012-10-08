<?php

namespace OG\InversaBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * OG\InversaBundle\Entity\InversaUser
 */
class InversaUser implements UserInterface
{
  /**
   * @var integer $id
   */
  private $id;

  /**
   * @var string $username
   */
  private $username;

  /**
   * @var string $salt
   */
  private $salt;

  /**
   * @var string $name
   */
  private $name;

  /**
   * @var string $firstname
   */
  private $firstname;

  /**
   * @var string $email
   */
  private $email;

  /**
   * @var string $password
   */
  private $password;

  public function __construct()
  {
    $this->isactive = true;
    $this->salt = md5(uniqid(null, true));
  }
  /**
   * @inheritDoc
   */
  public function getUsername()
  {
    return $this->username;
  }

  /**
   * @inheritDoc
   */
  public function getSalt()
  {
    return $this->salt;
  }

  /**
   * @inheritDoc
   */
  public function getPassword()
  {
    return $this->isactive ? $this->password : null;
  }

  /**
   * @inheritDoc
   */
  public function getRoles()
  {
    return array('ROLE_ADMIN');
  }

  /**
   * @inheritDoc
   */
  public function eraseCredentials()
  {
  }

  /**
   * @inheritDoc
   */
  public function equals(UserInterface $user)
  {
    return $this->username === $user->getUsername();
  }

  /**
   * Get id
   *
   * @return integer 
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set username
   *
   * @param string $username
   */
  public function setUsername($username)
  {
    $this->username = $username;
  }

  /**
   * Set name
   *
   * @param string $name
   */
  public function setName($name)
  {
    $this->name = $name;
  }

  /**
   * Get name
   *
   * @return string 
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set firstname
   *
   * @param string $firstname
   */
  public function setFirstname($firstname)
  {
    $this->firstname = $firstname;
  }

  /**
   * Get firstname
   *
   * @return string 
   */
  public function getFirstname()
  {
    return $this->firstname;
  }

  /**
   * Set email
   *
   * @param string $email
   */
  public function setEmail($email)
  {
    $this->email = $email;
  }

  /**
   * Get email
   *
   * @return string 
   */
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * Set password
   *
   * @param string $password
   */
  public function setPassword($password)
  {
    $this->password = $password;
  }

  /**
   * Set salt
   *
   * @param string $salt
   */
  public function setSalt($salt)
  {
    $this->salt = $salt;
  }

  /**
   * @var datetime $lastlogin
   */
  private $lastlogin;

  /**
   * @var boolean $isactive
   */
  private $isactive;

  /**
   * @var string $oldpassword
   */
  private $oldpassword;

  /**
   * @var string $newpassword
   */
  private $newpassword;

  /**
   * @var string $repeatpassword
   */
  private $repeatpassword;

  /**
   * @var boolean $oldPasswordOk
   */
  private $isOldPasswordOk;

  /**
   * Set lastlogin
   *
   * @param datetime $lastlogin
   */
  public function setLastlogin($lastlogin)
  {
    $this->lastlogin = $lastlogin;
  }

  /**
   * Get lastlogin
   *
   * @return datetime 
   */
  public function getLastlogin()
  {
    return $this->lastlogin;
  }

  /**
   * Set isactive
   *
   * @param boolean $isactive
   */
  public function setIsactive($isactive)
  {
    $this->isactive = $isactive;
  }

  /**
   * Get isactive
   *
   * @return boolean 
   */
  public function getIsactive()
  {
    return $this->isactive;
  }

  /**
   * Set oldpassword
   *
   * @param string $oldpassword
   */
  public function setOldpassword($oldpassword)
  {
    $this->oldpassword = $oldpassword;
  }

  /**
   * Get oldpassword
   *
   * @return string 
   */
  public function getOldpassword()
  {
    return $this->oldpassword;
  }

  /**
   * Set newpassword
   *
   * @param string $newpassword
   */
  public function setNewpassword($newpassword)
  {
    $this->newpassword = $newpassword;
  }

  /**
   * Get newpassword
   *
   * @return string 
   */
  public function getNewpassword()
  {
    return $this->newpassword;
  }

  /**
   * Set repeatpassword
   *
   * @param string $repeatpassword
   */
  public function setRepeatpassword($repeatpassword)
  {
    $this->repeatpassword = $repeatpassword;
  }

  /**
   * Get repeatpassword
   *
   * @return string 
   */
  public function getRepeatpassword()
  {
    return $this->repeatpassword;
  }

  public function setIsOldPasswordOk($isOldPasswordOk)
  {
    $this->isOldPasswordOk = $isOldPasswordOk;
  }

  public function isOldPasswordOk()
  {
    return $this->isOldPasswordOk;
  }

  public function isRepeatPasswordOk()
  {
    return ($this->newpassword === null || $this->newpassword == $this->repeatpassword);
  }
}