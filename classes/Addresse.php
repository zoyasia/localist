<?php

class Address {
    public function __construct(
    protected int $id,
    protected string $addressName,
    protected string $picture,
    protected string $comment,
    protected string $street,
    protected int $zipcode,
    protected string $city,
    protected string $phone,
    protected string $website,
    protected int $category_id,
    protected int $user_id,
    protected int $status_id,
    ){
    }
    


    public function getName(): string
    {
        return $this->addressName;
    }

    public function setName($addressName)
    {
        $this->addressName = $addressName;
        return $this;
    }


    public function getCategory()
    {
        return $this->category_id;
    }


    public function setCategory($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    public function getStatus()
    {
        return $this->status_id;
    }

    public function setStatus($status_id)
    {
        $this->status_id = $status_id;

        return $this;
    }
    public function getPicture()
    {
        return $this->picture;
    }
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }
    public function getZipcode()
    {
        return $this->zipcode;
    }
 
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    public function getUrl()
    {
        return $this->website;
    }

    public function setUrl($website)
    {
        $this->website = $website;

        return $this;
    }
}