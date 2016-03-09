<?php

namespace BanqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Account
 *
 * @ORM\Table(name="accounts")
 * @ORM\Entity(repositoryClass="BanqueBundle\Repository\AccountRepository")
 */
class Account
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="Number", type="string", length=255)
     * @Assert\Length(min=4,max=4,exactMessage="Le nombre doit avoir 4 caractères")
     */
    private $number;
    
    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $name;


    /**
     * @var int
     *
     * @ORM\Column(name="Credits", type="integer")
     */
    private $credits;

    /**
     * @var int
     *
     * @ORM\Column(name="Id_User", type="integer", nullable=true)
     */
    private $idUser;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Account
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Set number
     *
     * @param string $number
     *
     * @return Account
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set credits
     *
     * @param integer $credits
     *
     * @return Account
     */
    public function setCredits($credits)
    {
        $this->credits = $credits;

        return $this;
    }

    /**
     * Get credits
     *
     * @return int
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Account
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
}

