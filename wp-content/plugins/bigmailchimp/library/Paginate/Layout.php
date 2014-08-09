<?php

/**
 * Description of Layout
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
interface Paginate_Layout {

    public function getPagedLinks(Paginate_Paginator $paginator, $urlVariables);
}