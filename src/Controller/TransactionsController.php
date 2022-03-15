<?php


namespace App\Controller;


use App\Entity\Herb;
use App\Entity\PageData;
use App\Entity\Transaction;
use App\Form\TransactionListsFormType;
use App\Tools\PageNation;
use App\Tools\SMTools;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionsController extends MainController
{
    public function lists(Request $request):Response{
        /**
         * order by id desc
         */
        $data = [];
        $data["status"] = 400;
        $data["msg"] = "failed";
        if ($this->user()){
            $searchParams = [];
            $pageData = new PageData();

            $pageNation = new PageNation();
            $pageNation->setPage($pageData->getPage());
            $form = $this->createForm(TransactionListsFormType::class,$pageData);
            $form->submit($request->request->all());

            $repository = $this->doctrine->getRepository(Transaction::class);

            $searchParams[] = ["key"=>"uid","value"=>$this->user()->getId(),"like"=>false];

            switch ($pageData->getType()){
                case SMTools::$TYPE_DEBITER:
                    $searchParams[] = ["key"=>"type","value"=>SMTools::$TYPE_DEBITER,"like"=>false];
                    break;
                case SMTools::$TYPE_CREDITER:
                    $searchParams[] = ["key"=>"type","value"=>SMTools::$TYPE_CREDITER,"like"=>false];
                    break;
                default:
                    break;
            }

            $count = $repository->countSearch($searchParams);
            $pageNation->setTotal($count);
            $pageNation->setPage($pageData->getPage());
            $items = $repository->paramsSearch($searchParams,$pageNation->getLimit(),$pageNation->getOffset());
            $data["status"] = 200;
            $data["msg"] = "success";
            $data["items"] = $items;
            $data["page"] = $pageNation->getPage();
            $data["limit"] = $pageNation->getLimit();
            $data["pages"] = $pageNation->getTotalPage();
            return $this->json($data);
        }
        return $this->json($data);
    }


    public function detail(Request $request):Response{
        /**
         * detail include
         * 1. title of transaction
         * 2. amount
         * 3. transaction type
         * 4. transaction description
         * 5. transaction time
         */
        $id = $request->query->get("id");
        $repository = $this->doctrine->getRepository(Transaction::class);
        $detail = $repository->findOneBy($id);
        $data = [];
        $data["status"] = 400;
        $data["msg"] = "failed";
        if ($detail){
            $data["status"] = 200;
            $data["msg"] = "success";
            $data["item"] = $detail;
            return $this->json($data);
        }
        return $this->json($data);
    }

}