<?php

/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 10/03/2017
 * Time: 12:43
 */
class filter
{
    protected $filter;

    /**
     * @param mixed $filter
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    /**
     * @return mixed
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * this method is used to apply some queries filters based on select list post values
     * @param $filter
     * @return string
     */
    public function applyFilter($filter)
    {
        if(isset($_POST['filter']) && $filter !== "1=1")
        {
            $apply_filter = "state = '$filter'";
        }
        elseif(isset($_POST['filter_member']) && $filter !== "1=1")
        {
            $apply_filter = "status = '$filter'";
        }
        else
        {
            $apply_filter = $filter;
        }

        return $apply_filter;
    }


}