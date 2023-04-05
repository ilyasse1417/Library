<?php

namespace Application\Repository;

use Application\Entity\ItemEntity;
use Application\Entity\ItemSearchEntity;
use PDO;

class ItemRepository extends AbstarctRepository
{
    protected $tableName = 'item';
    protected $entityName = ItemEntity::class;

    public function search(ItemSearchEntity $search): array
    {
        $searchBar = $search->getSearchBar();
        $type = $search->getType();
        $state = $search->getState();
        $status = $search->getStatus();
        $where = '';

        if ($searchBar) {
            $where .= " AND (title LIKE '%$searchBar%' OR author_name LIKE '%$searchBar%')";
        }
        if ($type) {
            $where .= " AND type = '$type'";
        }
        if ($state) {
            $where .= " AND state = '$state'";
        }
        if ($status) {
            $where .= " AND status = '$status'";
        }

        return $this->findBy($where);
    }

    public function itemAdd($item)
    {
        $title = $item->getTitle();
        $authorName = $item->getAuthorName();
        $type = $item->getType();
        $typeValue = $item->getTypeValue();
        $state = $item->getState();
        $status = 'Available';
        $editionDate = $item->getEditionDate();
        $purchaseDate = $item->getPurchaseDate();

        $dir = realpath(__DIR__ . '/../../assets/images');
        $tmp_name = $_FILES['coverImage']['tmp_name'];
        $ext = pathinfo($_FILES['coverImage']['name'], PATHINFO_EXTENSION);
        $coverImage =  '/Item_Images' . '/' . $type . '/' . uniqid() . '.' . $ext;
        $newNameFileFullPath = $dir . $coverImage;
        move_uploaded_file($tmp_name, $newNameFileFullPath);

        $insrt = $this->db->prepare('INSERT INTO item (title, author_name, cover_image, state, status, type, type_value, edition_date, purchase_date) VALUES (:title,:authorName,:coverImage, :state, :status, :type, :typeValue, :editionDate, :purchaseDate)');
        $insrt->bindParam(':title', $title);
        $insrt->bindParam(':authorName', $authorName);
        $insrt->bindParam(':type', $type);
        $insrt->bindParam(':typeValue', $typeValue);
        $insrt->bindParam(':state', $state);
        $insrt->bindParam(':status', $status);
        $insrt->bindParam(':editionDate', $editionDate);
        $insrt->bindParam(':purchaseDate', $purchaseDate);
        $insrt->bindParam(':coverImage', $coverImage);
        $insrt->execute();
    }

    public function getItem($itemId)
    {
        $slct = $this->db->prepare("SELECT * FROM item WHERE id = :itemId");
        $slct->bindParam(':itemId', $itemId);
        $slct->execute();
        $result = $slct->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function editItem($item)
    {
        $id = $item->getId();
        $title = $item->getTitle();
        $authorName = $item->getAuthorName();
        $type = $item->getType();
        $typeValue = $item->getTypeValue();
        $state = $item->getState();
        $status = $item->getStatus();
        $editionDate = $item->getEditionDate();
        $purchaseDate = $item->getPurchaseDate();

        $updte = $this->db->prepare("UPDATE item SET title = '$title', author_name = '$authorName', state = '$state', status = '$status', type = '$type', type_value = '$typeValue',edition_date = '$editionDate',purchase_date = '$purchaseDate' WHERE id = $id");
        $updte->execute();
    }

    public function deleteItem($itemId)
    {
        $delete = $this->db->prepare('DELETE FROM item WHERE id = :itemId');
        $delete->bindParam('itemId', $itemId);
        $delete->execute();
    }

    public function addPenaltyCheck($member)
    {
        $memberId = $member->getId();
        $slct = $this->db->prepare('SELECT borrowing.created_at,borrowing.returned_at,item.title FROM borrowing 
        JOIN reservation 
        ON borrowing.reservation_id = reservation.id
        JOIN member
        ON reservation.member_id = member.id
        JOIN item
		ON item.id = reservation.item_id
        WHERE member.id = :memberId');
        $slct->bindParam('memberId', $memberId);
        $slct->execute();

        $borrowings = $slct->fetchAll(PDO::FETCH_ASSOC);

        $penaltyMessages = [];

        if ($borrowings) {

            $curDate = date('Y-m-d H:m:s');
            $penaltyCount = 0;

            foreach ($borrowings as $borrowing => $value) {
                $penaltyCount++;
                $returnLimitDate = date('Y-m-d H:i:s', strtotime('+15 day', strtotime($value['created_at'])));

                if ($curDate > $returnLimitDate) {
                    $penaltyMessages[] = 'PENALTY ' . $penaltyCount . ' : Return date is exceeded for the item : [' . $value['title'] . ']';
                    
                    $updte = $this->db->prepare('UPDATE member SET penalty_count = :penaltyCount WHERE id = :memberId');
                    $updte->bindParam('penaltyCount', $penaltyCount);
                    $updte->bindParam('memberId', $memberId);
                    $updte->execute();
                }
            }
        }
        return $penaltyMessages;
    }
}
