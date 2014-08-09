<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JumpLayout
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
class Paginate_JumpLayout implements Paginate_Layout {

    public function getPagedLinks(Paginate_Paginator $paginator, $urlVariables) {
        $currentPage = $paginator->getPageNumber();
        $totalPages = $paginator->getTotalPages();
        $totalItems = count($paginator->getItems());
        $str = '';
        $urlVar = '?';
        unset($urlVariables['paginator']);
        foreach ($urlVariables as $key => $value)
            $urlVar.= strip_tags ($key) . "=" .  ($value) . '&';

        if ($totalPages <= 1) {
            $displayItems = 'items';
            if ($totalItems === 1)
                $displayItems = 'item';
            $str .= '<div class="tablenav-pages one-page"><span class="displaying-num">' . $totalItems . ' ' . $displayItems . '</span></div>';
        } else {
            $str.= '<div class="tablenav-pages"><span class="displaying-num">' . $totalItems . ' items</span>';
            $str.= '<span class="pagination-links">';
            $firstLink = '<a class="first-page" title="Go to the first page" href="'.$urlVar.'paginator=1">&laquo;</a>';
            $lastLink = '<a class="last-page" title="Go to the last page" href="'.$urlVar.'paginator='.$paginator->getTotalPages().'">&raquo;</a>';
            $prevLink = '<a class="prev-page" title="Go to the previous page" href="'.$urlVar.'paginator='.$paginator->getPreviousPage().'">&lsaquo;</a>';
            $nextLink = ' <a class="next-page" title="Go to the next page" href="'.$urlVar.'paginator='.$paginator->getNextPage().'">&rsaquo;</a>';
            $displayCurrent = '<span class="paging-input"><input class="current-page" title="Current page" type="text" name="paginator" value="'.$currentPage.'" size="'.count($paginator->getPageNumber()).'" /> of <span class="total-pages">'.$paginator->getTotalPages().'</span></span>';
            if ($paginator->isFirstPage()) {
                 $firstLink = '<a class="first-page disabled" title="Go to the first page" href="'.$urlVar.'paginator=1">&laquo;</a>';
                 $prevLink = '<a class="prev-page disabled" title="Go to the previous page" href="'.$urlVar.'paginator='.$paginator->getPreviousPage().'">&lsaquo;</a>';
            } elseif ($paginator->isLastPage()) {
                $lastLink = '<a class="last-page disabled" title="Go to the last page" href="'.$urlVar.'paginator='.$paginator->getTotalPages().'">&raquo;</a>';
                $nextLink = ' <a class="next-page disabled" title="Go to the next page" href="'.$urlVar.'paginator='.$paginator->getNextPage().'">&rsaquo;</a>';
            }

            $str .= $firstLink . $prevLink . $displayCurrent . $nextLink . $lastLink;
            $str .= '</span >';
            $str .= '</div>';
        }
        return $str;
    }

}