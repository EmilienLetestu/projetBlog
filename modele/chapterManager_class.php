<?php

/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 20/02/2017
 * Time: 11:33
 */
class chapterManager extends bddManager
{

    /**
     * This method will choose between creating or updating a chapter relying on chapter_id presence
     * @param $publish_on
     * @param $publish
     * @param $chapter
     * @param $novel_id
     * @param $chapter_id
     */
    public function saveChapter($publish_on,$publish,$chapter,$novel_id,$chapter_id)
    {
        if(isset($chapter_id) && !empty($chapter_id))
        {
            $this->updateChapter($publish_on,$publish,$chapter,$chapter_id);
        }
        else
        {
            $this->createChapter($publish_on,$publish,$chapter,$novel_id);
        }
    }

    /**
     * This method create a chapter and let user the ability to set different kind of release options
     * @param $publish_on
     * @param $publish
     * @param $chapter
     * @param $novel_id
     * @return PDOStatement
     */

     private function createChapter($publish_on,$publish,$chapter,$novel_id)
     {
         if(isset($publish) && $publish == 'laterOn' && isset($publish_on) && $publish_on !== '')
         {
             $bdd = $this->bdd;
             $req = $bdd->prepare("INSERT INTO chapters(title, started_on, last_mod, publish_on, body, state, novels_id) VALUES (:title, NOW(), NOW(),:publish_on ,:body,:state,$novel_id)");

             $req->execute(array('title'      => $chapter->getChapterTitle(),
                                 'state'      => 'en attente de publication',
                                 'publish_on' => $chapter->getChapterPublishOn(),
                                 'body'       => $chapter->getChapterBody()
             ));
             if($chapter->getChapterTitle() == null )
             {
                 $_SESSION['saving_error'] = 1;
             }
             else
             {
                 $_SESSION['flash'] = "Chapitre sauvegardé, publication programmée pour le " . $chapter->getChapterPublishOn($fr=true);
                 $_SESSION['saving_error'] = 0;
             }
         }
         elseif(isset($publish) && $publish == "now")
         {
             $bdd = $this->bdd;
             $req = $bdd->prepare("INSERT INTO chapters(title, started_on, last_mod, publish_on, body, state, novels_id) VALUES (:title, NOW(), NOW(),CURDATE(),:body,:state,$novel_id)");

             $req->execute(array('title'      => $chapter->getChapterTitle(),
                                 'state'      => 'publié',
                                 'body'       => $chapter->getChapterBody()
             ));
             if($chapter->getChapterTitle() == null)
             {
                 $_SESSION['saving_error'] = 1;
             }
             else
              {
                 $_SESSION['flash'] = "Chapitre sauvegardé et publié";
                 $_SESSION['saving_error'] = 0;
              }
         }
         else
         {
             $bdd = $this->bdd;
             $req = $bdd->prepare("INSERT INTO chapters(title, started_on, last_mod, publish_on, body, state, novels_id) VALUES (:title, NOW(), NOW(),:publish_on ,:body,:state,$novel_id)");

             $req->execute(array('title' => $chapter->getChapterTitle(),
                                 'state' => 'en cours de rédaction',
                                 'publish_on' => NULL,
                                 'body'  => $chapter->getChapterBody()
             ));
             if($chapter->getChapterTitle() == null)
             {
                 $_SESSION['saving_error'] = 1;
             }
             else
             {
                 $_SESSION['flash'] = "Chapitre sauvegardé";
                 $_SESSION['saving_error'] = 0;
             }
         }
     }

    /**
     * Same as above method but for updating instead of creating
     * @param $publish_on
     * @param $publish
     * @param $chapter
     * @param $chapter_id
     * @return string
     */
    private function updateChapter($publish_on,$publish,$chapter,$chapter_id)
    {
        if(isset($publish) && $publish == 'laterOn' && isset($publish_on) && $publish_on !== '')
        {
            $bdd = $this->bdd;
            $req = $bdd->prepare("UPDATE chapters SET title = :title, last_mod = NOW(), publish_on = :publish_on , body = :body, state = :state WHERE id = $chapter_id");

            $req->execute(array('title'      => $chapter->getChapterTitle(),
                                'publish_on' => $chapter->getChapterPublishOn(),
                                'state'      => 'en attente de publication',
                                'body'       => $chapter->getChapterBody()
            ));

            $_SESSION['flash'] = "Modification sauvegardée, publication programmée pour le".$chapter->getChapterPublishOn($fr=true);

        }
        elseif(isset($publish) && $publish == "now")
        {
            $bdd = $this->bdd;
            $req = $bdd->prepare("UPDATE chapters SET title = :title, last_mod = NOW(), publish_on = CURDATE() , body = :body, state = :state WHERE id = $chapter_id");

            $req->execute(array('title'      => $chapter->getChapterTitle(),
                                'state'      => 'publié',
                                'body'       => $chapter->getChapterBody()
            ));

            $_SESSION['flash'] = "Modification sauvegardée, chapitre publié";
        }
        else
        {
            $bdd = $this->bdd;
            $req = $bdd->prepare("UPDATE chapters SET title = :title, last_mod = NOW(), body = :body WHERE id = $chapter_id");

            $req->execute(array('title' => $chapter->getChapterTitle(),
                                'body'  => $chapter->getChapterBody()
            ));

            $_SESSION['flash'] = "Modification sauvegardée";
        }
    }

    /**
     * This method will delete a chapter
     * @param $query
     */
    public function deleteChapter($query)
    {

        $bdd   = $this->bdd;
        $query = ("DELETE FROM chapters WHERE $query");
        $req   = $bdd->prepare($query);
        $req->execute();

        $_SESSION['flash'] = "Chapitre supprimé";
    }

