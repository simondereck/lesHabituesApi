<?php


namespace App\Entity;


class PageData
{
    private  $page;
    private  $limit;
    private  $type;

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @param mixed $limit
     */
    public function setLimit($limit): void
    {
        $this->limit = $limit;
    }

    /**
     * @param mixed $page
     */
    public function setPage($page): void
    {
        $this->page = $page;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type?$this->type:0;
    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit?$this->limit:15;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page?$this->page:0;
    }

}
