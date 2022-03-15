<?php


namespace App\Entity;
use App\Repository\PortefeuilleRepository;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass=PrortefeuilleRepository::class)
 */
class Portefeuille
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
     * @ORM\Column(type="string", length=255)
     */
    private $disponible;

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
    public function getUtime()
    {
        return $this->utime;
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
    public function getId()
    {
        return $this->id;
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
    public function getCid()
    {
        return $this->cid;
    }

    /**
     * @return mixed
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    /**
     * @param mixed $utime
     */
    public function setUtime($utime): void
    {
        $this->utime = $utime;
    }

    /**
     * @param mixed $uid
     */
    public function setUid($uid): void
    {
        $this->uid = $uid;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed $ctime
     */
    public function setCtime($ctime): void
    {
        $this->ctime = $ctime;
    }

    /**
     * @param mixed $cid
     */
    public function setCid($cid): void
    {
        $this->cid = $cid;
    }

    /**
     * @param mixed $disponible
     */
    public function setDisponible($disponible): void
    {
        $this->disponible = $disponible;
    }


    public function toArray(){
        return [
            "cid"=>$this->cid,
            "uid"=>$this->uid,
            "disponible"=>$this->disponible,
            "utime"=>$this->uid,
            "ctime"=>$this->ctime,
        ];
    }
}