    /**
     * this method will fetch all released chapter from db based on the "publish_on" table key
     * if a chapter was awaiting for release, its state will be changed from "en attente de publication" to "publié"
     * @param $novel_id
     * @return array
     */
    public function getPublishedChapter($novel_id)
    {

        $bdd = $this->bdd;
        $req = $bdd->prepare("SELECT * FROM chapters WHERE novels_id = $novel_id AND publish_on <= NOW() order by publish_on");
        $req->execute();

        $chapters = array();
        while($row = $req->fetch(PDO::FETCH_ASSOC))
        {

            $myChapter = new chapter();
            $myChapter ->setChapterId($row['id']);
            $myChapter ->setChapterBody($row['body']);
            $myChapter ->setChapterTitle($row['title']);
            $myChapter ->setChapterStartedOn($row['started_on']);
            $myChapter ->setChapterLastMod($row['last_mod']);
            $myChapter ->setChapterState($row['state']);
            $myChapter ->setChapterPublishOn($row['publish_on']);

            if($myChapter->getChapterState() !== 'publié')
            {
                $req = $bdd->prepare("UPDATE chapters SET state = :state WHERE publish_on <= NOW()");

                $req->execute(array('state' => 'publié'));
            }
            $chapters[] = $myChapter;
    }
        return $chapters;
    }

    /**
     * * This method fetch all chapter of a given novel with the ability to adjust its scope with some filters
     * if the array parameter is set to true the method will return an array
     * @param $novel_id
     * @param $filter
     * @param bool $array
     * @return array|chapter
     */
    public function getAllChapter($novel_id,$filter,$array=true)
    {

        $bdd = $this->bdd;
        $req = $bdd->prepare("SELECT * FROM chapters WHERE novels_id = $novel_id AND $filter");
        $req->execute();

        if($array == true)
        {
            $chapters = array();
            while ($row = $req->fetch(PDO::FETCH_ASSOC)) {

                $myChapter = new chapter();
                $myChapter->setChapterId($row['id']);
                $myChapter->setChapterBody($row['body']);
                $myChapter->setChapterTitle($row['title']);
                $myChapter->setChapterStartedOn($row['started_on']);
                $myChapter->setChapterLastMod($row['last_mod']);
                $myChapter->setChapterState($row['state']);
                $myChapter->setChapterPublishOn($row['publish_on']);

                $chapters[] = $myChapter;
            }
        }
        elseif($array == false)
        {
            while($row = $req->fetch(PDO::FETCH_ASSOC))
            {
                $chapters = new chapter();
                $chapters ->setChapterId($row['id']);
                $chapters ->setChapterTitle($row['title']);
                $chapters ->setChapterBody($row['body']);
                $chapters ->setChapterStartedOn($row['started_on']);
                $chapters ->setChapterLastMod($row['last_mod']);
                $chapters ->setChapterState($row['state']);
                $chapters ->setChapterNovelId($row['novels_id']);
            }
        }
        return $chapters;
    }

    /**
     * @param $chapter_id
     * @return chapter
     */
    public function getChapterById($chapter_id)
    {
        $bdd = $this->bdd;
        $req = $bdd->prepare("SELECT * FROM chapters WHERE id = $chapter_id");
        $req->execute();
        $count = $req->rowCount();

        if($count !== 0)
        {
            while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
                $myChapter = new chapter();
                $myChapter->setChapterId($row['id']);
                $myChapter->setChapterTitle($row['title']);
                $myChapter->setChapterBody($row['body']);
                $myChapter->setChapterStartedOn($row['started_on']);
                $myChapter->setChapterLastMod($row['last_mod']);
                $myChapter->setChapterState($row['state']);
                $myChapter->setChapterNovelId($row['novels_id']);
                $myChapter->setChapterPublishOn($row['publish_on']);
            }

        }
        elseif ($count == 0)
        {
           header('location: //localhost/blog/accueil');
           $_SESSION['flash'] = "Désolé cette page n'existe pas !";
        }

        return $myChapter;
    }

    /**
     * This method will fetch the next published chapter in line based on a given chapter id
     * @param $chapter_publish_on
     * @return array
     */
    public function getNextChapter($chapter_publish_on)
    {
        $bdd = $this->bdd;
        $req = $bdd->prepare("SELECT * FROM chapters WHERE publish_on > '$chapter_publish_on' AND state = 'publié' ORDER BY publish_on LIMIT 1");
        $req->execute();

        $chapters = array();
        while ($row = $req->fetch(PDO::FETCH_ASSOC))
        {
            $myChapter = new chapter();
            $myChapter->setChapterId($row['id']);
            $myChapter->setChapterTitle($row['title']);
            $chapters[] = $myChapter;
        }
        return $chapters;
    }


    /**
     * This method will fetch previous published chapter based on a given chapter id
     * @param $chapter_publish_on
     * @return array
     */
    public function getPreviousChapter($chapter_publish_on)
    {
        $bdd = $this->bdd;
        $req = $bdd->prepare("SELECT * FROM chapters WHERE publish_on < '$chapter_publish_on' AND state = 'publié' ORDER BY publish_on DESC LIMIT 1");
        $req->execute();

        $chapters = array();
        while ($row = $req->fetch(PDO::FETCH_ASSOC))
        {
            $myChapter = new chapter();
            $myChapter->setChapterId($row['id']);
            $myChapter->setChapterTitle($row['title']);

            $chapters[] = $myChapter;
        }
        return $chapters;
    }

}



