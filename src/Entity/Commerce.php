<?php


namespace App\Entity;

use App\Repository\CommerceRepository;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass=CommerceRepository::class)
 */
class Commerce
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column (type="string",length=255)
     */
    private $name;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $utime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ctime;


    /**
     * @param mixed $ctime
     */
    public function setCtime($ctime): void
    {
        $this->ctime = $ctime;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed $utime
     */
    public function setUtime($utime): void
    {
        $this->utime = $utime;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCtime()
    {
        return $this->ctime;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUtime()
    {
        return $this->utime;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}