<?php

namespace Application\Controller;

use Application\Controller\AbstractController;

class PageController extends AbstractController
{
    /**
     * route : page/index
     */
    function indexAction()
    {
        $this->renderView('templates/page/index.view.php');
    }

    function _404action()
    {
        $this->renderView('templates/page/404.view.php');
    }
}
