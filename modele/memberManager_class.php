<?php

/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 09/02/2017
 * Time: 16:19
 */


class memberManager extends bddManager
{
    /**
     * Check if the object already exist into table by comparing "id"
     * If "id" isn't found -> store the object inside table
     * If "id" is found    -> update bounded values inside table
     * @param $member
     * @param $mail
     * @param $pswd
     */
    public function save($member,$mail,$pswd)
    {
        if($member->getId() === null)
        {
            $this->createMember($member,$mail,$pswd);
        }
        else
        {
            $this->updateMember($member);
        }
    }

    /**
     * @param $member
     *
     * Prepare a query to update "pswd" key from "membres" table
     * Store the data in an array and assign them to the aimed object
     */
    public function updateMember($member)
    {
        $bdd = $this->bdd;
        $req = $bdd->prepare('UPDATE members SET pswd = :pswd WHERE id = : id');

        $req ->execute(array('id'   => $member->getId(),
            'pswd' => $member->getPassword()
        ));
    }

    /**
     * @param $member
     * @param $mail
     * If submitted email was not already stored into db  -> Prepare a query to store a new object (member) into table
     * Store the data in an array and assign them to the object
     */
    public function createMember($member,$mail,$pswd)
    {
        $bdd = $this->bdd;
        $req = $bdd->prepare('INSERT INTO members(email, created_on, surname, name, pswd) VALUES (:email, NOW(), :surname, :name, :pswd)');

        $tools = new tools();
        $check_spam = $tools->isRecaptchaValid($_POST['g-recaptcha-response']);

        if($mail == 0 && !empty($pswd) && $check_spam == true)
        {
            $req->execute(array('email'     => $member->getEmail(),
                                'surname'   => $member->getSurname(),
                                'name'      => $member->getName(),
                                'pswd'      => $member->getPassword(),
            ));

            $_SESSION['flash'] = "votre compte a été activé avec succès !";
            $_SESSION['register_error'] = 0;
            $_SESSION['newbie_email'] = $member->getEmail();

        }
        elseif($mail !== 0 && !empty($pswd))
        {
            $_SESSION['register_error'] = 1;
            $_SESSION['email']    = $member->getEmail();
            $_SESSION['name']     = $member->getName();
            $_SESSION['surname']  = $member->getSurname();

        }
        else
        {
            $_SESSION['register_error'] = 2;
        }

    }


    /**
     * @param $user_input
     * @return string
     * Parse email table from db to check if it already contains submitted email
     */
    public function registeredEmail($user_input)
    {
        $bdd = $this->bdd;
        $req = $bdd->prepare("SELECT COUNT(*)FROM members WHERE email = '$user_input'");
        $req->execute();
        $result = $req->fetchColumn();
        return $result;
    }



    /**
     * will fetch all the members
     * scope can be adjusted with some extra filters
     * @param $filter
     * @return array
     */
    public function getMember($filter)
    {
        $bdd = $this->bdd;
        $req = $bdd->prepare("SELECT * FROM members WHERE $filter");
        $req->execute();

        $members = array();
        while($row = $req->fetch(PDO::FETCH_ASSOC))
        {
            if($row['status'] != "supprimé")
            {
                $myMember = new Member();
                $myMember->setId($row['id']);
                $myMember->setEmail($row['email']);
                $myMember->setSurname($row['surname']);
                $myMember->setName($row['name']);
                $myMember->setDate($row['created_on']);
                $myMember->setPassword($row['pswd']);
                $myMember->setStatus($row['status']);

                $members[] = $myMember;
            }

        }
        return $members;
    }


    /**
     * will fetch all the data of a given member based on its id
     * @param $id
     * @return Member
     */
    public function getMemberById($id)
    {
        $bdd= $this->bdd;
        $req = $bdd->prepare("SELECT * FROM members WHERE id = $id");
        $req->execute();

        while($row = $req->fetch(PDO::FETCH_ASSOC))
        {
            $myMember = new Member();
            $myMember->setId($row['id']);
            $myMember->setEmail($row['email']);
            $myMember->setSurname($row['surname']);
            $myMember->setName($row['name']);
            $myMember->setDate($row['created_on']);
            $myMember->setPassword($row['pswd']);
            $myMember->setStatus($row['status']);
            $myMember->setCountBan($row['countBan']);
        }
        return $myMember;
    }


    /**
     * allow the administrator to banish or reintegrate a member
     * @param $get_status
     * @param $id
     */
    private function updateStatus($get_status,$id)
    {
        if(isset($get_status) && ($get_status == 'actif'))
        {

            $bdd = $this->bdd;
            $req = $bdd->prepare("UPDATE members SET status = :status, countBan = countBan + 1 WHERE id = $id");

            $req->execute(array('status'    => 'banni'));
        }
        elseif (isset($get_status) && ($get_status == 'banni'))
        {
            $bdd = $this->bdd;
            $req = $bdd->prepare("UPDATE members SET status = 'actif' WHERE id = $id");

            $req->execute();
        }
    }


    /**
     * will operate a soft delete to a given member
     * change any former status to "supprimé"
     * @param $member
     *
     */
    private function delete($member)
    {
        $bdd = $this->bdd;
        $req = $bdd->prepare("UPDATE members SET status = :status WHERE id = $member");
        $req->execute(array('status' => 'supprimé'));

        $req->execute();
    }


    /**
     * choose between updateStatus and delete method
     * @param $id
     * @param $status
     *
     */
    public function editMember($id, $status)
    {
        if(isset($id) && isset($status) && $status !== null)
        {
            $this->updateStatus($status, $id);
        }
        else
        {
            $this->delete($id);
        }
    }



}
