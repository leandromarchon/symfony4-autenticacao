<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="users")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @var array
     * @ORM\Column(type="json")
     */
    private $roles;

    /**
     * @return mixed
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return self
     */ 
    public function setUsername(string $username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return self
     */ 
    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return array
     */ 
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     * @return self
     */ 
    public function setRoles($roles)
    {
        $this->roles[] = $roles;
        return $this;
    }

    /**
     * Métodos de 'UserInteface' que obrigatoriamente devem ser implementados
     * pelas classes que estejam fazendo uso da mesma.
     * 
     *  getSalt()
     *  eraseCredencials()
     */
    
    /**
     * @return string|null
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Removes sensitive data from the user.
     * 
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        return null;
    }
}
