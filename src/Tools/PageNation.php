<?php


namespace App\Tools;


class PageNation
{
    private int $page = 0;
    private int $limit = 10;
    private int $total = 0;
    private int $offset = 0;
    private int $totalPage = 0;

    private $pages = [];
    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }


    /**
     * @param int $limit
     */
    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }


    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }


    /**
     * @param int $total
     */
    public function setTotal(int $total): void
    {
        $this->total = $total;
    }




    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }



    public function caculate(){

    }

    public function getOffset(){
        $this->offset = $this->page * $this->limit;
        return $this->offset;
    }

    public function getTotalPage():int
    {
        $this->totalPage =  ceil($this->total / $this->limit);
        return $this->totalPage;
    }


}