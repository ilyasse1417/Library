<?php

namespace Application\Controller;

use Application\Controller\AbstractController;
use Application\Repository\BorrowingRepository;

class BorrowingController extends AbstractController
{
    function confirmAction()
    {
        $id = $_GET['id'];
        $borrowingRepository = new BorrowingRepository();
        $borrowingRepository->returnBorrowing($id);
        $this->redirect('/member/returnborrowings');
    }
}