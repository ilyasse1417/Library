<?php

namespace Application\Repository;

use PDO;

class BorrowingRepository extends AbstarctRepository
{
    protected $tableName = 'item';
    protected $entityName = ItemEntity::class;

    public function insert($reservationId)
    {
        $createdAt = (new \DateTime())->format('Y-m-d H:i:s');
        $inst = $this->db->prepare("INSERT INTO borrowing (reservation_id,created_at) VALUES (:reservationId,:createdAt)");
        $inst->bindParam(':reservationId', $reservationId);
        $inst->bindParam(':createdAt', $createdAt);
        $inst->execute();
    }

    public function getStatus($itemId)
    {
        $slct = $this->db->prepare("SELECT status FROM item WHERE id = :itemId");
        $slct->bindParam(':itemId', $itemId);
        $slct->execute();
        $result = $slct->fetch();
        return $result['status'];
    }

    public function updateStatus($itemId)
    {
        $update = $this->db->prepare("UPDATE item SET status = 'Borrowed' WHERE id=:itemId ");
        $update->bindParam(':itemId', $itemId);
        $update->execute();
    }

    public function selectBorrowings($memberId)
    {
        $slct = $this->db->prepare('SELECT *,borrowing.id AS borrowing_id FROM item 
        JOIN reservation 
        ON item.id = reservation.item_id 
        JOIN borrowing
        ON borrowing.reservation_id = reservation.id
        WHERE reservation.member_id = :memberId');
        $slct->bindParam(':memberId', $memberId);
        $slct->execute();
        $result = $slct->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function selectBorrowingById($borrowingId)
    {
        $slct = $this->db->prepare('SELECT *, borrowing.id AS borrowing_id, reservation.id AS reservation_id 
        FROM item 
        JOIN reservation 
        ON item.id = reservation.item_id
        JOIN borrowing
        ON borrowing.reservation_id = reservation.id
        WHERE borrowing.id = :borrowingId');
        $slct->bindParam(':borrowingId', $borrowingId);
        $slct->execute();
        $result = $slct->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function returnBorrowing($borrowingId)
    {
        $returnedAt = (new \DateTime())->format('Y-m-d H:i:s');
        $updte = $this->db->prepare('UPDATE item 
        JOIN reservation 
        ON item.id = reservation.item_id
        JOIN borrowing
        ON borrowing.reservation_id = reservation.id
        SET status = "Available" 
        WHERE borrowing.id = :borrowingId');
        $updte->bindParam(':borrowingId', $borrowingId);
        $updte->execute();
        $return = $this->db->prepare('UPDATE borrowing SET returned_at = :returnedAt WHERE
        borrowing.id = :borrowingId');
        $return->bindParam(':returnedAt', $returnedAt);
        $return->bindParam(':borrowingId', $borrowingId);
        $return->execute();
    }

}
