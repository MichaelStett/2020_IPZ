<?php


class Weather
{
    private $id;
    private $user_id;
    private $city_name;

    public function __construct($params)
    {
        if ($params) {
            $this->fromArray($params);
        }
    }

    private function fromArray($params) {
        $this
            ->setId($params['id'])
            ->setUser_id($params['user_id'])
            ->setCity_name($params['city_name']);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): Weather
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): Weather
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCityName()
    {
        return $this->city_name;
    }

    /**
     * @param mixed $city_name
     */
    public function setCityName($city_name): Weather
    {
        $this->city_name = $city_name;
        return $this;
    }


}