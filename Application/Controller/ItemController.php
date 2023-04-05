<?php

namespace Application\Controller;

use Application\Controller\AbstractController;
use Application\Repository\ItemRepository;
use Application\Entity\ItemSearchEntity;
use Application\Entity\ItemEntity;
use Application\Form\ItemSearchForm;
use Application\Form\ItemManagerForm;

class ItemController extends AbstractController
{
    function listAction()
    {
        if (!$this->getUser()) {
            $this->addFlashMessage('error', 'Please log in');
            $this->redirect('/member/login');
        }

        $user = $this->getUser();
        $itemRepository = new ItemRepository();

        $penaltyMessages = $itemRepository->addPenaltyCheck($user);
        $penaltyMessage = '';
        if ($penaltyMessages) {
            for ($i = 0; $i < count($penaltyMessages); $i++) {
                $penaltyMessage = $itemRepository->addPenaltyCheck($user);
                $this->addFlashMessage('error', $penaltyMessage[$i]);
            }
        }

        $itemsList = $itemRepository->findBy();



        $search = new ItemSearchEntity();
        $form = new ItemSearchForm(ItemSearchEntity::class, $search);
        $form->handle($search);

        if ($form->isSubmited()) {
            $itemsList = $itemRepository->search($search);
        }

        $this->renderView('templates/item/list.view.php', [
            'itemsList' => $itemsList,
            'form' => $form->createView(),
        ]);
    }

    function adminlistAction()
    {
        if (!$this->getUser()) {
            $this->addFlashMessage('error', 'Please log in');
            $this->redirect('/member/login');
        }
        if (!$this->isAdmin($this->getUser())) {
            $this->redirect('/page/_404');
        }

        $itemRepository = new ItemRepository();
        $itemsList = $itemRepository->findBy();

        $search = new ItemSearchEntity();
        $form = new ItemSearchForm(ItemSearchEntity::class, $search);
        $form->handle($search);

        if ($form->isSubmited()) {
            $itemsList = $itemRepository->search($search);
        }

        $this->renderView('templates/item/adminlist.view.php', [
            'itemsList' => $itemsList,
            'form' => $form->createView(),
        ]);
    }

    function createAction()
    {
        if (!$this->getUser()) {
            $this->addFlashMessage('error', 'Please log in');
            $this->redirect('/member/login');
        }
        if (!$this->isAdmin($this->getUser())) {
            $this->redirect('/page/_404');
        }

        $item = new ItemEntity();
        $form = new ItemManagerForm(ItemEntity::class, $item);
        $form->handle($item);

        if ($form->isSubmited() && $form->isValid()) {
            $itemRepository = new ItemRepository();
            $itemRepository->itemAdd($item);
            $this->addFlashMessage('success', 'Item successfully added');
        }

        $this->renderView('templates/item/create.view.php', [
            'item' => $item,
            'form' => $form->createView(),
        ]);
    }

    function editAction()
    {
        if (!$this->getUser()) {
            $this->addFlashMessage('error', 'Please log in');
            $this->redirect('/member/login');
        }
        if (!$this->isAdmin($this->getUser())) {
            $this->redirect('/page/_404');
        }

        $itemRepository = new ItemRepository();
        $itemId = $_GET['id'];
        $itemArr = $itemRepository->getItem($itemId);

        $item = new ItemEntity();

        $item->setId($itemArr['id']);
        $item->setTitle($itemArr['title']);
        $item->setAuthorName($itemArr['author_name']);
        $item->setCoverImage($itemArr['cover_image']);
        $item->setState($itemArr['state']);
        $item->setStatus($itemArr['status']);
        $item->setType($itemArr['type']);
        $item->setTypeValue($itemArr['type_value']);
        $item->setEditionDate($itemArr['edition_date']);
        $item->setPurchaseDate($itemArr['purchase_date']);

        $form = new ItemManagerForm(ItemEntity::class, $item);
        $form->handle($item);

        if ($form->isSubmited() && $form->isValid()) {

            $itemRepository->editItem($item);
            $this->addFlashMessage('success', 'Item successfully edited');
        }

        $this->renderView('templates/item/edit.view.php', [
            'item' => $item,
            'form' => $form->createView(),
        ]);
        $this->redirect('/item/edit');
    }

    function deleteAction()
    {
        if (!$this->getUser()) {
            $this->addFlashMessage('error', 'Please log in');
            $this->redirect('/member/login');
        }
        if (!$this->isAdmin($this->getUser())) {
            $this->redirect('/page/_404');
        }

        $itemRepository = new ItemRepository();
        $itemId = $_GET['id'];
        $itemRepository->deleteItem($itemId);
        $this->addFlashMessage('success', 'Item successfully deleted');
        $this->redirect('/member/itemmanager');
    }
}
