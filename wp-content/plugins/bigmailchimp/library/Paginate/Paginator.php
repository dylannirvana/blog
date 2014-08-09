<?php
/**
 * Description of Paginator
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
class Paginate_Paginator {

    private $_items = array();
    private $_limit;
    private $_pageNumber;
    private $_offSet;
    private $_layout;

    function __construct($items, $limit, $pageNumber = 1) {
        $this->setItems($items);
        $this->setPageLimit($limit);
        $this->setPageNumber($pageNumber);
        $this->setOffSet(($this->getPageNumber() - 1) * ($this->getPageLimit()));
    }

    public function getItems() {
        return $this->_items;
    }

    public function setItems($items) {
        $this->_items = $items;
        return $this;
    }

    public function getOffSet() {
        return $this->_offSet;
    }

    public function setOffSet($offSet) {
        $this->_offSet = $offSet;
        return $this;
    }

    public function getPageLimit() {
        return $this->_limit;
    }

    public function setPageLimit($limit) {
        $this->_limit = $limit;
        return $this;
    }

    //accessor and mutator for page numbers
    public function getPageNumber() {
        return $this->_pageNumber;
    }

    public function setPageNumber($pageNumber) {
        if (($pageNumber <= 0) || ($pageNumber == ""))
            $this->_pageNumber = 1;
        elseif ($pageNumber > $this->getTotalPages())
            $this->_pageNumber = $this->getTotalPages();
        else
            $this->_pageNumber = $pageNumber;
        return $this;
    }


    public function getTotalPages() {
        if (!$this->getItems()) {
            return false;
        }

        $pages = ceil(count($this->getItems()) / (float) $this->getPageLimit());
        return $pages;
    }

    public function getPageRows() {
        return array_slice($this->getItems(), $this->getOffSet(), $this->getPageLimit());
    }

    public function isFirstPage() {
        return ($this->getPageNumber() <= 1);
    }

    public function isLastPage() {
        return ($this->getPageNumber() >= $this->getTotalPages());
    }

    public function getPreviousPage(){
        if($this->getPageNumber()-1 <=1){
            return 1;
        } elseif($this->getPageNumber()-1 > $this->getTotalPages()){
            return $this->getTotalPages()-1;
        } else return $this->getPageNumber() -1;
    }

    public function getNextPage(){
        if($this->getPageNumber()+1 >= $this->getTotalPages()){
            return $this->getTotalPages();
        } elseif($this->getPageNumber()+1 <= 1){
            return 2;
        } else return $this->getPageNumber() +1;
    }

    public function getLayout() {
        return $this->_layout;
    }

    public function setLayout(Paginate_Layout $layout) {
        $this->_layout = $layout;
    }

    public function getPagedNavigation($urlValiables = "") {
        return $this->getLayout()->getPagedLinks($this, $urlValiables);
    }

}