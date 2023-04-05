<?php

namespace Application\Controller;

use Application\Controller\AbstractController;
use Application\Repository\ReservationRepository;

class ReservationController extends AbstractController
{
    function createAction()
    {
        if (!$this->getUser()) {
            $this->redirect('/member/login');
        }

        $itemId = $_GET['id'];
        $memberId = $this->getUser()->getId();
        $penaltyCount = $this->getUser()->getPenaltyCount();

        if ($penaltyCount === 3) {
            $this->redirect('/member/logout');
        }

        $reservationRepository = new ReservationRepository();

        if ($reservationRepository->getStatus($itemId) === 'Available') {
            $reservations = $reservationRepository->getAvailableReservations($memberId);
            $borrowings = $reservationRepository->getAvailableBorrowings($memberId);
            $count = count($borrowings) + count($reservations);
            if ($count >= 3) {
                $this->addFlashMessage('error', 'Please return an item or cancel a reservation in order to reserve (MAX 3 reservations and borrowings)');
                $this->redirect('/item/list');
            } else {
                $reservationRepository->insert($itemId, $memberId);
                $reservationRepository->updateStatus($itemId);
                $this->addFlashMessage('success', 'You have successfully reserved the item');
                $this->redirect('/item/list');
            }
        } else {
            $this->addFlashMessage('error', 'You cannot reserve that item');
            $this->redirect('/item/list');
        }
    }

    function confirmAction()
    {
        $id = $_GET['id'];
        $reservationRepository = new ReservationRepository();
        $reservationRepository->confirmReservation($id);
        $this->redirect('/member/confirmreservations');
    }

    function cancelAction()
    {
        $id = $_GET['id'];
        $reservationRepository = new ReservationRepository();
        $reservationRepository->cancelReservation($id);
        $this->redirect('/member/reservations');
    }
}
