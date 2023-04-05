<?php

namespace Application\Controller;

use Application\Form\MemberRegisterForm;
use Application\Form\MemberProfileForm;
use Application\Form\MemberLoginForm;
use Application\Form\ItemSearchForm;
use Application\Entity\MemberEntity;
use Application\Entity\ItemSearchEntity;
use Application\Repository\MemberRepository;
use Application\Repository\ReservationRepository;
use Application\Repository\BorrowingRepository;
use Application\Repository\ItemRepository;

class MemberController extends AbstractController
{

    function createAction()
    {
        if ($this->getUser()) {
            $this->logoutAction();
            $this->redirect('/member/create');
        }
        $member = new MemberEntity();
        $form = new MemberRegisterForm(MemberEntity::class, $member);
        $form->handle($member);

        if ($form->isSubmited() && $form->isValid()) {

            $memberRepository = new MemberRepository();
            if (($memberRepository->emailExist($member))) {
                $form->errors['email'] = 'Email already exists';
            } else {
                $memberRepository->insert($member);
                if ($user = $memberRepository->isMember($member)) {
                    $this->setSession('user', $user);
                    $this->redirect('/item/list');
                }
            }
        }

        $this->renderView('templates/member/create.view.php', [
            'form' => $form->createView()
        ]);
    }

    function loginAction()
    {
        if ($this->getUser()) {
            $this->logoutAction();
            $this->redirect('/member/login');
        }

        $member = new MemberEntity();
        $form = new MemberLoginForm(MemberEntity::class, $member);
        $form->handle($member);

        if ($form->isSubmited() && $form->isValid()) {
            $memberRepository = new MemberRepository();
            if ($user = $memberRepository->isMember($member)) {
                $this->setSession('user', $user);
                if ($memberRepository->isBanned($user)) {
                    $this->addFlashMessage('error', 'Your account is suspended');
                } else {
                    if ($this->isAdmin($user)) {
                        $this->redirect('/item/adminlist');
                    } else {
                        $this->redirect('/item/list');
                    }
                }
            } else {
                $this->addFlashMessage('error', 'Nickname or passowrd are incorrect');
            }
        }
        $this->renderView('templates/member/login.view.php', [
            'form' => $form->createView()
        ]);
    }

    function profileAction()
    {
        if (!$this->getUser()) {
            $this->addFlashMessage('error', 'Please log in');
            $this->redirect('/member/login');
        }

        $memberRepository = new MemberRepository();
        $member = $memberRepository->findOneBy(['id' => $this->getUser()->getId()]);

        $form = new MemberProfileForm(MemberEntity::class, $member);
        $form->handle($member);

        if ($form->isSubmited() && $form->isValid()) {
            if ($errors = $memberRepository->checkUniqueFields($member)) {
                $form->errors = $errors;
            }

            $memberRepository->update($member);
            // set user in session
            $this->setSession('user', $member);
            // print success message
            $this->addFlashMessage('success', 'Profile updated successfully');
            // redirect
            $this->redirect('/member/profile');
        }

        $this->renderView('templates/member/profile.view.php', [
            'form' => $form->createView()
        ]);
    }

    function reservationsAction()
    {
        if (!$this->getUser()) {
            $this->addFlashMessage('error', 'Please log in');
            $this->redirect('/member/login');
        }
        $id = $this->getUser()->getId();
        $reservationRepository = new ReservationRepository();
        $reservations = $reservationRepository->getAvailableReservations($id);

        $this->renderView('templates/member/reservations.view.php', [
            'reservations' => $reservations
        ]);

        $this->redirect('/member/reservations');
    }

    function borrowingsAction()
    {
        if (!$this->getUser()) {
            $this->addFlashMessage('error', 'Please log in');
            $this->redirect('/member/login');
        }
        $id = $this->getUser()->getId();
        $borrowingRepository = new ReservationRepository();
        $borrowings = $borrowingRepository->getAvailableBorrowings($id);

        $this->renderView('templates/member/borrowings.view.php', [
            'borrowings' => $borrowings
        ]);

        $this->redirect('/member/borrowings');
    }

    function confirmreservationsAction()
    {
        if (!$this->getUser()) {
            $this->addFlashMessage('error', 'Please log in');
            $this->redirect('/member/login');
        }
        if (!$this->isAdmin($this->getUser())) {
            $this->redirect('/page/_404');
        }
        $reservationRepository = new ReservationRepository();

        $reservation = null;
        $search = new ItemSearchEntity();
        $form = new ItemSearchForm(ItemSearchEntity::class, $search);
        $form->handle($search);

        if ($form->isSubmited()) {
            $reservationId = $search->getReservationId();
            $reservation = $reservationRepository->selectReservationById($reservationId);
        }
        $this->renderView('templates/member/confirmreservations.view.php', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    function returnborrowingsAction()
    {
        if (!$this->getUser()) {
            $this->addFlashMessage('error', 'Please log in');
            $this->redirect('/member/login');
        }
        if (!$this->isAdmin($this->getUser())) {
            $this->redirect('/page/_404');
        }
        $borrowingRepository = new BorrowingRepository();

        $borrowing = null;
        $search = new ItemSearchEntity();
        $form = new ItemSearchForm(ItemSearchEntity::class, $search);
        $form->handle($search);

        if ($form->isSubmited()) {
            $borrowingId = $search->getBorrowingId();
            $borrowing = $borrowingRepository->selectBorrowingById($borrowingId);
        }
        $this->renderView('templates/member/returnborrowings.view.php', [
            'borrowing' => $borrowing,
            'form' => $form->createView(),
        ]);
    }

    function itemmanagerAction()
    {
        if (!$this->getUser()) {
            $this->addFlashMessage('error', 'Please log in');
            $this->redirect('/member/login');
        }
        if (!$this->isAdmin($this->getUser())) {
            $this->redirect('/page/_404');
        }
        $itemRepository = new ItemRepository();

        $item = null;
        $search = new ItemSearchEntity();
        $form = new ItemSearchForm(ItemSearchEntity::class, $search);
        $form->handle($search);

        if ($form->isSubmited()) {
            $itemId = $search->getItemId();
            $item = $itemRepository->getItem($itemId);
        }

        $this->renderView(
            'templates/member/itemmanager.view.php',
            [
                'item' => $item,
                'form' => $form->createView()
            ]
        );
    }

    function logoutAction()
    {
        session_destroy();
        $this->redirect('/member/login');
    }
}