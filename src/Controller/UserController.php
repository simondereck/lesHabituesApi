<?php


namespace App\Controller;



use App\Entity\User;
use App\Form\UserFormType;
use App\Form\UserLoginType;
use App\Tools\SMTools;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends MainController
{


   public function singup(Request $request):Response{
       $user = new User();
       $form = $this->createForm(UserFormType::class,$user);
       $form->submit($request->request->all());
       $data = [];
       if ($user->getUsername()&&$user->getPassword()&&$user->getEmail()&&$user->getTelephone()){
           $user->setUtime(SMTools::getDateString());
           $user->setCtime(SMTools::getDateString());
           $user->setPassword($user->generatePassword());
           $user->setStatus(SMTools::$USER_ACTIVE);
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


    public function login(Request $request):Response
    {
        $user = new User();
        $form = $this->createForm(UserLoginType::class,$user);
        $form->submit($request->request->all());

        $repository = $this->doctrine
            ->getRepository(User::class);
        $result = $repository->findOneByLogin($user->getUsername());
        $data = [];

        if ($result && $user->login($result)){
            $this->session->set("user",$result);
            $data["status"] = 200;
            $data["msg"] = "success";
            return $this->json($data);
        }
        $data["status"] = 400;
        $data["msg"] = "failed";
        return $this->json($data);
    }

    public function logout(Request $request):Response{

        return new Response('user logout');
    }


    public function forgotPassword(Request $request):Response{

        return new Response('forgot password');
    }

    public function resetPassword(Request $request):Response{
       return new Response('reset password');
    }
}