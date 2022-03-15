<?php


namespace App\Controller;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Log\Logger;
use Symfony\Component\Security\Core\User\UserInterface;

class MainController extends AbstractController
{
    protected $session;
    protected $doctrine;

    public function __construct(ManagerRegistry $doctrine,RequestStack $requestStack)
    {
        $this->session = $requestStack->getSession();
        $this->doctrine = $doctrine;
    }


    public function user(): ?User
    {
        if ($this->session->get("user")){
            return $this->session->get("user");
        }
        return null;
    }
}