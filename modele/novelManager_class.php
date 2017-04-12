<?php

/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 18/02/2017
 * Time: 17:55
 */
class novelManager extends bddManager
{


    /**
     * Store a new novel into database if its title isn't already taken
     * @param $title
     * @param $novel
     * @return string
     *
     */
    public function createNovel($title, $novel)
    {
        $bdd = $this->bdd;
        $req = $bdd->prepare('INSERT INTO novels(title, added_on) VALUES (:title, NOW())');
        if($title == 0)
        {
            $req->execute(array('title' => $novel->getNovelTitle()));
            $_SESSION['flash'] = "Roman créer";
            $_SESSION['novel_error'] = 0;
        }
        else
        {
            $_SESSION['novel_error'] = 1;
        }

    }

    /**
     * will delete a novel and all related chapters
     * table junction made in "php my admin" settings
     * @param $novelId
     */
    public function deleteNovel($novelId)
    {
        $bdd = $this->bdd;
        $query = ("DELETE FROM novels WHERE id = $novelId");
        $req = $bdd->prepare($query);

        $req->execute();
    }


    /**
     * Parse database romans table and check how many novel share this title
     * @param $user_input
     * @return string
     */
    public function verifyTitle($user_input)
    {
        $bdd = $this->bdd;
        $req = $bdd->prepare("SELECT COUNT(*)FROM novels WHERE title = '$user_input'");
        $req->execute();
        $result = $req->fetchColumn();

        return $result;
    }

    /**
     * Parse database and assign the keys value of "romans" table to the array
     * @return array
     */
    public function getNovel()
    {

        $bdd = $this->bdd;
        $req = $bdd->prepare("SELECT * FROM novels");
        $req->execute();

        $novels = array();
        while($row = $req->fetch(PDO::FETCH_ASSOC))
        {

            $myNovel = new novel();
            $myNovel ->setNovelId($row['id']);
            $myNovel ->setNovelTitle($row['title']);
            $myNovel ->setNovelDate($row['added_on']);

            $novels[] = $myNovel;
        }
        return $novels;
    }


    /**
     * will fetch all data from a given novel
     * @param $id
     * @return novel
     */
    public function getNovelById($id)
    {
        $bdd = $this->bdd;
        $req = $bdd->prepare("SELECT * FROM novels WHERE id = $id");
        $req->execute();

        while ($row = $req->fetch(PDO::FETCH_ASSOC))
        {
            $myNovel = new novel();
            $myNovel ->setNovelId($row['id']);
            $myNovel ->setNovelTitle($row['title']);
            $myNovel ->setNovelDate($row['added_on']);
        }

        return $myNovel;
    }

}