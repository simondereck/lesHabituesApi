<?php


namespace App\Entity;
use App\Repository\TransactionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TransactionRepository::class)
 */
class Transaction
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $uid;


    /**
     * @ORM\Column(type="integer")
     */
    private $cid;

    /**
     * @ORM\Column (type="string",length=255)
     */
    private $amount;

    /**
     * @ORM\Column (type="string",length=255)
     */
    private $title;


    /**
     * @ORM\Column (type="text")
     */
    private $description;

    /**
     * @ORM\Column (type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $utime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ctime;



    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getCid()
    {
        return $this->cid;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @return mixed
     */
    public function getUtime()
    {
        return $this->utime;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @param mixed $cid
     */
    public function setCid($cid): void
    {
        $this->cid = $cid;
    }

    /**
     * @param mixed $ctime
     */
    public function setCtime($ctime): void
    {
        $this->ctime = $ctime;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @param mixed $uid
     */
    public function setUid($uid): void
    {
        $this->uid = $uid;
    }

    /**
     * @param mixed $utime
     */
    public function setUtime($utime): void
    {
        $this->utime = $utime;
    }
}


