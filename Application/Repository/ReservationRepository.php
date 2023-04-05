<?php

namespace Application\Repository;

use PDO;

class ReservationRepository extends AbstarctRepository
{
    protected $tableName = 'item';
    protected $entityName = ItemEntity::class;

    public function insert($itemId, $memberId)
    {
        $createdAt = (new \DateTime())->format('Y-m-d H:i:s');
        $inst = $this->db->prepare("INSERT INTO reservation (created_at,item_id,member_id) VALUES (:createdAt,:itemId,:memberId)");
        $inst->bindParam(':createdAt', $createdAt);
        $inst->bindParam(':itemId', $itemId);
        $inst->bindParam(':memberId', $memberId);
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
        $update = $this->db->prepare("UPDATE item SET status = 'Reserved' WHERE id=:itemId ");
        $update->bindParam(':itemId', $itemId);
        $update->execute();
    }

    public function selectReservations($memberId)
    {
        $slct = $this->db->prepare('SELECT *, reservation.id AS reservation_id FROM item JOIN reservation on item.id = reservation.item_id WHERE reservation.member_id = :id');
        $slct->bindParam(':id', $memberId);
        $slct->execute();
        $result = $slct->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function selectReservationById($reservationId)
    {
        $slct = $this->db->prepare('SELECT *, reservation.id AS reservation_id FROM item JOIN reservation on item.id = reservation.item_id WHERE reservation.id = :reservationId');
        $slct->bindParam(':reservationId', $reservationId);
        $slct->execute();
        $result = $slct->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function confirmReservation($reservationId)
    {
        $createdAt = (new \DateTime())->format('Y-m-d H:i:s');
        $insrt = $this->db->prepare('INSERT INTO borrowing(reservation_id,created_at) VALUES (:reservationId, :createdAt)');
        $insrt->bindParam(':reservationId', $reservationId);
        $insrt->bindParam(':createdAt', $createdAt);
        $insrt->execute();
        $updte = $this->db->prepare('UPDATE item JOIN reservation ON item.id = reservation.item_id  SET status = "Borrowed" WHERE reservation.id = :reservationId');
        $updte->bindParam(':reservationId', $reservationId);
        $updte->execute();
    }

    public function getAvailableReservations($memberId)
    {
        $slct = $this->db->prepare("SELECT *
        FROM item
        JOIN reservation ON reservation.item_id = item.id
        JOIN borrowing ON borrowing.reservation_id = reservation.id
        WHERE reservation.member_id = :memberId AND borrowing.reservation_id = reservation.id");
        $slct->bindParam('memberId', $memberId);
        $slct->execute();
        $confirmedReservations = $slct->fetchAll(PDO::FETCH_ASSOC);

        foreach ($confirmedReservations as $key => $confirmedReservation) {
            $confirmedReservationsIds[] = $confirmedReservation['reservation_id'];
        }

        $curDate = date('Y-m-d H:m:s');
        $reservations = $this->selectReservations($memberId);
        $availableReservations = [];

        foreach ($reservations as $key => $reservation) {
            $createdAt = $reservation['created_at'];
            $expiresAt = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($createdAt)));

            if ($curDate < $expiresAt) {
                $availableReservations[] = $reservation;
            }
        }
        if ($confirmedReservations) {
            for ($i = 0; $i < count($availableReservations); $i++) {
                for ($j = 0; $j < count($confirmedReservationsIds); $j++) {
                    if ($availableReservations[$i]['id'] == $confirmedReservationsIds[$j]) {
                        array_splice($availableReservations, $i, 1);
                    }
                }
            }
        }
        return $availableReservations;
    }

    public function getAvailableBorrowings($memberId)
    {
        $slct = $this->db->prepare('SELECT *,borrowing.id AS borrowing_id FROM item 
        JOIN reservation 
        ON item.id = reservation.item_id 
        JOIN borrowing
        ON borrowing.reservation_id = reservation.id
        WHERE reservation.member_id = :memberId');
        $slct->bindParam(':memberId', $memberId);
        $slct->execute();
        $borrowings = $slct->fetchAll(PDO::FETCH_ASSOC);

        $availableBorrowings = [];

        foreach ($borrowings as $key => $value) {
            $returnedAt = $value['returned_at'];

            if (!$returnedAt) {
                $availableBorrowings[] = $value;
            }
        }
        return $availableBorrowings;
    }

    public function cancelReservation($reservationId)
    {
        $updte = $this->db->prepare("DELETE FROM reservation 
        WHERE id = :reservationId ");
        $updte->bindParam('reservationId', $reservationId);
        $updte->execute();
    }
}
