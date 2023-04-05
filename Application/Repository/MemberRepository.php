<?php

namespace Application\Repository;

use Application\Entity\MemberEntity;
use PDO;

class MemberRepository extends AbstarctRepository
{
    protected $tableName = 'member';
    protected $entityName = MemberEntity::class;

    public function insert(MemberEntity $member): void
    {
        $nickname = $member->getNickname();
        $email = $member->getEmail();
        $password = md5($member->getPassword());
        $fullName = $member->getFullName();
        $address = $member->getAddress();
        $phone = $member->getPhone();
        $cin = $member->getCin();
        $type = $member->getType();
        $birthDate = $member->getBirthDate();
        $createdAt = (new \DateTime())->format('Y-m-d H:i:s');
        $inst = $this->db->prepare("INSERT INTO member 
        (nickname,email,password,full_name,address,phone,cin,type,birth_date,created_at) VALUES (:nickname,:email,:password,:fullName,:address,:phone,:cin,:type,:birthDate,:createdAt)");
        $inst->bindParam(':nickname', $nickname);
        $inst->bindParam(':email', $email);
        $inst->bindParam(':password', $password);
        $inst->bindParam(':fullName', $fullName);
        $inst->bindParam(':address', $address);
        $inst->bindParam(':phone', $phone);
        $inst->bindParam(':cin', $cin);
        $inst->bindParam(':type', $type);
        $inst->bindParam(':birthDate', $birthDate);
        $inst->bindParam(':createdAt', $createdAt);
        $inst->execute();
    }

    public function emailExist(MemberEntity $member)
    {
        $memberEmail = $member->getEmail();
        $slct = $this->db->prepare("SELECT email FROM member WHERE email = :email");
        $slct->bindParam(':email', $memberEmail);
        $slct->execute();
        $email = $slct->fetch();

        if ($memberEmail === $email['email']) {
            return true;
        }
        return false;
    }

    public function nicknameExist(MemberEntity $member)
    {
        $memberNickname = $member->getNickName();
        $slct = $this->db->prepare("SELECT nickname FROM member WHERE nickname = :nickname");
        $slct->bindParam(':nickname', $memberNickname);
        $slct->execute();
        $nickname = $slct->fetch();

        if ($memberNickname === $nickname['nickname']) {
            return true;
        }
        return false;
    }

    public function update(MemberEntity $member): void
    {
        // TODO to be refactord
        $memberId = $member->getId();
        $nickname = $member->getNickName();
        $email = $member->getEmail();
        $fullName = $member->getFullName();
        $address = $member->getAddress();
        $phone = $member->getPhone();
        $cin = $member->getCin();
        $type = $member->getType();
        $birthDate = $member->getBirthDate();
        $updte = "UPDATE member SET full_name = '$fullName' , address = '$address' , phone = '$phone' , cin = '$cin' , type = '$type' , birth_date = '$birthDate'";
        $where = " WHERE id = $memberId ";
        $updte .= " , nickname = '$nickname'";
        $updte .= " , email = '$email'";
        $sql = $updte . $where;
        $updte = $this->db->prepare($sql);
        $updte->execute();
    }

    public function isMember(MemberEntity $member)
    {
        $criterias = [
            'nickname' => $member->getNickname(),
            'password' => md5($member->getPassword())
        ];

        return $this->findOneBy($criterias);
    }

    public function delete(int $id)
    {
        $delete = $this->db->prepare("DELETE FROM member WHERE id=$id ");
        $delete->execute();
    }


    public function checkUniqueFields(MemberEntity $member)
    {
        $where = '';
        $where .= " AND nickname = '" . $member->getNickname() . "'";
        $where .= " AND id <> " . $member->getId();

        $errors = [];
        if ($this->findOneBy($where)) {
            $errors['nickname'] = 'nikname exists';
        }

        $where = '';
        $where .= " AND email = '" . $member->getEmail() . "'";
        $where .= " AND id <> " . $member->getId();

        if ($this->findOneBy($where)) {
            $errors['email'] = 'email exists';
        }

        return $errors;
    }

    public function isBanned(MemberEntity $member)
    {
        $id = $member->getId();
        $slct = $this->db->prepare('SELECT penalty_count FROM member WHERE id = :id');
        $slct->bindParam('id', $id);
        $slct->execute();
        $count = $slct->fetch(PDO::FETCH_OBJ);


        if ($count->penalty_count == 3) {
            return true;
        }
        return false;
    }
}
