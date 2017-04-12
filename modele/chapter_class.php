<?php

/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 19/02/2017
 * Time: 15:44
 */
class chapter
{
    protected $chapter_id = null;
    protected $chapter_title;
    protected $chapter_startedOn;
    protected $chapter_lastMod;
    protected $chapter_state;
    protected $publish_on = null;
    protected $chapter_body;
    protected $chapter_novelId;
    protected $chapter_novel_title;


    /*---------------------------------------------------------------------- setters list--------------------------------------------------------------------------*/
    /**
     * @param $chapter_id
     */
    public function setChapterId($chapter_id)
    {
        $this->chapter_id = $chapter_id;
    }

    /**
     * @param $chapter_title
     * @return int
     */
    public function setChapterTitle($chapter_title)
    {
        if (is_string($chapter_title) && $chapter_title !== '')
        {
            $this->chapter_title = ucfirst($chapter_title);
        }

    }


    /**
     * @param $chapter_startedOn
     */
    public function setChapterStartedOn($chapter_startedOn)
    {

        $this->chapter_startedOn = $chapter_startedOn;
    }

    /**
     * @param $chapter_lastMod
     */
    public function setChapterLastMod($chapter_lastMod)
    {
        $this->chapter_lastMod =$chapter_lastMod;
    }

    /**
     * @param $chapter_state
     */
    public function setChapterState($chapter_state)
    {
        $this->chapter_state = $chapter_state;
    }

    /**
     * @param $chapter_body
     * @return int
     */
    public function setChapterBody($chapter_body)
    {
        if(is_string($chapter_body))
        {
            $this->chapter_body = $chapter_body;
        }
    }

    /**
     * @param mixed $publish_on
     */
    public function setChapterPublishOn($publish_on)
    {
        if($publish_on !== null)
        {
            $this->publish_on = $publish_on;
        }
    }

    /**
     * @param $chapter_novelId
     */
    public function setChapterNovelId($chapter_novelId)
    {
        $this->chapter_novelId = $chapter_novelId;
    }

    /**
     * will allow to find a novel title based on the novel id the chapter is related
     * @param $chapter_novelId
     */
    public function setChapterNovelTitle($chapter_novelId)
    {
        $novel = new novelManager();
        $novel_id = $novel->getNovelById($chapter_novelId);
        $chapter_novel_title = $novel_id->getNovelTitle();
        $this ->chapter_novel_title = $chapter_novel_title;
    }

    /*---------------------------------------------------------------------- setters list--------------------------------------------------------------------------*/


    /**
     * @return null
     */
    public function getChapterId()
    {
        return $this->chapter_id;
    }

    /**
     * @return mixed
     */
    public function getChapterTitle()
    {
        return $this->chapter_title;
    }

    /**
     * @return false|string
     */
    public function getChapterStaredOn()
    {
        $tools =new tools();
        $date = $this->chapter_startedOn;
        $fr_date = $tools->dateFormat($date, $time=false);

        return $fr_date;

    }

    /**
     * @return false|string
     */
    public function getChapterLastMod()
    {
        $tools =new tools();
        $date = $this->chapter_lastMod;
        $fr_date = $tools->dateFormat($date, $time=true);

        return $fr_date;
    }

    /**
     * @return mixed
     */
    public function getChapterState()
    {
        return $this->chapter_state;
    }

    /**
     * @return mixed
     */
    public function getChapterBody()
    {
        return $this->chapter_body;
    }

    /**
     * @return mixed
     */
    public function getChapterNovelId()
    {
        return $this->chapter_novelId;
    }

    /**
     * will allow to transform publication date to french format if $fr is set to true
     * it keeps publication date to sql friendly format by default
     * @param bool $fr
     * @return false|null|string
     */
    public function getChapterPublishOn($fr = false)
    {
       $state = $this->getChapterState();
       if($fr == true && $state !== "en cours de rédaction")
       {
          $tools = new tools;
          $date = $this->publish_on;
          $display_date = $tools->dateFormat($date, $time=false);
       }

       else
       {
           $display_date = $this->publish_on;
       }
       return $display_date;
    }

    /**
     * will create an excerpt of a chapter
     * @param $chapter_body
     * @return string
     */
    public function getChapterExcerpt($chapter_body)
    {
        $body = strip_tags($chapter_body);
        $excerpt = substr($body,0,230);
        $clean = strripos($excerpt,".");
        $clean_excerpt = substr($body,0,$clean)."...";

        return $clean_excerpt;
    }

    /**
     * @return mixed
     */
    public function getChapterNovelTitle()
    {
        return $this->chapter_novel_title;
    }
}