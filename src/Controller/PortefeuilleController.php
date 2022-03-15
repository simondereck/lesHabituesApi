<?php


namespace App\Controller;


use App\Entity\Portefeuille;
use App\Entity\Transaction;
use App\Form\CrediterFormType;
use App\Form\DebiterFormType;
use App\Form\UserFormType;
use App\Tools\SMTools;
use Doctrine\DBAL\Driver\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PortefeuilleController extends MainController
{
    public function detail(Request $request):Response{
        /**
         * get detail of credit , debit detail
         * and user info $uid
         */
        $cid = $request->query->get("cid",0);
        $data = [];
        $data["status"] = 400;
        $data["msg"] = "failed";
        if ($cid>0 && $this->user()){
            $repository = $this->doctrine->getRepository(Portefeuille::class);
            $detail = $repository->findOneByUidAndCid($this->user()->getId(),$cid);
            if ($detail){
                $data["detail"] = $detail;
                $data["status"] = 200;
                $data["msg"] = "success";
                return $this->json($data);
            }else{
                $portefeuille = new Portefeuille();
                $portefeuille->setUid($this->user()->getId());
                $portefeuille->setCid($cid);
                $portefeuille->setUtime(SMTools::getDateString());
                $portefeuille->setCtime(SMTools::getDateString());
                $portefeuille->setDisponible(0);
                $entityManager = $this->doctrine->getManager();
                $entityManager->persist($portefeuille);
                $entityManager->flush();
                $data["detail"] = $portefeuille;
            }
        }
        return $this->json($data);
    }

    public function crediter(Request $request):Response{
        /**
         * Pour rendre attractif le système le commerçant propose des offres de rechargement avec une remise, par exemple :
         * - 20 € déposé + 1 € offert. Le compte sera donc crédité de 21 €.
         * - 50 € déposé + 2.5 € offert. Le compte sera donc crédité de 52.50 €.
         * - 100 € déposé + 10 € offert. Le compte sera donc crédité de 110 €.
         */
        $transaction = new Transaction();
        $form = $this->createForm(CrediterFormType::class,$transaction);
        $form->submit($request->request->all());
        if ($transaction->getCid()&&$transaction->getAmount()&&$this->user()){
            $transaction->setUtime(SMTools::getDateString());
            $transaction->setCtime(SMTools::getDateString());
            $transaction->setUid($this->user()->getId());
            $amount = floatval($transaction->getAmount());
            if ($amount>=20 && $amount<50){
                $amount = $amount + 1;
                $transaction->setType(SMTools::$TYPE_AVEC_OFFERT);
            }else if ($amount>=50 && $amount<100){
                $amount = $amount + 2.5;
                $transaction->setType(SMTools::$TYPE_AVEC_OFFERT);
            }else if ($amount>=100){
                $amount = $amount + 10;
                $transaction->setType(SMTools::$TYPE_AVEC_OFFERT);
            }else{
                $transaction->setType(SMTools::$TYPE_CREDITER);
            }
            $transaction->setAmount($amount);
            $data = [];
            try {
                $entityManager = $this->doctrine->getManager();
                $entityManager->persist($form->getData());
                $entityManager->flush();
                $data["status"] = 200;
                $data["msg"] = "success";
                //après set portefeuille disponise;

                $repository = $this->doctrine->getRepository(Portefeuille::class);
                $detail = $repository->findOneByUidAndCid($this->user()->getId(),$transaction->getCid());
                if ($detail){
                    $disponible = floatval($detail->getDisponible());
                    $detail->setDisponible($disponible+$amount);
                    $entityManager->persist($detail);
                    $entityManager->flush();
                }
                return $this->json($data);
            }catch (Exception $exception){
//            $this->logger->log(1,$exception->getMessage());
            }
        }

        $data["status"] = 400;
        $data["msg"] = "failed";
        return $this->json($data);
    }


    public function debiter(Request $request):Response{

        $transaction = new Transaction();
        $form = $this->createForm(DebiterFormType::class,$transaction);
        $form->submit($request->request->all());

        if ($transaction->getCid()&&$transaction->getAmount()&&$this->user()) {
            $transaction->setType(SMTools::$TYPE_DEBITER);
            $transaction->setUtime(SMTools::getDateString());
            $transaction->setCtime(SMTools::getDateString());
            $transaction->setUid($this->user()->getId());
            $data = [];
            try {
                $entityManager = $this->doctrine->getManager();

                $repository = $this->doctrine->getRepository(Portefeuille::class);
                $detail = $repository->findOneByUidAndCid($this->user()->getId(), $transaction->getCid());
                if ($detail) {
                    $disponible = floatval($detail->getDisponible());
                    if ($disponible - floatval($transaction->getAmount()) > 0) {
                        $detail->setDisponible($disponible - floatval($transaction->getAmount()));
                        $entityManager->persist($detail);
                        $entityManager->flush();
                        //droit fix la portefeuille data
                        $entityManager->persist($form->getData());
                        $entityManager->flush();
                        $data["status"] = 200;
                        $data["message"] = "success";
                    }
                }

                return $this->json($data);
            } catch (Exception $exception) {
//              $this->logger->log(1,$exception->getMessage());
            }
        }
        $data["status"] = 400;
        $data["message"] = "failed";
        return $this->json($data);
    }

    public function create(){

    }

}