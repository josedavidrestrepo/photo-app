<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 29/10/2016
 * Time: 0:47
 */
class Person
{
    private $person_id;
    private $name;

    /**
     * @return mixed
     */
    public function getPersonId()
    {
        return $this->person_id;
    }

    /**
     * @param mixed $person_id
     */
    public function setPersonId($person_id)
    {
        $this->person_id = $person_id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}