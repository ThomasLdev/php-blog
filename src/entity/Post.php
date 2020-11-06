<?php

use \OC\Blog\Model\Manager;

class Post extends Manager
{
    private $id;
    private $author;
    private $title;
    private $created_at;
    private $updated_at;
    private $category;
    private $content;

    //GETTERS

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    //SETTERS
    //PEUT ETRE NE PAS LE PROPOSER, SINON CHANGER L'ID VA PETER LA BASE
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $id = (int) $id;;
        if($id > 0){
            $this->id = $id;
        }
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        if(is_string($author)){
            $this->author = $author;
        }
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        if(is_string($title)){
            $this->title = $title;
        }
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
}