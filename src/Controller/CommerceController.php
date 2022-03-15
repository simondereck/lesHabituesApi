<?php


namespace App\Controller;


use App\Entity\Commerce;
use App\Entity\User;
use App\Form\CommerceFormType;
use App\Form\UserFormType;
use App\Tools\SMTools;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

class CommerceController extends MainController
{

    /**
     * create a commerce
     * normally a commerce should have image url , name ,etc
     */
    public function create(Request $request):Response{
        $commerce = new Commerce();
        $form = $this->createForm(CommerceFormType::class,$commerce);
        $form->submit($request->request->all());
        $data = [];
        if ($commerce->getName()){
            $commerce->setUtime(SMTools::getDateString());
            $commerce->setCtime(SMTools::getDateString());
            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($form->getData());
            $entityManager->flush();
            $data["status"] = 200;
            $data["msg"] = "success";
            return $this->json($data);
        }
        $data["status"] = 400;
        $data["msg"] = "failed";
        return $this->json($data);
    }


}